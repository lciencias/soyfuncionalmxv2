<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(-1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$array = array('exito' => 0,'msg' => 'Error al guardar el pedido');

if ( $_SESSION['visitante'] == $_POST['sessionId'] && 
    isset($_POST['nombre']) &&  trim($_POST['nombre']) != "" && strlen(trim($_POST['nombre'])) > 5 &&
    isset($_POST['email']) &&  trim($_POST['email']) != "" && strlen(trim($_POST['email'])) > 5 &&
    isset($_POST['phone']) &&  trim($_POST['phone']) != "" && strlen(trim($_POST['phone'])) == 10 &&
    isset($_POST['address']) &&  trim($_POST['address']) != "" && strlen(trim($_POST['address'])) >5 &&  
    isset($_POST['delegacion']) &&  trim($_POST['delegacion']) != ""
    ){
      
      include_once($pathSis."panel/BDconfig.php");
      include_once($pathSis."panel/clases/Comunes.class.php");
      include_once($pathSis."panel/clases/Conexion.class.php");
      include_once($pathSis."panel/clases/InsertaPedido.class.php");
      $db  = new Conexion( $_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency = true );
      $pedido = new InsertaPedido($db, $_SESSION, $_POST, Comunes::SAVE);
      if($pedido->obtenExito()){
        $productos = $pedido->obtenCatalogoProductos();
        $array = array('exito' => $pedido->obtenExito(),'msg' => $pedido->obtenMensaje());
      }
}
die(json_encode($array));
?>