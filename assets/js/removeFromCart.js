$(document).ready(function() {
    $(".cart-product-card").find("a").one("click", function(e) {
        e.preventDefault(); // Prevent the default link behavior

        var product_id = $(this).attr('data-pid');
        var size_id = $(this).attr('data-sid');
        var color_id = $(this).attr('data-cid');
        var customer_id = $(this).attr('data-custid');
        console.log("Data to be deleted: " + product_id + " : " + size_id + " : " + color_id + " : " + customer_id);

        $.ajax({
            url: "loadCartInfo.php",
            data: { pid: product_id, sid: size_id, colid: color_id, custid: customer_id },
            success: function(response) {
                loadCart();
                getCount();
            }
        });
    });
});