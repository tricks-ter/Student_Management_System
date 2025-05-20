<h1>Student Gradebook</h1>
<table id="gradebookTable">
  <thead>
    <tr>
      <th>Student</th>
      <?php foreach ($assignments as $a): ?>
        <th><?php echo $a['name'] . " (" . ($a['weight'] * 100) . "%)"; ?></th>
      <?php endforeach; ?>
      <th>Total (%)</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $student): ?>
      <tr>
        <td><?php echo $student['username']; ?></td>
        <?php $total = 0; ?>
        <?php foreach ($assignments as $a): ?>
          <?php $score = rand(60, 100); ?>
          <td><?php echo $score; ?></td>
          <?php $total += $score * $a['weight']; ?>
        <?php endforeach; ?>
        <td><?php echo number_format($total, 1); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
