<h1>Export User Data</h1>
<p>Click the button below to download all user records as a CSV file.</p>
<a href="/export/csv" class="cta-btn">Download CSV</a>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo htmlspecialchars($user['username']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo htmlspecialchars($user['role']); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
