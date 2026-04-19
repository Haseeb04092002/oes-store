<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #1f3f5f;
            --bs-primary: #0056b3;
        }

        body {
            background: #f4f7f6;
            font-size: 0.9rem;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            transition: 0.3s;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: 0.3s;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #c5a059;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 10px;
        }

        .stat-card {
            border-left: 5px solid var(--bs-primary);
        }
    </style>
</head>

<body>

    <div class="sidebar d-none d-lg-block">
        <div class="p-4 text-white">
            <h4 class="fw-bold mb-0">OES ADMIN</h4>
            <small class="opacity-50">Oxbridge Services</small>
        </div>
        <nav class="nav flex-column mt-3">
            <a href="<?= base_url('admin'); ?>" class="nav-link <?= ($this->uri->segment(2) == '') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/products'); ?>" class="nav-link <?= ($this->uri->segment(2) == 'products') ? 'active' : '' ?>">
                <i class="bi bi-book me-2"></i> All Products
            </a>
            <a href="<?= base_url('admin/add_product'); ?>" class="nav-link <?= ($this->uri->segment(2) == 'add_product') ? 'active' : '' ?>">
                <i class="bi bi-plus-circle me-2"></i> Add Product
            </a>
            <a href="<?= base_url('admin/reviews'); ?>" class="nav-link <?= ($this->uri->segment(2) == 'reviews') ? 'active' : '' ?>">
                <i class="bi bi-star me-2"></i> Reviews
            </a>
            <a href="<?= base_url('admin/customers'); ?>" class="nav-link <?= ($this->uri->segment(2) == 'customers') ? 'active' : '' ?>">
                <i class="bi bi-people me-2"></i> Customers
            </a>
            <a href="<?= base_url('admin/settings'); ?>" class="nav-link <?= ($this->uri->segment(2) == 'settings') ? 'active' : '' ?>">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
            <a href="<?= base_url(); ?>" class="nav-link mt-5 text-warning">
                <i class="bi bi-box-arrow-left me-2"></i> View Website
            </a>
        </nav>
    </div>

    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h5 class="fw-bold m-0"><?= $title ?></h5>
            <div class="dropdown">
                <button class="btn btn-white border dropdown-toggle shadow-sm rounded-pill" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i> Admin User
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                    <li><a class="dropdown-item py-2" href="<?= base_url('admin/settings'); ?>"><i class="bi bi-gear me-2"></i> Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item py-2 text-danger fw-bold" href="<?= base_url('admin/logout'); ?>">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </header>