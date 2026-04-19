<?php
class Wishlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('cus_logged')) {
            echo json_encode(['status' => 'error', 'message' => 'Please login']);
            exit;
        }
        $this->load->model('Wishlist_model');
    }

    public function toggle($product_id) {
        $customer_id = $this->session->userdata('cus_id');
        $result = $this->Wishlist_model->toggle_wishlist($customer_id, $product_id);
        echo json_encode(['status' => 'success', 'action' => $result]);
    }

    public function remove($product_id) {
        $customer_id = $this->session->userdata('cus_id');
        $this->db->delete('wishlist', ['customer_id' => $customer_id, 'product_id' => $product_id]);
        $this->session->set_flashdata('success', 'Removed from wishlist.');
        redirect('main/account/wishlist');
    }
}