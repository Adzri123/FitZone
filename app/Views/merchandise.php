<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Merchandise - FitZone</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/merchandise.css') ?>">
  <style>
    .hidden {
      display: none;
    }
  </style>
</head>
<body>

  <!-- Navigation -->
  <nav>
    <div class="logo">FITZONE</div>
    <ul>
      <li><a href="<?= base_url('/welcome_message') ?>">HOME</a></li>
      <li><a href="<?= base_url('/about') ?>">ABOUT</a></li>
      <li><a href="<?= base_url('/contactus') ?>">CONTACT US</a></li>
      <li><a href="<?= base_url('/membership') ?>">MEMBERSHIP</a></li>
      <li><a href="<?= base_url('/login') ?>">LOGIN</a></li>
      <li><a href="<?= base_url('/register') ?>">REGISTER</a></li>
    </ul>
    <button class="join-btn">JOIN</button>
  </nav>

  <h1 class="title">TRAIN IN STYLE</h1>

  <!-- Category Buttons -->
  <div class="category-buttons">
    <button onclick="filterCategory('all')">All</button>
    <button onclick="filterCategory('apparel')">Apparel</button>
    <button onclick="filterCategory('gear')">Gear</button>
    <button onclick="filterCategory('accessories')">Accessories</button>
    <button onclick="filterCategory('supplements')">Supplements</button>
  </div>

  <!-- Product Cards -->
  <div class="merch-container">
    <!-- Apparel -->
    <div class="merch-card" data-category="apparel">
      <img src="<?= base_url('assets/images/tshirt.jpg') ?>" alt="T-Shirt">
      <h3>FitZone T-Shirt</h3>
      <p>Price: RM69 <br> Points: 69</p>
      <div class="cart-action">
  <input type="number" min="1" value="1" class="qty-input" />
  <button class="buy-btn">
    <i class="fas fa-shopping-cart"></i>
  </button>
</div>

    </div>

    <div class="merch-card" data-category="apparel">
      <img src="<?= base_url('assets/images/hoodie.jpg') ?>" alt="Hoodie">
      <h3>FitZone Hoodie</h3>
      <p>Price: RM129 <br> Points: 129</p>
      <div class="cart-action">
    <input type="number" min="1" value="1" class="qty-input" />
    <button class="buy-btn"><i class="fas fa-shopping-cart"></i></button>
  </div>
    </div>

    <!-- Gear -->
    <div class="merch-card" data-category="gear">
      <img src="<?= base_url('assets/images/bag.jpg') ?>" alt="Bag">
      <h3>Training Bag</h3>
      <p>Price: RM109 <br> Points: 109</p>
      <div class="cart-action">
    <input type="number" min="1" value="1" class="qty-input" />
    <button class="buy-btn"><i class="fas fa-shopping-cart"></i></button>
  </div>
    </div>

    <div class="merch-card" data-category="gear">
      <img src="<?= base_url('assets/images/yogamat.jpg') ?>" alt="Yoga Mat">
      <h3>Yoga Mat</h3>
      <p>Price: RM89 <br> Points: 89</p>
      <div class="cart-action">
    <input type="number" min="1" value="1" class="qty-input" />
    <button class="buy-btn"><i class="fas fa-shopping-cart"></i></button>
  </div>
    </div>

    <!-- Accessories -->
    <div class="merch-card" data-category="accessories">
      <img src="<?= base_url('assets/images/bottle.jpg') ?>" alt="Water Bottle">
      <h3>Gym Water Bottle</h3>
      <p>Price: RM29 <br> Points: 29</p>
      <div class="cart-action">
    <input type="number" min="1" value="1" class="qty-input" />
    <button class="buy-btn"><i class="fas fa-shopping-cart"></i></button>
  </div>
    </div>

    <div class="merch-card" data-category="accessories">
      <img src="<?= base_url('assets/images/cap.jpg') ?>" alt="Cap">
      <h3>Sport Cap</h3>
      <p>Price: RM39 <br> Points: 39</p>
      <div class="cart-action">
    <input type="number" min="1" value="1" class="qty-input" />
    <button class="buy-btn"><i class="fas fa-shopping-cart"></i></button>
  </div>
    </div>

    <!-- Supplements -->
   <div class="merch-card" data-category="supplements">
  <img src="<?= base_url('assets/images/protein.jpg') ?>" alt="Whey Protein">
  <h3>Whey Protein 1kg</h3>
  <p>Price: RM159 <br> Points: 159</p>
  <div class="cart-action">
    <input type="number" min="1" value="1" class="qty-input" />
    <button class="buy-btn"><i class="fas fa-shopping-cart"></i></button>
  </div>
</div>


  <script>
    function filterCategory(category) {
      const cards = document.querySelectorAll('.merch-card');
      cards.forEach(card => {
        const itemCat = card.getAttribute('data-category');
        if (category === 'all' || category === itemCat) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    }
  </script>

</body>
</html>
