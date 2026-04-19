<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Join OES Store</h2>
                        <p class="text-muted small">Quick and easy registration for students & parents</p>
                    </div>

                    <form action="<?= base_url('auth/register_process'); ?>" method="POST" data-parsley-validate>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Full Name</label>
                                <input type="text" name="full_name" class="form-control rounded-pill px-4 bg-light border-0" required placeholder="John Doe">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill px-4 bg-light border-0" required placeholder="john@example.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="tel" name="phone" class="form-control rounded-pill px-4 bg-light border-0" required placeholder="03XXXXXXXXX">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control rounded-pill px-4 bg-light border-0" required minlength="6" placeholder="••••••••">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Confirm Password</label>
                                <input type="password" class="form-control rounded-pill px-4 bg-light border-0" required data-parsley-equalto="#password" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="form-check my-4">
                            <input class="form-check-input" type="checkbox" required id="terms">
                            <label class="form-check-label small" for="terms">
                                I agree to the <a href="#" class="text-primary fw-bold text-decoration-none">Terms & Conditions</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                            Create Account <i class="bi bi-person-plus-fill ms-2"></i>
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Already a member?</p>
                        <a href="<?= base_url('main/login'); ?>" class="text-danger fw-bold text-decoration-none">Sign In to Your Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>