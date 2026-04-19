<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold m-0 text-primary">Pending & Published Reviews</h6>
        </div>

        <table id="reviewsTable" class="table table-hover align-middle" style="width:100%">
            <thead class="bg-light text-muted">
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="fw-bold">Ahmed Khan</div>
                        <small class="text-muted">ahmed@example.com</small>
                    </td>
                    <td>Oxford Science Grade 5</td>
                    <td>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        </div>
                    </td>
                    <td class="small">The bundle was complete and delivered on time. Very satisfied.</td>
                    <td><span class="badge bg-success rounded-pill">Approved</span></td>
                    <td>15 Apr 2026</td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger border-0" onclick="confirmDelete()"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-bold">Sara Williams</div>
                        <small class="text-muted">sara.w@example.com</small>
                    </td>
                    <td>Maths Workbook Set</td>
                    <td>
                        <div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i></div>
                    </td>
                    <td class="small">Book cover was slightly bent during shipping.</td>
                    <td><span class="badge bg-warning text-dark rounded-pill">Pending</span></td>
                    <td>18 Apr 2026</td>
                    <td>
                        <button class="btn btn-sm btn-outline-success border-0"><i class="bi bi-check-circle"></i></button>
                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#reviewsTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf', 'print'],
            responsive: true
        });
    });

    function confirmDelete() {
        Swal.fire({
            title: 'Delete Review?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ed1c24',
            confirmButtonText: 'Yes, delete it!'
        });
    }
</script>