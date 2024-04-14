<!DOCTYPE html>
<html>
<head>
    <title>Cars</title>
    <?php
    require('config/dbinit.php');
    require('layouts/commonHead.php');
    ?>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
<?php
require('layouts/header.php');
?>

<section id="product-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium">
                <br/>
                <h2 class="display-2 pb-5 text-uppercas text-light">Cars</h2>
            </div>
        </div>
    </div>
</section>

<div class="row m-5">
    <div class="col-md-3">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Filter <i class="fa fa-filter"></i></h2>
                </div>
            </div>
            <div class="row" id="filter-list">
                <form class="card card-body fs-6">
                    <div class="form-group">
                        <h5 for="type" class="mb-2">Type:</h5>

                        <div class="form-check">
                            <input class="form-check-input" name="type" type="checkbox" value="Petrol" id="Petrol">
                            <label class="form-check-label" for="Petrol">Petrol</label>
                        </div>

                        <div class="form-check ">
                        <input class="form-check-input" name="type" type="checkbox" value="Diesel" id="Diesel">
                        <label class="form-check-label" for="Diesel">Diesel</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" name="type" type="checkbox" value="CNG" id="CNG">
                        <label class="form-check-label" for="CNG">CNG</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" name="type" type="checkbox" value="Electic" id="Electic">
                        <label class="form-check-label" for="Electic">Electic</label>
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <h5 for="brand" class="mb-2">Brand:</h5>

                        <div class="form-check">
                            <input class="form-check-input" name="brand" type="checkbox" value="Honda" id="Honda">
                            <label class="form-check-label" for="Honda">Honda</label>
                        </div>

                        <div class="form-check ">
                        <input class="form-check-input" name="brand" type="checkbox" value="Nissan" id="Nissan">
                        <label class="form-check-label" for="Nissan">Nissan</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" name="brand" type="checkbox" value="Toyota" id="Toyota">
                        <label class="form-check-label" for="Toyota">Toyota</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" name="brand" type="checkbox" value="Telsa" id="Telsa">
                        <label class="form-check-label" for="Telsa">Telsa</label>
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <h5 for="priceRange" class="mb-2">Price: (<span id="priceValue"></span>)</h5>
                        <input type="range" class="form-control-range" min="20000" max="150000" id="priceRange">
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-warning" type="reset" onclick="resetFilters()">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section id="car-products" class="col-md-9 product-store position-relative no-padding-top">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Our Cars</h2>
                </div>
            </div>
            <div class="row" id="product-list">
                <!-- AJAX content will be loaded here -->
            </div>
        </div>
    </section>
</div>

<?php
require('layouts/footer.php');
?>

<script>
    // Function to reset filters
    function resetFilters() {
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        document.getElementById('priceRange').value = 150000;
        updatePriceValue();
        filterCars();
    }

    // Update price value display
    function updatePriceValue() {
        document.getElementById('priceValue').textContent = document.getElementById('priceRange').value;
        filterCars();
    }

    // Filter cars based on brand and type selection using AJAX
    function filterCars() {
        const selectedBrands = Array.from(document.querySelectorAll('input[name="brand"]:checked')).map(checkbox => checkbox.value);
        const selectedTypes = Array.from(document.querySelectorAll('input[name="type"]:checked')).map(checkbox => checkbox.value);
        const priceRange = document.getElementById('priceRange').value;

        // AJAX call to fetch filtered cars
        $.ajax({
            type: 'POST',
            url: 'filter_cars.php',
            data: { brands: selectedBrands, types: selectedTypes, price: priceRange },
            success: function(response) {
                $('#product-list').html(response); // Update product list with filtered cars
            }
        });
    }

    // Event listeners for checkboxes and price range slider
    document.querySelectorAll('input[name="brand"]').forEach(checkbox => {
        checkbox.addEventListener('change', filterCars);
    });

    document.querySelectorAll('input[name="type"]').forEach(checkbox => {
        checkbox.addEventListener('change', filterCars);
    });


    document.getElementById('priceRange').addEventListener('input', updatePriceValue);

    // Initial call to filterCars to apply initial filters
    filterCars();
</script>

</body>
</html>
