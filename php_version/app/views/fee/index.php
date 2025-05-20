<h1>Fee Payment Dashboard</h1>

<div class="invoice-box">
  <p><strong>Name:</strong> <?php echo $name; ?></p>
  <p><strong>Student ID:</strong> <?php echo $studentId; ?></p>
  <p><strong>Semester:</strong> <?php echo $semester; ?></p>
  <p><strong>Total Fee:</strong> ৳<?php echo $totalFee; ?></p>
  <p><strong>Paid:</strong> ৳<?php echo $paidAmount; ?></p>
  <p><strong>Due Amount:</strong> ৳<?php echo $dueAmount; ?></p>
  <p><strong>Late Fee:</strong> ৳<?php echo $lateFee; ?></p>
  <p><strong>Total Due:</strong> ৳<?php echo $totalDue; ?></p>
</div>

<?php if ($paidAmount < $totalFee): ?>
  <form method="post" action="/fee/pay" class="payment-section">
    <label for="method">Choose Payment Method:</label>
    <select name="method" id="method">
      <option value="card">Credit/Debit Card</option>
      <option value="upi">UPI</option>
      <option value="netbanking">Net Banking</option>
    </select>
    <button type="submit">Pay Now</button>
  </form>
<?php else: ?>
  <p class="form-response" style="color:green;">Fees are fully paid.</p>
<?php endif; ?>
