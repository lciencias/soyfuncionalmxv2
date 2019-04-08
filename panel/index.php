<?php
include_once("include.php");
include_once("BDconfig.php");
$usuario = $clave = "";
if(isset($_POST['usuario'])){
	$usuario = trim($_POST['usuario']);
}
if(isset($_POST['clave'])){
	$clave = trim($_POST['clave']);
}
include_once ($pathCla."Conexion.class.php");
include_once ($pathCla."Comunes.class.php");
$_SESSION ['msgError']   = "";
if($_SESSION && (int)$_SESSION['userId'] > 0){
    header ( "Location: " . $path_web . "admin.php" );
}
if ($usuario != "" && $clave != "") {			
	include_once ($pathCla . "ValidaUsuario.class.php");
    include_once ($pathCla . "Session.class.php");
	$db = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
    $objVal = new ValidaUsuario ( $db, $_REQUEST, $_SERVER, $_SESSION, $pathWeb );
	if ($objVal->obtenExito ()) {		
		$_SESSION ['userId'] 	 = $objVal->obtenIdUser ();
		$_SESSION ['userNm'] 	 = $objVal->obtenNmUser ();
		$_SESSION ['userEmail']  = $objVal->obtenEmailUser();
		$_SESSION ['pathWeb']  	 = $pathWeb;
		$_SESSION ['pathSys']    = $pathSis;
		$_SESSION ['pathLib']  	 = $path_lib;
		$_SESSION ['pathFile']	 = $path_files;
		$_SESSION ['pathCla']	 = $pathCla;
		$_SESSION ['pathImg']	 = $pathImg;
		$_SESSION ['pathFileWeb']= $path_Wfiles;
		$_SESSION ['regs'] 		 = 100;
		$_SESSION ['page'] 		 = 1;
		$_SESSION ['folio'] 	 = 0;
		$_SESSION ['rol']   	 = 1;
		$_SESSION ['msgError']   = "";
		$_SESSION ['fechaMov']   = date("Y-m-d H:i:s");
		$_SESSION ['cerrarSesionMins']  = 15;
		$_SESSION ['msgWarning'] = "";
		$_SESSION ['msgSuccess'] = "";
		$_SESSION ['ip']    	 = $_SERVER['REMOTE_ADDR'];
		$obj_s 		   = new Session ( $db, $_SESSION, $_SERVER );
		$sesion_valida = $obj_s->Obten_Sesion ();
		$_SESSION ["session"] 	 = $sesion_valida;
		header ( "Location: " . $path_web . "admin.php" );
	} else {
		$_SESSION ['msgError']   =  $objVal->obtenMensaje ();
	}
}
/*  if(isset($_COOKIE['admin']))
  { 
    setcookie('admin', $_COOKIE['admin'] + 1, time() + 1095 * 24 * 60 * 60, "/"); 
    $mensaje = '';
  } 
  else 
  { 
    setcookie('admin', 1, time() + 1095 * 24 * 60 * 60, "/"); 
    $mensaje = ''; 
  } 
*/
include_once($path_sys ."header.php");
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=$pathWeb?>">
        <img src="<?=$pathImg?>logo.png" width="150">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><strong>Soy Funcional MX</strong><br>Tecleer la claves de acceso</p>

    <form action="<?=$pathWeb?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="usuario" id="usuario" placeholder="Correo Electr&oacute;nico" tabIndex="1"
        maxlength="20">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contrase&ntilde;a" tabIndex="2"
        maxlength="20" name="clave" id="clave">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordar
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
    include_once("script.php");
?>
</body>
</html>
