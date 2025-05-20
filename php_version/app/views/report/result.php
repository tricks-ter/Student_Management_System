<h2>Progress Report for <?php echo $student['username']; ?></h2>

<?php foreach ($grades as $title => $grade): ?>
  <p><strong><?php echo $title; ?>:</strong> <?php echo $grade; ?>%</p>
<?php endforeach; ?>

<p><strong>Average:</strong> <?php echo number_format($average, 1); ?>%</p>
<p><strong>Teacher Comment:</strong> <?php echo htmlspecialchars($comment); ?></p>
