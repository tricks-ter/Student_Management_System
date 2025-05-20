<?php

class ContactMessage extends Model {
    public function save($name, $email, $subject, $message) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        $subject = $this->conn->real_escape_string($subject);
        $message = $this->conn->real_escape_string($message);

        $this->conn->query("INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')");
    }
}
