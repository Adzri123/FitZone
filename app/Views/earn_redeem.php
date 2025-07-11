<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Earn & Redeem - FitZone</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/earn_redeem.css') ?>">
</head>
<body>

<!-- Navigation -->
<nav>
  <a href="<?= base_url('/welcome_message') ?>" class="logo">FITZONE</a>

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


<h1 class="title">EARN & REDEEM</h1>
<p class="subtitle">Collect points as you shop and redeem exciting rewards!</p>

<div class="earn-section">
  <h2>How to Earn Points</h2>
  <ul>
    <li>🛒 1 Point per RM1 spent on merchandise</li>
    <li>💪 Bonus Points for attending special fitness classes</li>
    <li>🎯 Points for achieving fitness milestones</li>
  </ul>
</div>

<div class="redeem-section">
  <h2>Redeem Your Rewards</h2>
  <table>
    <thead>
  <tr>
    <th>Reward</th>
    <th>Points Required</th>
  </tr>
</thead>

    <tr>
  <td>FitZone Water Bottle</td>
  <td>29</td>
</tr>
<tr>
  <td>Training T-Shirt</td>
  <td>69</td>
</tr>
<tr>
  <td>Gym Membership Extension (1 week)</td>
  <td>120</td>
</tr>

  </table>
</div>

</body>
</html>
