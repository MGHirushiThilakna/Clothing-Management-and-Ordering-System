<?php 
include "..\classes\DBConnect.php";
include "..\classes\ChargeController.php";
include "..\classes\CustomerController.php";
$db = new DatabaseConnection;
$chargeObj = new ChargeController;
$userObj = new CustomerController();
session_start();
$customerResult = $userObj->getInfoForUpate($_SESSION['customerID']);
$customerdata = $customerResult -> fetch_assoc();
?>
<script src="..\assets\js\checkout-payment-option.js"></script>
<?php 
if(isset($_REQUEST['form']) && isset($_REQUEST['task']) && $_REQUEST['form'] =='COD' && $_REQUEST['task']=='show'){
  
    ?>
    <div class="card-header mydeliveryHeader">Cash on Delivery</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4 mylabel">Delivery Location</div>
                  <div class="col-8">
                    <select class="form-select" name="location" id="location">
                      <option value="0" selected>Select</option>
                      <?php 
                        $result = $chargeObj->displaychargesForPaymentMethods("COD");
                        if($result){
                          foreach($result as $item){?>
                            <option value="<?=$item['charge_ID']?>" ><?=$item['Location']?></option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-4 mylabel">Delivery Fees</div>
                  <div class="col-8">Rs <span class="fw-bold" id="deliveryFee">0.00</span></div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3 mylabel mb-1">Delivery Address</div>
                  <div class="col-11"><textarea class="form-control" name="deliveryCODAddress"><?=$customerdata['Address']?></textarea></div>
                  <div class="col-1 icon">
                    <button class="btn btn-outline-danger" id="COD_Address_edit"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-success" id="COD_Address_save"><i class="far fa-save"></i></button>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3 mylabel mb-1">Contact Number</div>
                  <div class="col-11"><input type="text" class="form-control" name="CODContact" value="<?=$customerdata['Contact_NO']?>"></div>
                  <div class="col-1 icon">
                    <button class="btn btn-outline-danger" id="COD_Contact_edit"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-success" id="COD_Contact_save"><i class="far fa-save"></i></button>
                  </div>
                </div>
              </div>
              
    <?php
}
?>

<?php 
if(isset($_REQUEST['form']) && isset($_REQUEST['task']) && $_REQUEST['form'] =='BD' && $_REQUEST['task']=='show'){

    ?>
    <div class="card-header mydeliveryHeader">Bank Deposit</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4 mylabel">Delivery District</div>
                  <div class="col-8">
                    <select class="form-select" name="location" id="location">
                      <option value="0" selected>Select</option>
                      <?php 
                        $result = $chargeObj->displaychargesForPaymentMethods("BD");
                        if($result){
                          foreach($result as $item){?>
                            <option value="<?=$item['charge_ID']?>" ><?=$item['Location']?></option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-4 mylabel">Courier Charges</div>
                  <div class="col-8">Rs <span class="fw-bold" id="deliveryFee">0.00</span></div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3 mylabel mb-1">Delivery Address</div>
                  <div class="col-11"><textarea class="form-control" name="BDdeliveryAddress"><?=$customerdata['Address']?></textarea></div>
                  <div class="col-1 icon">
                    <button class="btn btn-outline-danger" id="BD_Address_edit"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-success" id="BD_Address_save"><i class="far fa-save"></i></button>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3 mylabel mb-1">Contact Number</div>
                  <div class="col-11"><input type="text" class="form-control" name="BDContact" value="<?=$customerdata['Contact_NO']?>"></div>
                  <div class="col-1 icon">
                    <button class="btn btn-outline-danger" id="BD_Contact_edit"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-success" id="BD_Contact_save"><i class="far fa-save"></i></button>
                  </div>
                </div>
              </div>

    <?php
}
?>

<?php 
if(isset($_REQUEST['form']) && isset($_REQUEST['task']) && $_REQUEST['form'] =='Pick' && $_REQUEST['task']=='show'){

    ?>
    <div class="card-header mydeliveryHeader">Pick Up</div>
              <div class="card-body">
                <div class="row mt-2">
                  <div class="col-md-3 mylabel mb-1">Contact Number</div>
                  <div class="col-11"><input type="text" class="form-control" name="PContact" value="<?=$customerdata['Contact_NO']?>"></div>
                  <div class="col-1 icon">
                    <button class="btn btn-outline-danger" id="P_Contact_edit"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-success" id="P_Contact_save"><i class="far fa-save"></i></button>
                  </div>
                </div>
              </div>
    <?php
}
?>

