<?php 

$currentSubPage="setCharges";
include "OrderManagement.php"; ?>
<link rel="stylesheet" href="..\assets\css\order-charge-style.css">

<div class="container">
    <div class="row mt-2">
        <div class="col-md-5">
            <div class="card">
                <form id = 'chargesForm'>
                    <div class="card-header mycardheader"> Add Charges For payment Types</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating myFormFloating">
                                        <select class="form-select myselect" id="floatingSelect" name="paymentMethod">
                                            <option value="0" selected>Select</option>
                                            <option value="COD">Cash on Delivery</option>
                                            <option value="BD">Bank Deposit</option>
                                        </select>
                                        <label for="floatingSelect">Payment Method</label>
                                        <div id="strPayMethodError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-floating myFormFloating">
                                    <input type="text" class="form-control myinputText" name="location" id="floatingInput" placeholder=" ">
                                    <label for="floatingInput">Location</label>
                                    <div id="strLocationError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating myFormFloating">
                                    <input type="text" class="form-control myinputText" name="charge" id="floatingInput" placeholder=" ">
                                    <label for="floatingTextarea">Charges (Rs.)</label>
                                    <div id="strChargeError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="btn-col">
                                    <button class="btn myBtn" id="setCharges" type="submit" name="setCharges">Set Charges</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Charge ID</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Loation</th>
                            <th scope="col">charge (Rs)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id = "tableData">
                    <?php 
                        
                    ?>
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
</div>
<div class="modal fade" id="Update-modal" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-modal-style.css">
        <div class="modal-content">
           
        </div>
    </div>
</div>
<script src="..\assets\js\form-validation\admin-order-charge-form-validation.js"></script>

<?php include "adminFooter.php"; ?>