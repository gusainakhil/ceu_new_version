<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders with Billing Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="cont mt-5">
        <h1 class="text-center mb-4">Orders with Billing Details</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>User ID</th>
                       
                        <th>Order ID</th>
                        <th>Order Date</th>
                       
                        <th>Total Amount</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Billing Name</th>
                        <th>Billing Phone</th>
                        <th>Billing Email</th>
                        <th>Billing Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // API URL
                    $api_url = "https://ceutrainers.com/api/order_details.php";

                    // Fetch data from API
                    $response = file_get_contents($api_url);
                    $orders = json_decode($response, true);
                    $a=0;
                    // Check if data is available
                    if (!empty($orders) && is_array($orders)) {
                      
                        foreach ($orders as $order) {
                              $a++;
                            echo "<tr>
                                <td>$a</td>
                                
                                <td>{$order['order_id']}</td>
                                <td>{$order['order_date']}</td>
                              
                                <td>{$order['total_amount']}</td>
                                <td>{$order['product_name']}</td>
                                <td>{$order['product_quantity']}</td>
                                <td>{$order['billing_name']}</td>
                                <td>{$order['billing_phone']}</td>
                                <td>{$order['billing_email']}</td>
                                <td>{$order['billing_address']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr>
                            <td colspan='15' class='text-center'>No data available</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
