<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php
include "connect.php";
include "functions.php";

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$from = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime('-30 days'));
$to = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d');

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $from)) {
    $from = date('Y-m-d', strtotime('-30 days'));
}
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $to)) {
    $to = date('Y-m-d');
}

$fromDateTime = $from . ' 00:00:00';
$toDateTime = $to . ' 23:59:59';
$completedOnly = (isset($_GET['completed_only']) && $_GET['completed_only'] == '1') ? 1 : 0;

$stmt = $con->prepare("SELECT order_id, name, amount, payment_status, trans_date, txn_type FROM order_details WHERE trans_date BETWEEN ? AND ? ORDER BY trans_date DESC");
$stmt->bind_param("ss", $fromDateTime, $toDateTime);
$stmt->execute();
$result = $stmt->get_result();

$summary = [];
$orderRows = [];
$totalOrders = 0;
$totalPaidOrders = 0;
$totalRevenue = 0.0;

while ($row = $result->fetch_assoc()) {
    $campaignData = [];
    $txnType = trim((string)$row['txn_type']);
    if ($txnType !== '') {
        $decoded = json_decode($txnType, true);
        if (is_array($decoded)) {
            $campaignData = $decoded;
        }
    }

    $source = !empty($campaignData['utm_source']) ? $campaignData['utm_source'] : (!empty($campaignData['source']) ? $campaignData['source'] : 'Direct / Unknown');
    $medium = !empty($campaignData['utm_medium']) ? $campaignData['utm_medium'] : (!empty($campaignData['medium']) ? $campaignData['medium'] : 'Unknown');
    $campaign = !empty($campaignData['utm_campaign']) ? $campaignData['utm_campaign'] : (!empty($campaignData['campaign']) ? $campaignData['campaign'] : 'Not Set');

    $status = strtolower(trim((string)$row['payment_status']));
    $isPaid = ($status === 'completed');

    if ($completedOnly === 1 && !$isPaid) {
        continue;
    }

    $totalOrders++;

    $key = $source . '||' . $medium . '||' . $campaign;
    if (!isset($summary[$key])) {
        $summary[$key] = [
            'source' => $source,
            'medium' => $medium,
            'campaign' => $campaign,
            'orders' => 0,
            'paid_orders' => 0,
            'revenue' => 0.0
        ];
    }

    $summary[$key]['orders']++;
    if ($isPaid) {
        $amount = (float)$row['amount'];
        $summary[$key]['paid_orders']++;
        $summary[$key]['revenue'] += $amount;
        $totalPaidOrders++;
        $totalRevenue += $amount;
    }

    $orderRows[] = [
        'order_id' => $row['order_id'],
        'name' => $row['name'],
        'status' => $row['payment_status'],
        'amount' => (float)$row['amount'],
        'source' => $source,
        'medium' => $medium,
        'campaign' => $campaign,
        'date' => $row['trans_date']
    ];
}
$stmt->close();

usort($orderRows, function ($a, $b) {
    return strtotime($b['date']) <=> strtotime($a['date']);
});

$summaryRows = array_values($summary);
usort($summaryRows, function ($a, $b) {
    return $b['revenue'] <=> $a['revenue'];
});

$losingCampaigns = $summaryRows;
usort($losingCampaigns, function ($a, $b) {
    $conversionA = $a['orders'] > 0 ? ($a['paid_orders'] / $a['orders']) : 0;
    $conversionB = $b['orders'] > 0 ? ($b['paid_orders'] / $b['orders']) : 0;

    if ($conversionA === $conversionB) {
        if ($a['orders'] === $b['orders']) {
            return $a['revenue'] <=> $b['revenue'];
        }
        return $b['orders'] <=> $a['orders'];
    }

    return $conversionA <=> $conversionB;
});

$topLosingCampaigns = array_slice(array_filter($losingCampaigns, function ($item) {
    return $item['orders'] > 0;
}), 0, 5);

