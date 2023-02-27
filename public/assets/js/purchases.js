$(document).ready(function () {
$('body').on("click", "#add-product", function () {
    var productId = $("#product-ajax").val();
    var qyt = $("#qyt").val();
    var url = $(this).data("url");
    if(!$("#product-ajax").val() || !$("#qyt").val()){
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

                if(data.id == $(this).val()){
                    existent =true;
                    return false;
                }
            }); //end of product price
            if(existent){
                alert("هذا المنتج تم اضافته بالفعل");
            }else{
                $("#purchaseList").append(`
                <tr>
                    <td>${data.name}
                        <input type="hidden" name="products[]" class="inputProduct" value="${data.id}">
                        </td>
                    <td>
                        <input type="text" class="form-control product-price" name="price[]"
                            value="${data.purchase_price}">
                    </td>
                    <td><input name="qyt[]" type="text" value="${qyt}"
                            name="demo0" class="form-control qyt product-quantity"></td>
                    <td><input type="text" class="form-control product-subTotal" value="${
                        data.purchase_price * qyt
                    }"
                            disabled></td>
                    <td><span><a href="javascript:void()" data-toggle="tooltip" class="remove-product-btn" data-id="${
                        data.id
                    }"
                                data-placement="top" title="delete"><i
                                    class="fa fa-close color-danger"></i></a></span>
                    </td>
                    <script>
            $(".qyt").TouchSpin({
                min: 1,
                max: null,
            });
        </script>
                </tr>
                `);
            }

        },
    });
    $('#product-ajax').val('');
    $('#qyt').val(1);
    const myTimeout = setTimeout(calculateTotal, 1500);
}); // add product

//remove product btn
$('body').on("click", ".remove-product-btn", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $(this).closest("tr").remove();
    //to calculate total price
    calculateTotal();
}); //end of remove product btn

//change product quantity
$('body').on("keyup change", ".product-quantity", function () {
    var quantity = Number($(this).val());
    var price = $(this).closest("tr").find(".product-price").val();

    $(this)
        .closest("tr")
        .find(".product-subTotal")
        .val(quantity * price);

    calculateTotal();
}); //end of product quantity change

  //change product price
  $('body').on("keyup change", ".product-price", function () {
    var price = Number($(this).val()); //2
    var quantity = $(this).closest("tr").find(".product-quantity").val();
    $(this)
      .closest("tr")
      .find(".product-subTotal")
      .val(price * quantity);

    calculateTotal();
  }); //end of product price change
  });

//calculate the total
function calculateTotal() {

    var price = 0;

    $("#purchaseList .product-subTotal").each(function (index) {
        price += parseFloat($(this).val().replace(/,/g, ""));
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
