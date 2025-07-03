<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Merchandise - FitZone</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/merchandise.css') ?>">
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
  <p class="subtitle">Exclusive merchandise for members. Redeem with points or enjoy your discounts!</p>

  <div class="merch-container">
    <!-- Item 1 -->
    <div class="merch-card">
      <img src="<?= base_url('assets/images/tshirt.jpg') ?>" alt="Shirt">
      <h3>FitZone T-Shirt</h3>
      <p>Price: RM69 <br> Points: 69</p>
      <a href="#" class="buy-btn">Buy</a>
    </div>

    <!-- Item 2 -->
    <div class="merch-card">
      <img src="<?= base_url('assets/images/bottle.jpg') ?>" alt="Bottle">
      <h3>Gym Water Bottle</h3>
      <p>Price: RM29 <br> Points: 29</p>
      <a href="#" class="buy-btn">Buy</a>
    </div>

    <!-- Item 3 -->
    <div class="merch-card">
      <img src="<?= base_url('assets/images/bag.jpg') ?>" alt="Bag">
      <h3>Training Bag</h3>
      <p>Price: RM109 <br> Points: 109</p>
      <a href="#" class="buy-btn">Buy</a>
    </div>
  </div>

</body>
</html>
