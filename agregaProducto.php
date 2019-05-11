<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$array = array('exito' => 0,'msg' => 'Error al guardar la pregunta');
if ( $_SESSION['visitante'] == $_POST['sessionId'] && (int) $_POST['idProd'] > 0 && strlen(trim($_POST['fecha'])) == 10){
      include_once($pathSys."panel/clases/Comunes.class.php");
      $fecha    = $_POST['fecha'];
      $cantidad = Comunes::SAVE;
      $idProd   = (int)$_POST['idProd'];      
      if(isset($_SESSION) && trim($fecha)!= "" && $cantidad > 0 && $idProd > 0){
        $_SESSION['productos'][$fecha][$idProd] = $_SESSION['productos'][$fecha][$idProd] + $cantidad;
        $_SESSION['fechaPedido'] = $fecha;
      }
      $_SESSION['noPedidos'] = count($_SESSION['productos']);
      $_SESSION['importe'] = calculaImporte($_SESSION['catalogo'], $_SESSION);;
      $array = array('exito' => Comunes::SAVE,'msg' => Comunes::MSGSUCESS, 'importe' => $_SESSION['importe']);
}
die(json_encode($array));


function calculaImporte($prods, $session){
  $importe = 0.00;
  $seleccion = $session['productos'];
  foreach($seleccion as $fechaP => $data){
    foreach($data as $idProd => $cantidad){
      $producto = $prods[$idProd];
      $importe = $importe + ($producto['precio'] * $cantidad) + 0.00;
    }
  }
  return $importe;
}
?>