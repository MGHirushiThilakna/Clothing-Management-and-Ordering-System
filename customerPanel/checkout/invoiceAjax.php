<?php 
include "..\classes\DBConnect.php";
include "..\classes\OrderController.php";
include "..\classes\ProductController.php";
$db = new DatabaseConnection;
$orderObj = new OrderController;
$productObj = new ProductController;

if(isset($_REQUEST['task']) && $_REQUEST['task']==='displayInvoice'){
    $OrderRes = $orderObj->getInvoiceDataForCustomer($_REQUEST['custID'],$_REQUEST['status']);
    if($OrderRes){
        foreach($OrderRes as $row){
            $pmResult = $orderObj->getPaymentMethod($row['Payment_ID']);
            $pmData = $pmResult->fetch_assoc();
            $pmValue = $pmData['Payment_METHOD'];
            ?>
            <div class="card order-card">

                <div class="card-header order-card-header">Invoice No : <?=$row['Invoice_ID']?></div>

                <div class="card-body order-card-body">
                    <?php 
                    if($pmValue === 'COD'){
                        ?>
                        <span><Strong>Payment Method :</Strong> Cash on Delivery</span>
                        <?php
                        
                    }else if($pmValue === 'BD'){
                        ?>
                        <span><Strong>Payment Method :</Strong> Bank Deposit</span>
                        <?php
                    }else{
                        ?>
                        <span><Strong>Payment Method :</Strong> Store Pick up</span>
                        <?php
                    }
                    ?>
                    

                    <div class="row mt-2">

                        <div class="col"><button class="btn btn-outline-primary" data-invoiceID = '<?=$row['Invoice_ID']?>' data-paymentID='<?=$row['Payment_ID']?>' id="cust-view-order">View Order</button></div>
                        
                        <?php if($row['order_status'] ==='Pending') {?>

                        <div class="col"><button class="btn btn-outline-danger" data-invoiceID = '<?=$row['Invoice_ID']?>' data-paymentID='<?=$row['Payment_ID']?>' id="cust-cancel-order">Cancel Order</button></div>
                        
                        <?php } ?>
                    </div>
                    <?php 
                    if($pmValue === 'BD'){
                        ?>
                        <div class="row mt-2">

                            <form id="paymentProof">
                                <input type="hidden" id="paymentID" value="<?=$row['Payment_ID']?>">

                                <div class="col-12"><input type="file" name="proof" id="imgproof" class="form-control myChooseFile"></div>

                                <div class="col-md-12 mt-1 redda"><button type="submit" class="btn uploadbtn"> Upload </button></div>

                            </form>

                        </div>
                        <?php
                    }
                    ?>
                    

                </div>
                <div class="card-footer order-card-footer <?=$row['order_status']?>">Order Status: <span><?=$row['order_status']?></span></div>

            </div>

            <?php
        }
    }else{
        ?>
        <div class="card">
            <div class="card-body"><span class="h3">There is no any orders placed recently</span></div>
        </div>
        <?php
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task']==='displayCompletedInvoice'){
    $OrderRes = $orderObj->getCompletedInvoiceDataForCustomer($_REQUEST['custID'],$_REQUEST['status']);
    if($OrderRes){
        foreach($OrderRes as $row){
            $pmResult = $orderObj->getPaymentMethod($row['Payment_ID']);
            $pmData = $pmResult->fetch_assoc();
            $pmValue = $pmData['Payment_METHOD'];
            ?>
            <div class="card order-card">

                <div class="card-header order-card-header">Invoice No : <?=$row['Invoice_ID']?></div>

                <div class="card-body order-card-body">
                    <?php 
                    if($pmValue === 'COD'){
                        ?>
                        <span><Strong>Payment Method :</Strong> Cash on Delivery</span>
                        <?php
                        
                    }else if($pmValue === 'BD'){
                        ?>
                        <span><Strong>Payment Method :</Strong> Bank Deposit</span>
                        <?php
                    }else{
                        ?>
                        <span><Strong>Payment Method :</Strong> Store Pick up</span>
                        <?php
                    }
                    ?>
                    

                    <div class="row mt-2">

                        <div class="col"><button class="btn btn-outline-primary" data-invoiceID = '<?=$row['Invoice_ID']?>' data-paymentID='<?=$row['Payment_ID']?>' id="cust-view-order">View Order</button></div>
                        
                        <?php if($row['order_status'] ==='Pending') {?>

                        <div class="col"><button class="btn btn-outline-danger" data-invoiceID = '<?=$row['Invoice_ID']?>' data-paymentID='<?=$row['Payment_ID']?>' id="cust-cancel-order">Cancel Order</button></div>
                        
                        <?php } ?>
                    </div>
                    <?php 
                    if($pmValue === 'BD'){
                        ?>
                        <div class="row mt-2">

                            <form id="paymentProof">
                                <input type="hidden" id="paymentID" value="<?=$row['Payment_ID']?>">

                                <div class="col-12"><input type="file" name="proof" id="imgproof" class="form-control myChooseFile"></div>

                                <div class="col-md-12 mt-1 redda"><button type="submit" class="btn uploadbtn"> Upload </button></div>

                            </form>

                        </div>
                        <?php
                    }
                    ?>
                    

                </div>
                <div class="card-footer order-card-footer <?=$row['order_status']?>">Order Status: <span><?=$row['order_status']?></span></div>

            </div>

            <?php
        }
    }else{
        ?>
        <div class="card">
            <div class="card-body"><span class="h3">There is no any orders placed recently</span></div>
        </div>
        <?php
    }
}

if(isset($_REQUEST['task'])&& isset($_REQUEST['invoice']) && $_REQUEST['task']==='viewCustomerOrder'){
    $pmResult = $orderObj->getPaymentMethod($_REQUEST['payment']);
    $pmData = $pmResult->fetch_assoc();
    $pmValue = $pmData['Payment_METHOD'];
    $contact;$address;
    if($pmValue === "Pick"){
        $contact = $pmData['Contact_NO'];
        $address = "None";
    }else{
        $contact=$pmData['Contact_NO'];
        $address=$pmData['Delivery_Address'];
    }
    ?>
    <!--Modal Header -->
    <div class="modal-header my-modal-header mycardheader">

        <div class="modal-title My-modal-title">INVOICE #<?=$_REQUEST['invoice']?> Order </div>

        <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>
    <!-- ------------- -->
    <!-- Modal body -->
    <div class="modal-body">

        <div class="row">

            <div class="col-md-8">

                <div class="table-responsive">

                    <table class="table table-sm">

                        <thead>

                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Quantity</th>
                            </tr>

                        </thead>

                        <tbody id="modalOrder">
                            <?php 
                            $result = $orderObj->getOrderInFoTable($_REQUEST['invoice']);
                            foreach($result as $row){
                                ?>
                                    <tr>
                                        <td><?=$row['Product_ID']?>: <?=$row['Pro_Name']?></td>
                                        <td><?=$row['Size_ID']?>: <?=$row['Size_Value']?></td>
                                        <td><?=$row['Color_ID']?>: <i class="fas fa-square" style="color: <?=$row['Color_Value']?>"></i>: <?=$row['Color_Name']?></td>
                                        <td><?=$row['Order_Qty']?></td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody> 

                    </table>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-header mysubcardheader">Your InFo Details</div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 label">Delevery Address:</div>

                            <div class="col"><?=$address?></div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 label">Contact No:</div>
                            <div class="col"><?=$contact?></div>
                        </div>
                        <div class="row mt-3">

                            <div class="col-md-6 label">Payment Method:</div>

                            <div class="col">

                            <?php 
                                if($pmValue === 'COD'){
                            ?>
                                Cash on Delivery
                            <?php
                            }else if($pmValue === 'BD'){
                            ?>
                                Bank Deposit
                            <?php
                            }else{
                            ?>
                                Pick Up
                            <?php
                            }
                            ?>
                            </div>

                        </div>
                            <?php if($pmValue === 'BD'){?>

                            <div class="row mt-3">

                                <div class="col-md-6 label">Payment Proof:</div>

                                    <div class="col">

                                        <?php 
                                            $payBDResult=$orderObj->getImgProofBDPayment($_REQUEST['payment']);
                                            if($payBDResult){
                                                $pBDData = $payBDResult->fetch_assoc();
                                                $payProof = $pBDData['Payment_Proof'];
                                                if(is_null($payProof)){
                                                    ?><a href="#" class="btn btn-outline-danger">No Image</a><?php
                                                }else{
                                                    ?><a href="data:image/jpg;base64,<?=base64_encode($payProof)?>"  target="_blank" class="btn btn-outline-success" id="proofimgview">view Image</a><?php
                                                }
                                            }
                                        ?>
                                            
                                    </div>
                                </div>
                                    <?php
                                } ?>
                                
                            </div>
                    </div>

                </div>

        </div>

    </div>

    <?php
}


if(isset($_REQUEST['task']) && $_REQUEST['task']==='updateProof'){
    $updateResult = $orderObj->updatePaymentProof($_FILES['proof']['tmp_name'],$_REQUEST['paymentID']);
    if($updateResult){
        echo 1;
    }else{
        echo $updateResult;
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task']==='cancelOrder'){

    $orderResult = $orderObj->getOrderInFoTable($_REQUEST['invoice']);

    foreach($orderResult as $orderRow){

        $productObj->addBackToStock($orderRow['Product_ID'],$orderRow['Color_ID'],$orderRow['Size_ID'],$orderRow['Order_Qty']);
    }

    $invoiceResult = $orderObj->RemoveRecordsFromInvoice($_REQUEST['invoice']);

    if($invoiceResult){

        $paymentResult = $orderObj->RemovePaymentRecord($_REQUEST['payment']);

        if($paymentResult){

            echo 1;
        }else{
            echo 0;
        }
    }

    
}



?>