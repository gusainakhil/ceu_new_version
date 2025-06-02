<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h1>Data Table</h1>
    <table id="dataTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Country</th>
                <th>Address</th>
                <th>Pin Code</th>
                <th>Course ID</th>
                <th>Job Profile</th>
                <th>State</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be dynamically populated here -->
        </tbody>
    </table>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        // Fetch the data using AJAX (Assuming `fetch_data.php` serves your database data in JSON format)
        $(document).ready(function () {
            $('#dataTable').DataTable({
                ajax: {
                    url: 'fetch_data.php', // PHP file to fetch data
                    dataSrc: '' // Data is expected to be an array
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'number' },
                    { data: 'country' },
                    { data: 'address' },
                    { data: 'pin_code' },
                    { data: 'course_id' },
                    { data: 'job_profile' },
                    { data: 'state' },
                    { data: 'created_at' }
                ]
            });
        });
    </script>
</body>
</html>
