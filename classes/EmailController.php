<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailController
{
    private $EmailBillBody;
    private $EmailOTPBody;
    private $EmailCredentialsBody;

    private $BillContent;
    public function getbillcontent(){
        return $this->BillContent;
    }
    private function Intialize(){
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = "587";
        $this->mail->Username = "hahcollections.store@gmail.com";
        $this->mail->Password = "rfyvbhwlwrmthmso";

    }
    public function sendBillInfoEmail($subject,$email,$filename){
        $this->Intialize();
        $this->mail->Subject = $subject;
        $this->mail->setFrom('hahcollections.store@gmail.com');
        $this->mail->isHTML(true);
        $this->BillContent = $this->getMailHeader()." ".$this->EmailBillBody;
        $this->mail->Body = $this->BillContent;
        $this->mail->addAttachment('../exludes/billFolder/'.$filename.'.pdf');

        $this->mail->addAddress($email);

        if ($this->mail->send()) {
        } else {
            echo "Message could not be sent. Mailer Error: " . $this->mail->ErrorInfo;
        }

        $this->mail->smtpClose();
    }

    private function getMailHeader(){
        $headerMessage = '
        <html>
            <head>
                <style>
                    .header {
                        background-color: #d8d5ff;
                        padding: 20px;
                        text-align: center;
                        border-bottom: 2px solid #9b93fe;
                    }
                    .header h1 {
                        color: #333;
                        font-size: 25px;
                        font-family: oblique;
                        margin: 0;
                    }
                    .header p {
                        color: #777;
                        font-size: 16px;
                        margin: 10px 0;
                    }
                    .header .post{
                        font-family: Lucida Handwriting;
                    }
                    .order-details {
                        float: left;
                        width: 45%;
                        margin-right: 5%;
                    }
                    .billing-details {

                        float: right;
                        width: 45%;
                        margin-left: 5%;
                    }
                    .billing-details p{
                        font-weight: bold;
                        color: #6c5ce7;
                    }
                    .billing-details p .data{
                        font-weight: 400;
                        color: black;
                    }
                    .billing-details p .total{
                        font-size: 25px;
                        color: black;
                    }
                    .billing-details p .sub,.billing-details p .charge{
                        font-size: 20px;
                        color: black;
                    }
                    table {
                        width: 100%;
                    }
                    table td {
                        text-align: center;
                        padding: 5px;
                        border-bottom: 1px solid #9b93fe;
                    }
                    table th{
                        border-top: 2px solid #9b93fe;
                        padding: 5px;
                        border-bottom: 2px solid #9b93fe;
                    }
                    .box {
                        margin: 0 auto;
                        max-width: 600px;
                        padding: 20px;
                        background-color: #f5f5f5;
                    }
                    .card {
                        margin: 0 auto;
                        width: 300px;
                        background-color: #fff;
                        border-radius: 10px;
                        padding: 20px;
                        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                        font-family: Arial, sans-serif;
                        text-align: center;
                    }
                    .card-header {
                        text-align: center;
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 10px;
                    }
                    .card-body {
                        background-color: #f5f5f5;
                        padding: 15px;
                        border-radius: 8px;
                        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    .otp-label {
                        font-size: 18px;
                        margin-bottom: 10px;
                    }
                    .otp-code {
                        display: block;
                        font-size: 24px;
                        font-weight: bold;
                        padding: 5px 10px;
                        background-color: #f0f0f0;
                        border-radius: 4px;
                        text-align: center;
                    }
                    .expiration {
                        margin-top: 20px;
                        text-align: center;
                        color: #777;
                        font-size: 14px;
                    }
                    .credentials-label {
                        font-size: 18px;
                        margin-bottom: 10px;
                    }

                    .username,
                    .password {
                        font-size: 16px;
                        padding: 5px 10px;
                        background-color: #f0f0f0;
                        border-radius: 4px;
                        border: 1px solid #ccc;
                        width: 100%;
                    }

                    .credentials-group {
                        margin-bottom: 20px;
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>HAH Collections</h1>
                    <p>Welcome to our clothing store</p>
                </div>
        ';
        return $headerMessage;
    }

    public function setBillBody($billingInfo,$tableData){
        $tablerow="";
        foreach($tableData as $row){
            $tablerow.= "<tr>";
            $tablerow.="<td>".$row['Pro_Name']."</td>";
            $tablerow.="<td>".$row['Size_Value']."</td>";
            $tablerow.="<td>".$row['Color_Name']."</td>";
            $tablerow.="<td>".$row['Pro_SalePrice']."</td>";
            $tablerow.="<td>".$row['Qty']."</td>";
            $tablerow.="<td>".$row['Pro_SalePrice']*$row['Qty']."</td>";
            $tablerow.= "</tr>";
        }
        $this->EmailBillBody = '
        <div class="order-details">
                    <h2>Order Details</h2>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                        '.$tablerow.'
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>SubTotal</th>
                            <th>'.$billingInfo['subtotal'].'</th>
                        </tr>
                        
                    </table>
                </div>
                
                <div class="billing-details">
                    <h2>Billing Details</h2>
                    <p>INVOICE NO: <span class="data">'.$billingInfo['invoiceNo'].'</span></p>
                    <p>Name: <span class="data">'.$billingInfo['name'].'</span></p>
                    <p>Payment Method: <span class="data">'.$billingInfo['payment'].'</span></p>
                    <p>Address: <span class="data">'.$billingInfo['address'].'</span></p>
                    <p>Contact:<span class="data">'.$billingInfo['contact'].'</span></p>
                    <p>Discount: <span class="sub">Rs. '.$billingInfo['discount'].'</span></p>
                    <p>Charges: <span class="charge">Rs. '.$billingInfo['charges'].'</span></p>
                    <p>Total: <span class="total">Rs. '.$billingInfo['total'].'</span></p>
                </div>
        ';
    }
    public function setOTPBody($otpCode){
        $this->EmailOTPBody = '
        <div class="box">
            <div class="card">
                <div class="card-header">OTP Information</div>
                <div class="card-body">
                    <div class="otp-label">Your One-Time Password (OTP):</div>
                    <div class="otp-code">'.$otpCode.'</div>
                </div>
                <div class="expiration">This OTP will expire in 5 minutes.</div>
            </div>
        </div>        
        ';
    }
    public function sendOTPCode($email){
        $subject = "Your One Time Password to Recover your Account";
        $this->Intialize();
        $this->mail->Subject = $subject;
        $this->mail->setFrom('hahcollections.store@gmail.com');
        $this->mail->isHTML(true);
        $this->mail->Body = $this->getMailHeader()." ".$this->EmailOTPBody;
        $this->mail->addAddress($email);

        if ($this->mail->send()) {
        } else {
            echo "Message could not be sent. Mailer Error: " . $this->mail->ErrorInfo;
        }

        $this->mail->smtpClose();
        
    }

    public function sendEmpCredentials($email){
        $subject = "New Employee Credentials";
        $this->Intialize();
        $this->mail->Subject = $subject;
        $this->mail->setFrom('hahcollections.store@gmail.com');
        $this->mail->isHTML(true);
        $this->mail->Body = $this->getMailHeader()." ".$this->EmailCredentialsBody;
        $this->mail->addAddress($email);

        if ($this->mail->send()) {
        } else {
            echo "Message could not be sent. Mailer Error: " . $this->mail->ErrorInfo;
        }
        $this->mail->smtpClose();
    }
    public function setEmpCredentialsBody($email,$pass){
        $this->EmailCredentialsBody = '
        <div class="box">
                    <div class="card">
                        <div class="card-header">User Credentials For Login</div>
                        <div class="card-body">
                            <div class="credentials-group">
                                <label for="username" class="credentials-label">Username:</label>
                                <span class="username">'.$email.'</span>
                            </div>
                            <div class="credentials-group">
                                <label for="password" class="credentials-label">Password:</label>
                                <span class="password">'.$pass.'</span>
                            </div>
                        </div>
                    </div>
                </div>        
        ';
    }
}
