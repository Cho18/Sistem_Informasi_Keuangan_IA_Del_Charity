<!-- Untung menghitung secara dinamis -->
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();

        // Menghitung total donasi saat halaman dimuat
        calculateTotal();

        // Memperbarui total donasi saat pencarian dilakukan
        table.on('draw', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var totalDonation = 0;

            table.column(1, { search: 'applied' }).data().each(function(value) {
                var donation = parseFloat(value.replace(/[^0-9,]/g, '').replace(',', '.'));
                if (!isNaN(donation)) {
                    totalDonation += donation;
                }
            });

            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            var formattedDonation = formatter.format(totalDonation);
            $('#total1').text(formattedDonation);
        }
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();

        // Menghitung total donasi saat halaman dimuat
        calculateTotal();

        // Memperbarui total donasi saat pencarian dilakukan
        table.on('draw', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var totalDonation = 0;

            table.column(2, { search: 'applied' }).data().each(function(value) {
                var donation = parseFloat(value.replace(/[^0-9,]/g, '').replace(',', '.'));
                if (!isNaN(donation)) {
                    totalDonation += donation;
                }
            });

            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            var formattedDonation = formatter.format(totalDonation);
            $('#total2').text(formattedDonation);
        }
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();

        // Menghitung total donasi saat halaman dimuat
        calculateTotal();

        // Memperbarui total donasi saat pencarian dilakukan
        table.on('draw', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var totalDonation = 0;

            table.column(3, { search: 'applied' }).data().each(function(value) {
                var donation = parseFloat(value.replace(/[^0-9,]/g, '').replace(',', '.'));
                if (!isNaN(donation)) {
                    totalDonation += donation;
                }
            });

            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            var formattedDonation = formatter.format(totalDonation);
            $('#total3').text(formattedDonation);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#exportBtnDn').click(function() {
            var searchTerm = $('#dataTable_filter input').val();

            var exportUrl = '/export_donator?search=' + searchTerm;

            var anchor = document.createElement('a');
            anchor.href = exportUrl;
            anchor.style.display = 'none';
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#exportBtnJP').click(function() {
            var searchTerm = $('#dataTable_filter input').val();

            var exportUrl = '/export_jp?search=' + searchTerm;

            var anchor = document.createElement('a');
            anchor.href = exportUrl;
            anchor.style.display = 'none';
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        });
    });
</script> 