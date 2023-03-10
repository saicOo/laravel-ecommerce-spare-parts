let address = $("meta[name=address-governorates]").attr("content");
let governorate = $("meta[name=address-governorate]").attr("content");
let city = $("meta[name=address-city]").attr("content");
$(document).ready(function() {
    // $("body").on("change", "#address_governorate", function() {
    //     let addressIndex = $(this).val();
    //     $.getJSON(address, function(data) {
    //         $('#inputGovernorate').val(data[addressIndex].name_en);
    //         $('#address_city').html('');
    //         $.each(data[addressIndex].subregions, function(index, element) {
    //                 $('#address_city').append($('<option>', {
    //                     text: $('html').attr("lang") == 'ar' ? element.name_ar : element.name_en,
    //                     value: element.name_en,
    //                 }));
    //         });
    //     });
    // }); //end of change address
    // ajax get countries
    // $.ajax({
    //     type: 'GET',
    //     url: address,
    //     dataType: 'json',
    //     success: function(data) {
    //         $.each(data, function(index, element) {
    //                 $('#address_governorate').append($('<option>', {
    //                     text: $('html').attr("lang") == 'ar' ? element.name_ar : element.name_en,
    //                     value: index,
    //                     selected: governorate == element.name_en ? true : false,
    //                 }));
    //         });
    //     }
    // }); // end ajax get countries
    // start
    // setTimeout(function() {
    //     var governorateVal = $('#address_governorate').find(":selected").val();
    //     $.getJSON(address, function(data) {
    //         $('#address_city').html('');
    //         $.each(data[governorateVal].subregions, function(index, element) {
    //                 $('#address_city').append($('<option>', {
    //                     text: $('html').attr("lang") == 'ar' ? element.name_ar : element.name_en,
    //                     value: element.name_en,
    //                     selected: city == element.name_en ? true : false,
    //                 }));
    //         });
    //     });
    // }, 100);

///////////////////////////////////////////////////////////////
$("body").on("change", "#address_governorate", function() {
    let addressIndex = $(this).val();

    getJsonAddress(addressIndex,$('#address_city'),city);
}); //end of change address

getJsonAddress(null,$('#address_governorate'),governorate);

setTimeout(function() {
    var governorateVal = $('#address_governorate').find(":selected").val();
    getJsonAddress(governorateVal,$('#address_city'),city);
}, 500);

});
function getJsonAddress(val,ele,op) {
    var dataEeach;
    $.getJSON(address, function(data) {
        if (val == null) {
            dataEeach = data;
        } else {
            dataEeach = data[val].subregions;
            $('#inputGovernorate').val(data[val].name_en);
        }
        ele.html('');
        $.each(dataEeach, function(index, element) {
                ele.append($('<option>', {
                    text: $('html').attr("lang") == 'ar' ? element.name_ar : element.name_en,
                    value: val == null ? index : element.name_en,
                    selected: op == element.name_en ? true : false,
                }));
        });
    });
}
