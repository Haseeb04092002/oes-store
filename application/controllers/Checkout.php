<?php
class Checkout extends CI_Controller
{
    /**
     * Custom Render Function
     * Handles consistent layout loading for Header, Content, and Footer
     */
    protected function render($view_path, $data = [])
    {
        // 1. Load the Header (Standard for all pages)
        $this->load->view('layout/header', $data);

        // 2. Load the specific page content
        // Note: $view_path will be something like 'customer/checkout_step1'
        $this->load->view($view_path, $data);

        // 3. Load the Footer (Standard for all pages)
        $this->load->view('layout/footer', $data);
    }

    public function index()
    {
        if (!$this->cart->contents()) redirect('main/index');
        $data['title'] = "Checkout - Step 1";
        $this->render('customer/checkout_step1', $data);
    }

    public function process_info()
    {
        $phone = $this->input->post('phone');

        $customer_data = [
            'full_name' => $this->input->post('full_name'),
            'phone'     => $phone,
            'city'      => $this->input->post('city'),
            'post_code' => $this->input->post('post_code'),
            'address'   => $this->input->post('address')
        ];

        // Check if customer exists by phone
        $user = $this->db->get_where('customers', ['phone' => $phone])->row_array();

        if ($user) {
            // Update existing customer info
            $this->db->where('id', $user['id'])->update('customers', $customer_data);
            $cus_id = $user['id'];
        } else {
            // Create new customer
            $this->db->insert('customers', $customer_data);
            $cus_id = $this->db->insert_id();
        }

        // Auto-login the user
        $this->session->set_userdata([
            'cus_id' => $cus_id,
            'cus_name' => $customer_data['full_name'],
            'cus_logged' => TRUE
        ]);

        redirect('checkout/payment');
    }

    public function payment()
    {
        if (!$this->session->userdata('cus_logged')) redirect('checkout');
        $data['title'] = "Payment - Step 2";
        $this->render('customer/checkout_payment', $data);
    }
}
