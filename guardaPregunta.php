<?php
include_once("includeAjax.php");
$array = array('exito' => 0,'msg' => 'Error al guardar la pregunta');
if ( $_SESSION['visitante'] == $_POST['sessionId'] && trim($_POST['pregunta']) != ""  
    && strlen(trim($_POST['pregunta'])) > 3){
    include_once($pathSys."panel/BDconfig.php");
    include_once($pathSys."panel/clases/Comunes.class.php");
    include_once($pathSys."panel/clases/Conexion.class.php");
    include_once($pathSys."panel/clases/InsertaPregunta.class.php");
    $db  = new Conexion( $_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency = true );
    $pregunta = new InsertaPregunta($db, $_SESSION, $_POST, Comunes::SAVE);
    $array = array('exito' => $pregunta->obtenExito(),'msg' => $pregunta->obtenMensaje());
}
die(json_encode($array));
?>