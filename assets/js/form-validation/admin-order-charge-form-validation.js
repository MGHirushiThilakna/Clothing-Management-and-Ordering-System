$(document).ready(function(){
    ShowRecords();
    $('#chargesForm').submit(function(event){
        event.preventDefault();

        // Perform validation
        var paymentMethod = $('select[name="paymentMethod"]').val();
        var location = $.trim($('input[name="location"]').val());
        var charges = $.trim($('input[name="charge"]').val());

        $('.myinputText').removeClass('is-invalid');
        $('.myselect').removeClass('is-invalid');
        resetStrError();
        var isPayMethodValid = true;
        var islocationValid = true;
        var ischargesValid = true;

        if(parseInt(paymentMethod) === 0){
            $('.myselect').addClass('is-invalid');
            $('#strPayMethodError').html('Please select a payment method');
            isPayMethodValid = false;
        }

        if(location === ''){
            $('.myinputText').addClass('is-invalid');
            $('#strLocationError').html('This field is required');
            islocationValid = false;
        }

        if(charges === ''){
            $('.myinputText').addClass('is-invalid');
            $('#strChargeError').html('This field is required');
            ischargesValid = false;
        }else if(parseFloat(charges) || parseInt(charges)){
            ischargesValid = true;
        }else{
            $('.myinputText').addClass('is-invalid');
            $('#strChargeError').html('Invalid values entered');
            ischargesValid = false;
        }

        if(ischargesValid && islocationValid && isPayMethodValid){
            resetStrError();
            $('.myinputText').removeClass('is-invalid');
            $('.myselect').removeClass('is-invalid');

            $.ajax({
                url: "chargesAjax.php",
                type: "post",
                data: {payment:paymentMethod,location:location,charges:charges,task:"addNew"},
                success: function(response){
                    if(parseInt(response) === 1){
                        Swal.fire({icon:'success',title:'Done !',text:'Charges was set successfully'});
                        ShowRecords();
                        restInputs();

                    }else{
                        console.log(response);
                        Swal.fire({icon:'warning',title:'Something is not right',text:''});
                    }
                }
            })

        }
    });
    $('tbody').on('click', '#btnDelete', function() {
        var id = $(this).attr('data-chargeId');
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
                    url: "chargesAjax.php",
                    data:{id:id,task:"delete"},
                    success: function(response){
                        if(parseInt(response) === 1){
                            Swal.fire({icon:'success',title:'Done !',text:'Charge Removed successfully'});
                            ShowRecords();
                        }else{
                            console.log(response);
                            Swal.fire({icon:'warning',title:'Something is not right',text:''});
                        }
                    }
                });
            }
        });

    });
    $('tbody').on('click','#btnUpdate', function(){
        var id = $(this).attr('data-chargeId');
        $.ajax({
            url: "chargesAjax.php",
            data:{task:"showForm",id:id},
            success: function(response){
                $('.modal-content').html(response);
                $('#Update-modal').modal('show');
            }
        })
    });
    $('#Update-modal').on('submit', '#updateCharges', function(event) {
        event.preventDefault();
        // Perform validation
        var paymentMethod = $('select[name="UPpaymentMethod"]').val();
        var location = $.trim($('input[name="UPlocation"]').val());
        var charges = $.trim($('input[name="UPcharge"]').val());
        var id = $('input[name="chargeID"]').val();

            $.ajax({
                url: "chargesAjax.php",
                type: "post",
                data: {payment:paymentMethod,location:location,charges:charges,id:id,task:"updateTHIS"},
                success: function(response){
                    if(parseInt(response) === 1){
                        Swal.fire({icon:'success',title:'Done !',text:'Charges was Update successfully'});
                        ShowRecords();

                    }else{
                        console.log(response);
                        Swal.fire({icon:'warning',title:'Something is not right',text:''});
                    }
                }
            })
    });

});

function restInputs(){
    $('input[name="location"]').val('');
    $('input[name="charge"]').val('');
    $('select[name="paymentMethod"]').val(0);
    
}
function resetStrError(){
    $('#strPayMethodError').html('');
    $('#strLocationError').html('');
    $('#strChargeError').html('');

}
function ShowRecords(){
    $.ajax({
        url: "chargesAjax.php",
        data:{task:"show"},
        success: function(response){
            $('#tableData').html(response);
        }
    })
}