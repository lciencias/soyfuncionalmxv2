<?php
include_once("includeAjax.php");
include_once ($_SESSION['pathSys']."BDconfig.php");
include_once ($_SESSION['pathSys']."revisaSesion.php");
include_once ($_SESSION['pathCla']."Conexion.class.php");
$db = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
$_SESSION['msgSuccess'] = $_SESSION['msgError'] = "";
$array = array();
if(isset($_POST) && ((int)$_POST['id'] > 0) && ((int) $_POST['idModulo'] > 0) && ( (int) $_POST['valor'] > 0 ) ){
	include_once ($_SESSION['pathCla']."Comunes.class.php");
	include_once ($_SESSION['pathCla']."Slider.class.php");
	include_once ($_SESSION['pathCla']."Evento.class.php");
	include_once ($_SESSION['pathCla']."Revista.class.php");
	include_once ($_SESSION['pathCla']."Usuario.class.php");
	include_once ($_SESSION['pathCla']."Categoria.class.php");
	include_once ($_SESSION['pathCla']."Producto.class.php");
	$url = "admin.php?idT=".$_POST['idModulo']."&idS=0&".$db->url();
	switch((int)$_POST['idModulo']){
		case 2:
			$slide = new Slider ($db,$_SESSION,$_POST,$_POST['id'],Comunes::ORDENAR,0);
			$array = array('exito' => $slide->obtenExito(),'msg' => $slide->obtenMensaje(), 'url' => $url);
			break;
		case 3:
			$categoria = new Categoria($db,$_SESSION,$_POST,$_POST['id'],Comunes::ORDENAR);
			$array = array('exito' => $categoria->obtenExito(),'msg' => $categoria->obtenMensaje(), 'url' => $url);
			break;					
		case 4:
			$producto = new Producto($db,$_SESSION,$_POST,$_POST['id'],Comunes::ORDENAR);
			$array = array('exito' => $producto->obtenExito(),'msg' => $producto->obtenMensaje(), 'url' => $url);
			break;					
	}
}
die(json_encode($array));
?>