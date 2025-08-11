<?php 
$currentMainPage ="Supplier";
include "adminHeader.php";
include "..\classes\DBConnect.php";
include "..\classes\SupplierController.php";
$db = new DatabaseConnection;
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
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'viewSup' ? 'active' : '' ?>"  href="viewSupplier.php">View suppliers</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'addSup' ? 'active' : '' ?>"  href="addSupplier.php">Add New Suppliers</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'reOrderStock' ? 'active' : '' ?>"  href="reOrder.php">Reorder stock</a>
            </li>
        </ul>

    </div>
    </div>
</nav>