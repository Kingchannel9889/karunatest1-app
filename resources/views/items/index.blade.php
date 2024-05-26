<!DOCTYPE html>
<html>
<head>
    <title>Laravel DataTable</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .custom-button {
        border-radius: 15px;
        padding: 10px 20px;
    }

    table {
        width: 100%;
        margin: auto;
    }

    table tr {
        text-align: center;
    }

    table th, table td {
        border: 1px solid black;
        padding: 8px;
    }

    table thead th {
        background-color: #f2f2f2;
    }

    table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .container {
        margin-top: 20px;
    }
</style>
<body>
    <div class="container">
        <h2 class="text-center">List of Items</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('items.create') }}" class="btn btn-success custom-button">Create New Item</a>
        </div>
        <table class="table" id="items-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price (RM)</th>
                    <th>Details</th>
                    <th>Publish</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#items-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('items.getData') }}',
                columns: [
                    { data: 'running_number', name: 'running_number' },
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'details', name: 'details' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
</body>
</html>
