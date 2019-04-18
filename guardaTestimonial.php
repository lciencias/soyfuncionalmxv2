<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
set_time_limit (0);
error_reporting(-1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_PARSE);
ini_set('memory_limit', -1);
date_default_timezone_set("America/Mexico_City");
$array = array('exito' => 0,'msg' => 'Error al guardar la pregunta');
if ( $_SESSION['visitante'] == $_POST['sessionId'] && 
    trim($_POST['nombre']) != ""  && strlen(trim($_POST['nombre'])) > 3 &&
    trim($_POST['testimonial']) != ""  && strlen(trim($_POST['testimonial'])) > 3 
    ){
    include_once($pathWeb."panel/BDconfig.php");
    include_once($pathWeb."panel/clases/Comunes.class.php");
    include_once($pathWeb."panel/clases/Conexion.class.php");
    include_once($pathWeb."panel/clases/InsertaTestimonial.class.php");
    $db  = new Conexion( $_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency = true );
    $testimonial = new InsertaTestimonial($db, $_SESSION, $_POST, Comunes::SAVE);
    $array = array('exito' => $testimonial->obtenExito(),'msg' => $testimonial->obtenMensaje());
}
die(json_encode($array));
?>