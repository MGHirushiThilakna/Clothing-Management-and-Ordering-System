<?php 
$currentMainPage ="adminHome";
include "adminHeader.php"; 
?>
<nav class="navbar navbar-expand-lg myNavbarSub" >
    <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentSub" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContentSub">
        <ul class="navbar-nav myNavbarNavSub justify-content-center">
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'adminHome' ? 'active' : '' ?>"  href="DashHome.php">Home</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'sales' ? 'active' : '' ?>"  href="sales.php">Sales Progress</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'manageAdmin' ? 'active' : '' ?>"  href="ManageAdmin.php">Manage Admin</a>
            </li>
            <li class="nav-item mynavitemSub">
                <a class="nav-link mynavLinkSub <?php echo $currentSubPage == 'adminPass' ? 'active' : '' ?>"  href="adminChangePassword.php">Change Password</a>
            </li>
        </ul>

    </div>
    </div>
</nav>

