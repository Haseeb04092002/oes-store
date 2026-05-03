<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load helpers/libraries needed for all pages
        $this->load->helper('url');
    }

    public function login() {
        if($this->session->userdata('cus_logged')) redirect('main/index');
        $data['title'] = "Sign In | OES";
        $this->render('customer/login', $data);
    }

    public function register() {
        if($this->session->userdata('cus_logged')) redirect('main/index');
        $data['title'] = "Create Account | OES";
        $this->render('customer/register', $data);
    }
    

    // Common function to render views with Header and Footer
    private function render($view_name, $data = [])
    {
        $this->load->view('layout/header', $data);
        $this->load->view($view_name, $data);
        $this->load->view('layout/footer', $data);
    }

    public function checkout()
    {
        // Removed login check to allow guest checkout

        // 5. If logged in, check if the cart is empty
        // (Assuming you are using the native CodeIgniter Cart Library)
        if (empty($this->cart->contents())) {
            $this->session->set_flashdata('error', 'Your cart is empty. Add some books first!');
            redirect('main/products');
        }

        // 6. Prepare data for the checkout view
        $data['title'] = "Secure Checkout | OES";
        $data['cart_items'] = $this->cart->contents();
        $data['total_amount'] = $this->cart->total();

        // 7. Render the view
        $this->render('customer/checkout', $data);
    }

    public function index()
    {
        $data['title'] = "Home";
        $data['meta_desc'] = "Welcome to Oxbridge Educational Services. Your hub for premium education books, courses for kids, artificial intelligence training, and IT solutions.";
        $data['meta_keys'] = "education books services IT solutions e commerce, courses for kids, artificial intelligence, Oxbridge Educational Services, Chakwal";
        $data['products'] = $this->Product_model->get_active_products(8);
        // echo "<br>";
        // echo "<pre>";
        // // print_r($data);
        // print_r($this->db->last_query());
        // die();
        $this->render('home', $data);
    }

    public function products()
    {
        $data['title'] = "Shop Books";
        $data['meta_desc'] = "Browse our comprehensive catalog of education books, learning materials, and courses designed to empower students and kids with modern IT solutions.";
        $data['meta_keys'] = "education books services IT solutions e commerce, courses for kids, artificial intelligence, buy books online, learning materials";
        $data['products'] = $this->Product_model->get_active_products();
        // Fetch wishlist IDs only if logged in
        if($this->session->userdata('cus_logged')) {
            $wishlist = $this->db->select('product_id')
                                ->get_where('wishlist', ['customer_id' => $this->session->userdata('cus_id')])
                                ->result_array();
            // Convert to a simple array: [1, 5, 12]
            $data['wishlist_ids'] = array_column($wishlist, 'product_id');
        }
        $this->render('products', $data);
    }

    public function about()
    {
        $data['title'] = "About Us";
        $data['meta_desc'] = "Learn about Oxbridge Educational Services, our mission, and our dedicated Skills Academy focusing on vocational training, digital literacy, and professional workshops.";
        $data['meta_keys'] = "about Oxbridge Educational Services, education books services IT solutions e commerce, courses for kids, artificial intelligence, Chakwal academy";
        $this->render('about', $data);
    }

    public function contact()
    {
        $data['title'] = "Contact Us";
        $data['meta_desc'] = "Get in touch with Oxbridge Educational Services in Chakwal. Contact us for inquiries regarding our education books, IT solutions, and courses.";
        $data['meta_keys'] = "contact Oxbridge Educational Services, education books services IT solutions e commerce, courses for kids, artificial intelligence, Chakwal location";
        $this->render('contact', $data);
    }

    public function product_detail($id) {
        // 1. Fetch Product Data
        $data['product'] = $this->Product_model->get_product($id);
        
        // 2. Fetch all media (images & videos)
        $data['gallery'] = $this->Product_model->get_media($id);

        $this->load->model('Review_model');
        $data['reviews'] = $this->Review_model->get_product_reviews($id);
        $data['avg_rating'] = $this->Review_model->get_avg_rating($id);

        $data['is_wishlisted'] = false;
        if($this->session->userdata('cus_logged')) {
            $this->load->model('Wishlist_model');
            $data['is_wishlisted'] = $this->Wishlist_model->is_in_wishlist($this->session->userdata('cus_id'), $id);
        }

        if (!$data['product']) {
            show_404();
        }

        $data['title'] = $data['product']['title'] . " | Details";
        
        // Dynamic SEO based on product
        $desc = strip_tags($data['product']['short_desc'] ?: $data['product']['long_desc']);
        $data['meta_desc'] = (strlen($desc) > 160) ? substr($desc, 0, 157) . '...' : $desc;
        $data['meta_keys'] = $data['product']['title'] . ", education books services IT solutions e commerce, courses for kids, artificial intelligence";

        $this->render('product_detail', $data);
    }

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

        $this->render('customer/account_wrapper', $data);
    }
}
