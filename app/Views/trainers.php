<!-- app/Views/trainers.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Trainers - FitZone</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/trainers.css') ?>">
</head>
<body>

  <!-- Navigation (same as other pages) -->
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


  <h1 class="title">OUR TRAINERS</h1>

<div class="trainer-container">
  <div class="trainer-card">
    <img src="<?= base_url('assets/images/coach1.jpg') ?>" alt="Trainer A">
    <h3>Coach Max</h3>
    <p>Specialty: Body Pump & Strength Training</p>
    <p>Class Schedule: Mon & Wed - 6PM</p>
    <p>"Discipline outworks motivation every time"</p>
  </div>

  <div class="trainer-card">
    <img src="<?= base_url('assets/images/coach2.jpg') ?>" alt="Trainer B">
    <h3>Coach Nia</h3>
    <p>Specialty: Yoga & Flexibility</p>
    <p>Class Schedule: Tue & Thu - 7PM</p>
    <p>"Strong is the new beautiful"</p>
  </div>

  <div class="trainer-card">
    <img src="<?= base_url('assets/images/coach3.jpg') ?>" alt="Trainer C">
    <h3>Coach Blake</h3>
    <p>Specialty: HIIT & Cardio Burn</p>
    <p>Class Schedule: Fri - 5PM | Sun - 9AM</p>
    <p>"Push your limits. Your body can handle more than you think."</p>
  </div>
</div>

</body>
</html>
