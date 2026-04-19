<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Welcome Back</h2>
                        <p class="text-muted small">Access your account to manage orders</p>
                    </div>

                    <form action="<?= base_url('auth/login_process'); ?>" method="POST" data-parsley-validate>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0 px-3" required placeholder="email@example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0 px-3" required placeholder="••••••••">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label small" for="remember">Remember Me</label>
                            </div>
                            <a href="#" class="small text-decoration-none text-primary fw-bold">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                            Sign In <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>

                    <div class="text-center mt-5">
                        <p class="small text-muted mb-0">Don't have an account yet?</p>
                        <a href="<?= base_url('main/register'); ?>" class="text-danger fw-bold text-decoration-none">Create a Free Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>