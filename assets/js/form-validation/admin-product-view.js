$(document).ready(function(){
    getProductinfo();
    //view product button
    $('#pro_Data').on('click',"#p_view",function(){
        var productId = $(this).attr("data-productID");
        viewProducts(productId);
    });
    // update button
    $('#pro_Data').on('click',"#p_update",function(){
        var productId = $(this).attr("data-productID");
        viewUpdateForm(productId);
    });

    // form
    $('#updateImage').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        console.log("img update clicked");
    });


});

function getProductinfo(){
    
    $.ajax({
        url: "adminProductAjax.php",
        data:{task:'displayAllProducts'},
        success: function(response){
            Swal.close();
            $('#pro_Data').html(response);
        }
    });
}

function viewProducts(pid){
    Swal.fire({
        title: 'Loading...',
        html: '<div class="loading-spinner"></div>',
        showConfirmButton: false,
        allowOutsideClick: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajax({
        url : "adminProductAjax.php",
        data : {task:"view",pid:pid},
        success : function(response){
            Swal.close();
            $('.view-content').html(response);
            $('#view-admin-product').modal('show');
        }
    })
}

function viewUpdateForm(id){
    Swal.fire({
        title: 'Loading...',
        html: '<div class="loading-spinner"></div>',
        showConfirmButton: false,
        allowOutsideClick: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajax({
        url : "adminProductAjax.php",
        data : {task:"updateForm",pid:id},
        success : function(response){
            Swal.close();
            $('.update-content').html(response);
            $('#update-admin-product').modal('show');
        }
    })
}

