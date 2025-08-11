var subtotal= 0.0; // stores the value subtotal
var conditionAmount = 0.0; // stores the offer max bill value
var discountvalue = 0.0; // store the Discount value
var chargesForDelivery =0.0; // stores the delivery charges.
var FinalTotal;

var paymentMethod; //store paymentMethod
var address; // store address
var contact; // store contact
var customerID;
var emailAddress;
var user;

var offerID; // store private public offerID for update claim status

$( document ).ready(function() {
    loadCarttbl();
    getCounttbl();
    getTotaltbl();

    $('input[name="offerTable"]').click(function(){
        var table = $('input[name="offerTable"]:checked').val();
        console.log(table);
        loadOptions(table);
    });
    $('#discount').change(function(){
        offerID = $(this).val();
        console.log(offerID + "WHEN selecting");
        if(parseInt(offerID) === 0){
            $('#discountAmount').html("0.00");
            getTotaltbl();
        }else{
            $.ajax({
                url: "checkoutPage.php",
                dataType : 'json',
                data:{offerID:offerID,subtotal:subtotal},
                success:function(response){
                    conditionAmount = response.billValue;
                    discountvalue = response.discountAmount;
                    setAmounts();
                }

            });
        }
    });
/* Slide 2 : payment */
    $('input[name="paymentMethod"]').click(function(){
        $('#bill-subtotal').html(parseFloat("0.0").toFixed(2));
        $('#bill-discount').html(parseFloat("0.0").toFixed(2));
        $('#bill-delivery-Fees').html(parseFloat("0.0").toFixed(2));
        var type = $('input[name="paymentMethod"]:checked').val();
        paymentMethod = type;
        loadPaymentMethodForm(type);
        $('#bill-subtotal').html(parseFloat(subtotal).toFixed(2));
        $('#bill-discount').html(parseFloat(discountvalue).toFixed(2));
    });

    $('#my-payment-card').on('click','#location',function(){
        var chargeID = $(this).val();
        $.ajax({
            url: "checkoutPage.php",
            data:{chargeID:chargeID,task:"getValue"},
            success : function(response){
                console.log(response);
                if(parseFloat(response) != 0){
                    chargesForDelivery = parseFloat(response);
                    
                }else{
                    chargesForDelivery = 0.0;
                }
                $('#deliveryFee').html(chargesForDelivery.toFixed(2));
                $('#bill-delivery-Fees').html(chargesForDelivery.toFixed(2));
            }
        })
    });
    
    $('#my-payment-card').on('change', 'textarea', function() {
        address = $(this).val();
    });
    $('#my-payment-card').on('change', 'input', function() {
        contact = $(this).val();
    });
    $('#next').click(function(){
        loadValuesToBilling();
        emailAddress = $('input[name="SNDEmail"]').val();
    })
    loadCarttblFinal(); 
    
    $('#PlaceOrder').click(function(){
        var redirectPage = $(this).attr('href');
        Swal.fire({
            title: 'Please Wait...',
            html: '<div class="loading-spinner"></div>',
            text: 'placing your order',
            showConfirmButton: false,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });
        console.log(offerID + "WHEN placing ORDER");
        $.ajax({
            url:"placeOrder.php",
            data:{
                task:'placeOrder',
                customerID:customerID,
                paymentMode:paymentMethod,
                charges:chargesForDelivery,
                total:FinalTotal,
                address:address,
                contact:contact,
                subtotal:subtotal,
                discount:discountvalue,
                email:emailAddress,
                user:user,
                offerID:offerID
            },
            success:function(response){
                console.log("success: response");
                if(parseInt(response) === 1){
                    Swal.close();
                    getCount();
                    Swal.fire({
                        title: 'Done !',
                        text: 'Your Order was placed successfully',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#686de0',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href=redirectPage;
                        }
                    });
                    
                }else{
                    console.log(response);
                    Swal.fire({icon:'warning',title:'Something is not right',text:''});
                }
            },
            error: function(xhr, status, error) {
                console.log('An error occurred: ' + error);
              },


        });

    });

    SNDEmail_enable();
    $('#SNDEmail_edit').click(function(){
        SNDEmail_disable();
    });
    $('#SNDEmail_save').click(function(){
        SNDEmail_enable();
        emailAddress = $('input[name="SNDEmail"]').val();
    });

});
function loadCarttbl(){
    var customer_id = $('#getCustID').attr('data-customerID');
    user = $('#getuser').attr('data-user');
    customerID = customer_id;
    $.ajax({
        url: "checkoutPage.php",
        data:{cid:customer_id,task:"show"},
        success: function(response){
            $('.tbody').html(response);          
        },
        error: function(xhr, status, error) {
            console.log('An error occurred: ' + error);
          }
      });
}
function loadCarttblFinal(){
    var customer_id = $('#getCustID').attr('data-customerID'); 
    $.ajax({
        url: "checkoutPage.php",
        data:{cid:customer_id,task:"finalDisplay"},
        success: function(response){
            $('.tbodyFinal').html(response);          
        },
        error: function(xhr, status, error) {
            console.log('An error occurred: ' + error);
          }
      });
}
function removeFromCarttbl(element){
    var product_id = $(element).attr('data-pid');
    var size_id = $(element).attr('data-sid');
    var color_id = $(element).attr('data-cid');
    var customer_id = $(element).attr('data-custid');
    Swal.fire({
        title: 'Do you want to remove?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result)=>{
        if(result.isConfirmed){
            $.ajax({
                url: "loadCartInfo.php",
                data:{pid:product_id,sid:size_id,colid:color_id,custid:customer_id},
                success: function(response){
                    loadCarttbl();
                    getCounttbl();
                    getTotaltbl();
                    $("#discount").val(0);
                    $('#discountAmount').html(parseFloat("0.00"));
                }
            });
        }
    });
    

}

