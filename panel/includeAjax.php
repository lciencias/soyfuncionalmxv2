<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(-1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
set_time_limit (0);
ini_set('post_max_size', '1024M');
ini_set('upload_max_filesize', '1024M');
session_start();
session_cache_limiter("nocache");
date_default_timezone_set("America/Mexico_City");
$title   ="Administraci&oacute;n Amivtac";
$exito = 0;
if(trim(strtolower($_SERVER['SERVER_NAME'])) == "localhost"){
    $pathWeb = "http://localhost/soyfuncionalmxv2/panel/";
    $pathSis = "/Applications/XAMPP/htdocs/soyfuncionalmxv2/panel/"; 
	$pathSys = "/Applications/XAMPP/htdocs/soyfuncionalmxv2/panel/";        
	
	$pathWeb = "http://localhost/soyfuncionalmxv2/panel/";
    $pathSis = "/xampp/htdocs/soyfuncionalmxv2/panel/"; 
    $pathSys = "/xampp/htdocs/soyfuncionalmxv2/panel/";        
	
    $exito    = 1;
}

if($exito == 1){
	$pathCss = $pathWeb;
    $pathJs  = $pathWeb;
    $pathImg = $pathWeb."img/";    
	$pathCla = $pathSis."clases/";
	$pathInt = $pathSis."interfaces/";
	$filesameA  = explode('/',$_SERVER['SCRIPT_FILENAME']);
	$fileName   = $filesameA[count($filesameA) - 1 ];
	include_once($pathSis."BDconfig.php");
	$_SESSION['msgSuccess'] = $_SESSION['msgError'] = "";
}
else{
	die("<br><br><p align='center'>P&aacute;gina en mantenimiento</p></br><br>");
}
?>