<?php 
include "..\classes\DBConnect.php";
include "..\classes\OrderController.php";
include "..\classes\CartController.php";
include "..\classes\ProductController.php";
include "..\classes\EmailController.php";
include "..\classes\PDFController.php";
include "..\classes\offerController.php";
$db = new DatabaseConnection;
$orderObj = new OrderController;
$cartObj = new CartController;
$productObj = new ProductController;
$offerObj = new offerController;
$emailObj = new EmailController();
$pdfObj = new PDFController();
if(isset($_REQUEST['task']) && $_REQUEST['task']==='placeOrder'){
    $cartResultForEmail;
    $paymentMethod;
    if($_REQUEST['paymentMode'] === 'COD'){
        $paymentMethod = "Cash On Delivery";
        $paymentData = [
            "del_Fee" => mysqli_real_escape_string($db->conn,$_REQUEST['charges']),
            "total" => mysqli_real_escape_string($db->conn,$_REQUEST['total']),
            "address" => mysqli_real_escape_string($db->conn,$_REQUEST['address']),
            "contact" => mysqli_real_escape_string($db->conn,$_REQUEST['contact']),
        ];
        $paymentResult = $orderObj->addPaymentCOD($paymentData);
        if($paymentResult){
            $invoiceData = [
                "subTotal" => mysqli_real_escape_string($db->conn,$_REQUEST['subtotal']),
                "discount" => mysqli_real_escape_string($db->conn,$_REQUEST['discount']),
            ];
            $invoiceResult = $orderObj->addInVoice($invoiceData);
            if($invoiceResult){
                $cartResult = $cartObj->getcartInfoDirect($_REQUEST['customerID']);
                $cartResultForEmail = $cartObj->get_productFromCartFinal($_REQUEST['customerID']);
                if($cartResult){
                    foreach ($cartResult as $row){
                        $orderData = [
                            "pid" => mysqli_real_escape_string($db->conn,$row['Product_ID']),
                            "sid" => mysqli_real_escape_string($db->conn,$row['Size_ID']),
                            "cid" => mysqli_real_escape_string($db->conn,$row['Color_ID']),
                            "qty" => mysqli_real_escape_string($db->conn,$row['Qty']),
                            "custId" => mysqli_real_escape_string($db->conn,$row['Customer_ID'])
                        ];
                        $updateResult = $productObj->reduceFromStock($orderData['pid'],$orderData['cid'],$orderData['sid'],$orderData['qty']);
                        $orderResult = $orderObj->addOrder($orderData);
                        $cartResult = $cartObj->remove_productFromCart($orderData['pid'],$orderData['sid'],$orderData['cid'],$orderData['custId']);
                    }
                    $emailbillingInfo=[
                        "payment"=> $paymentMethod,
                        "name" => $_REQUEST['user'],
                        "address" => $_REQUEST['address'],
                        "contact" => $_REQUEST['contact'],
                        "charges" => $_REQUEST['charges'],
                        "discount" => $_REQUEST['discount'],
                        "total" => $_REQUEST['total'],
                        "subtotal" => $_REQUEST['subtotal'],
                        "invoiceNo" => $orderObj->getInvoiceID()
                    ];
                    if(isset($_REQUEST['offerID'])){
                        $offerObj->UpdateclaimedStatus($_REQUEST['offerID'],$_REQUEST['customerID']);
                    }
                    $emailObj->setBillBody($emailbillingInfo,$cartResultForEmail);
                    $pdfObj->setDocumentBillBody($emailbillingInfo,$cartResultForEmail);
                    $pdfObj->createBill($emailObj->getbillcontent(),$orderObj->getInvoiceID());
                    $emailObj->sendBillInfoEmail("Your Order has been Placed",$_REQUEST['email'],$orderObj->getInvoiceID());
                    $pdfObj->removeBillPDFs($orderObj->getInvoiceID());
                    echo 1;
                }
            }
        }else{
            echo "0";
        }

    }else if($_REQUEST['paymentMode'] === 'BD'){
        $paymentMethod = "Bank Deposit";
        $paymentData = [
            "del_Fee" => mysqli_real_escape_string($db->conn,$_REQUEST['charges']),
            "total" => mysqli_real_escape_string($db->conn,$_REQUEST['total']),
            "address" => mysqli_real_escape_string($db->conn,$_REQUEST['address']),
            "contact" => mysqli_real_escape_string($db->conn,$_REQUEST['contact']),
        ];
        $paymentResult = $orderObj->addPaymentBD($paymentData);
        if($paymentResult){
            $invoiceData = [
                "subTotal" => mysqli_real_escape_string($db->conn,$_REQUEST['subtotal']),
                "discount" => mysqli_real_escape_string($db->conn,$_REQUEST['discount']),
            ];
            $invoiceResult = $orderObj->addInVoice($invoiceData);
            if($invoiceResult){
                $cartResult = $cartObj->getcartInfoDirect($_REQUEST['customerID']);
                $cartResultForEmail = $cartObj->get_productFromCartFinal($_REQUEST['customerID']);
                if($cartResult){
                    foreach ($cartResult as $row){
                        $orderData = [
                            "pid" => mysqli_real_escape_string($db->conn,$row['Product_ID']),
                            "sid" => mysqli_real_escape_string($db->conn,$row['Size_ID']),
                            "cid" => mysqli_real_escape_string($db->conn,$row['Color_ID']),
                            "qty" => mysqli_real_escape_string($db->conn,$row['Qty']),
                            "custId" => mysqli_real_escape_string($db->conn,$row['Customer_ID'])
                        ];
                        $updateResult = $productObj->reduceFromStock($orderData['pid'],$orderData['cid'],$orderData['sid'],$orderData['qty']);
                        $orderResult = $orderObj->addOrder($orderData);
                        $cartResult = $cartObj->remove_productFromCart($orderData['pid'],$orderData['sid'],$orderData['cid'],$orderData['custId']);
                    }
                    $emailbillingInfo=[
                        "payment"=> $paymentMethod,
                        "name" => $_REQUEST['user'],
                        "address" => $_REQUEST['address'],
                        "contact" => $_REQUEST['contact'],
                        "charges" => $_REQUEST['charges'],
                        "discount" => $_REQUEST['discount'],
                        "total" => $_REQUEST['total'],
                        "subtotal" => $_REQUEST['subtotal'],
                        "invoiceNo" => $orderObj->getInvoiceID()
                    ];
                    if(isset($_REQUEST['offerID'])){
                        $offerObj->UpdateclaimedStatus($_REQUEST['offerID'],$_REQUEST['customerID']);
                    }
                    $emailObj->setBillBody($emailbillingInfo,$cartResultForEmail);
                    $pdfObj->setDocumentBillBody($emailbillingInfo,$cartResultForEmail);
                    $pdfObj->createBill($emailObj->getbillcontent(),$orderObj->getInvoiceID());
                    $emailObj->sendBillInfoEmail("Your Order has been Placed",$_REQUEST['email'],$orderObj->getInvoiceID());
                    $pdfObj->removeBillPDFs($orderObj->getInvoiceID());
                    echo 1;
                }
            }
        }
    }else{
        $paymentMethod = "PickUp";
        $paymentData = [
            "total" => mysqli_real_escape_string($db->conn,$_REQUEST['total']),
            "contact" => mysqli_real_escape_string($db->conn,$_REQUEST['contact']),
        ];
        $paymentResult = $orderObj->addPaymentPickUp($paymentData);
        if($paymentResult){
            $invoiceData = [
                "subTotal" => mysqli_real_escape_string($db->conn,$_REQUEST['subtotal']),
                "discount" => mysqli_real_escape_string($db->conn,$_REQUEST['discount']),
            ];
            $invoiceResult = $orderObj->addInVoice($invoiceData);
            if($invoiceResult){
                $cartResult = $cartObj->getcartInfoDirect($_REQUEST['customerID']);
                $cartResultForEmail = $cartObj->get_productFromCartFinal($_REQUEST['customerID']);
                if($cartResult){
                    foreach ($cartResult as $row){
                        $orderData = [
                            "pid" => mysqli_real_escape_string($db->conn,$row['Product_ID']),
                            "sid" => mysqli_real_escape_string($db->conn,$row['Size_ID']),
                            "cid" => mysqli_real_escape_string($db->conn,$row['Color_ID']),
                            "qty" => mysqli_real_escape_string($db->conn,$row['Qty']),
                            "custId" => mysqli_real_escape_string($db->conn,$row['Customer_ID'])
                        ];
                        $updateResult = $productObj->reduceFromStock($orderData['pid'],$orderData['cid'],$orderData['sid'],$orderData['qty']);
                        $orderResult = $orderObj->addOrder($orderData);
                        $cartResult = $cartObj->remove_productFromCart($orderData['pid'],$orderData['sid'],$orderData['cid'],$orderData['custId']);
                    }
                    $emailbillingInfo=[
                        "payment"=> $paymentMethod,
                        "name" => $_REQUEST['user'],
                        "address" => 'None',
                        "contact" => $_REQUEST['contact'],
                        "charges" => $_REQUEST['charges'],
                        "discount" => $_REQUEST['discount'],
                        "total" => $_REQUEST['total'],
                        "subtotal" => $_REQUEST['subtotal'],
                        "invoiceNo" => $orderObj->getInvoiceID()
                    ];
                    if(isset($_REQUEST['offerID'])){
                        $offerObj->UpdateclaimedStatus($_REQUEST['offerID'],$_REQUEST['customerID']);
                    }
                    $emailObj->setBillBody($emailbillingInfo,$cartResultForEmail);
                    $pdfObj->setDocumentBillBody($emailbillingInfo,$cartResultForEmail);
                    $pdfObj->createBill($emailObj->getbillcontent(),$orderObj->getInvoiceID());
                    $emailObj->sendBillInfoEmail("Your Order has been Placed",$_REQUEST['email'],$orderObj->getInvoiceID());
                    $pdfObj->removeBillPDFs($orderObj->getInvoiceID());
                    echo 1;
                }
            }
        }

    }

}
?>

