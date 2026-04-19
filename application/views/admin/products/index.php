<div class="card shadow-sm">
    <div class="card-body">
        <table id="productsTable" class="table table-hover align-middle" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><span class="fw-bold"><?= $p['id'] ?></span></td>
                        <td><span class="fw-bold"><?= $p['title'] ?></span></td>
                        <td><span class="badge bg-light text-dark border"><?= strtoupper($p['product_type']) ?></span></td>
                        <td><span class="text-danger fw-bold">Rs. <?= number_format($p['discounted_price']) ?></span></td>
                        <td><?= $p['stock_count'] ?></td>
                        <td><?= ($p['is_active']) ? '<span class="text-success small">● Active</span>' : '<span class="text-muted small">● Inactive</span>' ?></td>
                        <td>
                            <a href="<?= base_url('admin/edit_product/' . $p['id']); ?>" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                            <a href="<?= base_url('admin/delete_product/' . $p['id']); ?>" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Delete this product?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>