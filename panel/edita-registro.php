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
	include_once ($_SESSION['pathCla']."Pedidos.class.php");
	include_once ($_SESSION['pathCla']."Producto.class.php");
	include_once ($_SESSION['pathCla']."Testimonial.class.php");
	include_once ($_SESSION['pathCla']."Preguntas.class.php");
	$url = "admin.php?idT=".$_POST['idModulo']."&idS=0&".$db->url();
	switch((int)$_POST['idModulo']){
		case 1:
			$usuario = new Usuario($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT);
			$array = array('regs' => $usuario->obtenRegistros());
			break;
		case 2:
			$slide = new Slider ($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT,0);
			$array = array('regs' => $slide->obtenRegistros());

			break;				
		case 3:
			$categoria = new Categoria($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT);
			$array = array('regs' => $categoria->obtenRegistros());
			break;					
		case 4:
			$producto = new Producto($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT);
			$array = array('regs' => $producto->obtenRegistros());
			break;	
		case 5:
			$pedido = new Pedidos($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT);
			$array = array('regs' => $pedido->obtenRegistros());
			break;					
		case 6:
			$testimonial = new Testimonial($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT);
			$array = array('regs' => $testimonial->obtenRegistros());
			break;
		case 7:
			$pregunta = new Preguntas($db,$_SESSION,$_POST,$_POST['id'],Comunes::EDIT);
			$array = array('regs' => $pregunta->obtenRegistros());
			break;
	}
}
die(json_encode($array));
?>