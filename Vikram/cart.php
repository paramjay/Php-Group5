<?php
require ('config/dbinit.php');

// Instantiate the Database class
$db = new Database();

// Get the PDO connection object
$conn = $db->getConnection();
$car_items_data = null;
$subtotal = 0;
if (isset($_COOKIE['cart_items'])) {
    $cart_items = unserialize($_COOKIE['cart_items']);
    if (!empty($cart_items)) {
        $car_ids_sql = "";
        foreach ($cart_items as $item) {
            $car_ids_sql .= ":car_id" . $item['car_id'] . ",";
        }
        $car_ids_sql = substr($car_ids_sql, 0, -1); // remove last comma(,),
        // $car_total_sql = substr($car_total_sql, 0, -1); 

        $sql = "SELECT car_id,car_name,car_brand,car_sale_price,car_price,car_type,
        car_model,car_body_style,car_image FROM tbl_cars WHERE 
        car_id in (" . $car_ids_sql . ")";
        $stmt = $conn->prepare($sql);

        foreach ($cart_items as $item) {
            $stmt->bindParam(':car_id' . $item['car_id'], $item['car_id'], PDO::PARAM_INT);
        }

        $stmt->execute();
        $car_items_data = $stmt->fetchAll();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <?php
    require ('layouts/commonHead.php');
    require ('function.php');
    $user_data = check_login($conn);

    ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">
    <?php
    require ('layouts/header.php');
    ?>

    <section id="cart-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
            <div class="col-md-6 col-sm-12">
                <div class="text-content offset-4 padding-medium">
                    <br />
                    <h2 class="display-2 pb-5 text-uppercas text-light">Shopping Cart</h2>
                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="row m-2">
        <div class="col-md-8 m-auto">
            <h2 class=" pb-2">In your Cart:-</h2>
        </div>

        <div class="col-md-3 "> </div>
    </div>
    <div class="row m-2 ">
        <div class="col-md-8 m-auto">
            <div class=" card card-body fs-6">
                <?php
                if ($car_items_data) {
                    for ($i = 0; $i < count($car_items_data); $i++) {
                        ?>
                        <div class="row m-2">
                            <div class="col-md-6 p-1">
                                <h4 class="">Car Image</h4>
                                <img src="images/cars/<?php echo $car_items_data[$i]['car_image']; ?>" class="cart-image"
                                    alt="Car's image">
                            </div>
                            <div class="col-md-6 p-4">
                                <h3 class=""><?php echo $car_items_data[$i]['car_name']; ?></h3>
                                <h5 class=""><?php echo $car_items_data[$i]['car_brand']; ?></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span
                                            class="text-decoration-line-through"><?php echo $car_items_data[$i]['car_price']; ?></span>
                                        <span class="fs-5">$<?php echo $car_items_data[$i]['car_sale_price']; ?></span>
                                    </div>
                                    <p class="text-capitalize"><?php echo $car_items_data[$i]['car_type']; ?></p>
                                    <p>Model-<?php echo $car_items_data[$i]['car_model']; ?></p>
                                    <p><?php echo $car_items_data[$i]['car_body_style']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <?php
                                    $quantity;
                                    $total_price;
                                    foreach ($cart_items as $item) {
                                        if ($item['car_id'] == $car_items_data[$i]['car_id']) {
                                            $quantity = $item['quantity'];
                                            $total_price = $car_items_data[$i]['car_sale_price'] * $item['quantity'];
                                            $subtotal = $subtotal + $total_price;
                                        }
                                    }
                                    ?>
                                    <p>Quantity :- <span><?php echo $quantity; ?></span></p>
                                    <p>Total :- $<span><?php echo $total_price; ?></span></p>
                                </div>
                                <div>
                                    <form action="utils/removeFromCart.php" method="post">
                                        <input type="hidden" name="car_id" value="<?php echo $car_items_data[$i]['car_id']; ?>">
                                        <button class="btn btn-danger float-right" type="submit">Remove</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <hr />

                    <?php
                    }//for
                    ?>
                    <div class="text-end">
                        <b>Subtotal
                            (<?php echo count($car_items_data) ?><span><?php echo (count($car_items_data) > 1) ? " Items" : " Item"; ?>
                            </span>):
                            $<span><?php echo $subtotal; ?></span> </b>
                    </div>

                <?php }//if
                else { ?>
                    <h3>Cart is Empty</h3>
                <?php }//else ?>

            </div>
        </div>
        <div class="col-md-3">
            <?php if ($car_items_data) { ?>
                <div class="card card-body ">
                    <span class="text-success mb-4"> <i class="fa fa-check"></i> Your order qualifies for FREE shipping
                        (excludes remote locations). Choose this option at checkout. Details</span>
                    <span class="fs-5 mb-4">Subtotal (<?php echo count($car_items_data);
                    echo (count($car_items_data) > 1) ? " Items" : " Item"; ?>):
                        <b>$<?php echo $subtotal; ?></b> </span>
                    <form action="checkoutForm.php" method="post">
                        <input type="hidden" name="total_price" value="<?php echo $subtotal; ?>">
                        <button type="submit" class="btn btn-warning">Proceed to Checkout</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="mb-5"></div>
    <?php
    require ('layouts/footer.php');
    ?>

</body>

</html>