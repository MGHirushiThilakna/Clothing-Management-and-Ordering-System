<?php 
include "..\classes\DBConnect.php";
include "..\classes\offerController.php";
$db = new DatabaseConnection;
$offerObj = new offerController;

if(isset($_POST['value']) && $_POST['value'] === 'private'){?>

 <!--Modal header-->
 <div class="modal-header my-modal-header">
    <div class="modal-title My-modal-title">Add New Private offer</div>
    <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<!--Modal body -->
<div class="modal-body">
    <form method="post">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_title" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Offer Title</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_name" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Offer Name</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <textarea class="form-control myinputTextArea" name="off_Desc"  placeholder=" " id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Offer Description</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_billValue" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Total Bill Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <select class="form-select myselect" id="floatingSelect" name="off_type">
                        <option value="0">Select</option>
                        <option value="percentage">percentage</option>
                        <option value="Cash">Cash</option>
                    </select>
                        <label for="floatingSelect">Discount Type</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_value" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Discount Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_from_Date" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Start Date</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_to_Date" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">End Date</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="btn-col">
                    <button class="btn myBtn" id="btnAdd" type="submit" name="offer-private-add">Add Offer</button>
                </div>         
            </div>
        </div>
    </form>
</div>
    
<?php }
?>

<?php 

if(isset($_POST['value']) && $_POST['value'] === 'public'){?>

 <!--Modal header-->
 <div class="modal-header my-modal-header">
    <div class="modal-title My-modal-title">Add New Public offer</div>
    <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<!--Modal body -->
<div class="modal-body">
    <form method="post" enctype="multipart/form-data">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_title" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Offer Title</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_Name" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Offer Name</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <textarea class="form-control myinputTextArea" name="off_Desc"  placeholder=" " id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Offer Description</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_billValue" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Total Bill Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <select class="form-select myselect" id="floatingSelect" name="off_type">
                        <option value="0">Select</option>
                        <option value="percentage">percentage</option>
                        <option value="Cash">Cash</option>
                    </select>
                        <label for="floatingSelect">Discount Type</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_value" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Discount Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_from_Date" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">Start Date</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_to_Date" id="floatingInput" placeholder=" ">
                    <label for="floatingInput">End Date</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group has-validation myFormGroup">
                    <label for="formFile" class="form-label">Please select a image file</label>
                        <input type="file" id="file-input" name="imageFile[]" accept="image/png, image/jpeg" onchange="preview()" multiple class="form-control myChooseFile">
                        <div id="strErr"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card img-box">
                    <div class="row " id="images">
                                
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="btn-col">
                    <button class="btn myBtn" id="btnAdd" type="submit" name="offer-public-add">Add Offer</button>
                </div>         
            </div>
        </div>
    </form>
</div>
    
<?php }
?>

