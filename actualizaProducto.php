<?php
include_once("includeAjax.php");
$array = array('exito' => 0,'msg' => 'Error al guardar la pregunta');
if ( $_SESSION['visitante'] == $_POST['sessionId'] && (int) $_POST['idProd'] > 0 && strlen(trim($_POST['fecha'])) == 10){
      include_once($pathSys."panel/clases/Comunes.class.php");
      include_once($pathSis."funciones.php");
      $fecha    = trim( $_POST['fecha'] );
      $cantidad = (int) $_POST['cantidad'];
      $idProd   = (int) $_POST['idProd'];
      if(isset($_SESSION) && trim($fecha)!= "" && $cantidad > 0 && $idProd > 0){
        $_SESSION['productos'][$fecha][$idProd] =  $cantidad;
        $_SESSION['fechaPedido'] = $fecha;
      }
      $_SESSION['noPedidos'] = calculaProductos($_SESSION['productos']);
      $_SESSION['importe'] = calculaImporte($_SESSION['catalogo'], $_SESSION);    
      $array = array('exito' => Comunes::SAVE,'msg' => Comunes::MSGSUCESS, 'importe' => $_SESSION['importe'], 'noPedidos' => $_SESSION['noPedidos']);
}
die(json_encode($array));
?>