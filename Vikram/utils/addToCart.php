<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = $_POST['quantity'];
    $car_id = $_POST['car_id'];
    // Retrieve existing cart items from the cookie or initialize an empty array
    $cart_items = isset($_COOKIE['cart_items']) ? unserialize($_COOKIE['cart_items']) : array();

    if (empty($cart_items)) {
        // Add the new item to the cart
        $cart_items[] = array(
            'car_id' => $car_id,
            'quantity' => $quantity
        );
    } else {
        foreach ($cart_items as $key => $item) {
            if ($item['car_id'] == $car_id) {
                // Update the quantity of the item
                $cart_items[$key]['quantity'] += $quantity;
                break;
            } else {
                // Add the new item to the cart
                $cart_items[] = array(
                    'car_id' => $car_id,
                    'quantity' => $quantity
                );
            }
        }
    }

    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";//get whole URL
    $HomePageURL = strstr($currentURL, "/utils", true);

    // Serialize the cart items and set it as a cookie
    setcookie("cart_items", serialize($cart_items), time() + (86400 * 30), "/");
    echo "cookie" . $_COOKIE['cart_items'];
    header("Location: $HomePageURL" . "/cart.php");
} else {
    ?>
    <script>
        alert("Something went wrong,Try Later");
        window.history.back();
    </script>
    <?php
}
?>