<?php 
include "..\classes\DBConnect.php";
include "..\classes\cartController.php";
include "..\classes\offerController.php";
include "..\classes\ChargeController.php";
$db = new DatabaseConnection;
$cartObj = new CartController();
$offerObj = new offerController();
$chargeObj = new ChargeController();
?>
<?php 
if(isset($_REQUEST['cid']) && $_REQUEST['task']=== 'show'){
    $result = $cartObj->get_productFromCart($_REQUEST['cid']);
    if($result){
        foreach($result as $item){?>
            <tr>
                <td><img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($item['Pro_IMG_1'])?>" class="img-fluid cart-img" alt="..."></td>
                <td><?=$item['Pro_Name']?></td>
                <td><?=$item['Size_Value']?></td>
                <td><i class="fas fa-square" style="color: <?=$item['Color_Value']?>"></i></td>
                <td><?=$item['Pro_SalePrice']?></td>
                <td><?=$item['Qty']?></td>
                <td><?php echo $item['Pro_SalePrice'] * $item['Qty'];?></td>
                <td><a class="btn btn-danger" id="cart-tbl-del" data-pid="<?=$item['Product_ID']?>" data-sid="<?=$item['Size_ID']?>" data-cid="<?=$item['Color_ID']?>" data-custid="<?=$_REQUEST['cid']?>" onclick="removeFromCarttbl(this)"><i class="far fa-trash-alt"></i></a></td>
            </tr>

       <?php }
    }
}
if(isset($_REQUEST['cid']) && $_REQUEST['task']=== 'finalDisplay'){
    $result = $cartObj->get_productFromCartFinal($_REQUEST['cid']);
    if($result){
        foreach($result as $item){?>
            <tr>
                <td><?=$item['Pro_Name']?></td>
                <td><?=$item['Size_Value']?></td>
                <td><?=$item['Color_Name']?></td>
                <td><?=$item['Pro_SalePrice']?></td>
                <td><?=$item['Qty']?></td>
                <td><?php echo $item['Pro_SalePrice'] * $item['Qty'];?></td>
            </tr>

       <?php }
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
            echo "$total";
        }else{
            echo "0.00";
        }
    }else{
        echo "0";
    }
}

if(isset($_REQUEST['offerID']) && isset($_REQUEST['subtotal'])){
    $subTotal = doubleval($_REQUEST['subtotal']);
    $discountAmount = 0;
    $result = $offerObj->getofferDetails($_REQUEST['offerID']);
    if($result){
        $data = $result-> fetch_assoc();
        $billValue = doubleval($data['TotalBillValue']);
        if($subTotal >= $billValue){
            if($data['Discount_Type'] === 'percentage'){
                $percentage = doubleval($data['Discount']);
                $discountAmount = $subTotal * ($percentage / 100);
            }else{
                $discountAmount = doubleval($data['Discount']);
            }
        }else{
            $discountAmount = 0;
        }
        
        $data = array(
            "billValue" => $billValue,
            "discountAmount" => $discountAmount
        );
        echo json_encode($data);
    }
}

if(isset($_REQUEST['chargeID']) && $_REQUEST['task'] === 'getValue'){
    $result =  $chargeObj->getChargeValueByID($_REQUEST['chargeID']);
    if($result){
        $item = $result->fetch_assoc();
        echo $item['Value'];
    }else{
        echo 0;
    }
}

?>