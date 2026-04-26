<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load Model, Library, and Helper
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    public function phone_login_process()
    {
        $phone = $this->input->post('phone');

        // 1. Check if user exists
        $user = $this->db->get_where('customers', ['phone' => $phone])->row_array();

        if ($user) {
            // 2. Set Session
            $session_data = [
                'cus_id'     => $user['id'],
                'cus_name'   => $user['full_name'],
                'cus_logged' => TRUE
            ];
            $this->session->set_userdata($session_data);

            $this->session->set_flashdata('success', 'Welcome back, ' . $user['full_name'] . '!');
            redirect('main/account');
        } else {
            // 3. Handle Non-existent User
            $this->session->set_flashdata('error', 'No account found with this number. Please place an order to register!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function phone_login()
    {
        $phone = $this->input->post('phone');
        $user = $this->db->get_where('customers', ['phone' => $phone])->row_array();

        if ($user) {
            $this->session->set_userdata([
                'cus_id'     => $user['id'],
                'cus_name'   => $user['full_name'],
                'cus_logged' => TRUE
            ]);
            redirect('main/account');
        } else {
            $this->session->set_flashdata('error', 'Account not found with this phone number.');
            redirect('main/login');
        }
    }

    /**
     * REGISTRATION PROCESS
     */
    public function register_process()
    {
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[customers.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('main/register');
        } else {
            $data = [
                'full_name' => $this->input->post('full_name'),
                'email'     => $this->input->post('email'),
                'phone'     => $this->input->post('phone'),
                'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];

            if ($this->Auth_model->register_user($data)) {
                $this->session->set_flashdata('success', 'Account created! Welcome to Oxbridge.');
                redirect('main/login');
            } else {
                $this->session->set_flashdata('error', 'Database error. Please try again.');
                redirect('main/register');
            }
        }
    }

    /**
     * LOGIN PROCESS
     */
    public function login_process()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please fill all fields correctly.');
            redirect('main/login');
        } else {
            $email = $this->input->post('email');
            $pass  = $this->input->post('password');

            // Use the Model instead of direct DB query
            $user = $this->Auth_model->get_user_by_email($email);

            if ($user && password_verify($pass, $user['password'])) {
                $session_data = [
                    'cus_id'     => $user['id'],
                    'cus_name'   => $user['full_name'],
                    'cus_logged' => TRUE
                ];
                $this->session->set_userdata($session_data);

                // Handle the "Redirect to Checkout" flag
                if ($this->session->userdata('redirect_to_checkout')) {
                    $this->session->unset_userdata('redirect_to_checkout');
                    redirect('main/checkout');
                }
                redirect('main/index');
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password.');
                redirect('main/login');
            }
        }
    }

    /**
     * ACCOUNT SETTINGS UPDATE
     */
    public function update_profile()
    {
        if (!$this->session->userdata('cus_logged')) redirect('main/login');

        $customer_id = $this->session->userdata('cus_id');

        $data = [
            'full_name' => $this->input->post('full_name'),
            'phone'     => $this->input->post('phone'),
            'address'   => $this->input->post('address')
        ];

        // If user wants to change password
        if ($this->input->post('new_password')) {
            $data['password'] = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
        }

        if ($this->Auth_model->update_customer($customer_id, $data)) {
            $this->session->set_userdata('cus_name', $data['full_name']); // Update session name
            $this->session->set_flashdata('success', 'Profile updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile.');
        }
        redirect('main/account/settings');
    }

    public function logout()
    {
        $this->session->unset_userdata(['cus_id', 'cus_name', 'cus_logged']);
        $this->session->set_flashdata('success', 'You have been logged out.');
        redirect('main/index');
    }
}
