<?php 
$currentSubPage="Size";
include "ProductManagement.php"; 
?>
<script type="module" src="../assets/js/datalist-css.min.js"></script>
<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card">
        <div class="card-body">
<div class="row myrow">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header mycardheader">Add New Size</div>
                        <div class="card-body">
                            <form action="#" method="post">
                                <div class="row myrow">
                                    <div class="col">
                                        <div class="form-floating myFormFloating"> 
                                            <input type="text" class="form-control myinputText" list="sizeTypes" name="type" id="floatingInput" placeholder=" ">
                                            <label for="floatingInput">Size Type</label>
                                            <datalist id="sizeTypes">
                                                <?php
                                                $sizeType = $sizeObj->getType();
                                                if($sizeType){
                                                    foreach($sizeType as $row){
                                                        ?>
                                                        <option><?=$row['Size_Type']?></option>
                                                        <?php
                                                    }
                                                }else{
                                                    echo "<option></option>";
                                                }
                                                ?>
                                                
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col ">
                                        <div class="form-floating myFormFloating">
                                            <input type="text" class="form-control myinputText" name="value" id="floatingInput" placeholder=" ">
                                            <label for="floatingInput">Value</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-col">
                                        <button class="btn myBtn" id="btnAdd" type="submit" name="btnSize">Add Size</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Size ID</th>
                                <th scope="col">Size Type</th>
                                <th scope="col">Size Value</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $results = $sizeObj->getSizeData();
                                    if($results){
                                        foreach($results as $row){
                                            ?>
                                            <tr>
                                            <th scope="row"><?=$row['Size_ID']?></th>
                                                <td><?=$row['Size_Type']?></td>
                                                <td><?=$row['Size_Value']?></td>
                                                <td>
                                                    <button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                    <button class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo "No Records found";
                                    }
                                ?>
                            </tbody>
                            </table>
                    </div>
                </div>

            </div>
                                </div>
                                </div>
                                <div>
<?php 

if(isset($_POST['btnSize'])){
    $sizeData =[
        'type'=> mysqli_real_escape_string($db->conn,$_POST['type']),
        'value'=>mysqli_real_escape_string($db->conn,$_POST['value'])
    ];
    $resSize = $sizeObj->addNewSize($sizeData);
    if($resSize){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new size added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed'});</script>";
    }
}

?>
<?php include "adminFooter.php"; ?>