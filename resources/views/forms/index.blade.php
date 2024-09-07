@include('layout.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms List</title>
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .navbar-dark {
            background-color: #242424;
        }

        .navbar-brand,
        .nav-link {
            color: #fff;
            margin-right: 20px;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin-top: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-bottom: 15px;
        }

        .table-container {
            background-color: #1e1e1e;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .table {
            margin-top: 10px;
        }

        table.dataTable tbody tr {
            background-color: #1f1f1f;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #2a2a2a;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        .table thead {
            background-color: #343a40;
        }

        .table thead th {
            color: #ffffff;
            padding: 12px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #fff;
            background-color: #444;
        }

        .dataTables_wrapper .dataTables_filter input {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
            padding: 6px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_length select {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
            padding: 6px;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <!-- Main Content -->
    <div class="container">
        <h1>Forms Management</h1>

        <!-- Create New Form Button -->
        <a href="{{ route('forms.create') }}" class="btn btn-primary">Create New Form</a>

        <!-- Table Container -->
        <div class="table-container">
            <table id="formsTable" class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody> <!-- AJAX will load this dynamically -->
            </table>
        </div>
    </div>

    <!-- Bootstrap JS, jQuery, and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#formsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('forms.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                "pageLength": 10,
                "pagingType": "full_numbers"
            });

            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: '/forms/' + id,
                        type: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}' // Pass the CSRF token
                        },
                        success: function(result) {
                            // Reload the table data (Ensure 'table' is your DataTable instance)
                            table.ajax.reload();
                            alert('Form deleted successfully!');
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the record.');
                        }
                    });
                }
            });

        });
    </script>

</body>

</html>
