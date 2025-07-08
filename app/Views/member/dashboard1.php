<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Member Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/user.css') ?>">
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">🏋️ Fitness Dashboard</a>
    <div class="d-flex">
      <span class="text-white me-3">Welcome, <?= session('email') ?></span>
      <span class="text-info me-3">Balance: <?= session('balancePoint') ?? 0 ?> pts</span>
      <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>">Logout</a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <a href="<?= site_url('/dashboard/member') ?>">🏠 Dashboard</a>
  <a href="<?= site_url('/shop') ?>">🛒 Shop</a>
  <a href="<?= site_url('/membership') ?>">💳 Membership</a>
  <a href="<?= site_url('/classes') ?>">📅 Classes</a>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container">
    <h3 class="mb-4">User Dashboard</h3>

    <!-- Membership Info -->
    <div class="card mb-4 border-info">
      <div class="card-body">
        <h5 class="card-title">💳 Your Membership</h5>
        <?php if (isset($membership)): ?>
          <p>Type: <strong><?= esc($membership->type) ?></strong></p>
          <p>Valid: <?= esc($membership->start_date) ?> to <?= esc($membership->end_date) ?></p>
        <?php else: ?>
          <p class="text-danger">No active membership. <a href="<?= site_url('/membership') ?>">Buy now</a>.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Image Slider -->
    <div id="dashboardCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= base_url('assets/images/fit.jpg') ?>" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('assets/images/lol.jpg') ?>" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('assets/images/merchh.jpg') ?>" class="d-block w-100" alt="Slide 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <!-- Booking Schedule -->
    <div class="card mb-4 border-secondary">
      <div class="card-body">
        <h5 class="card-title">📅 Your Class Bookings</h5>
        <?php if (isset($bookings) && count($bookings) > 0): ?>
          <ul class="list-group">
            <?php foreach ($bookings as $booking): ?>
              <li class="list-group-item">
                <strong><?= esc($booking->class_name) ?></strong> with <?= esc($booking->trainer) ?> on <?= date('d M Y, h:i A', strtotime($booking->schedule_date)) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-muted">You have no upcoming classes. <a href="<?= site_url('/classes') ?>">Book now</a>.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Feature Cards -->
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card border-primary shadow-sm">
          <div class="card-body">
            <h5 class="card-title">🛍️ Shop</h5>
            <p>Buy equipment, supplements and fitness products.</p>
            <a href="<?= site_url('/shop') ?>" class="btn btn-primary">Go to Shop</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-success shadow-sm">
          <div class="card-body">
            <h5 class="card-title">💳 Membership</h5>
            <p>View or purchase your membership plan.</p>
            <a href="<?= site_url('/membership') ?>" class="btn btn-success">Buy Membership</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-warning shadow-sm">
          <div class="card-body">
            <h5 class="card-title">🏋️ Classes</h5>
            <p>Select classes based on trainer and schedule.</p>
            <a href="<?= site_url('/classes') ?>" class="btn btn-warning">Choose Class</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
