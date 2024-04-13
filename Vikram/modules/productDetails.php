<!DOCTYPE html>
<html>
  <head>
    <title>Details</title>
    <?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>
    
    <section id="productDetails-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Car Details</h2>
          </div>
        </div>
      </div>
      </div>
    </section>

    <div class="row mb-5 m-5">
        
        <div class="card card-body col-md-10">
            <div class="row m-4">
                <div class="col-md-6 p-1">
                    <h4 class="">Car Image</h4>
                    <img src="images/car (2).jpg" id="product-image" alt="Car's image">
                </div>
                <div class="col-md-6 p-4">
                    <h3 class="">Car Product-name</h3>
                    <h5 class="">Car Brand-name</h5>
                    <div class="d-flex justify-content-between">
                        <div>    
                            <span class="text-decoration-line-through">$100,000</span>
                            <span class="fs-5">$95,000</span>
                        </div>
                        <p >Diesel</p>
                        <p >Model-Model-2</p>
                        <p >Sedan</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p >Color-Black</p>
                        <p >30km/litre</p>
                        <p >4 seater</p>
                        <p >Year-2020</p>
                    </div>
                
                    <p >car_odometer</p>
                    <p class="text-justify">Description. sdvfj fdgd gdna adgjab fdgag0g herhr vgagra artrag raratr g ragr argrab a r hgta h5hd aet.</p>
                                
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
    <h3>Car Name</h3>
    <h6>Key Specifications</h6>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Engine</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> 1499 cc</span>
        </div>
        <div class="col-md-3">
            <span> Torque</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> 115 Nm</span>
        </div>
    </div>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Driven Type</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> FWD</span>
        </div>
        <div class="col-md-3">
            <span> Power</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> 72.41 - 86.63 bhp</span>
        </div>
    </div>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Transmission</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> Manual / Automatic</span>
        </div>
        <div class="col-md-3">
            <span> Mileage</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> 18.8 - 20.09 kmpl</span>
        </div>
    </div>
    <div class="row fs-5" >
        <div class="col-md-3">
            <span> Global NCAP Safety Rating</span>
        </div>
        <div class="col-md-3 fw-bolder">
            <span> 5 Star</span>
        </div>
    </div>
    
    
    </div>
    <div class="mb-5"></div>
    
    <?php
      require('layouts/footer.php');
    ?>
    
  </body>
</html>