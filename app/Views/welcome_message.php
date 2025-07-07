<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitZone | Your Fitness Journey Starts Here</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
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
    <!-- Removed LOGIN and REGISTER links -->
  </ul>
  <!-- Updated JOIN button to go to login page -->
  <a href="<?= base_url('/login') ?>" class="join-btn">JOIN</a>
</nav>


  <!-- Hero Section -->
 <!-- Hero Section -->
<div class="hero">

  <!-- Background Video -->
  <video autoplay muted loop playsinline class="hero-video">
    <source src="assets/images/preview.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="hero-overlay"></div>

  <div class="hero-content">
    <h1>YOUR FITNESS JOURNEY STARTS HERE</h1>
    <p>Don't wait any longer; seize this opportunity to become the best version of yourself. Join our gym class today and take the special offer for Body Pump Class!</p>
    <a href="<?= base_url('membership') ?>" class="detail-btn">DETAIL</a>
  </div>

<div class="promo-container">
  <div class="promo-banner">GET 20% OFF FOR MERCHANDISE</div>
  <div class="merch-box">
    <a href="<?= base_url('merchandise') ?>">
      <video autoplay loop muted playsinline>
        <source src="assets/images/slideshow.mp4" type="video/mp4"> 
      </video>
    </a>
  </div>
</div>




</div>

  <!-- Section Divider -->
  <div class="section-divider">
    <span>Perks & Offers</span>
  </div>

  <!-- Service Section -->
<div class="class-section">
  
  <div class="class-box">
    <a href="<?= base_url('/merchandise') ?>" style="text-decoration: none; color: inherit;">
      <img src="assets/images/fit.jpg" alt="store">
      <h3>Train in Style</h3>
    </a>
  </div>

  <!-- Earn & Redeem Box -->
<div class="class-box">
  <a href="<?= base_url('/earn_redeem') ?>" style="text-decoration: none; color: inherit;">
    <img src="assets/images/rewardd.png" alt="reward">
    <h3>Earn & Redeem</h3>
  </a>
</div>


  <div class="class-box">
    <a href="<?= base_url('/trainers') ?>" style="text-decoration: none; color: inherit;">
      <img src="assets/images/trainee.jpg" alt="trainers">
      <h3>Meet Our Trainers</h3>
    </a>
  </div>

</div>

  </div>

</body>
</html>
