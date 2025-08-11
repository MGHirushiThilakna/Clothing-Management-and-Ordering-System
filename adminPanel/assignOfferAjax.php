<?php
include "..\classes\DBConnect.php"; 
include "..\classes\CustomerController.php";
include "..\classes\offerController.php";
$db = new DatabaseConnection;
$customerObj = new CustomerController;
$offerObj = new offerController;

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'displayAllCustomerData'){
    $result = $customerObj->getCustomerInfo();
    if($result){
        foreach($result as $row){
            ?>
            <tr>
                <th><?=$row['Customer_ID']?></th>
                <td><?=$row['FName']?></td>
                <td><?=$row['LName']?></td>
                <td><?=$row['Email']?></td>
                <td><?=$row['Address']?></td>
                <td><?=$row['Contact_NO']?></td>
                <td><button class="btn viewbtn" data-CustomerID="<?=$row['Customer_ID']?>" id="assign"><i class="far fa-eye"></i> Assign</button></td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='7'><label>No Records Found</label></td></tr>";
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showPrivateOffers'){
    $result = $offerObj->displayPrivateOffers();
    if($result){
        foreach($result as $row){
            ?>
            <tr>
                <th><?=$row['Promo_ID']?></th>
                <td><?=$row['Offer_Name']?></td>
                <td><?=$row['Offer_Title']?></td>
                <td><?=$row['Valid_To_Date']?></td>
                <td><button class="btn viewbtn" data-CustomerID="<?=$_REQUEST['customerID']?>" data-promoID="<?=$row['Promo_ID']?>" id="assignOffer"><i class="far fa-eye"></i> Assign</button></td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='5'><label>No Records Found</label></td></tr>";
    }
}
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showCustomerPrivateOffers'){
    $result = $offerObj->getPrivateCustomeroffer($_REQUEST['customerID']);
    if($result){
        foreach($result as $row){
            ?>
            <tr>
                <th><?=$row['Promo_ID']?></th>
                <td><?=$row['Offer_Name']?></td>
                <td><?=$row['Offer_Title']?></td>
                <td><?=$row['Valid_To_Date']?></td>
                <td><button class="btn btn-outline-danger" data-CustomerID="<?=$_REQUEST['customerID']?>" data-promoID="<?=$row['Promo_ID']?>" id="delete"><i class="far fa-eye"></i> delete</button></td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='5'><label>No Records Found</label></td></tr>";
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'showModal'){
    ?>
            <!--Modal Header -->
            <div class="modal-header my-modal-header mycardheader">
                <div class="modal-title My-modal-title">Customer ID : <?=$_REQUEST['customerID']?></div>
                <button type="button" class="btn-close my-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 off-my-col">
                            <form class="d-flex search-box" id="PromoSearch">

                                <input class="form-control search-input " name="PromosearchData" type="search" placeholder="Promo ID" aria-label="Search">
                                <input type="hidden" name="customerID" value='<?=$_REQUEST['customerID']?>'>
                                <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-md sub-tbl caption-top">
                                <caption>All available private offers</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Promo ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Expire Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id = 'showOfferData'>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-md sub-tbl caption-top">
                                <caption>All Assigned Private Offers for Customer ID : <?=$_REQUEST['customerID']?></caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Promo ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Expire Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id = 'showAssignedOfferData'>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    <?php
}


if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'assignOfferCustomer'){
    $result = $offerObj->AddOfferToCustomer($_REQUEST['customerId'],$_REQUEST['promoID']);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'deleteAssignedTask'){
    $result = $offerObj->DeleteAssignedOffer($_REQUEST['customerId'],$_REQUEST['promoID']);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
?>

<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'CustomerSearch'){
    $results = $customerObj->searchCustomer($_REQUEST['field'],$_REQUEST['data']);
    if($results){
        foreach($results as $row){
            ?>
            <tr>
                <th><?=$row['Customer_ID']?></th>
                <td><?=$row['FName']?></td>
                <td><?=$row['LName']?></td>
                <td><?=$row['Email']?></td>
                <td><?=$row['Address']?></td>
                <td><?=$row['Contact_NO']?></td>
                <td><button class="btn viewbtn" data-CustomerID="<?=$row['Customer_ID']?>" id="assign"><i class="far fa-eye"></i> Assign</button></td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='7'><label>No Records Found</label></td></tr>";
    }
}

?>
<?php 
if(isset($_REQUEST['task']) && $_REQUEST['task'] === 'PromoSearch'){
    $result = $offerObj->SearchPrivateOfferByID($_REQUEST['PromoID']);
    if($result){
        foreach($result as $row){
            ?>
            <tr>
                <th><?=$row['Promo_ID']?></th>
                <td><?=$row['Offer_Name']?></td>
                <td><?=$row['Offer_Title']?></td>
                <td><?=$row['Valid_To_Date']?></td>
                <td><button class="btn viewbtn" data-CustomerID="<?=$_REQUEST['customerID']?>" data-promoID="<?=$row['Promo_ID']?>" id="assignOffer"><i class="far fa-eye"></i> Assign</button></td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='5'><label>No Records Found</label></td></tr>";
    }
}

?>