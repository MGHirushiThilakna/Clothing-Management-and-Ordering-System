<?php 
$currentSubPage="stock";
include "ProductManagement.php"; ?>
<link rel="stylesheet" href="..\assets\css\admin-color-size-style.css">
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $results = $productObj->getProductDataForStock();
                            if($results){
                                foreach($results as $row){?>
                                    <tr>
                                    <th scope="row"><?=$row['Product_ID']?></th>
                                    <td><?=$row['Pro_Name']?></td>
                                    <td><?=$row['Pro_Desc']?></td>
                                    <td>
                                        <button class="btn btn-outline-success viewStockModal" data-productId = "<?=$row['Product_ID']?>"><i class="fas fa-folder-plus"></i> Add New Stock</button>
                                        <button class="btn btn-outline-danger updateStock" data-productId = "<?=$row['Product_ID']?>"><i class="fas fa-edit"></i> Update Stock</button>
                                        
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
<!-- Modal -->
<div class="modal fade" id="addStockModal" data-bs-backdrop="static" data-bs-keyboard="false">
        
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="updateModalStock" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content updateStockContent">
        </div>
    </div>
</div>

<script src="..\assets\js\viewManageStockModal.js"></script>
<script src="..\assets\js\ajaxGetSizeValue.js"></script>
<?php 
if(isset($_POST['addStock'])){
    $stockdata = [
        'pID' => mysqli_real_escape_string($db->conn,$_POST['productId']),
        'sID' => mysqli_real_escape_string($db->conn,$_POST['size']),
        'cID' => mysqli_real_escape_string($db->conn,$_POST['color']),
        'qty'=> mysqli_real_escape_string($db->conn,$_POST['qty'])
    ];
    $result = $productObj->addStockInfo($stockdata);
    if($result){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new Stock added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed : stock'});</script>";
    }
}

?>
<?php include "adminFooter.php"; ?>