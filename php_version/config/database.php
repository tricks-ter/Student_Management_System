<?php

class Database {
    public static function getConnection() {
        $conn = new mysqli("localhost", "root", "", "edusystem");
        if ($conn->connect_error) {
            die("DB connection failed");
        }
        return $conn;
    }
}
