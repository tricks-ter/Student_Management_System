<h1>Contact Us</h1>
<form method="post" action="/contact/submit">
  <label>Name</label>
  <input type="text" name="name" required>

  <label>Email</label>
  <input type="email" name="email" required>

  <label>Subject</label>
  <input type="text" name="subject" required>

  <label>Message</label>
  <textarea name="message" rows="6" required></textarea>

  <button type="submit">Send Message</button>
</form>
<?php if (isset($success)) echo "<p class='form-response' style='color:green;'>$success</p>"; ?>
