<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - FitZone</title>
 
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
      <img src="assets/images/lol2.jpg" alt="Fitness" />
    </div>
    <div class="auth-form-section">
      <h2>JOIN FITZONE<br><span>REGISTER NOW!</span></h2>
      <p>Create your account to start your fitness journey.</p>
      <form action="<?= site_url('/register/process') ?>" method="POST">

        <div class="input-icon">
          <i class="fas fa-user"></i>
          <input type="text" name="name" placeholder="Name" required />
        </div>
        
        <div class="input-icon">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required />
        </div>

         <div class="input-icon">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="error-message" id="error-password"></div>

         <div class="input-icon">
          <i class="fas fa-lock"></i>
          <input type="password" name="password2" placeholder="Confirm Password" required />
        </div>
        <div class="error-message" id="error-password2"></div>

        <div class="input-icon">
          <i class="fas fa-phone"></i>
          <input type="text" name="phone" placeholder="Phone No" required />
        </div>

        <input type="hidden" name="role" value="member">
        <input type="hidden" name="membershipID" value="1">

        <button class="login-btn" type="submit">REGISTER</button>
      </form>
      <div class="auth-footer">
        <a href="/login">Already have an account?</a>
      </div>
    </div>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (e) {
      let hasError = false;

      const password = form.password.value;
      const password2 = form.password2.value;

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;

      // Clear all previous error messages
      document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

      if (!passwordRegex.test(password)) {
        document.getElementById('error-password').textContent =
          'Password must be at least 8 characters and include uppercase, lowercase, and a symbol.';
        hasError = true;
      }

      if (password !== password2) {
        document.getElementById('error-password2').textContent = 'Passwords do not match.';
        hasError = true;
      }

      if (hasError) {
        e.preventDefault(); // Stop form submission
      }
    });
  });
</script>


</body>
</html>
