<?php 
include "..\classes\DBConnect.php";
include "..\classes\cartController.php";
$db = new DatabaseConnection;
$cartObj = new CartController();
if(isset($_REQUEST['cid'])){
    $cartInfoResults = $cartObj->get_productFromCart($_REQUEST['cid']);
    if($cartInfoResults){
        foreach($cartInfoResults as $item){ ?>
            <div class="card cart-product-card">
                <div class="card-header cart-product-header">
                    <span><?=$item['Pro_Name']?></span> <a class="btn btn-removeproduct" id="cartRemove" data-pid="<?=$item['Product_ID']?>" data-sid="<?=$item['Size_ID']?>" data-cid="<?=$item['Color_ID']?>" data-custid="<?=$_REQUEST['cid']?>" onclick="removeFromCart(this)"><i class="far fa-times-circle"></i></a>
                </div>
                <div class="card-body cart-product-body">
                    <div class="row">
                        <div class="col-3 col-img">
                            <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($item['Pro_IMG_1'])?>" class="img-fluid cart-img" alt="...">
                        </div>
                        <div class="col-9 col-data">
                            <p><?=$item['Brand']?>-- --<?=$item['Size_Value']?>-- -- <i class="fas fa-square" style="color: <?=$item['Color_Value']?>"></i>--</p>
                            <p>Quantity <?=$item['Qty']?></p>
                            <p>Amount Rs <?php echo $item['Pro_SalePrice'] * $item['Qty']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
       <?php }
    }else{
        ?>
        <div class="card cart-product-card">
            <div class="card-body cart-product-body">
                <p>Yout cart is empty</p>
            </div>
        </div>
        
        <?php

    }
}

if(isset($_REQUEST['customerID'])){
    $cartCount = $cartObj->get_productCount($_REQUEST['customerID']);
    if($cartCount){
        echo $cartCount;
    }
}

if(isset($_REQUEST['pid']) && isset($_REQUEST['sid']) && isset($_REQUEST['colid']) && isset($_REQUEST['custid'])){
    $cartDelRes = $cartObj->remove_productFromCart($_REQUEST['pid'],$_REQUEST['sid'],$_REQUEST['colid'],$_REQUEST['custid']);
    if($cartDelRes){
        echo "1";
    }else{
        echo "0";
    }
}

if(isset($_REQUEST['pid']) && isset($_REQUEST['sid']) && isset($_REQUEST['colid']) && isset($_REQUEST['custid']) && isset($_REQUEST['quantity'])){

    $cartData = [
    "pid" => mysqli_real_escape_string($db->conn,$_REQUEST['pid']),
    "sid" => mysqli_real_escape_string($db->conn,$_REQUEST['sid']),
    "co_id" => mysqli_real_escape_string($db->conn,$_REQUEST['colid']),
    "Qty" => mysqli_real_escape_string($db->conn,$_REQUEST['quantity']),
    "cu_id" => mysqli_real_escape_string($db->conn,$_REQUEST['custid'])
    ];
$res = $cartObj->addtoCart($cartData);
if($res){
  echo "1";
}else{
  echo "0";
}

}

if(isset($_REQUEST['custTotalcart'])){
    $cartRes = $cartObj->getCartTotal($_REQUEST['custTotalcart']);
    if($cartRes){
        if($cartRes->num_rows > 0){
            $total = 0.0;
            foreach($cartRes as $row){
                $price = bcadd($row['Pro_SalePrice'],'0',2);
                $qty = (int)$row['Qty'];
                $total += $price * $qty;
            }
            echo "<span class='h5'>Your Total is : Rs $total</span>";
        }else{
            echo "<span class='h5'>Your Total is : Rs 0.00</span>";
        }
    }else{
        echo "0";
    }
}
?>