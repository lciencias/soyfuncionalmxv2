var baseUrl = $("#baseUrl").val();
$(document).ready(function() {
 
    $('.summernote').summernote({height: 180});
    $(document).delegate(".submit", "click", function(e) {
	var i = 0;
	$('#procesando').html(procesando);
			setTimeout(function() {
			    i++;
			}, 500);
		    });

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

		    $("#fechaInicio").on(
			    "dp.change",
			    function(e) {
				$('#fechaFinal').data("DateTimePicker")
					.minDate(e.date);
			    });

		    // Slider
		    var formUser = $('validateFormSlider');
		    formUser.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormSlider')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 6,
							max : 50,
							message : 'Minimo 6 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    // Delegacion

		    var formUser = $('validateFormDelegacion');
		    formUser.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormDelegacion')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n&uacute;meros'
						    },
						    stringLength : {
							min : 6,
							max : 150,
							message : 'Minimo 6 y maximo 150 caracteres'
						    }
						}
					    },
					    idestado : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : numericos,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 1,
							max : 2,
							message : 'Minimo 1 y maximo 2 caracteres'
						    }
						}
					    }
					}
				    });

		    // Comite
		    var formUser = $('validateFormComite');
		    formUser.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormComite')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 6,
							max : 150,
							message : 'Minimo 6 y maximo 150 caracteres'
						    }
						}
					    },
					    presidente : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 6,
							max : 50,
							message : 'Minimo 6 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    // Expresidente

		    var form = $('validateFormExPresidente');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormExPresidente')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nomesa : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n�meros'
						    },
						    stringLength : {
							min : 1,
							max : 70,
							message : 'Minimo 1 y maximo 70 caracteres'
						    }
						}
					    },
					    presidente : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 50,
							message : 'Minimo 3 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    // Presidente
		    var form = $('validateFormPresidente');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormPresidente')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nomesa : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n�meros'
						    },
						    stringLength : {
							min : 1,
							max : 70,
							message : 'Minimo 1 y maximo 70 caracteres'
						    }
						}
					    },
					    presidente : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 50,
							message : 'Minimo 3 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    // Presidente
		    var form = $('validateFormPresidente');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormPresidente')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nomesa : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n�meros'
						    },
						    stringLength : {
							min : 1,
							max : 70,
							message : 'Minimo 1 y maximo 70 caracteres'
						    }
						}
					    },
					    presidente : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 50,
							message : 'Minimo 3 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    // Cargo
		    var form = $('validateFormCargo');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormCargo')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para car&aacute;cteres alfanumericos'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    },
					    cargo : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para car&aacute;cteres alfanumericos'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    }
					}
				    });

		    // Coordinador
		    var form = $('validateFormCoordinador');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormCoordinador')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    },
					    coordinacion : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    }
					}
				    });

		    // Biblioteca
		    var form = $('validateFormBiblioteca');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormBiblioteca')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    subcarpeta : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n&uacute;meros'
						    },
						    stringLength : {
							min : 3,
							max : 200,
							message : 'Minimo 3 y maximo 20 caracteres'
						    }
						}
					    }
					}
				    });
		    // Revista
		    var form = $('validateFormRevista');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormRevista')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    titulo : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n&uacute;meros'
						    },
						    stringLength : {
							min : 3,
							max : 120,
							message : 'Minimo 3 y maximo 120 caracteres'
						    }
						}
					    },
					    periodo : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y n&uacute;meros'
						    },
						    stringLength : {
							min : 3,
							max : 50,
							message : 'Minimo 3 y maximo 20 caracteres'
						    }
						}
					    }
					}
				    });

		    // biblioteca
		    var form = $('validateFormSubcarpetaAmivtac');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormSubcarpetaAmivtac')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    subcarpeta : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : carpeta,
							message : 'El campo es s&oacute;lo para letras y n&uacute;meros'
						    },
						    stringLength : {
							min : 3,
							max : 500,
							message : 'Minimo 3 y maximo 500 caracteres'
						    }
						}
					    }
					}
				    });

		    // Socios
		    var form = $('validateFormSocio');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormSocio')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    },
					    anio : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : fecha,
							message : 'Campo de fecha'
						    },
						    stringLength : {
							min : 4,
							max : 4,
							message : 'El campo es de 10 caracteres'
						    }
						}
					    }
					}
				    });

		    // Acuerdos
		    var form = $('validateFormAcuerdo');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormAcuerdo')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 200,
							message : 'Minimo 3 y maximo 200 caracteres'
						    }
						}
					    },
					    url : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : url,
							message : 'Favor de teclear una url correcta'
						    },
						    stringLength : {
							min : 5,
							max : 250,
							message : 'Minimo 5 y maximo 250 caracteres'
						    }
						}
					    },
					    texto : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y numeros'
						    },
						    stringLength : {
							min : 3,
							max : 999,
							message : 'Minimo 3 y maximo 999 caracteres'
						    }
						}
					    }
					}
				    });

		    // Eventos
		    var form = $('validateFormEvento');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormEvento')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    titulo : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    },
					    fecha_evento : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : fecha,
							message : 'Campo de fecha'
						    },
						    stringLength : {
							min : 19,
							max : 20,
							message : '19 caracteres'
						    }
						}
					    },
					    lugar : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y numero'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    },
					    descripcion : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y numeros'
						    },
						    stringLength : {
							min : 3,
							max : 500,
							message : 'Minimo 3 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    //Noticias
		    //validateFormNoticia
		    var form = $('validateFormNoticia');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormNoticia')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    titulo : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 100,
							message : 'Minimo 3 y maximo 100 caracteres'
						    }
						}
					    },
					    fecha_noticia : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : fecha,
							message : 'Campo de fecha'
						    },
						    stringLength : {
							min : 19,
							max : 20,
							message : '19 caracteres'
						    }
						}
					    },
					    descripcion : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras y numeros'
						    },
						    stringLength : {
							min : 3,
							max : 500,
							message : 'Minimo 3 y maximo 50 caracteres'
						    }
						}
					    }
					}
				    });

		    // Vinculos

		    var form = $('validateFormVinculo');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormVinculo')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 200,
							message : 'Minimo 3 y maximo 200 caracteres'
						    }
						}
					    },
					    url : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : url,
							message : 'Favor de teclear una url correcta'
						    },
						    stringLength : {
							min : 5,
							max : 250,
							message : 'Minimo 5 y maximo 250 caracteres'
						    }
						}
					    }
					}
				    });
		    //Becas
		    
		    var form = $('validateFormBeca');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormBeca')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : alfanum,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 200,
							message : 'Minimo 3 y maximo 200 caracteres'
						    }
						}
					    },
					    url : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp : url,
							message : 'Favor de teclear una url correcta'
						    },
						    stringLength : {
							min : 5,
							max : 250,
							message : 'Minimo 5 y maximo 250 caracteres'
						    }
						}
					    }
					}
				    });
		    
		    //capitulos estados
		    var form = $('validateFormCapEstado');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormCapEstado')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    idestado : {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp :  numericos,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 1,
							max : 2,
							message : ''
						    }
						}
					    }
					}
				    });
		    //capitulos 
		    var form = $('validateFormCap');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormCap')
			    .bootstrapValidator(
				    {
					message : 'Campo obligatorio',
					feedbackIcons : {
					    valid : 'glyphicon glyphicon-ok',
					    invalid : 'glyphicon glyphicon-remove',
					    validating : 'glyphicon glyphicon-refresh'
					},
					fields : {
					    nombre: {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp :  letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 128,
							message : ''
						    }
						}
					    },
					    presidente: {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp :  letras,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 3,
							max : 128,
							message : ''
						    }
						}
					    },
					    fecha_toma: {
						message : 'Campo obligatorio',
						validators : {
						    notEmpty : {
							message : 'Campo obligatorio'
						    },
						    regexp : {
							regexp :  fecha,
							message : 'El campo es s&oacute;lo para letras'
						    },
						    stringLength : {
							min : 10,
							max : 10,
							message : ''
						    }
						}
					    }

					    
					}
					
				    });

		    //capitulos inicio
		    
		    var form = $('validateFormCapInicio');
		    form.on('submit', function(e) {
			e.preventDefault();
		    });

		    $('#validateFormCapInicio').bootstrapValidator({
			message : 'Campo obligatorio',
			feedbackIcons : {
			    valid : 'glyphicon glyphicon-ok',
			    invalid : 'glyphicon glyphicon-remove',
			    validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
			    texto: {
				message : 'Campo obligatorio',
					validators : {
					    notEmpty : {
						message : 'Campo obligatorio'
					},
					/*regexp : {
					    regexp :  alfanum,
					    message : 'El campo es s&oacute;lo para letras'
					},
					stringLength : {
					    min : 3,
					    max : 1250,
					    message : ''
					}*/
				    }
			    	}
			    }					
			});
		    
		    
	$("#agregaNot").click(function(){	  
	    var ids      = $("#ids").val();
	    var tmp      = ids.split('|');
	    var idsN     = $("#nom").val();
	    var valor    = $("#idnoticia1").val();	    
	    var texto    = $('select[name="idnoticia1"] option:selected').text();
	    var cadena   = "";
	    var cadenaN  = "";
	    if(parseInt(valor) > 0){
		if(tmp.lastIndexOf(valor) === -1){
		    cadena += ids+valor+"|";
		    cadenaN+= idsN+texto+"|";
		    tmp.push(valor);
		    $("#ids").val(cadena);
		    $("#nom").val(cadenaN);
		}		
	    }
	    muestraTabla();
	 });
	

}); // Fin de jquery

