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

  <h1 class="title">OUR TRAINERS</h1>

<div class="trainer-container">
  <div class="trainer-card">
    <img src="<?= base_url('assets/images/coach1.jpg') ?>" alt="Trainer A">
    <h3>Coach Max</h3>
    <p>Specialty: Body Pump & Strength Training</p>
    <p>Class Schedule: Mon & Wed - 6PM</p>
    <p>"Discipline outworks motivation every time"</p>
    <button class="book-btn" onclick="openBooking('Coach Max')">Book</button>
  </div>

  <div class="trainer-card">
    <img src="<?= base_url('assets/images/coach2.jpg') ?>" alt="Trainer B">
    <h3>Coach Nia</h3>
    <p>Specialty: Yoga & Flexibility</p>
    <p>Class Schedule: Tue & Thu - 7PM</p>
    <p>"Strong is the new beautiful"</p>
    <button class="book-btn" onclick="openBooking('Coach Nia')">Book</button>
  </div>

  <div class="trainer-card">
    <img src="<?= base_url('assets/images/coach3.jpg') ?>" alt="Trainer C">
    <h3>Coach Blake</h3>
    <p>Specialty: HIIT & Cardio Burn</p>
    <p>Class Schedule: Fri - 5PM | Sun - 9AM</p>
    <p>"Push your limits. Your body can handle more than you think."</p>
    <button class="book-btn" onclick="openBooking('Coach Blake')">Book</button>
  </div>
</div>
<div id="bookingModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeBooking()">&times;</span>
    <h2 id="modalTitle">Book Session</h2>
    <form method="POST" action="<?= base_url('booking/save') ?>">
      <input type="hidden" name="trainer" id="trainerInput">

      <label for="date">Choose a Date:</label>
      <input type="date" id="datePicker" name="booking_date" required>

      <button type="submit" class="confirm-btn">Confirm Booking</button>
    </form>
  </div>
</div>
<!-- Booking Script -->
<script>
function openBooking(trainerName) {
  document.getElementById('bookingModal').style.display = 'block';
  document.getElementById('modalTitle').textContent = 'Book Session with ' + trainerName;
  document.getElementById('trainerInput').value = trainerName;

  const dateInput = document.getElementById('datePicker');
  const today = new Date().toISOString().split('T')[0];
  dateInput.setAttribute('min', today);
}

function closeBooking() {
  document.getElementById('bookingModal').style.display = 'none';
}
</script>

</body>
</html>
