<?php 
require_once "GenerateID.php";

class offerController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db ->conn;
        $this->generateId = new GenerateID;
    }

    private function imgDbFormat($file){
        /*$imageTempName = $file['tmp_Name'];*/
        $imageContent = addslashes(file_get_contents($file));
        return $imageContent;
    }

    public function addPublicOffers($offerData,$img){
        $idType = "offers";
        $promoID = $this->generateId->getNewID($idType);
        $offerTitle = $offerData['title'];
        $offerName = $offerData['name'];
        $desc = $offerData['desc'];
        $type = $offerData['type'];
        $disValue = $offerData['value'];
        $bill = $offerData['bill'];
        $ValidFrom = date("Y-m-d", strtotime($offerData['FDate']));
        $ValidTo = date("Y-m-d", strtotime($offerData['TDate']));
        $OfferImg1 = $this->imgDbFormat($img);
        $sql_addOfferData = "INSERT INTO public_offers VALUES('$promoID','$offerName','$offerTitle','$desc','$type','$disValue','$bill','$ValidFrom','$ValidTo','$OfferImg1')";
        if($this->conn->query($sql_addOfferData)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }

    public function addPrivateOffers($offerData){
        $idType = "offers";
        $promoID = $this->generateId->getNewID($idType);
        $offerTitle = $offerData['title'];
        $offerName = $offerData['name'];
        $desc = $offerData['desc'];
        $type = $offerData['type'];
        $disValue = $offerData['value'];
        $bill = $offerData['bill'];
        $ValidFrom = date("Y-m-d", strtotime($offerData['FDate']));
        $ValidTo = date("Y-m-d", strtotime($offerData['TDate']));
        $sql_addOfferData = "INSERT INTO private_offers VALUES('$promoID','$offerName','$offerTitle','$desc','$type','$disValue','$bill','$ValidFrom','$ValidTo')";
        if($this->conn->query($sql_addOfferData)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }

    public function displayPublicOffers(){
        $sql_get_data = "SELECT * FROM public_offers";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    public function getPublicOffer($id){
        $sql_get_data = "SELECT * FROM public_offers WHERE Promo_ID='$id'";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    public function getPrivateOffer($id){
        $sql_get_data = "SELECT * FROM private_offers WHERE Promo_ID='$id'";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }

    public function displayPrivateOffers(){
        $sql_get_data = "SELECT * FROM private_offers";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }

    public function deletePublicOffer($PromoID){
        $sql_deleteOffer = "DELETE FROM public_offers WHERE Promo_ID = '$PromoID'";
        if($this->conn->query($sql_deleteOffer)){
            return true;
        }else{
            return false;
        }
    }

    public function deletePrivateOffer($PromoID){
        $sql_deleteOffer = "DELETE FROM private_offers WHERE Promo_ID = '$PromoID'";
        if($this->conn->query($sql_deleteOffer)){
            return true;
        }else{
            return false;
        }
    }
    public function UpdatePublicOffer($offerData){
        $promoID = $offerData['ID'];
        $offerTitle = $offerData['title'];
        $offerName = $offerData['name'];
        $desc = $offerData['desc'];
        $type = $offerData['type'];
        $disValue = $offerData['value'];
        $bill = $offerData['bill'];
        $ValidFrom = date("Y-m-d", strtotime($offerData['FDate']));
        $ValidTo = date("Y-m-d", strtotime($offerData['TDate']));
        $sql_updateOfferData = "UPDATE public_offers SET Offer_Name = '$offerName',Offer_Title = '$offerTitle', `Description` = '$desc',Discount_Type = '$type',Discount = '$disValue',TotalBillValue = '$bill',Valid_From_Date = '$ValidFrom',Valid_To_Date = '$ValidTo' WHERE Promo_ID = '$promoID';";
        if($this->conn->query($sql_updateOfferData)){
            return true;
        }else{
            return false;
        }
    }
    public function UpdatePrivateOffer($offerData){
        $promoID = $offerData['ID'];
        $offerTitle = $offerData['title'];
        $offerName = $offerData['name'];
        $desc = $offerData['desc'];
        $type = $offerData['type'];
        $disValue = $offerData['value'];
        $bill = $offerData['bill'];
        $ValidFrom = date("Y-m-d", strtotime($offerData['FDate']));
        $ValidTo = date("Y-m-d", strtotime($offerData['TDate']));
        $sql_updateOfferData = "UPDATE private_offers SET Offer_Name = '$offerName',Offer_Title = '$offerTitle', `Description` = '$desc',Discount_Type = '$type',Discount = '$disValue',TotalBillValue = '$bill',Valid_From_Date = '$ValidFrom',Valid_To_Date = '$ValidTo' WHERE Promo_ID = '$promoID';";
        if($this->conn->query($sql_updateOfferData)){
            return true;
        }else{
            return false;
        }
    }

    public function getPublicCount(){
        $sql_get_data = "SELECT * FROM public_offers";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results->num_rows;
        }else{
            return 0;
        }
    }

    public function loadPrivateOffer($customerID){
        $currentDate = date('Y-m-d');
        $sql_get_data = "SELECT p.Promo_ID, p.Offer_Name FROM private_offers p, customer_offer co WHERE co.Promo_ID=p.Promo_ID AND co.Customer_ID='$customerID' AND co.Claim_Status = 'NO' AND '$currentDate' BETWEEN Valid_From_Date AND Valid_To_Date";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    public function loadPublicOffer(){
        $currentDate = date('Y-m-d');
        $sql_get_data = "SELECT Promo_ID,Offer_Name FROM public_offers WHERE '$currentDate' BETWEEN Valid_From_Date AND Valid_To_Date";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    public function getofferDetails($ID){
        $sql_tbl_private = "SELECT Discount_Type,Discount,TotalBillValue FROM private_offers WHERE Promo_ID = '$ID';";
        $sql_tbl_public = "SELECT Discount_Type,Discount,TotalBillValue FROM public_offers WHERE Promo_ID = '$ID';";
        $result_private = $this->conn->query($sql_tbl_private);
        if($result_private->num_rows == 0){
            $result_public = $this->conn->query($sql_tbl_public);
            if($result_public->num_rows > 0){
                return $result_public;
            }else{
                return false;
            }
        }else{
            return $result_private;
        }
    }

    public function getPrivateCustomeroffer($customerID){
        $sql = "SELECT p.* FROM private_offers p, customer_offer co WHERE co.Promo_ID = p.Promo_ID AND co.Customer_ID='$customerID'";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    private function checkAssignedOffer($cid,$proID){
        $sql = "SELECT * FROM customer_offer WHERE Promo_ID = '$proID' AND Customer_ID='$cid'";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function AddOfferToCustomer($cid,$proID){
        $sql = "INSERT INTO customer_offer VALUES('$proID','$cid','NO')";
        if($this->checkAssignedOffer($cid,$proID)){
            return false;
        }else{
            $results = $this->conn->query($sql);
            if($results){
                return true;
            }else{
                return false;
            }
        }

    }
    public function DeleteAssignedOffer($cid,$proID){
        $sql = "DELETE FROM customer_offer WHERE Promo_ID = '$proID' AND Customer_ID='$cid'";
            $results = $this->conn->query($sql);
            if($results){
                return true;
            }else{
                return false;
            }
    }

    


    public function SearchPrivateOfferByID($proId){
        $sql = "SELECT * FROM private_offers WHERE Promo_ID = '$proId'";
        $results = $this->conn->query($sql);
            if($results->num_rows > 0){
                return $results;
            }else{
                return false;
            }
    }

    private function findPrivateOffer($promoID,$customerID){
        $sql = "SELECT * FROM customer_offer WHERE Promo_ID = '$promoID' AND Customer_ID='$customerID'";
        $results = $this->conn->query($sql);
        if($results->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function UpdateclaimedStatus($promoID,$customerID){
        $sql = "UPDATE customer_offer SET Claim_Status = 'YES' WHERE Promo_ID = '$promoID' AND Customer_ID='$customerID'";
        if($this->findPrivateOffer($promoID,$customerID)){
            $result = $this->conn->query($sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false; 
        }

    }


    

}

?>