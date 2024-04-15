<?php 
  require ('config/dbinit.php');
    
  $sql = "SELECT * FROM tbl_users ";

  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $vikram_cars = $stmt->fetchAll();
  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
      require('layouts/commonHead.php');
      require('config/dbinit.php');
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
    <button type="button" class="btn btn-warning" style="margin-left: 80px;" onclick="window.location.href='updateUserDetails.php'">Add New User Details</button>
</section>

    <div class="row m-4 ">
        <div class="col-md-12 table-div table-responsive"> 
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type</th>
                    <th scope="col">Address</th>
                    <th scope="col">Postal Code</th>
                    <th scope="col">Country</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php for($i=0; $i<count($vikram_cars); $i++){?>
                <tr>
                <th scope="row"><?php echo $i+1 ?></th>
                    
                    <td><?php echo $vikram_cars[$i]['user_name'] ?></td>
                    <td><?php echo $vikram_cars[$i]['user_email'] ?></td>
                    <td><?php echo $vikram_cars[$i]['user_type'] ?></td>
                    <td><?php echo $vikram_cars[$i]['user_address'] ?></td>
                    <td><?php echo $vikram_cars[$i]['user_postal_code'] ?></td>
                    <td><?php echo $vikram_cars[$i]['user_country'] ?></td>
                   
                    
                    <td><a class="btn btn-outline-primary" href="updateUserDetails.php?id=<?php echo $vikram_cars[$i]['user_id'] ?>">Edit</a>
                        <button class="btn btn-outline-danger" onclick="deleteUser('<?php echo $vikram_cars[$i]['user_id'] ?>')">Delete</a></td>
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
function deleteUser(id) {
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
        text: "User has been deleted.",
        icon: "success",showConfirmButton: false,
      });
      setTimeout(function() { window.location.href='deleteUserDetails.php?id='+id;}, 1000);
    }
  });
};
function Reload(url){
 
}
   
</script>
</body>
</html>

 