<?php 
$currentSubPage="view";
include "ProductManagement.php"; ?>
<link rel="stylesheet" href="..\assets\css\admin-view-product.css">
<div class="container">
    <div class="card">
        <div class="card-body main-card-body">
            <div class="table-responsive">
                <table class="table main-tbl">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="pro_Data">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view-admin-product" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-view-product-All-details.css">
        <div class="modal-content view-content">
            
        </div>
    </div>
</div>

<div class="modal fade" id="update-admin-product" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-view-product-All-details.css">
        <div class="modal-content update-content">
                        
        </div>
    </div>
</div>
<script src="..\assets\js\form-validation\admin-product-view.js"></script>
<?php include "adminFooter.php"; ?>