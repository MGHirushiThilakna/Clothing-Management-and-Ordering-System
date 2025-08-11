<?php 
$currentSubPage="viewOrders";
include "OrderManagement.php"; 

?>
<link rel="stylesheet" href="..\assets\css\admin-view-orders.css">

<div class="container">
    <div class="card form-card mb-3 mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 off-my-col">
                    <form class="d-flex search-box">
                        <input class="form-control search-input " type="search" placeholder="Invoice ID" aria-label="Search">
                        <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="form-floating myFormFloating">
                        <select class="form-select myselect" id="floatingSelect" name="orderStatus">
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Ready">Ready</option>
                            <option value="Dispatched">Dispatched</option>
                            <option value="Completed">Completed</option>
                        </select>
                            <label for="floatingSelect">Order Status</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating myFormFloating">
                        <select class="form-select myselect" id="floatingSelect" name="paymentMethods">
                            <option value="all">All</option>
                            <option value="COD">Cash On Delivery</option>
                            <option value="BD">Bank Deposit</option>
                            <option value="Pick">Pick Up</option>
                        </select>
                            <label for="floatingSelect">Payment Method</label>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Invoice ID</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                        
            </tbody> 
        </table>
    </div>
</div>
<div class="modal fade" id="viewEachOrder" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-view-orders.css">
        <div class="modal-content">
           
        </div>
    </div>
</div>
<script src="..\assets\js\viewOrder.js"></script>
<?php include "adminFooter.php"; ?>