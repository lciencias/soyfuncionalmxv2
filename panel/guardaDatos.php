<?php
include_once("includeAjax.php");
include_once ($_SESSION['pathSys']."BDconfig.php");
include_once ($_SESSION['pathSys']."revisaSesion.php");
include_once ($_SESSION['pathCla']."Conexion.class.php");
$db = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
$_SESSION['msgSuccess'] = $_SESSION['msgError'] = "";
$array = array();
if(isset($_POST)  && (int) $_POST['idT'] > 0 && (int) $_POST['idT'] < 7 && ((int) $_SESSION['userId'] > 0) ){
    include_once ($_SESSION['pathCla']."Comunes.class.php");
	include_once ($_SESSION['pathCla']."Slider.class.php");
	include_once ($_SESSION['pathCla']."Usuario.class.php");
	include_once ($_SESSION['pathCla']."Categoria.class.php");
	include_once ($_SESSION['pathCla']."Producto.class.php");
    include_once ($_SESSION['pathCla']."Testimonial.class.php");
	$url = "admin.php?idT=".$_POST['idT']."&idS=0&".$db->url();
	switch((int)$_POST['idT']){
        case 1:
			$usuario = new Usuario($db,$_SESSION,$_POST,$_POST['idT'], Comunes::SAVE);
			$array = array('exito' => $usuario->obtenExito(),'msg' => $usuario->obtenMensaje(), 'url' => $url);
			break;
		case 2:
			$idImagen = $idImagenM = 0;
        	if( isset($_FILES) && isset($_FILES['image']['name'])){
				include_once ($_SESSION ['pathCla']."Imagen.class.php");
				$imagen   = new Imagen ($db,$_SESSION,$_FILES,Comunes::SAVE);
				$idImagen = $imagen->obtenIdImagen();
			}
			if( isset($_FILES) && isset($_FILES['imageM']['name'])){
				include_once ($_SESSION ['pathCla']."ImagenBiz.class.php");
				$imagenM   = new ImagenBiz ($db,$_SESSION,$_FILES,Comunes::SAVE);
				$idImagenM = $imagenM->obtenIdImagen();
			}
			$slide = new Slider ($db,$_SESSION,$_POST,$idImagen,Comunes::SAVE,$idImagenM);
			$array = array('exito' => $slide->obtenExito(),'msg' => $slide->obtenMensaje(), 'url' => $url);
			break;
		case 3:
			$categ = new Categoria ($db,$_SESSION,$_POST,$_POST['idT'], Comunes::SAVE);
			$array = array('exito' => $categ->obtenExito(),'msg' => $categ->obtenMensaje(), 'url' => $url);
			break;
		case 4:
			$idImagen = 0;
        	if( isset($_FILES) && isset($_FILES['image']['name'])){
				include_once ($_SESSION ['pathCla']."Imagen.class.php");
                $imagen   = new Imagen ($db,$_SESSION,$_FILES,Comunes::SAVE);
				$idImagen = $imagen->obtenIdImagen();
				$produ = new Producto ($db,$_SESSION,$_POST,$idImagen,Comunes::SAVE);
				$array = array('exito' => $produ->obtenExito(),'msg' => $produ->obtenMensaje(), 'url' => $url);
			}
			break;
		case 6:
			$testi = new Testimonial($db, $_SESSION, $_POST, $_POST['idT'], Comunes::SAVE);
			$array = array('exito' => $testi->obtenExito(),'msg' => $testi->obtenMensaje(), 'url' => $url);
			break;
			
    }
}
die(json_encode($array));
?>