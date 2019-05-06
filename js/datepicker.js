$(document).ready(function() {
    var dateToday = new Date();
    $(".datetimepicker").datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        inline: false,
        sideBySide: true,
        locale: 'es'
    });

    $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        inline: false,
        sideBySide: true,
        locale: 'es'
    });


    $("#fechaInicio").on("dp.change", function(e) {
        $("#fechaInicio").data("DateTimePicker").minDate(dateToday);
    });
});