<?php
#Color Azul        = #002857
#Color Amarillo    = #e7e76a
#Color gris fuerte = #56555a
#Color gris suave  = #b8b6b9
$visitante = 'visitante';
$fecha     = 'fecha';
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
if($_SESSION[$visitante] == ""){
    $_SESSION[$visitante] = rand(99999990,9999999999);
    $fechaPedido = date('d-m-Y');
    if(date("H") > 13){
        $fechaPedido = date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
    }
    $_SESSION['noPedidos'] = 0;
    $_SESSION['productos'] = array();
    $_SESSION['fechaPedido'] = $fechaPedido;
    //$idUsuarioWeb     = $_SESSION[$visitante]."|".$fechaPedido;
    //$_SESSION['id']   = $idUsuarioWeb;
}
$site       = "Soy Funcional MX";
$panelTitle = "Soy Funcional MX";
$exito = 0;
if(trim(strtolower($_SERVER['SERVER_NAME'])) == "localhost"){
    $pathWeb = "http://localhost/soyfuncionalmxv2/";
    $pathSis = "/Applications/XAMPP/htdocs/soyfuncionalmxv2/"; 
    $pathSys = "/Applications/XAMPP/htdocs/soyfuncionalmxv2/";        
    $pathWeb = "http://localhost/soyfuncionalmxv2/";
    $pathSis = "c:/xampp/htdocs/soyfuncionalmxv2/"; 
    $pathSys = "c:/xampp/htdocs/soyfuncionalmxv2/";
    $exito    = 1;
}
if($exito == 1){
    $pathCss   = $pathWeb."css/";
    $pathJs    = $pathWeb."js/";
    $pathImg   = $pathWeb."images/";   
	$pathCla   = $pathSis."panel/clases/";
	$filesameA = explode('/',$_SERVER['SCRIPT_FILENAME']);
	$fileName  = $filesameA[count($filesameA) - 1 ];
	include_once($pathSis."panel/BDconfig.php");
}
?>