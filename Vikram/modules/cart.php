<!DOCTYPE html>
<html>
  <head>
    <title>Cart</title>
    <?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>

    <section id="cart-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Shopping Cart</h2>
          </div>
        </div>
      </div>
      </div>
    </section>
    <div class="row m-2">
        <div class="col-md-8 m-auto"> <h2 class=" pb-2">In your Cart:-</h2></div>
        
        <div class="col-md-3 "> </div>
    </div>
    <div class="row m-2 ">
        <div class="col-md-8 m-auto" >
            <div class=" card card-body fs-6" > 
                <div class="row m-2">
                    <div class="col-md-6 p-1">
                        <h4 class="">Car Image</h4>
                        <img src="images/car (2).jpg" class="cart-image" alt="Car's image">
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
                        <p>Quantity :-  <span>1</span></p>
                        <div>
                            <button class="btn btn-danger float-right">Remove</button>
                        </div>
                    </div>        
                </div>
                
                <hr/>
                <div class="row m-2">
                    <div class="col-md-6 p-1">
                        <h4 class="">Car Image</h4>
                        <img src="images/car (2).jpg" class="cart-image" alt="Car's image">
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
                        <p>Quantity :-  <span>1</span></p>
                        <div>
                            <button class="btn btn-danger float-right">Remove</button>
                        </div>
                    </div>        
                </div>
                <hr/>
                <div class="text-end">
                    <b>Subtotal (<span>1 Item</span>): $<span>95,000</span> </b>
                </div>
            </div>        
        </div>
        <div class="col-md-3">
            <div class="card card-body ">
                <span class="text-success mb-4"> <i class="fa fa-check"></i> Your order qualifies for FREE shipping (excludes remote locations). Choose this option at checkout. Details</span>
                <span class="fs-5 mb-4">Subtotal (<span>1 Item</span>): <b>$95,000</b> </span>
                <button type="button" class="btn btn-warning">Proceed to Checkout</button>
            </div>
        </div>
    </div>
    <div class="mb-5"></div>
    <?php
      require('layouts/footer.php');
    ?>
    
  </body>
</html>