<h2>Login</h2>
<form method="post" action="/login/authenticate">
  <input type="email" name="email" placeholder="Email" required value="<?php echo $_COOKIE['remember_email'] ?? ''; ?>">
  <input type="password" name="password" placeholder="Password" required>
  <label><input type="checkbox" name="remember"> Remember Me</label>
  <button type="submit">Login</button>
</form>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<p>Don't have an account? <a href="/register">Register</a></p>
