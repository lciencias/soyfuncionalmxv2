
<?php
include_once("include.php");
include_once($pathCla."Conexion.class.php");
include_once($pathCla."Comunes.class.php");
include_once($pathCla."Logout.class.php");
$db 	   = new Conexion($_dbhost, $_dbuname, $_dbpass, $_dbname, $_port);
$objLogout = new Logout($db,$_SESSION,$_SERVER,$pathWeb);
session_destroy();
header("Location:  ".$pathWeb);
?>