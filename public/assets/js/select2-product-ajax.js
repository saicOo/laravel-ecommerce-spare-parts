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
                        return {
                            text: item.name_en +' | '+ item.name_ar,
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
