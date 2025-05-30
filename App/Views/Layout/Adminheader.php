<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/../../../config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Không gán $section cố định ở đây, để file view (như product.php) tự gán
// Nếu không có $section được gán sau khi include view, sẽ mặc định là 'home'
if (!isset($section)) {
    // Xác định $section dựa trên URL nếu cần
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    switch ($url) {
        case 'admin/product':
            $section = 'products';
            break;
        case 'admin/create':
            $section = 'create';
            break;
        case 'admin/user':
            $section = 'users';
            break;
        case 'admin/orders':
            $section = 'orders';
            break;
        case 'admin/index':
        default:
            $section = 'home';
            break;
    }
}

// Các biến được truyền từ controller
$totalProducts = isset($totalProducts) ? $totalProducts : 0;
$totalUsers = isset($totalUsers) ? $totalUsers : 0;
$totalOrders = isset($totalOrders) ? $totalOrders : 0;
$totalRevenue = isset($totalRevenue) ? $totalRevenue : 0;
$earnings = isset($earnings) ? $earnings : array_fill(0, 12, ['month' => '', 'total' => 0]);
$orderStatusCounts = isset($orderStatusCounts) ? $orderStatusCounts : [];
$topProducts = isset($topProducts) ? $topProducts : [];
$productList = isset($productList) ? $productList : [];
$userList = isset($userList) ? $userList : [];
$orderList = isset($orderList) ? $orderList : [];
$order = isset($order) ? $order : [];
$totalPages = isset($totalPages) ? $totalPages : 1;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$recentOrderStats = isset($recentOrderStats) ? $recentOrderStats : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?= $base ?>assets/admin/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?= $base ?>assets/admin/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["<?= $base ?>assets/admin/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/plugins.min.css" />
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/demo.css" />
</head>