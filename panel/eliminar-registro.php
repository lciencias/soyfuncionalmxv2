<?php
include_once("includeAjax.php");
include_once ($_SESSION['pathSys']."BDconfig.php");
include_once ($_SESSION['pathSys']."revisaSesion.php");
include_once ($_SESSION['pathCla']."Conexion.class.php");
$db = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
$_SESSION['msgSuccess'] = $_SESSION['msgError'] = "";
$array = array();
if(isset($_POST) && ((int)$_POST['id'] > 0) && ((int) $_POST['idModulo'] > 0) ){
	include_once ($_SESSION['pathCla']."Comunes.class.php");
	include_once ($_SESSION['pathCla']."Slider.class.php");
	include_once ($_SESSION['pathCla']."Evento.class.php");
	include_once ($_SESSION['pathCla']."Revista.class.php");
	include_once ($_SESSION['pathCla']."Usuario.class.php");
	include_once ($_SESSION['pathCla']."Categoria.class.php");
	include_once ($_SESSION['pathCla']."Producto.class.php");
	include_once ($_SESSION['pathCla']."Testimonial.class.php");
	switch((int)$_POST['idModulo']){
		case 1:
			$slide = new Slider ($db,$_SESSION,$_POST,$_POST['id'],Comunes::DELETE,0);
			$array = array('exito' => $slide->obtenExito(),'msg' => $slide->obtenMensaje(), 'url' => "banner-lista.php");
			break;
		case 2:
			$usuario = new Usuario($db,$_SESSION,$_POST,$_POST['id'],Comunes::DELETE);
			$array = array('exito' => $usuario->obtenExito(),'msg' => $usuario->obtenMensaje(), 'url' => "usuarios-lista.php");
			break;					
		case 3:
			$categoria = new Categoria($db,$_SESSION,$_POST,$_POST['id'],Comunes::DELETE);
			$array = array('exito' => $categoria->obtenExito(),'msg' => $categoria->obtenMensaje(), 'url' => "categoria-lista.php");
			break;					
		case 4:
			$producto = new Producto($db,$_SESSION,$_POST,$_POST['id'],Comunes::LISTAR, Comunes::DELETE);
			$array = array('exito' => $producto->obtenExito(),'msg' => $producto->obtenMensaje(), 'url' => "producto-lista.php");
			break;					
		case 5:
			$testimonial = new Testimonial($db,$_SESSION,$_POST,$_POST['id'],Comunes::DELETE);
			$array = array('exito' => $testimonial->obtenExito(),'msg' => $testimonial->obtenMensaje(), 'url' => "testimonial-lista.php");
			break;
		case 6:
			$revista = new Revista($db,$_SESSION,$_POST,$_POST['id'],$_POST['id'],Comunes::DELETE);
			$array = array('exito' => $revista->obtenExito(),'msg' => $revista->obtenMensaje(), 'url' => "revista-lista.php");
			break;
	}
}
die(json_encode($array));
?>