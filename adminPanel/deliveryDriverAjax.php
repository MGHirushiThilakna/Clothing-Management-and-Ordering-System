<?php 
include "..\classes\DBConnect.php";
include "..\classes\DeliveryDriverController.php";
include "..\classes\EmailController.php";
$db = new DatabaseConnection;
$delDriverObj = new DeliveryDriverController();
$emailObj = new EmailController;

?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'addDelDriver'){
    $data = [
        'fname' => mysqli_real_escape_string($db->conn,$_REQUEST['fname']),
        'lname' => mysqli_real_escape_string($db->conn,$_REQUEST['lname']),
        'VNum' => mysqli_real_escape_string($db->conn,$_REQUEST['VNum']),
        'contact' => mysqli_real_escape_string($db->conn,$_REQUEST['contact']),
        'email' => mysqli_real_escape_string($db->conn,$_REQUEST['email']),
        'pass' => mysqli_real_escape_string($db->conn,$_REQUEST['pass'])
    ];
    $result = $delDriverObj->addDeliveryDriver($data);
    if($result){
        $emailObj->setEmpCredentialsBody($_POST['email'],$_POST['pass']);
        $emailObj->sendEmpCredentials($_POST['email']);
        echo 1;
    }else{
        echo $result;
    }
}
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showAllData'){
    $results = $delDriverObj->getDeliveryDriverInfo();
    if($results){
        foreach($results as $row){
            ?>
            <tr>
                <td><?=$row['Driver_ID']?></td>
                <td><?=$row['FName']?></td>
                <td><?=$row['LName']?></td>
                <td><?=$row['Vehicle_No']?></td>
                <td><?=$row['Contact_No']?></td>
                <td><?=$row['Email']?></td>
                <td>
                <a class="btn btn-outline-danger" ><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='7'><label>No Records Found</label></td></tr>";
    }
}
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'search'){
    $results = $delDriverObj->searchDriver($_REQUEST['field'],$_REQUEST['data']);
    if($results){
        foreach($results as $row){
            ?>
            <tr>
                <td><?=$row['Driver_ID']?></td>
                <td><?=$row['FName']?></td>
                <td><?=$row['LName']?></td>
                <td><?=$row['Vehicle_No']?></td>
                <td><?=$row['Contact_No']?></td>
                <td><?=$row['Email']?></td>
                <td>
                <a class="btn btn-outline-danger" ><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='7'><label>No Records Found</label></td></tr>";
    }
}