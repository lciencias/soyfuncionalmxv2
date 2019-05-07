<?php
  include_once("include.php");
  include_once($pathCla."Conexion.class.php");
  include_once($pathCla."Comunes.class.php");
  include_once($pathCla."Categoria.class.php");
  include_once($pathCla."Producto.class.php");
  include_once($pathCla."Populares.class.php");
  include_once($pathSis."panel/DBconfig.php");
  $cat = "idCat";
  $idCat = 0;
  $db     = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
  $categ  = new Categoria($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $categs = $categ->obtenRegistros();
  $prod   = new Producto($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $prods  = $prod->obtenRegistros();
  $pop    = new Populares($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $popul  = $pop->obtenRegistros();
  if(isset($_REQUEST[$cat]) && (int) $_REQUEST[$cat] > 0){
    $idCat = (int) $_REQUEST[$cat];
  }
  include_once("header.php");
?>
<body>
	<input type="hidden" id="baseUrl" name="baseUrl" value="<?=$pathWeb?>" />
	<input type="hidden" id="sessionId" name="sesionId" value="<?=$_SESSION['visitante']?>" />
  <input type="hidden" id="catId" name="catId" value="<?=( $idCat + 1 )?>" />
  <div class="preloader">
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
        <!--<section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=$pathWeb?>images/breadcrumbs-bg.jpg">
          <div class="breadcrumbs-custom-body parallax-content context-dark darken-overlay">
            <div class="container">
              <h2 class="breadcrumbs-custom-title">Arma tu Plato</h2>
            </div>
          </div>
        </div>
      </section>-->
      <!-- Section Shop-->
      <section class="text-md-left">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-4 col-xl-3">
              <div class="aside row row-30 row-md-50 justify-content-md-between">
                <div class="aside-item col-12">
                  <h6 class="aside-title">Fecha del pedido</h6>
                  <div class="group-xs group-justify">  
                    <div class="form-group">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                        </div>
                        <input type="text" style="width:120px;" class="form-control required datepicker"
                         id="fechaInicio" value="<?=$_SESSION['fechaPedido']?>" maxlength="10">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-item col-sm-6 col-md-5 col-lg-12">
                  <h6 class="aside-title">Categor&iacute;as</h6>
                  <ul class="list-shop-filter">
                  <?php
                    $contadorCat = 0;
                    foreach($categs as $idC => $dataC){
                      $totalProd = count($prods[$dataC['id']]);
                      $tmp = "  ";
                      if( (int) $idC == (int) $idCat){
                        $tmp = " checked ";
                      }
                  ?>
                    <li>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="idCat" id="<?=$dataC['id']?>" value="<?=$dataC['id']?>" 
                        class="seleccionCategoria" <?=$tmp?>><?=$dataC['nombre']?>
                      </label>
                       <span class="list-shop-filter-number">(<?=$totalProd?>)</span>
                    </li>
                  <?php
                    $contadorCat++;
                    }
                  ?>
                  </ul>
                </div>
                <?php
                if(count($popul) > 0){
                ?>
                <div class="aside-item col-sm-6 col-lg-12">
                  <h6 class="aside-title">Productos Populares</h6>
                  <div class="row row-10 row-lg-20 gutters-10">
                    <?php
                      foreach($popul as $idPop => $dataPop){
                    ?>
                    <div class="col-4 col-sm-6 col-md-12">
                      <article class="product-minimal">
                        <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                          <div class="unit-left">
                            <a class="product-minimal-figure-peq" href="<?=$pathWeb?>single-product.php">
                            <img src="<?=$dataPop['web']?>" alt="" width="106" height="104"/>
                            </a>
                          </div>
                          <div class="unit-body">
                            <p class="product-minimal-title"><a href="<?=$pathWeb?>single-product.php"><?=$dataPop['producto']?></a></p>
                            <p class="product-minimal-price"><?=$dataPop['precio']?></p>
                          </div>
                        </div>
                      </article>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="col-lg-8 col-xl-9">
              <div class="alert alert-success" id="aviso" role="alert" style="background-color:#fff;color:#fff;border:0px;"></div>
              <div class="row row-30 row-lg-50" id="cuadroGr">
                <?php
                  foreach($categs as $idCategoria => $dataCategoria){
                    $productos = $prods[($idCategoria + 1)];
                    foreach($productos as $idProd => $producto){
                ?>                                  
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4 cuadrados cuadro<?=($idCategoria + 1)?>">
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure">
                        <img src="<?=$producto['web']?>" alt="" style="width:220px;height:160px;"/>
                      </div>
                      <h5 class="product-title"><a href="<?=$pathWeb?>single-product.php"><?=$producto['producto']?></a></h5>
                      <div class="product-price-wrap">
                        <div class="product-caloria">Calorias: <?=$producto['caloria']?></div><br/>
                        <div class="product-price">Precio: <?=$producto['precio']?></div>
                      </div>
                    </div>
                    <div class="product-button-wrap">
                      <div class="product-button">
                        <a id="prod-<?=$idProd?>" class="button button-primary button-zakaria fl-bigmug-line-shopping202 seleccionaProducto" href="#"></a>
                      </div>
                    </div>
                  </article>
                </div>  
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
          require_once("footer.php");
         ?>
    </div>
    <div class="snackbars" id="form-output-global"></div>
    <?php
	    require_once($pathSis."scriptsDate.php");
    ?>