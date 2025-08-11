<?php 
$currentSubPage="public";
include "OfferManagement.php"; 
?>
<link rel="stylesheet" href="..\assets\css\admin-offer-style.css">
<div class="container my-container mt-2">
    <div class="card form-card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 off-my-col">
                        <form class="d-flex search-box">
                            <input class="form-control search-input " type="search" placeholder="Search" aria-label="Search">
                            <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                </div>
                <div class="col-lg-3"><button class="btn my-Btn add-offer-public">Add New Offer Item</button></div>
                <div class="col-lg-3"><span>No of public Offers: 0</span></div>
            </div>
        </div>
    </div>
    
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Promo ID</th>
                            <th scope="col">Offer Name</th>
                            <th scope="col">Offer Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Discount Type</th>
                            <th scope="col">Discount</th>
                            <th scope="col">For Bill Value</th>
                            <th scope="col">Valid From</th>
                            <th scope="col">Valid Till</th>
                            <th scope="col">Img</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $results = $offerObj->displayPublicOffers();
                            if($results){
                                foreach($results as $row){?>
                                    <tr>
                                        <th scope="col"><?=$row['Promo_ID']?></th>
                                        <td><?=$row['Offer_Name']?></td>
                                        <td><?=$row['Offer_Title']?></td>
                                        <td><?=$row['Description']?></td>
                                        <td><?=$row['Discount_Type']?></td>
                                        <td><?=$row['Discount']?></td>
                                        <td><?=$row['TotalBillValue']?></td>
                                        <td><?=$row['Valid_From_Date']?></td>
                                        <td><?=$row['Valid_To_Date']?></td>
                                        <td><img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['IMG'])?>" class="img-fluid td-img"></td>
                                        <td>
                                            <a class="btn btn-outline-danger" data-offerId="<?=$row['Promo_ID']?>" id="del-offer" onclick = "deletePublic(this)"><i class="fas fa-trash-alt"></i></a>
                                            <a class="btn btn-outline-success" data-offerId="<?=$row['Promo_ID']?>" id="update-offer" onclick = "showupdatePublicOffer(this)"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                            <?php
                            }
                            }else{
                                echo "<tr><td colspan='7'>No Records found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-Offer-modal" data-bs-backdrop="static" data-bs-keyboard="false">     
    <div class="modal-dialog modal-xl">
        <link rel="stylesheet" href="..\assets\css\admin-modal-style.css">
        <div class="modal-content">
           
        </div>
    </div>
</div>
<script src="..\assets\js\admin-offer-modal.js"></script>

<?php 
if(isset($_POST['offer-public-add'])){
    $data = [
        "title" => mysqli_real_escape_string($db->conn,$_POST['off_title']),
        "name" => mysqli_real_escape_string($db->conn,$_POST['off_name']),
        "desc" => mysqli_real_escape_string($db->conn,$_POST['off_Desc']),
        "type" => mysqli_real_escape_string($db->conn,$_POST['off_type']),
        "value" => mysqli_real_escape_string($db->conn,$_POST['off_value']),
        "bill" => mysqli_real_escape_string($db->conn,$_POST['off_billValue']),
        "FDate" => mysqli_real_escape_string($db->conn,$_POST['off_from_Date']),
        "TDate" => mysqli_real_escape_string($db->conn,$_POST['off_to_Date'])
    ];
    $result = $offerObj->addPublicOffers($data,$_FILES['imageFile']['tmp_name'][0]);
    if($result){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:'A new offer added successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed : addOffer'});</script>";
    }
}

if(isset($_POST['offer-public-update'])){
    $data = [
        "ID" => mysqli_real_escape_string($db->conn,$_POST['promoID']),
        "title" => mysqli_real_escape_string($db->conn,$_POST['off_title']),
        "name" => mysqli_real_escape_string($db->conn,$_POST['off_name']),
        "desc" => mysqli_real_escape_string($db->conn,$_POST['off_Desc']),
        "type" => mysqli_real_escape_string($db->conn,$_POST['off_type']),
        "value" => mysqli_real_escape_string($db->conn,$_POST['off_value']),
        "bill" => mysqli_real_escape_string($db->conn,$_POST['off_billValue']),
        "FDate" => mysqli_real_escape_string($db->conn,$_POST['off_from_Date']),
        "TDate" => mysqli_real_escape_string($db->conn,$_POST['off_to_Date'])
    ];
    $result = $offerObj->UpdatePublicOffer($data);
    if($result){
        echo"<script>Swal.fire({icon:'success',title:'Done !',text:' offer Updated successfully'});</script>";
    }else{
        echo"<script>Swal.fire({icon:'error',title:'Something is not right',text:'Query Failed : addOffer'});</script>";
    }
}
?>

<?php include "adminFooter.php"; ?>