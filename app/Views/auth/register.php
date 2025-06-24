<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - FitZone</title>
 
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="auth-body">
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
          <input type="password" name="password1" placeholder="Password" required />
        </div>

         <div class="input-icon">
          <i class="fas fa-lock"></i>
          <input type="password" name="password2" placeholder="Confirm Password" required />
        </div>

        <div class="input-icon">
          <i class="fas fa-phone"></i>
          <input type="text" name="phone" placeholder="Phone No" required />
        </div>

        <div class="input-icon">
          <i class="fas fa-users"></i>
          <select name="role" required>
            <option value="">-- Select Role --</option>
            <option value="member">Member</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button class="login-btn" type="submit">REGISTER</button>
      </form>
      <div class="auth-footer">
        <a href="/login">Already have an account?</a>
      </div>
    </div>
  </div>
</body>
</html>
