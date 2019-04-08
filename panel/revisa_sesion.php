<?php
include_once("include.php");
$fecha_actual   = date("Y-m-d H:i:s");
$fecha_registro = $_SESSION['fechaMov'];
$minutos = ceil( (strtotime($fecha_actual) - strtotime($fecha_registro)) / 60);
$cerrarSession = 0;
if ($minutos > $_SESSION ['cerrarSesionMins']) {
	$cerrarSession = 1;
}
echo $cerrarSession;
die();
?>