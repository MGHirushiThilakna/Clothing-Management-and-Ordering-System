<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HAH collections</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <!--fontawsome icons -->
    <link rel="stylesheet" href="assets/icons/css/all.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="assets/css/navbar-style-A.css" />
    <!-- JQuery and Sweet Alert-->
    <script src="assets\sweetalert2\jquery-3.5.1.min.js"></script>
    <script src="assets\sweetalert2\sweetalert2.all.min.js"></script>
</head>
<body>    

<nav class="navbar navbar-expand-lg my-navcolor">
    <div class="container-fluid ">
        <span class="navbar-brand mb-0 heading">
            <img src="assets/imgs/hah-collection-logo1.png" alt="Logo" class="logo">HAH <span class="post">Collections </span>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav my-navbar-nav justify-content-center">
                <li class="nav-item mynavitem">
                <a class="nav-link mynavLink"  href="index.php">Home</a>
                </li>
                <form class="d-flex search-box">
                    <input class="form-control search-input " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
                 </form>
            </ul>
            
                <a class="btn btn-outline my-btn" href="login.php"><i class="far fa-user-circle fa-lg"></i> Sign In</a>
                <button class="btn btn-outline my-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-cart-plus fa-lg"></i> Cart</button>
            
        </div>
    </div>
</nav>
<div class="container">
    <div class="offcanvas offcanvas-end my-canvas" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Your Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body my-canvas-body">

    </div>
    </div>
</div>





