<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(-1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
set_time_limit (0);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$site   ="Soy Funcional MX";
$panelTitle = "<h1>Panel de Control <small>Soy Funcional MX</small></h1>";
$exito = 0;

if(trim(strtolower($_SERVER['SERVER_NAME'])) == "localhost"){
    $pathWeb = "http://localhost/soyfuncionalmx/panel/";
    $pathSis = "/Applications/XAMPP/htdocs/soyfuncionalmx/panel/"; 
    $pathSys = "/Applications/XAMPP/htdocs/soyfuncionalmx/panel/";        
    $pathWeb = "http://localhost/soyfuncionalmxv2/panel/";
    $pathSis = "c:/xampp/htdocs/soyfuncionalmxv2/panel/"; 
    $pathSys = "c:/xampp/htdocs/soyfuncionalmxv2/panel/";        
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
	include_once($pathSis."session_visita.php");
}
?>