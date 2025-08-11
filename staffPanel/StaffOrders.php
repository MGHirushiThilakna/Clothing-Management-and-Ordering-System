<?php 
$currentMainPage = "Orders";
include "staffHeader.php";
?>
<link rel="stylesheet" href="..\assets\css\delivery-order-style.css">
<div class="d-flex mywrapper" id="wrapper">

<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar">
  <ul>
    <li><a href="#" id="newOrders">New Assigned Orders</a></li>
    <li><a href="#" id="orderHistory">Ready Orders</a></li>
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
    <div class="card-header">Product Order Info</div>
    <div class="card-body my-card-body">
    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Invoice ID</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id='showOrders' data-staffID = '<?=$empID?>'>
                  
            </tbody> 
        </table>
    </div>
    </div>
</div>
<div class="modal fade" id="viewEachOrder" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-view-orders.css">
        <div class="modal-content">
           
        </div>
    </div>
</div>
</div>
<!-- /#wrapper -->

<script src="..\assets\js\deliveryPanel-order.js"></script>
<script src="..\assets\js\staffPanel-order.js"></script>
<?php include "staffFooter.php";?>