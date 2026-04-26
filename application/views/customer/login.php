<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-person-circle text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="fw-bold text-dark">Welcome Back</h2>
                        <p class="text-muted small">Sign in using your registered phone number</p>
                    </div>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger border-0 rounded-4 small py-2">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/phone_login_process'); ?>" method="POST" data-parsley-validate>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-phone"></i></span>
                                <input type="tel" name="phone" class="form-control bg-light border-0 px-3 py-2"
                                    placeholder="03XXXXXXXXX" required
                                    data-parsley-pattern="^(03)[0-9]{9}$"
                                    data-parsley-error-message="Enter a valid Pakistani number (03...)">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                            Sign In to Account <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>

                    <div class="text-center mt-5">
                        <p class="small text-muted mb-0">Don't have an account yet?</p>
                        <a href="<?= base_url('main/products'); ?>" class="text-danger fw-bold text-decoration-none">
                            Browse Books & Register
                        </a>
                    </div>

                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?= base_url('main/index'); ?>" class="text-muted small text-decoration-none">
                    <i class="bi bi-house-door me-1"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>