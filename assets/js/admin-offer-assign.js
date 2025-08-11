$(document).ready(function(){
    loadCustomerData();

    $('#showCustomerData').on('click',"#assign",function(){
        var customerID = $(this).attr('data-CustomerID');
        ShowModal(customerID);
    })

    $('#assignOfferModal').on('click', '#assignOffer', function() {
        var customerId = $(this).attr('data-CustomerID');
        var promoID = $(this).attr('data-promoID');
        AssignOfferToCustomer(customerId,promoID);
    });

    $('#assignOfferModal').on('click', '#delete', function() {
        var customerId = $(this).attr('data-CustomerID');
        var promoID = $(this).attr('data-promoID');
        DeleteAssignedOfferToCustomer(customerId,promoID);
    });

    $('#assignOfferModal').on('submit', '#PromoSearch', function(event) {
        event.preventDefault();
        var promoID = $.trim($('input[name="PromosearchData"]').val());
        var customerID = $('input[name="customerID"]').val()
        loadPrivateOfferInfoForSearch(promoID,customerID);
        
    });

    $('#CustSearch').submit(function(event){
        event.preventDefault();
        var field = $('select[name="customer_col"]').val();
        var searchData = $.trim($('input[name="searchData"]').val());

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
            url : "assignOfferAjax.php",
            data : {task:'CustomerSearch',field:field,data:searchData},
            success: function(response){
                Swal.close();
                $('#showCustomerData').html(response);
            }
        });


    });

});

function loadCustomerData(){
    $.ajax({
        url:"assignOfferAjax.php",
        data:{task:"displayAllCustomerData"},
        success:function(response){
            $('#showCustomerData').html(response);
        }
    });
}

function loadPrivateOfferInfo(customerID){
    $.ajax({
        url : "assignOfferAjax.php",
        data : {task:'showPrivateOffers',customerID:customerID},
        success: function(response){
            $('#showOfferData').html(response);
        }
    });
}

function loadPrivateOfferInfoForSearch(PromoID,customerID){
    $.ajax({
        url : "assignOfferAjax.php",
        data : {task:'PromoSearch',PromoID:PromoID,customerID:customerID},
        success: function(response){
            $('#showOfferData').html(response);
        }
    });
}
function loadCustomerPrivateOfferInfo(customerID){
    $.ajax({
        url : "assignOfferAjax.php",
        data : {task:'showCustomerPrivateOffers',customerID:customerID},
        success: function(response){
            $('#showAssignedOfferData').html(response);
        }
    });
}

function ShowModal(customerID){
    $.ajax({
        url : "assignOfferAjax.php",
        data : {task:'showModal',customerID:customerID},
        success: function(response){
            $('.assign-content').html(response);
            $('#assignOfferModal').modal('show');
            loadPrivateOfferInfo(customerID);
            loadCustomerPrivateOfferInfo(customerID);
        }
    });
}
function AssignOfferToCustomer(customerId,promoID){
    $.ajax({
        url : "assignOfferAjax.php",
        data : {task:'assignOfferCustomer',customerId:customerId,promoID:promoID},
        success: function(response){
            if(parseInt(response) === 1){
                Swal.fire({icon:'success',title:'Done !',text:'This Offer Assigned Successfully to the customer'});
            }else if(parseInt(response) === 3){
                Swal.fire({icon:'warning',title:'Done !',text:'This Offer is already Assigned to the customer'});
            }
            else{
                console.log(response);
                Swal.fire({icon:'warning',title:'Something is not right',text:''});
            }
            loadCustomerPrivateOfferInfo(customerId);
                
        }
    });
}

function DeleteAssignedOfferToCustomer(customerId,promoID){
    $.ajax({
        url : "assignOfferAjax.php",
        data : {task:'deleteAssignedTask',customerId:customerId,promoID:promoID},
        success: function(response){
            if(parseInt(response) === 1){
                Swal.fire({icon:'success',title:'Done !',text:'This Unassigned Successfully'});
            }else{
                Swal.fire({icon:'warning',title:'Something is not right',text:''});
            }
            loadCustomerPrivateOfferInfo(customerId);
        }
    })
}
