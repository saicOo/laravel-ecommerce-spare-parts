$(document).ready(function() {
    let brandArr = [];
    let countryArr = [];

    console.log($('#amount').val());
    $("body").on("change", ".filter-brand", function() {
        let brandId = $(this).val();
        if ($(this).prop("checked")) {
            brandArr.push($(this).val());
        } else {
            brandArr.splice($.inArray(brandId, brandArr), 1);
        }
        $('#brand_id').val(`[${brandArr}]`);
        console.log($('#brand_id').val());
    });

    $("body").on("change", ".filter-country", function() {
        let country = $(this).val();
        if ($(this).prop("checked")) {
            countryArr.push(`"${$(this).val()}"`);
        } else {
            countryArr.splice($.inArray(country, countryArr), 1);
        }
        $('#country').val(`[${countryArr}]`);
        console.log($('#country').val());
    });

    $("body").on("click", ".filter-category", function(event) {
        event.preventDefault()
        $('#category_id').val($(this).attr("data-category"));
        console.log($('#category_id').val());
    });

});
