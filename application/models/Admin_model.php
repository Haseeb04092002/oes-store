<?php
class Admin_model extends CI_Model
{

    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }

    public function get_product_by_id($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        return $this->db->delete('products', ['id' => $id]);
    }

    public function get_dashboard_stats() {
        return [
            'total_sales'    => $this->db->select_sum('total_amount')->get_where('orders', ['order_status' => 'completed'])->row()->total_amount ?? 0,
            'total_products' => $this->db->count_all('products'),
            'pending_reviews'=> $this->db->where('status', 'pending')->count_all_results('reviews'),
            'total_customers'=> $this->db->count_all('customers')
        ];
    }

    public function get_sales_chart_data() {
        // Fetches sales grouped by month for the current year
        $this->db->select('MONTHNAME(created_at) as month, SUM(total_amount) as total');
        $this->db->from('orders');
        $this->db->where('YEAR(created_at)', date('Y'));
        $this->db->where('order_status', 'completed');
        $this->db->group_by('month');
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get()->result_array();
    }
}
