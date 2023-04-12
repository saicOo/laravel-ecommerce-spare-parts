$(document).ready(function () {
    $("body").on("change", "#product-ajax", function () {
        var productId = $(this).val();
        var url = $(this).data("url-show");
        url = url.replace(":productId", productId);
        $.ajax({
            url: url,
            dataType: "json",
            method: "get",
            success: function (data) {
                $("#price").val(data.purchase_price);
            },
        });
    }); // add price

    $("body").on("click", "#add-product", function () {
        var productId = $("#product-ajax").val();
        var qyt = $("#qyt").val();
        var price = $("#price").val();
        var url = $(this).data("url");
        if (!$("#product-ajax").val() || !$("#qyt").val()) {
            alert("ادخل بيانات المنتج !");
            return false;
        }
        url = url.replace(":productId", productId);
        $.ajax({
            url: url,
            dataType: "json",
            method: "get",
            success: function (data) {
                var existent = false;
                $("#purchaseList .inputProduct").each(function (index) {
                    if (data.id == $(this).val()) {
                        existent = true;
                        return false;
                    }
                    productIndex = index;
                }); //end of product price
                if (existent) {
                    alert("هذا المنتج تم اضافته بالفعل");
                } else {
                    $("#purchaseList").append(`
                <tr>
                    <td>${data.name} #${data.id}
                        </td>
                    <td>${price}
                        <input type="hidden" class="form-control product-price" name="products[${data.id}][price]"
                            value="${price}">
                    </td>
                    <td>${qyt}
                    <input name="products[${data.id}][quantity]" type="hidden" value="${qyt}"
                            class="form-control"></td>
                    <td class="product-subTotal">${price * qyt}</td>
                    <td><span><a href="javascript:void()" data-toggle="tooltip" class="remove-product-btn" data-id="${
                        data.id
                    }"
                                data-placement="top" title="delete"><i
                                    class="fa fa-close color-danger"></i></a></span>
                    </td>
                </tr>
                `);
                }
            },
        });
        $("#product-ajax").val("");
        $("#qyt").val(1);
        $("#price").val("");
        const myTimeout = setTimeout(calculateTotal, 1000);
    }); // add product

    //remove product btn
    $("body").on("click", ".remove-product-btn", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $(this).closest("tr").remove();
        //to calculate total price
        setTimeout(calculateTotal, 1000);
    }); //end of remove product btn

});

//calculate the total
function calculateTotal() {
    var price = 0;

    $("#purchaseList .product-subTotal").each(function (index) {
        price += parseFloat($(this).html().replace(/,/g, ""));
        console.log(price);
    }); //end of product price

    $("#total-price").html(price);
    //check if price > 0
    if (price > 0) {
        $("#add-form-btn").attr("disabled", false);
    } else {
        $("#add-form-btn").attr("disabled", true);
    } //end of else
} //end of calculate total
