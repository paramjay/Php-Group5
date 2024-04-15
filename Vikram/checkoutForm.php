<?php
require('config/dbinit.php');
require('function.php');
require('user.php');
// Instantiate the Database class
$db = new Database();

// Get the PDO connection object
$conn = $db->getConnection();
$user_data = check_login($conn);
$total_price=0;
$user_info;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $total_price = $_POST['total_price']; 
  $userManager = new User($db);
  $user_info = $userManager->getUserDetailsById($user_data['user_id']);
} 
else{
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $currentURL = strstr($currentURL, "Vikram/", true);
  header("Location: $currentURL"."Vikram/");
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Checkout Form</title>
    <?php
      require('layouts/commonHead.php');
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
        <form class="card card-body fs-6" action="utils/create_invoice.php" method="post" >
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" 
                  value="<?php echo $user_info['user_name']; ?>" 
                  placeholder="Enter your full name" required readonly>
                </div>
                <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email"
                  value="<?php echo $user_info['user_email']; ?>" 
                  placeholder="name@example.com" required readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" 
                  value="<?php echo $user_info['user_address']; ?>" 
                  placeholder="1234 Main St" required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="Country" class="form-label">Country</label>
                  <input type="text" class="form-control" id="Country" 
                  value="<?php echo $user_info['user_country']; ?>" required readonly>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6 mb-3">
                    <label for="zip" class="form-label">Postal-Code</label>
                    <input type="text" class="form-control" id="zip" 
                    value="<?php echo $user_info['user_postal_code']; ?>" required readonly>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="payment" class="form-label">Select Payment Mode</label>
                <select class="form-control" id="payment" name="invoice_payment_mode" required>
                  <option value="">--- Select ---</option>
                  <option value="Online NetBanking">Online NetBanking</option>
                  <option value="Loan">Loan</option>
                  <option value="Cash">Cash</option>
                  <option value="Credit/Debit">Credit/Debit</option>
                </select>
              </div>
            </div>
            
            <div class="row">
              <h4>Your Total due amount:-</h4>
              <div class="col-md-3">
                <span>Sub-Total: </span><br>
                <span>Tax(13%):</span><br>
              </div>
              
              <div class="col-md-3">
              <b>$ <?php echo $total_price; ?></b><br>
              <input type="hidden" name="invoice_total" value="<?php echo $total_price; ?>">
              <b>$ <?php echo $total_price*0.13; ?></b><br>
              <input type="hidden" name="invoice_tax" value="<?php echo $total_price*0.13; ?>">
              </div>
            </div>
            
            <div class="row"><div class="col-md-6"><hr></div></div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <span>Total Due Amount: </span>
              </div>
              <div class="col-md-3 mb-3">
                <b>$ <?php echo $total_price*1.13; ?></b>
                <input type="hidden" name="invoice_total_due" value="<?php echo $total_price*1.13; ?>">
              </div>
            </div>
            <div class="text-center">
              <input type="hidden" name="user_id" value="1">
              <button type="submit" class="btn btn-primary mt-3">Generate Invoice</button>
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