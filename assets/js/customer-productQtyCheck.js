var form = document.getElementById('viewProduct');


form.addEventListener('change', function() {
  const size = document.querySelector('input[name="size"]:checked');
  const color = document.querySelector('input[name="color"]:checked');
  const product = document.querySelector('input[name="productId"]');

  if (size && color) {
    const sizeId = size.value;
    const colorId = color.value;
    const productId = product.value;
    //displayElement.textContent = `Selected size: ${sizeValue}, Selected color: ${colorValue}`;
    console.log(productId);
    $.ajax({
      url: "loadProducts.php",
      data:{pId:productId,sId:sizeId,cId:colorId},
      success: function(result){
        //$("#stockStatus").html(result);
        if (parseInt(result) === 0) {
          $('#addtoCart').show();
          $('#stockOut').hide();
          $("#stockStatus").html("<p class='stock-in'>Its available</p>");
        } else if (parseInt(result)  === 1) {
          $('#addtoCart').hide();
          $('#stockOut').show();
          $("#stockStatus").html("<p class='stock-out'>Sorry, Out of stock ! </p>");
        } else if (parseInt(result)  === 2) {
          $('#addtoCart').hide();
          $('#stockOut').show();
          $("#stockStatus").html("<p class='stock-out'>Sorry, Not in stock yet !</p>");
        } else {
          console.log('Unexpected server response.');
        }
      }
    });
  }
});
