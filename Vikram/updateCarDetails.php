<?php 
require ('config/dbinit.php');
require('function.php');
require('classes/dao/carDao.php');

$db = new Database();
$conn = $db->getConnection();

$user_data = check_login($conn);

$carManager = new CarDAO($db);
$msg = '';
$errors = [];
$car = null;

function validateInput($input) {
    $validatedInput = trim($input);
    $validatedInput = stripslashes($validatedInput);
    $validatedInput = htmlspecialchars($validatedInput);
    return $validatedInput;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = validateInput($_POST['car_id']);
    $name = validateInput($_POST['car_name']);
    $brand = validateInput($_POST['car_brand']);
    $price = validateInput($_POST['car_price']);
    $sale_price = validateInput($_POST['sale_price']);
    $engine = validateInput($_POST['engine']);
    $style = validateInput($_POST['style']);
    $capacity = validateInput($_POST['capacity']);
    $mileage = $_POST['mileage'];
    $model = validateInput($_POST['model']);
    $mfg_year = validateInput($_POST['mfg_year']);
    $description = $_POST['description'];
    $odometer = validateInput($_POST['odometer']);
    $color = validateInput($_POST['color']);
    
    $car_type = validateInput($_POST['car_type']);
    $car_transmission = validateInput($_POST['car_transmission']);
    $car_driven_type = validateInput($_POST['car_driven_type']);
    $car_torque = $_POST['car_torque'];
    $car_power = validateInput($_POST['car_power']);
    $car_safety = validateInput($_POST['car_safety']);

    $id = validateInput($_POST['car_id']);
    $image = '';
     
   
    if (empty($name)) {
        $errors[]= "Name is required.";
    }
    if (empty($brand)) {
        $errors[]= "Brand is required.";
    }
    if (empty($style)) {
        $errors[]= "Style is required.";
    }
    if (empty($capacity)) {
        $errors[]= "Capacity is required.";
    }
    if (empty($mileage)) {
        $errors[]= "Mileage is required.";
    }
    if (empty($model)) {
        $errors[]= "Car Model is required.";
    }
    if (empty($mfg_year)) {
        $errors[]= "Car manufacturing year is required.";
    }
    if (empty($odometer)) {
        $errors[]= "Car Odometer year is required.";
    }
    if (empty($color)) {
        $errors[]= "Car Color year is required.";
    }
    if (empty($price)) {
        $errors[]= "Price is required.";
    }else if (!is_numeric($price) || $price < 0) {
        $errors[] = "Price must be a non-negative numeric value.";
    }
    if (empty($engine)) {
        $errors[]= "Engine detail is required.";
    }
    if (empty($sale_price)) {
        $errors[]= "Sale Price is required.";
    }else if (!is_numeric($sale_price) || $sale_price < 0) {
        $errors[] = "Sale Price Available must be a non-negative numeric value.";
    }

    
    if (empty($car_type)) {
        $errors[]= "Car-Type is required.";
    }
    if (empty($car_transmission)) {
        $errors[]= "Transmission is required.";
    }
    if (empty($car_driven_type)) {
        $errors[]= "Driven-Type is required.";
    }
    if (empty($car_torque)) {
        $errors[]= "Torque is required.";
    }
    if (empty($car_power)) {
        $errors[]= "Power is required.";
    }
    if (empty($car_safety)) {
        $errors[]= "Safety is required.";
    }

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "images/cars/"; // Directory to store images
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $msg .= "<div class='bg-danger-subtle d-grid p-3'><span class='text-danger'>File is not an image.</span></div>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $msg .= "<div class='bg-danger-subtle d-grid p-3'><span class='text-danger'>Sorry, file already exists.</span></div>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['image']['size'] > 1000000) {
            $msg .= "<div class='bg-danger-subtle d-grid p-3'><span class='text-danger'>Sorry, your file is too large.</span></div>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $msg .= "<div class='bg-danger-subtle d-grid p-3'><span class='text-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</span></div>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg .= "<div class='bg-danger-subtle d-grid p-3'><span class='text-danger'>Sorry, your file was not uploaded.</span></div>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $msg .= "<div class='bg-success-subtle d-grid p-3'><span class='text-success'>The file ". htmlspecialchars(basename($_FILES['image']['name'])) . " has been uploaded.</span></div>";
            } else {
                $msg .= "<div class='bg-danger-subtle d-grid p-3'><span class='text-danger'>Sorry, there was an error uploading your file.</span></div>";
            }
        }
    }


    if (empty($errors)) {
        $NewCar = new Car(
            $id,
            $brand,
            $name,
            $model,
            $car_type,
            $price,
            $sale_price,
            $engine,
            $style,
            $capacity,
            $mileage,
            $description,
            $mfg_year,
            $odometer,
            $color,
            $image,
            $car_transmission,
            $car_driven_type,
            $car_torque,
            $car_power,
            $car_safety
        );
        $sql = "INSERT INTO tbl_cars (car_name, car_brand, car_price, car_sale_price, car_engine, car_body_style, car_capacity,
        car_mileage, car_model, car_mfg_year, car_description, car_odometer, car_color,car_type,
        car_transmission,car_driven_type,car_torque,car_power,car_safety";
        if (!empty($image)) {
        $sql .= ", car_image";
        }
        $sql .= ") VALUES (:name, :brand, :price, :sale_price, :engine, :style, :capacity, :mileage, :model, :mfg_year, :description, :odometer, :color
        , :car_type, :car_transmission, :car_driven_type, :car_torque, :car_power, :car_safety";
        if (!empty($image)) {
        $sql .= ", :image";
        }
        $sql .= ")";
        if($id!=0){
          
            $sql = "UPDATE tbl_cars SET car_name=:name, car_price=:price, car_sale_price=:sale_price, car_brand=:brand,
             car_engine=:engine, car_body_style=:style, car_capacity=:capacity, car_mileage=:mileage, car_model=:model,
             car_mfg_year=:mfg_year, car_description=:description, car_odometer=:odometer, car_color=:color,
              car_type=:car_type, car_transmission=:car_transmission, car_driven_type=:car_driven_type,
              car_torque=:car_torque, car_power=:car_power, car_safety=:car_safety where car_id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
        }else{
            $stmt = $conn->prepare($sql);
        }
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sale_price', $sale_price);
        $stmt->bindParam(':engine', $engine);
        $stmt->bindParam(':style', $style);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':mileage', $mileage);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':mfg_year', $mfg_year);
        $stmt->bindParam(':odometer', $odometer);
        $stmt->bindParam(':color', $color);

        $stmt->bindParam(':car_type', $car_type);
        $stmt->bindParam(':car_transmission', $car_transmission);
        $stmt->bindParam(':car_driven_type', $car_driven_type);
        $stmt->bindParam(':car_torque', $car_torque);
        $stmt->bindParam(':car_power', $car_power);
        $stmt->bindParam(':car_safety', $car_safety);

        if (!empty($image)) {
            $stmt->bindParam(':image', $image);
        }
        
        if ($stmt->execute()) {
            
            $msg.="<div class='bg-success-subtle d-grid p-3'>";
            if($id!=0){
                $msg.= "<span class='text-success'>Car details Updated successfully!</span>";
            }else{
                $msg.= "<span class='text-success'>Car details added successfully!</span>";
            }
            $msg.="</div>";
        } else {
            $msg.="<div class='d-grid'>";
            $msg.= "<span class='bg-danger-subtle text-danger'>Error: " . $stmt->error . "</span>";
            $msg.="</div>";
        }

    } else {
        
        $msg.="<div class='bg-danger-subtle d-grid p-3'>";
        foreach ($errors as $error) {
            $msg .= "<span class=' text-danger'>$error</span>";
        }
        $msg.="</div>";
        if($id!=0){
            $car = $carManager->getCarDetailsById($_GET['car_id']);
        }
    }
  
  }
  else{
    if(!empty($_GET['id'])){
    $car = $carManager->getCarDetailsById($_GET['id']);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add/Edit Product</title>
<?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>
    <br><br><br>
    <main>
        <h2 style="margin-left: 80px;">Add/Edit Car Details</h2>
        <div class="mt-4 mb-4" style="margin-left: 80px;" >
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <form action="#" method="POST" enctype="multipart/form-data">
                    <?php
                        if(!empty($msg)){
                            echo '<div class="mb-3">';
                            echo $msg;
                            echo '</div>';
                        }
                    ?>
                    <input type="hidden" class="form-control" id="car_id" 
                            name="car_id" 
                            value="<?php
                                if(!empty($car)){
                                    echo $car['car_id'];
                                }
                                else{
                                    echo '0';
                                }
                            ?>">
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="car_name" 
                            name="car_name" placeholder="Enter the name of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_name'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <div class="col-sm-6">
                            <label for="car_brand" class="form-label">Brand</label>
                            <select type="text" class="form-control" id="car_brand" name="car_brand" >
                                <option value="">--- select ---</option>
                                <option value="Honda" <?php
                                if(!empty($car)){
                                    if($car['car_brand']=='Honda'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Honda</option>
                                <option value="Nissan" <?php
                                if(!empty($car)){
                                    if($car['car_brand']=='Nissan'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Nissan</option>
                                <option value="Toyota" <?php
                                if(!empty($car)){
                                    if($car['car_brand']=='Toyota'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Toyota</option>
                                <option value="Tesla" <?php
                                if(!empty($car)){
                                    if($car['car_brand']=='Tesla'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Tesla</option>
                            </select>
                        </div>
                    </div>

                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="car_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="car_price" name="car_price" placeholder="Enter the price of Car..."
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_price'].'" ';
                                }
                            ?>>
                        </div>
                        <div class="col-sm-6">
                            <label for="sale_price" class="form-label">Sale Price</label>
                            <input type="number" class="form-control" id="sale_price" name="sale_price" placeholder="Enter the sale price of Car..."
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_sale_price'].'" ';
                                }
                            ?>>
                        </div>
                    </div>
                     
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Engine</label>
                            <input type="text" class="form-control" id="engine" 
                            name="engine" placeholder="Enter the engine of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_engine'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <div class="col-sm-6">
                            <label for="style" class="form-label">Style</label>
                            <select type="text" class="form-control" id="style" name="style" >
                                <option value="">--- select ---</option>
                                <option value="Sedan" <?php
                                if(!empty($car)){
                                    if($car['car_body_style']=='Sedan'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Sedan</option>
                                <option value="SUV" <?php
                                if(!empty($car)){
                                    if($car['car_body_style']=='SUV'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>SUV</option>
                                <option value="Pickup Truck" <?php
                                if(!empty($car)){
                                    if($car['car_body_style']=='Pickup Truck'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Pickup Truck</option>
                                <option value="Hatchback" <?php
                                if(!empty($car)){
                                    if($car['car_body_style']=='Hatchback'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Hatchback</option>
                            </select>
                            
                        </div>
                    </div>
                    
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="capacity" 
                            name="capacity" placeholder="Enter the capacity of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_capacity'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <div class="col-sm-6">
                            <label for="mileage" class="form-label">Mileage</label>
                            <input type="text" class="form-control" id="mileage" 
                            name="mileage" placeholder="Enter the mileage of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_mileage'].'" ';
                                }
                            ?>
                            >
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" 
                            name="model" placeholder="Enter the model of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_model'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <div class="col-sm-6">
                            <label for="mfg_year" class="form-label">Manufacturing year</label>
                            <input type="text" class="form-control" id="mfg_year" 
                            name="mfg_year" placeholder="Enter the manufacturing year of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_mfg_year'].'" ';
                                }
                            ?>
                            >
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="odometer" class="form-label">Odometer</label>
                            <input type="text" class="form-control" id="odometer" 
                            name="odometer" placeholder="Enter the odometer of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_odometer'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <div class="col-sm-6">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" 
                            name="color" placeholder="Enter the color of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_color'].'" ';
                                }
                            ?>
                            >
                        </div>
                    </div>

                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="car_type" class="form-label">Fuel-Type</label>
                            <select type="text" class="form-control" id="car_type" name="car_type" >
                                <option value="">--- select ---</option>
                                <option value="petrol" <?php
                                if(!empty($car)){
                                    if($car['car_type']=='petrol'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Petrol</option>
                                <option value="diesel" <?php
                                if(!empty($car)){
                                    if($car['car_type']=='diesel'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Diesel</option>
                                <option value="electric" <?php
                                if(!empty($car)){
                                    if($car['car_type']=='electric'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Electric</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="car_transmission" class="form-label">Transmission</label>
                            <select type="text" class="form-control" id="car_transmission" name="car_transmission" >
                                <option value="">--- select ---</option>
                                <option value="Automatic" <?php
                                if(!empty($car)){
                                    if($car['car_transmission']=='Automatic'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Automatic</option>
                                <option value="Manual" <?php
                                if(!empty($car)){
                                    if($car['car_transmission']=='Manual'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Manual</option>
                                <option value="CVT" <?php
                                if(!empty($car)){
                                    if($car['car_transmission']=='CVT'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>CVT</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="car_driven_type" class="form-label">Car Driven Type</label>
                            <select type="text" class="form-control" id="car_driven_type" name="car_driven_type" >
                                <option value="">--- select ---</option>
                                <option value="AWD" <?php
                                if(!empty($car)){
                                    if($car['car_driven_type']=='AWD'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>AWD</option>
                                <option value="FWD" <?php
                                if(!empty($car)){
                                    if($car['car_driven_type']=='FWD'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>FWD</option>
                                <option value="RWD" <?php
                                if(!empty($car)){
                                    if($car['car_driven_type']=='RWD'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>RWD</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="car_torque" class="form-label">Torque</label>
                            <input type="text" class="form-control" id="car_torque" 
                            name="car_torque" placeholder="Enter the Torque of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_torque'].'" ';
                                }
                            ?>
                            >
                            
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-sm-6">
                            <label for="car_power" class="form-label">Power</label>
                            <input type="text" class="form-control" id="car_power" 
                            name="car_power" placeholder="Enter the Power of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_power'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <div class="col-sm-6">
                            <label for="car_safety" class="form-label">Saftey</label>
                            <input type="text" class="form-control" id="car_safety" 
                            name="car_safety" placeholder="Enter the Safety of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car['car_safety'].'" ';
                                }
                            ?>
                            >
                            
                        </div>
                    </div>

                    <div class="row mt-3">
                        <?php if (empty($_GET['id'])): ?>
                            <div class="col-sm-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-6">
                            <label for="description" class="form-label">Description</label><span class="text-body-secondary"></span>
                            <textarea class="form-control" id="description" name="description" 
                            placeholder="More details like design, color, matrial, speciality, etc...">
                            <?php if(!empty($car)){
                                    echo $car['car_description'];
                                }
                            ?></textarea>
                        </div>
                    </div>
                    
                    <div class="text-center m-3">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
      </main>
      <br/>
      <br/>
      <br/>
      <?php
      require('layouts/footer.php');
    ?>
      