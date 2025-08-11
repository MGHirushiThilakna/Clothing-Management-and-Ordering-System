<?php 
$currentMainPage ="products";
include "adminHeader.php"; 
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
include "..\classes\CategoryController.php";
include "..\classes\SupplierController.php";
$db = new DatabaseConnection;
$colorObj = new ProductController;
$sizeObj = new ProductController;
$productObj = new ProductController;
$categoryObj = new CategoryController;
$supplierObj = new SupplierController;
?>
<nav class="navbar navbar-expand-lg myNavbarSub" >
    <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentSub" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContentSub">
        <ul class="navbar-nav myNavbarNavSub justify-content-center">
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'view' ? 'active' : '' ?>"  href="viewProduct.php">View</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'add' ? 'active' : '' ?>"  href="addProduct.php">New Product</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'colorSize' ? 'active' : '' ?>"  href="addcolorsize.php">New Color</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'Size' ? 'active' : '' ?>"  href="addSize.php">New Size</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'stock' ? 'active' : '' ?>"  href="manageStock.php">Manage Stock</a>
            </li>
        </ul>

    </div>
    </div>
</nav>