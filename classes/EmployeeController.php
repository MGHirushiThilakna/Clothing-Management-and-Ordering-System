<?php 
require_once "GenerateID.php";
class EmployeeController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->generateId = new GenerateID;
        $this->conn = $db ->conn;
    }
    public function addEmployee($data){
        $idType = "employee";
        $employeeID = $this->generateId->getNewID($idType);
        $fname = $data['fname'];
        $lname = $data['lname'];
        $jobRol = $data['Job_Role'];
        $contact = $data['contact'];
        $email = $data['email'];
        $password = password_hash($data['pass'],PASSWORD_DEFAULT);
        $sql_create = "INSERT INTO employee VALUES('$employeeID','$fname','$lname','$jobRol','$email','$password','$contact')";
        if($this->conn->query($sql_create)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return $this->conn -> error;
        }
    }

    public function getEmpData(){
        $sql = "SELECT * FROM employee";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }

    public function searchEMP($category,$searchData){
        $sql = "SELECT * FROM employee WHERE $category LIKE '%$searchData%'";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    
    public function updateEmployee($data){
        $employeeID = $data['id'];
        $fname = $data['fname'];
        $lname = $data['lname'];
        $contact = $data['contact'];
        $sql = "UPDATE employee SET FName = '$fname',LName = '$lname',Contact_No = '$contact' WHERE Emp_ID = '$employeeID'";
        if($this->conn->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    public function getLoginData($username){
        $sql_get_login_data = "SELECT * FROM employee WHERE Email = '$username';";
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
    public function getInfoForUpdate($id){
        $sql = "SELECT * FROM employee WHERE Emp_ID ='$id'";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }

    public function ChangeEmpPassword($data){
        $empID = $data['id'];
        $password = $data['password'];
        $sql_update = "UPDATE employee SET `Password`='$password' WHERE Emp_ID = '$empID';";
        $result = $this->conn->query($sql_update);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
?>