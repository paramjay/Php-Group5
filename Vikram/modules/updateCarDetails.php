<?php 
require ('config/dbinit.php');


function validateInput($input) {
    $validatedInput = trim($input);
    $validatedInput = stripslashes($validatedInput);
    $validatedInput = htmlspecialchars($validatedInput);
    return $validatedInput;
}
$msg='';
$car;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = validateInput($_POST['car_id']);
    $name = validateInput($_POST['car_name']);
    $brand = validateInput($_POST['car_brand']);
    $price = validateInput($_POST['car_price']);
    $sale_price = validateInput($_POST['car_sale_price']);
    $engine = validateInput($_POST['car_engine']);
    $style = validateInput($_POST['car_body_style']);
    $capacity = validateInput($_POST['car_capacity']);
    $mileage = validateInput($_POST['car_mileage']);
    $model = validateInput($_POST['car_model']);
    $mfg_year = validateInput($_POST['car_mfg_year']);
    $description = $_POST['car_description'];
    $odometer = validateInput($_POST['car_odometer']);
    $color = validateInput($_POST['car_color']);
    $image = $_POST['car_image'];
    
    
   
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
    if (empty($errors)) {
    $sql = "INSERT INTO tbl_cars (car_name, car_brand, car_price,car_sale_price,car_engine,car_body_style,car_capacity,
                                  car_mileage,car_model,car_mfg_year,car_description,car_odometer,car_color, car_image)
        VALUES (:name, :brand, :price, :sale_price, :engine, :style, :capacity, :mileage, :mfg_year, :description, :odometer, :color,:image)";
        
        if($id!=0){
            $sql = "UPDATE tbl_cars SET car_name=:name, car_price=:price, car_sale_price=:sale_price, car_brand=:brand,
             car_engine=:engine, car_body_style=:style, car_capacity=:capacity, car_mileage=:mileage, car_model=:model,
             car_mfg_year=:mfg_year, car_description=:description, car_odometer=:odometer, car_color=:color, car_image=:image
                where car_id='".$id."'";
        }

        $stmt = $conn->prepare($sql);
       
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
        $stmt->bindParam(':image', $image);
        

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
            $stmt = $conn->prepare("SELECT * FROM tbl_cars WHERE car_id='".$id."'");
            $stmt->execute();
            $shoe = $stmt->fetchAll();
        }
    }
  
  }
  else{
    if(!empty($_GET['id'])){
    $sql = "SELECT * FROM tbl_cars WHERE car_id='".$_GET['id']."'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $shoe = $stmt->fetchAll();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add/Edit Product</title>
<?php
      require('../layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('../layouts/header.php');
    ?>
    <main>
        <h2>Add/Edit Car Details</h2>
        <div class="mt-4 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <form action="#" method="POST" >
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
                                    echo $car[0]['car_id'];
                                }
                                else{
                                    echo '0';
                                }
                            ?>">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="car_name" 
                            name="car_name" placeholder="Enter the name of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['car_name'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="car_brand" 
                            name="car_brand" placeholder="Enter the Brand of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['car_name'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="col-sm-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="car_price" name="car_price" placeholder="Enter the price of Car..."
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['car_price'].'" ';
                                }
                            ?>>
                        </div>
                    </div>

                    <div class="col-sm-6">
                            <label for="price" class="form-label">Sale Price</label>
                            <input type="number" class="form-control" id="sale_price" name="sale_price" placeholder="Enter the sale price of Car..."
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['sale_price'].'" ';
                                }
                            ?>>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Engine</label>
                            <input type="text" class="form-control" id="engine" 
                            name="engine" placeholder="Enter the engine of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['engine'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Style</label>
                            <input type="text" class="form-control" id="style" 
                            name="style" placeholder="Enter the style of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['style'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="capacity" 
                            name="capacity" placeholder="Enter the capacity of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['capacity'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="mileage" class="form-label">Mileage</label>
                            <input type="text" class="form-control" id="mileage" 
                            name="engine" placeholder="Enter the mileage of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['mileage'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" 
                            name="model" placeholder="Enter the model of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['model'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="mfg_year" class="form-label">Manufacturing year</label>
                            <input type="date" class="form-control" id="mfg_year" 
                            name="mfg_year" placeholder="Enter the manufacturing year of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['mfg_year'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="odometer" class="form-label">Odometer</label>
                            <input type="text" class="form-control" id="odometer" 
                            name="odometer" placeholder="Enter the odometer of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['odometer'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" 
                            name="color" placeholder="Enter the color of Car..." 
                            <?php
                                if(!empty($car)){
                                    echo 'value="'.$car[0]['color'].'" ';
                                }
                            ?>
                            >
                        </div>

                        

                        
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="description" class="form-label">Description</label><span class="text-body-secondary"> (optional)</span>
                            <textarea class="form-control" id="description" name="car_description" 
                            placeholder="More details like design, color, matrial, speciality, etc..."><?php
                                if(!empty($car)){
                                    echo $shoe[0]['car_description'];
                                }
                            ?>
                            </textarea>
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
      require('../layouts/footer.php');
    ?>
      