<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="fw-bold m-0"><i class="bi bi-credit-card me-2"></i>Payment Method Configuration</h6>
            </div>
            <div class="card-body p-4">
                <form id="paymentSettings">

                    <div class="d-flex justify-content-between align-items-center mb-4 p-3 border rounded-3 bg-light bg-opacity-50">
                        <div>
                            <h6 class="fw-bold mb-1">Cash on Delivery (COD)</h6>
                            <small class="text-muted">Allow customers to pay when books are delivered.</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" checked style="width: 45px; height: 22px;">
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-primary mb-0">Bank Transfer Details</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="row g-3 p-3 border rounded-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Bank Name</label>
                                <input type="text" class="form-control" value="Meezan Bank">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Account Title</label>
                                <input type="text" class="form-control" value="Oxbridge Educational Services">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">IBAN / Account Number</label>
                                <input type="text" class="form-control" value="PK00MEZN00112233445566">
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 border-success border-opacity-25">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="fw-bold text-success mb-0">EasyPaisa</h6>
                                    <div class="form-check form-switch"><input class="form-input" type="checkbox" checked></div>
                                </div>
                                <label class="form-label small fw-bold">Mobile Number</label>
                                <input type="text" class="form-control" value="03001234567">
                                <label class="form-label small fw-bold mt-2">Account Name</label>
                                <input type="text" class="form-control" value="OES Admin">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 border-danger border-opacity-25">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="fw-bold text-danger mb-0">JazzCash</h6>
                                    <div class="form-check form-switch"><input class="form-input" type="checkbox"></div>
                                </div>
                                <label class="form-label small fw-bold">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="03XXXXXXXXX">
                                <label class="form-label small fw-bold mt-2">Account Name</label>
                                <input type="text" class="form-control" placeholder="Account Name">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-primary px-5 rounded-pill shadow" onclick="saveSettings()">Save Configuration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm rounded-4 border-0 bg-navy text-white" style="background: #1f3f5f;">
            <div class="card-body p-4 text-center">
                <i class="bi bi-shield-lock display-4 text-warning"></i>
                <h5 class="fw-bold mt-3">Security Note</h5>
                <p class="small opacity-75">Ensure your payment credentials are updated and verified. Incorrect bank details may lead to order payment failures.</p>
                <button class="btn btn-warning btn-sm w-100 rounded-pill fw-bold">Update Admin Password</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveSettings() {
        Swal.fire({
            title: 'Success!',
            text: 'Payment settings have been updated successfully.',
            icon: 'success',
            confirmButtonColor: '#0056b3'
        });
    }
</script>