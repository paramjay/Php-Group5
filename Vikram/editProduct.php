<!DOCTYPE html>
<html>
  <head>
    <title>Edit Product</title>
    <?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>

    <section id="AddProduct-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Edit-Product</h2>
          </div>
        </div>
      </div>
      </div>
    </section>

    <div class="row mb-5 ">
        
        <div class="col-md-2"></div>
        
        <div class="col-md-8">
        <h2 class=" pb-2">Edit Car Details</h2>
        
        <form class=" card card-body fs-6" > 
            <div class="row">
                
            <input type="hidden" class="form-control" id="car_id" >
                <div class=" col-md-6 mb-3">
                    <label for="car_brand" class="form-label">Brand</label>
                    <input type="text" class="form-control" id="car_brand" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="car_name" >
                </div>
            </div>
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="car_model" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_type" class="form-label">Type</label>
                    <input type="text" class="form-control" id="car_type" >
                </div>
            </div>
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="car_price" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_sale_price" class="form-label">Sale Price</label>
                    <input type="text" class="form-control" id="car_sale_price" >
                </div>
            </div>
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_engine" class="form-label">Engine</label>
                    <input type="text" class="form-control" id="car_engine" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_body_style" class="form-label">Body Style</label>
                    <input type="text" class="form-control" id="car_body_style" >
                </div>
            </div>
            
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_capacity" class="form-label">Capacity</label>
                    <input type="text" class="form-control" id="car_capacity" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_milage" class="form-label">Milage</label>
                    <input type="text" class="form-control" id="car_milage" >
                </div>
            </div>
            
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="car_description" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_mfg_year" class="form-label">MFG Year</label>
                    <input type="text" class="form-control" id="car_mfg_year" >
                </div>
            </div>
            
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_odometer" class="form-label">Odometer</label>
                    <input type="text" class="form-control" id="car_odometer" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="car_color" class="form-label">Color</label>
                    <input type="text" class="form-control" id="car_color" >
                </div>
            </div>
            <div class="row">
                <div class=" col-md-6 mb-3">
                    <label for="car_image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="car_image" >
                </div>
            </div>
                <!-- <div class="mb-3">
                    <label for="usertype" class="form-label">User-Type</label>
                    <select class="form-select" id="usertype" >
                        <option value="Buyer">Buyer</option>
                        <option value="Seller">Seller</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div> -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3">Update-Details</button>
                </div>
                
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    
    <?php
      require('layouts/footer.php');
    ?>
    
  </body>
</html>