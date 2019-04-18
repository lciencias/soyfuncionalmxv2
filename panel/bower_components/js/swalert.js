var noRedes;
var cargos;
var noCargos = 50;
var contadorCargo = 0;
var arrayCargos;
var cargos = new Object();
var lon = 50;
var procesando = " P R O C E S A N D O . . . . .";
$(function() {
    "use strict";
    var SweetAlert = function() {};
    SweetAlert.prototype.init = function() {
            //Evento nuevo Usuario
            $(document).on("click", "#nuevoUsuario", function(e) {
                var baseUrl = $("#baseUrl").val();
                var name = $("#name").val();
                var email = $("#email").val();
                var password = $("#passwordS").val();
                var idT = $("#idT").val();
                var id = $("#id").val();
                if (name.length >= 6 && email.length >= 6 && valEmail(email) &&
                    password.length >= 8 && parseInt(idT) === 1) {
                    swal({
                        title: "Desea guardar el registro?",
                        text: "Soy Funcional MX",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: "Guardar",
                        closeOnConfirm: false
                    }, function() {
                        var url = "guardaDatos.php";
                        var formData = new FormData();
                        formData.append("id", id);
                        formData.append("name", name);
                        formData.append("email", email);
                        formData.append("password", password);
                        formData.append("idT", $("#idT").val());
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#procesando').html(procesando);
                            },
                            success: function(data) {
                                $('#procesando').html("");
                                if (parseInt(data.exito) === 1) {
                                    swal("Registrado", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 1500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });

            //Evento crearSlider
            $(document).on("click", "#crearSlider", function(e) {
                var baseUrl = $("#baseUrl").val();
                var nombre = $("#nombre").val();
                var orden = $("#orden").val();
                var id = $("#id").val();
                var texto_corto = $("#texto_corto").val();
                var texto_grande = $("#texto_grande").val();
                var texto_boton = $("#texto_boton").val();
                var texto_url = $("#texto_url").val();
                var fileImg = $("#imagen")[0].files[0];
                var fileImgM = $("#imagenM")[0].files[0];
                var idT = $("#idT").val();
                if (nombre.length >= 6 && parseInt(orden) > 0 && parseInt(idT) === 2) {
                    swal({
                        title: "Desea guardar el registro?",
                        text: "Soy Funcional MX",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: "Guardar",
                        closeOnConfirm: false
                    }, function() {
                        var url = "guardaDatos.php";
                        var formData = new FormData();
                        formData.append("id", id);
                        formData.append("nombre", nombre);
                        formData.append("orden", orden);
                        formData.append("texto_corto", texto_corto);
                        formData.append("texto_grande", texto_grande);
                        formData.append("texto_boton", texto_boton);
                        formData.append("texto_url", texto_url);
                        formData.append("idT", $("#idT").val());
                        formData.append('image', $("#imagen")[0].files[0]);
                        formData.append('imageM', $("#imagenM")[0].files[0]);
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#procesando').html(procesando);
                            },
                            success: function(data) {
                                $('#procesando').html("");
                                if (parseInt(data.exito) === 1) {
                                    swal("Registrado", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 1500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });


            // Evento  nuevoCategoria
            $(document).on("click", "#nuevoCategoria", function(e) {
                var baseUrl = $("#baseUrl").val();
                var id = $("#id").val();
                var nombre = $("#nombreC").val();
                var orden = $("#orden").val();
                var idT = $("#idT").val();
                if (nombre.length >= 6 && parseInt(orden) > 0 && parseInt(idT) === 3) {
                    swal({
                        title: "Desea guardar el registro?",
                        text: "Soy Funcional MX",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: "Guardar",
                        closeOnConfirm: false
                    }, function() {
                        var url = "guardaDatos.php";
                        var formData = new FormData();
                        formData.append("id", id);
                        formData.append("nombre", nombre);
                        formData.append("orden", orden);
                        formData.append("idT", $("#idT").val());
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#procesando').html(procesando);
                            },
                            success: function(data) {
                                $('#procesando').html("");
                                if (parseInt(data.exito) === 1) {
                                    swal("Registrado", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 1500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });

            //Evento nuevoProducto
            $(document).on("click", "#nuevoProducto", function(e) {
                var baseUrl = $("#baseUrl").val();
                var id = $("#id").val();
                var idcategoria = $("#idcategoria").val();
                var producto = $("#producto").val();
                var caloria = $("#caloria").val();
                var precio = $("#precio").val();
                var orden = $("#orden").val();
                var fileImg = $("#fileImgProd")[0].files[0];
                var idT = $("#idT").val();
                if (parseInt(idcategoria) > 0 && producto.length >= 4 && caloria.length >= 3 &&
                    precio.length >= 2 && parseInt(orden) > 0 && parseInt(idT) === 4) {
                    swal({
                        title: "Desea guardar el registro?",
                        text: "Soy Funcional MX",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: "Guardar",
                        closeOnConfirm: false
                    }, function() {
                        var url = "guardaDatos.php";
                        var formData = new FormData();
                        formData.append("id", id);
                        formData.append("idcategoria", idcategoria);
                        formData.append("producto", producto);
                        formData.append("orden", orden);
                        formData.append("caloria", caloria);
                        formData.append("precio", precio);
                        formData.append("idT", $("#idT").val());
                        formData.append('image', $("#fileImgProd")[0].files[0]);
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#procesando').html(procesando);
                            },
                            success: function(data) {
                                $('#procesando').html("");
                                if (parseInt(data.exito) === 1) {
                                    swal("Registrado", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 1500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });

            //Evento nuevoTestimonial
            $(document).on("click", "#nuevoTestimonial", function(e) {
                var baseUrl = $("#baseUrl").val();
                var id = $("#id").val();
                var nombre = $("#nombreVisitante").val();
                var testimonial = $("#testimonial").val();
                var idT = $("#idT").val();
                if (nombre.length >= 6 && testimonial.length >= 6 &&
                    parseInt(idT) === 6) {
                    swal({
                        title: "Desea guardar el registro?",
                        text: "Soy Funcional MX",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: "Guardar",
                        closeOnConfirm: false
                    }, function() {
                        var url = "guardaDatos.php";
                        var formData = new FormData();
                        formData.append("id", id);
                        formData.append("nombre", nombre);
                        formData.append("testimonial", testimonial);
                        formData.append("idT", $("#idT").val());
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#procesando').html(procesando);
                            },
                            success: function(data) {
                                $('#procesando').html("");
                                if (parseInt(data.exito) === 1) {
                                    swal("Registrado", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 1500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });
            // Evento nuevoPregunta
            $(document).on("click", "#nuevoPregunta", function(e) {
                var baseUrl = $("#baseUrl").val();
                var id = $("#id").val();
                var pregunta = $("#pregunta").val();
                var respuesta = $("#respuesta").val();
                var idT = $("#idT").val();
                if (pregunta.length >= 6 && respuesta.length >= 6 &&
                    parseInt(idT) === 7) {
                    swal({
                        title: "Desea guardar el registro?",
                        text: "Soy Funcional MX",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: "Guardar",
                        closeOnConfirm: false
                    }, function() {
                        var url = "guardaDatos.php";
                        var formData = new FormData();
                        formData.append("id", id);
                        formData.append("pregunta", pregunta);
                        formData.append("respuesta", respuesta);
                        formData.append("idT", $("#idT").val());
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#procesando').html(procesando);
                            },
                            success: function(data) {
                                $('#procesando').html("");
                                if (parseInt(data.exito) === 1) {
                                    swal("Registrado", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 1500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });


            $(document).on("click", ".mostrar", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'mostrar-registro.php';
                var titulo = "Desea activar el testimonial?";
                var tituloB = "Activar";
                if (parseInt(tmp[2]) === 7) {
                    titulo = "Desea mostrar la pregunta?";
                    tituloB = "Mostrar";
                }

                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    swal({
                        title: titulo,
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: tituloB,
                        closeOnConfirm: false
                    }, function() {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            dataType: 'json',
                            data: dataString,
                            beforeSend: function() {},
                            success: function(data) {
                                if (parseInt(data.exito) === 1) {
                                    swal("Activado!", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 2500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                error("Error");
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });

            $(document).on("click", ".eliminar", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'eliminar-registro.php';
                var titulo = "Desea eliminar el registro?";
                var tituloB = "Eliminar";
                if (parseInt(tmp[2]) === 5) {
                    var titulo = "Desea cerrar el pedido?";
                    var tituloB = "Cerrar Pedido";
                }
                if (parseInt(tmp[2]) === 7) {
                    var titulo = "Desea mostrar la pregunta?";
                    var tituloB = "Mostrar Pregunta";
                }
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    swal({
                        title: titulo,
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#f8b32d",
                        confirmButtonText: tituloB,
                        closeOnConfirm: false
                    }, function() {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            dataType: 'json',
                            data: dataString,
                            beforeSend: function() {
                                //$('#procesando').html(procesando);
                            },
                            success: function(data) {
                                if (parseInt(data.exito) === 1) {
                                    swal("Eliminado!", data.msg, "success");
                                    setTimeout(function() {
                                        location.href = baseUrl + data.url;
                                    }, 2500);
                                } else {
                                    swal("Error", data.msg, "error");
                                }
                                return false;
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                error("Error");
                                return false;
                            },
                            complete: function() {}
                        });
                    });
                }
                return false;
            });

            $(".ordenar").on('change', function(e) {
                var div = $(this).attr('id');
                var val = $(this).val();
                var tmp = div.split('-');
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'ordenar-registro.php';
                var dataString = "";
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0 && parseInt(val) > 0) {
                    dataString = 'id=' + tmp[1] + '&valor=' + val + '&idModulo=' + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {},
                        success: function(data) {
                            if (parseInt(data.exito) === 1) {
                                swal("Ok", data.msg, "success");
                            } else {
                                swal("Error", data.msg, "error");
                            }
                            return false;
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            return false;
                        },
                        complete: function() {}
                    });
                }
            });

            $('#sa-warning,.sa-warning').on('click', function(e) {
                swal({
                    title: "Desea eliminar el registro?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f8b32d",
                    confirmButtonText: "Eliminar",
                    closeOnConfirm: false
                }, function() {
                    swal("Ã‚Â¡Eliminado!", "El registro ha sido eliminado.", "success");
                });
            });

            /***Slider***/
            $('#crearSlider').on('click', function(e) {
                var errores = "";
                var noErrores = 0;
                if (String($("#nombre").val()) == "") {
                    errores += "Debe registrar el nombre del Banner\n";
                    noErrores++;
                }
                if (String($("#fileImg").val()) == "") {
                    errores += "Debe seleccionar la imagen del Banner\n";
                    noErrores++;
                }
                if (noErrores > 0) {
                    swal({
                        title: "Soy Funcional MX",
                        type: "error",
                        text: errores,
                        confirmButtonColor: "#4aa23c",
                    });
                    return false;
                }
                return true;

            });

            $('#editarSlider').on('click', function(e) {
                var errores = "";
                var noErrores = 0;
                if (String($("#nombre").val()) == "") {
                    errores += "Debe registrar el nombre del Banner\n";
                    noErrores++;
                }
                if (parseInt($("#idimagen").val()) == 0) {
                    errores += "Debe seleccionar la imagen del Banner\n";
                    noErrores++;
                }
                if (noErrores > 0) {
                    swal({
                        title: "Soy Funcional MX",
                        type: "error",
                        text: errores,
                        confirmButtonColor: "#4aa23c",
                    });
                    return false;
                }
                return true;

            });

            /****************/
            $('.cancelaRegistro').on('click', function(e) {
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + $(this).attr('id');
                swal({
                    title: "Desea salir del formulario sin guardar?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#4aa23c",
                    confirmButtonText: "Si",
                    closeOnConfirm: false
                }, function() {
                    location.href = url;
                });
                return false;
            });

            //Ordenar Slider
            $(".ordenslide").on('change', function(e) {
                var div = $(this).attr('id');
                var val = $(this).val();
                var tmp = div.split('-');
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'orden-slider.php';
                var dataString = "";
                if (parseInt(tmp[1]) > 0 && parseInt(val) > 0) {
                    dataString = 'id=' + tmp[1] + "&valor=" + val;
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {},
                        success: function(data) {
                            if (parseInt(data.exito) === 1) {
                                swal("Ok", data.msg, "success");
                            } else {
                                swal("Error", data.msg, "error");
                            }
                            return false;
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            return false;
                        },
                        complete: function() {}
                    });
                }
            });

            $(".modales").on('click', function(e) {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                $("#idDoc").val(tmp[1]);
                $("#myModal").modal('show');
            });
            /**** Editar  ****/
            $(document).on("click", ".modificarU", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'edita-registro.php';
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {
                            $('#procesando').html(procesando);
                        },
                        success: function(data) {
                            $('#procesando').html("");
                            if (parseInt(data.regs.id) > 0) {
                                $("#myModalLabel").html("Actualiza Usuario");
                                $("#idT").val(tmp[2]);
                                $("#id").val(data.regs.id);
                                $("#name").val(data.regs.name);
                                $("#email").val(data.regs.email);
                                $("#passwordS").val(data.regs.passwordS);
                                $("#titBtn").html("Actualizar");
                                $("#modal" + tmp[2]).modal('show');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            error("Error");
                            return false;
                        }
                    });
                }
                return false;
            });


            $(document).on("click", ".modificarS", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'edita-registro.php';
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {
                            $('#procesando').html(procesando);
                        },
                        success: function(data) {
                            $('#procesando').html("");
                            if (parseInt(data.regs.idslide) > 0) {
                                $("#myModalLabel").html("Actualiza Banner");
                                $("#idT").val(tmp[2]);
                                $("#id").val(data.regs.idslide);
                                $("#nombre").val(data.regs.nombre);
                                $("#orden").val(data.regs.orden);
                                $("#texto_corto").val(data.regs.texto_corto);
                                $("#texto_grande").val(data.regs.texto_grande);
                                $("#texto_url").val(data.regs.url);
                                $("#texto_boton").val(data.regs.texto_boton);
                                $("#titBtn").html("Actualizar");
                                $("#modal" + tmp[2]).modal('show');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            error("Error");
                            return false;
                        }
                    });
                }
                return false;
            });

            $(document).on("click", ".modificarC", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'edita-registro.php';
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {
                            $('#procesando').html(procesando);
                        },
                        success: function(data) {
                            $('#procesando').html("");
                            if (parseInt(data.regs.id) > 0) {
                                $("#myModalLabel").html("Actualiza Categoria");
                                $("#idT").val(tmp[2]);
                                $("#id").val(data.regs.id);
                                $("#nombreC").val(data.regs.nombre);
                                $("#orden").val(data.regs.orden);
                                $("#titBtn").html("Actualizar");
                                $("#modal" + tmp[2]).modal('show');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            error("Error");
                            return false;
                        }
                    });
                }
                return false;
            });

            $(document).on("click", ".modificarP", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'edita-registro.php';
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {
                            $('#procesando').html(procesando);
                        },
                        success: function(data) {
                            $('#procesando').html("");
                            if (parseInt(data.regs.id) > 0) {
                                $("#myModalLabel").html("Actualiza Producto");
                                $("#idT").val(tmp[2]);
                                $("#id").val(data.regs.id);
                                $("#idcategoria").val(data.regs.idcategoria);
                                $("#producto").val(data.regs.producto);
                                $("#orden").val(data.regs.orden);
                                $("#caloria").val(data.regs.caloria);
                                $("#precio").val(data.regs.precio);
                                $("#titBtn").html("Actualizar");
                                $("#modal" + tmp[2]).modal('show');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            error("Error");
                            return false;
                        }
                    });
                }
                return false;
            });


            $(document).on("click", ".modificarT", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'edita-registro.php';
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {
                            $('#procesando').html(procesando);
                        },
                        success: function(data) {
                            $('#procesando').html("");
                            if (parseInt(data.regs.id) > 0) {
                                $("#myModalLabel").html("Actualiza Testimonial");
                                $("#idT").val(tmp[2]);
                                $("#id").val(data.regs.id);
                                $("#nombreVisitante").val(data.regs.nombre);
                                $("#testimonial").val(data.regs.testimonial);
                                $("#titBtn").html("Actualizar");
                                $("#modal" + tmp[2]).modal('show');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            error("Error");
                            return false;
                        }
                    });
                }
                return false;
            });


            $(document).on("click", ".modificarA", function() {
                var div = $(this).attr('id');
                var tmp = div.split('-');
                var dataString = '';
                var baseUrl = $("#baseUrl").val();
                var url = baseUrl + 'edita-registro.php';
                if (parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0) {
                    dataString = 'id=' + tmp[1] + "&idModulo=" + tmp[2];
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: dataString,
                        beforeSend: function() {
                            $('#procesando').html(procesando);
                        },
                        success: function(data) {
                            $('#procesando').html("");
                            if (parseInt(data.regs.id) > 0) {
                                $("#myModalLabel").html("Actualiza Pregunta");
                                $("#idT").val(tmp[2]);
                                $("#id").val(data.regs.id);
                                $("#pregunta").val(data.regs.pregunta);
                                $("#respuesta").val(data.regs.respuesta);
                                $("#titBtn").html("Actualizar");
                                $("#modal" + tmp[2]).modal('show');
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            error("Error");
                            return false;
                        }
                    });
                }
                return false;
            });


        },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert;

    $.SweetAlert.init();
});


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