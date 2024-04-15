<?php
require_once 'config/dbinit.php';

class User {
    private $db;

    // Constructor to initialize the Database object
    public function __construct($db) {
        $this->db = $db;
    }

    // Method to get all users from the database
    public function getAllUsers() {
        $conn = $this->db->getConnection();
        $stmt = $conn->query("SELECT * FROM tbl_users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get user details by ID
    public function getUserDetailsById($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update user details by ID
    public function updateUserDetailsById($id, $newDetails) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE tbl_users SET user_name = :user_name, user_email = :user_email, user_type = :user_type WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_name', $newDetails['user_name']);
        $stmt->bindParam(':user_email', $newDetails['user_email']);
        $stmt->bindParam(':user_type', $newDetails['user_type']);
        return $stmt->execute();
    }

    // Method to delete user details by ID
    public function deleteUserDetailsById($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("DELETE FROM tbl_users WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
