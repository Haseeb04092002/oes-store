<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 1. Force strict session check for all methods except login/auth
        $current_method = $this->router->fetch_method();
        $protected_methods = ['index', 'products', 'add_product', 'reviews', 'customers', 'settings'];

        if (in_array($current_method, $protected_methods)) {
            if (!$this->session->userdata('admin_logged_in')) {
                // If session expired or not set, redirect to login
                $this->session->set_flashdata('error', 'Session expired. Please login again.');
                redirect('admin/login');
            }
        }
    }

    // Force logout when entering the login page from the website
    public function login()
    {
        // This ensures a clean slate every time they click "Admin" from the header
        $this->session->unset_userdata('admin_logged_in');

        $data['title'] = "Admin Secure Login";
        $this->load->view('admin/login', $data);
    }

    public function auth()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        // Static credentials (Replace with DB query later)
        if ($user === 'admin' && $pass === 'admin123') {
            $this->session->set_userdata('admin_logged_in', TRUE);
            $this->session->set_userdata('last_activity', time());
            redirect('admin');
        } else {
            $this->session->set_flashdata('error', 'Authentication Failed.');
            redirect('admin/login');
        }
    }

    // Manual Logout Method
    public function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        $this->session->sess_destroy(); // Completely kill the session
        redirect('admin/login');
    }

    private function render($view, $data = [])
    {
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/' . $view, $data);
        $this->load->view('admin/layout/footer', $data);
    }

    // public function index()
    // {
    //     $data['title'] = "Dashboard Analytics";
    //     $this->render('dashboard', $data);
    // }

    public function index() {
        // Standard Admin Auth Check
        // if (!$this->session->userdata('admin_logged')) redirect('admin/login');

        $this->load->model('Admin_model');
        
        $data['stats'] = $this->Admin_model->get_dashboard_stats();
        $data['chart_data'] = $this->Admin_model->get_sales_chart_data();
        
        $data['title'] = "Admin Dashboard";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer');
    }

    // public function products()
    // {
    //     $data['title'] = "Manage Products";
    //     $this->render('products/index', $data);
    // }

    public function add_product()
    {
        $data['title'] = "Add New Product";
        $this->render('products/add', $data);
    }

    public function reviews()
    {
        $data['title'] = "Customer Reviews";
        $this->render('reviews', $data);
    }

    public function customers()
    {
        $data['title'] = "Customer Management";
        $this->render('customers', $data);
    }

    public function settings()
    {
        $data['title'] = "Payment & System Settings";
        $this->render('settings', $data);
    }

    // public function save_product()
    // {
    //     // 1. Configure Image Upload
    //     $config['upload_path']   = './assets/uploads/products/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
    //     $config['encrypt_name']  = TRUE; // For security
    //     $this->load->library('upload', $config);

    //     $image_name = '';
    //     if ($this->upload->do_upload('product_image')) {
    //         $upload_data = $this->upload->data();
    //         $image_name = $upload_data['file_name'];
    //     }

    //     // 2. Prepare Data Array
    //     $data = [
    //         'title'             => $this->input->post('title'),
    //         'slug'              => url_title($this->input->post('title'), 'dash', TRUE),
    //         'product_type'      => $this->input->post('product_type'),
    //         'long_desc'         => $this->input->post('description'), // From Summernote
    //         'original_price'    => $this->input->post('original_price'),
    //         'discounted_price'  => $this->input->post('discounted_price'),
    //         'stock_count'       => $this->input->post('stock'),
    //         'is_active'         => $this->input->post('status') ? 1 : 0,
    //         'main_image'        => $image_name
    //     ];

    //     // 3. Save to DB
    //     if ($this->Admin_model->insert_product($data)) {
    //         $this->session->set_flashdata('success', 'Product added successfully!');
    //     } else {
    //         $this->session->set_flashdata('error', 'Failed to add product.');
    //     }
    //     redirect('admin/products');
    // }

    // List all products
    public function products()
    {
        $data['title'] = "Manage Products";
        $data['products'] = $this->Product_model->get_all_products();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/products/index', $data);
        $this->load->view('admin/layout/footer');
    }

    // Add Product Logic
    public function store_product()
    {
        $product_data = [
            'title'            => $this->input->post('title'),
            'product_type'     => $this->input->post('product_type'),
            'long_desc'        => $this->input->post('description'),
            'original_price'   => $this->input->post('original_price'),
            'discounted_price' => $this->input->post('discounted_price'),
            'stock_count'      => $this->input->post('stock'),
            'is_active'        => $this->input->post('is_active') ? 1 : 0
        ];

        $product_id = $this->Product_model->insert_product($product_data);

        if ($product_id) {
            $this->handle_multi_upload($product_id);
            $this->session->set_flashdata('success', 'Product Created Successfully');
        }
        redirect('admin/products');
    }

    private function handle_multi_upload($product_id)
    {
        $files = $_FILES;
        $count = count($_FILES['media_files']['name']);
        $media_entries = [];

        // 1. Define the relative path for the DB and the absolute path for the Server
        $relativeImagePath = "uploads/Products/$product_id/"; 
        $uploadDir = FCPATH . $relativeImagePath;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $config['upload_path']   = $uploadDir;
        $config['allowed_types'] = 'jpg|jpeg|png|webp|mp4|mkv';
        $config['encrypt_name']  = TRUE;
        $config['max_size']      = 999999;

        $this->load->library('upload');

        for ($i = 0; $i < $count; $i++) {
            $_FILES['media_files']['name']     = $files['media_files']['name'][$i];
            $_FILES['media_files']['type']     = $files['media_files']['type'][$i];
            $_FILES['media_files']['tmp_name'] = $files['media_files']['tmp_name'][$i];
            $_FILES['media_files']['error']    = $files['media_files']['error'][$i];
            $_FILES['media_files']['size']     = $files['media_files']['size'][$i];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('media_files')) {
                $uploadData = $this->upload->data();
                $ext = pathinfo($uploadData['file_name'], PATHINFO_EXTENSION);

                // 2. SAVE THE FULL RELATIVE PATH
                // This ensures the DB has: "uploads/Products/1/filename.jpg"
                $media_entries[] = [
                    'product_id' => $product_id,
                    'file_path'  => $relativeImagePath . $uploadData['file_name'], 
                    'file_type'  => (in_array($ext, ['mp4', 'mkv'])) ? 'video' : 'image'
                ];
            }
        }

        if (!empty($media_entries)) {
            // 3. Ensure your Product_model uses insert_batch
            $this->Product_model->insert_media($media_entries);
        }
    }

    // Load the edit form with existing data
    public function edit_product($id)
    {
        $data['title'] = "Edit Product";
        $data['product'] = $this->Product_model->get_product($id);
        $data['media'] = $this->Product_model->get_media($id);

        if (!$data['product']) {
            show_404();
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/products/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    // Handle the update request
    public function update_product($id)
    {
        $data = [
            'title'            => $this->input->post('title'),
            'product_type'     => $this->input->post('product_type'),
            'long_desc'        => $this->input->post('description'),
            'original_price'   => $this->input->post('original_price'),
            'discounted_price' => $this->input->post('discounted_price'),
            'stock_count'      => $this->input->post('stock'),
            'is_active'        => $this->input->post('status') ? 1 : 0
        ];

        if ($this->Product_model->update_product($id, $data)) {
            // Process any new additional media uploaded during edit
            if (!empty($_FILES['media_files']['name'][0])) {
                $this->handle_multi_upload($id);
            }
            $this->session->set_flashdata('success', 'Product updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update product.');
        }
        redirect('admin/products');
    }

    // AJAX function to delete a single media item
    public function delete_media()
    {
        $media_id = $this->input->post('media_id');
        $media = $this->db->get_where('product_media', ['id' => $media_id])->row_array();

        if ($media) {
            $file_path = './assets/uploads/products/' . $media['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->Product_model->delete_single_media($media_id);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function delete_product($id)
    {
        $media = $this->Product_model->get_media($id);
        foreach ($media as $file) {
            unlink('./assets/uploads/products/' . $file['file_path']);
        }
        $this->Product_model->delete_product($id);
        $this->session->set_flashdata('success', 'Product Deleted');
        redirect('admin/products');
    }
}
