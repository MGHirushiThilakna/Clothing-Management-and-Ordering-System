<?php include "header.php" ?>
<section>
<link rel="stylesheet" href="assets/css/homePage-style-A.css">

<div class="container-fluid">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators c-indi">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active c-indi" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class=" c-indi" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class=" c-indi" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active c-item" >
        <img src="assets/imgs/hah-collections-slider1.png" class="d-block w-100  c-img" alt="...">
      </div>
      <div class="carousel-item c-item" >
        <img src="assets/imgs/hah-collections-slider2.png" class="d-block w-100  c-img" alt="...">
      </div>
      <div class="carousel-item c-item" data-bs-interval="10000">
        <img src="assets/imgs/hah-collections-slider4.png" class="d-block w-100  c-img" alt="...">
        <div class="carousel-caption top-0 mt-4  ">
          <p class="mt-5 fs-3 text-uppercase">සිංහල අලුත් අවුරුදු  offers</p>
          <h1 class="display-1 fw-bolder text-Capitalize">Upto 50% off</h1>
          <p class="mt-5 fs-5">*valid till April 15<sup>th<sup></p>
          <p class="fs-5">*Hurry offer valid till stock lasts</p>
          <p class="">*Terms and conditions Apply</p>
        </div>
      </div>
    </div>
  </div>




  <div class="card main-container">
    <div class="card-header main-container-title"><span>MENS Wear</span> <button class="btn btn-outline btn-seemore">See More >></button></div>
    <div class="card-body main-container-body">
        <div class="row">
          <div class="card items" >
            <img src="assets\imgs\sampleImgs\men\Navy-Blue-Mens-Polo-T-Shirt.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
              <h5 class="card-title item-title">Navy Blue Polo</h5>
              <p class="card-text item-stockIn">Available</p>
              <a href="#" class="btn btn-primary card-btn"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">View</a>
            </div>
          </div>
          <div class="card items">
            <img src="assets\imgs\sampleImgs\men\Navy-Blue-Mens-Long-Sleeve-T-Shirt.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
              <h5 class="card-title">Navy Blue Polo</h5>
              <p class="card-text">In-stock</p>
              <a href="#" class="btn btn-primary card-btn">View</a>
            </div>
          </div>
          <div class="card items">
            <img src="assets\imgs\sampleImgs\men\Maroon-Mens-Long-Sleeve-T-Shirt.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
              <h5 class="card-title">Navy Blue Polo</h5>
              <p class="card-text item-stockout">Sold out!</p>
              <a href="#" class="btn btn-primary card-btn">View</a>
            </div>
          </div>
          <div class="card items">
            <img src="assets\imgs\sampleImgs\men\Cinnamon-Brown-Mens-Polo-T-Shirt.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
              <h5 class="card-title">Navy Blue Polo</h5>
              <p class="card-text">In-stock</p>
              <a href="#" class="btn btn-primary card-btn">View</a>
            </div>
          </div>
          <div class="card items">
            <img src="assets\imgs\sampleImgs\men\Carbon-Blue-Mens-Polo-T-Shirt.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
              <h5 class="card-title">Navy Blue Polo</h5>
              <p class="card-text">In-stock</p>
              <a href="#" class="btn btn-primary card-btn">View</a>
            </div>
        </div>  
      </div> 
    </div>
  </div>
</div>

<div class="modal fade my-product-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 
<div class="modal-dialog modal-xl">
<link rel="stylesheet" href="assets\css\product-modal-style-A.css"> 
    <div class="modal-content my-modal-content">
      
      <!-- Header section -->
      <div class="modal-header my-modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Product Name</h5>
        <div class="rating">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Body Section -->
      <div class="modal-body my-modal-body">
        <div class="container my-modal-container">
            <div class="row">
              <div class="col-lg-4 col-md-12">
                <!-- Product images -->
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner my-modal-slider">
                    <div class="carousel-item active">
                      <img src="assets\imgs\sampleImgs\men\Carbon-Blue-Mens-Polo-T-Shirt.jpg" class="d-block w-100 my-modal-slider-img" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="assets\imgs\sampleImgs\men\Cinnamon-Brown-Mens-Polo-T-Shirt.jpg" class="d-block w-100 my-modal-slider-img" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="assets\imgs\sampleImgs\men\Navy-Blue-Mens-Long-Sleeve-T-Shirt.jpg" class="d-block w-100 my-modal-slider-img" alt="...">
                    </div>
                  </div>
                  <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon slider-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon slider-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
              
              <div class="col-lg-8 col-md-12 ">
                <div class="row product-details">
                  <div class="col-lg-3 col-md-4 col-topics"><span>Description</span></div>
                  <div class="col-lg-9 col-md-8 col-data">
                    <span>
                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typeset
                    </span>
                  </div>

                </div>
                <div class="row product-details">
                  <div class="col-3 col-topics"><span>Pick Color</span></div>
                  <div class="col-9 col-data">
                    <div class="colors">
                      <label>
                        <input type="radio" name="color" value="black">
                        <span class="swatch" style="background-color:#222"></span>
                      </label>
                      <label>
                        <input type="radio" name="color" value="blue">
                        <span class="swatch" style="background-color:#6e8cd5"></span>
                      </label>
                      <label>
                        <input type="radio" name="color" value="green">
                        <span class="swatch" style="background-color:#44c28d"></span>
                      </label>
                    </div>
                  </div>                    
                </div>
                <div class="row product-details">
                  <div class="col-3 col-topics"><span>Pick Size</span></div>
                  <div class="col-9 col-data">
                  <div class="size">
                      <label>
                        <input type="radio" name="size" value="M">
                        <span class="size-box">M</span>
                      </label>
                      <label>
                        <input type="radio" name="size" value="L">
                        <span class="size-box" style="">L</span>
                      </label>
                      <label>
                        <input type="radio" name="size" value="XL">
                        <span class="size-box" style="">XL</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row product-details">
                  <div class="col-3 col-topics"><span>Availability</span></div>
                  <div class="col-9 col-data"></div>
                </div>
                <div class="row product-details">
                  <div class="col-3 col-topics"><span>Price</span></div>
                  <div class="col-9 col-data"></div>
                </div>
                <!-- Add to cart button-->
                <button type="button" class="btn btn-primary"><i class="fas fa-cart-plus fa-lg"></i> Add to cart</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<?php include "footer.php"?>