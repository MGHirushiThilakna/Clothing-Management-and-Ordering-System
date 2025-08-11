function loadTargetDropdown() {
    var selectedValue = $('#sizeType').val();
    $.ajax({
        url: 'ajaxGetSizeValues.php',
        data: { selectedValue: selectedValue },
        dataType: 'json',
        success: function(data) {
            // Clear the current options from the target dropdown
            $('#sizeValue').empty();

            // Add the new options to the target dropdown
            $.each(data, function(index, option) {
                $('<option>')
                    .attr('value', option.id)
                    .text(option.name)
                    .appendTo('#sizeValue');
            });
        }
    });
}

$(document).ready(function() {
    $('#sizeType').change(function() {
        loadTargetDropdown();
    });

    $('#form-update-stock').submit(function(event){
        event.preventDefault();
        console.log("updateclicked");
        var formData = [];
        var productID = $('input[name="productId"]').val();
        $(this)
        .find(".row.mb-2")
        .each(function () {
            var color = $(this).find('select[name="updatecolor[]"]').val();
            var size = $(this).find('select[name="updatesizevalue[]"]').val();
            var quantity = $(this).find('input[name="qty[]"]').val();
            formData.push({ color: color, size: size, quantity: quantity});
        });
        updateStockValues(formData,productID);

    });
});
function updateStockValues(data,pid){
    $.ajax({
        url: "viewAddStockModal.php",
        type: "POST",
        data: { formData: JSON.stringify(data),task:"updateStock",pid:pid},
        success: function (response){
            if(parseInt(response)===1){
                Swal.fire({icon:'success',title:'Done !',text:'modal stock was updated successfully'});
            }else{
                console.log(response);
                Swal.fire({icon:'warning',title:'Something is not right',text:"check console log"});
            }
        },
        error: function (xhr, status, error) {
            // Handle any errors that occurred during the AJAX request
            console.error("AJAX error:", error);
        },
    })
}
