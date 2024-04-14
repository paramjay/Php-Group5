<!DOCTYPE html>
<html>
  <head>
    <title>Checkout Form</title>
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
    <section id="checkout-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Checkout</h2>
          </div>
        </div>
      </div>
      </div>
    </section>

    <div class="row m-4 ">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <h2 class=" pb-2">Checkout Form</h2>
        <form class=" card card-body fs-6" >
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" required>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="zip" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" placeholder="123-456-7890" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cardNumber" class="form-label">Credit Card Number</label>
                <input type="text" class="form-control" id="cardNumber" required>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4 mb-3">
            <label for="expiryDate" class="form-label">Expiration Date</label>
            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" required>
        </div>
        </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3">Checkout</button>
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