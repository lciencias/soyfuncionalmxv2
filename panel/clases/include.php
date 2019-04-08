<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(-1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
set_time_limit (0);
date_default_timezone_set("America/Mexico_City");
$title   ="Administraci&oacute;n Amivtac";
$exito = 0;

if(trim(strtolower($_SERVER['SERVER_NAME'])) == "localhost"){
	if((int)$_SERVER['HTTP_X_HTTPS'] == 1){
		header("Location: http://localhost/pensatori");
	}	
	$path_pweb = "http://localhost/pensatori/";
	$path_psis = "c:/xampp56/htdocs3/pensatori/";
	$path_psys = "c:/xampp56/htdocs3/pensatori/";
	
	$path_web = "http://localhost/pensatori/spanelWeb/";
	$path_sis = "c:/xampp56/htdocs3/pensatori/spanelWeb/";
	$path_sys = "c:/xampp56/htdocs3/pensatori/spanelWeb/";
	$exito    = 1;
}


if(trim(strtolower($_SERVER['SERVER_NAME'])) == "www.amivtac.org"){
	if((int)$_SERVER['HTTP_X_HTTPS'] == 1){
		header("Location: http://www.amivtac.org/");
	}	
	$path_pweb = "http://www.amivtac.org/";
	$path_psis = "/home/amivtac/public_html/";
	$path_psys = "/home/amivtac/public_html/";

	$path_web = "http://www.amivtac.org/spanelWeb/";
	$path_sis = "/home/amivtac/public_html/spanelWeb/";
	$path_sys = "/home/amivtac/public_html/spanelWeb/";
	$exito    = 1;
}

if(trim(strtolower($_SERVER['SERVER_NAME'])) == "amivtac.org"){
	if((int)$_SERVER['HTTP_X_HTTPS'] == 1){
		header("Location: http://www.amivtac.org/");
	}	
	header("Location: http://www.amivtac.org");
}


if($exito == 1){
	$path_sys   = $path_sis;
	$path_cla   = $path_sis."clases/";
	$path_int   = $path_sis."interfaces/";
	$path_lib   = $path_web."lib/";
	$path_css   = $path_web."css/";
	$path_js    = $path_web."js/";
	$path_img   = $path_web."imagenes/";
	$path_Wfiles= $path_web."downfiles/";
	$path_files = $path_sis."downfiles/";
	$filesameA  = explode('/',$_SERVER['SCRIPT_FILENAME']);
	$fileName   = $filesameA[count($filesameA) - 1 ];
	include_once($path_sis."BDconfig.php");
//	include_once($path_psis."session_visita.php");
}else{
	die("mantenimiento");	
}
?>