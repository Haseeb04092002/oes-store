<?php
class Review extends CI_Controller {

    public function submit() {
        if (!$this->session->userdata('cus_logged')) {
            $this->session->set_flashdata('error', 'Please login to leave a review.');
            redirect('main/login');
        }

        $this->load->model('Review_model');

        $data = [
            'product_id'  => $this->input->post('product_id'),
            'customer_id' => $this->session->userdata('cus_id'),
            'rating'      => $this->input->post('rating'),
            'comment'     => $this->input->post('comment'),
            'status'      => 'approved' // Set to 'pending' if you want to approve them manually
        ];

        if ($this->Review_model->insert_review($data)) {
            $this->session->set_flashdata('success', 'Thank you! Your review has been posted.');
        } else {
            $this->session->set_flashdata('error', 'Failed to post review.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id) {
        if (!$this->session->userdata('cus_logged')) {
            $this->session->set_flashdata('error', 'Please login first.');
            redirect('main/login');
        }

        $customer_id = $this->session->userdata('cus_id');
        
        // Verify ownership before deleting
        $review = $this->db->get_where('reviews', ['id' => $id, 'customer_id' => $customer_id])->row_array();
        
        if ($review) {
            $this->db->delete('reviews', ['id' => $id]);
            $this->session->set_flashdata('success', 'Review deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Review not found or permission denied.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}