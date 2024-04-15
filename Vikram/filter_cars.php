<?php
// Include database connection or initialization file
require ('config/dbinit.php');

// Instantiate the Database class
$db = new Database();

// Get the PDO connection object
$conn = $db->getConnection();
// Get brands, types, and price from AJAX POST request
$selectedBrands = isset($_POST['brands']) ? $_POST['brands'] : [];
$selectedTypes = isset($_POST['types']) ? $_POST['types'] : [];
$selectedBodyTypes = isset($_POST['bodyTypes']) ? $_POST['bodyTypes'] : [];
$priceRange = isset($_POST['price']) ? $_POST['price'] : '';

// Build SQL query based on selected filters
$sql = "SELECT * FROM tbl_cars WHERE 1";

if (!empty($selectedBrands)) {
    $brandsPlaceholder = implode(',', array_fill(0, count($selectedBrands), '?'));
    $sql .= " AND car_brand IN ($brandsPlaceholder)";
}

if (!empty($selectedTypes)) {
    $typesPlaceholder = implode(',', array_fill(0, count($selectedTypes), '?'));
    $sql .= " AND car_type IN ($typesPlaceholder)";
}

if (!empty($selectedBodyTypes)) {
    $bodyTypesPlaceholder = implode(',', array_fill(0, count($selectedBodyTypes), '?'));
    $sql .= " AND car_body_style IN ($bodyTypesPlaceholder)";
}

if (!empty($priceRange)) {
    $sql .= " AND car_sale_price <= ?";
}

// Prepare and execute the SQL statement
$stmt = $conn->prepare($sql);

$placeholders = [];

if (!empty($selectedBrands)) {
    $placeholders = array_merge($placeholders, $selectedBrands);
}

if (!empty($selectedTypes)) {
    $placeholders = array_merge($placeholders, $selectedTypes);
}

if (!empty($selectedBodyTypes)) {
    $placeholders = array_merge($placeholders, $selectedBodyTypes);
}

if (!empty($priceRange)) {
    $placeholders[] = $priceRange;
}

$stmt->execute($placeholders);

$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate HTML for filtered cars
foreach ($cars as $car) {
    echo '<div class="col-md-4">';
    echo '<div class="card card-body p-0">';
    echo '<img src="images/cars/' . $car['car_image'] . '" alt=" ' . $car['car_name'] . ' - ' . $car['car_brand'] . ' " class="rounded-3" id="p' . $car['car_id'] . '">';
    echo '<div class="p-4 pt-0">';
    echo '<h3 class="mt-3">' . $car['car_name'] . '</h3>';
    echo '<div class="d-flex justify-content-between">';
    echo '<div>';
    echo '<span class="text-decoration-line-through">$' . $car['car_price'] . '</span>';
    echo '<span class="fs-5">$' . $car['car_sale_price'] . '</span>';
    echo '</div>';
    echo '<p>' . $car['car_type'] . '</p>';
    echo '</div>';
    echo '<p>' . $car['car_description'] . '</p>';
    echo '<a class="btn btn-outline-primary btn-center" href="productDetails.php?car_id=' . $car['car_id'] . '">View Details</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>