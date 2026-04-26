<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('cus_logged')) redirect('main/login');
        $this->load->model('Order_model');
        $this->load->library('cart');
    }

    public function place()
    {
        // 1. Validate Cart
        if (!$this->cart->contents()) {
            $this->session->set_flashdata('error', 'Your cart is empty.');
            redirect('main/products');
        }

        // 2. Prepare Order Data
        $order_data = [
            'customer_id'    => $this->session->userdata('cus_id'),
            'total_amount'   => $this->cart->total(),
            'payment_method' => $this->input->post('payment'),
            'order_status'   => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        // 3. Prepare Order Items Data
        $items_data = [];
        foreach ($this->cart->contents() as $item) {
            $items_data[] = [
                'product_id' => $item['id'],
                'quantity'   => $item['qty'],
                'unit_price' => $item['price']
            ];
        }

        // 4. Process via Model
        $order_id = $this->Order_model->create_order($order_data, $items_data);

        if ($order_id) {
            // Success: Clear Cart and show success page
            $this->cart->destroy();
            $this->session->set_flashdata('order_id', $order_id);
            redirect('order/success');
        } else {
            $this->session->set_flashdata('error', 'Failed to place order. Please contact support.');
            redirect('main/checkout');
        }
    }

    public function success()
    {
        if (!$this->session->flashdata('order_id')) redirect('main/index');

        $data['title'] = "Order Success | OES";
        $data['order_id'] = $this->session->flashdata('order_id');

        $this->load->view('layout/header', $data);
        $this->load->view('customer/order_success', $data);
        $this->load->view('layout/footer');
    }

    public function place_with_receipt()
    {
        // 1. Upload the Receipt Image
        $config['upload_path']   = './uploads/receipts/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('receipt_image')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('checkout/payment');
        }

        $upload_data = $this->upload->data();

        // 2. Save Order to DB
        $order_data = [
            'customer_id'    => $this->session->userdata('cus_id'),
            'total_amount'   => $this->cart->total(),
            'payment_method' => $this->input->post('payment_method'),
            'receipt_path'   => $upload_data['file_name'],
            'order_status'   => 'pending'
        ];

        $order_id = $this->Order_model->save_full_order($order_data, $this->cart->contents());

        if ($order_id) {
            $this->cart->destroy();
            // Redirect to a method that generates PDF
            redirect('order/generate_pdf/' . $order_id);
        }
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
