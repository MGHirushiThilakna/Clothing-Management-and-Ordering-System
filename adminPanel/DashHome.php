<?php 
$currentSubPage="adminHome";
include "admin.php"; ?>
<link rel="stylesheet" href="..\assets\css\admin-dashboard-home-style-A.css">

<div class="card main-container">

    <div class="card-body main-body">

        <div class="row main-row">

            <div class="col main-col">

                <div class="card sub-card">

                    <div class="card-header my-card-header">Category Status</div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col">

                                <div class="card my-card-content-box">

                                    <div class="card-body my-content-box-body">

                                        <div class="card-title my-content-box-title">Main</div>

                                        <div class="card-text my-content-box-text">4</div>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="card my-card-content-box">

                                    <div class="card-body my-content-box-body">

                                        <div class="card-title my-content-box-title">Sub</div>

                                        <div class="card-text my-content-box-text">16</div>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="card my-card-content-box">

                                    <div class="card-body my-content-box-body">

                                        <div class="card-title my-content-box-title">Brand</div>

                                        <div class="card-text my-content-box-text">5</div>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="card my-card-content-box">

                                    <div class="card-body my-content-box-body">

                                        <div class="card-title my-content-box-title">Supplier</div>

                                        <div class="card-text my-content-box-text">5</div>
                                        
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            
            <div class="col main-col">
                <div class="card sub-card">
                    <div class="card-header my-card-header">Order Status</div>
                    <div class="card-body">
                    <div class="row">
                            <div class="col">
                            <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">New Orders</div>
                                        <div class="card-text my-content-box-text">4</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Ready Orders</div>
                                        <div class="card-text my-content-box-text">16</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                            <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Completed Orders</div>
                                        <div class="card-text my-content-box-text">4</div>
                                        
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row main-row">
            <div class="col main-col">
                <div class="card sub-card">
                    <div class="card-header my-card-header">Product Returns</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                            <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Return Requests</div>
                                        <div class="card-text my-content-box-text">4</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Rejected Requests</div>
                                        <div class="card-text my-content-box-text">5</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Approved Requests</div>
                                        <div class="card-text my-content-box-text">5</div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col main-col">
                <div class="card sub-card">
                    <div class="card-header my-card-header">Products</div>
                    <div class="card-body">
                    <div class="row">
                            <div class="col">
                                <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Instock</div>
                                        <div class="card-text my-content-box-text">4</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Out of stock</div>
                                        <div class="card-text my-content-box-text">4</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card my-card-content-box">
                                    <div class="card-body my-content-box-body">
                                        <div class="card-title my-content-box-title">Low in Stock</div>
                                        <div class="card-text my-content-box-text">5</div>
                                        
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "adminFooter.php"; ?>