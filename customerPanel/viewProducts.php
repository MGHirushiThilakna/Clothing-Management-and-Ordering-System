<?php 
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
$productObj = new ProductController;
session_start();
if(isset($_GET['pId'])){
    $productResults = $productObj->getProductInfomation($_GET['pId']);
    if($productResults){
        foreach($productResults as $row){ ?>
        <!-- Header section -->
        <div class="modal-header my-modal-header">
            <div class="row w-100" >
                <div class="col-lg-4">
                    <h5 class="modal-title" id="staticBackdropLabel"><?=$row['Pro_Name']?></h5>
                </div>
                <div class="col-lg-8">
                    <!-- product Rating part -->
                    <div class="rating">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                <!-- product Rating end -->
                </div>
            </div>
            
                
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Header section end -->
        
        <!-- Body section -->
        <div class="modal-body my-modal-body">
        <form id="viewProduct" method="post">
            <div class="container my-modal-container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <!--Product Images-->
                        <div id="productImageCarouselControl" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner my-modal-slider">
                                <div class="carousel-item active">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_1'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_2'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_3'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <button class="carousel-control-prev " type="button" data-bs-target="#productImageCarouselControl" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon slider-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next " type="button" data-bs-target="#productImageCarouselControl" data-bs-slide="next">
                                    <span class="carousel-control-next-icon slider-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <!--Product Images end-->
                    </div>
                    <div class="col-lg-8 col-md-12 ">
                        <div class="row product-details">
                            <!--Product Description-->
                            <div class="col-lg-3 col-md-4 col-topics"><span>Description</span></div>
                            <div class="col-lg-9 col-md-8 col-data">
                                <span><?=$row['Pro_Desc']?></span>
                            </div>
                            <!--Product Description end-->
                        </div>
                        <div class="row product-details">
                            <!--Product Colors-->
                            <div class="col-3 col-topics"><span>Pick Color</span></div>
                            <div class="col-9 col-data">
                                <div class="colors">
                                    <?php
                                        $colorResult = $productObj->getProductColors($_GET['pId']);
                                        if($colorResult){
                                            foreach($colorResult as $rowColor){?>
                                            <label>
                                                <input type="radio" name="color" id="color" value="<?=$rowColor['Color_ID']?>">
                                                <span class="swatch" style="background-color:<?=$rowColor['Color_Value']?>"></span>
                                            </label>
                                    <?php }
                                        }else{
                                            echo"<label>No Colors Available</label>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <!--Product Colors end-->
                        </div>
                        <div class="row product-details">
                            <!--Product Size-->
                            <div class="col-3 col-topics"><span>Pick Size</span></div>
                            <div class="col-9 col-data">
                                <div class="size">
                                    <?php
                                        $sizeResult = $productObj->getProductSize($_GET['pId']);
                                        if($sizeResult){
                                            foreach($sizeResult as $rowSize){?>
                                            <label>
                                                <input type="radio" name="size" id="size" value="<?=$rowSize['Size_ID']?>">
                                                <span class="size-box"><?=$rowSize['Size_Value']?></span>
                                            </label>
                                    <?php }
                                        }else{
                                            echo"<label>No Size Available</label>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <!--Product Size end-->
                        </div>
                        <div class="row product-details">
                            <!--Product Availability-->
                            <div class="col-3 col-topics"><span>Availability</span></div>
                            <div class="col-9 col-data"><span id="stockStatus"></span></div>
                            <!--Product Availability end-->
                        </div> 
                        <div class="row product-details">
                            <!--Product Price-->
                            <div class="col-3 col-topics"><span>Price</span></div>
                            <div class="col-9 col-data">Rs <?=$row['Pro_SalePrice']?></div>
                            <!--Product Price end-->
                        </div>
                        <div class="row product-details">
                            <!--Product Price-->
                            <div class="col-3 col-topics"><span>Quantity</span></div>
                            <div class="col-9 col-data">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="" name="quantity" id="qty" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                            <!--Product Price end-->
                        </div>
                        <input type="hidden" name="productId" value="<?=$_GET['pId']?>">
                        <!--Add to cart Button-->
                        <a name="addToCart"  class="btn btn-primary" id="addtoCart" data-pid="<?=$_GET['pId']?>" data-custid="<?=$_SESSION['cart_customerID'] ?>" onclick="addtoCart(this)"><i class="fas fa-cart-plus fa-lg"></i> Add to cart</a>
                        <button type="button" class="btn btn-danger disabled" id ="stockOut"><i class="far fa-times-circle"></i> Stock Out</button> 
                        <!--Add to cart Button end-->                 
                    </div>
                </div>
            </div>
        </form>
        </div>
        <!-- Body section end-->
        
        <?php
        }
    }
}

?>
<script src="..\assets\js\customer-productQtyCheck.js"></script>