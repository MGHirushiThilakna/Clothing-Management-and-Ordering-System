<?php 
$currentMainPage = "products";
include "customerHeader.php"; 
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
include "..\classes\CategoryController.php";
include "..\classes\CartController.php";
$db = new DatabaseConnection;
$productObj = new ProductController;
$categoryObj = new CategoryController;
$cartObj = new CartController;

?>
<link rel="stylesheet" href="../assets/css/customer-product-style.css">
<div class="container-fluid mycontainer">
    <nav class="navbar ">
        <div class="container">
            <form class="d-flex search-box">
                <input class="form-control search-input " type="search" placeholder="Search" aria-label="Search">
                <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </nav>
</div>

<div class="d-flex mywrapper" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar">
      <div class="accordion" id="categories">
      <?php
        $mainCategoryResult = $categoryObj->getMainCategoryData();
          if($mainCategoryResult){
              foreach($mainCategoryResult as $row){
      ?>
              <div class="accordion-item my-accordion-item">
                <div class="accordion-header my-accordion-header" id="<?=$row['Main_ID']?>">
                  <button class="accordion-button my-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#S<?=$row['Main_ID']?>" data-mainCate="<?=$row['Main_ID']?>" aria-expanded="true" aria-controls="collapseOne">
                  <?=$row['Name']?>
                  </button>
                </div>
                <div id="S<?=$row['Main_ID']?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#categories">
                  <div class="accordion-body my-accordion-body">
                    <ul>
                      <?php
                        $subCategoryitemResult = $categoryObj->getCategorizationData($row['Main_ID']);
                        if($subCategoryitemResult){
                          foreach($subCategoryitemResult as $rowSub){ ?>
                                <li><a href="#" data-mainCat="<?=$row['Main_ID']?>" data-subCat="<?=$rowSub['Sub_ID']?>" id="subMenu"><?=$rowSub['Name']?></a></li>                            
                        <?php  }
                        }else{
                          echo "<li>None</li>";
                        }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>

      <?php
            }
          }
      ?>
      </div>
    </div>
    <!-- /#sidebar -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <button type="button" class="btn btn-primary d-lg-none" id="sidebarCollapse">
      <i class="fas fa-angle-double-right"></i>
      </button>
    </div>
    <!-- /#page-content-wrapper -->
    <div class="card my-card-content">
        <div class="card-header">Products</div>
        <div class="card-body my-card-body">
            <div class="row" id="items">

            </div>
        </div>
    </div>
</div>
  <!-- /#wrapper -->
<!--Modal-->
<div class="modal fade my-product-modal" id="viewProduct" aria-labelledby="staticBackdropLabel" data-bs-backdrop="static" data-bs-keyboard="false"> 
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <link rel="stylesheet" href="..\assets\css\product-modal-style-A.css">
    <script src="..\assets\js\product-view-quantity.js"></script>
      <div class="modal-content my-modal-content">
        
      </div>
      
    </div>
</div>
<?php /* 
if(isset($_POST['addToCart'])){


}*/
?>

<script src="..\assets\js\customer-viewProduct.js"></script>
<script src="..\assets\js\customer-product-page.js"></script>
<?php include "customerFooter.php"; ?>