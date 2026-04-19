<section class="py-5 text-white position-relative" style="
    background: linear-gradient(rgba(0, 86, 179, 0.9), rgba(0, 86, 179, 0.9)), 
    url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=2070&auto=format&fit=crop'); 
    background-size: cover; 
    background-position: center;">

    <div class="container py-5 text-center">
        <h1 class="display-3 fw-bold mb-3">About Our <span class="text-warning">Legacy</span></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 my-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop" class="img-fluid rounded-5 shadow-lg" alt="OES Team">
                    <div class="position-absolute top-0 start-0 translate-middle-y mt-5 ms-n3 d-none d-md-block">
                        <div class="bg-danger text-white p-4 rounded-4 shadow">
                            <h4 class="fw-bold mb-0">15+</h4>
                            <p class="small mb-0">Years of Excellence</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-danger fw-bold text-uppercase ls-1 mb-3">Our Story</h6>
                <h2 class="display-5 fw-bold text-dark mb-4">Shaping the Future of <span class="text-primary">Learning</span></h2>
                <p class="text-muted fs-5">Oxbridge Educational Services (OES) was founded with a singular vision: to bridge the gap between quality curriculum and student accessibility. We understand that the right resources are the foundation of academic success.</p>
                <p class="text-muted">Over the last decade, we have evolved from a local book supplier into a comprehensive educational hub, serving thousands of students across the region with verified curriculum materials and skill development programs.</p>

                <div class="row g-4 mt-2">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary fs-3 me-2"></i>
                            <span class="fw-bold text-dark">Verified Sources</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary fs-3 me-2"></i>
                            <span class="fw-bold text-dark">Expert Curation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h6 class="text-danger fw-bold text-uppercase">OES Ecosystem</h6>
            <h2 class="fw-bold display-6">Our Flagship Projects</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="card h-100 border-0 shadow-sm rounded-5 overflow-hidden project-card">
                    <img src="https://images.unsplash.com/photo-1491841573634-28140fc7ced7?q=80&w=2070&auto=format&fit=crop" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Book Store">
                    <div class="card-body p-4 text-center">
                        <h4 class="fw-bold">OES Book Store</h4>
                        <p class="text-muted">Our specialized e-commerce platform providing individual books and curriculum-specific bundle packs for schools.</p>
                        <a href="<?= base_url('main/products'); ?>" class="btn btn-primary rounded-pill px-4">Visit Store</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card h-100 border-0 shadow-sm rounded-5 overflow-hidden project-card">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Skills Academy">
                    <div class="card-body p-4 text-center">
                        <h4 class="fw-bold">OES Skills Academy</h4>
                        <p class="text-muted">A dedicated wing focused on vocational training, digital literacy, and professional workshops for the youth.</p>
                        <button class="btn btn-outline-danger rounded-pill px-4">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 my-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="p-5 rounded-5 border-start border-primary border-5 bg-white shadow-sm h-100">
                    <div class="mb-4">
                        <i class="bi bi-eye-fill text-primary display-4"></i>
                    </div>
                    <h3 class="fw-bold">Our Vision</h3>
                    <p class="text-muted px-lg-4">To be the leading educational resource provider in the region, recognized for our commitment to quality, integrity, and the academic growth of every child we serve.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 rounded-5 border-start border-warning border-5 bg-white shadow-sm h-100">
                    <div class="mb-4">
                        <i class="bi bi-bullseye text-warning display-4"></i>
                    </div>
                    <h3 class="fw-bold">Our Mission</h3>
                    <p class="text-muted px-lg-4">To empower students by delivering authentic curriculum materials and specialized skill training that prepares them for the challenges of a globalized world.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white rounded-top-5 mt-5">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-4">Stay Connected With Us</h2>
        <p class="lead text-white-50 mb-5">Follow us on social media for the latest updates on new arrivals and academic workshops.</p>

        <div class="d-flex justify-content-center gap-4 mb-5">
            <a href="#" class="social-icon bg-primary text-white"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#" class="social-icon bg-danger text-white"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#" class="social-icon bg-info text-white"><i class="bi bi-twitter fs-4"></i></a>
            <a href="#" class="social-icon bg-success text-white"><i class="bi bi-whatsapp fs-4"></i></a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="bg-secondary bg-opacity-10 p-4 rounded-pill border border-secondary border-opacity-25">
                    <span class="me-3"><i class="bi bi-envelope-fill text-warning me-2"></i> info@oxbridge.edu</span>
                    <span><i class="bi bi-telephone-fill text-warning me-2"></i> +92 300 1234567</span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .ls-1 {
        letter-spacing: 1px;
    }

    .project-card {
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: scale(1.03);
    }

    .social-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        text-decoration: none;
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    .social-icon:hover {
        transform: translateY(-5px);
        filter: brightness(1.2);
    }
</style>