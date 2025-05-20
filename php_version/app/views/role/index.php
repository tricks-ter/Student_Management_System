<h1>Role-Based Access Management</h1>
<table>
  <thead>
    <tr>
      <th>User ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Current Role</th>
      <th>Change Role</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo htmlspecialchars($user['username']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo htmlspecialchars($user['role']); ?></td>
        <td>
          <form method="post" action="/role/update">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <select name="new_role">
              <option value="Admin" <?php if($user['role'] === 'Admin') echo 'selected'; ?>>Admin</option>
              <option value="Editor" <?php if($user['role'] === 'Editor') echo 'selected'; ?>>Editor</option>
              <option value="User" <?php if($user['role'] === 'User') echo 'selected'; ?>>User</option>
            </select>
            <button type="submit">Update</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
