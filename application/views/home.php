<style>
    .productSwiper .swiper-slide {
        height: auto; /* Allows cards to fill height */
    }
    
    .product-card {
        transition: transform 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }

    .swiper-pagination-bullet-active {
        background: #1f3f5f !important; /* Your Navy Blue Primary Color */
    }
</style>
<section class="hero-section text-white d-flex align-items-center" style="
    min-height: 80vh; 
    background: linear-gradient(rgba(0, 86, 179, 0.85), rgba(0, 86, 179, 0.85)), 
    url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80&w=2073'); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed;">

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold">Academic Session 2026 Open</span>
                <h1 class="display-2 fw-bold mb-3">Academic Excellence Starts with the <span class="text-warning">Right Books</span></h1>
                <p class="lead mb-5 opacity-90">Official provider of premium curriculum books and bundled sets. Get everything your child needs for the school year in one click.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?= base_url('main/products'); ?>" class="btn btn-danger btn-lg px-5 shadow-lg fw-bold rounded-pill">Shop Now</a>
                    <a href="#about" class="btn btn-outline-light btn-lg px-5 fw-bold rounded-pill">Our Mission</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container my-5 py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h6 class="text-danger fw-bold text-uppercase ls-1">Curated Collections</h6>
            <h2 class="fw-bold display-6">Featured Arrivals</h2>
        </div>
        <a href="<?= base_url('main/products'); ?>" class="btn btn-outline-primary rounded-pill px-4">View Catalog</a>
    </div>

    <div class="swiper productSwiper pb-5">
        <div class="swiper-wrapper">
            <?php if (isset($products) && count($products) > 0): ?>
                <?php foreach ($products as $p): ?>
                    <div class="swiper-slide">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                            <div class="position-relative" style="height: 250px;">
                                <img src="<?= base_url(($p['file_path'] ? $p['file_path'] : 'assets/images/default.jpg')); ?>" 
                                    class="w-100 h-100" 
                                    style="object-fit: cover;" 
                                    alt="<?= $p['title'] ?>">
                            </div>
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-dark text-truncate mb-1"><?= $p['title'] ?></h6>
                                <p class="text-danger fw-bold mb-3">Rs. <?= number_format($p['discounted_price']) ?></p>

                                <a href="<?= base_url('main/product_detail/' . $p['id']); ?>" 
                                class="btn btn-outline-primary w-100 rounded-pill btn-sm fw-bold">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="swiper-slide">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-5 text-center">
                        <p class="text-muted m-0">No products available at the moment.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="swiper-pagination mt-4"></div>
    </div>
</section>

<section id="about" class="py-5 bg-light">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=800" class="img-fluid rounded-5 shadow-lg" alt="Oxbridge Education">
                    <div class="position-absolute bottom-0 end-0 bg-warning p-4 rounded-4 shadow-lg m-n3 d-none d-md-block" style="width: 200px;">
                        <h3 class="fw-bold mb-0">15+</h3>
                        <p class="small fw-bold mb-0">Years of Service</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-danger fw-bold text-uppercase">Who We Are</h6>
                <h2 class="display-5 fw-bold mb-4">Dedicated to Educational <span class="text-primary">Resource Quality</span></h2>
                <p class="text-muted fs-5 mb-4">Oxbridge Educational Services is more than a bookstore. We are a specialized hub ensuring that every student has access to the exact curriculum materials required for their academic success.</p>

                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-patch-check-fill text-primary fs-4 me-3"></i>
                        <span class="fw-bold">Direct Partnership with Publishers</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-truck text-primary fs-4 me-3"></i>
                        <span class="fw-bold">Safe & Secure Nationwide Delivery</span>
                    </li>
                </ul>
                <a href="<?= base_url('main/about'); ?>" class="btn btn-outline-dark rounded-pill px-4 mt-3">Read Full Story</a>
            </div>
        </div>
    </div>
</section>