<?php 
require_once "GenerateID.php";
class OrderController{
    private $paymentID;
    private $invoiceID;

    public function __construct(){
        $db = new DatabaseConnection;
        $this->generateId = new GenerateID;
        $this->conn = $db ->conn;
    }

    public function getpaymentID(){
        return $this->paymentID;
    }

    public function getInvoiceID(){
        return $this->invoiceID;
    }

    public function addPaymentCOD($data){
        $idType = "payment";
        $this->paymentID = $this->generateId->getNewID($idType);
        $deliveryFee = $data['del_Fee'];
        $total = $data['total'];
        $address = $data['address'];
        $contact = $data['contact'];
        $sql_payment = "INSERT INTO `payment_cod`(`Payment_ID`, `Delivery_Fee`, `Total`, `Delivery_Address`,`Contact_NO`) VALUES ('$this->paymentID','$deliveryFee','$total','$address','$contact')"; 
        if($this->conn->query($sql_payment)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function addPaymentBD($data){
        $idType = "payment";
        $this->paymentID = $this->generateId->getNewID($idType);
        $deliveryFee = $data['del_Fee'];
        $total = $data['total'];
        $address = $data['address'];
        $contact = $data['contact'];
        $sql_payment = "INSERT INTO `payment_bankdeposit`(`Payment_ID`, `postal_charges`, `Total`, `Delivery_Address`, `Contact_NO`) VALUES ('$this->paymentID','$deliveryFee','$total','$address','$contact')";
        if($this->conn->query($sql_payment)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function addPaymentPickUp($data){
        $idType = "payment";
        $this->paymentID = $this->generateId->getNewID($idType);
        $total = $data['total'];
        $contact = $data['contact'];
        $sql_payment = "INSERT INTO `payment_pickup`(`Payment_ID`, `Contact_NO`, `Total`) VALUES ('$this->paymentID','$contact','$total')";
        if($this->conn->query($sql_payment)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }

    public function addInVoice($data){
        $idType = "invoice";
        $this->invoiceID = $this->generateId->getNewID($idType);
        $subTotal = $data['subTotal'];
        $discount = $data['discount'];
        $currentDate = date('Y-m-d');
        $status = "Pending";
        $paymentID = $this->paymentID;
        $sql_invoice = "INSERT INTO `invoice`(`Invoice_ID`, `sub_Total`, `Discount`, `Order_Date`,order_status ,`Payment_ID`) VALUES ('$this->invoiceID','$subTotal','$discount','$currentDate','$status','$paymentID')";
        if($this->conn->query($sql_invoice)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }

    public function addOrder($data){
        $idType = "order";
        $orderID = $this->generateId->getNewID($idType);
        $productID = $data['pid'];
        $sizeID = $data['sid'];
        $colorID = $data['cid'];
        $qty=$data['qty'];
        $customerID=$data['custId'];
        $invoiceID = $this->invoiceID;
        $sql_order = "INSERT INTO `order_tbl`(`Order_ID`, `Product_ID`, `Size_ID`, `Color_ID`, `Order_Qty`, `Customer_ID`, `Invoice_ID`) VALUES ('$orderID','$productID','$sizeID','$colorID','$qty','$customerID','$invoiceID')";
        if($this->conn->query($sql_order)){
            $this->generateId->updatetID($idType);
        }
    }

    public function DisplayOrders(){
        $sql = "SELECT * FROM invoice";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    
    public function getOrderInFoTable($invoiceID){
        $sql = "SELECT p.Product_ID,s.Size_ID,c.Color_ID,p.Pro_Name,s.Size_Value,c.Color_Value,c.Color_Name,o.Order_Qty FROM product p, size s, color c, order_tbl o WHERE p.Product_ID = o.Product_ID AND s.Size_ID = o.Size_ID AND c.Color_ID = o.Color_ID AND o.Invoice_ID = '$invoiceID'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getPaymentMethod($paymentID){
        $sql_query = "SELECT 'COD' AS Payment_METHOD,Delivery_Address,Contact_NO FROM payment_cod WHERE Payment_ID = '$paymentID' UNION ALL SELECT 'BD' AS Payment_METHOD,Delivery_Address,Contact_NO FROM payment_bankdeposit WHERE Payment_ID = '$paymentID' UNION ALL SELECT 'Pick' AS Payment_METHOD,`Total`,Contact_NO FROM payment_pickup WHERE Payment_ID = '$paymentID'";
        $result = $this->conn->query($sql_query);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }

    }

    public function getImgProofBDPayment($paymentID){
        $sql = "SELECT `Payment_Proof` FROM `payment_bankdeposit` WHERE `Payment_ID` = '$paymentID'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }

    }

    public function getInvoiceData($orderStatus){
        $sql = "SELECT * FROM `invoice` WHERE order_status='$orderStatus'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getInvoiceDataCODAndOS($orderStatus){
        $sql = "SELECT i.* FROM invoice i INNER JOIN payment_cod p ON i.Payment_ID = p.Payment_ID WHERE i.order_status = '$orderStatus';";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getInvoiceDataBDAndOS($orderStatus){
        $sql = "SELECT i.* FROM invoice i INNER JOIN payment_bankdeposit p ON i.Payment_ID = p.Payment_ID WHERE i.order_status = '$orderStatus';";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getInvoiceDataPKAndOS($orderStatus){
        $sql = "SELECT i.* FROM invoice i INNER JOIN payment_pickup p ON i.Payment_ID = p.Payment_ID WHERE i.order_status = '$orderStatus';";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getInvoiceDataForCustomer($CustomerID,$status){
        $sql = "SELECT i.* FROM invoice i, order_tbl o WHERE i.Invoice_ID = o.Invoice_ID AND o.Customer_ID = '$CustomerID' AND i.order_status <> '$status' GROUP BY o.Invoice_ID ORDER BY i.Invoice_ID ASC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getCompletedInvoiceDataForCustomer($CustomerID,$status){
        $sql = "SELECT i.* FROM invoice i, order_tbl o WHERE i.Invoice_ID = o.Invoice_ID AND o.Customer_ID = '$CustomerID' AND i.order_status = '$status' GROUP BY o.Invoice_ID ORDER BY i.Invoice_ID ASC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    private function imgDbFormat($file){
        /*$imageTempName = $file['tmp_Name'];*/
        $imageContent = addslashes(file_get_contents($file));
        return $imageContent;
    }

    public function updatePaymentProof($image,$pid){
        $imgProof = $this->imgDbFormat($image);
        $sql = "UPDATE payment_bankdeposit SET Payment_Proof = '$imgProof' WHERE Payment_ID ='$pid'";
        if($this->conn->query($sql)){
            return true;
        }else{
            return $this->conn -> error;
        }
    }

    public function RemoveRecordsFromInvoice($invoiceId){
        $sql = "DELETE FROM invoice WHERE Invoice_ID = '$invoiceId';";
        if($this->conn->query($sql)){
            return true;
        }else{
            return $this->conn -> error;
        }
    }
    public function RemovePaymentRecord($paymentID){
        $result = $this->getPaymentMethod($paymentID);
        $pmData = $result->fetch_assoc();
        $pmValue = $pmData['Payment_METHOD'];
        $sql="";
        if($pmValue === 'COD'){
            $sql = "DELETE FROM payment_cod WHERE Payment_ID = '$paymentID';";
        }else if($pmValue === 'BD'){
            $sql = "DELETE FROM payment_bankdeposit WHERE Payment_ID = '$paymentID';";
        }else{
            $sql = "DELETE FROM payment_pickup WHERE Payment_ID = '$paymentID';";
        }
        if($this->conn->query($sql)){
            return true;
        }else{
            return $this->conn -> error;
        }

    }

    public function updateOrderStatusAdmin($invoiceID,$status){
        $sql = "UPDATE invoice SET order_status = '$status' WHERE Invoice_ID = '$invoiceID'";
        if($this->conn->query($sql)){
            return true;
        }else{
            return $this->conn -> error;
        }
    }

    public function AssignEmp($invoiceID,$empID){
        $sql = "UPDATE invoice SET Emp_ID = '$empID' WHERE Invoice_ID = '$invoiceID'";
        if($this->conn->query($sql)){
            return true;
        }else{
            return $this->conn -> error;
        }
    }

    public function AssignDriver($paymentId,$DriverID){
        $sql = "UPDATE payment_cod SET Driver_ID = '$DriverID' WHERE Payment_ID = '$paymentId'";
        if($this->conn->query($sql)){
            return true;
        }else{
            return $this->conn -> error;
        }
    }

    public function getDispatchedOrderDriver($Driver){
        $sql = "SELECT i.Invoice_ID,i.order_status,i.Payment_ID FROM invoice i,payment_cod pcod WHERE i.Payment_ID = pcod.`Payment_ID` AND i.order_status = 'Dispatched' AND pcod.`Driver_ID` = '$Driver'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getOrderStaff($id){
        $sql = "SELECT Invoice_ID,order_status,Payment_ID FROM invoice WHERE order_status = 'Pending' OR order_status = 'Confirmed' AND Emp_ID = '$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getREADYCOMPLETEOrderStaff($id){
        $sql = "SELECT Invoice_ID,order_status,Payment_ID FROM invoice WHERE order_status = 'Ready' OR order_status = 'Completed' AND Emp_ID = '$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getCompleteOrderDriver($Driver){
        $sql = "SELECT i.Invoice_ID,i.order_status,i.Payment_ID FROM invoice i,payment_cod pcod WHERE i.Payment_ID = pcod.`Payment_ID` AND i.order_status = 'Completed' AND pcod.`Driver_ID` = '$Driver'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    
    public function getBillingInfoCOD($PaymentID){
        $sql = "SELECT Delivery_Fee,Total FROM payment_cod WHERE Payment_ID = '$PaymentID'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getBillingInfoPiCK($PaymentID){
        $sql = "SELECT * FROM payment_pickup WHERE Payment_ID = '$PaymentID'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getBillingInfoBD($PaymentID){
        $sql = "SELECT * FROM payment_bankdeposit WHERE Payment_ID = '$PaymentID'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getEmpOforder($Id){
        $sql = "SELECT Emp_ID FROM invoice WHERE Invoice_ID = '$Id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    

}

?>