$(document).ready(function(){
    $('#addDriver').submit(function(event){
        event.preventDefault();

        var fname = $('input[name="FName"]');
        var lname = $('input[name="LName"]');
        var vNum = $('input[name="VehicleNo"]');
        var contact = $('input[name="contact"]');
        var email = $('input[name="email"]');
        var password = $('input[name="Password"]');
        // reset errors
        $('.myinputText').removeClass('is-invalid');
        resetError();
        var isValid_fname = true;
        var isValid_lname = true;
        var isValid_Vnum = true;
        var isValid_contact = true;
        var isValid_email = true;
        var isValid_pass = true;
        // performing validation
        if(fname.val() == ''){
            $('#strFNameError').html("This field is required");
            fname.addClass('is-invalid');
            isValid_fname = false;
        }
        
        if(lname.val() == ''){
            $('#strLNameError').html("This field is required");
            lname.addClass('is-invalid');
            isValid_lname = false;
        }
        // vNum
        if(vNum.val() == ''){
            $('#strVnumError').html("This field is required");
            vNum.addClass('is-invalid');
            isValid_Vnum = false;
        }else{
            var VehicleNumberPattern = /^[A-Za-z]{2,3}-\d{4}$/;
            if (!VehicleNumberPattern.test($.trim(vNum.val()))) {
                $('#strVnumError').html('Invalid valid Vehicle Number Format');
                vNum.addClass('is-invalid');
                isValid_Vnum = false;
            }
        }
        // contact number
        if($.trim(contact.val()) == ''){
            $('#strNumberError').html("This field is required");
            contact.addClass('is-invalid');
            isValid_contact = false;
        }else{
            if($.isNumeric($.trim(contact.val()))){
                if($.trim(contact.val()).length == 10){
                    isValid_contact = true;
                    $('.myinputText').removeClass('is-invalid');
                    $('#strNumberError').html('');
                }else{
                    $('#strNumberError').html("Contact number must have 10 digits");
                    contact.addClass('is-invalid');
                    isValid_contact = false;
                }
            }else{
                $('#strNumberError').html("Invalid characters");
                contact.addClass('is-invalid');
                isValid_contact = false;
            }
        }

        //Email Validation
        if($.trim(email.val()) == ''){
            $('#strEmailError').html('Please enter your email.');
            email.addClass('is-invalid');
            isValid_email = false;
        }else{
            // Regular expression for email validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test($.trim(email.val()))) {
                $('#strEmailError').html('Invalid valid email entered.');
                email.addClass('is-invalid');
                isValid_email = false;
            }
        }

        // password validation
        if($.trim(password.val()) == ''){
            $('#strPasswordError').html("This field is required");
            password.addClass('is-invalid');
            isValid_pass = false;
        }
        if(isValid_fname && isValid_lname && isValid_Vnum && isValid_contact && isValid_email && isValid_pass){
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
                url : "deliveryDriverAjax.php",
                type : "post",
                data : {fname : fname.val(),lname: lname.val(),VNum: vNum.val(),contact: contact.val(),email: email.val(),pass: password.val(),task:'addDelDriver'},
                success : function(response){
                    if(parseInt(response) === 1){
                        Swal.fire({icon:'success',title:'Done !',text:'Your Account was created successfully'});
                    }else{
                        console.log(response);
                        Swal.fire({icon:'warning',title:'Something is not right',text:''});
                    }
                }
              });
        }
    });
    displayALLData();

    $('#delSearch').submit(function(event){
        event.preventDefault();
        var field = $('select[name="del_col"]').val();
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
            url : "deliveryDriverAjax.php",
            data : {task:'search',field:field,data:searchData},
            success: function(response){
                Swal.close();
                $("#DelDriverDataShow").html(response);
            }
        });


    });
});

function resetError(){
    $('#strFNameError').html('');
    $('#strLNameError').html('');
    $('#strVnumError').html('');
    $('#strNumberError').html('');
    $('#strEmailError').html('');
    $('#strPasswordError').html('');
}

function displayALLData(){
    $.ajax({
        url : "deliveryDriverAjax.php",
        data : {task:'showAllData'},
        success: function(response){
            $("#DelDriverDataShow").html(response);
        }
    });
}