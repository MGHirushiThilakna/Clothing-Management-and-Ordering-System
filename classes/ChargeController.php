<?php 
require_once "GenerateID.php";
class ChargeController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->generateId = new GenerateID;
        $this->conn = $db ->conn;
    }

    public function addNewCharges($data){
        $idType = "charge";
        $chargeID= $this->generateId->getNewID($idType);
        $type = $data['type'];
        $location = $data['location'];
        $charge = $data['charge'];
        $sql_create = "INSERT INTO charges VALUES ('$chargeID','$type','$location','$charge')";
        if($this->conn->query($sql_create)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function displaycharges(){
        $sql = "SELECT * FROM charges";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function displaychargesForPaymentMethods($paymentMethod){
        $sql = "SELECT * FROM charges WHERE Charge_Type='$paymentMethod';";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function getChargeValueByID($id){
        $sql = "SELECT `Value` FROM charges WHERE charge_ID='$id';";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function UpdateCharges($data){
        $chargeID= $data['ID'];
        $type = $data['type'];
        $location = $data['location'];
        $charge = $data['charge'];
        $sql_update = "UPDATE charges SET `Charge_Type`='$type',`Location`='$location',`Value`='$charge' WHERE charge_ID = '$chargeID'";
        if($this->conn->query($sql_update)){
            return true;
        }else{
            return false;
        }
    }
    public function getInfoUpdate($id){
        $sql_show = "SELECT * FROM charges WHERE charge_ID = '$id'";
        $result = $this->conn->query($sql_show);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function removeCharges($id){
        $sql = "DELETE FROM charges WHERE charge_ID = '$id'";
        if($this->conn->query($sql)){
            return true;
        }else{
            return false;
        }
    }
}
?>