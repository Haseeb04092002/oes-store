<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | OES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1f3f5f 0%, #0056b3 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center mb-4">
                    <h2 class="text-white fw-bold">OES ADMIN</h2>
                    <p class="text-white-50">Oxbridge Educational Services</p>
                </div>

                <div class="card login-card p-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4 text-center">Secure Portal Login</h5>

                        <form action="<?= base_url('admin/auth'); ?>" method="POST" data-parsley-validate>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                                    <input type="text" name="username" class="form-control bg-light border-0" required placeholder="Enter username">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-key"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-0" required placeholder="••••••••">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold shadow">
                                Login to Dashboard
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="<?= base_url(); ?>" class="text-white-50 text-decoration-none small">
                        <i class="bi bi-arrow-left"></i> Back to Website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= $this->session->flashdata('error'); ?>'
            });
        <?php endif; ?>
    </script>
</body>

</html>