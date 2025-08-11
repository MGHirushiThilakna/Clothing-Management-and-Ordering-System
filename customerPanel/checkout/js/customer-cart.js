function loadCart(){
    var customer_id = $('#addtocart').attr('data-custId'); 
    console.log(customer_id);
    $.ajax({
        url: "loadCartInfo.php",
        data:{cid:customer_id},
        success: function(response){
            $('.offcanvas-body').html(response);
            $('#offcanvasRight').offcanvas('show');
            getTotal();

        },
        error: function(xhr, status, error) {
            console.log('An error occurred: ' + error);
          }
      });
}

function getCount(){
    var customer_id = $('#addtocart').attr('data-custId');
    $.ajax({
        url: "loadCartInfo.php",
        data:{customerID:customer_id},
        success: function(response){
            if(parseInt(response) === 0){
                $('#cartBadge').html("");
            }else{
                $('#cartBadge').html(response);
            }
        }
    })
}

function removeFromCart(element){
        var product_id = $(element).attr('data-pid');
        var size_id = $(element).attr('data-sid');
        var color_id = $(element).attr('data-cid');
        var customer_id = $(element).attr('data-custid');
        console.log("Data to be deleted : "+product_id+" : "+size_id+" : "+ color_id+" : "+customer_id);
        $.ajax({
            url: "loadCartInfo.php",
            data:{pid:product_id,sid:size_id,colid:color_id,custid:customer_id},
            success: function(response){
                loadCart();
                getCount();
                getTotal();
            }
        });
  
}

function addtoCart(element){
     var product_id = $(element).attr('data-pid');
     var size_id = $("input[name='size']:checked").val();
     var color_id = $("input[name='color']:checked").val();
     var customer_id = $(element).attr('data-custid');
     var inputValue = jQuery("#qty").val();
     var qty = parseInt(inputValue);
     console.log(product_id,size_id,color_id,qty);
     $.ajax({
        url: "loadCartInfo.php",
        data:{pid:product_id,sid:size_id,colid:color_id,custid:customer_id,quantity:qty},
        success: function(response){
            console.log(response);
            if(parseInt(response) === 11){
                Swal.fire({icon:'info',title:'Done !',text:'Added to Cart'});
                loadCart();
                getCount();
                getTotal();
                
            }else{
                Swal.fire({icon:'warning',title:'Something is not right',text:''});
            }
            
        }
    });
     
 }

 function getTotal(){
    var customer_id = $('#addtocart').attr('data-custId');
    $.ajax({
        url: "loadCartInfo.php",
        data:{custTotalcart:customer_id},
        success: function(response){
            if(parseInt(response) === 0){
                $('#cartTotal').html("<span class='h5'>Your Total is : Rs 0.00</span>");
            }else{
                $('#cartTotal').html(response);
            }
        }
    })
 }
 $('#signout').on('click',function(e){
    e.preventDefault();
    const href="../logoutprocess.php";
    Swal.fire({
        title: 'Do you wish to sign out?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            document.location.href=href;
        }
      });
 });
$( document ).ready(function() {
    getCount();
    $('#signout').on('click',function(e){
        e.preventDefault();
        const href="../logoutprocess.php";
        Swal.fire({
            title: 'Do you wish to sign out?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#686de0',
            cancelButtonColor: '#f46e50',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href=href;
            }
        });
    });
});