<?php 
if(isset($_REQUEST['offer_id']) && $_REQUEST['task'] === 'delete' && $_REQUEST['mode'] === 'private'){
    $result = $offerObj->deletePrivateOffer($_REQUEST['offer_id']);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
?>

<?php 
if(isset($_REQUEST['offer_id']) && $_REQUEST['task'] === 'delete' && $_REQUEST['mode'] === 'public'){
    $result = $offerObj->deletePublicOffer($_REQUEST['offer_id']);
    if($result){
        echo 1;
    }else{
        echo $db -> error;
    }
}
?>

<?php 

if(isset($_POST['offer_id']) && $_POST['mode'] === 'public' && $_POST['task'] === 'update'){
    $resultGetData = $offerObj->getPublicOffer($_POST['offer_id']);
    if($resultGetData){  
        $row = $resultGetData -> fetch_assoc();  
    ?>

 <!--Modal header-->
 <div class="modal-header my-modal-header">
    <div class="modal-title My-modal-title">Update Public offer <?=$_POST['offer_id']?></div>
    <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<!--Modal body -->
<div class="modal-body">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="promoID" value="<?=$_POST['offer_id']?>">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_title" id="floatingInput" placeholder=" " value = "<?=$row['Offer_Title']?>">
                    <label for="floatingInput">Offer Title</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_name" id="floatingInput" placeholder=" " value = "<?=$row['Offer_Name']?>">
                    <label for="floatingInput">Offer Name</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <textarea class="form-control myinputTextArea" name="off_Desc"  placeholder=" " id="floatingTextarea"><?=$row['Description']?></textarea>
                    <label for="floatingTextarea">Offer Description</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_billValue" id="floatingInput" placeholder=" " value = "<?=$row['TotalBillValue']?>">
                    <label for="floatingInput">Total Bill Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <select class="form-select myselect" id="floatingSelect" name="off_type">
                        <option value="0">Select</option>
                        <option value="percentage" <?php if ($row['Discount_Type'] === 'percentage') echo 'selected'; ?>>percentage</option>
                        <option value="Cash" <?php if ($row['Discount_Type'] === 'Cash') echo 'selected'; ?>>Cash</option>
                    </select>
                        <label for="floatingSelect">Discount Type</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_value" id="floatingInput" placeholder=" " value = "<?=$row['Discount']?>">
                    <label for="floatingInput">Discount Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_from_Date" id="floatingInput" placeholder=" " value = "<?=$row['Valid_From_Date']?>">
                    <label for="floatingInput">Start Date</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_to_Date" id="floatingInput" placeholder=" " value = "<?=$row['Valid_To_Date']?>">
                    <label for="floatingInput">End Date</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="btn-col">
                    <button class="btn myBtn" id="btnAdd" type="submit" name="offer-public-update">Update</button>
                </div>         
            </div>
        </div>
    </form>
</div>
    
<?php }
}
?>
<?php 

if(isset($_POST['offer_id']) && $_POST['mode'] === 'private' && $_POST['task'] === 'update'){
    $resultGetData = $offerObj->getPrivateOffer($_POST['offer_id']);
    if($resultGetData){  
        $row = $resultGetData -> fetch_assoc();  
    ?>

 <!--Modal header-->
 <div class="modal-header my-modal-header">
    <div class="modal-title My-modal-title">Update Public offer <?=$_POST['offer_id']?></div>
    <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<!--Modal body -->
<div class="modal-body">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="promoID" value="<?=$_POST['offer_id']?>">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_title" id="floatingInput" placeholder=" " value = "<?=$row['Offer_Title']?>">
                    <label for="floatingInput">Offer Title</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_name" id="floatingInput" placeholder=" " value = "<?=$row['Offer_Name']?>">
                    <label for="floatingInput">Offer Name</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <textarea class="form-control myinputTextArea" name="off_Desc"  placeholder=" " id="floatingTextarea"><?=$row['Description']?></textarea>
                    <label for="floatingTextarea">Offer Description</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_billValue" id="floatingInput" placeholder=" " value = "<?=$row['TotalBillValue']?>">
                    <label for="floatingInput">Total Bill Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <select class="form-select myselect" id="floatingSelect" name="off_type">
                        <option value="0">Select</option>
                        <option value="percentage" <?php if ($row['Discount_Type'] === 'percentage') echo 'selected'; ?>>percentage</option>
                        <option value="Cash" <?php if ($row['Discount_Type'] === 'Cash') echo 'selected'; ?>>Cash</option>
                    </select>
                        <label for="floatingSelect">Discount Type</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="text" class="form-control myinputText" name="off_value" id="floatingInput" placeholder=" " value = "<?=$row['Discount']?>">
                    <label for="floatingInput">Discount Value</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_from_Date" id="floatingInput" placeholder=" " value = "<?=$row['Valid_From_Date']?>">
                    <label for="floatingInput">Start Date</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating myFormFloating">
                    <input type="date" class="form-control myinputText" name="off_to_Date" id="floatingInput" placeholder=" " value = "<?=$row['Valid_To_Date']?>">
                    <label for="floatingInput">End Date</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="btn-col">
                    <button class="btn myBtn" id="btnAdd" type="submit" name="offer-private-update">Update</button>
                </div>         
            </div>
        </div>
    </form>
</div>
    
<?php }
}
?>