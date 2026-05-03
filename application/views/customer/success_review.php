<div class="container py-5 mt-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="fw-bold text-dark mb-3">Order Received!</h2>
                    <p class="text-muted mb-4" style="font-size: 1.1rem;">
                        Thank you for your purchase. Your order and payment are received, and it's currently under review. 
                        You will get a confirmation message at your phone number shortly.
                    </p>
                    
                    <div class="bg-light p-3 rounded-4 mb-4 d-inline-block">
                        <span class="fw-bold text-primary">Order ID: #<?= $order_id ?></span>
                    </div>

                    <div>
                        <a href="<?= base_url('main/products'); ?>" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            Continue Shopping <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