/*****************************/

function elimina(valor){        
    var ids      = $("#ids").val();    
    var idsN     = $("#nom").val();
    var tmp      = ids.split('|');
    var tmn      = idsN.split('|');
    var paso;
    var cadena   = "";
    var cadenaN  = "";
    if(parseInt(valor) > 0){	
	for (x=0; x < (tmp.length-1); x++){
	    if(String(tmp[x]) !== ''){
		if(parseInt(tmp[x]) === parseInt(valor)){
		    tmp[x] = '';
		   // tmp.splice(x, 1);
		}
	    }
	}
	for (x=0; x < tmp.length; x++){
	    if(String(tmp[x]) !== ''){
		cadena += tmp[x]+"|";
		cadenaN+= tmn[x]+"|";
	    }
	}
	$("#ids").val(cadena);
	$("#nom").val(cadenaN);
	muestraTabla();
    }
}



function muestraTabla(){
    var ids    = $("#ids").val();
    var nom    = $("#nom").val();
    var tmp    = ids.split('|');
    var tmn    = nom.split('|');
    var buffer = "";
    $("#noticiasLista").html("");
    if( tmp.length > 0){
	buffer = "<table class='table table-bordered'>" +
	   	 "<thead><tr style='background-color:#e5e5e5;'>" +
		 "<th width='80%'>Titulo Noticia</th>" +
		 "<th width='10%'>Elimina</th>" +
		 "</tr></thead><tbody>";
	for (x=0; x < tmp.length; x++){
	    if(String(tmp[x]) !== ''){
		buffer += "<tr>" +
			"<td>"+tmn[x]+"</td>" +
			"<td><button type='button' name='"+tmp[x]+"' id='"+tmp[x]+"' " +
			"class='btn btn-default btn-sm' onclick='elimina("+tmp[x]+");return false;'><span class='glyphicon glyphicon-trash'></span></button>" +
			"</td></tr>";
	    }
	}
	buffer+="</tbody></table>";
    }
    $("#noticiasLista").html(buffer);   
}