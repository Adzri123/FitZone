<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - FitZone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('assets/css/contactus.css') ?>">

  <!-- SweetAlert2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  
  <!-- Contact Content -->
  <div class="container">
    <div class="contact-box">
      <div class="contact-info">
        <h2>Get in Touch</h2>
        <p><strong>📍 Address:</strong> Lot 12, Jalan Fitness, 47000 Selangor, Malaysia</p>
        <p><strong>📞 Phone:</strong> +60 12-345 6789</p>
        <p><strong>✉️ Email:</strong> contact@fitzone.com</p>
        <p>We are happy to hear from you! Whether you have questions, feedback, or just want to say hello, drop us a message anytime.</p>
      </div>

      <div class="contact-form">
        <h2>Send Us a Message</h2>
        <form id="contactForm">
          <input type="text" id="name" name="name" placeholder="Your Full Name" required>
          <input type="email" id="email" name="email" placeholder="Your Email Address" required>
          <input type="text" id="subject" name="subject" placeholder="Subject" required>
          <textarea id="message" name="message" placeholder="Your Message" required></textarea>
          <button type="submit">SEND MESSAGE</button>
        </form>
      </div>
    </div>
  </div>

  <!-- SweetAlert Script -->
  <script>
    document.getElementById("contactForm").addEventListener("submit", function(e) {
      e.preventDefault(); // Prevent default submit

      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const subject = document.getElementById("subject").value.trim();
      const message = document.getElementById("message").value.trim();

      if (!name || !email || !subject || !message) {
        Swal.fire({
          icon: "error",
          title: "Oops!",
          text: "Please fill in all fields.",
          confirmButtonColor: "#751111"
        });
        return;
      }

      Swal.fire({
        icon: "success",
        title: "Message Sent!",
        text: "Your message has been sent successfully.",
        confirmButtonColor: "#751111"
      });

      this.reset(); // Kosongkan form selepas submit
    });
  </script>

</body>
</html>
