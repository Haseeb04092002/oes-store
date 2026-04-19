<?php
class Review_model extends CI_Model {

    public function insert_review($data) {
        return $this->db->insert('reviews', $data);
    }

    public function get_product_reviews($product_id) {
        $this->db->select('reviews.*, customers.full_name');
        $this->db->from('reviews');
        $this->db->join('customers', 'customers.id = reviews.customer_id');
        $this->db->where('reviews.product_id', $product_id);
        $this->db->where('reviews.status', 'approved');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_avg_rating($product_id) {
        $this->db->select_avg('rating');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('reviews')->row();

        // Use the null coalescing operator (??) to default to 0 if no rating exists
        $rating = $query->rating ?? 0;

        return round((float)$rating, 1);
    }
}