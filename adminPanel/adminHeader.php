<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HAH Admin Panel</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <!--fontawsome icons -->
    <link rel="stylesheet" href="../assets/icons/css/all.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="../assets/css/admin-navbar-style-A.css" />
    <!-- Sweet Alert 2-->
    <script src="..\assets\sweetalert2\jquery-3.5.1.min.js"></script>
    <script src="..\assets\sweetalert2\sweetalert2.all.min.js"></script>
</head>
<body>  
    <nav class="navbar navbar-expand-lg myNavbar" >
        <div class="container-fluid">
            <span class="navbar-band myNavbarBand">
                <img src="../assets/imgs/hah-collection-logo1.png" alt="logo" class="logo"> Admin Panel
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  myNavbarNav justify-content-center">
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'adminHome' ? 'active' : '' ?>"  href="DashHome.php">Dashboard</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'EmpManage' ? 'active' : '' ?>"  href="AddEmp.php">Employee Management</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'CategoryPage' ? 'active' : '' ?>"  href="addMainCategory.php">Category Handling</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'Supplier' ? 'active' : '' ?>"  href="viewSupplier.php">Supplier</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'products' ? 'active' : '' ?>"  href="viewProduct.php">Product Management</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'offers' ? 'active' : '' ?>"  href="privateOffer.php">Offer Management</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'orders' ? 'active' : '' ?>"  href="viewOrders.php">Order Management</a>
                    </li>
                    <li class="nav-item mynavitem">
                        <a class="nav-link mynavLink <?php echo $currentMainPage == 'delivery' ? 'active' : '' ?>"  href="addDeliveryDriver.php">Delivery Handling</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </nav>
