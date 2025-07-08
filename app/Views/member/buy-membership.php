<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Purchase Membership</title>
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

    .purchase-container {
      background: #232326;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 20px 40px rgba(239, 68, 68, 0.08);
      border: 1px solid #333;
    }

    .plan-card {
      background: #232326;
      color: #fff;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 10px 30px rgba(239, 68, 68, 0.08);
      transition: all 0.3s ease;
      border: 3px solid transparent;
      position: relative;
      overflow: hidden;
    }
    .plan-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(239, 68, 68, 0.15);
      border-color: #ef4444;
    }
    .plan-card.selected {
      border-color: #ef4444;
      background: linear-gradient(135deg, #751111 0%, #232326 100%);
      box-shadow: 0 20px 40px rgba(239, 68, 68, 0.2);
    }
    .plan-card.downgrade {
      opacity: 0.6;
      filter: grayscale(30%);
      border-color: #6c757d;
      background: linear-gradient(135deg, #333 0%, #232326 100%);
    }
    .plan-card.downgrade:hover {
      transform: none;
      box-shadow: 0 10px 30px rgba(239, 68, 68, 0.08);
    }
    .plan-card.basic {
      border-left: 5px solid #ef4444;
    }
    .plan-card.premium {
      border-left: 5px solid #f59e42;
    }
    .plan-card.vip {
      border-left: 5px solid #22c55e;
    }
    .plan-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .plan-name {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 10px;
      color: #fff;
    }
    .plan-price {
      font-size: 2.5rem;
      font-weight: bold;
      color: #ef4444;
      margin-bottom: 5px;
    }
    .plan-duration {
      color: #fff;
      font-size: 0.9rem;
    }
    .plan-features {
      list-style: none;
      padding: 0;
      margin: 20px 0;
    }
    .plan-features li {
      padding: 8px 0;
      border-bottom: 1px solid #333;
      display: flex;
      align-items: center;
      color: #fff;
    }
    .plan-features li:last-child {
      border-bottom: none;
    }
    .plan-features li i {
      margin-right: 10px;
      width: 20px;
      color: #22c55e;
    }
    .plan-badge {
      position: absolute;
      top: 3px;
      right: 15px;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: bold;
      color: white;
    }
    .badge-popular {
      background: linear-gradient(135deg, #f59e42 0%, #ef4444 100%);
    }
    .badge-current {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    }
    .badge-downgrade {
      background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    .payment-section {
      background: #232326;
      color: #fff;
      border-radius: 15px;
      padding: 25px;
      margin-top: 30px;
      box-shadow: 0 10px 30px rgba(239, 68, 68, 0.08);
      border: 1px solid #333;
    }
    .payment-methods {
      display: flex;
      gap: 15px;
      margin: 20px 0;
    }
    .payment-method {
      flex: 1;
      padding: 15px;
      border: 2px solid #333;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      background: #232326;
      color: #fff;
    }
    .payment-method:hover {
      border-color: #ef4444;
      background: #751111;
    }
    .payment-method.selected {
      border-color: #ef4444;
      background: #751111;
    }
    .payment-method i {
      font-size: 2rem;
      margin-bottom: 10px;
    }
    .summary-card {
      background: linear-gradient(135deg, #751111 0%, #ef4444 100%);
      color: white;
      border-radius: 15px;
      padding: 25px;
      margin-top: 20px;
    }
    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .summary-total {
      border-top: 2px solid rgba(255,255,255,0.3);
      padding-top: 15px;
      margin-top: 15px;
      font-size: 1.2rem;
      font-weight: bold;
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

    .btn-purchase {
      display: inline-block;
      width: 100%;
      padding: 14px 0;
      font-size: 1.15rem;
      font-weight: 700;
      background: linear-gradient(90deg, #ef4444 0%, #751111 100%);
      color: #fff;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 16px rgba(239, 68, 68, 0.10);
      transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
      cursor: pointer;
      margin-top: 20px;
      letter-spacing: 1px;
    }
    .btn-purchase:disabled {
      background: #888;
      color: #eee;
      cursor: not-allowed;
      opacity: 0.7;
      box-shadow: none;
    }
    .btn-purchase:hover:not(:disabled), .btn-purchase:focus:not(:disabled) {
      background: linear-gradient(90deg, #751111 0%, #ef4444 100%);
      color: #fff;
      box-shadow: 0 8px 24px rgba(239, 68, 68, 0.18);
      transform: translateY(-2px) scale(1.01);
      outline: none;
    }

    .comparison-table {
      background: #232326;
      border-radius: 15px;
      padding: 25px;
      margin-top: 30px;
      box-shadow: 0 10px 30px rgba(239, 68, 68, 0.08);
      border: 1px solid #333;
    }
    .comparison-table h4 {
      color: #ef4444;
      margin-bottom: 20px;
      font-weight: bold;
    }
    .comparison-table .table {
      background: transparent;
      border: none;
      margin-bottom: 0;
    }
    .comparison-table .table thead th {
      background: linear-gradient(135deg, #751111 0%, #ef4444 100%);
      color: #fff;
      border: none;
      padding: 15px 10px;
      text-align: center;
      font-weight: 600;
      font-size: 0.95rem;
      position: relative;
    }
    .comparison-table .table thead th:first-child {
      background: #232326;
      color: #fff;
      text-align: left;
      border-radius: 10px 0 0 0;
    }
    .comparison-table .table thead th:last-child {
      border-radius: 0 10px 0 0;
    }
    .comparison-table .table tbody tr {
      background: transparent;
      border: none;
    }
    .comparison-table .table tbody tr:nth-child(even) {
      background: rgba(239, 68, 68, 0.05);
    }
    .comparison-table .table tbody td {
      border: none;
      padding: 12px 10px;
      text-align: center;
      color: #000;
      font-size: 0.9rem;
      vertical-align: middle;
    }
    .comparison-table .table tbody td:first-child {
      text-align: left;
      font-weight: 600;
      color: #000;
      background: rgba(239, 68, 68, 0.1);
      border-radius: 0 0 0 10px;
    }
    .comparison-table .table tbody tr:last-child td:first-child {
      border-radius: 0 0 0 10px;
    }
    .comparison-table .table tbody tr:last-child td:last-child {
      border-radius: 0 0 10px 0;
    }
    .comparison-table .table tbody tr:hover {
      background: rgba(239, 68, 68, 0.1);
      transform: scale(1.01);
      transition: all 0.2s ease;
    }
    .comparison-table .badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }
    .comparison-table .badge.bg-success {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
      color: #fff;
    }
    .comparison-table .badge.bg-danger {
      background: linear-gradient(135deg, #ef4444 0%, #751111 100%) !important;
      color: #fff;
    }
    .comparison-table .price-cell {
      font-weight: bold;
      color: #22c55e;
      font-size: 1rem;
    }
    .comparison-table .feature-cell {
      font-weight: 500;
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

    <h2 class="mb-4"><i class="fas fa-credit-card"></i> Purchase Membership</h2>

      <!-- Current Membership Warning -->
      <?php if (isset($currentMembership) && $currentMembership): ?>
        <div class="alert alert-info" role="alert">
          <i class="fas fa-info-circle"></i> 
          <strong>Upgrade Policy:</strong> You can only upgrade your membership plan. Downgrading is not allowed. Your current plan is <strong><?= esc($currentMembership['planName']) ?></strong>.
        </div>
      <?php else: ?>
        <div class="alert alert-info" role="alert">
          <i class="fas fa-info-circle"></i> 
          <strong>Upgrade Policy:</strong> Once you select a membership plan, you can only upgrade to higher tiers. Downgrading is not allowed.
        </div>
      <?php endif; ?>

      <!-- Membership Plans Selection -->
      <h4 class="mb-3"><i class="fas fa-list"></i> Choose Your Plan</h4>
      <div class="d-flex flex-row flex-wrap gap-4 justify-content-center">
        <?php if (isset($memberships) && count($memberships) > 0): ?>
          <?php 
          // Define plan hierarchy for upgrade-only logic
          $planHierarchy = ['Basic' => 1, 'Silver' => 2, 'Gold' => 3, 'Platinum' => 4];
          $currentPlanLevel = 0;
          
          if (isset($currentMembership) && $currentMembership) {
            $currentPlanName = $currentMembership['planName'];
            $currentPlanLevel = $planHierarchy[$currentPlanName] ?? 0;
          }
          ?>
          <?php foreach ($memberships as $membership): ?>
            <?php 
            $isCurrent = isset($currentMembership) && $currentMembership && $currentMembership['membershipID'] == $membership['membershipID'];
            $isPopular = $membership['tier'] === 'premium';
            
            // Check if this plan can be upgraded to (higher level than current)
            $planName = $membership['planName'];
            $planLevel = $planHierarchy[$planName] ?? 0;
            $canUpgrade = $planLevel > $currentPlanLevel;
            $isDowngrade = $planLevel < $currentPlanLevel;
            ?>
            <div class="mb-4" style="flex: 1 1 0; min-width: 220px; max-width: 340px;">
              <div class="plan-card <?= $membership['tier'] ?> <?= $isCurrent ? 'selected' : '' ?> <?= $isDowngrade ? 'downgrade' : '' ?>" 
                   data-plan-id="<?= $membership['membershipID'] ?>" 
                   data-plan-price="<?= $membership['price'] ?>"
                   data-plan-name="<?= esc($membership['planName']) ?>">
                <?php if ($isPopular): ?>
                  <div class="plan-badge badge-popular">Most Popular</div>
                <?php endif; ?>
                <?php if ($isCurrent): ?>
                  <div class="plan-badge badge-current">Current Plan</div>
                <?php endif; ?>
                <?php if ($isDowngrade): ?>
                  <div class="plan-badge badge-downgrade">Downgrade</div>
                <?php endif; ?>
                <div class="plan-header">
                  <div class="plan-name"><?= esc($membership['planName']) ?></div>
                  <div class="plan-price">RM<?= number_format($membership['price'], 2) ?></div>
                  <div class="plan-duration">per month</div>
                </div>
                <ul class="plan-features">
                  <li><i class="fas fa-check"></i> <?= $membership['discountRate'] ?>% discount on purchases</li>
                  <li><i class="fas fa-check"></i> <?= $membership['classLimit'] ?> classes per week</li>
                </ul>
                <div class="text-center">
                  <?php if ($isCurrent): ?>
                    <button class="btn btn-secondary w-100" disabled>
                      <i class="fas fa-check"></i> Current Plan
                    </button>
                  <?php elseif ($isDowngrade): ?>
                    <button class="btn btn-secondary w-100" disabled>
                      <i class="fas fa-lock"></i> Downgrade Not Allowed
                    </button>
                  <?php else: ?>
                    <button class="btn btn-outline-primary w-100 select-plan-btn">
                      <i class="fas fa-arrow-up"></i> Upgrade to <?= esc($membership['planName']) ?>
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Payment Section -->
      <div class="payment-section">
        <h4 class="mb-3"><i class="fas fa-credit-card"></i> Payment Method</h4>
        <div class="d-flex w-100 gap-3 mb-3">
          <div class="payment-method flex-fill text-center selected d-flex flex-column justify-content-center align-items-center" style="flex:1;" onclick="selectPaymentMethod('card', event)">
            <input type="radio" name="payment_method" value="card" id="card_payment" checked>
            <label for="card_payment" class="mb-0 w-100">
              <i class="fas fa-credit-card text-primary"></i>
              <strong>Credit/Debit Card</strong>
              <br>
              <small class="text-muted">Visa, Mastercard, American Express</small>
            </label>
          </div>
          <div class="payment-method flex-fill text-center d-flex flex-column justify-content-center align-items-center" style="flex:1;" onclick="selectPaymentMethod('fpx', event)">
            <input type="radio" name="payment_method" value="fpx" id="fpx_payment">
            <label for="fpx_payment" class="mb-0 w-100">
              <i class="fas fa-university text-success"></i>
              <strong>FPX (Online Banking)</strong>
              <br>
              <small class="text-muted">Direct bank transfer via FPX</small>
            </label>
          </div>
        </div>
        <!-- Card Payment Form -->
        <div id="card-payment-form" class="mt-3">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number *</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="expiryDate" class="form-label">Expiry Date *</label>
                <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" maxlength="5">
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="cvv" class="form-label">CVV *</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" maxlength="4">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="cardName" class="form-label">Cardholder Name *</label>
            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="John Doe">
          </div>
        </div>
        <!-- FPX Payment Form -->
        <div id="fpx-payment-form" class="mt-3" style="display: none;">
          <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>FPX Payment:</strong> You will be redirected to your bank's secure payment page after placing the order.
          </div>
          <div class="mb-3">
            <label for="bankSelection" class="form-label">Select Your Bank</label>
            <select class="form-control" id="bankSelection" name="bankSelection">
              <option value="">Choose your bank...</option>
              <option value="maybank">Maybank</option>
              <option value="cimb">CIMB Bank</option>
              <option value="public">Public Bank</option>
              <option value="rhb">RHB Bank</option>
              <option value="hongleong">Hong Leong Bank</option>
              <option value="ambank">AmBank</option>
              <option value="alliance">Alliance Bank</option>
            </select>
          </div>
        </div>
        <!-- Purchase Summary -->
        <div class="summary-card">
          <h5><i class="fas fa-receipt"></i> Purchase Summary</h5>
          <div class="summary-row">
            <span>Selected Plan:</span>
            <span id="summary-plan">No plan selected</span>
          </div>
          <div class="summary-row">
            <span>Plan Price:</span>
            <span id="summary-price">RM0.00</span>
          </div>
          <div class="summary-row">
            <span>Payment Method:</span>
            <span id="summary-method">Credit/Debit Card</span>
          </div>
          <div class="summary-row summary-total">
            <span>Total Amount:</span>
            <span id="summary-total">RM0.00</span>
          </div>
        </div>
        <!-- Purchase Button -->
        <form action="<?= site_url('/purchase-membership') ?>" method="post" id="purchase-form">
          <input type="hidden" name="membershipID" id="selected-membership-id">
          <input type="hidden" name="payment_method" id="selected-payment-method" value="card">
          <button type="submit" class="btn-purchase" id="purchase-btn" disabled>
            <i class="fas fa-lock"></i> Secure Purchase - RM0.00
          </button>
        </form>
      </div>

      <!-- Plan Comparison -->
      <div class="comparison-table">
        <h4><i class="fas fa-balance-scale"></i> Plan Comparison</h4>
        <div class="table-responsive">
          <?php
            // Filter memberships for Basic, Silver, Gold, Platinum
            $planOrder = ['Basic', 'Silver', 'Gold', 'Platinum'];
            $plans = [];
            foreach ($planOrder as $planName) {
              foreach ($memberships as $m) {
                if (strcasecmp($m['planName'], $planName) === 0 || strcasecmp($m['tier'], $planName) === 0) {
                  $plans[$planName] = $m;
                  break;
                }
              }
            }
          ?>
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-list"></i> Features</th>
                <?php foreach ($planOrder as $plan): ?>
                  <th><i class="fas fa-crown"></i> <?= $plan ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><i class="fas fa-dollar-sign"></i> Monthly Price</td>
                <?php foreach ($planOrder as $plan): ?>
                  <td class="price-cell"><?= isset($plans[$plan]) ? 'RM' . number_format($plans[$plan]['price'], 2) : '-' ?></td>
                <?php endforeach; ?>
              </tr>
              <tr>
                <td><i class="fas fa-percentage"></i> Discount Rate</td>
                <?php foreach ($planOrder as $plan): ?>
                  <td class="feature-cell"><?= isset($plans[$plan]) ? $plans[$plan]['discountRate'] . '%' : '-' ?></td>
                <?php endforeach; ?>
              </tr>
              <tr>
                <td><i class="fas fa-dumbbell"></i> Classes per Week</td>
                <?php foreach ($planOrder as $plan): ?>
                  <td class="feature-cell"><?= isset($plans[$plan]) ? $plans[$plan]['classLimit'] : '-' ?></td>
                <?php endforeach; ?>
              </tr>
              <tr>
                <td><i class="fas fa-gift"></i> Redeem Status</td>
                <?php foreach ($planOrder as $plan): ?>
                  <td>
                    <?php if (isset($plans[$plan])): ?>
                      <?php if (strtolower($plans[$plan]['redeemStatus']) === 'enable' || strtolower($plans[$plan]['redeemStatus']) === 'enabled'): ?>
                        <span class="badge bg-success"><i class="fas fa-check-circle"></i> Enabled</span>
                      <?php else: ?>
                        <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Disabled</span>
                      <?php endif; ?>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                <?php endforeach; ?>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function selectPaymentMethod(method, event) {
  // Remove selected class from all payment methods
  document.querySelectorAll('.payment-method').forEach(el => {
    el.classList.remove('selected');
  });
  // Add selected class to clicked method
  event.currentTarget.classList.add('selected');
  // Check the radio button
  document.getElementById(method + '_payment').checked = true;
  // Set hidden input for form submission
  document.getElementById('selected-payment-method').value = method;
  // Show/hide payment forms
  if (method === 'card') {
    document.getElementById('card-payment-form').style.display = 'block';
    document.getElementById('fpx-payment-form').style.display = 'none';
    document.getElementById('summary-method').textContent = 'Credit/Debit Card';
  } else if (method === 'fpx') {
    document.getElementById('card-payment-form').style.display = 'none';
    document.getElementById('fpx-payment-form').style.display = 'block';
    document.getElementById('summary-method').textContent = 'FPX (Online Banking)';
  }
}

document.addEventListener('DOMContentLoaded', function() {
  let selectedPlan = null;
  let selectedPaymentMethod = 'card';

  // Plan selection
  document.querySelectorAll('.select-plan-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const planCard = this.closest('.plan-card');
      
      // Check if this is a downgrade plan (disabled)
      if (planCard.classList.contains('downgrade')) {
        return; // Don't allow selection of downgrade plans
      }
      
      const planId = planCard.dataset.planId;
      const planPrice = parseFloat(planCard.dataset.planPrice);
      const planName = planCard.dataset.planName;
      // Remove previous selection
      document.querySelectorAll('.plan-card').forEach(card => {
        card.classList.remove('selected');
      });
      // Select current plan
      planCard.classList.add('selected');
      selectedPlan = { id: planId, price: planPrice, name: planName };
      // Update summary
      updateSummary();
    });
  });

  function updateSummary() {
    if (selectedPlan) {
      document.getElementById('summary-plan').textContent = selectedPlan.name;
      document.getElementById('summary-price').textContent = `RM${selectedPlan.price.toFixed(2)}`;
      document.getElementById('summary-total').textContent = `RM${selectedPlan.price.toFixed(2)}`;
      document.getElementById('selected-membership-id').value = selectedPlan.id;
      const purchaseBtn = document.getElementById('purchase-btn');
      purchaseBtn.textContent = `Secure Purchase - RM${selectedPlan.price.toFixed(2)}`;
      purchaseBtn.disabled = false;
    }
  }

  // Card number formatting
  document.getElementById('cardNumber').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formattedValue;
  });
  // Expiry date formatting
  document.getElementById('expiryDate').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
      value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
  });
  // CVV formatting
  document.getElementById('cvv').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
  });

  // Form validation for purchase
  document.getElementById('purchase-form').addEventListener('submit', function(e) {
    const paymentMethod = document.getElementById('selected-payment-method').value;
    if (paymentMethod === 'card') {
      const cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, '');
      const expiryDate = document.getElementById('expiryDate').value;
      const cvv = document.getElementById('cvv').value;
      const cardName = document.getElementById('cardName').value;
      if (!cardNumber || cardNumber.length < 13) {
        e.preventDefault();
        alert('Please enter a valid card number');
        return;
      }
      if (!expiryDate || expiryDate.length !== 5) {
        e.preventDefault();
        alert('Please enter a valid expiry date (MM/YY)');
        return;
      }
      if (!cvv || cvv.length < 3) {
        e.preventDefault();
        alert('Please enter a valid CVV');
        return;
      }
      if (!cardName.trim()) {
        e.preventDefault();
        alert('Please enter the cardholder name');
        return;
      }
    } else if (paymentMethod === 'fpx') {
      const bankSelection = document.getElementById('bankSelection').value;
      if (!bankSelection) {
        e.preventDefault();
        alert('Please select your bank for FPX payment');
        return;
      }
    }
  });
});
</script>
</body>
</html> 