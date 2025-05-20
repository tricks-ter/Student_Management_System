<?php

class TimetableController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
        $slots = [
            ['time' => '9:00–10:00', 'Mon' => ['subject' => 'Math', 'room' => 'A101'], 'Tue' => ['subject' => 'Physics', 'room' => 'B201'], 'Wed' => ['subject' => 'Math', 'room' => 'A101'], 'Thu' => ['subject' => 'Chemistry', 'room' => 'C102'], 'Fri' => ['subject' => 'English', 'room' => 'D301']],
            ['time' => '10:00–11:00', 'Mon' => ['subject' => 'English', 'room' => 'D301'], 'Tue' => ['subject' => 'Biology', 'room' => 'C110'], 'Wed' => ['subject' => 'Chemistry', 'room' => 'C102'], 'Thu' => ['subject' => 'Math', 'room' => 'A101'], 'Fri' => ['subject' => 'Physics', 'room' => 'B201']],
            ['time' => '11:00–12:00', 'Mon' => ['subject' => 'Physics', 'room' => 'B201'], 'Tue' => ['subject' => 'English', 'room' => 'D301'], 'Wed' => ['subject' => 'Free', 'room' => ''], 'Thu' => ['subject' => 'Free', 'room' => ''], 'Fri' => ['subject' => 'Chemistry', 'room' => 'C102']],
            ['time' => '1:00–2:00', 'Mon' => ['subject' => 'Biology', 'room' => 'C110'], 'Tue' => ['subject' => 'Math', 'room' => 'A101'], 'Wed' => ['subject' => 'English', 'room' => 'D301'], 'Thu' => ['subject' => 'Physics', 'room' => 'B201'], 'Fri' => ['subject' => 'Free', 'room' => '']],
            ['time' => '2:00–3:00', 'Mon' => ['subject' => 'Free', 'room' => ''], 'Tue' => ['subject' => 'Chemistry', 'room' => 'C102'], 'Wed' => ['subject' => 'Biology', 'room' => 'C110'], 'Thu' => ['subject' => 'English', 'room' => 'D301'], 'Fri' => ['subject' => 'Math', 'room' => 'A101']]
        ];

        $this->view('timetable/index', ['days' => $days, 'slots' => $slots]);
    }
}
