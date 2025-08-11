<?php 
$currentMainPage = "Home";
include "staffHeader.php";
?>

<link rel="stylesheet" href="..\assets\css\admin-dashboard-home-style-A.css">

<div class="container">
    <div class="card main-container">

    <div class="card-body main-body">

        <div class="row main-row">

            <div class="col main-col">

                <div class="card sub-card">

                    <div class="card-header my-card-header">Order Status</div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col">

                                <div class="card my-card-content-box">

                                    <div class="card-body my-content-box-body">

                                        <div class="card-title my-content-box-title">New Orders</div>

                                        <div class="card-text my-content-box-text">0</div>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="card my-card-content-box">

                                    <div class="card-body my-content-box-body">

                                        <div class="card-title my-content-box-title">Completed Orders</div>

                                        <div class="card-text my-content-box-text">0</div>

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
</div>

<?php include "staffFooter.php";?>