<?php
require_once __DIR__ ."/db.php";
$tables = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        password VARCHAR(255),
        phone VARCHAR(20),
        address TEXT,
        dob DATE,
        role ENUM('admin', 'student', 'teacher') DEFAULT 'student',
        is_verified TINYINT DEFAULT 0,
        verification_code VARCHAR(10),
        is_reset TINYINT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        student_id VARCHAR(50) UNIQUE,
        academic_year VARCHAR(10),
        department VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )",
    "CREATE TABLE IF NOT EXISTS courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(10) UNIQUE,
        title VARCHAR(100),
        credits INT,
        department VARCHAR(100)
    )",
    "CREATE TABLE IF NOT EXISTS registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT,
        course_id INT,
        semester VARCHAR(10),
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        FOREIGN KEY (student_id) REFERENCES students(id),
        FOREIGN KEY (course_id) REFERENCES courses(id)
    )",
    "CREATE TABLE IF NOT EXISTS grades (
        id INT AUTO_INCREMENT PRIMARY KEY,
        registration_id INT,
        grade VARCHAR(5),
        feedback TEXT,
        FOREIGN KEY (registration_id) REFERENCES registrations(id)
    )",
    "CREATE TABLE IF NOT EXISTS timetable (
        id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT,
        day_of_week VARCHAR(10),
        start_time TIME,
        end_time TIME,
        room VARCHAR(50),
        FOREIGN KEY (course_id) REFERENCES courses(id)
    )",
    "CREATE TABLE IF NOT EXISTS fees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT,
        amount DECIMAL(10,2),
        status ENUM('paid', 'unpaid') DEFAULT 'unpaid',
        due_date DATE,
        paid_at DATE,
        FOREIGN KEY (student_id) REFERENCES students(id)
    )"
];

foreach ($tables as $query) {
    if (!mysqli_query($conn, $query)) {
        die("Table creation failed: " . mysqli_error($conn));
    }
}
?>