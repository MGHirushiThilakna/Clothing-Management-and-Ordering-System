<?php 
$currentMainPage = "profile";
include "customerHeader.php"; 
include "..\classes\DBConnect.php";
include "..\classes\CustomerController.php";
$db = new DatabaseConnection;
$customerObj = new CustomerController();
?>
<link rel="stylesheet" href="..\assets\css\customer-profile-style.css">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <form id="saveCustomerINFO">
                    <?php 
                        $result = $customerObj -> getInfoForUpate($customerID);
                        if($result){
                           $customerData = $result -> fetch_assoc(); ?>
                           <div class="card-header mycardheader">Your Infomation</div>
                <div class="card-body">
                    <input type="hidden" id="customerID" value="<?=$customerID?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText yourForm" name="fname" id="floatingInput" placeholder=" " value="<?=$customerData['FName']?>">
                                <label for="floatingInput">First Name</label>
                                <div id="strFnameError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText yourForm" name="lname" id="floatingInput" placeholder=" " value="<?=$customerData['LName']?>">
                                <label for="floatingInput">Last Name</label>
                                <div id="strLnameError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText yourForm" name="email" id="floatingInput" placeholder=" " value="<?=$customerData['Email']?>">
                                <label for="floatingInput">Email Address</label>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-floating myFormFloating">
                                <input type="text" class="form-control myinputText yourForm" name="contact" id="floatingInput" placeholder=" " value="<?=$customerData['Contact_NO']?>">
                                <label for="floatingInput">Contact Number</label>
                                <div id="strContactError"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-floating myFormFloating">
                                <textarea class="form-control myinputTextArea yourForm" name="address"  placeholder=" " id="floatingTextarea"><?=$customerData['Address']?></textarea>
                                <label for="floatingTextarea">Address</label>
                                <div id="strAddressError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="btn-col">
                                <button class="btn myBtn" id="btnSave" type="submit" name="btnSave">Save</button>
                                <button class="btn myBtn" id="btnEdit" onclick="" name="btnEdit">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                        <?php }
                    ?> 
                
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mycardheader">Change Your Password</div>
                <form id="changePasswordForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class="form-floating myFormFloating">
                                    <input type="password" class="form-control myinputText changeForm" name="currentPass" id="floatingInput" placeholder=" ">
                                    <label for="floatingInput">Current Password</label>
                                    <div id="strCurrentPassError"></div>

                                </div>
                            </div>
                            <div class="col-1 myeye">
                                <span id="CPeyeicon" class="fa fa-eye "></span>
                                <span id="CPeyeslashicon" class="fa fa-eye-slash"></span>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-11">
                                <div class="form-floating myFormFloating">
                                    <input type="password" class="form-control myinputText changeForm" name="NewPass" id="floatingInput" placeholder=" ">
                                    <label for="floatingInput">New Password</label>
                                    <div id="strNewPassError"></div>
                                </div>
                            </div>
                            <div class="col-1 myeye">
                                <span id="CPeyeicon2" class="fa fa-eye "></span>
                                <span id="CPeyeslashicon2" class="fa fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-11">
                                <div class="form-floating myFormFloating">
                                    <input type="password" class="form-control myinputText changeForm" name="RepeatNewPass" id="floatingInput" placeholder=" " >
                                    <label for="floatingInput">Repeat New Password</label>
                                    <div id="strRepeatNewPassError"></div>
                                </div>
                            </div>
                            <div class="col-1 myeye">
                                <span id="CPeyeicon3" class="fa fa-eye "></span>
                                <span id="CPeyeslashicon3" class="fa fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="btn-col">
                                    <button class="btn myBtn" id="btnChangePass" type="submit" name="btnChangePass">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="..\assets\js\customer-profile.js"></script>
<?php include "customerFooter.php"; ?>