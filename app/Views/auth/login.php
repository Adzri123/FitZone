<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - FitZone</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="auth-body">

  <!-- Back to Home Icon Button -->
<a href="<?= base_url('welcome_message') ?>" class="back-icon" title="Back to Home">
  <i class="fas fa-home"></i>
</a>


  <div class="auth-container">
    <div class="auth-image-section">
      <img src="assets/images/lol.jpg" alt="Fitness" />
    </div>
    <div class="auth-form-section">
      <h2>WELCOME BACK<br><span>GYM MEMBER!</span></h2>
      <p>Log in to your account to access your personalized fitness journey.</p>
      <?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
      <form method="POST" action="<?= site_url('/login') ?>">
        <div class="input-icon">
          <i class="fas fa-user"></i>
          <input type="text" name="email" placeholder="Email" required />
        </div>
        <div class="input-icon">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <button class="login-btn" type="submit">LOGIN</button>
      </form>
      <div class="auth-footer">
        <a href="<?= base_url('register') ?>">Create Account</a>
        <a href="#">Need Help?</a>
      </div>
    </div>
  </div>
</body>
</html>

