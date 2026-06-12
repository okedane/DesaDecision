<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>



<x-style></x-style>


<body>
    <div id="app">
        <x-sidebar></x-sidebar>
        <div id="main">
            <x-header></x-header>

            {{ $slot }}

            

            <x-footer></x-footer>
        </div>

    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="{{ asset('assets/js/notify.js') }}"></script>
    <x-toast></x-toast>


   

    {{-- // Data Tables --}}

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const datatableTables = document.querySelectorAll('table[data-datatable="true"]');

            datatableTables.forEach(function(table) {
                const headerCells = table.querySelectorAll('thead tr th');
                if (!headerCells.length) return;

                const columns = [];

                if (table.dataset.noSortLast === 'true') {
                    columns.push({
                        select: headerCells.length - 1,
                        sortable: false
                    });
                }

                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    columns: columns
                });
            });
        });
    </script>



<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>


</body>



</html>
