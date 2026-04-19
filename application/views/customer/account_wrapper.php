<div class="container py-5 mt-5">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-primary p-4 text-center text-white">
                    <div class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-person-fill fs-2"></i>
                    </div>
                    <h6 class="fw-bold mb-0"><?= $this->session->userdata('cus_name'); ?></h6>
                    <small class="opacity-75">Customer Account</small>
                </div>
                <div class="list-group list-group-flush p-2">
                    <a href="<?= base_url('main/account/orders'); ?>" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($active_tab == 'orders') ? 'active bg-primary' : '' ?>">
                        <i class="bi bi-bag-check me-2"></i> My Purchases
                    </a>
                    <a href="<?= base_url('main/account/wishlist'); ?>" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($active_tab == 'wishlist') ? 'active bg-primary' : '' ?>">
                        <i class="bi bi-heart me-2"></i> Wishlist
                    </a>
                    <a href="<?= base_url('main/account/reviews'); ?>" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($active_tab == 'reviews') ? 'active bg-primary' : '' ?>">
                        <i class="bi bi-star me-2"></i> My Reviews
                    </a>
                    <a href="<?= base_url('main/account/settings'); ?>" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($active_tab == 'settings') ? 'active bg-primary' : '' ?>">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                    <hr>
                    <a href="<?= base_url('auth/logout'); ?>" class="list-group-item list-group-item-action border-0 rounded-3 text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 p-4 min-vh-50">
                <h4 class="fw-bold text-dark mb-4"><?= ucfirst($active_tab); ?></h4>
                
                <?php if($active_tab == 'orders'): ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="bg-light">
                                <tr><th>Order #</th><th>Date</th><th>Total</th><th>Status</th><th>Action</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $o): ?>
                                <tr>
                                    <td class="fw-bold">#OES-<?= $o['id'] ?></td>
                                    <td><?= date('d M, Y', strtotime($o['created_at'])) ?></td>
                                    <td class="text-primary fw-bold">Rs. <?= number_format($o['total_amount']) ?></td>
                                    <td><span class="badge rounded-pill bg-<?= ($o['order_status'] == 'completed') ? 'success' : 'warning' ?>"><?= $o['order_status'] ?></span></td>
                                    <td><button class="btn btn-sm btn-outline-primary rounded-pill">View Detail</button></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php elseif($active_tab == 'wishlist'): ?>
                    <div class="table-responsive">
                        <table class="table align-middle border-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Product</th>
                                    <th class="border-0 text-center">Price</th>
                                    <th class="border-0 text-center">Stock</th>
                                    <th class="border-0 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($wishlist)): foreach($wishlist as $w): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url($w['file_path']) ?>" class="rounded-3 me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <h6 class="mb-0 fw-bold small"><?= $w['title'] ?></h6>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold">Rs. <?= number_format($w['discounted_price']) ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill <?= ($w['stock_count'] > 0) ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' ?>">
                                            <?= ($w['stock_count'] > 0) ? 'In Stock' : 'Out of Stock' ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="<?= base_url('cart/buy_now/' . $w['id']); ?>" class="btn btn-sm btn-primary rounded-start-pill px-3">
                                                <i class="bi bi-cart-check"></i> Purchase
                                            </a>
                                            <a href="<?= base_url('wishlist/remove/' . $w['id']); ?>" class="btn btn-sm btn-outline-danger rounded-end-pill px-3">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="bi bi-heart text-muted fs-1 mb-3 d-block"></i>
                                        <p class="text-muted">Your wishlist is empty.</p>
                                        <a href="<?= base_url('main/products'); ?>" class="btn btn-primary rounded-pill btn-sm">Browse Books</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                <?php elseif($active_tab == 'settings'): ?>
                    <form action="<?= base_url('auth/update_profile'); ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="<?= $customer['full_name'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">Email Address</label>
                                <input type="email" class="form-control" value="<?= $customer['email'] ?>" readonly>
                            </div>
                            <div class="col-12 mt-4 text-end">
                                <button class="btn btn-primary rounded-pill px-5">Save Changes</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>