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
  <a href="<?= base_url('/register') ?>" class="join-btn">JOIN</a>
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

  <div class="slideshow-wrapper">
    <!-- Left Arrow -->
    <span class="arrow left" onclick="prevSlide()">&#10094;</span>

    <div class="slideshow-container">
      <img class="slide-img active" src="assets/images/hoodie.jpg" alt="Product 1">
      <img class="slide-img" src="assets/images/yogamat.jpg" alt="Product 2">
      <img class="slide-img" src="assets/images/cap.jpg" alt="Product 3">
      <img class="slide-img" src="assets/images/bottle.jpg" alt="Product 4">
      <img class="slide-img" src="assets/images/protein.jpg" alt="Product 5">
      <img class="slide-img" src="assets/images/tshirt.jpg" alt="Product 6">
      <img class="slide-img" src="assets/images/bag.jpg" alt="Product 7">
    </div>

    <!-- Right Arrow -->
    <span class="arrow right" onclick="nextSlide()">&#10095;</span>

    <!-- Pagination Dots -->
    <div class="dots-container">
      <span class="dot active" onclick="showSlide(0)"></span>
      <span class="dot" onclick="showSlide(1)"></span>
      <span class="dot" onclick="showSlide(2)"></span>
      <span class="dot" onclick="showSlide(3)"></span>
      <span class="dot" onclick="showSlide(4)"></span>
      <span class="dot" onclick="showSlide(5)"></span>
      <span class="dot" onclick="showSlide(6)"></span>
    </div>
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
  
<script>
  let slideIndex = 0;
  let slides = document.querySelectorAll('.slide-img');
  let dots = document.querySelectorAll('.dot');

  function showSlide(n) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      dots[i].classList.remove('active');
    });
    slides[n].classList.add('active');
    dots[n].classList.add('active');
    slideIndex = n;
  }

  function nextSlide() {
    slideIndex = (slideIndex + 1) % slides.length;
    showSlide(slideIndex);
  }

  setInterval(nextSlide, 3000); // Auto-play every 3 seconds

  // Initialize
  showSlide(slideIndex);
</script>


</body>
</html>
