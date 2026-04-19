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
}
