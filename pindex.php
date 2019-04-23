<?php
  include_once("include.php");
  include_once($pathCla."Conexion.class.php");
  include_once($pathCla."Comunes.class.php");
  include_once($pathCla."Categoria.class.php");
  include_once($pathCla."Producto.class.php");
  include_once($pathSis."panel/DBconfig.php");
  
  $db     = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
  $categ  = new Categoria($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $categs = $categ->obtenRegistros();
  $prod   = new Producto($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $prods  = $prod->obtenRegistros();
  include_once("header.php");
?>
<body>
	<input type="hidden" id="baseUrl" name="baseUrl" value="<?=$pathWeb?>" />
	<input type="hidden" id="sessionId" name="sesionId" value="<?=$_SESSION['visitante']?>" />		<div class="preloader">
    <div class="preloader-body">
        <div class="cssload-bell">
          <div class="cssload-circle">
            <div class="cssload-inner"></div>
          </div>
          <div class="cssload-circle">
            <div class="cssload-inner"></div>
          </div>
          <div class="cssload-circle">
            <div class="cssload-inner"></div>
          </div>
          <div class="cssload-circle">
            <div class="cssload-inner"></div>
          </div>
          <div class="cssload-circle">
            <div class="cssload-inner"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="page">
        <header class="section page-header">
    		<?php
          require_once($pathSis."superior.php");
        ?>
		    </header>
        <section class="section section-xxl bg-default">
		    <?php
			    require_once($pathSis."productosCat.php");
	    	?>
	      </section>
        <?php
          require_once("footer.php");
         ?>
    </div>
    <?php
	    require_once($pathSis."scripts.php");
    ?>