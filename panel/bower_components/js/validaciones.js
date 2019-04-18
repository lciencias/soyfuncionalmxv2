var baseUrl = $("#baseUrl").val();
$(document).ready(function() {

    $(document).delegate(".submit", "click", function(e) {
        var i = 0;
        $('#procesando').html(procesando);
        setTimeout(function() {
            i++;
        }, 500);
    });

    /*$(".datetimepicker").datetimepicker({
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
*/
    $("#fechaInicio").on(
        "dp.change",
        function(e) {
            $('#fechaFinal').data("DateTimePicker")
                .minDate(e.date);
        });

    //Usuarios

    var formUser = $('validateFormUsuario');
    formUser.on('submit', function(e) {
        e.preventDefault();
    });

    $('#validateFormUsuario')
        .bootstrapValidator({
            message: 'Campo obligatorio',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: letras,
                            message: 'El campo es s&oacute;lo para letras'
                        },
                        stringLength: {
                            min: 6,
                            max: 50,
                            message: 'Minimo 6 y maximo 50 caracteres'
                        }
                    }
                },
                email: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: correo,
                            message: 'El campo s&oacute;lo permite correo electr&oacute;nico'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'Minimo 3 y maximo 30  caracteres'
                        }
                    }
                },
                passwordS: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: alfanum,
                            message: 'El campo s&oacute;lo permite letras y numeros'
                        },
                        stringLength: {
                            min: 8,
                            max: 20,
                            message: 'Minimo 8 y maximo 20  caracteres'
                        }
                    }
                }
            }
        });


    // Slider
    var formUser = $('validateFormSlider');
    formUser.on('submit', function(e) {
        e.preventDefault();
    });

    $('#validateFormSlider')
        .bootstrapValidator({
            message: 'Campo obligatorio',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombre: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: letras,
                            message: 'El campo es s&oacute;lo para letras'
                        },
                        stringLength: {
                            min: 6,
                            max: 50,
                            message: 'Minimo 6 y maximo 50 caracteres'
                        }
                    }
                }
            }
        });

    // Categoria

    var formUser = $('validateFormCategoria');
    formUser.on('submit', function(e) {
        e.preventDefault();
    });

    $('#validateFormCategoria')
        .bootstrapValidator({
            message: 'Campo obligatorio',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombre: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: alfanum,
                            message: 'El campo es s&oacute;lo para letras y n&uacute;meros'
                        },
                        stringLength: {
                            min: 6,
                            max: 150,
                            message: 'Minimo 6 y maximo 150 caracteres'
                        }
                    }
                },
                orden: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: numericos,
                            message: 'El campo es s&oacute;lo para numeros'
                        },
                        stringLength: {
                            min: 1,
                            max: 3,
                            message: 'Minimo 1 y maximo 3  caracteres'
                        }
                    }
                }
            }
        });

    // Producto
    var formUser = $('validateFormProducto');
    formUser.on('submit', function(e) {
        e.preventDefault();
    });

    $('#validateFormProducto')
        .bootstrapValidator({
            message: 'Campo obligatorio',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                producto: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: letras,
                            message: 'El campo es s&oacute;lo para letras'
                        },
                        stringLength: {
                            min: 4,
                            max: 150,
                            message: 'Minimo 4 y maximo 150 caracteres'
                        }
                    }
                },
                caloria: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: alfanum,
                            message: 'El campo es s&oacute;lo para letras y numeros'
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: 'Minimo 3 y maximo 20 caracteres'
                        }
                    }
                },
                precio: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: decimales,
                            message: 'El campo es s&oacute;lo numeros'
                        },
                        stringLength: {
                            min: 1,
                            max: 8,
                            message: 'Minimo 2 y maximo 8 caracteres'
                        }
                    }
                },
                orden: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: numericos,
                            message: 'El campo es s&oacute;lo para numeros'
                        },
                        stringLength: {
                            min: 1,
                            max: 3,
                            message: 'Minimo 1 y maximo 3  caracteres'
                        }
                    }
                }
            }
        });

    // Testimonial

    var form = $('validateFormTestimonial');
    form.on('submit', function(e) {
        e.preventDefault();
    });

    $('#validateFormTestimonial')
        .bootstrapValidator({
            message: 'Campo obligatorio',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombreVisitante: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: letras,
                            message: 'El campo es s&oacute;lo para letras'
                        },
                        stringLength: {
                            min: 3,
                            max: 70,
                            message: 'Minimo 3 y maximo 70 caracteres'
                        }
                    }
                },
                testimonial: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: alfanum,
                            message: 'El campo es s&oacute;lo para letras y numeros'
                        },
                        stringLength: {
                            min: 3,
                            max: 120,
                            message: 'Minimo 3 y maximo 120 caracteres'
                        }
                    }
                }
            }
        });

    //Evento Preguntas
    var form = $('validateFormPregunta');
    form.on('submit', function(e) {
        e.preventDefault();
    });

    $('#validateFormPregunta')
        .bootstrapValidator({
            message: 'Campo obligatorio',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                pregunta: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: letras,
                            message: 'El campo es s&oacute;lo para letras'
                        },
                        stringLength: {
                            min: 6,
                            max: 100,
                            message: 'Minimo 3 y maximo 100 caracteres'
                        }
                    }
                },
                respuesta: {
                    message: 'Campo obligatorio',
                    validators: {
                        notEmpty: {
                            message: 'Campo obligatorio'
                        },
                        regexp: {
                            regexp: alfanum,
                            message: 'El campo es s&oacute;lo para letras y numeros'
                        },
                        stringLength: {
                            min: 6,
                            max: 300,
                            message: 'Minimo 6 y maximo 300 caracteres'
                        }
                    }
                }
            }
        });
}); // Fin de jquery