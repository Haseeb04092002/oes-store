<div class="container py-5 mt-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-5 p-5">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                </div>
                <h2 class="fw-bold text-dark">Order Placed Successfully!</h2>
                <p class="text-muted mb-4">
                    Thank you for choosing Oxbridge. Your order <span class="fw-bold text-primary">#OES-<?= $order_id ?></span> 
                    has been received and is currently being processed.
                </p>
                
                <div class="bg-light p-3 rounded-4 mb-4">
                    <p class="small mb-0">You can track your order status in your account dashboard under "My Purchases".</p>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="<?= base_url('main/account/orders'); ?>" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                        View My Orders
                    </a>
                    <a href="<?= base_url('main/products'); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>