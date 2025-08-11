$(document).ready(function(){
    loadOrders();
    $('tbody').on('click',"#view",function(){
        var invoiceID = $(this).attr("data-invoiceID");
        var paymentID = $(this).attr("data-paymentID");
        var orderstatus = $(this).attr("data-orderStatus");
        loadViewOrder(invoiceID,paymentID,orderstatus);
    });

    $(document).on('click', '#confirmOrder', function() {
        var invoice = $(this).attr('data-invoiceID');
        var stat = "Confirmed";
        Swal.fire({
            title: 'Do you wish to Confirm this Order ?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if (result.isConfirmed) {
                updateOrderStatus(invoice,stat);
              }
          });

        
    });

    $(document).on('click', '#readyOrder', function() {
        var invoice = $(this).attr('data-invoiceID');
        var stat = "Ready";
        Swal.fire({
            title: 'Do you wish to Assign Ready Status to this Order ?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if (result.isConfirmed) {
                updateOrderStatus(invoice,stat);
              }
          });
    });

    $(document).on('click', '#dispatch', function() {
        var invoice = $(this).attr('data-invoiceID');
        var stat = "Dispatched";
        Swal.fire({
            title: 'Do you wish to Dispatch this Order ?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if (result.isConfirmed) {
                updateOrderStatus(invoice,stat);
              }
        });
    });

    $(document).on('submit','#AssignEMP',function(event){
        event.preventDefault();
        var empId = $('select[name="empIDSelect"]').val();
        var invoice = $('input[name="invoiceID"]').val();
        
        Swal.fire({
            title: 'Do you wish to Assign this Employee ?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if (result.isConfirmed) {
                assignEmp(empId,invoice);
              }
        });
    });

    $(document).on('submit','#AssignDriver',function(event){
        event.preventDefault();
        var driverID = $('select[name="DriverSelect"]').val();
        var paymentID = $('input[name="paymentID"]').val();
        console.log(driverID + " : " +paymentID);
        Swal.fire({
            title: 'Do you wish to Assign this Driver ?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if (result.isConfirmed) {
                assignDriver(driverID,paymentID);
              }
        });
    })

    $('[name="orderStatus"]').change(function(){
        var orderStatus = $(this).val();
        var pm = $('[name="paymentMethods"]').val();
        loadOrderOnCondition(pm,orderStatus);
    });
    $('[name="paymentMethods"]').change(function(){
        var paymentMethods = $(this).val();
        var os = $('[name="orderStatus"]').val();
        loadOrderOnCondition(paymentMethods,os);
    });

});

function loadOrderOnCondition(pm,os){
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
        url: "orderAjaxCalls.php",
        data: {pm:pm,os:os,task:"loadOnCondition"},
        success:function(response){
            Swal.close();
            $('tbody').html(response);
        }
    });  
}

function loadOrders(){
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
        url: "orderAjaxCalls.php",
        data: {task:"loadTable"},
        success:function(response){
            Swal.close();
            $('tbody').html(response);
        }
    });
}
function loadViewOrder(invoiceID,paymentID,orderStatus){
    $.ajax({
        url: "orderAjaxCalls.php",
        data: {task:"viewOrder",invoiceID:invoiceID,paymentID:paymentID,orderStatus:orderStatus},
        success:function(response){
            $('.modal-content').html(response);
            $('#viewEachOrder').modal('show');
            
        }
    })
}

function loadOrderDetailsOfInvoice($invoiceID){
    $.ajax({
        url: "orderAjaxCalls.php",
        data: {task:"loadOrderdetails",invoiceID:invoiceID},
        success:function(response){
            $('.modal-content').html(response);
            $('#viewEachOrder').modal('show');
        }
    })
}

function updateOrderStatus(invoiceID,stat){
    $.ajax({
        url: "orderAjaxCalls.php",
        data: {task:"updateOrderAdminStatus",invoice:invoiceID,oStat:stat},
        success:function(response){
            if(parseInt(response)=== 1){
                if(stat ==='Confirmed'){Swal.fire({icon:'success',title:'Done !',text:'Order '+invoiceID+' is Confirmed'});}
                else if(stat ==='Ready'){Swal.fire({icon:'success',title:'Done !',text:'Order '+invoiceID+' is Ready'});}
                else if(stat ==='Dispatched'){Swal.fire({icon:'success',title:'Done !',text:'Order '+invoiceID+' is Dispatched'});}
                else{
                    Swal.fire({icon:'success',title:'Done !',text:'Order '+invoiceID+' Status Updated'});
                }
                
            }else{
                console.log(response);
                Swal.fire({icon:'warning',title:'Something is not right',text:''});
            }
        }
    })
}

function assignEmp(EmpId,invoiceID){
    $.ajax({
        url : "orderAjaxCalls.php",
        data : {task:"AssignEmp",EMPid:EmpId,invoiceID:invoiceID},
        success : function (response){
            if(parseInt(response)=== 1){
                Swal.fire({icon:'success',title:'Done !',text:'Employee Assigned'});
            }else{
                console.log(response);
                Swal.fire({icon:'warning',title:'Something is not right',text:''});
            }
        }
    })
}

function assignDriver(DriverID,paymentId){
    $.ajax({
        url : "orderAjaxCalls.php",
        data : {task:"AssignDriver",DriverId: DriverID,paymentId:paymentId},
        success : function (response){
            if(parseInt(response)=== 1){
                Swal.fire({icon:'success',title:'Done !',text:'Driver Assigned'});
            }else{
                console.log(response);
                Swal.fire({icon:'warning',title:'Something is not right',text:''});
            }
        }
    })
}