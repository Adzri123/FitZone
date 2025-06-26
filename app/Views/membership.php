<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitZone Membership Plan</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/membership.css') ?>">
</head>
<body>

  <!-- Navigation -->
  <nav>
    <div class="logo">FITZONE</div>
    <ul>
      <li><a href="/welcome_message">HOME</a></li>
      <li><a href="/about">ABOUT</a></li>
      <li><a href="/contactus">CONTACT US</a></li>
      <li><a href="/membership">MEMBERSHIP</a></li>
      <li><a href="/login">LOGIN</a></li>
      <li><a href="/register">REGISTER</a></li>
    </ul>
    <button class="join-btn">JOIN</button>
  </nav>

  <h1 class="title">FITZONE MEMBERSHIP</h1>
  <p class="subtitle">Pay Once. Access Forever. Upgrade Anytime.</p>

  <div class="container">

    <!-- Silver Plan -->
    <div class="card silver">
      <h2>Silver Membership</h2>
      <ul class="features">
        <li>5% discount on merchandise</li>
        <li>1 point per RM spent</li>
        <li>1 class/week</li>
        <li>Choose trainer</li>
      </ul>
      <p class="price">RM149</p>
      <a href="#" class="btn">Join Silver</a>
    </div>

    <!-- Gold Plan -->
    <div class="card gold">
      <h2>Gold Membership</h2>
      <ul class="features">
        <li>10% discount</li>
        <li>1 point per RM spent</li>
        <li>2 class/week</li>
        <li>Choose trainer</li>
      </ul>
      <p class="price">RM249</p>
      <a href="#" class="btn">Join Gold</a>
    </div>

    <!-- Platinum Plan -->
    <div class="card platinum">
      <h2>Platinum Membership</h2>
      <ul class="features">
        <li>20% discount</li>
        <li>1 point per RM spent</li>
        <li>3 class/week</li>
        <li>Choose trainer</li>
      </ul>
      <p class="price">RM349</p>
      <a href="#" class="btn">Join Platinum</a>
    </div>

  </div>

</body>
</html>
