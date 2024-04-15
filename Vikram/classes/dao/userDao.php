<?php
require_once 'config/dbinit.php';
require_once 'classes/model/user.php';

class UserDAO
{
    private $db;

    // Constructor to initialize the Database object
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Method to get all users from the database
    public function getAllUsers($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_id != :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function EmailChecker($email)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true; // User exists
        } else {
            return false; // User does not exist
        }
    }


    // Method to get user details by ID
    public function getUserDetailsById($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function validateInput($input)
    {
        $validatedInput = trim($input);
        $validatedInput = stripslashes($validatedInput);
        $validatedInput = htmlspecialchars($validatedInput);
        return $validatedInput;
    }


    // Method to update user details by ID
    public function updateUserDetailsById($id, $newDetails)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE tbl_users SET user_name = :user_name, user_email = :user_email, user_type = :user_type, user_address = :user_address, user_postal_code = :user_postal_code, user_country = :user_country WHERE user_id = :id");
        $stmt->bindParam(':id', $id);

        // Modify these lines to pass variables by reference
        $userName = $newDetails->getUserName();
        $userEmail = $newDetails->getUserEmail();
        $userType = $newDetails->getUserType();
        $userAddress = $newDetails->getUserAddress();
        $userPostalCode = $newDetails->getUserPostalCode();
        $userCountry = $newDetails->getUserCountry();

        $stmt->bindParam(':user_name', $userName);
        $stmt->bindParam(':user_email', $userEmail);
        $stmt->bindParam(':user_type', $userType);
        $stmt->bindParam(':user_address', $userAddress);
        $stmt->bindParam(':user_postal_code', $userPostalCode);
        $stmt->bindParam(':user_country', $userCountry);
        return $stmt->execute();
    }


    // Method to delete user details by ID
    public function deleteUserDetailsById($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("DELETE FROM tbl_users WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Method to add a new user to the database
    public function addUser($user)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO tbl_users (user_name, user_email, user_password, user_type, user_address, user_postal_code, user_country) VALUES (:user_name, :user_email, :user_password, :user_type, :user_address, :user_postal_code, :user_country)");

        // Modify these lines to pass variables by reference
        $userName = $user->getUserName();
        $userEmail = $user->getUserEmail();
        $userPassword = $user->getUserPassword();
        $userType = $user->getUserType();
        $userAddress = $user->getUserAddress();
        $userPostalCode = $user->getUserPostalCode();
        $userCountry = $user->getUserCountry();

        $stmt->bindParam(':user_name', $userName);
        $stmt->bindParam(':user_email', $userEmail);
        $stmt->bindParam(':user_password', $userPassword);
        $stmt->bindParam(':user_type', $userType);
        $stmt->bindParam(':user_address', $userAddress);
        $stmt->bindParam(':user_postal_code', $userPostalCode);
        $stmt->bindParam(':user_country', $userCountry);
        return $stmt->execute();
    }


}
?>