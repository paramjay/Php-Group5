<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = $_POST['quantity'];
    $car_id = $_POST['car_id'];
    // Retrieve existing cart items from the cookie or initialize an empty array
    $cart_items = isset($_COOKIE['cart_items']) ? unserialize($_COOKIE['cart_items']) : array();
    // Add the new item to the cart
    $cart_items[] = array(
        'car_id' => $car_id,
        'quantity' => $quantity
    );
    // Serialize the cart items and set it as a cookie
    // echo $cart_items;
    setcookie("cart_items", serialize($cart_items), time() + (86400 * 30), "/");
    header("Location: checkoutForm.php");
    exit;
}
else{
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}

?>