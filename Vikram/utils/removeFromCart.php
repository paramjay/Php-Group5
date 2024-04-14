<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $car_id = $_POST['car_id'];
        // Retrieve existing cart items from the cookie or initialize an empty array
        $cart_items = isset($_COOKIE['cart_items']) ? unserialize($_COOKIE['cart_items']) : array();
        
        if(isset($_POST['car_id'])) {
            $remove_car_id = $_POST['car_id'];
            foreach ($cart_items as $key => $item) {
                if ($item['car_id'] == $remove_car_id) {
                    unset($cart_items[$key]); // Remove the item from the array
                    break; // Exit the loop after removing the item
                }
            }
            // Serialize the updated cart items array and set it back to the cookie
            setcookie("cart_items", serialize($cart_items), time() + (86400 * 30), "/");
        }


        // Serialize the cart items and set it as a cookie
        $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $HomePageURL = strstr($currentURL, "/utils", true);
        header("Location: $HomePageURL"."/cart.php");
        exit;
    }
    else{
        ?>
        <script>
            alert("Something went wrong.Try again later");
            window.history.back();
        </script>
        <?php
    }
?>