<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Oxbridge Educational Services</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/oes-logo.png'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --bs-primary: #0056b3;
            /* Logo Blue */
            --bs-danger: #ed1c24;
            /* Logo Red */
            --bs-warning: #c5a059;
            /* Logo Gold */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfcfc;
        }

        /* Modern Underline Menu */
        .nav-link {
            font-weight: 600;
            color: #555 !important;
            position: relative;
            padding: 0.5rem 1rem;
        }

        .nav-link.active {
            color: var(--bs-primary) !important;
        }

        .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 1rem;
            right: 1rem;
            height: 3px;
            background: var(--bs-primary);
            border-radius: 5px;
        }

        .navbar-brand img {
            height: 50px;
        }

        .btn-primary {
            --bs-btn-bg: var(--bs-primary);
            border: none;
            font-weight: 600;
        }

        .btn-outline-primary {
            --bs-btn-color: var(--bs-primary);
            --bs-btn-border-color: var(--bs-primary);
        }
    </style>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url(); ?>">
                <img src="<?= base_url('assets/images/oes-logo.png'); ?>" alt="Oxbridge Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto gap-4">
                    <?php $seg = $this->uri->segment(2); ?>
                    <li class="nav-item"><a class="nav-link <?= (!$seg) ? 'active' : ''; ?>" href="<?= base_url(); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($seg == 'products') ? 'active' : ''; ?>" href="<?= base_url('main/products'); ?>">Products</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($seg == 'about') ? 'active' : ''; ?>" href="<?= base_url('main/about'); ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($seg == 'contact') ? 'active' : ''; ?>" href="<?= base_url('main/contact'); ?>">Contact</a></li>
                </ul>

                <div class="d-lg-flex d-none">
                    <a href="<?= base_url('admin/login'); ?>" class="btn btn-outline-primary rounded-pill px-3 me-2 border-0 shadow-sm">
                        <i class="bi bi-lock-fill"></i> Admin
                    </a>
                    <?php if (!$this->session->userdata('cus_logged')): ?>
                        <a href="#" class="btn btn-outline-primary rounded-pill px-4 border-0 fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-person me-1"></i> Sign In
                        </a>
                    <?php else: ?>
                        <a class="btn btn-outline-primary rounded-pill px-3 border-0 shadow-sm" href="<?= base_url('main/account'); ?>">
                            <i class="bi bi-person-circle me-1"></i> Hi, <?= explode(' ', $this->session->userdata('cus_name'))[0]; ?>
                        </a>
                    <?php endif; ?>

                    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-5 shadow-lg">
                                <div class="modal-body p-5">
                                    <div class="text-center mb-4">
                                        <h3 class="fw-bold text-primary">Quick Sign In</h3>
                                        <p class="text-muted small">Enter your phone number to access your account</p>
                                    </div>

                                    <form action="<?= base_url('auth/phone_login_process'); ?>" method="POST" data-parsley-validate>
                                        <div class="mb-4">
                                            <label class="form-label small fw-bold">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i class="bi bi-phone"></i></span>
                                                <input type="tel" name="phone" class="form-control bg-light border-0 px-3"
                                                    placeholder="03XXXXXXXXX" required
                                                    data-parsley-pattern="^(03)[0-9]{9}$"
                                                    data-parsley-error-message="Please enter a valid Pakistani phone number (03...)">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                                            Sign In to Dashboard <i class="bi bi-arrow-right ms-2"></i>
                                        </button>

                                        <div class="text-center mt-4">
                                            <p class="small text-muted mb-0">New here?</p>
                                            <a href="<?= base_url('main/products'); ?>" class="text-danger fw-bold text-decoration-none">Start Shopping to Register</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('main/checkout'); ?>" class="btn btn-light rounded-pill px-3 shadow-sm position-relative me-2">
                        <i class="bi bi-cart3"></i>
                        <?php if ($this->cart->total_items() > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $this->cart->total_items(); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>