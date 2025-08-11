$( document ).ready(function() {
    // cod
    COD_ADDRESS_enable();
    COD_contact_enable();
    $('#COD_Address_edit').click(function(){
        COD_ADDRESS_disable();
    });
    $('#COD_Address_save').click(function(){
        COD_ADDRESS_enable();
    });
    $('#COD_Contact_edit').click(function(){
        COD_contact_disable();
    });
    $('#COD_Contact_save').click(function(){
        COD_contact_enable();
    });
    //*************************************** */
    BD_ADDRESS_enable();
    BD_contact_enable();
    $('#BD_Address_edit').click(function(){
        BD_ADDRESS_disable();
    });
    $('#BD_Address_save').click(function(){
        BD_ADDRESS_enable();
    });
    $('#BD_Contact_edit').click(function(){
        BD_contact_disable();
    });
    $('#BD_Contact_save').click(function(){
        BD_contact_enable();
    });
    //****************************************** */
    P_contact_enable();
    $('#P_Contact_edit').click(function(){
        P_contact_disable();
    });
    $('#P_Contact_save').click(function(){
        P_contact_enable();
    });

});
//COD
function COD_ADDRESS_enable(){
    $('textarea[name="deliveryCODAddress"]').prop('disabled',true);
    $('#COD_Address_edit').show();
    $('#COD_Address_save').hide();
}
function COD_ADDRESS_disable(){
    $('textarea[name="deliveryCODAddress"]').prop('disabled',false);
    $('#COD_Address_edit').hide();
    $('#COD_Address_save').show();
}
function COD_contact_enable(){
    $('input[name="CODContact"]').prop('disabled',true);
    $('#COD_Contact_edit').show();
    $('#COD_Contact_save').hide();
}
function COD_contact_disable(){
    $('input[name="CODContact"]').prop('disabled',false);
    $('#COD_Contact_edit').hide();
    $('#COD_Contact_save').show();
}

//BD

function BD_ADDRESS_enable(){
    $('textarea[name="BDdeliveryAddress"]').prop('disabled',true);
    $('#BD_Address_edit').show();
    $('#BD_Address_save').hide();
}
function BD_ADDRESS_disable(){
    $('textarea[name="BDdeliveryAddress"]').prop('disabled',false);
    $('#BD_Address_edit').hide();
    $('#BD_Address_save').show();
}
function BD_contact_enable(){
    $('input[name="BDContact"]').prop('disabled',true);
    $('#BD_Contact_edit').show();
    $('#BD_Contact_save').hide();
}
function BD_contact_disable(){
    $('input[name="BDContact"]').prop('disabled',false);
    $('#BD_Contact_edit').hide();
    $('#BD_Contact_save').show();
}
// p
function P_contact_enable(){
    $('input[name="PContact"]').prop('disabled',true);
    $('#P_Contact_edit').show();
    $('#P_Contact_save').hide();
}
function P_contact_disable(){
    $('input[name="PContact"]').prop('disabled',false);
    $('#P_Contact_edit').hide();
    $('#P_Contact_save').show();
}

