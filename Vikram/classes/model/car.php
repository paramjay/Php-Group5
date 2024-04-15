<?php 
class Car {
    private $car_id;
    private $car_brand;
    private $car_name;
    private $car_model;
    private $car_type;
    private $car_price;
    private $car_sale_price;
    private $car_engine;
    private $car_body_style;
    private $car_capacity;
    private $car_mileage;
    private $car_description;
    private $car_mfg_year;
    private $car_odometer;
    private $car_color;
    private $car_image;
    private $car_transmission;
    private $car_driven_type;
    private $car_torque;
    private $car_power;
    private $car_safety;

    public function __construct($car_id, $car_brand, $car_name, $car_model, $car_type, $car_price, $car_sale_price, $car_engine, $car_body_style, $car_capacity, $car_mileage, $car_description, $car_mfg_year, $car_odometer, $car_color, $car_image, $car_transmission, $car_driven_type, $car_torque, $car_power, $car_safety) {
        $this->car_id = $car_id;
        $this->car_brand = $car_brand;
        $this->car_name = $car_name;
        $this->car_model = $car_model;
        $this->car_type = $car_type;
        $this->car_price = $car_price;
        $this->car_sale_price = $car_sale_price;
        $this->car_engine = $car_engine;
        $this->car_body_style = $car_body_style;
        $this->car_capacity = $car_capacity;
        $this->car_mileage = $car_mileage;
        $this->car_description = $car_description;
        $this->car_mfg_year = $car_mfg_year;
        $this->car_odometer = $car_odometer;
        $this->car_color = $car_color;
        $this->car_image = $car_image;
        $this->car_transmission = $car_transmission;
        $this->car_driven_type = $car_driven_type;
        $this->car_torque = $car_torque;
        $this->car_power = $car_power;
        $this->car_safety = $car_safety;
    }

    public function getCarId() {
        return $this->car_id;
    }

    public function setCarId($car_id) {
        $this->car_id = $car_id;
    }

    public function getCarBrand() {
        return $this->car_brand;
    }

    public function setCarBrand($car_brand) {
        $this->car_brand = $car_brand;
    }

    public function getCarName() {
        return $this->car_name;
    }

    public function setCarName($car_name) {
        $this->car_name = $car_name;
    }

    public function getCarModel() {
        return $this->car_model;
    }

    public function setCarModel($car_model) {
        $this->car_model = $car_model;
    }

    public function getCarType() {
        return $this->car_type;
    }

    public function setCarType($car_type) {
        $this->car_type = $car_type;
    }

    public function getCarPrice() {
        return $this->car_price;
    }

    public function setCarPrice($car_price) {
        $this->car_price = $car_price;
    }

    public function getCarSalePrice() {
        return $this->car_sale_price;
    }

    public function setCarSalePrice($car_sale_price) {
        $this->car_sale_price = $car_sale_price;
    }

    public function getCarEngine() {
        return $this->car_engine;
    }

    public function setCarEngine($car_engine) {
        $this->car_engine = $car_engine;
    }

    public function getCarBodyStyle() {
        return $this->car_body_style;
    }

    public function setCarBodyStyle($car_body_style) {
        $this->car_body_style = $car_body_style;
    }

    public function getCarCapacity() {
        return $this->car_capacity;
    }

    public function setCarCapacity($car_capacity) {
        $this->car_capacity = $car_capacity;
    }

    public function getCarMileage() {
        return $this->car_mileage;
    }

    public function setCarMileage($car_mileage) {
        $this->car_mileage = $car_mileage;
    }

    public function getCarDescription() {
        return $this->car_description;
    }

    public function setCarDescription($car_description) {
        $this->car_description = $car_description;
    }

    public function getCarMfgYear() {
        return $this->car_mfg_year;
    }

    public function setCarMfgYear($car_mfg_year) {
        $this->car_mfg_year = $car_mfg_year;
    }

    public function getCarOdometer() {
        return $this->car_odometer;
    }

    public function setCarOdometer($car_odometer) {
        $this->car_odometer = $car_odometer;
    }

    public function getCarColor() {
        return $this->car_color;
    }

    public function setCarColor($car_color) {
        $this->car_color = $car_color;
    }

    public function getCarImage() {
        return $this->car_image;
    }

    public function setCarImage($car_image) {
        $this->car_image = $car_image;
    }

    public function getCarTransmission() {
        return $this->car_transmission;
    }

    public function setCarTransmission($car_transmission) {
        $this->car_transmission = $car_transmission;
    }

    public function getCarDrivenType() {
        return $this->car_driven_type;
    }

    public function setCarDrivenType($car_driven_type) {
        $this->car_driven_type = $car_driven_type;
    }

    public function getCarTorque() {
        return $this->car_torque;
    }

    public function setCarTorque($car_torque) {
        $this->car_torque = $car_torque;
    }

    public function getCarPower() {
        return $this->car_power;
    }

    public function setCarPower($car_power) {
        $this->car_power = $car_power;
    }

    public function getCarSafety() {
        return $this->car_safety;
    }

    public function setCarSafety($car_safety) {
        $this->car_safety = $car_safety;
    }
}
?>