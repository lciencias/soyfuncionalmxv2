
var noRedes;
var cargos;
var noCargos = 50;
var contadorCargo = 0;
var arrayCargos;
var cargos = new Object();
var  lon = 50;
$(function() {
	"use strict";
	if ( $("#undiv").length > 0 ){
		lon = parseInt($("#noredes").val()) + 1;
	}
	noRedes = new Array(lon);
	arrayCargos = new Array(noCargos);
	for(var i=0; i < lon; i++){
		noRedes[i] = "";
	}			
	if($("#redes").length > 0 && String($("#redes").val()) !== ''){
		var cadenaRedes =$("#redes").val().split('|');
		for (var h = 0; h< cadenaRedes.length; h++){
			if(String(cadenaRedes[h]) !== ''){
				var cadenaDatos = cadenaRedes[h].split('*');
				noRedes[cadenaDatos[0]] = cadenaDatos[1];
			}			
		}		
	}
	
	for(var j=0; j < noCargos; j++){
		arrayCargos[j] = "";
	}

	if($("#cargos").length > 0 && String($("#cargos").val()) !== ''){
		var cadenaCargos =$("#cargos").val().split('|');
		var cadenaHtml = "";
		$("#bodyid").empty();
		for (var w = 0; w< cadenaCargos.length; w++){
			if(String(cadenaCargos[w]) !== ''){			
				var cadenaDatos = cadenaCargos[w].split('#');
				arrayCargos[cadenaDatos[0]] = cadenaDatos[0]+"#"+cadenaDatos[1]+"#"+cadenaDatos[2];
				cadenaHtml  = "<tr><td>"+cadenaDatos[0]+"</td><td>"+cadenaDatos[1]+"</td><td>"+cadenaDatos[2]+"</td>" +
				"<td><img src='"+baseUrl+"lib/dist/img/icons/editar.png' id='m-"+cadenaDatos[0]+"' onclick='editaDatos("+cadenaDatos[0]+");' class='editaCargo' style='cursor:pointer;'></td>" +
				"<td><img src='"+baseUrl+"lib/dist/img/sweetalert/eliminar.png' id='e-"+cadenaDatos[0]+"' onclick='eliminaDatos("+cadenaDatos[0]+");' class='eliminaCargo' style='cursor:pointer;'></a></td>" +
				"</tr>";
				$("#footable_2").append(cadenaHtml);    	
				contadorCargo++;
			}			
		}		
	}

	var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        
    //Basic
    $('#sa-basic').on('click',function(e){
	    swal({   
			title: "Here's a message!",   
            confirmButtonColor: "#0098a3",   
        });
		return false;
    });

    //A title with a text under
    $('#sa-title').on('click',function(e){
	    swal({   
			title: "Here's a message!",   
            text: "Lorem ipsum dolor sit amet",
			confirmButtonColor: "#0098a3",   
        });
		return false;
    });

    $("#guardaRed").on('click',function(e){
    	var cadena="";
    	var tId = $("#recipient-id").val();
    	var tNm = $("#recipient-name").val();
    	if( (parseInt(tId)>0 ) && String(tNm)!== ''){
    		noRedes[tId] = tNm;
    	}else{
    		noRedes[tId] = "";
    	}
    	//recorre array
    	for(var i=0; i < lon; i++){
    		if(String(noRedes[i]) !== ''){
    			cadena+= i+"*"+noRedes[i]+"|";
    		}    		
    	}
    	$("#redes").val(cadena);
		$("#responsive-modal").modal('hide');
    });
    
    $("#actualizaMesa").on('click',function(e){
    	var cadenaCargo  = "";
    	var cadenaHtml   = "";    	
    	var noComite     = $("#idComiteCargo").val();
    	var nombreComite = $("#nombreComite").val();
    	var cargoComite  = $("#cargoComite").val();
    	if( (String(nombreComite) !== '') && (String(cargoComite) !== '') ){    		
    		arrayCargos[noComite] = noComite+"#"+nombreComite+"#"+cargoComite;
    		$("#bodyid").empty();
    		var contadorCargo = 1;
    		for(var k=0; k < noCargos; k++){
    			if(String(arrayCargos[k]) !== ''){
    				var tmp     = arrayCargos[k].split('#');    			
    				cadenaCargo+= arrayCargos[k]+"|";
    				cadenaHtml  = "<tr><td>"+contadorCargo+"</td><td>"+tmp[1]+"</td><td>"+tmp[2]+"</td>" +
    				"<td><img src='"+baseUrl+"lib/dist/img/icons/editar.png' id='m-"+tmp[0]+"' onclick='editaDatos("+tmp[0]+");' class='editaCargo' style='cursor:pointer;'></td>" +
    				"<td><img src='"+baseUrl+"lib/dist/img/sweetalert/eliminar.png' id='e-"+tmp[0]+"' onclick='eliminaDatos("+tmp[0]+");' class='eliminaCargo' style='cursor:pointer;'></a></td>" +
    				"</tr>";
    				contadorCargo++;
    				$("#footable_2").append(cadenaHtml);    			
    			}    		
    		}
    		$("#cargos").val(cadenaCargo);
    		$("#editor-modal").modal('hide');
    	}
    });
    
    $("#guardaMesa").on('click',function(e){
    	var cadenaCargo  = "";
    	var cadenaHtml   = "";    	
    	var noComite = $("#idComiteCargo").val();
    	var nombreComite = $("#nombreComite").val();
    	var cargoComite  = $("#cargoComite").val();
    	if( (String(nombreComite) !== '') && (String(cargoComite) !== '') ){    		
    		contadorCargo++;
    		if(parseInt(noComite) === 0){
    			arrayCargos[contadorCargo] = contadorCargo+"#"+nombreComite+"#"+cargoComite;
    		}else{
    			arrayCargos[noComite] = noComite+"#"+nombreComite+"#"+cargoComite;
    		}
    		$("#bodyid").empty();
    		for(var k=0; k < noCargos; k++){
    			if(String(arrayCargos[k]) !== ''){
    				var tmp     = arrayCargos[k].split('#');    			
    				cadenaCargo+= arrayCargos[k]+"|";
    				cadenaHtml  = "<tr><td>"+tmp[0]+"</td><td>"+tmp[1]+"</td><td>"+tmp[2]+"</td>" +
    				"<td><img src='"+baseUrl+"lib/dist/img/icons/editar.png' id='m-"+tmp[0]+"' onclick='editaDatos("+tmp[0]+");' class='editaCargo' style='cursor:pointer;'></td>" +
    				"<td><img src='"+baseUrl+"lib/dist/img/sweetalert/eliminar.png' id='e-"+tmp[0]+"' onclick='eliminaDatos("+tmp[0]+");' class='eliminaCargo' style='cursor:pointer;'></a></td>" +
    				"</tr>";
    				$("#footable_2").append(cadenaHtml);    			
    			}    		
    		}
    		$("#cargos").val(cadenaCargo);
    		$("#editor-modal").modal('hide');
    	}else{
    		return false;    		
    	}
    });

    
    $("#nuevoReg").on('click',function(e){
    	$("#nombreComite").val("");
    	$("#cargoComite").val("");
    	$("#editor-modal").modal('show');
    	
    });
    //Success Message
	$('#sa-success').on('click',function(e){
        swal({   
			title: "good job!",   
             type: "success", 
			text: "Lorem ipsum dolor sit amet",
			confirmButtonColor: "#4aa23c",   
        });
		return false;
    });

    $(".bresponsive").on('click',function(e){
    	var tmp = $(this).attr('id').split('-');
    	var id = tmp[0];
    	var nm = tmp[1];
    	if(parseInt(id) > 0){
    		$("#nm").html(nm);
    		$("#recipient-id").val(id);
    		$("#recipient-name").val(noRedes[id]);
    		$("#responsive-modal").modal('show');
    	}
    	return false;
    });

    $("#mostrarNoticia").on('click',function(e){
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'mostrar-noticia.php';
    	var contador = 0;
    	var cadena = "";
    	//vemos cuantos checkbox estan activados
    	$(".checkboxMostrar" ).each(function( index ) {
    		if($(this).prop('checked')){
    			cadena = cadena + $(this).attr('id')+"|";
    			contador++;
    		}
    	});
    	if(contador > 4){
    		swal({   
				title: "Amivtac",   
	             type: "error", 
				text: "S\u00F3lo se pueden seleccionar cuatro noticias",
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
    	}    	
    	if(String(cadena) != '' && contador < 5){
    		dataString = 'id='+cadena;
    		$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Las noticias seleccionados se mostrar\u00E1n en la p\u00E1gina principal", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
    	}    	
	});
    
	$("#mostrar").on('click',function(e){
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'mostrar-registro.php';
    	var contador = 0;
    	var cadena = "";
    	//vemos cuantos checkbox estan activados
    	$(".checkboxMostrar" ).each(function( index ) {
    		if($(this).prop('checked')){
    			cadena = cadena + $(this).attr('id')+"|";
    			contador++;
    		}
    	});
    	if(contador > 3){
    		swal({   
				title: "Amivtac",   
	             type: "error", 
				text: "S\u00F3lo se pueden seleccionar tres eventos",
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
    	}    	
    	if(String(cadena) != '' && contador < 4){
    		dataString = 'id='+cadena;
    		$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Los eventos seleccionados se mostrar\u00E1n en la p\u00E1gina principal", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
    	}    	
	});
	
	$("#mostrarVin").on('click',function(e){
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'mostrar-vinculo.php';
    	var contador = 0;
    	var cadena = "";
    	//vemos cuantos checkbox estan activados
    	$(".checkboxMostrarVinculo" ).each(function( index ) {
    		if($(this).prop('checked')){
    			cadena = cadena + $(this).attr('id')+"|";
    			contador++;
    		}
    	});
		if(contador > 8){
    		swal({   
				title: "Amivtac",   
	             type: "error", 
				text: "S\u00F3lo se pueden seleccionar ocho vinculos",
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
    	}    	
    	if(String(cadena) != '' && contador < 9){
    		dataString = 'id='+cadena;
    		$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Los eventos seleccionados se mostrar\u00E1n en la p\u00E1gina principal", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
    	}    	
	});
	$("#mostrarArchivo").on('click',function(e){
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'mostrar-publicacion.php';
    	var contador = 0;
    	var cadena = "";
    	//vemos cuantos checkbox estan activados
    	$(".checkboxMostrarArchivo" ).each(function( index ) {
    		if($(this).prop('checked')){
    			cadena = cadena + $(this).attr('id')+"|";
    			contador++;
    		}
    	});
    	if(contador > 3){
    		swal({   
				title: "Amivtac",   
	             type: "error", 
				text: "S\u00F3lo se pueden seleccionar tres eventos",
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
    	}    	
    	if(String(cadena) != '' && contador < 4){
    		dataString = 'id='+cadena+'&tipo=1';
    		$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Los eventos seleccionados se mostrar\u00E1n en la p\u00E1gina principal", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
    	}    	
	});
	
	$("#mostrarArchivoPiarc").on('click',function(e){
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'mostrar-publicacion.php';
    	var contador = 0;
    	var cadena = "";
    	//vemos cuantos checkbox estan activados
    	$(".checkboxMostrarArchivo" ).each(function( index ) {
    		if($(this).prop('checked')){
    			cadena = cadena + $(this).attr('id')+"|";
    			contador++;
    		}
    	});
    	if(contador > 3){
    		swal({   
				title: "Amivtac",   
	             type: "error", 
				text: "S\u00F3lo se pueden seleccionar tres eventos",
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
    	}    	
    	if(String(cadena) != '' && contador < 4){
    		dataString = 'id='+cadena+'&tipo=2';
    		$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Los eventos seleccionados se mostrar\u00E1n en la p\u00E1gina principal", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
    	}    	
	});
    //Warning Message
    $(document).on("click","#sa-warning",function(){ 
    	var div = $(this).attr('id');
    //	alert("a div:  "+div);
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'eliminar-registro.php';
    	if(parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0 ){
    		dataString = 'id='+tmp[1]+"&idModulo="+tmp[2];
    	    swal({   
                title: "Desea eliminar el registro?",   
                text: "",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#f8b32d",   
                confirmButtonText: "Eliminar",   
                closeOnConfirm: false 
            }, function(){
    			$.ajax({
    				type: 'POST',
    				url : url,		
    				dataType: 'json',
    				data: dataString,
    				beforeSend: function(){
    					//$('#procesando').html(procesando);
    				},			
    				success: function(data){
    					if(parseInt(data.exito) === 1){
    						swal("Eliminado!", data.msg, "success");
                            setTimeout(function(){            					
                            	location.href=baseUrl+data.url;
                            	}
                            ,2500);       						
    					}else{
    						swal("Error", data.msg, "error");
    					}
    					return false;
    				},
    				error: function (xhr, ajaxOptions, thrownError) {
    					error("Error");
    					return false;
    			    },
    				complete: function(){
    				}				
    			});            		 
            });    		
    	}
		return false;
    });
    
    
    $(document).on("click",".sa-warning",function(){ 
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	//	alert("b div:  "+div);
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'eliminar-registro.php';
    	if(parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0 ){
    		dataString = 'id='+tmp[1]+"&idModulo="+tmp[2];
    	    swal({   
                title: "Desea eliminar el registro?",   
                text: "",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#f8b32d",   
                confirmButtonText: "Eliminar",   
                closeOnConfirm: false 
            }, function(){
    			$.ajax({
    				type: 'POST',
    				url : url,		
    				dataType: 'json',
    				data: dataString,
    				beforeSend: function(){
    					//$('#procesando').html(procesando);
    				},			
    				success: function(data){
    					if(parseInt(data.exito) === 1){
    						swal("Eliminado!", data.msg, "success");
                            setTimeout(function(){            					
                            	location.href=baseUrl+data.url;
                            	}
                            ,2500);       						
    					}else{
    						swal("Error", data.msg, "error");
    					}
    					return false;
    				},
    				error: function (xhr, ajaxOptions, thrownError) {
    					error("Error");
    					return false;
    			    },
    				complete: function(){
    				}				
    			});            		 
            });    		
    	}
		return false;    	
    });

    $(document).on("click",".eliminar",function(){
    //$('.eliminar').on('click',function(e){
    	var div = $(this).attr('id');
    	var tmp = div.split('-');
    	var dataString = '';
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+'eliminar-registro.php';
    	if(parseInt(tmp[1]) > 0 && parseInt(tmp[2]) > 0 ){
    		dataString = 'id='+tmp[1]+"&idModulo="+tmp[2];
    	    swal({   
                title: "Desea eliminar el registro?",   
                text: "",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#f8b32d",   
                confirmButtonText: "Eliminar",   
                closeOnConfirm: false 
            }, function(){
    			$.ajax({
    				type: 'POST',
    				url : url,		
    				dataType: 'json',
    				data: dataString,
    				beforeSend: function(){
    					//$('#procesando').html(procesando);
    				},			
    				success: function(data){
    					if(parseInt(data.exito) === 1){
    						swal("Eliminado!", data.msg, "success");
                            setTimeout(function(){            					
                            	location.href=baseUrl+data.url;
                            	}
                            ,2500);       						
    					}else{
    						swal("Error", data.msg, "error");
    					}
    					return false;
    				},
    				error: function (xhr, ajaxOptions, thrownError) {
    					error("Error");
    					return false;
    			    },
    				complete: function(){
    				}				
    			});            		 
            });    		
    	}
		return false;
    });
    
    $('#sa-warning,.sa-warning').on('click',function(e){
   	    swal({   
               title: "Desea eliminar el registro?",   
               text: "",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#f8b32d",   
                confirmButtonText: "Eliminar",   
                closeOnConfirm: false 
            }, function(){
            	swal("Ã‚Â¡Eliminado!", "El registro ha sido eliminado.", "success");
            });    		
    });
    
    /***Slider***/
    $('#crearSlider').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Banner\n";
			noErrores++;
		}
		if(String($("#fileImg").val()) == ""){
			errores += "Debe seleccionar la imagen del Banner\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	  
    });
        
    $('#editarSlider').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Banner\n";
			noErrores++;
		}
		if(parseInt($("#idimagen").val()) == 0){
			errores += "Debe seleccionar la imagen del Banner\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	  
    });
    
    /***Cargo***/
    
    
    $('#guardaMesa').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del aspirante al cargo\n";
			noErrores++;
		}
		if(String($("#cargo").val()) == ""){
			errores += "Debe registrar el nombre del cargo\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	  
    });
        
    $('#editarCargo').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del aspirante al cargo\n";
			noErrores++;
		}
		if(String($("#cargo").val()) == ""){
			errores += "Debe registrar el nombre del cargo\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	  
    });
    /**************/
    /**Presidente**/
    
    $('#guardaPresidente').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nomesa").val()) == ""){
			errores += "Debe registrar el n\u00FAmero de mesa\n";			
			noErrores++;
		}
		if(String($("#presidente").val()) == ""){
			errores += "Debe registrar el nombre del Presidente\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
    /***************/
    /**Coordinador **/
    $('#crearCoordinador').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del aspirante a Coordinador\n";
			noErrores++;
		}
		if(String($("#coordinacion").val()) == ""){
			errores += "Debe registrar el nombre de la coordinaci\u00F3n\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
        
    $('#actualizarCoordinador').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del aspirante a Coordinador\n";
			noErrores++;
		}
		if(String($("#coordinacion").val()) == ""){
			errores += "Debe registrar el nombre de la coordinaci\u00F3n\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });    
    
    /****************/
    /***ExPresidente***/    
    $('#guardaExPresidente').on('click',function(e){
    	var errores = "";
		var noErrores = 0;		
		if(String($("#presidente").val()) == ""){
			errores += "Debe registrar el nombre del Ex-Presidente\n";
			noErrores++;
		}
		if(String($("#periodo").val()) == ""){
			errores += "Debe registrar el periodo\n";			
			noErrores++;
		}		
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
    });    
    
    /***Socio ***/
    $('#crearSocio').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Socio\n";
			noErrores++;
		}
		if(String($("#anio").val()) == ""){
			errores += "Debe registrar la a\u00F1o de reconocimiento\n";			
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
        
    $('#actualizarSocio').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Socio\n";
			noErrores++;
		}
		if(String($("#anio").val()) == ""){
			errores += "Debe registrar la a\u00F1o de reconocimiento\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });    
    
    /**** Acuerdos ****/
    $('#crearAcuerdo').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Acuerdo\n";
			noErrores++;
		}
		if(String($("#url").val()) == ""){
			errores += "Debe registrar la Url\n";			
			noErrores++;
		}
		if(String($("#texto").val()) == ""){
			errores += "Debe registrar el texto\n";			
			noErrores++;
		}
		if(String($("#fileImg").val()) == ""){
			errores += "Debe seleccionar el logotipo\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
        
    $('#actualizaAcuerdo').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Acuerdo\n";
			noErrores++;
		}
		if(String($("#url").val()) == ""){
			errores += "Debe registrar la Url\n";			
			noErrores++;
		}
		if(String($("#texto").val()) == ""){
			errores += "Debe registrar el texto\n";			
			noErrores++;
		}
		if(parseInt($("#idimagen").val()) == 0){
			errores += "Debe seleccionar la imagen del Banner\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });   
    
    /***Eventos***/
    $('#nuevoEvento').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#titulo").val()) == ""){
			errores += "Debe registrar el titulo del evento\n";
			noErrores++;
		}
		if(String($("#fecha_evento").val()) == ""){
			errores += "Debe registrar la fecha del evento\n";			
			noErrores++;
		}
		if(String($("#lugar").val()) == ""){
			errores += "Debe registrar el lugar del evento\n";			
			noErrores++;
		}
		if(String($("#descripcion").val()) == ""){
			errores += "Debe seleccionar la descripci\u00F3n del evento\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
        
    $('#actualizarEvento').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#titulo").val()) == ""){
			errores += "Debe registrar el titulo del evento\n";
			noErrores++;
		}
		if(String($("#fecha_evento").val()) == ""){
			errores += "Debe registrar la fecha del evento\n";			
			noErrores++;
		}
		if(String($("#lugar").val()) == ""){
			errores += "Debe registrar el lugar del evento\n";			
			noErrores++;
		}
		if(String($("#descripcion").val()) == ""){
			errores += "Debe seleccionar la descripci\u00F3n del evento\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });   
    
    /****Comites*****/
    $('#crearComite').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Comit\u00E9\n";
			noErrores++;
		}
		if(String($("#presidente").val()) == ""){
			errores += "Debe registrar el nombre del Presidente\n";			
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
        
    $('#actulizaComite').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del Comit\u00E9\n";
			noErrores++;
		}
		if(String($("#presidente").val()) == ""){
			errores += "Debe registrar el nombre del Presidente\n";			
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });   

    /**Blblioteca amivtac***/
    $('#crearbiblioteca').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#subcarpeta").val()) == ""){
			errores += "Debe registrar el nombre de la Subcarpeta\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });
        
    $('#actualizarbiblioteca').on('click',function(e){
		var errores = "";
		var noErrores = 0;
		if(String($("#subcarpeta").val()) == ""){
			errores += "Debe registrar el nombre de la Subcarpeta\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;	  
    });   
    
    /****************/
    $('.cancelaRegistro').on('click',function(e){
    	var baseUrl = $("#baseUrl").val();
    	var url = baseUrl+$(this).attr('id');
	    swal({   
            title: "Desea salir del formulario sin guardar?",   
            text: "",   
            type: "info",   
            showCancelButton: true,   
            confirmButtonColor: "#4aa23c",   
            confirmButtonText: "Si",   
            closeOnConfirm: false 
        }, function(){   
        	location.href = url;
        });
		return false;
    });

	
	$("#crearDelegacion").click(function(){
		var errores = "";
		var noErrores = 0;
		if(String($("#idestado").val()) == ""){
			errores += "Debe seleccionar el Estado\n";
			noErrores++;
		}
		if(String($("#nombre").val()) == ""){
			errores += "Debe registrar el nombre del delegado\n";
			noErrores++;
		}
		if(String($("#fileImg").val()) == ""){
			errores += "Debe seleccionar la fotograf\u00EDa del Delegado\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	});


	$("#nuevoRevista").click(function(){
		var errores = "";
		var noErrores = 0;
		if(String($("#titulo").val()) == ""){
			errores += "Debe registrar el T\u00EDtulo\n";
			noErrores++;
		}
		if(String($("#periodo").val()) == ""){
			errores += "Debe registrar el per\u00EDodo\n";
			noErrores++;
		}
		if(String($("#url").val()) != "" && String($("#documento").val()) != ""){
			errores += "Debe de registrar la Url o el archivo PDF";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	});
	
	$("#crearBiblioteca").click(function(){
		var errores = "";
		var noErrores = 0;
		if(String($("#subcarpeta").val()) == ""){
			errores += "Debe registrar el nombre de la subcarpeta\n";
			noErrores++;
		}
		if(noErrores > 0){
			swal({   
				title: "Amivtac",   
	            type: "error", 
				text: errores,
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	});

	
	$("#actualizarRevista").click(function(){
		if(String($("#url").val()) != "" && String($("#documento").val()) != ""){
			swal({   
				title: "Amivtac",   
                type: "error", 
                text: "Debe de registrar la Url o el archivo PDF",
				confirmButtonColor: "#4aa23c",   
	        });
			return false;
		}
		return true;
	});

    //Parameter
	$('#sa-params').on('click',function(e){
        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this imaginary file!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f8b32d",   
            confirmButtonText: "Yes, delete it!",   
            cancelButtonText: "No, cancel plx!",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){   
            if (isConfirm) {     
                swal("Deleted!", "Your imaginary file has been deleted.", "success");   
            } else {     
                swal("Cancelled", "Your imaginary file is safe :)", "error");   
            } 
        });
		return false;
    });

    //Custom Image
	$('#sa-image').on('click',function(e){
		swal({   
            title: "John!",   
            text: "Recently joined twitter",   
            imageUrl: "dist/img/user.png" ,
			confirmButtonColor: "#f33923",   
			
        });
		return false;
    });
	
	//Ordenar Slider
	$(".ordenslide").on('change',function(e){
		var div = $(this).attr('id');
		var val = $(this).val();
		var tmp = div.split('-');
		var baseUrl = $("#baseUrl").val();
		var url = baseUrl+'orden-slider.php';
		var dataString = "";
		if(parseInt(tmp[1]) > 0 && parseInt(val) > 0){
			dataString = 'id='+tmp[1]+"&valor="+val;
			$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Ok", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
		}
	});
	
		//Ordenar Vinculo
	$(".ordenvinculo").on('change',function(e){
		var div = $(this).attr('id');
		var val = $(this).val();
		var tmp = div.split('-');
		var baseUrl = $("#baseUrl").val();
		var url = baseUrl+'orden-vinculo.php';
		var dataString = "";
		if(parseInt(tmp[1]) > 0 && parseInt(val) > 0){
			dataString = 'id='+tmp[1]+"&valor="+val;
			$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						swal("Ok", data.msg, "success");
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    		
		}
	});

	if($("#carpeta")!= undefined && String($("#carpeta").val()) !== ''){
		var carpeta = $("#carpeta").val();
		var idbiblioteca =$("#idbiblioteca").val();
		var idarchivo =$("#idarchivo").val();
		var tipo =$("#tipo").val();
		var baseUrl = $("#baseUrl").val();
		var url = baseUrl+'muestra-archivos.php';
		var dataString = "";		
		if(String(carpeta)!= ''){
			dataString = 'carpeta='+carpeta+'&idbiblioteca='+idbiblioteca+"&idarchivo="+idarchivo+"&tipo="+tipo;
			$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(data !== null){
						if(parseInt(data.exito) === 1){
							$("#combo").html(data.msg);
						}else{
							swal("Error", data.msg, "error");
						}
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    					
		}
	}
	
	$(".carpetas").on('change',function(e){
		var carpeta = $(this).val();
		var idbiblioteca =$("#idbiblioteca").val();
		var idarchivo =$("#idarchivo").val();
		var tipo =$("#tipo").val();
		var baseUrl = $("#baseUrl").val();
		var url = baseUrl+'muestra-archivos.php';
		var dataString = "";		
		if(String(carpeta)!= ''){
			dataString = 'carpeta='+carpeta+'&idbiblioteca='+idbiblioteca+"&idarchivo="+idarchivo+"&tipo="+tipo;
			$.ajax({
				type: 'POST',
				url : url,		
				dataType: 'json',
				data: dataString,
				beforeSend: function(){
				},			
				success: function(data){
					if(parseInt(data.exito) === 1){
						$("#combo").html(data.msg);
					}else{
						swal("Error", data.msg, "error");
					}
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					return false;
			    },
				complete: function(){
				}				
			});    					
		}
		
	});
	
	$(".modales").on('click',function(e){
		var div = $(this).attr('id');
		var tmp = div.split('-');
		$("#idDoc").val(tmp[1]);
		$("#myModal").modal('show');
	});
	
	$("#asignaNombre").on('click',function(e){
		var idDoc = $("#idDoc").val();
		var nmDoc = $("#filename").val();
		var compn = "documento"+idDoc;
		$("#"+compn).val(nmDoc);
		$("#myModal").modal('hide');
	});
    //Auto Close Timer
	$('#sa-close').on('click',function(e){
        swal({   
            title: "Auto close alert!",   
            text: "I will close in 2 seconds.",   
            timer: 2000,   
            showConfirmButton: false 
        });
		return false;
    });


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert;
	
	$.SweetAlert.init();
});


function editaDatos(id){
	var data = "";
	if(parseInt(id) > 0){		
    	data = arrayCargos[id].split('#');
    	$("#idComiteCargo").val(data[0]);
    	$("#nombreComite").val(data[1]);
    	$("#cargoComite").val(data[2]);
    	$("#editor-modal").modal('show');
	}
	return false;
}
function eliminaDatos(id){
	var data = "";
	var cadenaCargo  = "";
	var cadenaHtml   = "";
	var contadorCargo = 1;
	if(parseInt(id) > 0){
		arrayCargos[id] = "";
		$("#bodyid").empty();
		for(var k=0; k < noCargos; k++){
			if(String(arrayCargos[k]) !== ''){
				var tmp     = arrayCargos[k].split('#');    			
				cadenaCargo+= arrayCargos[k]+"|";
				cadenaHtml  = "<tr><td>"+contadorCargo+"</td><td>"+tmp[1]+"</td><td>"+tmp[2]+"</td>" +
				"<td><img src='"+baseUrl+"lib/dist/img/icons/editar.png' id='m-"+tmp[0]+"' onclick='editaDatos("+tmp[0]+");' class='editaCargo' style='cursor:pointer;'></td>" +
				"<td><img src='"+baseUrl+"lib/dist/img/sweetalert/eliminar.png' id='e-"+tmp[0]+"' onclick='eliminaDatos("+tmp[0]+");' class='eliminaCargo' style='cursor:pointer;'></a></td>" +
				"</tr>";
				contadorCargo++;
				$("#footable_2").append(cadenaHtml);    	
				
			}    		
		}
		$("#cargos").val(cadenaCargo);		
	}
	return false;

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