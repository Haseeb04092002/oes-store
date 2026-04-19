<div class="py-5 mb-5" style="background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container text-center">
        <h1 class="fw-bold text-dark display-5">Our <span class="text-primary">Collection</span></h1>
        <p class="text-muted">Explore our range of individual books and curriculum bundles.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-4">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $p): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                        <?php 
                            $is_wishlisted = false;
                            if($this->session->userdata('cus_logged')) {
                                // Assuming you have a list of wishlist product IDs in your controller or check per item
                                $is_wishlisted = in_array($p['id'], $wishlist_ids ?? []); 
                            }
                        ?>
                        <button class="btn btn-white btn-sm rounded-circle shadow-sm position-absolute top-0 end-0 m-2 z-3 wishlist-btn" 
                                onclick="toggleWishlist(<?= $p['id'] ?>, this)" 
                                style="width: 35px; height: 35px; border: none;">
                            <i class="bi <?= $is_wishlisted ? 'bi-heart-fill text-danger' : 'bi-heart' ?> fs-6"></i>
                        </button>
                        <div class="position-relative" style="height: 250px;">
                            <img src="<?= base_url(($p['file_path'] ? $p['file_path'] : 'default.jpg')); ?>" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body p-3">
                            <h6 class="fw-bold text-dark text-truncate mb-1"><?= $p['title'] ?></h6>
                            <p class="text-danger fw-bold mb-3">Rs. <?= number_format($p['discounted_price']) ?></p>

                            <a href="<?= base_url('main/product_detail/' . $p['id']); ?>" class="btn btn-outline-primary w-100 rounded-pill btn-sm fw-bold">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                    <div class="d-flex align-items-center justify-content-center" style="height: 250px;">
                        <p class="text-muted">No products available at the moment.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <script>
            function promptLogin() {
                Swal.fire({
                    title: 'Sign In Required',
                    text: "Please login or register to start shopping with Oxbridge.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#0056b3',
                    cancelButtonColor: '#ed1c24',
                    confirmButtonText: 'Login Now',
                    cancelButtonText: 'Register'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?= base_url('main/login'); ?>";
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "<?= base_url('main/register'); ?>";
                    }
                });
            }
        </script>

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

<style>
    .product-hover-card {
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        background: #ffffff;
    }

    .product-hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 86, 179, 0.1) !important;
        cursor: pointer;
    }

    .product-hover-card img {
        transition: transform 0.5s ease;
    }

    .product-hover-card:hover img {
        transform: scale(1.1);
    }

    .x-small {
        font-size: 0.8rem;
    }
</style>