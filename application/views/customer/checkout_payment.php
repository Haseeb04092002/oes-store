<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h4 class="fw-bold mb-4">Step 2: Payment Receipt</h4>

            <form action="<?= base_url('order/place_with_receipt'); ?>" method="POST" enctype="multipart/form-data">
                <div class="accordion border-0 shadow-sm rounded-4 overflow-hidden" id="paymentAccordion">

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#bankInfo">
                                <i class="bi bi-bank me-2"></i> Bank Transfer (HBL/UBL)
                            </button>
                        </h2>
                        <div id="bankInfo" class="accordion-collapse collapse show" data-bs-parent="#paymentAccordion">
                            <div class="accordion-body bg-light">
                                <p class="small mb-1">Account Title: <strong>Oxbridge Education</strong></p>
                                <p class="small mb-3">IBAN: <strong>PK00 HABL 0000 1234 5678 90</strong></p>
                                <input type="radio" name="payment_method" value="Bank" checked class="d-none">
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#epInfo">
                                <i class="bi bi-wallet2 me-2"></i> EasyPaisa / JazzCash
                            </button>
                        </h2>
                        <div id="epInfo" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                            <div class="accordion-body bg-light">
                                <p class="small">Send to: <strong>0300-1234567</strong></p>
                                <input type="radio" name="payment_method" value="EasyPaisa" class="d-none">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 border-0 shadow-sm rounded-4 p-4">
                    <label class="fw-bold mb-2 small">Upload Payment Screenshot</label>
                    <input type="file" name="receipt_image" class="form-control" required accept="image/*">
                    <div class="form-text mt-2 text-danger small">Order will be processed after receipt verification.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 mt-4 fw-bold shadow">
                    Confirm Order & Download Receipt
                </button>
            </form>
        </div>
    </div>
</div>