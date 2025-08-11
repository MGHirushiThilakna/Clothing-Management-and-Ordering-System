<?php 
use Dompdf\Dompdf;
class PDFController{

    private $pathForBill = "../exludes/billFolder/";
    private $DocBillBody;


    public function __construct() {
        require "../vendor/autoload.php";
        $this->dompdf = new Dompdf();
    }

    public function createBill($billContent,$filename){

        $billHTML = $this->DocumentHeader()." ".$this->DocBillBody;
        
        
        $this->dompdf->loadHtml($billHTML);
        
        // (Optional) Set paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $this->dompdf->render();

        // Get the generated PDF content
        $pdfContent = $this->dompdf->output();

        // Save the PDF file on the server
        $doc = $filename.".pdf";
        $pdfFilePath = $this->pathForBill . $doc;  // Specify the path to save the file
        file_put_contents($pdfFilePath, $pdfContent);
        
    }
    public function removeBillPDFs($filename){
        $doc = $filename.".pdf";
        unlink($this->pathForBill.$doc);
    }

    private function DocumentHeader(){
        $header= '
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
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>HAH Collections</h1>
                    <p>Welcome to our clothing store</p>
                </div>';
        return $header;
    }

    public function setDocumentBillBody($billingInfo,$tableData){
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
        $this->DocBillBody = '
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



    
}
?>