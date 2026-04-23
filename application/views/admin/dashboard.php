<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 stat-card shadow-sm border-0">
            <small class="text-muted fw-bold">TOTAL SALES</small>
            <h3 class="fw-bold mb-0 text-primary">Rs. <?= number_format($stats['total_sales']) ?></h3>
            <span class="text-success small">Completed Orders</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 stat-card shadow-sm border-0">
            <small class="text-muted fw-bold">TOTAL PRODUCTS</small>
            <h3 class="fw-bold mb-0"><?= $stats['total_products'] ?></h3>
            <span class="text-primary small">Active in Catalog</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 stat-card shadow-sm border-0">
            <small class="text-muted fw-bold text-danger">PENDING REVIEWS</small>
            <h3 class="fw-bold mb-0 text-danger"><?= $stats['pending_reviews'] ?></h3>
            <span class="text-danger small">Requires Approval</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 stat-card shadow-sm border-0">
            <small class="text-muted fw-bold">TOTAL CUSTOMERS</small>
            <h3 class="fw-bold mb-0"><?= number_format($stats['total_customers']) ?></h3>
            <span class="text-muted small">Registered Accounts</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-12">
        <div class="card p-4 border-0 shadow-sm">
            <h6 class="fw-bold mb-4">Sales Performance (<?= date('Y') ?>)</h6>
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>
</div>

<script>
    
</script>