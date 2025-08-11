<?php 
$currentSubPage="assignOffer";
include "OfferManagement.php"; 
?>
<link rel="stylesheet" href="..\assets\css\admin-assign-offer-style.css">
<div class="container">
    <div class="card form-card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 off-my-col">
                        <form class="d-flex search-box" id="CustSearch">
                            <select class="form-control search-input select-input" name="customer_col">
                                <option value ="Customer_ID" selected>Customer ID</option>
                                <option value ="FName">First Name </option>
                                <option value ="LName">Last Name </option>
                                <option value ="Email">Email Address</option>
                                <option value ="Contact_NO">Contact Number</option>
                            </select>
                            <input class="form-control search-input " name="searchData" type="search" placeholder="Search" aria-label="Search">
                            
                            <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table cust-tbl">
                    <thead>
                        <tr>
                            <th scope="col">Customer ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact No</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id ="showCustomerData">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="assignOfferModal" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-assign-offer-style.css">
        <div class="modal-content assign-content">
                       
        </div>
    </div>
</div>
<script src="../assets/js/admin-offer-assign.js"></script>
<?php include "adminFooter.php"; ?>