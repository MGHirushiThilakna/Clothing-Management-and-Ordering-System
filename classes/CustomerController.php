<?php 
require_once "GenerateID.php";
class CustomerController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->generateId = new GenerateID;
        $this->conn = $db ->conn;
    }
    public function createCustomerAccount($data){
        $idType = "customer";
        $customerID = $this->generateId->getNewID($idType);
        $fname = $data['fname'];
        $lname = $data['lname'];
        $Email = $data['email'];
        $password = password_hash($data['pass'],PASSWORD_DEFAULT);
        $sql_create = "INSERT INTO customer(Customer_ID,FName,LName,Email,`Password`) VALUES('$customerID','$fname','$lname','$Email','$password')";
        if($this->conn->query($sql_create)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function checkEmailInDB($email){
        $sql_getcount = "SELECT * FROM customer WHERE Email = '$email';";
        $results = $this->conn->query($sql_getcount);
        if($results->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getLoginData($username){
        $sql_get_login_data = "SELECT * FROM customer WHERE Email = '$username';";
        $result = $this->conn->query($sql_get_login_data);
        if($result){
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getCustomerInfo(){
        $sql = "SELECT Customer_ID,FName,LName,Email,`Address`,Contact_NO FROM customer";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }

    }

    public function getInfoForUpate($customerID){
        $sql_getData = "SELECT FName,LName,Email,`Address`,Contact_NO FROM customer WHERE Customer_ID = '$customerID';";
        $result = $this->conn->query($sql_getData);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function updateCustomerInfo($data){
        $customerID = $data['cid'];
        $fname = $data['fname'];
        $lname = $data['lname'];
        $address = $data['address'];
        $contact = $data['contact'];
        $sql_update = "UPDATE customer SET FName = '$fname',LName = '$lname',`Address` = '$address', Contact_NO = '$contact' WHERE Customer_ID = '$customerID';";
        $result = $this->conn->query($sql_update);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function changePassword($data){
        $customerID = $data['cid'];
        $password = $data['password'];
        $sql_update = "UPDATE customer SET `Password`='$password' WHERE Customer_ID = '$customerID';";
        $result = $this->conn->query($sql_update);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function changePasswordByEmail($data){
        $email = $data['email'];
        $password = password_hash($data['password'],PASSWORD_DEFAULT);

        $sql_update = "UPDATE customer SET `Password`='$password' WHERE Email = '$email';";
        $result = $this->conn->query($sql_update);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function searchCustomer($category,$searchData){
        $sql = "SELECT * FROM customer WHERE $category LIKE '%$searchData%'";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
}
?>