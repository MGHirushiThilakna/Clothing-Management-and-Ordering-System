<?php 
$currentSubPage="viewSup";
include "SupplierHandling.php"; 
?>
<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Supplier ID</th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $results = $supplierObj->getsupplierData();
                            if($results){
                                foreach($results as $row){?>
                                    <tr>
                                    <th scope="row"><?=$row['Sup_ID']?></th>
                                    <td><?=$row['Sup_Name']?></td>
                                    <td><?=$row['Sup_contact']?></td>
                                    <td><?=$row['Email']?></td>
                                    <td>
                                        <button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                        <button class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
                                    </td>
                                    </tr>
                            <?php
                            }
                            }else{
                                echo "<tr><td colspan='5'>No Records found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "adminFooter.php"; ?>