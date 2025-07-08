<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #18181b;
            color: #fff;
            font-family: 'Segoe UI', 'Montserrat', 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .navbar {
            background: #18181b !important;
            border-bottom: 2px solid #751111;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.08);
        }

        .navbar-brand {
            color: #ef4444 !important;
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 2px;
        }

        .navbar .btn-outline-light {
            border-color: #ef4444;
            color: #ef4444;
            transition: background 0.2s, color 0.2s;
        }
        .navbar .btn-outline-light:hover {
            background: #ef4444;
            color: #fff;
        }

        .sidebar {
            background: #751111;
            color: #fff;
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 56px;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(239, 68, 68, 0.08);
        }

        .sidebar a {
            color: #fff;
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            border-left: 4px solid transparent;
            font-weight: 500;
            border-radius: 0.5rem;
            margin-bottom: 8px;
            transition: background 0.2s, border-left 0.2s, color 0.2s;
        }
        .sidebar a.active,
        .sidebar a:hover {
            background: #ef4444;
            border-left: 4px solid #fff;
            color: #fff;
            box-shadow: 0 2px 8px 0 rgba(239, 68, 68, 0.15);
        }

        .content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 30px 20px;
            background: #18181b;
            min-height: 100vh;
        }

        .table {
            background: #232326;
            color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.08);
        }

        .table-dark {
            background: linear-gradient(135deg, #751111 0%, #ef4444 100%) !important;
            color: #fff;
        }

        .table-dark th, .table thead th {
            color: #fff !important;
        }

        .table-dark th {
            border-color: #333;
            color: #fff;
        }

        .table tbody tr {
            background: #232326;
            color: #fff;
            transition: background 0.2s;
        }

        .table tbody tr:hover {
            background: #333;
        }

        .table tbody td {
            border-color: #333;
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: #2a2a2d;
        }

        .table-striped tbody tr:nth-of-type(odd):hover {
            background: #333;
        }

        .text-center {
            color: #999;
        }

        .btn-primary, .btn-danger, .btn-success, .btn-warning {
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 18px;
            transition: background 0.2s, color 0.2s;
        }

        .btn-primary {
            background: #ef4444;
            color: #fff;
        }
        .btn-primary:hover {
            background: #751111;
            color: #fff;
        }

        .btn-danger {
            background: #751111;
            color: #fff;
        }
        .btn-danger:hover {
            background: #ef4444;
            color: #fff;
        }

        .btn-success {
            background: #22c55e;
            color: #fff;
        }
        .btn-warning {
            background: #f59e42;
            color: #fff;
        }

        .alert-success {
            background: #22c55e;
            color: #fff;
            border: none;
        }
        .alert-danger {
            background: #ef4444;
            color: #fff;
            border: none;
        }

        .text-success {
            color: #22c55e !important;
        }
        .text-muted {
            color: #999 !important;
        }
        .text-primary {
            color: #ef4444 !important;
        }

        .table, .table-dark, .table tbody tr, .table tbody td, .table-dark th {
            color: #000;
        }
        .text-center, .text-muted {
            color: #000 !important;
        }

        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                box-shadow: none;
            }
            .content {
                margin-left: 0;
                margin-top: 100px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-dumbbell"></i> FITZONE</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3"><i class="fas fa-user"></i> Welcome, <?= session('name') ?? session('email') ?></span>
            <span class="text-info me-3"><i class="fas fa-coins"></i> <?= session('balancePoint') ?? 0 ?> pts</span>
            <a class="btn btn-outline-light btn-sm me-2 cart-btn" href="<?= site_url('/cart') ?>">
                <i class="fas fa-shopping-cart"></i> Cart
                <?php 
                $cart = session()->get('cart') ?? [];
                $cartCount = count($cart);
                if ($cartCount > 0): 
                ?>
                    <span class="badge bg-danger ms-1 cart-badge"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
            <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <a href="<?= site_url('/dashboard/member') ?>"><i class="fas fa-home"></i> Dashboard</a>
    <a href="<?= site_url('/shop') ?>"><i class="fas fa-shopping-cart"></i> Shop</a>
    <a href="<?= site_url('/order-history') ?>" class="active"><i class="fas fa-history"></i> Order History</a>
    <a href="<?= site_url('/buy-membership') ?>"><i class="fas fa-credit-card"></i> Buy Membership</a>
    <a href="<?= site_url('/classes') ?>"><i class="fas fa-calendar-alt"></i> Classes</a>
</div>

<!-- Main Content -->
<div class="content">
    <h2 class="mb-4"><i class="fas fa-history"></i> Order History</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Order Date</th>
                    <th>Merchandise Name(s)</th>
                    <th>Order Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr><td colspan="5" class="text-center">No orders found.</td></tr>
                <?php else: ?>
                    <?php foreach ($orders as $i => $order): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= date('Y-m-d H:i', strtotime($order['order_date'])) ?></td>
                            <td>
                                <?php if (!empty($order['items'])): ?>
                                    <?= implode(', ', array_map(fn($item) => $item['merchandise_name'], $order['items'])) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= ucfirst($order['order_type']) ?></td>
                            <td><?= ucfirst($order['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html> 