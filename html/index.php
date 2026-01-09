<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Help Desk</title>
    <link href="../css/style_home.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />    
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav class="navbar">
      <div class="nav-brand">
        <img
          src="../assets/logo.png"
          alt="Student Help Desk Logo"
          class="brand-logo"
        />
        <span>Student Help Desk</span>
      </div>
      <div class="nav-links">
        <?php if(isset($_SESSION['username'])): ?>
          <!-- Logged In View -->
          <a href="profile_page.php"><i class="material-icons tiny-icon">person</i> My Profile</a>
          <a href="study_page.html"><i class="material-icons tiny-icon">school</i> Study Material</a>
          
          <div class="dropdown">
            <a href="#" class="dropbtn"><i class="material-icons tiny-icon">class</i> Faculty Details</a>
            <div class="dropdown-content">
              <a href="cse_page.html">CSE</a>
              <a href="eac_page.html">EAC</a>
              <a href="aie_page.html">AIE</a>
              <a href="ece_page.html">ECE</a>
              <a href="eee_page.html">EEE</a>
              <a href="mech_page.html">MECH</a>
            </div>
          </div>
          
          <a href="feedback_page.html"><i class="material-icons tiny-icon">feedback</i> Feedback</a>
          <a href="../server/logout.php" class="btn-login" style="background-color: #d9534f; color: white !important;">Logout</a>
        <?php else: ?>
          <!-- Guest View -->
          <a href="#about"><i class="material-icons tiny-icon">info</i> About</a>
          <a href="#services"><i class="material-icons tiny-icon">design_services</i> Services</a>
          <a href="feedback_page.html"><i class="material-icons tiny-icon">feedback</i> Feedback</a>
          <a href="login_page.html" class="btn-login"><i class="material-icons tiny-icon">login</i> Login</a>
        <?php endif; ?>
      </div>
    </nav>

    <?php if(!isset($_SESSION['username'])): ?>
    <header class="hero-section">
    <?php else: ?>
    <header class="hero-section" style="height: 60vh; min-height: 400px;">
    <?php endif; ?>
      <div class="hero-content">
        <?php if(isset($_SESSION['username'])): ?>
          <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['firstName']); ?>!</h1>
          <p>Access your notes, faculty details, and study resources below.</p>
          <a href="#services" class="btn-cta">Go to Dashboard</a>
        <?php else: ?>
          <h1>Welcome to Student's Desk</h1>
          <p>
            Your one-stop destination for class notes, study materials, and
            faculty information.
          </p>
          <a href="signup_page.html" class="btn-cta">Get Started</a>
        <?php endif; ?>
      </div>
    </header>

    <main>
      <section id="about" class="section-container">
        <div class="section-header">
          <h2>About Us</h2>
          <div class="underline"></div>
        </div>
        <div class="content-wrapper">
          <p>
            At <strong>Amrita Vishwa Vidyapeetham</strong>, we are dedicated to
            empowering students with easy access to academic resources. Our
            platform bridges the gap between students and the materials they
            need to excel.
          </p>
          <p>
            Built by students, for students. We understand the challenges of
            finding the right notes and study aids. Our mission is to foster a
            collaborative learning environment where resources are shared freely
            and efficiently.
          </p>
        </div>
      </section>

      <section id="services" class="section-container bg-light">
        <div class="section-header">
          <h2>Our Services</h2>
          <div class="underline"></div>
        </div>
        <div class="cards-grid">
          <div class="card">
            <i class="material-icons card-icon">menu_book</i>
            <h3>Study Material</h3>
            <p>
              Access comprehensive notes and study guides for all first-year
              branches. Simplify your learning process and score better.
            </p>
          </div>
          <div class="card">
            <i class="material-icons card-icon">school</i>
            <h3>Faculty Support</h3>
            <p>
              Get accurate contact details for faculty members. We ensure you
              have the right channels for academic guidance and emergency
              queries.
            </p>
          </div>
          <div class="card">
            <i class="material-icons card-icon">group</i>
            <h3>Student Community</h3>
            <p>
              Join a network of motivated students. Share knowledge, collaborate
              on projects, and grow together in your academic journey.
            </p>
          </div>
        </div>
      </section>

    <footer class="footer">
      <p>
        ICTS © Bengaluru Campus - 2023 | Built with
        <i class="material-icons tiny-icon">favorite</i> by Student Team
      </p>
    </footer>
  </body>
</html>
