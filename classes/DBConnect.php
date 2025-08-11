<?php 
define('DB_Host','localhost');
define('DB_User','root');
define('DB_Password','');
define('DB_Database','cmos_db');
define('DB_Port','3307');

class DatabaseConnection{
    
    public function __construct(){
        $connection = new mysqli(DB_Host,DB_User,DB_Password,DB_Database,DB_Port);

        if($connection->connect_error){
            die("Connection Failed : ". $connection->connect_error);
        }
        return $this->conn = $connection;
    }

}

?>