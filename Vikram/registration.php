<?php
// Include database initialization and functions
require('config/dbinit.php');
require ('classes/dao/userDao.php');
$db = new Database();
$conn = $db->getConnection();
$userManager = new UserDAO($db);
require('function.php');

// Define variables and initialize with empty values
$user_name = $user_email = $user_type = $user_password = $user_address = $user_postal_code = $user_country = "";
$username_err = $email_err = $password_err = $address_err = $postalCode_err = $country_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST['username']))) {
        $username_err = "Please enter a username.";
    } else {
        $user_name = trim($_POST['username']);
    }

    // Validate email
    if (empty(trim($_POST['email']))) {
        $email_err = "Please enter an email address.";
    } elseif ($userManager->EmailChecker(trim($_POST['email']))) {
        $email_err = "User already exist with this email. Enter another email address.";
    }else{
        $user_email = trim($_POST['email']);
    }

    // Validate user type
    $user_type = trim($_POST['usertype']);

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } else {
        $user_password = trim($_POST['password']);
    }

    // Validate address
    if (empty(trim($_POST['address']))) {
        $address_err = "Please enter an address.";
    } else {
        $user_address = trim($_POST['address']);
    }

    // Validate postal code
    if (empty(trim($_POST['postalCode']))) {
        $postalCode_err = "Please enter a postal code.";
    } else {
        $user_postal_code = trim($_POST['postalCode']);
    }

    // Validate country
    if (empty(trim($_POST['country']))) {
        $country_err = "Please enter a country.";
    } else {
        $user_country = trim($_POST['country']);
    }

    // Check if all fields are valid before inserting into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($address_err) && empty($postalCode_err) && empty($country_err)) {
        // Hash the password
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // SQL query to insert user data into database using PDO prepared statement
        $sql = "INSERT INTO tbl_users (user_name, user_email, user_type, user_password, user_address, user_postal_code, user_country) 
                VALUES (:username, :email, :usertype, :password, :address, :postalCode, :country)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $user_name);
        $stmt->bindParam(':email', $user_email);
        $stmt->bindParam(':usertype', $user_type);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':address', $user_address);
        $stmt->bindParam(':postalCode', $user_postal_code);
        $stmt->bindParam(':country', $user_country);

        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->errorInfo();
        }
    }

    // Close the connection (optional)
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <?php require('layouts/commonHead.php'); ?>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
<?php require('layouts/header.php'); ?>

<section id="signup-banner" class="position-relative overflow-hidden bg-light-blue mb-5" style="height:1200px">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium">
                <br/>
                <h2 class="display-2 pb-5 text-uppercase text-light">Sign Up</h2>
                <form class="card card-body fs-6 bg-opacity-75 bg-black text-white" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_name; ?>">
                        <span class="text-danger"><?php echo $username_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_email; ?>">
                        <span class="text-danger"><?php echo $email_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="usertype" class="form-label">User-Type</label>
                        <select class="form-select" id="usertype" name="usertype">
                            <option value="Buyer" <?php if ($user_type === 'Buyer') echo 'selected'; ?>>Buyer</option>
                            <option value="Admin" <?php if ($user_type === 'Admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger"><?php echo $password_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_address; ?>">
                        <span class="text-danger"><?php echo $address_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode" pattern="[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d" title="Please enter a valid Canadian postal code (e.g., A1A 1A1)." value="<?php echo $user_postal_code; ?>" >
                        <span class="text-danger"><?php echo $postalCode_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?php echo $user_country; ?>">
                        <span class="text-danger"><?php echo $country_err; ?></span>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    <span class="text-center m-3">Already have an account? <a class="btn-link ml-2" href="login.php">Login</a></span>

                </form>
            </div>
        </div>
    </div>
</section>

<?php require('layouts/footer.php'); ?>
</body>
</html>
