<?php 
require_once "GenerateID.php";
class SupplierController{

    public function __construct(){
        $db = new DatabaseConnection;
        $this->generateId = new GenerateID;
        $this->conn = $db ->conn;
    }
    public function addNewSupplier($supplierData){
        $idType = "supplier";
        $supId = $this->generateId->getNewID($idType);
        $supName = $supplierData['name'];
        $supContact = $supplierData['contact'];
        $supEmail = $supplierData['email'];
        $sql_add_supplier = "INSERT INTO supplier VALUES('$supId','$supName','$supContact','$supEmail');";
        if($this->conn->query($sql_add_supplier)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function getsupplierData(){
        $sql_get_supplier_data = "SELECT * FROM supplier;";
        $results = $this->conn->query($sql_get_supplier_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
}
?> 