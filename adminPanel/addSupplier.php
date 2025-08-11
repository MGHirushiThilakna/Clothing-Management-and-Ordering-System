<?php 
$currentSubPage="addSup";
include "SupplierHandling.php"; 
?>
<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card mt-3">
        <div class="card-header mycardheader">Add New Suppliers</div>
        <div class="card-body">
            <form action="#" method="post">
                <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText" name="supName" id="floatingInput" placeholder=" ">
                                <label for="floatingInput">Supplier Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating myFormFloating">
                                    <input type="text" class="form-control myinputText" name="supContact" id="floatingInput" placeholder=" ">
                                    <label for="floatingInput">Contact Number</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating myFormFloating">
                                    <input type="text" class="form-control myinputText" name="supEmail" id="floatingInput" placeholder=" ">
                                    <label for="floatingInput">Email Address</label>
                            </div>
                        </div>
                </div>
                <div class="row mt-3">
                    <div class="btn-col">
                        <button class="btn myBtn" id="btnAdd" type="submit" name="btnSup">Add Supplier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
if(isset($_POST['btnSup'])){
    $supplierData = [
        'name'=> mysqli_real_escape_string($db->conn,$_POST['supName']),
        'contact'=>mysqli_real_escape_string($db->conn,$_POST['supContact']),
        'email'=>mysqli_real_escape_string($db->conn,$_POST['supEmail'])
    ];
    $resSup=$supplierObj->addNewSupplier($supplierData);
    if($resSup){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new supplier added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed'});</script>";
    }
}
?>
<?php include "adminFooter.php"; ?>