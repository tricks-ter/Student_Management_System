<h2>Register</h2>
<form method="post" action="/register/create">
  <input type="text" name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<p>Already have an account? <a href="/login">Login</a></p>
