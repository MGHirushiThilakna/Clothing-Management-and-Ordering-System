<?php 
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
$productObj = new ProductController;

if(isset($_GET['table'])){
    $resProducts = $productObj -> getallProducts();
    if($resProducts){
        foreach($resProducts as $row){ ?>
        <div class="card items" >
        <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_1'])?>" class="card-img-top card-img" alt="...">
        <div class="card-body">
            <h5 class="card-title item-title"><?=$row['Pro_Name']?></h5>
                <?php 
                if($row['SUM(s.Stock_Qty)'] > 0){
                    echo "<p class='card-text item-stockIn'>Available</p>";
                }else{
                    echo "<p class='card-text item-stockout'>Sold out!</p>";
                }
                ?>
            
            <a class="btn btn-primary card-btn viewProductModalBtn" data-productId="<?=$row['Product_ID']?>" onclick="showModal(this)">View</a>
        </div>
    </div>

      <?php  }
    }
}

if(isset($_GET['mainId']) && isset($_GET['subId'])){
    $resMainSub = $productObj -> getallProductsOnMainSub($_GET['mainId'],$_GET['subId']);
    if($resMainSub){
        foreach($resMainSub as $row){ ?>
        <div class="card items" >
        <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_1'])?>" class="card-img-top card-img" alt="...">
        <div class="card-body">
            <h5 class="card-title item-title"><?=$row['Pro_Name']?></h5>
                <?php 
                if($row['SUM(s.Stock_Qty)'] > 0){
                    echo "<p class='card-text item-stockIn'>Available</p>";
                }else{
                    echo "<p class='card-text item-stockout'>Sold out!</p>";
                }
                ?>
            
            <a class="btn btn-primary card-btn viewProductModalBtn" data-productId="<?=$row['Product_ID']?>" onclick="showModal(this)" >View</a>
        </div>
    </div>

      <?php  }
    }
}

if(isset($_GET['mainCatOnlyId'])){
    $resMain = $productObj -> getallProductsOnMain($_GET['mainCatOnlyId']);
    if($resMain){
        foreach($resMain as $row){ ?>
        <div class="card items" >
        <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['Pro_IMG_1'])?>" class="card-img-top card-img" alt="...">
        <div class="card-body">
            <h5 class="card-title item-title"><?=$row['Pro_Name']?></h5>
                <?php 
                if($row['SUM(s.Stock_Qty)'] > 0){
                    echo "<p class='card-text item-stockIn'>Available</p>";
                }else{
                    echo "<p class='card-text item-stockout'>Sold out!</p>";
                }
                ?>
            
            <a class="btn btn-primary card-btn viewProductModalBtn" data-productId="<?=$row['Product_ID']?>" onclick="showModal(this)">View</a>
        </div>
    </div>

      <?php  }
    }
}

?>

<?php 
if(isset($_GET['pId']) && isset($_GET['sId']) && isset($_GET['cId'])){
    $resStock = $productObj-> getStockQuantity($_GET['pId'],$_GET['sId'],$_GET['cId']);
    if($resStock){
        $data = $resStock -> fetch_assoc();
        $qty = $data['Stock_Qty'];
        if($qty > 0){
            echo "0";
        }else{
            echo "1";
        }
    }else{
        echo "2";
    }
}

?>