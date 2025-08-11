<?php 
session_start();
if(!isset( $_SESSION['customerID'])){
    header("location:../login.php");
}
$customerID =  $_SESSION['customerID'];
$_SESSION['cart_customerID'] = $customerID;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HAH collections</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <!--fontawsome icons -->
    <link rel="stylesheet" href="../assets/icons/css/all.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="../assets/css/customer-navbar-style.css" />
    <!-- jQuery -->
    <script src="..\assets\sweetalert2\jquery-3.5.1.min.js"></script>
    <script src="..\assets\sweetalert2\sweetalert2.all.min.js"></script>
    <script src="..\assets\js\customer-cart.js"></script>
    
</head>
<body onload="loadAllProducts()">  
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
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'products' ? 'active' : '' ?>"  href="custProducts.php">Products</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'MyOffers' ? 'active' : '' ?>"  href="custOffer.php">My Offers</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'MyOrders' ? 'active' : '' ?>"  href="custOrders.php">My Orders</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'profile' ? 'active' : '' ?>"  href="custProfile.php">My Profile</a>
                    </li>
                </ul>
                <div class="btn-box">
                    <a class="btn btn-outline my-btn my-btn-signout" href="" id="signout"><i class="far fa-user-circle fa-lg" ></i> Sign out</a>
                    <button class="btn btn-outline my-btn" id="addtocart" type="button" data-custId="<?php echo $customerID; ?>" onclick="loadCart()"><i class="fas fa-cart-plus fa-lg"></i> Cart
                    <span class="badge rounded-pill bg-danger" id="cartBadge">
                        
                    </span>
                </button>
                </div>
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

            <div class="offcanvas-footer">
                <div class="card">
                    <div class="card-body cart-footer">
                        <div class="row" id="cartTotal">
                            <span class="h5">Your Total is : Rs 0.00</span>
                        </div>
                        <div class="row">
                        <a class="btn btn-primary" href="checkout.php"><i class="far fa-arrow-alt-circle-right"></i> Checkout</a>
                        </div>
                    </div>
                </div>
             </div>

        </div>
    </div>