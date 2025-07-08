<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
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

    .card {
      background: #232326;
      color: #fff;
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(239, 68, 68, 0.08);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(239, 68, 68, 0.12);
    }
    .cart-item {
      border-bottom: 1px solid #333;
      padding: 15px 0;
    }
    .cart-item:last-child {
      border-bottom: none;
    }
    .product-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }
    .price-badge {
      background: linear-gradient(135deg, #ef4444 0%, #751111 100%);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      font-weight: bold;
    }
    .points-badge {
      background: linear-gradient(135deg, #f59e42 0%, #ef4444 100%);
      color: white;
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.8em;
    }
    .quantity-input {
      width: 80px;
      text-align: center;
      background: #333;
      color: #fff;
      border: 1px solid #555;
      border-radius: 5px;
    }
    .empty-cart {
      text-align: center;
      padding: 60px 20px;
    }
    .empty-cart i {
      font-size: 4rem;
      color: #666;
      margin-bottom: 20px;
    }
    .discount-badge {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      font-weight: bold;
      font-size: 0.9em;
    }
    .membership-benefit {
      background: linear-gradient(135deg, #751111 0%, #ef4444 100%);
      color: white;
      border: none;
    }
    .membership-benefit .alert-info {
      background: transparent;
      color: white;
      border: none;
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
      color: #fff !important;
    }
    .text-primary {
      color: #ef4444 !important;
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
  <a href="<?= site_url('/shop') ?>" class="active"><i class="fas fa-shopping-cart"></i> Shop</a>
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

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2><i class="fas fa-shopping-cart"></i> Shopping Cart</h2>
        <?php if ($membership): ?>
          <small class="text-success">
            <i class="fas fa-crown"></i> <?= $membership['planName'] ?> Member - <?= $discountRate ?>% discount applied
          </small>
        <?php else: ?>
          <small class="text-muted">
            <i class="fas fa-info-circle"></i> No active membership - <a href="<?= site_url('/buy-membership') ?>" class="text-primary">Get a membership</a> for discounts!
          </small>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center">
        <a href="<?= site_url('/shop') ?>" class="btn btn-outline-primary me-2"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
        <a href="<?= site_url('/dashboard/member') ?>" class="btn btn-outline-secondary"><i class="fas fa-home"></i> Dashboard</a>
      </div>
    </div>

    <?php if (empty($cart)): ?>
      <!-- Empty Cart -->
      <div class="card">
        <div class="card-body empty-cart">
          <i class="fas fa-shopping-cart"></i>
          <h4 class="text-muted">Your cart is empty</h4>
          <p class="text-muted">Add some items to your cart to get started!</p>
          <a href="<?= site_url('/shop') ?>" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Browse Products</a>
        </div>
      </div>
    <?php else: ?>
      <!-- Cart Items -->
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-list"></i> Cart Items (<?= count($cart) ?> items)</h5>
            </div>
            <div class="card-body">
              <?php foreach ($cart as $merchandiseID => $item): 
                $itemTotal = $item['price'] * $item['quantity'];
              ?>
                <div class="cart-item">
                  <div class="row align-items-center">
                    <div class="col-md-2">
                      <img src="<?= $item['image_url'] ? base_url($item['image_url']) : base_url('assets/images/merch.png') ?>" 
                           class="product-image" alt="<?= esc($item['name']) ?>">
                    </div>
                    <div class="col-md-4">
                      <h6 class="mb-1"><?= esc($item['name']) ?></h6>
                      <p class="text-muted small mb-0"><?= esc($item['category']) ?></p>
                      <?php if ($item['point_cost'] > 0): ?>
                        <span class="points-badge"><?= $item['point_cost'] ?> pts</span>
                      <?php endif; ?>
                    </div>
                    <div class="col-md-2">
                      <span class="price-badge">$<?= number_format($item['price'], 2) ?></span>
                    </div>
                    <div class="col-md-2">
                      <form action="<?= site_url('/update-cart') ?>" method="post" class="d-flex align-items-center">
                        <input type="hidden" name="merchandiseID" value="<?= $merchandiseID ?>">
                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" 
                               class="form-control quantity-input me-2">
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-sync-alt"></i>
                        </button>
                      </form>
                    </div>
                    <div class="col-md-1">
                      <span class="fw-bold">$<?= number_format($itemTotal, 2) ?></span>
                    </div>
                    <div class="col-md-1">
                      <form action="<?= site_url('/remove-from-cart') ?>" method="post" class="d-inline">
                        <input type="hidden" name="merchandiseID" value="<?= $merchandiseID ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                onclick="return confirm('Are you sure you want to remove this item?')">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-receipt"></i> Order Summary</h5>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span>$<?= number_format($subtotal, 2) ?></span>
              </div>
              
              <?php if ($discountRate > 0 && $membership): ?>
                <!-- Membership Discount -->
                <div class="alert alert-success mb-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <i class="fas fa-percentage text-success"></i>
                      <strong><?= $membership['planName'] ?> Discount</strong>
                      <br>
                      <small class="text-muted"><?= $discountRate ?>% off all purchases</small>
                    </div>
                    <div class="text-end">
                      <span class="discount-badge">-$<?= number_format($discountAmount, 2) ?></span>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              
              <?php if ($totalPoints > 0): ?>
              <div class="d-flex justify-content-between mb-2">
                <span><i class="fas fa-coins text-warning"></i> Points Required:</span>
                <span class="text-warning"><?= number_format($totalPoints) ?> pts</span>
              </div>
              <?php endif; ?>
              
              
              <!-- Shipping Options -->
              <div class="mb-3">
                <label class="form-label fw-bold"><i class="fas fa-shipping-fast"></i> Shipping Options</label>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="radio" name="shipping_option" id="pickup" value="pickup" checked>
                  <label class="form-check-label" for="pickup">
                    <i class="fas fa-store text-success"></i> Pickup at Gym (Free)
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="shipping_option" id="delivery" value="delivery">
                  <label class="form-check-label" for="delivery">
                    <i class="fas fa-truck text-primary"></i> Delivery ($5.00)
                  </label>
                </div>
              </div>
              
              <div class="d-flex justify-content-between mb-2">
                <span>Shipping:</span>
                <span id="shipping-cost">Free</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong class="text-primary" id="total-amount">$<?= number_format($totalAmount, 2) ?></strong>
              </div>
              <?php if ($totalPoints > 0): ?>
              <div class="d-flex justify-content-between mb-3">
                <strong>Points to Deduct:</strong>
                <strong class="text-warning"><?= number_format($totalPoints) ?> pts</strong>
              </div>
              <?php endif; ?>
              
              <?php if ($discountRate > 0 && $membership): ?>
                <div class="alert alert-info mb-3 membership-benefit">
                  <small>
                    <i class="fas fa-star"></i>
                    <strong>Membership Benefit:</strong> You saved $<?= number_format($discountAmount, 2) ?> with your <?= $membership['planName'] ?> membership!
                  </small>
                </div>
              <?php endif; ?>
              
              <form action="<?= site_url('/checkout') ?>" method="post" id="checkout-form">
                <input type="hidden" name="shipping_option" id="shipping_option_input" value="pickup">
                <button type="submit" class="btn btn-primary w-100 mb-2">
                  <i class="fas fa-credit-card"></i> Proceed to Checkout
                </button>
              </form>
              
              <div class="text-center">
                <small class="text-muted">
                  <i class="fas fa-info-circle"></i> Free pickup at gym location
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Shipping option handling
document.addEventListener('DOMContentLoaded', function() {
    const pickupRadio = document.getElementById('pickup');
    const deliveryRadio = document.getElementById('delivery');
    const shippingCostSpan = document.getElementById('shipping-cost');
    const shippingOptionInput = document.getElementById('shipping_option_input');
    const totalSpan = document.getElementById('total-amount');
    
    // Get the base total amount (without shipping)
    const baseTotal = <?= $totalAmount ?>;
    
    function updateShippingCost() {
        if (pickupRadio.checked) {
            shippingCostSpan.textContent = 'Free';
            shippingOptionInput.value = 'pickup';
            totalSpan.textContent = '$' + baseTotal.toFixed(2);
        } else if (deliveryRadio.checked) {
            shippingCostSpan.textContent = '$5.00';
            shippingOptionInput.value = 'delivery';
            const newTotal = baseTotal + 5.00;
            totalSpan.textContent = '$' + newTotal.toFixed(2);
        }
    }
    
    // Add event listeners
    pickupRadio.addEventListener('change', updateShippingCost);
    deliveryRadio.addEventListener('change', updateShippingCost);
    
    // Initialize
    updateShippingCost();
});
</script>
</body>
</html> 