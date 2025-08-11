<?php 
class CartController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db ->conn;
    }

    public function addtoCart($productData){
        $productID = $productData['pid'];
        $sizeID = $productData['sid'];
        $ColorID = $productData['co_id'];
        $CustomerID = $productData['cu_id'];
        $Qty = $productData['Qty'];
        $sql_add_to_cart = "INSERT INTO cart VALUES('$productID','$sizeID','$ColorID','$Qty','$CustomerID');";
        if($this->conn->query($sql_add_to_cart)){
            return true;
        }else{
            return false;
        }
    }
    public function getcartInfoDirect($customerID){
        $sql_get_cart_data = "SELECT * From cart WHERE Customer_ID = '$customerID'";
        $results = $this->conn->query($sql_get_cart_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }

    public function get_productFromCart($customerID){
        $sql_get_cart_data = "SELECT p.Product_ID,s.Size_ID,c.Color_ID,p.Pro_Name,p.Pro_IMG_1,p.Pro_SalePrice,(Select b.Name From brand b, categorization cat WHERE b.Brand_ID = cat.Brand_ID AND cat.Product_ID = ct.Product_ID LIMIT 1) AS Brand,s.Size_Value,c.Color_Value,ct.Qty FROM product p, size s, color c, cart ct WHERE p.Product_ID = ct.Product_ID AND s.Size_ID = ct.Size_ID AND c.Color_ID = ct.Color_ID AND ct.Customer_ID = '$customerID'";
        $results = $this->conn->query($sql_get_cart_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }
    public function get_productFromCartFinal($customerID){
        $sql_get_cart_data = "SELECT p.Pro_Name,p.Pro_SalePrice,s.Size_Value,c.Color_Name,ct.Qty FROM product p, size s, color c, cart ct WHERE p.Product_ID = ct.Product_ID AND s.Size_ID = ct.Size_ID AND c.Color_ID = ct.Color_ID AND ct.Customer_ID = '$customerID'";
        $results = $this->conn->query($sql_get_cart_data);
        if($results->num_rows > 0){
            return $results;
        }else{
            return false;
        }
    }

    public function get_productCount($customerID){
        $sql_get_cart_data = "SELECT * FROM cart WHERE Customer_ID = '$customerID' ";
        $results = $this->conn->query($sql_get_cart_data);
        if($results){
            return $results->num_rows;
        }else{
            return false;
        }
    }

    public function remove_productFromCart($productID,$sizeID,$colorID,$customerID){
        $sql_del_cart_product = "DELETE FROM cart WHERE Product_ID='$productID' AND Size_ID='$sizeID' AND Color_ID='$colorID' AND Customer_ID='$customerID' ";
        $results = $this->conn->query($sql_del_cart_product);
        if($results){
            return true;
        }else{
            return false;
        }
    }

    public function getCartTotal($CustomerID){
        $sql_cart_total = "SELECT p.Pro_SalePrice,ct.Qty FROM cart ct,product p WHERE p.Product_ID = ct.Product_ID AND ct.Customer_ID ='$CustomerID'";
        $results = $this->conn->query($sql_cart_total);
        if($results){
            return $results;
        }else{
            return false;
        }
    }
}

?>