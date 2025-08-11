$(document).ready(function () {
    var cid = $('#displayInvoice').attr('data-customerid');
    displayInvoice(cid);
    $("#sidebarCollapse").on("click", function () {
      $("#sidebar").toggleClass("active");
    });

    $('#currentOrders').on('click',function(event){
      displayInvoice(cid);

    });
    $('#completedOrders').on('click',function(event){
      displayCompletedOrders(cid);
            
    });
    
    $('#displayInvoice').on('click',"#cust-view-order",function(){
      var invoiceID = $(this).attr("data-invoiceID");
      var paymentID = $(this).attr("data-paymentID");
      viewCustOrder(invoiceID,paymentID);
    });

    $('#displayInvoice').on('click',"#cust-cancel-order",function(){
      var invoiceID = $(this).attr("data-invoiceID");
      var paymentID = $(this).attr("data-paymentID");
      Swal.fire({
        title: 'Do you wish to cancel Your Order ?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
          if (result.isConfirmed) {
            cancelOrder(invoiceID,paymentID);
          }
      });
      displayInvoice(cid);
      
    });

    $('#displayInvoice').on('submit',"#paymentProof",function(event){
      event.preventDefault();

      // validate that form
      var fileInput = $('#imgproof',this)[0];
      var paymentID = $('#paymentID').val();
      $('#imgproof').removeClass('is-invalid');
      var isValid = true;

      if (fileInput.files.length === 0) {
        $('#imgproof',this).addClass('is-invalid');
        isValid = false;
      }
      if(isValid){
        $('#imgproof',this).removeClass('is-invalid');

        const formData = new FormData();

        // Append the selected file to the FormData object
        formData.append("proof", fileInput.files[0]); // Use "file" as the key to access the file on the server-side

        formData.append("task", "updateProof");
        formData.append("paymentID", paymentID);
        updatePaymentProof(formData);
      }
      displayInvoice(cid);
      
    });


  });

function displayInvoice(cid){
  $.ajax({
    url: "invoiceAjax.php",
    data: {task:"displayInvoice",custID:cid,status:"Completed"},
    success: function(response){
      $('#displayInvoice').html(response);
    }
  });
}

function displayCompletedOrders(cid){
  $.ajax({
    url: "invoiceAjax.php",
    data: {task:"displayCompletedInvoice",custID:cid,status:"Completed"},
    success: function(response){
      $('#displayInvoice').html(response);
    }
  });
}

function viewCustOrder(invoiceID,paymentID){
  $.ajax({
    url: "invoiceAjax.php",
    data:{task:"viewCustomerOrder",invoice:invoiceID,payment:paymentID},
    success: function(response){
      $('.cust-order-content').html(response);
      $('#view-customer-order').modal('show');
    }
  });
}

function cancelOrder(invoiceID,paymentID){
  $.ajax({
    url: "invoiceAjax.php",
    data:{task:"cancelOrder",invoice:invoiceID,payment:paymentID},
    success: function(response){
      if(parseInt(response) === 1){
        Swal.fire({icon:'success',title:'Done !',text:'Your Order '+invoiceID+' is cancelled'});
      }else{
        console.log(response);
        Swal.fire({icon:'warning',title:'Something is not right',text:''});
      }
    }
  });
}

function updatePaymentProof(data){
  $.ajax({
    url: "invoiceAjax.php",
    type:"post",
    data: data,
    processData: false,
    contentType: false,
    success: function(response) {
        if(parseInt(response) === 1){
            Swal.fire({icon:'success',title:'Done !',text:'Payment Proof Added'});
        }else{
            console.log(response);
            Swal.fire({icon:'warning',title:'Something is not right',text:''});
        }
    },
    error: function(xhr, status, error) {
        // Handle errors if the AJAX request fails
        console.error("Error:", error);
    }
});
}