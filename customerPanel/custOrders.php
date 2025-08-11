<?php 
$currentMainPage = "MyOrders";
include "customerHeader.php"; ?>
<link rel="stylesheet" href="..\assets\css\delivery-order-style.css">
<link rel="stylesheet" href="..\assets\css\customer-delivery-order-style.css">
<div class="d-flex mywrapper" id="wrapper">

  <!-- Sidebar -->
  <div class="bg-light border-right" id="sidebar">
    <ul>
      <li><a href='#' id="currentOrders">Your Pending Orders</a></li>
      <li><a href='#' id="completedOrders">Order History</a></li>
    </ul>

  </div>
  <!-- /#sidebar -->

<!-- Page Content -->
  <div id="page-content-wrapper">
    <button type="button" class="btn btn-primary d-lg-none" id="sidebarCollapse">
    <i class="fas fa-angle-double-right"></i>
    </button>
  </div>
<!-- /#page-content-wrapper -->
    <div class="card my-card-content">
      <div class="card-body my-order-card-body">

        <div class="row order-row" id = "displayInvoice" data-customerid="<?=$customerID?>">

          
          
        </div>

      </div>    
    </div>

      

</div>
<!-- /#wrapper -->

<div class="modal fade" id="view-customer-order" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-view-orders.css">
        <div class="modal-content cust-order-content">
           
        </div>
    </div>
</div>
<script src="..\assets\js\delivery-orderPage.js"></script>
<?php include "customerFooter.php"; ?>