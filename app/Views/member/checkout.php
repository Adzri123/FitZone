<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
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
    .payment-method {
      border: 2px solid #333;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: #232326;
      color: #fff;
    }
    .payment-method:hover {
      border-color: #ef4444;
      background-color: #751111;
    }
    .payment-method.selected {
      border-color: #ef4444;
      background-color: #751111;
    }
    .payment-method input[type="radio"] {
      margin-right: 10px;
    }
    .address-section {
      background-color: #232326;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      border: 1px solid #333;
    }
    .gym-address {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
      color: white;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .form-control, .form-select {
      background: #333;
      color: #fff;
      border: 1px solid #555;
      border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
      background: #333;
      color: #fff;
      border-color: #ef4444;
      box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25);
    }
    .form-label {
      color: #fff;
      font-weight: 500;
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
        <h2><i class="fas fa-credit-card"></i> Checkout</h2>
        <small class="text-muted">Complete your purchase</small>
      </div>
      <div class="d-flex align-items-center">
        <a href="<?= site_url('/cart') ?>" class="btn btn-outline-primary me-2"><i class="fas fa-arrow-left"></i> Back to Cart</a>
        <a href="<?= site_url('/dashboard/member') ?>" class="btn btn-outline-secondary"><i class="fas fa-home"></i> Dashboard</a>
      </div>
    </div>

    <form action="<?= site_url('/place-order') ?>" method="post" id="checkout-form">
      <div class="row">
        <!-- Left Column - Order Details and Forms -->
        <div class="col-lg-8">
          <!-- Shipping Address Section -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Shipping Information</h5>
            </div>
            <div class="card-body">
              <?php if ($shippingOption === 'pickup'): ?>
                <div class="gym-address">
                  <h6><i class="fas fa-store"></i> Pickup at Gym</h6>
                  <p class="mb-0">
                    <strong>Fitness Center Address:</strong><br>
                    123 Fitness Street<br>
                    Kuala Lumpur, 50000<br>
                    Malaysia<br>
                    <small><i class="fas fa-clock"></i> Available for pickup during gym hours</small>
                  </p>
                </div>
              <?php else: ?>
                <div class="address-section">
                  <h6><i class="fas fa-truck"></i> Delivery Address</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required value="<?= isset(
                          $user['name']) ? esc($user['name']) : '' ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required value="<?= isset($user['phone']) ? esc($user['phone']) : '' ?>">
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">Street Address *</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="city" class="form-label">City *</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="state" class="form-label">State *</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="postcode" class="form-label">Postal Code *</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" required>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Payment Method Section -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-credit-card"></i> Payment Method</h5>
            </div>
            <div class="card-body">
              <div class="payment-method selected" onclick="selectPaymentMethod('card')">
                <input type="radio" name="payment_method" value="card" id="card_payment" checked>
                <label for="card_payment" class="mb-0">
                  <i class="fas fa-credit-card text-primary"></i>
                  <strong>Credit/Debit Card</strong>
                  <br>
                  <small class="text-muted">Visa, Mastercard, American Express</small>
                </label>
              </div>
              
              <div class="payment-method" onclick="selectPaymentMethod('fpx')">
                <input type="radio" name="payment_method" value="fpx" id="fpx_payment">
                <label for="fpx_payment" class="mb-0">
                  <i class="fas fa-university text-success"></i>
                  <strong>FPX (Online Banking)</strong>
                  <br>
                  <small class="text-muted">Direct bank transfer via FPX</small>
                </label>
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
            </div>
          </div>
        </div>

        <!-- Right Column - Order Summary -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0"><i class="fas fa-receipt"></i> Order Summary</h5>
            </div>
            <div class="card-body">
              <!-- Cart Items -->
              <?php foreach ($cart as $merchandiseID => $item): 
                $itemTotal = $item['price'] * $item['quantity'];
              ?>
                <div class="cart-item">
                  <div class="row align-items-center">
                    <div class="col-3">
                      <img src="<?= $item['image_url'] ? base_url($item['image_url']) : base_url('assets/images/merch.png') ?>" 
                           class="product-image" alt="<?= esc($item['name']) ?>">
                    </div>
                    <div class="col-6">
                      <h6 class="mb-1"><?= esc($item['name']) ?></h6>
                      <p class="text-muted small mb-0">Qty: <?= $item['quantity'] ?></p>
                      <?php if ($item['point_cost'] > 0): ?>
                        <span class="points-badge"><?= $item['point_cost'] ?> pts</span>
                      <?php endif; ?>
                    </div>
                    <div class="col-3 text-end">
                      <span class="fw-bold">RM<?= number_format($itemTotal, 2) ?></span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

              <hr>
              
              <!-- Order Totals -->
              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span>RM<?= number_format($subtotal, 2) ?></span>
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
                      <span class="discount-badge">-RM<?= number_format($discountAmount, 2) ?></span>
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
              
              <div class="d-flex justify-content-between mb-2">
                <span>Shipping:</span>
                <span><?= $shippingOption === 'delivery' ? 'RM5.00' : 'Free' ?></span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong class="text-primary">RM<?= number_format($totalAmount, 2) ?></strong>
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
                    <strong>Membership Benefit:</strong> You saved RM<?= number_format($discountAmount, 2) ?> with your <?= $membership['planName'] ?> membership!
                  </small>
                </div>
              <?php endif; ?>
              
              <!-- Hidden inputs for order data -->
              <input type="hidden" name="shipping_option" value="<?= $shippingOption ?>">
              <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
              <input type="hidden" name="discount_amount" value="<?= $discountAmount ?>">
              <input type="hidden" name="total_amount" value="<?= $totalAmount ?>">
              <input type="hidden" name="total_points" value="<?= $totalPoints ?>">
              
              <button type="submit" class="btn btn-primary w-100 mb-2">
                <i class="fas fa-lock"></i> Place Order
              </button>
              
              <div class="text-center">
                <small class="text-muted">
                  <i class="fas fa-shield-alt"></i> Your payment information is secure
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Payment method selection
function selectPaymentMethod(method) {
    // Remove selected class from all payment methods
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selected class to clicked method
    event.currentTarget.classList.add('selected');
    
    // Check the radio button
    document.getElementById(method + '_payment').checked = true;
    
    // Show/hide payment forms
    if (method === 'card') {
        document.getElementById('card-payment-form').style.display = 'block';
        document.getElementById('fpx-payment-form').style.display = 'none';
    } else if (method === 'fpx') {
        document.getElementById('card-payment-form').style.display = 'none';
        document.getElementById('fpx-payment-form').style.display = 'block';
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
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
});

// CVV validation
document.getElementById('cvv').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    e.target.value = value;
});

// Form validation
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
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
    
    // Check delivery address fields if delivery is selected
    const shippingOption = '<?= $shippingOption ?>';
    if (shippingOption === 'delivery') {
        const requiredFields = ['fullName', 'phone', 'address', 'city', 'state', 'postcode'];
        for (let field of requiredFields) {
            const value = document.getElementById(field).value.trim();
            if (!value) {
                e.preventDefault();
                alert('Please fill in all required delivery address fields');
                return;
            }
        }
    }
});
</script>
</body>
</html> 