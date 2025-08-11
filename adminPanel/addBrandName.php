<?php 
$currentSubPage="Brand";
include "categoryHandling.php"; 
$db = new DatabaseConnection;
$brandObj = new CategoryController;
?>
<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header mycardheader">Add New Brand Name</div>
                        <div class="card-body">
                            <form action="#" method="post">
                                <div class="row myrow">
                                    <div class="col ">
                                            <div class="form-floating myFormFloating">
                                                <input type="text" class="form-control myinputText" name="CategoryName" id="floatingInput" placeholder=" ">
                                                <label for="floatingInput">Enter Brand Name</label>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-col">
                                        <button class="btn myBtn" id="btnAdd" type="submit" name="btnBrand">Add Brand</button>
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
                                    <th scope="col">Brand ID</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $results = $brandObj->getBrandData();
                                    if($results){
                                        foreach($results as $row){
                                            ?>
                                            <tr>
                                            <th scope="row"><?=$row['Brand_ID']?></th>
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
if(isset($_POST['btnBrand'])){
    $categoryName = mysqli_real_escape_string($db->conn,$_POST['CategoryName']);
    $resBrand = $brandObj->addNewBrand($categoryName);
    if($resBrand){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new Brand Name added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed'});</script>";
    }
}
?>
<?php include "adminFooter.php"; ?>