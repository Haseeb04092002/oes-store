<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('cus_logged')) redirect('main/login');
        $this->load->model('Order_model');
        $this->load->library('cart');
    }

    public function place() {
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

    public function success() {
        if (!$this->session->flashdata('order_id')) redirect('main/index');
        
        $data['title'] = "Order Success | OES";
        $data['order_id'] = $this->session->flashdata('order_id');
        
        $this->load->view('layout/header', $data);
        $this->load->view('customer/order_success', $data);
        $this->load->view('layout/footer');
    }
}