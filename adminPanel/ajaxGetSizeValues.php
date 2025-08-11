<?php
include "..\classes\DBConnect.php";
include "..\classes\ProductController.php";
$size2Obj = new ProductController;

// Get the selected value from the Ajax request
$selectedValue = $_GET['selectedValue'];

// Query the database for the data
$result = $size2Obj->getSizeValue($selectedValue);

// Loop through the results and build an array of options
$options = array();
if($result){
    while ($row = $result -> fetch_assoc()) {
        $options[] = array(
            'id' => $row['Size_ID'],
            'name' => $row['Size_Value']
        );
    }
}else{
    $options[] = array(
        'id' => "0",
        'name' => "None"
    );
}


// Return the options as JSON data
header('Content-Type: application/json');
echo json_encode($options);
?>