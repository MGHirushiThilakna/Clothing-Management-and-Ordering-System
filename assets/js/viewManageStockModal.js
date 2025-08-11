$(document).ready(function(){
    $('.viewStockModal').click(function(){
        var productId = $(this).attr('data-productId');        
        $.ajax({
            url: "viewAddStockModal.php",
            type : "POST",
            data: {pId:productId},
            success: function(response){
                $(".modal-content").html(response);
                $("#addStockModal").modal('show');
            }
        });
    });

    $('.updateStock').click(function(){
        var productId = $(this).attr('data-productId');
        getUpdateStckForm(productId);
    });

    

});

function getUpdateStckForm(productId){
    $.ajax({
        url: "viewAddStockModal.php",
        type : "POST",
        data: {task:"showUpdateForm",productID:productId},
        success: function(response){
            $(".updateStockContent").html(response);
            $("#updateModalStock").modal('show');
        }
    });
}