function getTotaltbl(){
    var customer_id = $('#getCustID').attr('data-customerID'); 
    $.ajax({
        url: "checkoutPage.php",
        data:{custTotalcart:customer_id},
        success: function(response){
            if(parseInt(response) === 0){
                $('#total').html("0.00");
                response = 0;
            }else{
                $('#total').html(parseFloat(response).toFixed(2));
                subtotal = parseFloat(response);
            }
        }
    })
 }
function getCounttbl(){
    var customer_id = $('#getCustID').attr('data-customerID'); 
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


function setAmounts(){
    if(subtotal >= parseFloat(conditionAmount)){
        $('#discountAmount').html(discountvalue);
        total = subtotal - parseFloat(discountvalue);
    }else{
        Swal.fire({icon:'warning',title:'Your Bill Amount',text:'should be greater than Rs '+conditionAmount+'/= to use this offer'});
        $('#discountAmount').html("0.00");
        total = subtotal - 0.0;
    }
    $('#total').html(total.toFixed(2));
    
}



function loadOptions(table){
    var customer_id = $('#getCustID').attr('data-customerID'); 
    $.ajax({
        url: 'customer_offer.php',
        method: 'post',
        data: { table: table,customer_id:customer_id },
        success: function(data) {
            $('#discount').html(data);
        }
    });
}

function loadPaymentMethodForm(type){
    $('#my-payment-card').html('');
    if(type === 'COD'){
        loadForm(type);
    }else if(type === 'BD'){
        loadForm(type);
    }else if(type === 'Pick'){
        loadForm(type);
    }

}

function loadForm(type){
    $.ajax({
        url : "checkout-payment-options.php",
        data:{form:type,task:"show"},
        success: function(response){
            $('#my-payment-card').html(response);
            address = $('#my-payment-card textarea').val();
            contact = $('#my-payment-card input').val();
        }

    });
    
}
function loadValuesToBilling(){
    if(paymentMethod === 'COD'){
        $('#paymentMethod').html("Cash On Delivery");
        $('#address').html(address);
        $('#contact').html(contact);
        var dSub = parseFloat(subtotal);
        var dDiscount = parseFloat(discountvalue);
        var dcharge = parseFloat(chargesForDelivery);
        var Ftotal = dSub + dcharge - dDiscount;
        FinalTotal = Ftotal;
        $('#finalSubTotal').html(dSub.toFixed(2));
        $('#FinalDiscount').html(dDiscount.toFixed(2));
        $('#FinalCharges').html(dcharge.toFixed(2));
        $('#FinalTotal').html(Ftotal.toFixed(2));
    }else if(paymentMethod === 'BD'){
        $('#paymentMethod').html("Bank Deposit");
      
        $('#address').html(address);
        $('#contact').html(contact);
        var dSub = parseFloat(subtotal);
        var dDiscount = parseFloat(discountvalue);
        var dcharge = parseFloat(chargesForDelivery);
        var Ftotal = dSub + dcharge - dDiscount;
        FinalTotal = Ftotal;
        $('#finalSubTotal').html(dSub.toFixed(2));
        $('#FinalDiscount').html(dDiscount.toFixed(2));
        $('#FinalCharges').html(dcharge.toFixed(2));
        $('#FinalTotal').html(Ftotal.toFixed(2));
    }else{
        $('#paymentMethod').html("Pick Up");
        
        $('#address').html("none");
        $('#contact').html(contact);
        var dSub = parseFloat(subtotal);
        var dDiscount = parseFloat(discountvalue);
        var dcharge = 0.0;
        var Ftotal = dSub + dcharge - dDiscount;
        $('#finalSubTotal').html(dSub.toFixed(2));
        $('#FinalDiscount').html(dDiscount.toFixed(2));
        $('#FinalCharges').html(dcharge.toFixed(2));
        $('#FinalTotal').html(Ftotal.toFixed(2));
        FinalTotal = Ftotal;
    }
    console.log(FinalTotal);

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
/*Email*/
function SNDEmail_enable(){
    $('input[name="SNDEmail"]').prop('disabled',true);
    $('#SNDEmail_edit').show();
    $('#SNDEmail_save').hide();
}
function SNDEmail_disable(){
    $('input[name="SNDEmail"]').prop('disabled',false);
    $('#SNDEmail_edit').hide();
    $('#SNDEmail_save').show();
}