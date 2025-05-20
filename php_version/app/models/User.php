<?php

class User extends Model {
    public function getAllUsers() {
        $sql = "SELECT id, username, email, role FROM users";
        $result = $this->conn->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function updateRole($id, $role) {
        $id = intval($id);
        $role = $this->conn->real_escape_string($role);
        $this->conn->query("UPDATE users SET role = '$role' WHERE id = $id");
    }

    public function getByEmail($email) {
        $email = $this->conn->real_escape_string($email);
        $result = $this->conn->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
        return $result->fetch_assoc();
    }


    public function emailExists($email) {
        $email = $this->conn->real_escape_string($email);
        $result = $this->conn->query("SELECT id FROM users WHERE email = '$email'");
        return $result->num_rows > 0;
    }

    public function create($username, $email, $password) {
        $username = $this->conn->real_escape_string($username);
        $email = $this->conn->real_escape_string($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->conn->query("INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'User')");
    }

    public function getByRole($role) {
        $role = $this->conn->real_escape_string($role);
        $result = $this->conn->query("SELECT id, username, email FROM users WHERE role = '$role'");
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getById($id) {
        $id = intval($id);
        $result = $this->conn->query("SELECT id, username, email FROM users WHERE id = $id LIMIT 1");
        return $result->fetch_assoc();
    }





}
