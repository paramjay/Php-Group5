<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <?php
      require('layouts/commonHead.php');
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
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Ford</td>
                    <td>Mustang</td>
                    <td>GT</td>
                    <td>Sports Car</td>
                    <td>$40,000</td>
                    <td>$35,000</td>
                    <td>5.0L V8</td>
                    <td>Coupe</td>
                    <td>4</td>
                    <td>25 mpg</td>
                    <td>Powerful and stylish sports car</td>
                    <td>2022</td>
                    <td>10,000 miles</td>
                    <td>Red</td>
                    <td><a href="#" class="btn btn-sm btn-outline-info">Edit</a><a href="#" class="btn btn-sm btn-outline-danger">Delete</a></td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Ford</td>
                    <td>Mustang</td>
                    <td>GT</td>
                    <td>Sports Car</td>
                    <td>$40,000</td>
                    <td>$35,000</td>
                    <td>5.0L V8</td>
                    <td>Coupe</td>
                    <td>4</td>
                    <td>25 mpg</td>
                    <td>Powerful and stylish sports car</td>
                    <td>2022</td>
                    <td>10,000 miles</td>
                    <td>Red</td>
                    <td><a href="#" class="btn btn-sm btn-outline-success">Edit</a><a href="#" class="btn btn-sm btn-outline-danger">Delete</a></td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Ford</td>
                    <td>Mustang</td>
                    <td>GT</td>
                    <td>Sports Car</td>
                    <td>$40,000</td>
                    <td>$35,000</td>
                    <td>5.0L V8</td>
                    <td>Coupe</td>
                    <td>4</td>
                    <td>25 mpg</td>
                    <td>Powerful and stylish sports car</td>
                    <td>2022</td>
                    <td>10,000 miles</td>
                    <td>Red</td>
                    <td><a href="#" class="btn btn-sm btn-outline-success">Edit</a><a href="#" class="btn btn-sm btn-outline-danger">Delete</a></td>
                </tr>
                </tbody>
            </table>
        </div>
   
    </div>
    
    <?php
      require('layouts/footer.php');
    ?>
    
  </body>
</html>