<?php
require_once 'config/dbinit.php';

class CarDAO {
    private $db;

    // Constructor to initialize the Database object
    public function __construct($db) {
        $this->db = $db;
    }

    // Method to get all cars from the database
    public function getAllCars() {
        $conn = $this->db->getConnection();
        $stmt = $conn->query("SELECT * FROM tbl_cars");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get car details by ID
    public function getCarDetailsById($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_cars WHERE car_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update car details by ID
    public function updateCarDetailsById($id, $newDetails) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE tbl_cars SET car_brand = :brand, car_type = :type, car_body_style = :body_style WHERE car_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':brand', $newDetails['brand']);
        $stmt->bindParam(':type', $newDetails['type']);
        $stmt->bindParam(':body_style', $newDetails['body_style']);
        return $stmt->execute();
    }

    // Method to delete car details by ID
    public function deleteCarDetailsById($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("DELETE FROM tbl_cars WHERE car_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
