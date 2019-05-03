
$(document).ready(function() {
    $(".datetimepicker").datetimepicker({
		format : 'YYYY-MM-DD HH:mm:ss',
        inline : false,
		sideBySide : true,
		locale : 'es'
	});

	$(".datepicker").datetimepicker({
	    format : 'DD-MM-YYYY',
		inline : false,
		sideBySide : true,
		locale : 'es'
	});

	$("#fechaInicio").on("dp.change",function(e) {
        //$('#fechaFinal').data("DateTimePicker").minDate(e.date);
		$("#fechaInicio").data("DateTimePicker").minDate(e.date);
	});
});
