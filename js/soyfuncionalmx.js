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
var catId = 0;
var tabSeleccionado = "";
$(document).ready(function() {


    if ($("#catId") !== undefined && parseInt($("#catId").val()) > 0) {
        catId = $("#catId").val();
        $(".cuadrados").hide();
        $(".cuadro" + catId).show();
    }

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

    $(document).on("click", ".seleccionCategoria", function(e) {
        var idCat = $(this).attr('id');
        if (parseInt(idCat) > 0) {
            $(".cuadrados").hide();
            $(".seleccionCategoria").each(function(i) {
                if ($(this).prop('checked')) {
                    $(".cuadro" + (i + 1)).show();
                }
            });
        }
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
                        $('#bprocesando').html("En breve recibir\u00E1s el bolet\u00EDn.");
                        setTimeout(function() {
                            $('#bprocesando').html("");
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


    $(document).on("click", ".seleccionaProducto", function(e) {
        var sessionId = $("#sessionId").val();
        var prodc = $(this).attr('id');
        var fecha = $("#fechaInicio").val();
        var tmp = prodc.split("-");
        var idProd = tmp[1];
        if (String(sessionId) !== "" && fecha !== "" && fecha.length === 10 && parseInt(idProd) > 0) {
            var url = "agregaProducto.php";
            var formData = new FormData();
            formData.append("idProd", idProd);
            formData.append("fecha", fecha);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#aviso').css({ "background-color": "#FFFFFF", "color": "#98bf44", "border": "2px solid #DDDDDD" });
                    $('#aviso').html(procesando);
                },
                success: function(data) {
                    $('#aviso').html("");
                    if (parseInt(data.exito) === 1) {
                        $("#totalPedidos").html(data.msg.noPedidos);
                        $('#aviso').css({ "background-color": "#98bf44", "color": "#ffffff", "border": "2px solid #DDDDDD" });
                        $('#aviso').html("Producto Agregado");

                    } else {
                        $('#aviso').css({ "background-color": "#f5543f", "color": "#ffffff", "border": "2px solid #DDDDDD" });
                        $('#aviso').html("Error: el producto NO se agrego");
                    }
                    return false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    return false;
                },
                complete: function() {}
            });
        }
        return false;
    });

    $(document).on("click", ".menos", function(e) {
        var sessionId = $("#sessionId").val();
        var div = $(this).attr('id');
        var tmp = div.split("-");
        var valor = parseInt($("#cantidad-" + tmp[1]).val());
        var unitario = parseFloat($("#unitario-" + tmp[1]).val());
        var importeDia = parseFloat($("#importedia-" + tabSeleccionado).val());
        var importeTotal = parseFloat($("#importeTotal").val());
        if (String(sessionId) !== "") {
            if (valor > 1) {
                valor = valor - 1;
            } else {
                valor = 1;
            }
            $("#cantidad-" + tmp[1]).val(String(valor));
            $("#importe-" + tmp[1]).val(String((unitario * valor).toFixed(2)));
            if (valor > 1) {
                importeTotal = importeTotal - unitario;
                importeDia = importeDia - unitario;
            }
            importeTotalS = String(importeTotal.toFixed(2));
            importeDiaS = String(importeDia.toFixed(2));
            $("#importedia-" + tabSeleccionado).val(importeDia);
            $("#simportedia-" + tabSeleccionado).html(importeDiaS);

            $("#importeTotal").val(importeTotal);
            $("#txtImporteTotal").html(importeTotalS);
            var url = "actualizaProducto.php";
            var formData = new FormData();
            formData.append("idProd", tmp[1]);
            formData.append("fecha", tabSeleccionado);
            formData.append("cantidad", valor);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {},
                success: function(data) {
                    console.log(data.exito);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                complete: function() {}
            });
        }
        return false;
    });

    $(document).on("click", ".mas", function(e) {
        var sessionId = $("#sessionId").val();
        var div = $(this).attr('id');
        var tmp = div.split("-");
        var valor = parseInt($("#cantidad-" + tmp[1]).val());
        var unitario = parseFloat($("#unitario-" + tmp[1]).val());
        var importeDia = parseFloat($("#importedia-" + tabSeleccionado).val());
        var importeTotal = parseFloat($("#importeTotal").val());
        if (String(sessionId) !== "") {
            if (valor >= 1) {
                valor = valor + 1;
            } else {
                valor = 1;
            }
            $("#cantidad-" + tmp[1]).val(String(valor));
            $("#importe-" + tmp[1]).val(String((unitario * valor).toFixed(2)));
            if (valor > 1) {
                importeTotal = importeTotal + unitario;
                importeDia = importeDia + unitario;
            }
            importeTotalS = String(importeTotal.toFixed(2));
            importeDiaS = String(importeDia.toFixed(2));
            $("#importedia-" + tabSeleccionado).val(importeDia);
            $("#simportedia-" + tabSeleccionado).html(importeDiaS);

            $("#importeTotal").val(importeTotal);
            $("#txtImporteTotal").html(importeTotalS);

            var url = "actualizaProducto.php";
            var formData = new FormData();
            formData.append("idProd", tmp[1]);
            formData.append("fecha", tabSeleccionado);
            formData.append("cantidad", valor);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {},
                success: function(data) {
                    console.log(data.exito);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                complete: function() {}
            });
        }
        return false;
    });

    $(document).on("change", "#name", function(e) {
        var nombre = $("#name").val();
        $("#errorNombre").html("");
        if (String(nombre) === "" || String(nombre).length < 6) {
            $("#errorNombre").html("El campo nombre debe contener al menos 6 caracteres");
            return false;
        }
    });

    $(document).on("change", "#email", function(e) {
        $("#errorEmail").html("");
        var email = $("#email").val();
        if (String(email) === "" || String(email).length < 6) {
            $("#errorEmail").html("El campo email debe contener al menos 6 caracteres");
            return false;
        }
        if (!valEmail(email)) {
            $("#errorEmail").html("Favor de teclear un correo electronico valido.");
            return false;
        }
    });

    $(document).on("change", "#phone", function(e) {
        $("#errorPhone").html("");
        var phone = $("#phone").val();
        alert("phone change:  " + phone);
        if (String(phone) === "" || phone.length !== 10) {
            $("#errorPhone").html("El campo telefono debe contener 10 numeros");
            return false;
        }
    });

    $(document).on("change", "#address", function(e) {
        $("#errorAddress").html("");
        var address = $("#address").val();
        if (String(address) === "" || String(address).length < 11) {
            $("#errorAddress").html("El campo domicilio debe contener al menos 10 caracteres");
            return false;
        }
    });


    $(document).on("click", "#enviarPedido", function(e) {
        var sessionId = $("#sessionId").val();
        var nombre = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var delegacion = $("#delegacion").val();
        $("#errorNombre").html("");
        $("#errorEmail").html("");
        $("#errorPhone").html("");
        $("#errorAddress").html("");
        if (String(nombre) === "" || String(nombre).length < 6) {
            $("#errorNombre").html("El campo nombre debe contener al menos 6 caracteres");
            return false;
        }
        if (String(email) === "" || String(email).length < 6) {
            $("#errorEmail").html("El campo email debe contener al menos 6 caracteres");
            return false;
        }
        if (!valEmail(email)) {
            $("#errorEmail").html("Favor de teclear un correo electronico valido.");
            return false;
        }
        if (String(phone) === "" || phone.length !== 10) {
            $("#errorPhone").html("El campo telefono debe contener 10 numeros");
            return false;
        }
        if (String(address) === "" || String(address).length < 11) {
            $("#errorAddress").html("El campo domicilio debe contener al menos 10 caracteres");
            return false;
        }
        if (String(sessionId) !== "") {
            console.log("enviar Correo");
            var url = "enviaPedido.php";
            var formData = new FormData();
            formData.append("nombre", nombre);
            formData.append("email", email);
            formData.append("phone", phone);
            formData.append("address", address);
            formData.append("delegacion", delegacion);
            formData.append("sessionId", sessionId);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {},
                success: function(data) {
                    if (parseInt(data.exito) === 1) {
                        //$("#totalPedidos").html(data.msg.noPedidos);
                        //$('#aviso').css({ "background-color": "#98bf44", "color": "#ffffff", "border": "2px solid #DDDDDD" });
                        //$('#aviso').html("Producto Agregado");
                        console.log("se ha enviado el pedido");
                    } else {
                        console.log("Error al enviar el pedido");
                        //$('#aviso').css({ "background-color": "#f5543f", "color": "#ffffff", "border": "2px solid #DDDDDD" });
                        //$('#aviso').html("Error: el producto NO se agrego");
                    }
                    return false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    return false;
                },
                complete: function() {}
            });
        }
        return false;
    });

    $(document).on("click", "#continuarPedido", function(e) {
        var url = baseurl + "grid-shop.php";
        location.href = url;
    });

    if ($("#fechainicial") !== undefined) {
        tabSeleccionado = $("#fechainicial").val();
    }

    $(document).on("click", ".selecTab", function(e) {
        tabSeleccionado = $(this).attr('id');
    });
});

$(window).on("load", function() {
    console.log("window loaded");
})

function valEmail(txt) {
    var b = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
    return b.test(txt)
}
/*********************************
 	&Aacute; 	\u00C1
 	&aacute; 	\u00E1
 	&Eacute; 	\u00C9
 	&eacute; 	\u00E9
 	&Iacute; 	\u00CD
 	&iacute; 	\u00ED
 	&Oacute; 	\u00D3
 	&oacute; 	\u00F3
 	&Uacute; 	\u00DA
 	&uacute; 	\u00FA
	&Uuml; 	\u00DC
 	&uuml; 	\u00FC
 	&Ntilde; 	\u00D1
 	&ntilde; 	\u00F1
******************************/