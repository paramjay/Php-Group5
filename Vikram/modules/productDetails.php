<?php
 require('config/dbinit.php');

// Check if car ID is passed in the URL
if (isset($_GET['car_id'])) {
    // Assuming you have a PDO connection established

    // Prepare the SQL statement to fetch car details by ID
    $sql = "SELECT * FROM tbl_cars WHERE car_id = :car_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':car_id', $_GET['car_id']);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display car details if found
    if ($car) {
        // Output HTML with car details
?>
<!DOCTYPE html>
<html>
<head>
    <title>Details</title>
    <?php require('layouts/commonHead.php'); ?>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
<?php require('layouts/header.php'); ?>

<section id="productDetails-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium">
                <br/>
                <h2 class="display-2 pb-5 text-uppercas text-light">Car Details</h2>
            </div>
        </div>
    </div>
</section>

<div class="row mb-5 m-5">

    <div class="card card-body col-md-10">
        <div class="row m-4">
            <div class="col-md-6 p-1">
                <h4 class="">Car Image</h4>
                <img src="images/cars/<?php echo $car['car_image']; ?>" id="product-image" alt="Car's image">
            </div>
            <div class="col-md-6 p-4">
                <h3 class=""><?php echo $car['car_name']; ?></h3>
                <h5 class=""><?php echo $car['car_brand']; ?></h5>
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="text-decoration-line-through">$<?php echo $car['car_price']; ?></span>
                        <span class="fs-5">$<?php echo $car['car_sale_price']; ?></span>
                    </div>
                    <p ><?php echo $car['car_type']; ?></p>
                    <p ><?php echo $car['car_model']; ?></p>
                    <p ><?php echo $car['car_body_style']; ?></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p ><?php echo $car['car_color']; ?></p>
                    <p ><?php echo $car['car_mileage']; ?></p>
                    <p ><?php echo $car['car_capacity']; ?> seater</p>
                    <p >Year-<?php echo $car['car_mfg_year']; ?></p>
                </div>

                <p ><?php echo $car['car_odometer']; ?></p>
                <p class="text-justify"><?php echo $car['car_description']; ?></p>

            </div>
        </div>
    </div>
    <div class="col-md-2 p-3">
        <h5 class="text-success">In Stocks</h5>
        <label for="quantity" class="fs-6 m-1">Quantity:-</label>
        <input type="number" class="form-control m-2" name="quantity" id="quantity" value="1">
        <button class="btn btn-full btn-primary m-2" type="button"> Add to Cart</button>
        <button class="btn btn-full btn-warning m-2" type="button"> Buy </button>
        <div class="row m-2">
            <table class="float-start">
                <tbody>
                <tr>
                    <td width="90px" class="float-start">Payment:</td>
                    <td >Secure transaction</td>
                </tr>
                <tr>
                    <td width="90px">Ships from:</td>
                    <td class="float-start">Vikram Motors</td>
                </tr>
                <tr>
                    <td width="90px">Sold by:</td>
                    <td>Vikram Motors</td>
                </tr>
                <tr>
                    <td  width="90px" class="float-start">Returns:</td>
                    <td>Eligible for Return, Refund or Replacement within 30 days of receipt</td>
                </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>
<div class="shadow card card-body p-4 w-75 m-auto">
    <h3><?php echo $car['car_name']; ?></h3>
    <h6>Key Specifications</h6>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Engine</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_engine']; ?> cc</span>
        </div>
        <div class="col-md-3">
            <span> Torque</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_torque']; ?> Nm</span>
        </div>
    </div>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Driven Type</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_driven_type']; ?></span>
        </div>
        <div class="col-md-3">
            <span> Power</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_power']; ?> bhp</span>
        </div>
    </div>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Transmission</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_transmission']; ?></span>
        </div>
        <div class="col-md-3">
            <span> Mileage</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_mileage']; ?> kmpl</span>
        </div>
    </div>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Global NCAP Safety Rating</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> <?php echo $car['car_safety']; ?> Star</span>
        </div>
    </div>


</div>
<div class="mb-5"></div>

<?php require('layouts/footer.php'); ?>

</body>
</html>
<?php
    } else {
        echo "<p>Car not found!</p>";
    }
} else {
    echo "<p>Car ID not provided in the URL.</p>";
}
?>
