<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Member Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: #18181b;
      color: #fff;
      font-family: 'Segoe UI', 'Montserrat', 'Poppins', sans-serif;
      margin: 0;
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

    .card, .membership-card, .stats-card, .tips-card {
      background: #232326;
      color: #fff;
      border-radius: 16px;
      border: none;
      box-shadow: 0 4px 16px rgba(239, 68, 68, 0.08);
      margin-bottom: 24px;
    }

    .stats-card {
      border-left: 6px solid #ef4444;
    }

    .membership-card {
      border-left: 6px solid #ef4444;
      background: linear-gradient(135deg, #751111 0%, #232326 100%);
    }

    .booking-item {
      border-left: 4px solid #ef4444;
      background: #232326;
      color: #fff;
      margin-bottom: 10px;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.08);
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

    .badge.bg-success {
      background: #22c55e !important;
    }
    .badge.bg-light {
      background: #fff !important;
      color: #751111 !important;
    }

    .carousel-item img {
      height: 300px;
      object-fit: cover;
      border-radius: 15px;
      filter: brightness(0.85);
    }

    .carousel-caption {
      background: rgba(24, 24, 27, 0.7);
      border-radius: 10px;
      padding: 10px 20px;
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
      <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <a href="<?= site_url('/dashboard/member') ?>" class="active"><i class="fas fa-home"></i> Dashboard</a>
  <a href="<?= site_url('/shop') ?>"><i class="fas fa-shopping-cart"></i> Shop</a>
  <a href="<?= site_url('/buy-membership') ?>"><i class="fas fa-credit-card"></i> Buy Membership</a>
  <a href="<?= site_url('/classes') ?>"><i class="fas fa-calendar-alt"></i> Classes</a>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container">
    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Member Dashboard</h2>

    <!-- Stats Row -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card stats-card">
          <div class="card-body text-center">
            <i class="fas fa-calendar-check fa-2x mb-2"></i>
            <h4><?= count($bookings ?? []) ?></h4>
            <p class="mb-0">Upcoming Classes</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card stats-card">
          <div class="card-body text-center">
            <i class="fas fa-coins fa-2x mb-2"></i>
            <h4><?= session('balancePoint') ?? 0 ?></h4>
            <p class="mb-0">Points Balance</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card stats-card">
          <div class="card-body text-center">
            <i class="fas fa-dumbbell fa-2x mb-2"></i>
            <h4><?= $membership ? $membership['classLimit'] : 0 ?></h4>
            <p class="mb-0">Booking Classes Per Week</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card stats-card">
          <div class="card-body text-center">
            <i class="fas fa-percentage fa-2x mb-2"></i>
            <h4><?= $membership ? $membership['discountRate'] : 0 ?>%</h4>
            <p class="mb-0">Discount Rate</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Membership Info -->
    <div class="card mb-4 membership-card">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-credit-card"></i> Your Membership</h5>
        <?php if (isset($membership)): ?>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Plan:</strong> <?= esc($membership['planName']) ?></p>
              <p><strong>Tier:</strong> <span class="badge bg-light text-dark"><?= esc($membership['tier']) ?></span></p>
              <p><strong>Discount:</strong> <?= esc($membership['discountRate']) ?>%</p>
            </div>
            <div class="col-md-6">
              <p><strong>Class Limit:</strong> <?= esc($membership['classLimit']) ?> per week</p>
              <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
            </div>
          </div>
        <?php else: ?>
          <p class="mb-0"><i class="fas fa-exclamation-triangle"></i> No active membership. 
            <a href="<?= site_url('/buy-membership') ?>" class="btn btn-light btn-sm ms-2">Buy now</a>
          </p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Image Slider with Tips -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-lightbulb"></i> Fitness Tips & Advice</h5>
        <div id="dashboardCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="<?= base_url('assets/images/fit.jpg') ?>" class="d-block w-100" alt="Fitness Tip 1">
              <div class="carousel-caption d-none d-md-block">
                <h5>Stay Hydrated</h5>
                <p>Drink at least 8 glasses of water daily for optimal performance</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url('assets/images/lol.jpg') ?>" class="d-block w-100" alt="Fitness Tip 2">
              <div class="carousel-caption d-none d-md-block">
                <h5>Consistent Training</h5>
                <p>Regular exercise is key to achieving your fitness goals</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url('assets/images/merchh.jpg') ?>" class="d-block w-100" alt="Fitness Tip 3">
              <div class="carousel-caption d-none d-md-block">
                <h5>Proper Nutrition</h5>
                <p>Fuel your body with the right nutrients for better results</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
    </div>

    <!-- Booking Schedule -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-calendar-alt"></i> Your Upcoming Classes</h5>
        <?php if (isset($bookings) && count($bookings) > 0): ?>
          <div class="row">
            <?php foreach ($bookings as $booking): ?>
              <div class="col-md-6 mb-3">
                <div class="booking-item">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="mb-1"><i class="fas fa-dumbbell"></i> <?= esc($booking['class_name']) ?></h6>
                      <p class="mb-1"><i class="fas fa-user"></i> Trainer: <?= esc($booking['trainer_name']) ?></p>
                      <p class="mb-0"><i class="fas fa-clock"></i> <?= date('d M Y, h:i A', strtotime($booking['schedule_date'] . ' ' . $booking['start_time'])) ?></p>
                    </div>
                    <span class="badge bg-success">Confirmed</span>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="text-center py-4">
            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
            <p class="text-muted">You have no upcoming classes.</p>
            <a href="<?= site_url('/classes') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Book a Class</a>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
