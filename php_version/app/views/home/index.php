<header class="landing-hero">
  <div class="hero-content">
    <h1>Welcome to EduSystem</h1>
    <p>Your all-in-one education management platform</p>
    <?php if (!isset($_SESSION['user_id'])): ?>
      <a href="/register" class="cta-btn">Get Started</a>
    <?php else: ?>
      <a href="/dashboard" class="cta-btn">Go to Dashboard</a>
    <?php endif; ?>
  </div>
</header>

<section class="features">
  <h2>Key Features</h2>
  <div class="feature-grid">
    <div class="feature-item">
      <h3>Student Profiles</h3>
      <p>Manage academic records and contact info.</p>
    </div>
    <div class="feature-item">
      <h3>Course Registration</h3>
      <p>Choose classes with real-time schedule checks.</p>
    </div>
    <div class="feature-item">
      <h3>Grade Tracking</h3>
      <p>Live updates on scores and progress reports.</p>
    </div>
  </div>
</section>

<section class="testimonials">
  <h2>What Users Say</h2>
  <div class="testimonial">
    <p>"EduSystem simplified our entire school management!"</p>
    <span>- Ms. Anita, Principal</span>
  </div>
  <div class="testimonial">
    <p>"I can now manage my timetable and grades from one place."</p>
    <span>- Rahul, Student</span>
  </div>
</section>

<footer class="footer">
  <p>&copy; 2025 EduSystem. All rights reserved.</p>
</footer>
