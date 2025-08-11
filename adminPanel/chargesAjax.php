<?php 
include "..\classes\DBConnect.php";
include "..\classes\ChargeController.php";
$db = new DatabaseConnection;
$chargeObj = new ChargeController;
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'show' ){
    $result = $chargeObj->displaycharges();
        if($result){
            foreach($result as $row){
            ?>
                <tr>
                    <th scope= "col"><?=$row['charge_ID']?></th>
                    <td><?=$row['Charge_Type']?></td>
                    <td><?=$row['Location']?></td>
                    <td><?=$row['Value']?></td>
                     <td>
                        <button class="btn btn-outline-danger" data-chargeId="<?=$row['charge_ID']?>" id = "btnDelete"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn btn-outline-success" data-chargeId="<?=$row['charge_ID']?>" id = "btnUpdate"><i class="fas fa-edit"></i></button>
                     </td>
                </tr>                 
            <?php
                }
            }else{
                echo "<td colspan='5'><label>No Records found</label></td>";
            }
            
}
?>

<?php 
if(isset($_REQUEST['payment']) && isset($_REQUEST['location']) && isset($_REQUEST['charges']) && $_REQUEST['task']==='addNew'){
    $data = [
        "type" => mysqli_real_escape_string($db->conn,$_REQUEST['payment']),
        "location" => mysqli_real_escape_string($db->conn,$_REQUEST['location']),
        "charge" => mysqli_real_escape_string($db->conn,$_REQUEST['charges']),
    ];

    $result = $chargeObj->addNewCharges($data);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
       
}
?>
<?php 
if($_REQUEST['task']==="updateTHIS"){
    $data = [
        "ID" => mysqli_real_escape_string($db->conn,$_REQUEST['id']),
        "type" => mysqli_real_escape_string($db->conn,$_REQUEST['payment']),
        "location" => mysqli_real_escape_string($db->conn,$_REQUEST['location']),
        "charge" => mysqli_real_escape_string($db->conn,$_REQUEST['charges']),
    ];
    $result = $chargeObj->UpdateCharges($data);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
       
}
?>
<?php 
if(isset($_REQUEST['id']) && $_REQUEST['task'] === 'showForm'){
    $result = $chargeObj->getInfoUpdate($_REQUEST['id']);
    if($result){
        $data = $result->fetch_assoc(); 
        ?>
            <!--Modal header-->
            <div class="modal-header my-modal-header">
                <div class="modal-title My-modal-title">Update Charge <?=$data['charge_ID']?></div>
                <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateCharges">
                <input type="hidden" name="chargeID" value="<?=$data['charge_ID']?>">
            <!--Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating myFormFloating">
                                <select class="form-select myselect UP" id="floatingSelect" name="UPpaymentMethod">
                                    <option value="0">Select</option>
                                    <option value="COD" <?php if ($data['Charge_Type'] === 'COD') echo 'selected'; ?>>Cash on Delivery</option>
                                    <option value="BD" <?php if ($data['Charge_Type'] === 'BD') echo 'selected'; ?>>Bank Deposit</option>
                                </select>
                                <label for="floatingSelect">Payment Method</label>
                                <div id="strUPPayMethodError"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText UP" name="UPlocation" id="floatingInput" placeholder=" " value = "<?=$data['Location']?>">
                                <label for="floatingInput">Location</label>
                                <div id="strUPLocationError"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText UP" name="UPcharge" id="floatingInput" placeholder=" " value = "<?=$data['Value']?>">
                                <label for="floatingTextarea">Charges (Rs.)</label>
                                <div id="strUPChargeError"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="btn-col">
                                <button class="btn myBtn" id="btnUpdate" type="submit" name="update">Update</button>
                            </div>         
                        </div>
                    </div>
                </div>
            </form>
        <?php
    }
       
}
?>

<?php 
if(isset($_REQUEST['id']) && $_REQUEST['task'] === 'delete'){
    $result = $chargeObj->removeCharges($_REQUEST['id']);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
       
}
?>

