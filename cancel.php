<?php
// cancel.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Cancelled</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #dc3545;
            color: #fff;
            font-size: 1.5rem;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            font-size: 1.2rem;
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card">
            <div class="card-header">
                Payment Cancelled
            </div>
            <div class="card-body">
                <p class="card-text">You have cancelled the PayPal payment.</p>
                <p>No amount was charged. You may try again at any time.</p>
                <a href="index.php" class="btn btn-danger btn-back">← Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html> 
