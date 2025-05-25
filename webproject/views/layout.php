<?php 
require_once __DIR__ . '/../config/bootstrap.php';
if (isset($_SESSION['toast'])): ?>
    <script>
        showToast("<?= htmlspecialchars($_SESSION['toast']['message']) ?>", <?= $_SESSION['toast']['type'] === 'error' ? 'true' : 'false' ?>);
    </script>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>
