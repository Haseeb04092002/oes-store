<?php
class Product_model extends CI_Model
{

    public function get_all_products()
    {
        return $this->db->get('products')->result_array();
    }

    public function insert_product($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    public function insert_media($media_data)
    {
        return $this->db->insert_batch('product_media', $media_data);
    }

    public function get_product($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function get_media($id)
    {
        return $this->db->get_where('product_media', ['product_id' => $id])->result_array();
    }

    public function delete_product($id)
    {
        // Files should be deleted from server before calling this
        return $this->db->delete('products', ['id' => $id]);
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_single_media($media_id)
    {
        return $this->db->delete('product_media', ['id' => $media_id]);
    }

    // Fetch active products for the website
    public function get_active_products($limit = null)
    {
        $this->db->select('products.*, product_media.file_path');
        $this->db->from('products');
        // Join to get the first image available
        $this->db->join('product_media', 'product_media.product_id = products.id', 'left');
        $this->db->where('products.is_active', 1);
        $this->db->group_by('products.id');
        if ($limit) $this->db->limit($limit);
        return $this->db->get()->result_array();
    }
}
