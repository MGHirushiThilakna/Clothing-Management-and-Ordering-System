<?php 
$currentSubPage="add";
include "ProductManagement.php"; ?>
<link rel="stylesheet" href="..\assets\css\admin-product-new-product-style.css">
<script src="..\assets\js\form-validation\admin-product-form-validation.js"></script>
<script src="..\assets\js\admin-product-add.js"></script>

<div class="container">
    <div class="card mt-3">
        <div class="card-header mycardheader">Add New Product</div>
        <div class="card-body">
            <form id="AddProduct" action="#" method="post" enctype="multipart/form-data" >
                <div class="row myrow">
                    <div class="col-md-3">
                        <div class="form-floating myFormFloating">
                            <select class="form-select myselect" id="floatingSelect" name="pMainCat">
                                <option value="0">Select</option>
                                <?php
                                    $mainCat = $categoryObj->getMainCategoryData();
                                    if($mainCat){
                                    foreach($mainCat as $row){
                                    ?>
                                    <option value="<?=$row['Main_ID']?>"><?=$row['Name']?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Select Main category</label>
                            <div id="strMainError"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating myFormFloating">
                            <select class="form-select myselect" id="floatingSelect" name="psubCat">
                                <option value="0">Select</option>
                                <?php
                                    $subCat = $categoryObj->getSubCategoryData();
                                    if($subCat){
                                    foreach($subCat as $row){
                                    ?>
                                    <option value="<?=$row['Sub_ID']?>"><?=$row['Name']?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Select Sub category</label>
                            <div id="strSubError"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating myFormFloating">
                            <select class="form-select myselect" id="floatingSelect" name="pBrand">
                            <option value="0">Select</option>
                            <?php
                                $brand = $categoryObj->getBrandData();
                                if($brand){
                                    foreach($brand as $row){
                                    ?>
                                    <option value="<?=$row['Brand_ID']?>"><?=$row['Name']?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Select Brand Name</label>
                            <div id="strBrandError"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating myFormFloating">
                            <select class="form-select myselect" id="floatingSelect" name="pSupplier">
                                <option value="0">Select</option>
                                <?php
                                $supplier = $supplierObj->getsupplierData();
                                if($supplier){
                                    foreach($supplier as $row){
                                    ?>
                                    <option value="<?=$row['Sup_ID']?>"><?=$row['Sup_Name']?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Select Supplier</label>
                            <div id="strSupError"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-floating myFormFloating">
                            <input type="text" class="form-control myinputText" name="pName" id="floatingInput" placeholder=" ">
                            <label for="floatingInput">Product Name</label>
                            <div id="strPNameError"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating myFormFloating">
                            <textarea class="form-control myinputTextArea" name="pDesc"  placeholder=" " id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Product Description</label>
                            <div id="strPDescError"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 myFormFloating">
                            <input type="text" class="form-control myinputText" name="pUnitPrice" id="floatingInput" placeholder=" ">
                            <label for="floatingInput">Product Unit Price (Rs.)</label>
                            <div id="strPUnitError"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating myFormFloating mb-3">
                            <input type="text" class="form-control myinputText" name="pSalePrice" id="floatingInput" placeholder=" ">
                            <label for="floatingInput">Product Selling Price (Rs.)</label>
                            <div id="strPSellError"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group has-validation myFormGroup">
                            <label for="formFile" class="form-label">Please select 3 image files</label>
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
                            <button class="btn myBtn" type="submit" name="btnProduct">Add Product</button>
                        </div>
                        
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php 
if(isset($_POST['btnProduct'])){
    $productData = [
        "pName" => mysqli_real_escape_string($db->conn,$_POST['pName']),
        "pDesc" => mysqli_real_escape_string($db->conn,$_POST['pDesc']),
        "pUnitPrice" => mysqli_real_escape_string($db->conn,$_POST['pUnitPrice']),
        "pSalePrice" => mysqli_real_escape_string($db->conn,$_POST['pSalePrice'])
    ];
    $categorize = [
        "MId" => mysqli_real_escape_string($db->conn,$_POST['pMainCat']),
        "SId" => mysqli_real_escape_string($db->conn,$_POST['psubCat']),
        "BId" => mysqli_real_escape_string($db->conn,$_POST['pBrand']),
        "Sup_ID" => mysqli_real_escape_string($db->conn,$_POST['pSupplier'])
    ]; 
    $resProduct = $productObj->addNewProduct($productData,$_FILES['imageFile']['tmp_name'][0],$_FILES['imageFile']['tmp_name'][1],$_FILES['imageFile']['tmp_name'][2]);
    if($resProduct){
        $resCategorize = $productObj->categorizeProduct($categorize);
        if($resCategorize){
            echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new product added successfully'});</script>";
        }else{
            echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed : Categorize'});</script>";
        }
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed : Product'});</script>";
    }
}

?>
<?php include "adminFooter.php"; ?>