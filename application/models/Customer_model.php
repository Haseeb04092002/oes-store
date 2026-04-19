<?php
class Customer_model extends CI_Model {

    public function get_wishlist($customer_id) {
        $this->db->select('products.*, product_media.file_path');
        $this->db->from('wishlist');
        $this->db->join('products', 'products.id = wishlist.product_id');
        $this->db->join('product_media', 'product_media.product_id = products.id', 'left');
        $this->db->where('wishlist.customer_id', $customer_id);
        $this->db->group_by('products.id');
        return $this->db->get()->result_array();
    }

    public function get_orders($customer_id) {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get_where('orders', ['customer_id' => $customer_id])->result_array();
    }

    public function get_reviews($customer_id) {
        $this->db->select('reviews.*, products.title as product_name');
        $this->db->from('reviews');
        $this->db->join('products', 'products.id = reviews.product_id');
        $this->db->where('reviews.customer_id', $customer_id);
        return $this->db->get()->result_array();
    }
}