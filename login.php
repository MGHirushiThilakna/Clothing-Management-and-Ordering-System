<?php include "header.php"; ?>
<link rel="stylesheet" href="assets\css\login-style-A.css">

<div class="container my-container">
    <div class="card my-login-card">
        <div class="card-body my-card-body">
            <div class="row">
                <div class="col-md-8 col-lg-7 col-xl-6 "><img src="assets\imgs\hah-collections-img-signin.png" class="img-fluid my-img" /></div>
                <div class="col-md-7 col-lg-5 col-xl-5 my-col">
                    <p class ="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 title">Sign in</p>
                    <?php
                        if(isset($_GET['status'])){
                            $status=$_GET['status'];
                            echo "<div class='alert alert-danger alert-dismissible fade show mt-1' role='alert' >
                                    $status
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        }
                    ?>
                    <form method="POST" action = "loginProcess.php" id="login">
                        <div class="form-floating my-form  mb-4">
                            <input type="text" id="username" name="username" class="form-control my-input shadow-none" placeholder="Username"/>
                            <label class="" for="username"><i class="fas fa-user me-2"></i>Email Address</label>
                            <div id="strUserError"></div>
                        </div>

                        <div class="form-floating my-form mb-4">
                            <input type="password" id="userpassword" name="password" class="form-control my-input shadow-none" placeholder="Password"/>
                            <label class="" for="password"><i class="fas fa-lock me-2"></i>Password</label>
                            <div id="strpasswordError"></div>
                        </div>
                        <button type="submit" name="login" class="btn  btn-lg btn-block mybtn mb-4">Sign in</button>
                    </form>
                    <div class="row mb-2">
                        <div class="col-md-12 bt-divs">
                            <span>New customer? <a href="#" onclick="displayForm()">Create your account</a></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 bt-divs">
                            <span>Lost password? <a href="#" id="passRecover">Recover password</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="register-form-modal" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="assets\css\reg-modal-style.css">
        <div class="modal-content regForm">
           
        </div>
    </div>
</div>
<div class="modal fade" id="fogot-password-modal" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-lg">
        <link rel="stylesheet" href="assets\css\reg-modal-style.css">
        <div class="modal-content modal-forgt">
           
        </div>
    </div>
</div>
<div class="modal fade" id="OTP-modal" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-lg">
        <link rel="stylesheet" href="assets\css\reg-modal-style.css">
        <div class="modal-content modal-otp">
           
        </div>
    </div>
</div>
<div class="modal fade" id="change-password" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-lg">
        <link rel="stylesheet" href="assets\css\reg-modal-style.css">
        <div class="modal-content modal-change-password">
           
        </div>
    </div>
</div>
<script src="assets\js\account-creation.js"></script>
<script src="assets\js\forgot-pass.js"></script>
<?php include "footer.php"; ?>