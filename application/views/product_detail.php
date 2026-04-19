<style>
    .thumb-item {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent !important;
        opacity: 0.6;
    }

    .thumb-item:hover, .thumb-item.active-thumb {
        opacity: 1;
        border-color: #1f3f5f !important; /* Your Corporate Navy Blue */
    }

    /* Animation for smooth media switching */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    #mainMediaDisplay {
        background-color: #f8f9fa;
        overflow: hidden;
    }
</style>

<div class="container py-5 mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('main/products'); ?>" class="text-decoration-none text-muted">Books</a></li>
            <li class="breadcrumb-item active fw-bold text-primary"><?= $product['title'] ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3" 
                id="galleryContainer" 
                onmouseenter="stopGalleryLoop()" 
                onmouseleave="startGalleryLoop()">
                
                <div id="mainMediaDisplay" class="bg-light d-flex align-items-center justify-content-center" style="height: 500px;">
                    <?php if(!empty($gallery)): ?>
                        <?php if($gallery[0]['file_type'] == 'image'): ?>
                            <img src="<?= base_url($gallery[0]['file_path']) ?>" id="activeMedia" class="img-fluid fade-in" style="max-height: 100%; width: 100%; object-fit: contain;">
                        <?php else: ?>
                            <video controls autoplay muted playsinline class="w-100 h-100" id="activeVideo">
                                <source src="<?= base_url($gallery[0]['file_path']) ?>" type="video/mp4">
                            </video>
                        <?php endif; ?>
                    <?php else: ?>
                        <img src="<?= base_url('assets/images/default.jpg') ?>" class="img-fluid">
                    <?php endif; ?>
                </div>
            </div>

            <div class="row g-2" id="thumbnailRow">
                <?php foreach($gallery as $index => $m): ?>
                    <div class="col-3">
                        <div class="card border rounded-3 overflow-hidden cursor-pointer thumb-item <?= ($index == 0) ? 'active-thumb' : '' ?>" 
                            data-index="<?= $index ?>" 
                            onclick="changeMedia(<?= $index ?>)">
                            
                            <?php if($m['file_type'] == 'image'): ?>
                                <img src="<?= base_url($m['file_path']) ?>" class="img-fluid" style="height: 80px; width: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 80px;">
                                    <i class="bi bi-play-circle fs-3"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-lg-6">
            <span class="badge bg-danger rounded-pill px-3 mb-2">Verified Curriculum</span>
            <h1 class="display-5 fw-bold text-dark"><?= $product['title'] ?></h1>
            <p class="text-muted mb-4">Product Category: <span class="fw-bold text-primary"><?= ucfirst($product['product_type']) ?></span></p>

            <div class="d-flex align-items-center mb-4">
                <h2 class="text-primary fw-bold mb-0">Rs. <?= number_format($product['discounted_price']) ?></h2>
                <span class="text-muted text-decoration-line-through ms-3">Rs. <?= number_format($product['original_price']) ?></span>
                <span class="badge bg-success-subtle text-success border border-success ms-3">Save <?= round((($product['original_price'] - $product['discounted_price']) / $product['original_price']) * 100) ?>%</span>
            </div>

            <div class="mb-5">
                <h6 class="fw-bold text-uppercase small text-muted">Description</h6>
                <div class="text-dark">
                    <?= $product['long_desc'] ?>
                </div>
            </div>

            <div class="card border-0 bg-light rounded-4 p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 small fw-bold">Stock Status:</p>
                        <span class="<?= ($product['stock_count'] > 0) ? 'text-success' : 'text-danger' ?> fw-bold">
                            <i class="bi bi-circle-fill me-1 small"></i> <?= ($product['stock_count'] > 0) ? 'In Stock (' . $product['stock_count'] . ' units)' : 'Out of Stock' ?>
                        </span>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="col-md-12 mt-3 mt-md-0">
                            <?php if (!$this->session->userdata('cus_logged')): ?>
                                <a href="<?= base_url('main/login'); ?>" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                                    <i class="bi bi-cart-plus-fill me-2"></i> Add to Cart
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('cart/add/' . $product['id']); ?>" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                                    <i class="bi bi-cart-plus-fill me-2"></i> Add to Cart
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-5 border-top">
        <div class="row">
            <div class="col-lg-7">
                <h4 class="fw-bold mb-4">Customer Reviews</h4>
                <?php if(!empty($reviews)): ?>
                    <?php foreach($reviews as $rv): ?>
                        <div class="card border-0 bg-light rounded-4 p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold mb-0"><?= $rv['full_name'] ?></h6>
                                <div class="text-warning small">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <i class="bi bi-star<?= ($i <= $rv['rating']) ? '-fill' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="small text-muted mb-0"><?= $rv['comment'] ?></p>
                            <small class="text-muted mt-2" style="font-size: 0.7rem;">Posted on <?= date('d M, Y', strtotime($rv['created_at'])) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted italic">No reviews yet. Be the first to review this book!</p>
                <?php endif; ?>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-3">Leave a Review</h5>
                    
                    <?php if($this->session->userdata('cus_logged')): ?>
                        <form action="<?= base_url('review/submit'); ?>" method="POST" data-parsley-validate>
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Your Rating</label>
                                <div class="star-rating d-flex gap-2">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>" class="btn-check" required>
                                        <label class="btn btn-outline-warning btn-sm rounded-pill px-3" for="star<?= $i ?>"><?= $i ?> <i class="bi bi-star"></i></label>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold">Your Thoughts</label>
                                <textarea name="comment" class="form-control border-0 bg-light rounded-3" rows="4" required placeholder="What did you like or dislike about this book?"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                                Submit Review
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-lock-fill fs-1 text-muted mb-3 d-block"></i>
                            <p class="small text-muted">You must be logged in to write a review.</p>
                            <a href="<?= base_url('main/login'); ?>" class="btn btn-outline-primary btn-sm rounded-pill px-4">Login Now</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// function changeMedia(src, type) {
