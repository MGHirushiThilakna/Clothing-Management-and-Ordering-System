
<?php 
include "classes\DBConnect.php";
include "classes\CustomerController.php";
$db = new DatabaseConnection;
$customerObj = new CustomerController();
session_start();
if(isset($_SESSION['customerID'])){
    $userPassword = $_SESSION['CurrentPassword'];
    $CustomerID = $_SESSION['customerID'];
}

?>
<?php
if(isset($_POST['task']) && $_POST['task'] == 'create'){ ?>
    <!-- modal header -->
    <div class="modal-header my-modal-header">
                <div class="modal-title My-regForm-title">Create Your Account</div>
                <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <!-- header close -->

           <!-- modal body -->
           <div class="modal-body">
                <div class="row img-row">
                    <div class="col-md-6 img-col">
                    <img src="assets\imgs\hah-collections-img1-assets\reg-page-image.jpg" class="img-fluid reg-img" alt="...">
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="card mt-2 ">
                            <div class="card-body">
                                <form id="customerRegisterForm">
                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-2">
                                        <input type="text" name="Fname" id="Fname" class="form-control myinputText" placeholder="First Name">
                                        <div id="strFnameError"></div>
                                        </div>
                                        <div class="col-md-6">
                                        <input type="text" name="Lname" id="Lname" class="form-control myinputText" placeholder="Last Name">
                                        <div id="strLnameError"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-2">
                                        <input type="text" name="email" id="email" class="form-control myinputText" placeholder="Email Address">
                                        <div id="strEmailError"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-2">
                                        <input type="password" name="password" id="password" class="form-control myinputText" placeholder="Password">
                                        <div id="strPasswordError"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-2">
                                        <input type="password" name="repeat_password" id="repeat_password" class="form-control myinputText" placeholder="Repeat Password">
                                        <div id="strRePasswordError"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><button class="btn my-reg-btn" type="submit">Create Account</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <script src="assets\js\form-validation\customer-register-form-validation.js"></script>
           <!-- body close -->
<?php }
?>

<?php 
if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['pass'])){
    $data = [
        "fname" => mysqli_real_escape_string($db->conn,$_POST['fname']),
        "lname" => mysqli_real_escape_string($db->conn,$_POST['lname']),
        "email" => mysqli_real_escape_string($db->conn,$_POST['email']),
        "pass" => mysqli_real_escape_string($db->conn,$_POST['pass']),
    ];
    $result = $customerObj -> createCustomerAccount($data);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
?>

<?php 
if(isset($_REQUEST['validateEmail'])){
    $res = $customerObj -> checkEmailInDB($_REQUEST['validateEmail']);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['address']) && isset($_REQUEST['customer']) && isset($_REQUEST['contact'])){
    $data_update = [
        "cid" => mysqli_real_escape_string($db->conn,$_REQUEST['customer']),
        "fname" => mysqli_real_escape_string($db->conn,$_REQUEST['fname']),
        "lname" => mysqli_real_escape_string($db->conn,$_REQUEST['lname']),
        "address" => mysqli_real_escape_string($db->conn,$_REQUEST['address']),
        "contact" => mysqli_real_escape_string($db->conn,$_REQUEST['contact'])
    ];
    $result = $customerObj -> updateCustomerInfo($data_update);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_REQUEST['password'])){
    $verify = password_verify($_REQUEST['password'],$userPassword);
    if($verify){
        echo 1;
    }else{
        echo 2;
    }
}
if(isset($_REQUEST['newPassword'])){
    $password = password_hash($_REQUEST['newPassword'],PASSWORD_DEFAULT);
    $update = [
        "cid" => mysqli_real_escape_string($db->conn,$CustomerID),
        "password" => mysqli_real_escape_string($db->conn,$password)
    ];
    $result = $customerObj -> changePassword($update);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
?>
