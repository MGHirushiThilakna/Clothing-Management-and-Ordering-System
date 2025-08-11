<?php
require_once "GenerateID.php";
class CategoryController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->generateId = new GenerateID;
        $this->conn = $db ->conn;
    }
    /*Main category*/
    public function addNewMainCategory($mainName){
        $idType = "mainCat";
        $mainId = $this->generateId->getNewID($idType);
        $sql_add_mainCat = "INSERT INTO main_category VALUES('$mainId','$mainName');";
        if($this->conn->query($sql_add_mainCat)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function getMainCategoryData(){
        $sql_get_main_data = "SELECT * FROM main_category;";
        $results = $this->conn->query($sql_get_main_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    /*Sub category*/
    public function addNewSubCategory($subName){
        $idType = "subCat";
        $subId = $this->generateId->getNewID($idType);
        $sql_add_subCat = "INSERT INTO sub_category VALUES('$subId','$subName');";
        if($this->conn->query($sql_add_subCat)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function getSubCategoryData(){
        $sql_get_sub_data = "SELECT * FROM sub_category;";
        $results = $this->conn->query($sql_get_sub_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    /*brand category*/
    public function addNewBrand($brandName){
        $idType = "brand";
        $brandId = $this->generateId->getNewID($idType);
        $sql_add_brand = "INSERT INTO brand VALUES('$brandId','$brandName');";
        if($this->conn->query($sql_add_brand)){
            $this->generateId->updatetID($idType);
            return true;
        }else{
            return false;
        }
    }
    public function getBrandData(){
        $sql_get_brand_data = "SELECT * FROM brand;";
        $results = $this->conn->query($sql_get_brand_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    public function getCategorizationData($mainCategory){
        $sql_get_data = "SELECT s.Sub_ID,s.Name FROM categorization c, sub_category s WHERE c.Main_ID = '$mainCategory' AND s.Sub_ID = c.Sub_ID GROUP BY(s.Name)";
        $results = $this->conn->query($sql_get_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
}
?>