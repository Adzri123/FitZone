<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gym Shop</title>
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
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(239, 68, 68, 0.15);
    }
    .product-card {
      height: 100%;
      display: flex;
      flex-direction: column;
      cursor: default;
      pointer-events: none;
    }
    .product-image {
      height: 200px;
      object-fit: cover;
      border-radius: 10px 10px 0 0;
      pointer-events: none;
    }
    .product-card .card-body {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      pointer-events: none;
    }
    .product-card .card-footer {
      background: none;
      border-top: 1px solid #333;
      padding-top: 0;
      pointer-events: auto;
    }
    .product-card .card-footer * {
      pointer-events: auto;
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
    .cart-btn {
      transition: all 0.3s ease;
    }
    .cart-btn:hover {
      transform: scale(1.05);
    }
    .cart-badge {
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    .redeemable-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: linear-gradient(135deg, #ef4444 0%, #751111 100%);
      color: white;
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.7em;
      font-weight: bold;
      z-index: 10;
    }
    .redeem-btn {
      background: linear-gradient(135deg, #f59e42 0%, #ef4444 100%);
      border: none;
      transition: all 0.3s ease;
    }
    .redeem-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
    }
    /* Ensure product containers are not clickable */
    .col-md-4[data-category], .col-lg-3[data-category] {
      cursor: default;
      pointer-events: none;
    }
    .col-md-4[data-category] *, .col-lg-3[data-category] * {
      pointer-events: none;
    }
    .col-md-4[data-category] .card-footer, 
    .col-md-4[data-category] .card-footer *,
    .col-lg-3[data-category] .card-footer,
    .col-lg-3[data-category] .card-footer * {
      pointer-events: auto;
    }
    .modal-header {
      background: linear-gradient(135deg, #751111 0%, #ef4444 100%);
      color: white;
      border-radius: 15px 15px 0 0;
    }
    .modal-content {
      background: #232326;
      color: #fff;
    }
    .modal-body {
      background: #232326;
      color: #fff;
    }
    .modal-footer {
      background: #232326;
      border-top: 1px solid #333;
    }
    .quantity-input {
      text-align: center;
      font-size: 1.2em;
      font-weight: bold;
      background: #333;
      color: #fff;
      border: 1px solid #555;
    }
    .quantity-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: none;
      font-size: 1.2em;
      font-weight: bold;
      transition: all 0.3s ease;
      background: #ef4444;
      color: #fff;
    }
    .quantity-btn:hover {
      transform: scale(1.1);
      background: #751111;
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
  <a href="<?= site_url('/shop') ?>" class="active"><i class="fas fa-shopping-cart"></i> Shop</a>
  <a href="<?= site_url('/order-history') ?>"><i class="fas fa-history"></i> Order History</a>
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

    <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Gym Shop</h2>

    <!-- Shop Categories -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-tags"></i> Shop Categories</h5>
            <div class="d-flex flex-wrap gap-2">
              <button class="btn btn-outline-primary active" data-category="all">All Items</button>
              <button class="btn btn-outline-success" data-category="equipment">Equipment</button>
              <button class="btn btn-outline-info" data-category="supplements">Supplements</button>
              <button class="btn btn-outline-warning" data-category="clothing">Clothing</button>
              <button class="btn btn-outline-danger" data-category="accessories">Accessories</button>
              <button class="btn btn-outline-warning" data-redeemable="true">
                <i class="fas fa-gift"></i> Redeemable Items
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
      <?php if (isset($merchandise) && count($merchandise) > 0): ?>
        <?php foreach ($merchandise as $item): ?>
          <div class="col-md-4 col-lg-3" data-category="<?= strtolower($item['category']) ?>">
            <div class="card product-card">
              <?php if ($item['is_redeemable'] && $item['point_cost'] > 0): ?>
                <div class="redeemable-badge">
                  <i class="fas fa-gift"></i> Redeemable
                </div>
              <?php endif; ?>
              <img src="<?= $item['image_url'] ? base_url($item['image_url']) : base_url('assets/images/merch.png') ?>" 
                   class="card-img-top product-image" alt="<?= esc($item['name']) ?>">
              <div class="card-body">
                <h6 class="card-title"><?= esc($item['name']) ?></h6>
                <p class="card-text text-muted small"><?= esc($item['category']) ?></p>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="price-badge">$<?= number_format($item['price'], 2) ?></span>
                  <?php if ($item['point_cost'] > 0): ?>
                    <span class="points-badge"><?= $item['point_cost'] ?> pts</span>
                  <?php endif; ?>
                </div>
                <p class="card-text small">
                  <i class="fas fa-box"></i> Stock: <?= $item['stock_quantity'] ?> available
                </p>
                <?php if ($item['is_redeemable']): ?>
                  <p class="card-text small text-success">
                    <i class="fas fa-gift"></i> Redeemable with points!
                  </p>
                <?php endif; ?>
              </div>
              <div class="card-footer">
                <?php if ($item['is_redeemable'] && $item['point_cost'] > 0): ?>
                  <!-- Redeem with Points Button -->
                  <form action="<?= site_url('member/pointCheckout') ?>" method="post" class="mb-2">
                    <input type="hidden" name="item_id" value="<?= $item['merchandiseID'] ?>">
                    <button type="submit" class="btn btn-warning btn-sm w-100 redeem-btn" 
                            <?= $item['stock_quantity'] <= 0 ? 'disabled' : '' ?>
                            onclick="return confirm('Redeem <?= esc($item['point_cost']) ?> points for this item?')">
                      <i class="fas fa-gift"></i> 
                      <?= $item['stock_quantity'] <= 0 ? 'Out of Stock' : 'Redeem with ' . esc($item['point_cost']) . ' pts' ?>
                    </button>
                  </form>
                <?php endif; ?>
                
                <!-- Add to Cart Button -->
                <button type="button" class="btn btn-success btn-sm w-100" 
                        <?= $item['stock_quantity'] <= 0 ? 'disabled' : '' ?>
                        onclick="openAddToCartModal(<?= $item['merchandiseID'] ?>, '<?= esc($item['name']) ?>', <?= $item['stock_quantity'] ?>, <?= $item['price'] ?>)">
                  <i class="fas fa-cart-plus"></i> 
                  <?= $item['stock_quantity'] <= 0 ? 'Out of Stock' : 'Add to Cart' ?>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="text-center py-5">
            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No products available</h4>
            <p class="text-muted">Check back later for new items!</p>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Shopping Cart Summary -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-info-circle"></i> Shopping Information</h5>
            <div class="row">
              <div class="col-md-6">
                <h6><i class="fas fa-coins text-warning"></i> Points System</h6>
                <ul class="list-unstyled">
                  <li><i class="fas fa-check text-success"></i> Earn points by attending classes</li>
                  <li><i class="fas fa-check text-success"></i> Use points to redeem items</li>
                  <li><i class="fas fa-check text-success"></i> Points never expire</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h6><i class="fas fa-shipping-fast text-primary"></i> Delivery Options</h6>
                <ul class="list-unstyled">
                  <li><i class="fas fa-check text-success"></i> Free pickup at gym</li>
                  <li><i class="fas fa-check text-success"></i> Home delivery ($5.00)</li>
                  <li><i class="fas fa-check text-success"></i> Same day processing</li>
                  <li><i class="fas fa-check text-success"></i> Secure payment</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addToCartModalLabel">
          <i class="fas fa-cart-plus"></i> Add to Cart
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <h6 id="modalProductName" class="mb-2"></h6>
          <p class="text-muted mb-3">Select quantity to add to your cart</p>
        </div>
        
        <form id="addToCartForm" action="<?= site_url('/add-to-cart') ?>" method="post">
          <input type="hidden" id="modalMerchandiseID" name="merchandiseID" value="">
          
          <div class="d-flex justify-content-center align-items-center mb-4">
            <button type="button" class="btn btn-outline-secondary quantity-btn me-3" onclick="decreaseQuantity()">
              <i class="fas fa-minus"></i>
            </button>
            <input type="number" id="modalQuantity" name="quantity" value="1" min="1" max="1" 
                   class="form-control quantity-input mx-2" style="width: 100px;" readonly>
            <button type="button" class="btn btn-outline-secondary quantity-btn ms-3" onclick="increaseQuantity()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          
          <div class="text-center mb-3">
            <p class="text-muted small">
              <i class="fas fa-box"></i> Available stock: <span id="modalStockQuantity">0</span>
            </p>
            <p class="text-muted small">
              <i class="fas fa-dollar-sign"></i> Price per item: $<span id="modalPrice">0.00</span>
            </p>
            <p class="text-primary fw-bold">
              <i class="fas fa-calculator"></i> Total: $<span id="modalTotal">0.00</span>
            </p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Cancel
        </button>
        <button type="submit" form="addToCartForm" class="btn btn-success">
          <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Category filter functionality
document.addEventListener('DOMContentLoaded', function() {
  const categoryButtons = document.querySelectorAll('[data-category]');
  const redeemableButton = document.querySelector('[data-redeemable]');
  const products = document.querySelectorAll('.col-md-4[data-category], .col-lg-3[data-category]');

  categoryButtons.forEach(button => {
    button.addEventListener('click', function() {
      const selectedCategory = this.getAttribute('data-category');
      
      // Update active button
      categoryButtons.forEach(btn => btn.classList.remove('active'));
      redeemableButton.classList.remove('active');
      this.classList.add('active');
      
      // Filter products
      products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        if (selectedCategory === 'all' || productCategory === selectedCategory) {
          product.style.display = 'block';
        } else {
          product.style.display = 'none';
        }
      });
    });
  });

  // Redeemable filter
  redeemableButton.addEventListener('click', function() {
    // Update active button
    categoryButtons.forEach(btn => btn.classList.remove('active'));
    this.classList.add('active');
    
    // Filter products
    products.forEach(product => {
      const hasRedeemableBadge = product.querySelector('.redeemable-badge');
      if (hasRedeemableBadge) {
        product.style.display = 'block';
      } else {
        product.style.display = 'none';
      }
    });
  });
});

// Modal functionality
let currentMaxStock = 1;
let currentPrice = 0;

function openAddToCartModal(merchandiseID, productName, stockQuantity, price) {
  currentMaxStock = stockQuantity;
  currentPrice = price;
  
  document.getElementById('modalMerchandiseID').value = merchandiseID;
  document.getElementById('modalProductName').textContent = productName;
  document.getElementById('modalStockQuantity').textContent = stockQuantity;
  document.getElementById('modalPrice').textContent = price.toFixed(2);
  document.getElementById('modalQuantity').value = 1;
  document.getElementById('modalQuantity').max = stockQuantity;
  
  updateModalTotal();
  
  const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));
  modal.show();
}

function increaseQuantity() {
  const quantityInput = document.getElementById('modalQuantity');
  const currentQuantity = parseInt(quantityInput.value);
  if (currentQuantity < currentMaxStock) {
    quantityInput.value = currentQuantity + 1;
    updateModalTotal();
  }
}

function decreaseQuantity() {
  const quantityInput = document.getElementById('modalQuantity');
  const currentQuantity = parseInt(quantityInput.value);
  if (currentQuantity > 1) {
    quantityInput.value = currentQuantity - 1;
    updateModalTotal();
  }
}

function updateModalTotal() {
  const quantity = parseInt(document.getElementById('modalQuantity').value);
  const total = quantity * currentPrice;
  document.getElementById('modalTotal').textContent = total.toFixed(2);
}

// Update total when quantity input changes
document.getElementById('modalQuantity').addEventListener('input', updateModalTotal);
</script>
</body>
</html> 