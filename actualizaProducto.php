<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$array = array('exito' => 0,'msg' => 'Error al guardar la pregunta');
if ( $_SESSION['visitante'] == $_POST['sessionId'] && (int) $_POST['idProd'] > 0 && strlen(trim($_POST['fecha'])) == 10){
      include_once($pathWeb."panel/clases/Comunes.class.php");
      $fecha    = trim( $_POST['fecha'] );
      $cantidad = (int) $_POST['cantidad'];
      $idProd   = (int) $_POST['idProd'];
      if(isset($_SESSION) && trim($fecha)!= "" && $cantidad > 0 && $idProd > 0){
        $_SESSION['productos'][$fecha][$idProd] =  $cantidad;
        $_SESSION['fechaPedido'] = $fecha;
      }
      $_SESSION['noPedidos'] = count($_SESSION['productos']);
      $array = array('exito' => Comunes::SAVE,'msg' => $_SESSION);
}
die(json_encode($array));
?>