<!DOCTYPE html>
<html>
  <head>
    <title>Cars</title>
    <?php
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
            <!-- <h3 class="text-white">10% off</h3>
            <h3 class="text-white">Summer sale</h3> -->
            <!-- <a href="products.php" class="btn btn-medium btn-light text-uppercase btn-rounded-none">Shop Sale</a> -->
          </div>
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
                    <form class=" card card-body fs-6">
                    <div class="  form-group">
                        <h5 for="email" class="mb-2">Type:</h5>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Petrol" id="Petrol">
                        <label class="form-check-label" for="Petrol">Petrol</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Diesel" id="Diesel">
                        <label class="form-check-label" for="Diesel">Diesel</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="CNG" id="CNG">
                        <label class="form-check-label" for="CNG">CNG</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Electic" id="Electic">
                        <label class="form-check-label" for="Electic">Electic</label>
                        </div>
                        
                    </div>
                    <div class="form-group mt-3">
                        <h5 for="pwd" class="mb-2">Brand:</h5>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Honda" id="Honda">
                        <label class="form-check-label" for="Honda">Honda</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Nissan" id="Nissan">
                        <label class="form-check-label" for="Nissan">Nissan</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Toyota" id="Toyota">
                        <label class="form-check-label" for="Toyota">Toyota</label>
                        </div>
                        
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="Telsa" id="Telsa">
                        <label class="form-check-label" for="Telsa">Telsa</label>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <h5 for="formControlRange" class="mb-2">Price:(20000-150000)</h5>
                        <input type="range" class="form-control-range" min="20000" max="150000" id="priceRange" onchange="$('#price').val($('#priceRange').val());">
                        <input type="number" class="form-control inactive w-50" readonly min="20000" max="150000" id="price" value="$('#priceRange').val()">
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-warning" type="reset">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <section id="car-products" class="col-md-9 product-store position-relative  no-padding-top">
        <div class="container">
            <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Our Cars</h2>
            </div>
            </div>
            <div class="row" id="product-list">
                <div class="col-md-4">
                    <div class="card card-body p-0">
                        
                        <img src="images/car (13).jpg" class="rounded-3" id="p1">
                        <div class="p-4 pt-0">
                        <h3 class="mt-3">Car Product-name</h3>
                        <div class="d-flex justify-content-between">
                            <div>    
                                <span class="text-decoration-line-through">$100,000</span>
                                <span class="fs-5">$95,000</span>
                            </div>
                            <p >Petrol</p>
                        </div>
                        <p>Description. sdvfj-fdgdg-gdna-adgjab-=fdgag0g-gagreh-herhr-vgagra-artrag--raratr-g-ragr-argrab-a-r-hgta-h5h-d-aet.</p>
                        <a class="btn btn-outline-primary btn-center" href="productDetails.php" >View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body">
                        <img src="images/car (14).jpg" class="rounded-3" id="p2">
                        <h3 class="mt-3">Car Product-name</h3>
                        <div class="d-flex justify-content-between">
                            <div>    
                                <span class="text-decoration-line-through">$100,000</span>
                                <span class="fs-5">$95,000</span>
                            </div>
                            <p >Diesel</p>
                        </div>
                        <p class="text-justify">Description. sdvfj fdgd gdna adgjab fdgag0g herhr vgagra artrag raratr g ragr argrab a r hgta h5hd aet.</p>
                        <a class="btn btn-outline-primary btn-center" >View Details</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body">
                        <img src="images/car (16).jpg" class="rounded-3" id="p3">
                        <h3 class="mt-3">Car Product-name</h3>
                        <div class="d-flex justify-content-between">
                            <div>    
                                <span class="text-decoration-line-through">$100,000</span>
                                <span class="fs-5">$95,000</span>
                            </div>
                            <p >Electic</p>
                        </div>
                        <p>Description. sdvfj-fdgdg-gdna-adgjab-=fdgag0g-gagreh-herhr-vgagra-artrag--raratr-g-ragr-argrab-a-r-hgta-h5h-d-aet.</p>
                        <a class="btn btn-outline-primary btn-center" >View Details</a>
                    </div>
                </div>
            <div>
        </div>
        <div class="swiper-pagination position-absolute text-center"></div>
        </section>
    </div>
    
    <?php
      require('layouts/footer.php');
    ?>
    
  </body>
</html>