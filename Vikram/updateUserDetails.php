<?php
require ('config/dbinit.php');
require ('function.php');
require ('classes/dao/userDao.php');

$db = new Database();
$conn = $db->getConnection();

$user_data = check_login($conn);

function validateInput($input)
{
    $validatedInput = trim($input);
    $validatedInput = stripslashes($validatedInput);
    $validatedInput = htmlspecialchars($validatedInput);
    return $validatedInput;
}

$msg = '';
$user;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = validateInput($_POST['user_id']);
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $type = validateInput($_POST['type']);
    $address = validateInput($_POST['address']);
    $postal_code = validateInput($_POST['postal_code']);
    $country = validateInput($_POST['country']);

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if ($id == 0) {
        $password = validateInput($_POST['password']);
        if (empty($password)) {
            $errors[] = "Password is required.";
        }
    }

    if (empty($type)) {
        $errors[] = "User type is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    if (empty($postal_code)) {
        $errors[] = "Postal code is required.";
    }
    if (empty($country)) {
        $errors[] = "Country is required.";
    }

    if (empty($errors)) {
        if ($id != 0) {
            $UpdatedUser = new User($id, $name, $email, null, $type, $address, $postal_code, $country);
            $userManager = new UserDAO($db);
            $userManager->updateUserDetailsById($id, $UpdatedUser);
            $msg = "<div class='bg-success-subtle d-grid p-3'><span class='text-success'>User details Updated successfully!</span></div>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $NewUser = new User(null, $name, $email, $hashed_password, $type, $address, $postal_code, $country);
            $userManager = new UserDAO($db);
            $userManager->addUser($NewUser);
            $msg = "<div class='bg-success-subtle d-grid p-3'><span class='text-success'>User details added successfully!</span></div>";
        }
    } else {
        $msg = "<div class='bg-danger-subtle d-grid p-3'>";
        foreach ($errors as $error) {
            $msg .= "<span class=' text-danger'>$error</span>";
        }
        $msg .= "</div>";
        if ($id != 0) {
            $userManager = new UserDAO($db);
            // $user = $userManager->getUserDetailsById($id);
            $user_data = $userManager->getUserDetailsById($id);
            if ($user_data) {
                // Create an instance of User class with retrieved data
                $user = new User($user_data['user_id'], $user_data['user_name'], $user_data['user_email'], $user_data['user_password'], $user_data['user_type'], $user_data['user_address'], $user_data['user_postal_code'], $user_data['user_country']);
            }
        }
    }
} else {
    if (!empty($_GET['id'])) {
        $userManager = new UserDAO($db);
        // $user = $userManager->getUserDetailsById($_GET['id']);
        $user_data = $userManager->getUserDetailsById($_GET['id']);
        if ($user_data) {
            // Create an instance of User class with retrieved data
            $user = new User($user_data['user_id'], $user_data['user_name'], $user_data['user_email'], $user_data['user_password'], $user_data['user_type'], $user_data['user_address'], $user_data['user_postal_code'], $user_data['user_country']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add/Edit User Deatils</title>
    <?php require ('layouts/commonHead.php'); ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">
    <?php require ('layouts/header.php'); ?>
    <br><br><br>
    <main>
        <h2 style="margin-left: 80px;">Add/Edit User Details</h2>
        <div style="margin-left: 80px;">
            <div class="mt-4 mb-4">
                <div class="card shadow rounded-4">
                    <div class="card-body p-4">
                        <form action="#" method="POST">
                            <?php if (!empty($msg)): ?>
                                <div class="mb-3"><?php echo $msg; ?></div>
                            <?php endif; ?>
                            <input type="hidden" class="form-control" id="user_id" name="user_id"
                                value="<?php echo !empty($user) ? $user->getUserId() : '0'; ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter the name of User..."
                                        value="<?php echo !empty($user) ? $user->getUserName() : ''; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter the Email of User..."
                                        value="<?php echo !empty($user) ? $user->getUserEmail() : ''; ?>">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <?php if (empty($_GET['id'])): ?>
                                    <div class="col-sm-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-6">
                                    <label for="type" class="form-label">Type</label>
                                    <select type="text" class="form-control" id="type" name="type">
                                        <option value="">--- select ---</option>
                                        <option value="Admin" <?php echo !empty($user) && $user->getUserType() === 'Admin' ? 'selected' : ''; ?>>
                                            Admin
                                        </option>
                                        <option value="Buyer" <?php echo !empty($user) && $user->getUserType() === 'Buyer' ? 'selected' : ''; ?>>
                                            Buyer
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter the address of user..."
                                        value="<?php echo !empty($user) ? $user->getUserAddress() : ''; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                        placeholder="Enter the postal code of user..."
                                        value="<?php echo !empty($user) ? $user->getUserPostalCode() : ''; ?>">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        placeholder="Enter the country of user..."
                                        value="<?php echo !empty($user) ? $user->getUserCountry() : ''; ?>">
                                </div>
                            </div>

                            <div class="text-center m-3">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <br /><br /><br />
    <?php require ('layouts/footer.php'); ?>