<?php
  include_once("include.php");
  include_once($pathCla."Conexion.class.php");
  include_once($pathCla."Comunes.class.php");
  include_once($pathCla."Categoria.class.php");
  include_once($pathCla."Producto.class.php");
  include_once($pathCla."Populares.class.php");
  include_once($pathSis."panel/DBconfig.php");
  
  $db     = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
  $categ  = new Categoria($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $categs = $categ->obtenRegistros();
  $prod   = new Producto($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $prods  = $prod->obtenRegistros();
  $pop    = new Populares($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $popul  = $pop->obtenRegistros();
//  echo"<pre>";
//  print_r($popul);die("coun:  ".count($popul));
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
        <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=$pathWeb?>images/breadcrumbs-bg.jpg">
          <div class="breadcrumbs-custom-body parallax-content context-dark darken-overlay">
            <div class="container">
              <h2 class="breadcrumbs-custom-title">Arma tu Plato</h2>
            </div>
          </div>
        </div>
      </section>
      <!-- Section Shop-->
      <section class="section section-xxl bg-default text-md-left">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-4 col-xl-3">
              <div class="aside row row-30 row-md-50 justify-content-md-between">
                <div class="aside-item col-12">
                  <h6 class="aside-title">Fechas</h6>
                  <!-- RD Range-->
                  <div class="rd-range" data-min="0" data-max="999" data-min-diff="100" data-start="[10, 250]" data-step="1" data-tooltip="false" data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2"></div>
                  <div class="group-xs group-justify">
                    <div>
                      <button class="button button-sm button-primary button-zakaria" type="button">Filter</button>
                    </div>
                    <div>
                      <div class="rd-range-wrap">
                        <div class="rd-range-title">Price:</div>
                        <div class="rd-range-form-wrap"><span>$</span>
                          <input class="rd-range-input rd-range-input-value-1" id="test" type="text" name="value-1">
                        </div>
                        <div class="rd-range-divider"></div>
                        <div class="rd-range-form-wrap"><span>$</span>
                          <input class="rd-range-input rd-range-input-value-2" type="text" name="value-2">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-item col-sm-6 col-md-5 col-lg-12">
                  <h6 class="aside-title">Categor&iacute;as</h6>
                  <ul class="list-shop-filter">
                  <?php
                    foreach($categs as $idC => $dataC){
                      $totalProd = count($prods[$dataC['id']]);

                  ?>
                    <li>
                      <label class="checkbox-inline">
                        <input name="input-group-radio" value="<?=$dataC['id']?>" 
                        type="checkbox"><?=$dataC['nombre']?>
                      </label><span class="list-shop-filter-number">(<?=$totalProd?>)</span>
                    </li>
                  <?php
                    }
                  ?>
                  </ul>
                  <!-- RD Search Form-->
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
              <div class="row row-30 row-lg-50">
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-1-220x160.png" alt="" width="220" height="160"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Bananas</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price product-price-old">$30.00</div>
                        <div class="product-price">$23.00</div>
                      </div>
                    </div><span class="product-badge product-badge-sale">Sale</span>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-2-191x132.png" alt="" width="191" height="132"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Potatoes</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$13.00</div>
                      </div>
                    </div><span class="product-badge product-badge-new">New</span>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-3-238x158.png" alt="" width="238" height="158"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Carrots</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$17.00</div>
                      </div>
                    </div>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-4-204x125.png" alt="" width="204" height="125"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Bread</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$11.00</div>
                      </div>
                    </div><span class="product-badge product-badge-new">New</span>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-5-204x156.png" alt="" width="204" height="156"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Strawberries</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$15.00</div>
                      </div>
                    </div>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-6-237x156.png" alt="" width="237" height="156"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Cucumbers</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price product-price-old">$32.00</div>
                        <div class="product-price">$22.00</div>
                      </div>
                    </div><span class="product-badge product-badge-sale">Sale</span>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-7-210x168.png" alt="" width="210" height="168"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Sweet peppers</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$14.00</div>
                      </div>
                    </div><span class="product-badge product-badge-new">New</span>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-8-210x133.png" alt="" width="210" height="133"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Bagels</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$10.00</div>
                      </div>
                    </div>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
                  <!-- Product-->
                  <article class="product">
                    <div class="product-body">
                      <div class="product-figure"><img src="images/product-9-185x155.png" alt="" width="185" height="155"/>
                      </div>
                      <h5 class="product-title"><a href="single-product.html">Galia melons</a></h5>
                      <div class="product-price-wrap">
                        <div class="product-price">$18.00</div>
                      </div>
                    </div>
                    <div class="product-button-wrap">
                      <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                      <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a></div>
                    </div>
                  </article>
                </div>
              </div>
              <div class="pagination-wrap">
                <!-- Bootstrap Pagination-->
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <li class="page-item page-item-control disabled"><a class="page-link" href="#" aria-label="Previous"><span class="icon" aria-hidden="true"></span></a></li>
                    <li class="page-item active"><span class="page-link">1</span></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item page-item-control"><a class="page-link" href="#" aria-label="Next"><span class="icon" aria-hidden="true"></span></a></li>
                  </ul>
                </nav>
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
	    require_once($pathSis."scripts.php");
    ?>