if (isset($_GET['export']) && $_GET['export'] == '1') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=campaign-report-' . $from . '-to-' . $to . '.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['From', $from, 'To', $to, 'Completed Only', $completedOnly ? 'Yes' : 'No']);
    fputcsv($output, []);
    fputcsv($output, ['Source', 'Medium', 'Campaign', 'Orders', 'Paid Orders', 'Conversion %', 'Revenue']);

    foreach ($summaryRows as $item) {
        $conversion = $item['orders'] > 0 ? round(($item['paid_orders'] / $item['orders']) * 100, 2) : 0;
        fputcsv($output, [
            $item['source'],
            $item['medium'],
            $item['campaign'],
            $item['orders'],
            $item['paid_orders'],
            $conversion,
            number_format($item['revenue'], 2, '.', '')
        ]);
    }

    fclose($output);
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Campaign Report</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">
        <?php include 'sidebar.php'; ?>

        <div class="main px-lg-4 px-md-4">
            <?php include 'header.php'; ?>

            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-12">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Campaign Attribution Report</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" class="row g-3 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label">From Date</label>
                                            <input type="date" class="form-control" name="from" value="<?php echo htmlspecialchars($from); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">To Date</label>
                                            <input type="date" class="form-control" name="to" value="<?php echo htmlspecialchars($to); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label d-block">&nbsp;</label>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" value="1" id="completed_only" name="completed_only" <?php echo $completedOnly ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="completed_only">Only Completed Orders</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                                            <a href="campaign-report?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>&completed_only=<?php echo $completedOnly; ?>&export=1" class="btn btn-success">Export CSV</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
                        <div class="col">
                            <div class="alert-info alert mb-0">
                                <span><strong>Total Orders</strong></span>
                                <div class="h2 mb-0"><strong><?php echo $totalOrders; ?></strong></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-success alert mb-0">
                                <span><strong>Paid Orders</strong></span>
                                <div class="h2 mb-0"><strong><?php echo $totalPaidOrders; ?></strong></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <span><strong>Paid Revenue</strong></span>
                                <div class="h2 mb-0"><strong>$<?php echo number_format($totalRevenue, 2); ?></strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Top 5 Losing Campaigns</h5>
                                    <table id="losingCampaignTable" class="table table-hover align-middle mb-0" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Source</th>
                                                <th>Medium</th>
                                                <th>Campaign</th>
                                                <th>Orders</th>
                                                <th>Paid Orders</th>
                                                <th>Conversion %</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($topLosingCampaigns as $item) {
                                                $conversion = $item['orders'] > 0 ? round(($item['paid_orders'] / $item['orders']) * 100, 2) : 0;
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['source']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['medium']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['campaign']); ?></td>
                                                    <td><?php echo (int)$item['orders']; ?></td>
                                                    <td><?php echo (int)$item['paid_orders']; ?></td>
                                                    <td><?php echo number_format($conversion, 2); ?>%</td>
                                                    <td>$<?php echo number_format($item['revenue'], 2); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">UTM Summary</h5>
                                    <table id="campaignSummaryTable" class="table table-hover align-middle mb-0" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Source</th>
                                                <th>Medium</th>
                                                <th>Campaign</th>
                                                <th>Orders</th>
                                                <th>Paid Orders</th>
                                                <th>Conversion %</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($summaryRows as $item) {
                                                $conversion = $item['orders'] > 0 ? round(($item['paid_orders'] / $item['orders']) * 100, 2) : 0;
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['source']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['medium']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['campaign']); ?></td>
                                                    <td><?php echo (int)$item['orders']; ?></td>
                                                    <td><?php echo (int)$item['paid_orders']; ?></td>
                                                    <td><?php echo number_format($conversion, 2); ?>%</td>
                                                    <td>$<?php echo number_format($item['revenue'], 2); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Order-Level Attribution</h5>
                                    <table id="campaignOrderTable" class="table table-hover align-middle mb-0" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Source</th>
                                                <th>Medium</th>
                                                <th>Campaign</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orderRows as $order) { ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                                                    <td>$<?php echo number_format($order['amount'], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($order['source']); ?></td>
                                                    <td><?php echo htmlspecialchars($order['medium']); ?></td>
                                                    <td><?php echo htmlspecialchars($order['campaign']); ?></td>
                                                    <td><?php echo htmlspecialchars($order['date']); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/js/template.js"></script>
    <script>
        $('#losingCampaignTable').addClass('nowrap').dataTable({
            responsive: true,
            paging: false,
            searching: false,
            info: false,
            ordering: false
        });

        $('#campaignSummaryTable').addClass('nowrap').dataTable({
            responsive: true,
            pageLength: 25
        });

        $('#campaignOrderTable').addClass('nowrap').dataTable({
            responsive: true,
            pageLength: 50,
            order: [[7, 'desc']]
        });
    </script>
</body>

</html>
