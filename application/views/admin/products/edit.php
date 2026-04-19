<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="<?= base_url('admin/update_product/' . $product['id']); ?>" method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Book Title</label>
                    <input type="text" name="title" class="form-control rounded-3" value="<?= $product['title'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Category</label>
                    <select name="product_type" class="form-select">
                        <option value="single" <?= ($product['product_type'] == 'single') ? 'selected' : '' ?>>Single Book</option>
                        <option value="pack" <?= ($product['product_type'] == 'pack') ? 'selected' : '' ?>>Bundle Pack</option>
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <label class="form-label fw-bold">Current Media</label>
                    <div class="row g-2">
                        <?php foreach ($media as $m): ?>
                            <div class="col-md-2 position-relative media-item-container" id="media-<?= $m['id'] ?>">
                                <div class="card h-100 border shadow-sm overflow-hidden">
                                    <?php if ($m['file_type'] == 'image'): ?>
                                        <img src="<?= base_url('assets/uploads/products/' . $m['file_path']) ?>" class="img-fluid rounded" style="height: 120px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-dark d-flex align-items-center justify-content-center text-white" style="height: 120px;">
                                            <i class="bi bi-play-circle fs-1"></i>
                                        </div>
                                    <?php endif; ?>

                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle remove-media" data-id="<?= $m['id'] ?>" style="width: 25px; height: 25px; padding: 0; line-height: 1;">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label fw-bold">Add More Images/Videos</label>
                    <input type="file" name="media_files[]" class="form-control" multiple accept="image/*,video/mp4">
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Full Description</label>
                    <textarea id="summernote" name="description"><?= $product['long_desc'] ?></textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Original Price</label>
                    <input type="number" name="original_price" class="form-control" value="<?= $product['original_price'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Discounted Price</label>
                    <input type="number" name="discounted_price" class="form-control" value="<?= $product['discounted_price'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?= $product['stock_count'] ?>" required>
                </div>

                <div class="col-12 mt-4 d-flex justify-content-between">
                    <a href="<?= base_url('admin/products') ?>" class="btn btn-light rounded-pill px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).on('click', '.remove-media', function() {
        let mediaId = $(this).data('id');

        Swal.fire({
            title: 'Remove this file?',
            text: "This file will be deleted from the server.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("admin/delete_media") ?>',
                    type: 'POST',
                    data: {
                        media_id: mediaId
                    },
                    success: function(response) {
                        $('#media-' + mediaId).fadeOut(300, function() {
                            $(this).remove();
                        });
                        Swal.fire('Deleted!', 'File removed.', 'success');
                    }
                });
            }
        });
    });
</script>