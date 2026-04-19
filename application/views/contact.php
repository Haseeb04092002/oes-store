<section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(45deg, #0056b3 0%, #004494 100%);">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Get In <span class="text-warning">Touch</span></h1>
        <p class="lead opacity-75">Have questions about book bundles or your order? We're here to help.</p>
    </div>
</section>

<div class="container my-5 py-5">
    <div class="row g-5">

        <div class="col-lg-4">
            <h3 class="fw-bold text-dark mb-4">Contact Information</h3>

            <div class="d-flex mb-4">
                <div class="bg-light text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-geo-alt-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Our Location</h6>
                    <p class="text-muted mb-0">123 Education Plaza, Main Boulevard,<br>Lahore, Pakistan</p>
                </div>
            </div>

            <div class="d-flex mb-4">
                <div class="bg-light text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-telephone-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Phone Number</h6>
                    <p class="text-muted mb-0">+92 300 1234567<br>+92 423 5556677</p>
                </div>
            </div>

            <div class="d-flex mb-4">
                <div class="bg-light text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-envelope-paper-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Email Address</h6>
                    <p class="text-muted mb-0">info@oxbridge.edu.pk<br>support@oxbridge.edu.pk</p>
                </div>
            </div>

            <hr class="my-5">

            <h5 class="fw-bold mb-3">Follow Our Updates</h5>
            <div class="d-flex gap-3">
                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 45px; height: 45px;"><i class="bi bi-facebook"></i></a>
                <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 45px; height: 45px;"><i class="bi bi-instagram"></i></a>
                <a href="#" class="btn btn-outline-info rounded-circle" style="width: 45px; height: 45px;"><i class="bi bi-twitter"></i></a>
                <a href="#" class="btn btn-outline-success rounded-circle" style="width: 45px; height: 45px;"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <h3 class="fw-bold mb-4">Send us a Message</h3>

                    <form id="contactForm" data-parsley-validate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-4" id="name" placeholder="Full Name" required data-parsley-trigger="change">
                                    <label for="name">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control rounded-4" id="email" placeholder="Email Address" required data-parsley-type="email">
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-4" id="subject" placeholder="Subject" required>
                                    <label for="subject">Subject (e.g., Order Inquiry)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <textarea class="form-control rounded-4" id="message" placeholder="Your Message" style="height: 150px" required minlength="10"></textarea>
                                    <label for="message">How can we help you?</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold">
                                    Send Message <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid p-0 mt-5">
    <div class="card border-0 rounded-0 shadow-sm overflow-hidden" style="height: 450px;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108844.20452373756!2d74.24294472304958!3d31.513031024364426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc202c60d148b3d22!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1711200000000!5m2!1sen!2s"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            // Check Parsley Validation
            if ($(this).parsley().isValid()) {
                // Display SweetAlert Success
                Swal.fire({
                    title: 'Message Sent!',
                    text: 'Thank you for contacting Oxbridge. We will get back to you shortly.',
                    icon: 'success',
                    confirmButtonColor: '#0056b3',
                    confirmButtonText: 'Great!'
                });

                // Reset the form
                $(this).trigger("reset");
            }
        });
    });
</script>

<style>
    /* Styling Floating Labels to match your brand */
    .form-floating>.form-control:focus~label {
        color: var(--bs-primary);
    }

    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.1);
    }

    /* Parsley Error Styling */
    .parsley-errors-list {
        list-style-type: none;
        padding-left: 0;
        color: #ed1c24;
        font-size: 0.8rem;
        margin-top: 5px;
    }
</style>