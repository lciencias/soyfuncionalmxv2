<?php
include_once ("include.php");
include_once ($pathSis."BDconfig.php");
include_once ($pathSis."revisaSesion.php");
include_once ($pathCla."Conexion.class.php");
include_once ($pathInt."InterfazCatalogos.php");
include_once ($pathCla."Inicio.class.php");
include_once ($pathCla."Usuario.class.php");
include_once ($pathCla."Slider.class.php");
include_once ($pathCla."Categoria.class.php");
include_once ($pathCla."Producto.class.php");
include_once ($pathCla."Pedidos.class.php");
include_once ($pathCla."Testimonial.class.php");
include_once ($pathCla."Preguntas.class.php");
include_once ($pathCla."Boletin.class.php");
$objeto    = null;
$registros = array();
$total     = 0;
$bread     = "";
$titulo    = "";
$tituloBoton="";
$modalId   = "";
$idT = (int) $_REQUEST['idT'] + 0;
$db  = new Conexion( $_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency = true );
$ext = $db->url(); 
$modalId   = "modal".$idT;
if($idT > 0 && $idT < 9){
    $objetoI    = new Inicio( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
    $_SESSION['pendientesT'] =  $objetoI->obtenTotal();
    $_SESSION['pendientes']  =  $objetoI->obtenRegistros();
}
switch($idT){
    case 0:
        $objeto    = new Inicio( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
        $pendientes= $objeto->obtenTotal();
        $_SESSION['pendientesT'] =  $pendientes;
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $registros = $objeto->obtenRegistros();
        $_SESSION['pendientes'] = $registros;
        $tituloBoton= "";
        $total     = 0;
        break;
    case 1:
        $objeto    = new Usuario( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
        $registros = $objeto->obtenRegistros();
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $total     = count($registros);
        $titulo    = "Listado de Usuarios";
        $tituloBoton= "Alta de Usuario";
        break;
    case 2:
        $objeto    = new Slider ($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR,0);
        $registros = $objeto->obtenRegistros();
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $total     = count($registros);
        $titulo    = "Listado de Banners";
        $tituloBoton= "Alta de Banners";
        break;        
    case 3:
        $objeto    = new Categoria( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
        $registros = $objeto->obtenRegistros();
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $total     = count($registros);
        $titulo    = "Listado de Categorias";
        $tituloBoton= "Alta de Categor&iacute;a";
        break;
    case 4:
        $objeto    = new Producto ($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR,Comunes::LISTAR);
        $registros = $objeto->obtenRegistros();
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $total     = count($registros);
        $titulo    = "Listado de Productos";
        $tituloBoton= "Alta de Productos";
        $categorias = $objeto->obtenCategorias();
        break;
    case 5:
        $objeto    = new Pedidos ($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR,Comunes::LISTAR);
        $registros = $objeto->obtenRegistros();
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $total     = count($registros);
        $titulo    = "Listado de Pedidos";
        $tituloBoton= "";
        break;
    case 6:
        $objeto     = new Testimonial( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
        $registros  = $objeto->obtenRegistros();
        $bread      = $objeto->obtenBreadcrumb();
        $table      = $objeto->obtenBuffer();
        $total      = count($registros);
        $titulo     = "Listado de Testimoniales";
        $tituloBoton= "Alta de Testimonial";
        break;
    case 7:
        $objeto     = new Preguntas( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
        $registros  = $objeto->obtenRegistros();
        $bread      = $objeto->obtenBreadcrumb();
        $table      = $objeto->obtenBuffer();
        $total      = count($registros);
        $titulo     = "Listado de Preguntas";
        $tituloBoton= "";
        break;
    case 8:
        $objeto     = new Boletin( $db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::LISTAR );
        $registros  = $objeto->obtenRegistros();
        $bread      = $objeto->obtenBreadcrumb();
        $table      = $objeto->obtenBuffer();
        $total      = count($registros);
        $titulo     = "Listado de correos electr&oacute;nicos del bolet&iacute;n";
        $tituloBoton= "";
        break;
    default:
        $objeto    = new Inicio($db);
        $registros = $objeto->obtenRegistros();
        $bread     = $objeto->obtenBreadcrumb();
        $table     = $objeto->obtenBuffer();
        $tituloBoton= "";
        $total     = 0;
        break;
}
include_once ($pathSys."headerAdmin.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
<input type="hidden" name="baseUrl" id="baseUrl" value="<?=$pathWeb?>">
<div class="wrapper">
    <header class="main-header">
        <a href="<?=$pathWeb?>admin.php" class="logo">
            <span class="logo-mini"><b>F</b>MX</span>
            <span class="logo-lg"><b>Soy Funcional</b>MX</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <?php
                    include_once("estadistica.php");
                ?>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?php
                include_once($pathSis."buscador.php");     
                include_once($pathSis."menu.php");
            ?>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <?=$panelTitle?>
            <?=$bread?>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3 class="box-title"><?=$titulo?></h3>
                                </div>
                                <div class="col-md-3 tdRight">
                                    <?php
                                    if(trim($tituloBoton) != ""){
                                    ?>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#<?=$modalId?>">
                                        <?=$tituloBoton?>
                                         </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                      
                            
                        </div>
                        <div class="box-body"><?=$table?></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
        include_once($pathSys."footer.php");
        include_once($pathSys."controles.php");
    ?>
  <div class="control-sidebar-bg"></div>
</div>
<?php
include_once($pathSys."scriptsAdmin.php");
?>

<!-- Modales -->
<?php
switch($idT){
    case 1:
        require_once("modal1.php");
        break;
    case 2:
        require_once("modal2.php");
        break;
    case 3:
        require_once("modal3.php");
        break;
    case 4:
        require_once("modal4.php");
        break;
    case 6:
        require_once("modal6.php");
        break;
    case 7:
        require_once("modal7.php");
        break;
}
?>