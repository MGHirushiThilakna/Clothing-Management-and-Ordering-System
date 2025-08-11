<?php 
$currentMainPage = "Home";
include "customerHeader.php"; 
include "..\classes\DBConnect.php";
include "..\classes\offerController.php";
$db = new DatabaseConnection;
$offerObj = new offerController;
?>
<link rel="stylesheet" href="../assets/css/customer-home-style.css">
<div class="container-fluid">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators c-indi">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active c-indi" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class=" c-indi" aria-label="Slide 2"></button>
      <?php 
      $slide= 2;
      $count = $offerObj->getPublicCount();
      for($i = 0; $i < $count; $i++){
        ?>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$slide?>" class=" c-indi" aria-label="Slide <?=$slide+1?>"></button>
      <?php 
        $slide++;
    }
      ?>
      
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active c-item" >
        <img src="../assets/imgs/hah-collections-slider1.png" class="d-block w-100  c-img" alt="...">
      </div>
      <div class="carousel-item c-item" >
        <img src="../assets/imgs/hah-collections-slider2.png" class="d-block w-100  c-img" alt="...">
      </div>
        <?php 
         $results = $offerObj->displayPublicOffers();
         if($results){
             foreach($results as $row){?>
             <div class="carousel-item c-item">
                <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($row['IMG'])?>" class="d-block w-100  c-img" alt="...">
                <div class="carousel-caption top-0 mt-4  ">
                  <p class="mt-5 fs-3 text-uppercase"><?=$row['Offer_Title']?></p>
                  <h1 class="display-1 fw-bolder text-Capitalize">Upto <?php 
                  if($row['Discount_Type'] === 'percentage')
                    echo intval($row['Discount'])."%";
                  else{
                    echo "Rs ".$row['Discount'];
                  }
                  ?> off</h1>
                  <p class="mt-5 fs-5">*valid till <?=date("jS F Y",strtotime($row['Valid_To_Date']))?></p>
                  <p class="fs-5">*<?=$row['Description']?></p>
                  <p class="">*Terms and conditions Apply</p>
                </div>
              </div>
          <?php }
         }
        ?>
      
    </div>
  </div>
</div>
<?php include "customerFooter.php"; ?>