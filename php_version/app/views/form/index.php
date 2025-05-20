<h1>Form Validation</h1>
<form method="post" action="/form/submit">
  <label>Username</label>
  <input type="text" name="username" value="<?php echo $data['username'] ?? ''; ?>">
  <?php if (!empty($errors['username'])) echo "<span class='error'>{$errors['username']}</span>"; ?>

  <label>Email</label>
  <input type="email" name="email" value="<?php echo $data['email'] ?? ''; ?>">
  <?php if (!empty($errors['email'])) echo "<span class='error'>{$errors['email']}</span>"; ?>

  <label>Password</label>
  <input type="password" name="password">
  <?php if (!empty($errors['password'])) echo "<span class='error'>{$errors['password']}</span>"; ?>

  <button type="submit">Submit</button>
</form>

<?php if (isset($success)) echo "<p class='form-response' style='color:green;'>$success</p>"; ?>
