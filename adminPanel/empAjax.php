<?php 
include "..\classes\DBConnect.php";
include "..\classes\EmployeeController.php";
include "..\classes\EmailController.php";
$db = new DatabaseConnection;
$empObj = new EmployeeController();
$emailObj = new EmailController;
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'addEmp'){
    $data = [
        'fname' => mysqli_real_escape_string($db->conn,$_REQUEST['fname']),
        'lname' => mysqli_real_escape_string($db->conn,$_REQUEST['lname']),
        'Job_Role' => mysqli_real_escape_string($db->conn,$_REQUEST['job']),
        'contact' => mysqli_real_escape_string($db->conn,$_REQUEST['contact']),
        'email' => mysqli_real_escape_string($db->conn,$_REQUEST['email']),
        'pass' => mysqli_real_escape_string($db->conn,$_REQUEST['pass'])
    ];
    $result = $empObj->addEmployee($data);
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
    $results = $empObj->getEmpData();
    if($results){
        foreach($results as $row){
            ?>
            <tr>
                <td><?=$row['Emp_ID']?></td>
                <td><?=$row['FName']?></td>
                <td><?=$row['LName']?></td>
                <td><?=$row['Email']?></td>
                <td><?=$row['Job_Role']?></td>
                <td><?=$row['Contact_No']?></td>
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
    $results = $empObj->searchEMP($_REQUEST['field'],$_REQUEST['data']);
    if($results){
        foreach($results as $row){
            ?>
            <tr>
                <td><?=$row['Emp_ID']?></td>
                <td><?=$row['FName']?></td>
                <td><?=$row['LName']?></td>
                <td><?=$row['Email']?></td>
                <td><?=$row['Job_Role']?></td>
                <td><?=$row['Contact_No']?></td>
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