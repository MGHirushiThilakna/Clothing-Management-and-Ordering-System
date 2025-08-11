<?php 
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
$productObj = new ProductController;

if(isset($_POST['pId'])){?>
    <div class="modal-header">
                <h1 class="modal-title fs-5"><?=$productObj->getProductName($_POST['pId'])?> (<?=$_POST['pId']?>)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="post">
        <div class="modal-body">
            
                <div class="row mb-3">
                    <div class="col">Color</div>
                    <div class="col">Size Type</div>
                    <div class="col">Size</div>
                    <div class="col">Quantity</div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <select class="form-select" name="color" id="color">
                            <option value="0" selected>Select</option>
                            <?php
                                $colors = $productObj->getColorData();
                                    if($colors){
                                        foreach($colors as $row){?>
                                            <option value="<?=$row['Color_ID']?>" style="background-color:<?=$row['Color_Value']?>;font-size:22px;"><?=$row['Color_Name']?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "<option></option>";
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" name = "sizeType" id="sizeType">
                            <option value="0" selected>Select</option>
                            <?php
                                $sizeType = $productObj->getType();
                                    if($sizeType){
                                        foreach($sizeType as $row){ ?>
                                            <option value="<?=$row['Size_Type']?>"><?=$row['Size_Type']?></option>
                                        <?php
                                        }
                                    }else{
                                        echo "<option></option>";
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" name = "size" id="sizeValue">
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="qty" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="productId" value="<?=$_POST['pId']?>">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="addStock">Add Stock</button>
        </div>
    </form>
    
<?php
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showUpdateForm'){
    $result = $productObj->getProductVariationData($_REQUEST['productID']);
    ?>
    
    <div class="modal-header">
        <h1 class="modal-title fs-5"><?=$productObj->getProductName($_REQUEST['productID'])?> (<?=$_REQUEST['productID']?>)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form id="form-update-stock">
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col">Color</div>
                <div class="col">Size Type</div>
                <div class="col">Size</div>
                <div class="col">Quantity</div>
            </div>
            <input type="hidden" name="productId" value="<?=$_REQUEST['productID']?>">
            <?php 
            foreach($result as $datarow){
                ?>
                <div class="row mb-2 ">
                    <div class="col">
                            <select class="form-select" name="updatecolor[]" id="color">
                                <option value="0" selected>Select</option>
                                <?php
                                    $colors = $productObj->getColorData();
                                        if($colors){
                                            foreach($colors as $row){?>
                                                <option value="<?=$row['Color_ID']?>" style="background-color:<?=$row['Color_Value']?>;font-size:22px;" <?php if ($datarow['Color_ID'] === $row['Color_ID'] ) echo 'selected'; ?>><?=$row['Color_Name']?></option>
                                                <?php
                                            }
                                        }else{
                                            echo "<option></option>";
                                        }
                                ?>
                            </select>
                    </div>
                    <div class="col">
                        <input type="text"  class="form-control" disabled value ='<?=$datarow['Size_Type']?>'>
                    </div>
                    <div class="col">
                            <select class="form-select" name="updatesizevalue[]" id="sizevalue">
                                <option value="0" selected>Select</option>
                                <?php
                                    $sizes = $productObj->getSizeValue($datarow['Size_Type']);
                                        if($sizes){
                                            foreach($sizes as $row){?>
                                                <option value="<?=$row['Size_ID']?>" <?php if ($datarow['Size_ID'] === $row['Size_ID'] ) echo 'selected'; ?>><?=$row['Size_Value']?></option>
                                                <?php
                                            }
                                        }else{
                                            echo "<option></option>";
                                        }
                                ?>
                            </select>
                    </div>
                    <div class="col">
                        <input type="number" name="qty[]" class="form-control" value="<?=$datarow['Stock_Qty']?>">
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="update-product-stock">Update info</button>
        </div>
    </form>
    <?php

}
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'updateStock'){
    $formData = json_decode($_POST['formData'], true);
    $Res;
    foreach ($formData as $row) {
        $color = $row['color'];
        $size = $row['size'];
        $quantity = $row['quantity'];
        $Res = $productObj->updateProductVariation($_REQUEST['pid'],$size,$color,$quantity);
    }
    if($Res){
        echo 1;
    }else{
        echo $Res;
    }
}
?>
<script src="..\assets\js\ajaxGetSizeValue.js"></script>