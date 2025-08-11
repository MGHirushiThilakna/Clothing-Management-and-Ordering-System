<?php 
$currentMainPage ="orders";
include "adminHeader.php"; 
include "..\classes\DBConnect.php";
include "..\classes\ChargeController.php";
$db = new DatabaseConnection;
$chargeObj = new ChargeController;
?>
<nav class="navbar navbar-expand-lg myNavbarSub" >
    <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentSub" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContentSub">
        <ul class="navbar-nav myNavbarNavSub justify-content-center">
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'viewOrders' ? 'active' : '' ?>"  href="viewOrders.php">View Orders</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'setCharges' ? 'active' : '' ?>"  href="charges.php">Set Charges</a>
            </li>
        </ul>

    </div>
    </div>
</nav>