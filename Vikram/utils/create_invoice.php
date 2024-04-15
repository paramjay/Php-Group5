<?php
 require('../config/dbinit.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invoice_payment_mode = $_POST['invoice_payment_mode'];
    $invoice_total = $_POST['invoice_total'];
    $invoice_tax = $_POST['invoice_tax'];
    $user_id = $_POST['user_id'];
    // $invoice_total_due = $_POST['invoice_total_due'];
    
    $currentDate = date("Y-m-d");
    echo $currentDate;

    $sql = "INSERT INTO tbl_invoice (user_id, invoice_payment_mode, invoice_tax, invoice_total, invoice_date)
    VALUES (:user_id, :invoice_payment_mode, :invoice_tax, :invoice_total, :invoice_date)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':invoice_payment_mode', $invoice_payment_mode);
    $stmt->bindParam(':invoice_total', $invoice_total);
    $stmt->bindParam(':invoice_tax', $invoice_tax);
    $stmt->bindParam(':invoice_date', $currentDate);
    $stmt->execute();

    $invoice_id = $conn->lastInsertId(); // Get the ID of the inserted invoice record

    $cart_items = unserialize($_COOKIE['cart_items']);
    foreach ($cart_items as $key => $item) {
        $sql = "INSERT INTO tbl_cart (invoice_id, car_id, car_quantity)
        VALUES (:invoice_id, :car_id, :car_quantity)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':invoice_id', $invoice_id);
        $stmt->bindParam(':car_id', $item['car_id']);
        $stmt->bindParam(':car_quantity', $item['quantity']);
        $stmt->execute();
    }
        
    setcookie("cart_items", "", time() - 3600, "/");// remove cookie that stores cart data

    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $HomePageURL = strstr($currentURL, "/utils", true);
    header("Location: $HomePageURL"."/invoice.php?invoice_id=".$invoice_id);
    exit;

}
?>