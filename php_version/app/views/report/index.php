<h1>Progress Report Generator</h1>

<form method="post" action="/report/generate">
  <label>Select Student:</label>
  <select name="student_id" required>
    <?php foreach ($students as $student): ?>
      <option value="<?php echo $student['id']; ?>"><?php echo $student['username']; ?></option>
    <?php endforeach; ?>
  </select>

  <label>Teacher Comment:</label>
  <textarea name="comment" rows="4" required></textarea>

  <button type="submit">Generate Report</button>
</form>
