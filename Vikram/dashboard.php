<?php 
  require ('config/dbinit.php');
    
    // Instantiate the Database class
    $db = new Database();

    // Get the PDO connection object
    $conn = $db->getConnection();
  $sql = "SELECT * FROM tbl_cars ";

  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $vikram_cars = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
      require('layouts/commonHead.php');
      require('function.php');
      $user_data = check_login($conn);

    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>
    
    <section id="dashboard-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Dashboard</h2>
          </div>
        </div>
      </div>
      </div>
    </section>
    
    <section>
    <button type="button" class="btn btn-warning" style="margin-left: 80px;" onclick="window.location.href='updateCarDetails.php'">Add New Car Details</button>
</section>

    <div class="row m-4 ">
        <div class="col-md-12 table-div table-responsive"> 
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Car ID</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Name</th>
                    <th scope="col">Model</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Engine</th>
                    <th scope="col">Body Style</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Mileage</th>
                    <th scope="col">Description</th>
                    <th scope="col">Manufacturing Year</th>
                    <th scope="col">Odometer</th>
                    <th scope="col">Color</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php for($i=0; $i<count($vikram_cars); $i++){?>
                <tr>
                <th scope="row"><?php echo $i+1 ?></th>
                    
                    <td><?php echo $vikram_cars[$i]['car_brand'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_name'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_model'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_type'] ?></td>
                    <td><?php echo '$'.$vikram_cars[$i]['car_price'] ?></td>
                    <td><?php echo '$'.$vikram_cars[$i]['car_sale_price'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_engine'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_body_style'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_capacity'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_mileage'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_description'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_mfg_year'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_odometer'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_color'] ?></td>
                    <td><?php echo $vikram_cars[$i]['car_image'] ?></td>
                    
                    <td >
                      <div class="d-flex">
                        <a class="btn btn-sm btn-outline-primary m-1" href="updateCarDetails.php?id=<?php echo $vikram_cars[$i]['car_id'] ?>">Edit</a>
                        <button class="btn btn-sm btn-outline-danger m-1" onclick="deleteCar('<?php echo $vikram_cars[$i]['car_id'] ?>')">Delete</a>
                      </div>
                    </td>
                </tr>
                <?php } ?>
                   
                </tbody>
            </table>
        </div>
   
    </div>
    
    <?php
      require('layouts/footer.php');
    ?>
    
    <script>
function deleteCar(id) {
    swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Deleted!",
        text: "Car details has been deleted.",
        icon: "success",showConfirmButton: false,
      });
      setTimeout(function() { window.location.href='deleteCarDetails.php?id='+id;}, 1000);
    }
  });
};
function Reload(url){
 
}
   
</script>
</body>
</html>

 