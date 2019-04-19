<?php
#Color Azul        = #002857
#Color Amarillo    = #e7e76a
#Color gris fuerte = #56555a
#Color gris suave  = #b8b6b9
session_start();
if($_SESSION['visitante'] == ""){
    $_SESSION['visitante'] = rand(99999990,9999999999);
}
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$site       = "Soy Funcional MX";
$panelTitle = "Soy Funcional MX";
$exito = 0;

if(trim(strtolower($_SERVER['SERVER_NAME'])) == "localhost"){
 //   $pathWeb = "http://localhost/soyfuncionalmx/";
 //   $pathSis = "/Applications/XAMPP/htdocs/soyfuncionalmxv2/"; 
 //   $pathSys = "/Applications/XAMPP/htdocs/soyfuncionalmxv2/";        
    $pathWeb = "http://localhost/soyfuncionalmxv2/";
    $pathSis = "c:/xampp/htdocs/soyfuncionalmxv2/"; 
    $pathSys = "c:/xampp/htdocs/soyfuncionalmxv2/";
    $exito    = 1;
}
if($exito == 1){
    $pathCss = $pathWeb."css/";
    $pathJs  = $pathWeb."js/";
    $pathImg = $pathWeb."images/";   
	$pathCla = $pathSis."panel/clases/";
	$filesameA  = explode('/',$_SERVER['SCRIPT_FILENAME']);
	$fileName   = $filesameA[count($filesameA) - 1 ];
	include_once($pathSis."panel/BDconfig.php");
}
?>