$(document).ready(function() {
    let massDeleteArr = [];
    $("body").on("change", ".check-box-delete", function() {
        let deleteId = $(this).val();
        if ($(this).prop("checked")) {
            massDeleteArr.push(deleteId)
        } else {
            massDeleteArr.splice($.inArray(deleteId, massDeleteArr), 1);
        }
        $('#mass-delete').val(massDeleteArr);
        checkMassDeleteIsDisabled()
    }); //end of inputs check box change

    $("body").on("change", "#check-box-delete-all", function() {
        if ($(this).prop("checked")) {
            massDeleteArr = [];
            $(".check-box-delete").each(function(index) {
                $(this).prop("checked", true);
                massDeleteArr.push($(this).val());
            });

        } else {
            $(".check-box-delete").each(function(index) {
                $(this).prop("checked", false);
                massDeleteArr = [];
            });
        }
        $('#mass-delete').val(massDeleteArr);
        checkMassDeleteIsDisabled()
    }); //end of input all check box change
    function checkMassDeleteIsDisabled() {
        massDeleteArr.length > 0 ? $('#btn-mass-delete').attr("disabled", false) : $('#btn-mass-delete')
            .attr("disabled", true);
    }
});
