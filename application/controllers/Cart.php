<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Ensure the cart library and models are loaded
        $this->load->library('cart');
        $this->load->model('Product_model');
    }

    // public function buy_now($id) {
    //     // 1. Security Check: Ensure the user didn't bypass login via URL
    //     if (!$this->session->userdata('cus_logged')) {
    //         $this->session->set_flashdata('error', 'Please sign in to complete your purchase.');
    //         redirect('main/login');
    //     }

    //     // 2. Fetch Product & Media (For the thumbnail in checkout)
    //     $product = $this->Product_model->get_product($id);
    //     $media = $this->Product_model->get_media($id);
        
    //     // Default image if gallery is empty
    //     $image = (!empty($media)) ? $media[0]['file_path'] : 'assets/images/default.jpg';

    //     if ($product) {
    //         // 3. Prepare the CI Cart Array
    //         // This is the core logic reused from your standard 'add' method
    //         $data = array(
    //             'id'      => $product['id'],
    //             'qty'     => 1,
    //             'price'   => $product['discounted_price'],
    //             'name'    => $product['title'],
    //             'options' => array(
    //                 'image' => $image,
    //                 'type'  => $product['product_type']
    //             )
    //         );

    //         // 4. Insert into the session-based Cart
    //         if($this->cart->insert($data)) {
    //             // 5. SUCCESS: Redirect straight to Checkout
    //             // We skip the 'added to cart' success message for a faster flow
    //             redirect('main/checkout');
    //         } else {
    //             $this->session->set_flashdata('error', 'Unable to process request. Please try again.');
    //             redirect($_SERVER['HTTP_REFERER']);
    //         }
    //     } else {
    //         // Handle cases where the ID might be invalid or deleted
    //         $this->session->set_flashdata('error', 'Book not found.');
    //         redirect('main/products');
    //     }
    // }

    // Remove specific item using Row ID
    public function remove($rowid) {
        $this->cart->remove($rowid);
        $this->session->set_flashdata('success', 'Item removed from cart.');
        redirect('main/checkout');
    }

    // Clear entire cart
    public function destroy() {
        $this->cart->destroy();
        redirect('main/index');
    }


    public function buy_now($id) {
        // Re-use your existing add logic but redirect to checkout instead
        $product = $this->Product_model->get_product($id);
        $media = $this->Product_model->get_media($id);
        $image = (!empty($media)) ? $media[0]['file_path'] : 'assets/images/default.jpg';

        if ($product) {
            $data = [
                'id'      => $product['id'],
                'qty'     => 1,
                'price'   => $product['discounted_price'],
                'name'    => $product['title'],
                'options' => ['image' => $image, 'type' => $product['product_type']]
            ];
            $this->cart->insert($data);
            redirect('main/checkout');
        }
        redirect('main/products');
    }
}