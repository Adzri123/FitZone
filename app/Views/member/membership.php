<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Membership Plans</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 56px;
      left: 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding-top: 20px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar a {
      color: #ffffff;
      padding: 15px 20px;
      display: block;
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
    }
    .sidebar a:hover {
      background-color: rgba(255,255,255,0.1);
      border-left-color: #ffffff;
      transform: translateX(5px);
    }
    .sidebar a.active {
      background-color: rgba(255,255,255,0.2);
      border-left-color: #ffffff;
    }
    .content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 20px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .membership-card {
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    .membership-card.basic {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }
    .membership-card.premium {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: white;
    }
    .membership-card.vip {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
    }
    .membership-card.current {
      border: 3px solid #28a745;
    }
    .price-tag {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 0;
    }
    .feature-list {
      list-style: none;
      padding: 0;
    }
    .feature-list li {
      padding: 8px 0;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .feature-list li:last-child {
      border-bottom: none;
    }
    .feature-list li i {
      margin-right: 10px;
      width: 20px;
    }
    .popular-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #ffc107;
      color: #000;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: bold;
    }
    .current-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: #28a745;
      color: white;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: bold;
    }
  </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-dumbbell"></i> Fitness Dashboard</a>
    <div class="d-flex align-items-center">
      <span class="text-white me-3"><i class="fas fa-user"></i> Welcome, <?= session('name') ?? session('email') ?></span>
      <span class="text-info me-3"><i class="fas fa-coins"></i> <?= session('balancePoint') ?? 0 ?> pts</span>
      <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <a href="<?= site_url('/dashboard/member') ?>"><i class="fas fa-home"></i> Dashboard</a>
  <a href="<?= site_url('/shop') ?>"><i class="fas fa-shopping-cart"></i> Shop</a>
  <a href="<?= site_url('/buy-membership') ?>" class="active"><i class="fas fa-credit-card"></i> Buy Membership</a>
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

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2><i class="fas fa-credit-card"></i> Membership Plans</h2>
      <a href="<?= site_url('/dashboard/member') ?>" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <!-- Current Membership Status -->
    <?php if (isset($currentMembership) && $currentMembership): ?>
      <div class="card mb-4 border-success">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-check-circle text-success"></i> Your Current Membership</h5>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Plan:</strong> <?= esc($currentMembership['planName']) ?></p>
              <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
              <p><strong>Purchase Date:</strong> <?= date('d M Y', strtotime($currentMembership['purchase_date'])) ?></p>
            </div>
            <div class="col-md-6">
              <p><strong>Payment Amount:</strong> RM<?= number_format($currentMembership['payment_amount'], 2) ?></p>
              <p><strong>Payment Status:</strong> <span class="badge bg-success">Paid</span></p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Membership Plans -->
    <div class="row g-4">
      <?php if (isset($memberships) && count($memberships) > 0): ?>
        <?php foreach ($memberships as $membership): ?>
          <?php 
          $isCurrent = isset($currentMembership) && $currentMembership && $currentMembership['membershipID'] == $membership['membershipID'];
          $isPopular = $membership['tier'] === 'premium';
          ?>
          <div class="col-md-4">
            <div class="card membership-card <?= $membership['tier'] ?> <?= $isCurrent ? 'current' : '' ?>">
              <?php if ($isPopular): ?>
                <div class="popular-badge">Most Popular</div>
              <?php endif; ?>
              <?php if ($isCurrent): ?>
                <div class="current-badge">Current Plan</div>
              <?php endif; ?>
              
              <div class="card-body text-center">
                <h4 class="card-title"><?= esc($membership['planName']) ?></h4>
                <p class="price-tag">RM<?= number_format($membership['price'], 2) ?></p>
                <p class="text-muted">per month</p>
                
                <ul class="feature-list text-start">
                  <li><i class="fas fa-check"></i> <?= $membership['discountRate'] ?>% discount on all purchases</li>
                  <li><i class="fas fa-check"></i> <?= $membership['classLimit'] ?> classes per week</li>
                  <li><i class="fas fa-check"></i> <?= $membership['tier'] === 'vip' ? 'Priority booking' : 'Standard booking' ?></li>
                  <li><i class="fas fa-check"></i> <?= $membership['tier'] === 'vip' ? 'Exclusive VIP events' : 'Regular events' ?></li>
                  <li><i class="fas fa-check"></i> <?= $membership['tier'] === 'vip' ? 'Personal trainer consultation' : 'Group consultation' ?></li>
                </ul>
                
                                 <div class="mt-4">
                   <?php if ($isCurrent): ?>
                     <button class="btn btn-light btn-lg w-100" disabled>
                       <i class="fas fa-check"></i> Current Plan
                     </button>
                   <?php else: ?>
                     <a href="<?= site_url('/buy-membership') ?>" class="btn btn-light btn-lg w-100">
                       <i class="fas fa-shopping-cart"></i> Purchase Plan
                     </a>
                   <?php endif; ?>
                 </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="text-center py-5">
            <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No membership plans available</h4>
            <p class="text-muted">Please contact the gym for membership options.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Membership Benefits -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-star"></i> Membership Benefits</h5>
            <div class="row">
              <div class="col-md-4">
                <div class="text-center mb-3">
                  <i class="fas fa-percentage fa-2x text-primary mb-2"></i>
                  <h6>Discounts</h6>
                  <p class="text-muted">Get discounts on all gym purchases and services</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="text-center mb-3">
                  <i class="fas fa-dumbbell fa-2x text-success mb-2"></i>
                  <h6>Class Access</h6>
                  <p class="text-muted">Access to all group classes and training sessions</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="text-center mb-3">
                  <i class="fas fa-user-tie fa-2x text-warning mb-2"></i>
                  <h6>Trainer Support</h6>
                  <p class="text-muted">Professional guidance from certified trainers</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-question-circle"></i> Frequently Asked Questions</h5>
            <div class="accordion" id="membershipFAQ">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    Can I upgrade my membership plan?
                  </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#membershipFAQ">
                  <div class="accordion-body">
                    Yes, you can upgrade your membership plan at any time. The new plan will be effective immediately.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    What happens if I miss a class?
                  </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#membershipFAQ">
                  <div class="accordion-body">
                    If you miss a class, it will still count towards your weekly limit. Please cancel at least 24 hours in advance.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Can I cancel my membership?
                  </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#membershipFAQ">
                  <div class="accordion-body">
                    Yes, you can cancel your membership with 30 days notice. Contact our support team for assistance.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 