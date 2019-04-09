<?php 
include_once("includeAjax.php");
include_once ($_SESSION['pathSys']."BDconfig.php");
include_once ($_SESSION['pathCla']."Conexion.class.php");
$db = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
$array= array();
die(json_encode($array));
?>