public function account($page = 'orders') {
    if (!$this->session->userdata('cus_logged')) redirect('main/login');

    $this->load->model('Customer_model');
    $customer_id = $this->session->userdata('cus_id');

    $data['title'] = "My Account | " . ucfirst($page);
    $data['active_tab'] = $page;
    $data['customer'] = $this->db->get_where('customers', ['id' => $customer_id])->row_array();

    // Fetch dynamic data based on tab
    if ($page == 'wishlist') $data['wishlist'] = $this->Customer_model->get_wishlist($customer_id);
    if ($page == 'orders')   $data['orders']   = $this->Customer_model->get_orders($customer_id);
    if ($page == 'reviews')  $data['reviews']  = $this->Customer_model->get_reviews($customer_id);

    $this->render('profile/account_wrapper', $data);
}