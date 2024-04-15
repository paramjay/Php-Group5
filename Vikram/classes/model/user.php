<?php 
class User {
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_password;
    private $user_type;
    private $user_address;
    private $user_postal_code;
    private $user_country;

    public function __construct($user_id, $user_name, $user_email, $user_password, $user_type, $user_address, $user_postal_code, $user_country) {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->user_password = $user_password;
        $this->user_type = $user_type;
        $this->user_address = $user_address;
        $this->user_postal_code = $user_postal_code;
        $this->user_country = $user_country;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function setUserName($user_name) {
        $this->user_name = $user_name;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function setUserEmail($user_email) {
        $this->user_email = $user_email;
    }

    public function getUserPassword() {
        return $this->user_password;
    }

    public function setUserPassword($user_password) {
        $this->user_password = $user_password;
    }

    public function getUserType() {
        return $this->user_type;
    }

    public function setUserType($user_type) {
        $this->user_type = $user_type;
    }

    public function getUserAddress() {
        return $this->user_address;
    }

    public function setUserAddress($user_address) {
        $this->user_address = $user_address;
    }

    public function getUserPostalCode() {
        return $this->user_postal_code;
    }

    public function setUserPostalCode($user_postal_code) {
        $this->user_postal_code = $user_postal_code;
    }

    public function getUserCountry() {
        return $this->user_country;
    }

    public function setUserCountry($user_country) {
        $this->user_country = $user_country;
    }
}

?>