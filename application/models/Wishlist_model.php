<?php
class Wishlist_model extends CI_Model {

    public function is_in_wishlist($customer_id, $product_id) {
        return $this->db->get_where('wishlist', [
            'customer_id' => $customer_id, 
            'product_id' => $product_id
        ])->num_rows() > 0;
    }

    public function toggle_wishlist($customer_id, $product_id) {
        if ($this->is_in_wishlist($customer_id, $product_id)) {
            $this->db->delete('wishlist', ['customer_id' => $customer_id, 'product_id' => $product_id]);
            return 'removed';
        } else {
            $this->db->insert('wishlist', ['customer_id' => $customer_id, 'product_id' => $product_id]);
            return 'added';
        }
    }

    public function get_customer_wishlist($customer_id) {
        $this->db->select('products.*, product_media.file_path');
        $this->db->from('wishlist');
        $this->db->join('products', 'products.id = wishlist.product_id');
        $this->db->join('product_media', 'product_media.product_id = products.id', 'left');
        $this->db->where('wishlist.customer_id', $customer_id);
        $this->db->group_by('products.id'); // Avoid duplicates from media
        return $this->db->get()->result_array();
    }
}