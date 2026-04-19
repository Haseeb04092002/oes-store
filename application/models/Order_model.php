<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function create_order($order_data, $items_data) {
        // Start Transaction
        $this->db->trans_start();

        // 1. Insert into Orders Table
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        // 2. Prepare Items with Order ID and Insert
        foreach ($items_data as &$item) {
            $item['order_id'] = $order_id;
        }
        $this->db->insert_batch('order_items', $items_data);

        // Complete Transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return $order_id;
        }
    }
}