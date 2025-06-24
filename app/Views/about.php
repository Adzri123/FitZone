<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>About Us - FitZone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('images/about.png') no-repeat center center fixed;
      background-size: cover;
      color: white;
      position: relative;
      min-height: 100vh;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.75);
      z-index: 0;
    }

    nav {
      background-color: #751111;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      z-index: 2;
      position: relative;
    }

    nav .logo {
      font-weight: bold;
      font-size: 24px;
      color: rgb(253, 245, 245);
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    nav .join-btn {
      background-color: #f00;
      color: white;
      padding: 10px 20px;
      border: none;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
    }

    .container {
      position: relative;
      z-index: 1;
      padding: 80px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .section {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(6px);
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,0.2);
      padding: 40px;
      margin-bottom: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }

    .section h2 {
      color: #FFD6D6;
      font-size: 28px;
      margin-bottom: 20px;
      border-left: 5px solid #f00;
      padding-left: 15px;
    }

    .section p, .section li {
      font-size: 17px;
      line-height: 1.7;
      color: #f1f1f1;
      margin-bottom: 15px;
    }

    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .feature-box {
      background-color: rgba(255,255,255,0.1);
      padding: 20px;
      border-radius: 12px;
      transition: transform 0.3s ease;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .feature-box:hover {
      transform: translateY(-5px);
      background-color: rgba(255,255,255,0.15);
    }

    .feature-box h3 {
      color: #FF9999;
      margin-bottom: 10px;
      font-size: 20px;
    }

    .testimonials blockquote {
      font-style: italic;
      border-left: 4px solid #f00;
      padding-left: 15px;
      margin-bottom: 20px;
      color: #e0e0e0;
    }

    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }

      nav ul {
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
      }

      .section {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Navigation -->
  <nav>
    <div class="logo">FITZONE</div>
    <ul>
      <li><a href="welcome_message.php">HOME</a></li>
      <li><a href="about.php">ABOUT</a></li>
      <li><a href="contact.php">CONTACT US</a></li>
      <li><a href="membership.php">MEMBERSHIP</a></li>
      <li><a href="login.php">LOGIN</a></li>
      <li><a href="register.php">REGISTER</a></li>
    </ul>
    <button class="join-btn">JOIN</button>
  </nav>

  <!-- About Page Content -->
  <div class="container">

    <div class="section">
      <h2>About FitZone</h2>
      <p>
        FitZone is more than just a gym — it's a supportive community dedicated to health, discipline and transformation. 
        Whether you're a beginner or seasoned athlete, our facilities, trainers and programs are tailored for everyone.
      </p>
    </div>

    <div class="section">
      <h2>Our Vision & Mission</h2>
      <p><strong>Vision:</strong> To become Malaysia’s leading fitness hub that transforms lives through health and well-being.</p>
      <p><strong>Mission:</strong> To provide world-class fitness services, modern equipment, and professional trainers in an inclusive and motivating environment.</p>
    </div>

    <div class="section">
      <h2>Why Choose FitZone?</h2>
      <div class="features">
        <div class="feature-box">
          <h3>✔ Certified Trainers</h3>
          <p>All our trainers are fully certified and experienced in fitness and personal training.</p>
        </div>
        <div class="feature-box">
          <h3>✔ Flexible Packages</h3>
          <p>Choose plans that suit your schedule and budget, from daily passes to yearly memberships.</p>
        </div>
        <div class="feature-box">
          <h3>✔ Friendly Environment</h3>
          <p>Safe, supportive and non-judgmental space for beginners and pros alike.</p>
        </div>
      </div>
    </div>

    <div class="section">
      <h2>Facilities</h2>
      <ul>
        <li>Cardio & Strength Zones</li>
        <li>Locker & Shower Rooms</li>
        <li>Yoga & Dance Studios</li>
        <li>Protein Bar & Lounge</li>
      </ul>
    </div>

    <div class="section">
      <h2>Operating Hours & Location</h2>
      <p><strong>Open Daily:</strong> 6:00 AM – 11:00 PM</p>
      <p><strong>Location:</strong> Lot 12, Jalan Fitness, 47000 Selangor, Malaysia</p>
    </div>

    <div class="section">
      <h2>Our Trainers</h2>
      <ul>
        <li><strong>Coach Aiman</strong> – Strength & Conditioning Specialist</li>
        <li><strong>Coach Farah</strong> – Certified Zumba & Yoga Instructor</li>
        <li><strong>Coach Ray</strong> – Personal Transformation Coach</li>
      </ul>
    </div>

    <div class="section testimonials">
      <h2>What Our Members Say</h2>
      <blockquote>"Joining FitZone has changed my life. I feel stronger, more confident, and inspired every day!" – Alya, 26</blockquote>
      <blockquote>"The trainers are supportive, and the environment is so welcoming!" – Rizal, 34</blockquote>
    </div>

  </div>
</body>
</html>
