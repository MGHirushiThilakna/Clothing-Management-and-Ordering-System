<?php 
$currentSubPage="subCat";
include "categoryHandling.php"; 
$db = new DatabaseConnection;
$subCatObj = new CategoryController;
?>
<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header mycardheader">Add New Sub Category</div>
                        <div class="card-body">
                            <form action="#" method="post">
                                <div class="row myrow">
                                    <div class="col ">
                                            <div class="form-floating myFormFloating">
                                                <input type="text" class="form-control myinputText" name="CategoryName" id="floatingInput" placeholder=" ">
                                                <label for="floatingInput">Enter Category Name</label>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-col">
                                        <button class="btn myBtn" id="btnAdd" type="submit" name="btnSub">Add Category</button>
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
                                    <th scope="col">Sub Category ID</th>
                                    <th scope="col">Sub Category Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $results = $subCatObj->getSubCategoryData();
                                    if($results){
                                        foreach($results as $row){
                                            ?>
                                            <tr>
                                            <th scope="row"><?=$row['Sub_ID']?></th>
                                                <td><?=$row['Name']?></td>
                                                <td>
                                                    <button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                    <button class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo "<tr><td colspan='3'>No Records found</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
<?php 
if(isset($_POST['btnSub'])){
    $categoryName = mysqli_real_escape_string($db->conn,$_POST['CategoryName']);
    $resSubCat = $subCatObj->addNewSubCategory($categoryName);
    if($resSubCat){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new Sub Category added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed'});</script>";
    }
}
?>
<?php include "adminFooter.php"; ?>