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
        <div class="parallax-container" data-parallax-img="images/breadcrumbs-bg.jpg">
          <div class="breadcrumbs-custom-body parallax-content context-dark darken-overlay">
            <div class="container">
              <h2 class="breadcrumbs-custom-title">Datos de env&iacute;o</h2>
            </div>
          </div>
        </div>
      </section>
      <!-- Section checkout form-->
      <section class="section section-sm section-first bg-default text-md-left">
        <div class="container">
          <div class="row row-50 justify-content-center">
            <div class="col-md-10 col-lg-6">
              <h3 class="font-weight-medium">Direcci&oacute;n de env&iacute;o</h3>
              <form class="rd-form rd-mailform form-checkout">
                <div class="row row-30">
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="checkout-first-name-1" type="text" name="name" data-constraints="@Required"/>
                      <label class="form-label" for="checkout-first-name-1">Nombre(s)</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="checkout-last-name-1" type="text" name="name" data-constraints="@Required"/>
                      <label class="form-label" for="checkout-last-name-1">Apellidos</label>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-wrap">
                      <input class="form-input" id="checkout-address-1" type="text" name="name" data-constraints="@Required"/>
                      <label class="form-label" for="checkout-address-1">Direcci&oacute;n</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-wrap">
                      <select name="delegacion" id="delegacion" class="form-control">
                      <option value="0">Delegaci&oacute;n</option>
                      <option value="1">&Aacute;lvaro Obreg&oacute;n</option>
                      <option value="3">Coyoac&aacute;n</option>
                      <option value="16">Miguel Hidalgo</option>
                      </select>
                      <!--<label class="form-label" for="checkout-address-del">Delegaci&oacute;n     </label>-->
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="checkout-email-1" type="email" name="email" data-constraints="@Email @Required"/>
                      <label class="form-label" for="checkout-email-1">Correo Electr&oacute;nico</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-wrap">
                      <input class="form-input" id="checkout-phone-1" type="text" name="phone" data-constraints="@Numeric"/>
                      <label class="form-label" for="checkout-phone-1">Celular</label>
                    </div>
                  </div>
                </div>
                <label class="checkbox-inline text-transform-capitalize">
                  <!--<input name="input-checkbox-1" value="checkbox-1" type="checkbox"/>My Billing Address and Shipping Address are the same-->
                  (En caso de que no te encuentres en las delegaciones listadas, por favor comunicate al Tel:  55 51 31 86 96)
                </label>
              </form>
            </div>
            <div class="col-md-10 col-lg-6">
            <h3 class="font-weight-medium">Importe</h3>
              <div class="table-custom-responsive">
                <table class="table-custom table-custom-primary table-checkout">
                  <tbody>
                    <tr>
                      <td>Subtotal</td>
                      <td>$43</td>
                    </tr>
                    <tr>
                      <td>Importe</td>
                      <td>Gratis</td>
                    </tr>
                    <tr>
                      <td>Total</td>
                      <td>$43</td>
                    </tr>
                  </tbody>
                </table>
              </div>  
            </div>
          </div>
        </div>
      </section>
      <!-- Shopping Cart-->
      <section class="section section-sm bg-default text-md-left">
        <div class="container">
          <h3 class="font-weight-medium">Tu pedido</h3>
          <div class="table-custom-responsive">
            <table class="table-custom table-cart">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Caloria</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a class="table-cart-figure" href="#">
                  <img src="images/product-mini-4-146x132.png" alt="" width="146" height="132"/></a><a class="table-cart-link" href="single-product.html">Oranges</a></td>
                  <td>$20.00</td>
                  <td>
                    <div class="table-cart-stepper">
                      <input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                    </div>
                  </td>
                  <td>$20</td>
                </tr>
                <tr>
                  <td><a class="table-cart-figure" href="single-product.html"><img src="images/product-mini-5-146x132.png" alt="" width="146" height="132"/></a><a class="table-cart-link" href="single-product.html">Bananas</a></td>
                  <td>$23.00</td>
                  <td>
                    <div class="table-cart-stepper">
                      <input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                    </div>
                  </td>
                  <td>$23</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Section Payment-->
      <section class="section section-sm section-last bg-default text-md-left">
        <div class="container">
          <div class="row row-50 justify-content-center">
            <!--<div class="col-md-10 col-lg-6">
              <h3 class="font-weight-medium">Payment methods</h3>
              <div class="box-radio">
                <div class="radio-panel">
                  <label class="radio-inline active">
                    <input name="input-group-radio" value="checkbox-1" type="radio" checked>Direct Bank Transfer
                  </label>
                  <div class="radio-panel-content">
                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will be shipped right away.</p>
                  </div>
                </div>
                <div class="radio-panel">
                  <label class="radio-inline">
                    <input name="input-group-radio" value="checkbox-1" type="radio">PayPal
                  </label>
                  <div class="radio-panel-content">
                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                  </div>
                </div>
                <div class="radio-panel">
                  <label class="radio-inline">
                    <input name="input-group-radio" value="checkbox-1" type="radio">Cheque Payment
                  </label>
                  <div class="radio-panel-content">
                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                  </div>
                </div>
              </div>
            </div>-->
            <div class="col-md-10 col-lg-6">
              
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