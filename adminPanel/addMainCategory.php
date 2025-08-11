<?php 
$currentSubPage="mainCat";
include "categoryHandling.php"; 
$db = new DatabaseConnection;
$mainCatObj = new CategoryController;
?>

<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header mycardheader">Add New Main Category</div>
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
                                        <button class="btn myBtn" id="btnAdd" type="submit" name="btnMain">Add Category</button>
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
                                    <th scope="col">Main Category ID</th>
                                    <th scope="col">Main Category Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $results = $mainCatObj->getMainCategoryData();
                                    if($results){
                                        foreach($results as $row){
                                            ?>
                                            <tr>
                                            <th scope="row"><?=$row['Main_ID']?></th>
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
if(isset($_POST['btnMain'])){
    $categoryName = mysqli_real_escape_string($db->conn,$_POST['CategoryName']);
    $resMainCat = $mainCatObj->addNewMainCategory($categoryName);
    if($resMainCat){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new Main Category added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed'});</script>";
    }
}

?>
<?php include "adminFooter.php"; ?>