</div>

<?php if ($this->session->flashdata('success')): ?>
    Swal.fire('Success', '<?= $this->session->flashdata('success'); ?>', 'success');
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    Swal.fire('Error', '<?= $this->session->flashdata('error'); ?>', 'error');
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. DataTables with Exports
        $('#productsTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            pageLength: 10,
            responsive: true
        });

        // 2. Rich Text Editor
        $('#summernote').summernote({
            placeholder: 'Enter product details here...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        // // 3. Analytics Chart
        // const ctx = document.getElementById('salesChart');
        // if (ctx) {
        //     new Chart(ctx, {
        //         type: 'line',
        //         data: {
        //             labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        //             datasets: [{
        //                 label: 'Sales (PKR)',
        //                 data: [12000, 19000, 3000, 5000, 2000, 30000],
        //                 borderColor: '#0056b3',
        //                 tension: 0.4,
        //                 fill: true,
        //                 backgroundColor: 'rgba(0, 86, 179, 0.1)'
        //             }]
        //         }
        //     });
        // }

        // Prepare Data for JS
        const chartLabels = <?= json_encode(array_column($chart_data, 'month')) ?>;
        const chartValues = <?= json_encode(array_column($chart_data, 'total')) ?>;

        const ctx = document.getElementById('salesChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels.length ? chartLabels : ['No Data'],
                    datasets: [{
                        label: 'Monthly Sales (PKR)',
                        data: chartValues.length ? chartValues : [0],
                        borderColor: '#0056b3',
                        backgroundColor: 'rgba(0, 86, 179, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    });
</script>
</body>

</html>