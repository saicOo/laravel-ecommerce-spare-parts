$(document).ready(function() {
    $("#product-ajax").select2({
        placeholder: "Select Product",
        // minimumInputLength: 2,
        // templateResult: formatGovernorate,
        ajax: {
            url: $("#product-ajax").data("url-products"),
            dataType: 'json',
            type: "GET",
            data: function(term) {
                return {
                    term: term
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        console.log(item);
                        return {
                            text: item.name_en +' | '+ item.name_ar +' '+ item.car.name_en +' ('+ item.car.start_year +'-'+ item.car.end_year +') ' +' | SKU: #'+ item.id,
                            id: item.id,
                            value: item.id,
                            // contryflage: item.description
                        }
                    })
                };
            }
        }
    });

});
