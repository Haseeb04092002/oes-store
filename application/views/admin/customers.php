<div class="card shadow-sm border-0">
    <div class="card-body">
        <table id="customersTable" class="table table-hover align-middle" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th>Customer Name</th>
                    <th>Email & Phone</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Member Since</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="fw-bold text-dark">Bilal Mansoor</span></td>
                    <td>
                        <div>bilal@gmail.com</div>
                        <small class="text-muted">+92 321 4567890</small>
                    </td>
                    <td><span class="badge bg-light text-dark">04</span></td>
                    <td class="fw-bold">Rs. 18,500</td>
                    <td>Mar 12, 2026</td>
                    <td><span class="badge bg-success-subtle text-success border border-success px-3">Active</span></td>
                    <td>
                        <button class="btn btn-sm btn-light border"><i class="bi bi-eye"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#customersTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf', 'print']
        });
    });
</script>