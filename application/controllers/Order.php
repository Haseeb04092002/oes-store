<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Removed global login check to allow guest checkout
        $this->load->model('Order_model');
        $this->load->library('cart');
    }

    public function submit_order()
    {
        // 1. Validate Cart
        if (!$this->cart->contents()) {
            $this->session->set_flashdata('error', 'Your cart is empty.');
            redirect('main/products');
        }

        $phone = $this->input->post('phone');
        $full_name = $this->input->post('full_name');
        
        // 2. Process Customer Information
        $user = $this->db->get_where('customers', ['phone' => $phone])->row_array();

        $customer_data = [
            'full_name' => $full_name,
            'phone'     => $phone,
            'city'      => $this->input->post('city'),
            'post_code' => $this->input->post('post_code'),
            'address'   => $this->input->post('address')
        ];

        if ($user) {
            $this->db->where('id', $user['id'])->update('customers', $customer_data);
            $cus_id = $user['id'];
        } else {
            // New user registration without password required
            $this->db->insert('customers', $customer_data);
            $cus_id = $this->db->insert_id();
        }

        // Auto-login the user
        $this->session->set_userdata([
            'cus_id' => $cus_id,
            'cus_name' => $full_name,
            'cus_logged' => TRUE
        ]);

        // 3. Upload the Receipt Image
        $config['upload_path']   = './uploads/receipts/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        if (!$this->upload->do_upload('receipt_image')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('main/checkout');
        }

        $upload_data = $this->upload->data();

        // 4. Prepare Order Data
        // Note: ensure your orders table has receipt_path column, or adjust accordingly.
        $order_data = [
            'customer_id'    => $cus_id,
            'total_amount'   => $this->cart->total(),
            'payment_method' => $this->input->post('payment'),
            'receipt_path'   => $upload_data['file_name'],
            'order_status'   => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        // 5. Prepare Order Items Data
        $items_data = [];
        foreach ($this->cart->contents() as $item) {
            $items_data[] = [
                'product_id' => $item['id'],
                'quantity'   => $item['qty'],
                'unit_price' => $item['price']
            ];
        }

        // 6. Process via Model
        $order_id = $this->Order_model->create_order($order_data, $items_data);

        if ($order_id) {
            // Success: Clear Cart and show success page
            $this->cart->destroy();
            $this->session->set_flashdata('order_id', $order_id);
            redirect('order/success_review');
        } else {
            $this->session->set_flashdata('error', 'Failed to place order. Please contact support.');
            redirect('main/checkout');
        }
    }

    public function success_review()
    {
        if (!$this->session->flashdata('order_id')) redirect('main/index');

        $data['title'] = "Order Received | OES";
        $data['order_id'] = $this->session->flashdata('order_id');

        $this->load->view('layout/header', $data);
        $this->load->view('customer/success_review', $data);
        $this->load->view('layout/footer');
    }

    public function generate_pdf($order_id)
    {
        // 1. Load the Order Data
        $this->load->model('Order_model');
        $order = $this->Order_model->get_order_details($order_id);
        $items = $this->Order_model->get_order_items($order_id);

        if (!$order) {
            $this->session->set_flashdata('error', 'Order record not found.');
            redirect('main/index');
        }

        // 2. Manually include Dompdf from third_party
        // Note: Ensure the path to autoload.inc.php matches your folder structure exactly
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

        // 3. Setup Dompdf Options
        $options = new Dompdf\Options();
        $options->set('isRemoteEnabled', true); // Essential for loading your logo or CSS images
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf\Dompdf($options);

        // 4. Load the view as a string (the 3rd parameter 'true' is key)
        $data = [
            'order' => $order,
            'items' => $items
        ];
        $html = $this->load->view('customer/order_pdf_view', $data, true);

        // 5. Generate and Stream the PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Forces a download in the browser
        $dompdf->stream("Invoice-OES-{$order_id}.pdf", array("Attachment" => 1));
    }
}
