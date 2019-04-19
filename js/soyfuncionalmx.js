var baseurl = $("#baseUrl").val();
var numericos = /[0-9,-]/;
var letras = /^[a-zA-Z\ .\s\u00C1 \u00E1 \u00C9 \u00E9 \u00CD \u00ED \u00D3 \u00F3 \u00DA \u00FA \u00DC \u00FC \u00D1 \u00F1 .;:,¿?¿!\"#%=()*\s]+$/;
var alfanum = /^[a-zA-Z\. \s\-\u00C1 \u00E1 \u00C9 \u00E9 \u00CD \u00ED \u00D3 \u00F3 \u00DA \u00FA \u00DC \u00FC \u00D1 \u00F1 .;:,0123456789_://.\"()s!#$¡¿?\s]+$/;
var correo = /^[a-zA-Z0-9_@\-\.\s]+$/;
var carpeta = /^[a-zA-Z\. \s\-\u00C1 \u00E1 \u00C9 \u00E9 \u00CD \u00ED \u00D3 \u00F3 \u00DA \u00FA \u00DC \u00FC \u00D1 \u00F1 .;:,0123456789_://.\"()s!#$¡¿?\s]+$/;
var decimales = /[0-9\.]/;
var fecha = /[0-9\-]/;
var url = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/;
var procesando = " P r o c e s a n d o . . . . ";

$(document).ready(function() {
    $(document).delegate(".numeros", "keypress", function(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8) {
            return true;
        }
        tecla_final = String.fromCharCode(tecla);
        return numericos.test(tecla_final);
    });

    //Entrada Letras
    $(document).delegate(".letras", "keypress", function(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8) {
            return true;
        }
        tecla_final = String.fromCharCode(tecla);
        return letras.test(tecla_final);
    });

    //Entrada alfanumerico
    $(document).delegate(".alfa", "keypress", function(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8) {
            return true;
        }
        tecla_final = String.fromCharCode(tecla);
        return alfanum.test(tecla_final);
    });

    //Entrada correo
    $(document).delegate(".correo", "keypress", function(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8) {
            return true;
        }
        tecla_final = String.fromCharCode(tecla);
        return correo.test(tecla_final);
    });

    //Decimales
    $(document).delegate(".decimales", "keypress", function(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8) {
            return true;
        }
        tecla_final = String.fromCharCode(tecla);
        return decimales.test(tecla_final);
    });

    $(document).on("click", "#guardaTestimonial", function(e) {
        $('#tprocesando').css({ 'color': '#000000' });
        var nombre = $("#nombre").val();
        var testimonial = $("#testimonial").val();
        var sessionId = $("#sessionId").val();
        if (String(sessionId) !== "" && String(nombre) !== "" && String(testimonial) !== "" && String(nombre).length > 3 && String(testimonial).length > 8) {
            var url = "guardaTestimonial.php";
            var formData = new FormData();
            formData.append("nombre", nombre);
            formData.append("testimonial", testimonial);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#tprocesando').html(procesando);
                },
                success: function(data) {
                    $('#tprocesando').html("");
                    if (parseInt(data.exito) === 1) {
                        $("#nombre").val('');
                        $("#testimonial").val('');
                        $('#tprocesando').css({ 'color': '#4B8A08' });
                        $('#tprocesando').html("En breve se publicar\u00E1 el testimonial");
                        setTimeout(function() {
                            console.log("insertado");
                            $("#mtestimonial").modal('hide');
                        }, 4000);
                    } else {
                        $('#tprocesando').css({ 'color': '#B40431' });
                        $('#tprocesando').html("Error al guardar el testimonial");
                    }
                    return false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    return false;
                },
                complete: function() {}
            });
        } else {
            $("#tprocesando").html("Por favor teclea correctamente los campos requeridos");
        }
        return false;
    });

    $(document).on("click", "#guardaPregunta", function(e) {
        $('#pprocesando').css({ 'color': '#800000' });
        var pregunta = $("#pregunta").val();
        var sessionId = $("#sessionId").val();
        if (String(sessionId) !== "" && String(pregunta).length > 3) {
            var url = "guardaPregunta.php";
            var formData = new FormData();
            formData.append("pregunta", pregunta);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#pprocesando').html(procesando);
                },
                success: function(data) {
                    $('#pprocesando').html("");

                    if (parseInt(data.exito) === 1) {
                        $("#pregunta").val('');
                        $('#pprocesando').css({ 'color': '#4B8A08' });
                        $('#pprocesando').html("En breve se responder\u00E1 y publicar\u00E1 tu pregunta.");
                        setTimeout(function() {
                            console.log("Insertado");
                            $("#mpregunta").modal('hide');
                        }, 4000);
                    } else {
                        $('#pprocesando').css({ 'color': '#B40431' });
                        $('#pprocesando').html("Error al guardar la pregunta");
                    }
                    return false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    return false;
                },
                complete: function() {}
            });
        } else {
            $("#tprocesando").html("Por favor teclea correctamente el campo requerido");
        }
        return false;
    });


    //Evento boletin
    $(document).on("click", "#guardaBoletin", function(e) {
        $('#bprocesando').css({ 'color': '#800000' });
        var email = $("#subscribe-form-2-email").val();
        var sessionId = $("#sessionId").val();
        if (String(sessionId) !== "" && String(email).length > 6) {
            var url = "guardaBoletin.php";
            var formData = new FormData();
            formData.append("email", email);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#bprocesando').html(procesando);
                },
                success: function(data) {
                    $('#bprocesando').html("");
                    if (parseInt(data.exito) === 1) {
                        $("#subscribe-form-2-email").val('');
                        $('#bprocesando').css({ 'color': '#4B8A08' });
                        setTimeout(function() {
                            $('#bprocesando').html("En breve recibir\u00E1s el bolet\u00EDn.");
                        }, 4000);
                    } else {
                        $('#bprocesando').css({ 'color': '#B40431' });
                        $('#bprocesando').html("Error al guardar la pregunta");
                    }
                    return false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    return false;
                },
                complete: function() {}
            });
        } else {
            $("#bprocesando").html("Por favor teclea correctamente el correo electr\u00F3nico");
        }
        return false;
    });    
    
});

$(window).on("load", function() {
    console.log("window loaded");
});