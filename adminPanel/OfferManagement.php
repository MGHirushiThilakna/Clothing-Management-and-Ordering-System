<?php 
$currentMainPage ="offers";
include "adminHeader.php";
include "..\classes\DBConnect.php";
include "..\classes\offerController.php";
$db = new DatabaseConnection;
$offerObj = new offerController;
?>

<nav class="navbar navbar-expand-lg myNavbarSub" >
    <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentSub" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContentSub">
        <ul class="navbar-nav myNavbarNavSub justify-content-center">
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'public' ? 'active' : '' ?>"  href="publicOffer.php">Public Offers</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'private' ? 'active' : '' ?>"  href="privateOffer.php">Private Offers</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'assignOffer' ? 'active' : '' ?>"  href="assign_private_offer.php">Assign Offer</a>
            </li>
            
        </ul>

    </div>
    </div>
</nav>


