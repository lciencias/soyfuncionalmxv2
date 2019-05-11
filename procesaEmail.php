<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(-1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$array = array('exito' => 0,'msg' => 'Error al guardar la pregunta');
include_once($pathSys."panel/BDconfig.php");
include_once($pathSys."panel/clases/Comunes.class.php");
include_once($pathSys."panel/clases/Conexion.class.php");
include_once($pathSis."panel/clases/EnviaEmailPedido.class.php");
require_once($pathSis."Swift/lib/swift_required.php");
$db    = new Conexion( $_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency = true );
$email = new EnviaEmailPedido($db);
$array = array('exito' => $email->obtenExito(),'msg' => $email->obtenMensaje());
die(json_encode($array));
?>