<?php 
$currentMainPage ="CategoryPage";
include "adminHeader.php"; 
include "..\classes\DBConnect.php";
include "..\classes\CategoryController.php";
?>
<nav class="navbar navbar-expand-lg myNavbarSub" >
    <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentSub" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContentSub">
        <ul class="navbar-nav myNavbarNavSub justify-content-center">
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'mainCat' ? 'active' : '' ?>"  href="addMainCategory.php">Add Main Category</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'subCat' ? 'active' : '' ?>"  href="addSubCategory.php">Add Sub Category</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'Brand' ? 'active' : '' ?>"  href="addBrandName.php">Add Brand Names</a>
            </li>
        </ul>

    </div>
    </div>
</nav>
<?php include "adminFooter.php"; ?>