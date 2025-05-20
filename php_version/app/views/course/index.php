<h1>Course Registration</h1>

<form method="post" action="/course/register">
  <div class="course-list">
    <?php foreach ($courses as $course): ?>
      <div class="course-item">
        <label>
          <input type="checkbox" name="course[]" value="<?php echo $course['code']; ?>">
          <strong><?php echo $course['code']; ?></strong> - <?php echo $course['name']; ?> (<?php echo $course['credits']; ?> credits)
        </label>
      </div>
    <?php endforeach; ?>
  </div>
  <button type="submit">Submit Registration</button>
</form>

<?php if (isset($success)) echo "<p class='form-response' style='color:green;'>$success</p>"; ?>
