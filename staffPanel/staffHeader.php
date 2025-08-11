<?php
session_start();
if(!isset( $_SESSION['empID'])){
    header("location:../login.php");
} 
$empID = $_SESSION['empID'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HAH Staff Panel</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <!--fontawsome icons -->
    <link rel="stylesheet" href="../assets/icons/css/all.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="../assets/css/customer-navbar-style.css" />
    <!-- jQuery -->
    <script src="..\assets\sweetalert2\jquery-3.5.1.min.js"></script>
    <script src="..\assets\sweetalert2\sweetalert2.all.min.js"></script>
    <script src="..\assets\js\logoutProccess.js"></script>
</head>
<body>  
    <nav class="navbar navbar-expand-lg myNavbar" >
        <div class="container-fluid">
            <span class="navbar-band myNavbarBand">
                <img src="../assets/imgs/hah-collection-logo1.png" alt="logo" class="logo">HAH <span class="post">Collections </span>
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  myNavbarNav justify-content-center">
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'Home' ? 'active' : '' ?>"  href="index.php">Home</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'profile' ? 'active' : '' ?>"  href="staffProfile.php">Profile</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'Orders' ? 'active' : '' ?>"  href="StaffOrders.php">Orders</a>
                    </li>
                </ul>
                <div class="btn-box">
                    <a class="btn btn-outline my-btn my-btn-signout" href="" id="signout"><i class="far fa-user-circle fa-lg" ></i> Sign out</a>
                </button>
                </div>
            </div>
        </div>
        
    </nav>