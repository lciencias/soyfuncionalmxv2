var baseurl   = $("#baseUrl").val();
var numericos = /[0-9,-]/;
var letras   = /^[a-zA-Z\ .\s\u00C1 \u00E1 \u00C9 \u00E9 \u00CD \u00ED \u00D3 \u00F3 \u00DA \u00FA \u00DC \u00FC \u00D1 \u00F1 .;:,¿?¿!\"#%=()*\s]+$/;
var alfanum  = /^[a-zA-Z\. \s\-\u00C1 \u00E1 \u00C9 \u00E9 \u00CD \u00ED \u00D3 \u00F3 \u00DA \u00FA \u00DC \u00FC \u00D1 \u00F1 .;:,0123456789_://.\"()s!#$¡¿?\s]+$/;
var correo   = /^[a-zA-Z0-9_@\-\.\s]+$/;
var carpeta   = /^[a-zA-Z\. \s\-\u00C1 \u00E1 \u00C9 \u00E9 \u00CD \u00ED \u00D3 \u00F3 \u00DA \u00FA \u00DC \u00FC \u00D1 \u00F1 .;:,0123456789_://.\"()s!#$¡¿?\s]+$/;
var decimales = /[0-9\.]/;
var fecha = /[0-9\-]/;
var url = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/;

$(document).ready(function() {
  setInterval(revisaSesion,30000);
  var dataString = 'idModulo='+$("#idModulo").val()+'&page=1&noRegs=0&orden=asc';
  
  if(parseInt($("#idModulo").val()) > 0 && String(token) !== ''){
	registrosIndexView(dataString,$("#idModulo").val());
	return false	
  }	
  $("input[type=text],input[type=email],select,textarea").focus(function(){
	  $(this).css({ color: "#000000", background: "#E5E5E5" });
  });
 
  $("input[type=text],input[type=email],select,textarea").focusout(function(){
	  $(this).css({ color: "#000000", background: "#ffffff" });
  });

       //Entrada Caracteres
     $( document ).delegate(".numeros", "keypress", function(e) {  
         tecla = (document.all) ? e.keyCode : e.which;
         if (tecla == 0 || tecla == 8){
    	 return true;
         }        
         tecla_final = String.fromCharCode(tecla);
         return numericos.test(tecla_final);		 
     });
      
      //Entrada Letras
    $( document ).delegate(".letras", "keypress", function(e) {	 
         tecla = (document.all) ? e.keyCode : e.which;
         if (tecla == 0 || tecla == 8){
    	return true;
         }	        
         tecla_final = String.fromCharCode(tecla);
         return letras.test(tecla_final);
    });
    
      //Entrada alfanumerico
    $( document ).delegate(".alfa", "keypress", function(e) {	  
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8){
    	return true;
        }	        
        tecla_final = String.fromCharCode(tecla);
        return alfanum.test(tecla_final);		  
    });
      
      //Entrada correo
    $( document ).delegate(".correo", "keypress", function(e) {	
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8){
    	return true;
        }	        
        tecla_final = String.fromCharCode(tecla);
        return correo.test(tecla_final);
    });
      
      //Decimales
    $( document ).delegate(".decimales", "keypress", function(e) {  
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8){
    	return true;
        }        
        tecla_final = String.fromCharCode(tecla);
        return decimales.test(tecla_final);		 
    });

    //Entrada carpeta
    $( document ).delegate(".carpeta", "keypress", function(e) {	
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 0 || tecla == 8){
    	return true;
        }	        
        tecla_final = String.fromCharCode(tecla);
        return carpeta.test(tecla_final);
    });

});  //Fin de jquery


function revisaSesion(){
	var baseUrl = $("#baseUrl").val();
	var dataString = 'id=1';
	url  = baseUrl+'revisa_sesion.php';
	$.ajax({
		type: 'POST',
		url : url,		
		data: dataString,
		beforeSend: function(){},			
		success: function(data){
		    if(parseInt(data) === 1){
			location.href = baseUrl+"logout.php";
		    }			
		},
		error: function (xhr, ajaxOptions, thrownError) {
			return false;
	    },
		complete: function(){
		}				
	});
	return false;
}
function check_chars(cadena, chars)
{
    var s = "";
    var j = 0;
    for (i = 0; i < cadena.length; i++)
    {
        if (chars.indexOf(cadena.charAt(i)) != -1)
        {
          s = s + cadena.charAt(i);
        }
        else j++;
    }
    cadena = s; 
    return cadena;
}

function valEmail(txt)
{
    var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/
    return b.test(txt)
}
function validarRFC(rfc) {
	var regex =  new RegExp("[A-Z]{4}[0-9]{6}[A-Z0-9]{3}");
	 if(String(rfc).length == 12){
		 regex =  new RegExp("[A-Z]{3}[0-9]{6}[A-Z0-9]{3}");	 
	 }
	 return regex.test(rfc);
}

function exito(msg){
	$('#procesando').fadeIn(1000).html("");
	$("#errorJs").addClass("alert alert-success alert-dismissible" );
	$("#errorJs").css({"position": "absolute", "top": "0px", "right": "0px", "index-z":"9999999999999"});
	$("#errorJs").html(msg);
    setTimeout(function(){
    	$("#errorJs").removeClass("alert-success alert-dismissible" );
    	$("#errorJs").html("");                    	
    },2500);	
	
}


function error(msg){
	$('#procesando').fadeIn(1000).html("");
	$("#errorJs").addClass("alert alert-danger alert-dismissible" );
	$("#errorJs").css({"position": "absolute", "top": "0px", "right": "200px", "index-z":"9999999999999"});
	if(String(msg) === '')
		$("#errorJs").html("Error inesperado favor de notificar al administrador.");
	else
		$("#errorJs").html(msg);
    setTimeout(function(){
    	$("#errorJs").removeClass("alert-danger alert-dismissible" );
    	$("#errorJs").html("");                    	
    },2500);	
}

function warning(msg){
	$('#procesando').fadeIn(1000).html("");
	$("#errorJs").addClass("alert alert-warning alert-dismissible" );
	$("#errorJs").css({"position": "absolute", "top": "0px", "right": "0px", "index-z":"9999999999999"});
	if(String(msg) === '')
		$("#errorJs").html("Error inesperado favor de notificar al administrador.");
	else
		$("#errorJs").html(msg);
    setTimeout(function(){
    	$("#errorJs").removeClass("alert-warning alert-dismissible" );
    	$("#errorJs").html("");                    	
    },2500);	
}


function revisaFecha(fecha){
	var validaciones = 0;
	var ano = fecha.substring(0,2);
	var mes = fecha.substring(2,4);
	var dia = fecha.substring(4,6);
	if( (parseInt(ano) >= 0 && parseInt(ano) <= 99) ){
		validaciones++;
	}
	if( (parseInt(mes) >= 1 && parseInt(mes) <= 12) ){
		validaciones++;
		switch(parseInt(mes)){
			case 1:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
			case 2:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 29) ){
					validaciones ++;					
				}
				break;
			case 3:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
			case 4:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 30) ){
					validaciones ++;					
				}
				break;
			case 5:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
			case 6:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 30) ){
					validaciones ++;					
				}
				break;
			case 7:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
			case 8:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
			case 9:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 30) ){
					validaciones ++;					
				}
				break;
			case 10:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
			case 11:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 30) ){
					validaciones ++;					
				}
				break;
			case 12:
				if( (parseInt(dia) >= 1 && parseInt(dia) <= 31) ){
					validaciones ++;					
				}
				break;
		}		
	}
	if(validaciones === 3){
		return true;
	}else{
		return false;
	}	
}
