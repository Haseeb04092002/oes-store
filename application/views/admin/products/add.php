<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="<?= base_url('admin/store_product'); ?>" method="POST" enctype="multipart/form-data" data-parsley-validate>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Book Title</label>
                    <input type="text" name="title" class="form-control rounded-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Category</label>
                    <select name="product_type" class="form-select">
                        <option value="single">Single Book</option>
                        <option value="pack">Bundle Pack</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Upload Images & Videos</label>
                    <div class="border-dashed p-4 text-center rounded-4 bg-light">
                        <input type="file" name="media_files[]" class="form-control" multiple accept="image/*,video/mp4">
                        <small class="text-muted mt-2 d-block">You can select multiple images and MP4 videos at once.</small>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Full Description</label>
                    <textarea id="summernote" name="description"></textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Original Price</label>
                    <input type="number" name="original_price" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Discounted Price</label>
                    <input type="number" name="discounted_price" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold d-block">Display Status</label>
                    <div class="form-check form-switch mt-2">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="statusToggle" value="1" checked style="width: 40px; height: 20px; cursor: pointer;">
                        <label class="form-check-label ms-2 fw-semibold text-muted" for="statusToggle" id="statusLabel">Active</label>
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem;">Toggle to show/hide this product from the website.</small>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow">Publish Product</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $('#statusToggle').on('change', function() {
        if($(this).is(':checked')) {
            $('#statusLabel').text('Active').addClass('text-success').removeClass('text-muted');
        } else {
            $('#statusLabel').text('Inactive').addClass('text-muted').removeClass('text-success');
        }
    });
</script>