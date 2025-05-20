<h1>Weekly Class Timetable</h1>

<div style="margin-bottom: 1em;">
  <button onclick="toggleView()">Toggle View</button>
  <span id="nextClass" style="float: right;"></span>
</div>

<div class="timetable" id="gridView">
  <div class="header">Time</div>
  <?php foreach ($days as $day): ?>
    <div class="header"><?php echo $day; ?></div>
  <?php endforeach; ?>

  <?php foreach ($slots as $slot): ?>
    <div class="header"><?php echo $slot['time']; ?></div>
    <?php foreach ($days as $day): ?>
      <?php
        $entry = $slot[$day];
        $subject = $entry['subject'];
        $room = $entry['room'];
        $class = strtolower(str_replace(' ', '', $subject));
      ?>
      <div class="subject <?php echo $class; ?>">
        <?php echo $subject !== 'Free' ? "$subject<br><small>Room: $room</small>" : 'Free'; ?>
      </div>
    <?php endforeach; ?>
  <?php endforeach; ?>
</div>

<div id="listView" style="display: none;">
  <?php foreach ($slots as $slot): ?>
    <div class="list-slot">
      <strong><?php echo $slot['time']; ?></strong>
      <ul>
        <?php foreach ($days as $day): ?>
          <?php
            $entry = $slot[$day];
            $subject = $entry['subject'];
            $room = $entry['room'];
          ?>
          <li><?php echo "$day: $subject" . ($room ? " (Room: $room)" : ""); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endforeach; ?>
</div>

<script>
function toggleView() {
  const grid = document.getElementById("gridView");
  const list = document.getElementById("listView");
  grid.style.display = grid.style.display === "none" ? "grid" : "none";
  list.style.display = list.style.display === "none" ? "block" : "none";
}

// Dummy countdown (shows next class in 00:10:00)
setInterval(() => {
  const timer = document.getElementById('nextClass');
  const date = new Date();
  const minutes = 9 - (date.getMinutes() % 10);
  const seconds = 59 - date.getSeconds();
  timer.textContent = "Next class in " + minutes.toString().padStart(2, '0') + ":" + seconds.toString().padStart(2, '0');
}, 1000);
</script>
