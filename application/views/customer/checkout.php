<div class="container py-5 mt-5">
    <div class="row g-5">
        
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Shipping Information</h4>
                
                <form action="<?= base_url('order/place'); ?>" method="POST" id="checkoutForm" data-parsley-validate>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" class="form-control bg-light border-0 px-3 py-2 rounded-3" 
                                   value="<?= $this->session->userdata('cus_name'); ?>" readonly>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-bold text-primary">Contact Number (For Delivery)</label>
                            <input type="tel" name="shipping_phone" class="form-control border-0 bg-light px-3 py-2 rounded-3" 
                                   required placeholder="e.g. 03001234567">
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold text-primary">Complete Shipping Address</label>
                            <textarea name="address" class="form-control border-0 bg-light px-3 py-2 rounded-3" 
                                      rows="3" required placeholder="House #, Street, Area, City..."></textarea>
                        </div>

                        <div class="col-12 mt-4">
                            <h5 class="fw-bold mb-3">Select Payment Method</h5>
                            
                            <div class="form-check border p-3 rounded-4 mb-3" style="cursor: pointer;">
                                <input class="form-check-input ms-0 me-2" type="radio" name="payment" id="cod" value="COD" checked>
                                <label class="form-check-label fw-bold d-block" for="cod">
                                    <i class="bi bi-truck me-2"></i> Cash on Delivery
                                    <small class="d-block text-muted fw-normal">Pay when you receive the books at your doorstep.</small>
                                </label>
                            </div>

                            <div class="form-check border p-3 rounded-4" style="cursor: pointer;">
                                <input class="form-check-input ms-0 me-2" type="radio" name="payment" id="bank" value="Bank">
                                <label class="form-check-label fw-bold d-block" for="bank">
                                    <i class="bi bi-bank me-2"></i> Bank Transfer / EasyPaisa / JazzCash
                                    <small class="d-block text-muted fw-normal">Transfer to our account and share the receipt.</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow rounded-4 bg-light p-4 sticky-top" style="top: 100px;">
                <h4 class="fw-bold mb-4">Order Summary</h4>
                
                <div class="cart-items-list mb-4" style="max-height: 300px; overflow-y: auto;">
                    <?php if($this->cart->contents()): ?>
                        <?php foreach($this->cart->contents() as $items): ?>
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?= base_url($items['options']['image']??''); ?>" class="rounded-3 me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 150px;"><?= $items['name']; ?></h6>
                                    <small class="text-muted">Qty: <?= $items['qty']; ?> x Rs. <?= number_format($items['price']); ?></small>
                                </div>
                                <div class="text-end">
                                    <button class="btn p-0 border-0 me-2" onclick="toggleWishlist(<?= $items['id'] ?>, this)">
                                        <i class="bi bi-heart text-muted small"></i>
                                    </button>
                                    <p class="mb-0 small fw-bold">Rs. <?= number_format($items['subtotal']); ?></p>
                                    <a href="<?= base_url('cart/remove/'.$items['rowid']); ?>" class="text-danger small text-decoration-none">Remove</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-muted">Your cart is currently empty.</p>
                    <?php endif; ?>
                </div>

                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal (<?= $this->cart->total_items(); ?> items)</span>
                    <span class="fw-bold">Rs. <?= number_format($this->cart->total()); ?></span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Shipping</span>
                    <span class="text-success fw-bold">FREE</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="fw-bold">Grand Total</h5>
                    <h5 class="fw-bold text-primary">Rs. <?= number_format($this->cart->total()); ?></h5>
                </div>
                
                <?php if($this->cart->total_items() > 0): ?>
                    <button type="submit" form="checkoutForm" class="btn btn-danger btn-lg w-100 rounded-pill shadow fw-bold py-3">
                        Place Order Now <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                <?php else: ?>
                    <a href="<?= base_url('main/products'); ?>" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                        Continue Shopping
                    </a>
                <?php endif; ?>
                
                <div class="text-center mt-3">
                    <small class="text-muted"><i class="bi bi-shield-lock-fill me-1"></i> Secure 256-bit SSL Checkout</small>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function() {
        function toggleWishlist(id, element) {
            // Check if user is logged in (frontend check for immediate feedback)
            <?php if(!$this->session->userdata('cus_logged')): ?>
                promptLogin(); // Triggers your SweetAlert login prompt
                return;
            <?php endif; ?>

            const icon = element.querySelector('i');

            $.ajax({
                url: "<?= base_url('wishlist/toggle/') ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(res) {
                    if(res.status === 'success') {
                        if(res.action === 'added') {
                            icon.classList.remove('bi-heart', 'text-muted');
                            icon.classList.add('bi-heart-fill', 'text-danger');
                            Toast.fire({ icon: 'success', title: 'Added to wishlist' });
                        } else {
                            icon.classList.remove('bi-heart-fill', 'text-danger');
                            icon.classList.add('bi-heart', 'text-muted');
                            Toast.fire({ icon: 'info', title: 'Removed from wishlist' });
                        }
                    } else {
                        window.location.href = "<?= base_url('main/login'); ?>";
                    }
                }
            });
        }
    });
</script>