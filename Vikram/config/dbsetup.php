<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS db_vikram";
    $conn->exec($sql);
    echo "Database created successfully<br>";

    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=db_vikram", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tbl_users table
    $sql = "CREATE TABLE IF NOT EXISTS tbl_users (
        user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(50) NOT NULL,
        user_email VARCHAR(50) NOT NULL,
        user_password VARCHAR(50) NOT NULL,
        user_type ENUM('Admin', 'Buyer') NOT NULL,
        user_address VARCHAR(255),
        user_postal_code VARCHAR(20),
        user_country VARCHAR(100)
    )";
    $conn->exec($sql);
    echo "Table tbl_users created successfully<br>";

    // Create tbl_cars table
    $sql = "CREATE TABLE IF NOT EXISTS tbl_cars (
        car_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        car_brand VARCHAR(100) NOT NULL,
        car_name VARCHAR(100) NOT NULL,
        car_model VARCHAR(100) NOT NULL,
        car_type ENUM('petrol', 'diesel','electric') NOT NULL,
        car_price DECIMAL(10, 2) NOT NULL,
        car_sale_price DECIMAL(10, 2),
        car_engine VARCHAR(50),
        car_body_style VARCHAR(50),
        car_capacity INT(11),
        car_mileage DECIMAL(5, 2),
        car_description TEXT,
        car_mfg_year INT(4),
        car_odometer DECIMAL(10, 2),
        car_color VARCHAR(50),
        car_image VARCHAR(255),
        car_transmission VARCHAR(50),
        car_driven_type VARCHAR(50),
        car_torque VARCHAR(100),
        car_power VARCHAR(100),
        car_safety VARCHAR(50)
    )";
    $conn->exec($sql);
    echo "Table tbl_cars created successfully<br>";

    // Create tbl_invoice table
    $sql = "CREATE TABLE IF NOT EXISTS tbl_invoice (
        invoice_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_id INT(11),
        invoice_payment_mode VARCHAR(50),
        invoice_tax DECIMAL(10, 2) DEFAULT 0.13,
        invoice_total DECIMAL(10, 2),
        invoice_date DATE,
        FOREIGN KEY (user_id) REFERENCES tbl_users(user_id)
    )";
    $conn->exec($sql);
    echo "Table tbl_invoice created successfully<br>";

    // Create tbl_cart table
    $sql = "CREATE TABLE IF NOT EXISTS tbl_cart (
        invoice_id INT(11),
        car_id INT(11),
        car_quantity INT(11),
        FOREIGN KEY (invoice_id) REFERENCES tbl_invoice(invoice_id),
        FOREIGN KEY (car_id) REFERENCES tbl_cars(car_id)
    )";
    $conn->exec($sql);
    echo "Table tbl_cart created successfully<br>";

    // Generate sample data for tbl_users
    $stmt = $conn->prepare("INSERT INTO tbl_users (user_name, user_email, user_password, user_type, user_address, user_postal_code, user_country)
    VALUES (:user_name, :user_email, :user_password, :user_type, :user_address, :user_postal_code, :user_country)");
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':user_email', $user_email);
    $stmt->bindParam(':user_password', $user_password);
    $stmt->bindParam(':user_type', $user_type);
    $stmt->bindParam(':user_address', $user_address);
    $stmt->bindParam(':user_postal_code', $user_postal_code);
    $stmt->bindParam(':user_country', $user_country);

    $usersData = [
        ['John Doe', 'john.doe@example.com', 'password123', 'Admin', '123 Main St', '12345', 'USA'],
        ['Jane Smith', 'jane.smith@example.com', 'pass456', 'Buyer', '456 Elm St', '54321', 'Canada']
    ];

    foreach ($usersData as $userData) {
        list($user_name, $user_email, $user_password, $user_type, $user_address, $user_postal_code, $user_country) = $userData;
        $stmt->execute();
    }
    echo "Sample data inserted into tbl_users successfully<br>";

    // Generate sample data for tbl_cars
    $stmt = $conn->prepare("INSERT INTO tbl_cars (car_brand, car_name, car_model, car_type, car_price, car_sale_price, car_engine, car_body_style, car_capacity, car_mileage, car_description, car_mfg_year, car_odometer, car_color, car_image, car_transmission, car_driven_type, car_torque, car_power, car_safety)
    VALUES (:car_brand, :car_name, :car_model, :car_type, :car_price, :car_sale_price, :car_engine, :car_body_style, :car_capacity, :car_mileage, :car_description, :car_mfg_year, :car_odometer, :car_color, :car_image, :car_transmission, :car_driven_type, :car_torque, :car_power, :car_safety)");
    $stmt->bindParam(':car_brand', $car_brand);
    $stmt->bindParam(':car_name', $car_name);
    $stmt->bindParam(':car_model', $car_model);
    $stmt->bindParam(':car_type', $car_type);
    $stmt->bindParam(':car_price', $car_price);
    $stmt->bindParam(':car_sale_price', $car_sale_price);
    $stmt->bindParam(':car_engine', $car_engine);
    $stmt->bindParam(':car_body_style', $car_body_style);
    $stmt->bindParam(':car_capacity', $car_capacity);
    $stmt->bindParam(':car_mileage', $car_mileage);
    $stmt->bindParam(':car_description', $car_description);
    $stmt->bindParam(':car_mfg_year', $car_mfg_year);
    $stmt->bindParam(':car_odometer', $car_odometer);
    $stmt->bindParam(':car_color', $car_color);
    $stmt->bindParam(':car_image', $car_image);
    $stmt->bindParam(':car_transmission', $car_transmission);
    $stmt->bindParam(':car_driven_type', $car_driven_type);
    $stmt->bindParam(':car_torque', $car_torque);
    $stmt->bindParam(':car_power', $car_power);
    $stmt->bindParam(':car_safety', $car_safety);

    $carsData = [
        ['Toyota', 'Camry', '2022', 'petrol', 25000, 23000, '2.5L V6', 'Sedan', 5, 30.5, 'A comfortable sedan for daily use.', 2022, 5000, 'Black', 'toyota-camry.jpg', 'Automatic', 'FWD', '200 lb-ft', '200 hp', 'Advanced safety features'],
        ['Honda', 'Civic', '2023', 'petrol', 22000, 21000, '2.0L I4', 'Hatchback', 5, 35.5, 'A stylish hatchback with great fuel efficiency.', 2023, 3000, 'White', 'honda-civic.jpg', 'CVT', 'FWD', '180 lb-ft', '180 hp', 'Multiple airbags'],       
        ['Toyota', 'Corolla', '2022', 'petrol', 22000, 21000, '1.8L I4', 'Sedan', 5, 33.5, 'A reliable sedan with good fuel efficiency.', 2022, 4000, 'Silver', 'toyota-corolla.jpg', 'Automatic', 'FWD', '160 lb-ft', '140 hp', 'Lane departure warning system'],
        ['Ford', 'Mustang', '2023', 'petrol', 35000, 32000, '5.0L V8', 'Coupe', 4, 25.0, 'An iconic American muscle car.', 2023, 2000, 'Red', 'ford-mustang.jpg', 'Manual', 'RWD', '420 lb-ft', '460 hp', 'Brembo brakes'],
        ['Mercedes-Benz', 'GLE', '2022', 'diesel', 60000, 55000, '3.0L V6', 'SUV', 7, 28.0, 'A luxurious and spacious SUV.', 2022, 5000, 'Blue', 'mercedes-gle.jpg', 'Automatic', 'AWD', '450 lb-ft', '360 hp', 'Adaptive cruise control'],
        ['BMW', '3 Series', '2023', 'petrol', 40000, 38000, '2.0L I4', 'Sedan', 5, 30.0, 'A sporty sedan with excellent handling.', 2023, 3000, 'Black', 'bmw-3series.jpg', 'Automatic', 'RWD', '258 lb-ft', '255 hp', 'Harman Kardon sound system'],
        ['Chevrolet', 'Silverado', '2022', 'diesel', 45000, 42000, '6.6L V8', 'Pickup Truck', 5, 18.0, 'A powerful and capable pickup truck.', 2022, 6000, 'White', 'chevrolet-silverado.jpg', 'Automatic', '4WD', '910 lb-ft', '445 hp', 'Trailer sway control']
    ];

    foreach ($carsData as $carData) {
        list($car_brand, $car_name, $car_model, $car_type, $car_price, $car_sale_price, $car_engine, $car_body_style, $car_capacity, $car_mileage, $car_description, $car_mfg_year, $car_odometer, $car_color, $car_image, $car_transmission, $car_driven_type, $car_torque, $car_power, $car_safety) = $carData;
        $stmt->execute();
    }
    echo "Sample data inserted into tbl_cars successfully<br>";

    // Generate sample data for tbl_invoice
    $stmt = $conn->prepare("INSERT INTO tbl_invoice (user_id, invoice_payment_mode, invoice_tax, invoice_total, invoice_date)
    VALUES (:user_id, :invoice_payment_mode, :invoice_tax, :invoice_total, :invoice_date)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':invoice_payment_mode', $invoice_payment_mode);
    $stmt->bindParam(':invoice_tax', $invoice_tax);
    $stmt->bindParam(':invoice_total', $invoice_total);
    $stmt->bindParam(':invoice_date', $invoice_date);

    $invoiceData = [
        [1, 'Credit Card', 150, 2650, '2024-04-12'],
        [2, 'PayPal', 120, 2120, '2024-04-10']
    ];

    foreach ($invoiceData as $data) {
        list($user_id, $invoice_payment_mode, $invoice_tax, $invoice_total, $invoice_date) = $data;
        $stmt->execute();
    }
    echo "Sample data inserted into tbl_invoice successfully<br>";

    // Generate sample data for tbl_cart
    $stmt = $conn->prepare("INSERT INTO tbl_cart (invoice_id, car_id, car_quantity)
    VALUES (:invoice_id, :car_id, :car_quantity)");
    $stmt->bindParam(':invoice_id', $invoice_id);
    $stmt->bindParam(':car_id', $car_id);
    $stmt->bindParam(':car_quantity', $car_quantity);

    $cartData = [
        [1, 1, 2],
        [2, 2, 1]
    ];

    foreach ($cartData as $data) {
        list($invoice_id, $car_id, $car_quantity) = $data;
        $stmt->execute();
    }
    echo "Sample data inserted into tbl_cart successfully<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>
