<?php 
include "..\classes\DBConnect.php";
include "..\classes\OrderController.php";
$db = new DatabaseConnection;
$orderObj = new OrderController;

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showDispatchOrders'){
    $orderRes = $orderObj->getDispatchedOrderDriver($_REQUEST['deliveryID']);
    if($orderRes){
        foreach($orderRes as $row){
            ?>
            <tr>
                <th scope="col"><?=$row['Invoice_ID']?></th>
                <td><?=$row['order_status']?></td>
                <td><button class="btn viewbtn" id="view" data-paymentID="<?=$row['Payment_ID']?>" data-invoiceID = "<?=$row['Invoice_ID']?>" data-orderStatus ='<?=$row['order_status']?>'><i class="far fa-eye"></i> View</button></td>
            </tr>
            <?php
        }
    }else{
        ?>
        
        <tr><td colspan="3" class="label">No Orders Yet</td></tr>
        
        <?php
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showCompleteOrders'){
    $orderRes = $orderObj->getCompleteOrderDriver($_REQUEST['deliveryID']);
    if($orderRes){
        foreach($orderRes as $row){
            ?>
            <tr>
                <th scope="col"><?=$row['Invoice_ID']?></th>
                <td><?=$row['order_status']?></td>
                <td><button class="btn viewbtn" id="view" data-paymentID="<?=$row['Payment_ID']?>" data-invoiceID = "<?=$row['Invoice_ID']?>" data-orderStatus ='<?=$row['order_status']?>'><i class="far fa-eye"></i> View</button></td>
            </tr>
            <?php
        }
    }else{
        ?>
        
        <tr><td colspan="3" class="label">No Orders Yet</td></tr>
        
        <?php
    }
}

?>
<?php
if(isset($_REQUEST['task']) && isset($_REQUEST['invoiceID']) && $_REQUEST['task']==='viewOrder'){
    $pmResult = $orderObj->getPaymentMethod($_REQUEST['paymentID']);
    $orderStatus = $_REQUEST['orderStatus'];
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
        <div class="modal-title My-modal-title">INVOICE #<?=$_REQUEST['invoiceID']?> Order </div>
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
                            $result = $orderObj->getOrderInFoTable($_REQUEST['invoiceID']);
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
                <div class="row">
                    <div class="col">
                    <div class="card">
                        <div class="card-header mysubcardheader">Bill info</div>
                        <div class="card-body">
                            <?php 
                            $resultBill = $orderObj->getBillingInfoCOD($_REQUEST['paymentID']);
                            if($resultBill){
                                $billData = $resultBill->fetch_assoc();
                                ?>
                                 <div class="row">
                                    <div class="col-md-6 label">Delivery Charges:</div>
                                    <div class="col fw-bold">Rs <?=$billData['Delivery_Fee']?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 label">Total :</div>
                                    <div class="col fw-bold">Rs <?=$billData['Total']?></div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="row">
                                    <div class="col-md-6 label">Delivery Charges:</div>
                                    <div class="col">None</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 label">Total:</div>
                                    <div class="col">None</div>
                                </div>
                                <?php
                            }
                            ?>                       
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="card">
                        <div class="card-header mysubcardheader">Customer Details</div>
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
                            <?php if($pmValue === 'BD'){
                                ?>
                                <div class="row mt-3">
                                    <div class="col-md-6 label">Payment Proof:</div>
                                    <div class="col">
                                        <?php 
                                        $payBDResult=$orderObj->getImgProofBDPayment($_REQUEST['paymentID']);
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
        </div>

    </div>
    <div class="modal-footer my-modal-footer">
        <?php 
        if($pmValue === 'Pick'){
            if($orderStatus === 'Pending'){
                ?>
                <button class="btn myBtn confirmBtn" id="confirmOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>" >Confirm Order</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Confirmed'){
                ?>
                <button class="btn myBtn readybtn" id="readyOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Ready</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Ready'){
                ?>
                <button class="btn myBtn confirmBtn" id="complete" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Compelete</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else{
                ?>
                <button class="btn myBtn cancelBtn" disabled id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }
        }else{
            if($orderStatus === 'Pending'){
                ?>
                <button class="btn myBtn confirmBtn" id="confirmOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>" >Confirm Order</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Confirmed'){
                ?>
                <button class="btn myBtn readybtn" id="readyOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Ready</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Ready'){
                ?>
                <button class="btn myBtn dispatchbtn" id="dispatch" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Dispatch</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Dispatched'){
                ?>
                <button class="btn myBtn confirmBtn" id="complete" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Compelete</button>
                <?php
            }else{
                ?>
                <button class="btn myBtn confirmBtn" disabled id="complete" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Compeleted</button>
                <?php
            }

        }
        ?>
    </div>
    <!-- ------------- -->
    <?php
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'updateOrderAdminStatus'){

    $result = $orderObj->updateOrderStatusAdmin($_REQUEST['invoice'],$_REQUEST['oStat']);
    if($result){
        echo 1;
    }else{
        echo $result;
    }
}

?>