//     const display = document.getElementById('mainMediaDisplay');
//     if (type === 'image') {
//         display.innerHTML = `<img src="${src}" class="img-fluid" style="max-height: 100%;">`;
//     } else {
//         display.innerHTML = `<video controls class="w-100 h-100"><source src="${src}" type="video/mp4"></video>`;
//     }
// }

// 1. Convert PHP Gallery to JS Array
const galleryData = <?= json_encode($gallery); ?>;
const baseUrl = "<?= base_url(); ?>";
let currentIndex = 0;
let galleryInterval;

// 2. Change Media Function
function changeMedia(index) {
    currentIndex = index;
    const media = galleryData[currentIndex];
    const display = document.getElementById('mainMediaDisplay');
    
    // Update Thumbnails UI
    document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active-thumb'));
    document.querySelector(`[data-index="${index}"]`).classList.add('active-thumb');

    // Update Main Display Content
    if (media.file_type === 'image') {
        display.innerHTML = `<img src="${baseUrl + media.file_path}" id="activeMedia" class="img-fluid fade-in" style="max-height: 100%; width: 100%; object-fit: contain;">`;
    } else {
        // Autoplay enabled with controls. 
        // Note: Browsers usually require 'muted' to autoplay video automatically.
        display.innerHTML = `
            <video controls autoplay muted playsinline class="w-100 h-100 fade-in" id="activeVideo">
                <source src="${baseUrl + media.file_path}" type="video/mp4">
            </video>`;
    }
}

// 3. Loop Logic
function startGalleryLoop() {
    if (galleryData.length <= 1) return; // Don't loop if only 1 item exists
    
    galleryInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % galleryData.length;
        changeMedia(currentIndex);
    }, 4000); // 2 Second Interval
}

function stopGalleryLoop() {
    clearInterval(galleryInterval);
}

// 4. Initialize
document.addEventListener('DOMContentLoaded', () => {
    startGalleryLoop();
});

function promptLogin() {
    Swal.fire({
        title: 'Sign In Required',
        text: "Please login to purchase items from the Oxbridge store.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#0056b3',
        confirmButtonText: 'Login Now',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('main/login'); ?>";
        }
    });
}
</script>

<style>
    .thumb-item { cursor: pointer; transition: 0.3s; opacity: 0.7; }
    .thumb-item:hover { opacity: 1; border-color: var(--bs-primary) !important; }
    .cursor-pointer { cursor: pointer; }
</style>