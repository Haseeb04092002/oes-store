<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    // Register a new customer
    public function register_user($data)
    {
        return $this->db->insert('customers', $data);
    }

    // Fetch user by email (For login and profile checks)
    public function get_user_by_email($email)
    {
        return $this->db->get_where('customers', ['email' => $email])->row_array();
    }

    // Update customer profile
    public function update_customer($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('customers', $data);
    }

    public function get_user_by_phone($phone)
    {
        return $this->db->get_where('customers', ['phone' => $phone])->row_array();
    }
}
