$(document).ready(function(){

    displayALLEmpData(); // to Display empyoy records on a table

    // Employee Search bar
    $('#empSearch').submit(function(event){
        event.preventDefault();
        var field = $('select[name="emp_col"]').val();
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
            url : "empAjax.php",
            data : {task:'search',field:field,data:searchData},
            success: function(response){
                Swal.close();
                $("#empDataShow").html(response);
            }
        });


    });

    // Employee Registration Form

    $('#AddEMP').submit(function(event) {
        event.preventDefault(); // this prevent the form from default submission 

        var fname = $('input[name="FName"]');
        var lname = $('input[name="LName"]');
        var select_job = $('select[name="JobRole"]');
        var contact = $('input[name="contact"]');
        var email = $('input[name="email"]');
        var password = $('input[name="Password"]');

        // reset errors
        $('.myinputText').removeClass('is-invalid');
        $('.myselect').removeClass('is-invalid');
        resetError();
        var isValid_fname = true;
        var isValid_lname = true;
        var isValid_job = true;
        var isValid_contact = true;
        var isValid_email = true;
        var isValid_pass = true;
        // performing validation

        if (parseInt(select_job.val()) === 0) {
            select_job.addClass('is-invalid');
            $('#strJobError').html('Please select a Role');
            isValid_job = false;
        }

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
        // Email number
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

        if($.trim(password.val()) == ''){
            $('#strPasswordError').html("This field is required");
            password.addClass('is-invalid');
            isValid_pass = false;
        }

        if(isValid_fname && isValid_lname && isValid_job && isValid_contact && isValid_email && isValid_pass){
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
                url : "empAjax.php",
                type : "post",
                data : {fname : fname.val(),lname: lname.val(),job: select_job.val(),contact: contact.val(),email: email.val(),pass: password.val(),task:'addEmp'},
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
});
function resetError() {
    $('#strFNameError').html('');
    $('#strLNameError').html('');
    $('#strJobError').html('');
    $('#strNumberError').html('');
    $('#strEmailError').html('');
    $('#strPasswordError').html('');
}

function displayALLEmpData(){
    $.ajax({
        url : "empAjax.php",
        data : {task:'showAllData'},
        success: function(response){
            $("#empDataShow").html(response);
        }
    });
}
