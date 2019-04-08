<?php
session_start();
//$ses = session_save_path ($path_psis."/tmp/");
include_once($pathCla."Comunes.class.php");
include_once($pathCla."Conexion.class.php");
include_once($pathCla."Visitante.class.php");
$db   = new Conexion($_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency = true );
if (!$_SESSION['contador']) {
	$visita  = new Visitante($db, $_SESSION, $_SERVER,Comunes::LISTAR);
	$visita  = new Visitante($db, $_SESSION, $_SERVER,Comunes::SAVE);
	$_SESSION['contador'] = $visita->obtenNoVisita();
}
?>