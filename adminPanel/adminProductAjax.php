<?php 
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
include "..\classes\CategoryController.php";
include "..\classes\SupplierController.php";
$db = new DatabaseConnection;
$productObj = new ProductController;
$categoryObj = new CategoryController;
$supplierObj = new SupplierController;

if(isset($_REQUEST['task']) && $_REQUEST['task']=== 'displayAllProducts'){
    $result = $productObj->getProductDetails();
    if($result){
        foreach($result as $row){
            ?>
            <tr>
                <td><?=$row['Product_ID']?></td>
                <td><?=$row['Pro_Name']?></td>
                <td><?=$row['Pro_Desc']?></td>
                <td >
                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_1'])?>" class="img P-img">
                </td>
                <td>
                    <a class="btn btn-outline-danger" data-productID='<?=$row['Product_ID']?>'><i class="fas fa-trash-alt"></i> delete</a>
                    <a class="btn btn-outline-success" data-productID='<?=$row['Product_ID']?>' id="p_update"><i class="fas fa-edit"></i> update</a>
                    <a class="btn btn-outline-primary" data-productID='<?=$row['Product_ID']?>' id="p_view"><i class="far fa-eye"></i> view</a>
                </td>
            </tr>
            <?php
        }
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task']=== 'view'){
    $productResults = $productObj->getViewProductDetails($_REQUEST['pid']);
    $row = $productResults -> fetch_assoc();
    ?>
    <!-- modal header -->
    <div class="modal-header my-modal-header">
                <div class="modal-title My-regForm-title"><?=$row['Pro_Name']?></div>
                <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- header close -->
            <!-- modal body -->
            <div class="modal-body my-modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <!--Product Images-->
                        <div id="productImageCarouselControl" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner my-modal-slider">
                                <div class="carousel-item active">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_1'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_2'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_3'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <button class="carousel-control-prev " type="button" data-bs-target="#productImageCarouselControl" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon slider-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next " type="button" data-bs-target="#productImageCarouselControl" data-bs-slide="next">
                                    <span class="carousel-control-next-icon slider-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <!--Product Images end-->
                    </div>
                    <div class="col-md-8">
                        <div class="row product-details">
                            <!--Product Description-->
                            <div class="col-lg-3 col-md-4 col-topics"><span>Description</span></div>
                            <div class="col-lg-9 col-md-8 col-data">
                                <span><?=$row['Pro_Desc']?></span>
                            </div>
                            <!--Product Description end-->
                        </div>
                        <div class="row product-details">
                            <!--Product Selling price-->
                            <div class="col-lg-3 col-md-4 col-topics"><span>Selling Price</span></div>
                            <div class="col-lg-9 col-md-8 col-data">
                                <span>Rs. <?=$row['Pro_SalePrice']?></span>
                            </div>
                            <!--Product Selling price end-->
                        </div>
                        <div class="row product-details">
                            <!--Product cost price-->
                            <div class="col-lg-3 col-md-4 col-topics"><span>Cost Price</span></div>
                            <div class="col-lg-9 col-md-8 col-data">
                                <span>Rs. <?=$row['Pro_UnitPrice']?></span>
                            </div>
                            <!--Product cost price end-->
                        </div>
                        <div class="row product-details">
                            <!--Product Categorize-->
                            <div class="col-lg-3 col-md-4 col-topics"><span>Categorize</span></div>
                            <div class="col-lg-9 col-md-8 col-data">
                                <span><?=$row['mName']?> / </span>
                                <span><?=$row['sName']?> / </span>
                                <span><?=$row['bName']?> / </span>
                                <span><?=$row['Sup_Name']?> / </span>
                            </div>
                            <!--Product Categorize end-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table class="table sub-tbl">
                            <thead>
                                <tr>
                                    <th>Product color</th>
                                    <th>Product size</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $productRes = $productObj->getProductVariationOnID($_REQUEST['pid']);
                                foreach($productRes as $record){
                                    ?>
                                    <tr>
                                        <td><?=$record['Color_ID']?> : <i class="fas fa-square" style="color: <?=$record['Color_Value']?>"></i> : <?=$record['Color_Name']?> </td>
                                        <td><?=$record['Size_ID']?> : <?=$record['Size_Value']?> </td>
                                        <td><?=$record['Stock_Qty']?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            <!-- body close -->
    <?php
}
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'updateForm'){
    $productResults = $productObj->getViewProductDetails($_REQUEST['pid']);
    $up_row = $productResults -> fetch_assoc();
    ?>
    <script src="..\assets\js\admin-ajax-view.js"></script>
    <!-- modal header -->
    <div class="modal-header my-modal-header">
                <div class="modal-title My-regForm-title">Update <?=$_REQUEST['pid']?></div>
                <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- header close -->
            <!-- modal body -->
            <div class="modal-body my-modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <!--Product Images-->
                        <div id="productImageCarouselControl" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner my-modal-slider">
                                <div class="carousel-item active">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($up_row['Pro_IMG_1'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($up_row['Pro_IMG_2'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($up_row['Pro_IMG_3'])?>" class="d-block w-100 my-modal-slider-img" alt="...">
                                </div>
                                <button class="carousel-control-prev " type="button" data-bs-target="#productImageCarouselControl" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon slider-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next " type="button" data-bs-target="#productImageCarouselControl" data-bs-slide="next">
                                    <span class="carousel-control-next-icon slider-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <!--Product Images end-->
                    </div>
                    <div class="col-md-8">
                        <form id = "updateImage" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-validation myFormGroup">
                                        <label for="formFile" class="form-label">Please select 3 image files</label>
                                        <input type="file" id="file-input" name="imageFile[]" accept="image/png, image/jpeg" onchange="preview()" multiple class="form-control myChooseFile">
                                        <div id="strErr"></div>
                                        <input type="hidden" name="productId" id="pid" value = "<?=$_REQUEST['pid']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card img-box">
                                        <div class="row " id="images">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="btn-col">
                                        <button class="btn myBtn" type="submit" id = "btn-updateImage">Update Images</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form> 
                    </div>    
                </div>
                <div class="row mt-2 divider">
                        <form id="UpdateProduct" class="mt-2">
                        <input type="hidden" name="productId" id="PID" value = "<?=$_REQUEST['pid']?>">
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
                                            <option value="<?=$row['Main_ID']?>" <?php if ($up_row['Main_ID'] === $row['Main_ID'] ) echo 'selected'; ?>><?=$row['Name']?></option>
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
                                            <option value="<?=$row['Sub_ID']?>" <?php if ($up_row['Sub_ID'] === $row['Sub_ID'] ) echo 'selected'; ?>><?=$row['Name']?></option>
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
                                            <option value="<?=$row['Brand_ID']?>" <?php if ($up_row['Brand_ID'] === $row['Brand_ID'] ) echo 'selected'; ?>><?=$row['Name']?></option>
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
                                            <option value="<?=$row['Sup_ID']?>" <?php if ($up_row['Sup_ID'] === $row['Sup_ID'] ) echo 'selected'; ?>><?=$row['Sup_Name']?></option>
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
                                    <input type="text" class="form-control myinputText" name="pName" id="floatingInput" placeholder=" " value ="<?=$up_row['Pro_Name']?>">
                                    <label for="floatingInput">Product Name</label>
                                    <div id="strPNameError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating myFormFloating">
                                    <textarea class="form-control myinputTextArea" name="pDesc"  placeholder=" " id="floatingTextarea"><?=$up_row['Pro_Desc']?></textarea>
                                    <label for="floatingTextarea">Product Description</label>
                                    <div id="strPDescError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 myFormFloating">
                                    <input type="text" class="form-control myinputText" name="pUnitPrice" id="floatingInput" placeholder=" " value ="<?=$up_row['Pro_UnitPrice']?>">
                                    <label for="floatingInput">Product Unit Price (Rs.)</label>
                                    <div id="strPUnitError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating myFormFloating mb-3">
                                    <input type="text" class="form-control myinputText" name="pSalePrice" id="floatingInput" placeholder=" " value ="<?=$up_row['Pro_SalePrice']?>">
                                    <label for="floatingInput">Product Selling Price (Rs.)</label>
                                    <div id="strPSellError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="btn-col">
                                    <button class="btn myBtn" type="submit" id="update-product-info">Update Product Info</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>

                </div>
            <div>
            <!-- end modal body-->
    <?php
}
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task']==='updateImage') {
    
     // Check if the required fields are set
     if (!isset($_FILES['files']) || !isset($_FILES['files']['tmp_name'][0]) || !isset($_REQUEST['pid'])) {
        echo "Error: Missing parameters.";
        exit;
    }

    // Assuming $productObj is an instance of the class handling product operations
    $result = $productObj->updateProductImage($_FILES['files']['tmp_name'][0],$_FILES['files']['tmp_name'][1],$_FILES['files']['tmp_name'][2], $_REQUEST['pid']);

    if ($result === true) {
        echo "1";
    } else {
        echo "Error: " . $result;
    }
}
?>
<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'updateProductInfo'){
    $productData = [
        "pId" => mysqli_real_escape_string($db->conn,$_REQUEST['pid']),
        "pName" => mysqli_real_escape_string($db->conn,$_REQUEST['pName']),
        "pDesc" => mysqli_real_escape_string($db->conn,$_REQUEST['pDesc']),
        "pUnitPrice" => mysqli_real_escape_string($db->conn,$_REQUEST['pUnit']),
        "pSalePrice" => mysqli_real_escape_string($db->conn,$_REQUEST['pSell'])
    ];
    $CatData = [
        "mainId" => mysqli_real_escape_string($db->conn,$_REQUEST['mId']),
        "subId" => mysqli_real_escape_string($db->conn,$_REQUEST['sId']),
        "brandId" => mysqli_real_escape_string($db->conn,$_REQUEST['bId']),
        "supId" => mysqli_real_escape_string($db->conn,$_REQUEST['supId']),
        "pId" => mysqli_real_escape_string($db->conn,$_REQUEST['pid'])
    ];
    $result1 = $productObj->updateProductInfo($productData);
    if($result1){
        $result2 = $productObj->updateCategorization($CatData);
        if($result2){
            echo 1;
        }else{
            echo $result2;
        }
    }else{
        echo $result1;
    }
    
}
?>
