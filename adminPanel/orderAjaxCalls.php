<?php 
include "..\classes\DBConnect.php";
include "..\classes\OrderController.php";
include "..\classes\CartController.php";
include "..\classes\EmployeeController.php";
include "..\classes\DeliveryDriverController.php";
$db = new DatabaseConnection;
$orderObj = new OrderController;
$cartObj = new CartController;
$empObj = new EmployeeController;
$DelDriverObj = new DeliveryDriverController;
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'loadTable'){
    $orderRes = $orderObj->DisplayOrders();
    if($orderRes){
        foreach($orderRes as $row){
            ?>
            <tr>
                <th scope="col"><?=$row['Invoice_ID']?></th>
                <td><?=$row['Order_Date']?></td>
                <td><?=$row['order_status']?></td>
                <td><button class="btn viewbtn" id="view" data-paymentID="<?=$row['Payment_ID']?>" data-invoiceID = "<?=$row['Invoice_ID']?>" data-orderStatus ='<?=$row['order_status']?>'><i class="far fa-eye"></i> View</button></td>
            </tr>
            <?php
        }
    }else{
        ?>
        
        <tr><td colspan="4" class="label">No Orders Yet</td></tr>
        
        <?php
    }
}

if(isset($_REQUEST['task'])&& isset($_REQUEST['invoiceID']) && $_REQUEST['task']==='viewOrder'){
    $orderEmpResult = $orderObj->getEmpOforder($_REQUEST['invoiceID']);
    $up_row = $orderEmpResult -> fetch_assoc();
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
                        <div class="card-header mysubcardheader">Order Handling</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 label">Assign Employee For Order</div>
                                <form id="AssignEMP">
                                    <div class="col-md-8">
                                        <select name="empIDSelect" class="form-select">
                                            <option value="0">Select</option>
                                            <?php
                                            $empRes = $empObj -> getEmpData();
                                            if($empRes){
                                                foreach($empRes as $row){
                                                    ?>
                                                    <option value="<?=$row['Emp_ID']?>" <?php if ($up_row['Emp_ID'] === $row['Emp_ID'] ) echo 'selected'; ?> ><?=$row['Emp_ID']?> : <?=$row['FName']?></option>
                                                    <?php
                                                }
                                            }else{
                                                echo "<option value='0'>None</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="invoiceID" value="<?=$_REQUEST['invoiceID']?>">
                                    </div>
                                    <div class="col-md-4"><button class="btn btn-primary btn-sm" type='submit'>Assign</button></div>
                                </form>
                            </div>
                            <?php 
                            if($pmValue === 'COD'){
                                ?>
                                <div class="row mt-3">
                                <div class="col-md-12 label">Assign Delivery Driver</div>
                                <form id="AssignDriver">
                                    <div class="col-md-8">
                                        <select name="DriverSelect" class="form-select">
                                            <option value="0">Select</option>
                                            <?php
                                            $DELRes = $DelDriverObj -> getDeliveryDriverInfo();
                                            if($DELRes){
                                                foreach($DELRes as $row){
                                                    ?>
                                                    <option value="<?=$row['Driver_ID']?>"><?=$row['Driver_ID']?> : <?=$row['FName']?> :<?=$row['Vehicle_No']?> </option>
                                                    <?php
                                                }
                                            }else{
                                                echo "<option value='0'>None</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="paymentID" value="<?=$_REQUEST['paymentID']?>">
                                    </div>
                                    <div class="col-md-4"><button class="btn btn-primary btn-sm" type='submit'>Assign</button></div>
                                </form>
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
                <button class="btn myBtn readybtn " id="readyOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>" <?php if ($up_row['Emp_ID'] !== null ) echo 'disabled'; ?>>Ready</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Ready'){
                ?>
                <button class="btn myBtn confirmBtn" id="complete" data-invoiceID = "<?=$_REQUEST['invoiceID']?>" >Compelete</button>
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
                <button class="btn myBtn readybtn" id="readyOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>" <?php if ($up_row['Emp_ID'] !== null ) echo 'disabled'; ?>>Ready</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Ready'){
                ?>
                <button class="btn myBtn dispatchbtn" id="dispatch" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Dispatch</button>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else if($orderStatus === 'Dispatched'){
                ?>
                <button class="btn myBtn cancelBtn" id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }else{
                ?>
                <button class="btn myBtn cancelBtn" disabled id="cancelOrder" data-invoiceID = "<?=$_REQUEST['invoiceID']?>">Cancel</button>
                <?php
            }

        }
        ?>
    </div>
    <!-- ------------- -->
    <?php
}

?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'loadOnCondition'){
    if($_REQUEST['pm'] ==='all'){
        $invoiceRes = $orderObj->getInvoiceData($_REQUEST['os']);
    }else if($_REQUEST['pm'] ==='COD'){
        $invoiceRes = $orderObj->getInvoiceDataCODAndOS($_REQUEST['os']);
    }else if($_REQUEST['pm'] ==='BD'){
        $invoiceRes = $orderObj->getInvoiceDataBDAndOS($_REQUEST['os']);
    }else{
        $invoiceRes = $orderObj->getInvoiceDataPKAndOS($_REQUEST['os']);
    }
    if($invoiceRes){
        foreach($invoiceRes as $row){
            ?>
            <tr>
                <th scope="col"><?=$row['Invoice_ID']?></th>
                <td><?=$row['Order_Date']?></td>
                <td><?=$row['order_status']?></td>
                <td><button class="btn viewbtn" id="view" data-paymentID="<?=$row['Payment_ID']?>" data-invoiceID = "<?=$row['Invoice_ID']?>" data-orderStatus ='<?=$row['order_status']?>'><i class="far fa-eye"></i> View</button></td>
            </tr>
            <?php
        }
    }else{
        ?>
        
        <tr><td colspan="4" class="label">No Records</td></tr>
        
        <?php
    }
}


if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'updateOrderAdminStatus'){

    $result = $orderObj->updateOrderStatusAdmin($_REQUEST['invoice'],$_REQUEST['oStat']);
    if($result){
        echo 1;
    }else{
        echo $result;
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'AssignEmp'){

    $result = $orderObj->AssignEmp($_REQUEST['invoiceID'],$_REQUEST['EMPid']);
    if($result){
        echo 1;
    }else{
        echo $result;
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'AssignDriver'){

    $result = $orderObj->AssignDriver($_REQUEST['paymentId'],$_REQUEST['DriverId']);
    if($result){
        echo 1;
    }else{
        echo $result;
    }
}

?>