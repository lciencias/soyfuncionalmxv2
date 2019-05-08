<?php
  include_once("include.php");
  include_once($pathCla."Conexion.class.php");
  include_once($pathCla."Comunes.class.php");
  include_once($pathCla."Producto.class.php");
  include_once($pathSis."panel/DBconfig.php");
  $db     = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
  $prod   = new Producto($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB2);
  $prods  = $prod->obtenRegistros();
  $envio  = 0.00;
  $importe = calculaImporte($prods, $session);
  $_SESSION['importe'] = $importe;
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
    <section>
      <div class="container">
      <?php
        $fechas = obtenFechas($_SESSION);
        $buffer = numeroPedido($prods, $_SESSION);
        echo $buffer;
      ?>
        <ul class="nav nav-tabs" role="tablist" id="tabs">
          <li class="active">
            <a href="#resumen" role="tab" data-toggle="tab">
              <span style="color:#002857"><b>Resum&eacute;n  del Pedido</b></span>
            </a>
          </li>
          <li>
            <a href="#envio" role="tab" data-toggle="tab">
              <span style="color:#002857">Direcci&oacute;n de envi&oacute;</b></span>
            </a>
          </li>
        </ul> 
        <div class="tab-content">
          <div class="tab-pane active" id="resumen" style="text-align:center;">
            <?php
              $buffer = "<br><span style='color:#002857;font-size:20px;'>Pedidos por d&iacute;a</span><br>".generaTabs($fechas);
              $buffer.= contenidos($fechas, $prods, $_SESSION, $pathweb);
              echo $buffer;
            ?>        
          </div>
          <div class="tab-pane" id="envio">
            <div class="row row-30 justify-content-center">
              <div class="col-md-6">
                <?php
                  echo formulario();
                ?>
              </div>
              <div class="col-md-6">
                <?php
                  echo importe($_SESSION['importe'] , $envio, $pathWeb);
                ?>  
              </div>
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

<?php
/** Funciones adicionales */
function regresaProductos($prods, $fecha,$seleccion){
  $arrayTmp = array();
  foreach($seleccion as $data){
    $temporal = explode('|',$data);
    $fechaP   = $temporal[0];
    $idProd   = $temporal[1];  
    if($fecha == $fechaP && array_key_exists($idProd, $prods)){
        $prods[$idProd]['cantidad'] = $prods[$idProd]['cantidad'] + 1 ;
        $arrayTmp[$idProd]          = $prods[$idProd];
    }
  }
  return $arrayTmp;
}


function generaTabla($datas, $session, $pathWeb, $fecha){
  $precioDia = 0;
  $buffer = '
    <div class="cart-inline-body">';
    foreach($datas as $idProducto => $data){
      $buffer .='
        <div class="cart-inline-item">
          <div class="unit unit-spacing-sm align-items-center">
            <div class="unit-left">
              <a class="cart-inline-figure" href="#">
                <img src="'.$data['web'].'" style="width:100px; height:90px;" alt="'.$data['producto'].'" />
              </a>
            </div>
            <div class="unit-body">
              <h6 class="cart-inline-name">'.$data['producto'].'</h6>												
              <div class="group-xs group-middle form-inline">
                <table class="table">
                  <tr>
                    <td>
                      <button type="button" id="menos-'.$idProducto.'" class="btn btn-default menos" style="width:40px;">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                      </button>
                    </td>
                    <td>
                      <input type ="text" id="cantidad-'.$idProducto.'" class ="form-control" readonly="true"
                      value="'.$data['cantidad'].'" style="border:1px solid #e5e5e5;background-color:#fff;width:40px;"/>
                    </td>
                    <td>
                      <button type="button" id="mas-'.$idProducto.'" class="btn btn-default mas" style="width:40px;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                      </button>
                    </td>
                    <td>
                      <input type="hidden" id="unitario-'.$idProducto.'" value="'.$data['precio'].'">
                      <input type="text" id="importe-'.$idProducto.'" class="form-control" readonly="true"
                       value="'.$data['precio'].'" style="border:1px solid #e5e5e5;background-color:#fff;width:100px;">
                    </td>
                    <td>
                      <button type="button" id="eliminar-'.$idProducto.'" 
                        class="btn btn-default elimina" style="width:40px;">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                </table>
              </div>									
            </div> 
          </div> 
        </div> ';
        $precioDia = $precioDia + ($data['precio'] * $data['cantidad']) + 0.00;
      }
      $buffer .= '<h6 class="cart-inline-title" id="pedidofecha-'.$fecha.'">
      <span style="color:#e7e76a;">Importe del d&iacute;a: </span><span style="color:#002857;" id="simportedia-'.$fecha.'"> $ '.number_format($precioDia, 2, '.', '').'</span>
      </h6>
      <input type="hidden" id="importedia-'.$fecha.'" value="'.number_format($precioDia, 2, '.', '').'">
      </span></h6></div>';
  return $buffer;        
}

function generaTabs($arrayFechas){
  $contador = 0;
  $buf   = "";
  if(count($arrayFechas) > 0){
    $buf .= '<input type="hidden" id="fechainicial" value="'.$arrayFechas[0].'">
     <ul class="nav nav-tabs" role="tablist" id="tabs">';
    foreach($arrayFechas as $fecha){
      $tmp = ($contador == 0) ? " class='active' " : " ";
      
      $buf .= '<li '.$tmp.'>
          <a href="#hometab'.$contador.'" role="tab" data-toggle="tab" id="'.$fecha.'" class="selecTab">
          <span style="color:#56555a">D&iacute;a: <b>'.$fecha.'</b></span></a>
          </li>';
      $contador++;
    }
    $buf .= '</ul>';
    return $buf;
  }
}

function contenidos($arrayFechas, $prods, $session, $pathweb){ 
  $contador = 0;
  $buf = '<div class="tab-content">';
  foreach($arrayFechas as $fecha){
    $tmp  = ($contador == 0) ? " active" : "";
    $buf .='<div class="tab-pane'.$tmp.'" id="hometab'.$contador.'">';
    $array= regresaProductos($prods, $fecha ,$session['productos']);
    $buf .= generaTabla($array, $session, $pathWeb, $fecha);
    $buf .='</div>';
    $contador++;
  }
  $buf .='</div>';
  return $buf;
}

function obtenFechas($session){
  $arrayFechas = array();
  foreach($session['productos'] as $data){
    $temporal = explode('|',$data);
    if(!in_array($temporal[0], $arrayFechas)){
      $arrayFechas[]= $temporal[0];
    }
  }
  return $arrayFechas;
}

function numeroPedido($prods, $session){
  $importe = calculaImporte($prods, $session);
  $_SESSION['importe'] = $importe;
  $buf = '<div class="row">
            <div class="col-md-6">
              <h5 class="cart-inline-title" id="noPedido">
                <span style="color:#002857;">No. de Pedido: '.$session['visitante'].'</span>
              </h5><br>      
            </div>
            <div class="col-md-6">
              <h6 class="cart-inline-title" id="impPedido">
                <input type="hidden" id="importeTotal" value="'.$importe.'">
                <span style="color:#e7e76a;">Importe Total: </span><span style="color:#002857;" id="txtImporteTotal">&nbsp;$&nbsp;'.number_format($importe, 2, '.', '').'</span>
              </h6><br>
            </div>
          </div>';
    return $buf;
}

function botonEnviarPedido($pathWeb){
  $buf = '<div class="cart-inline-footer">
            <div class="group-sm">
              <button type="button" class="button button-success button-zakaria" id="continuar">Continuar seleccionando</button>
              <button type="button" class="button button-primary button-zakaria" id="enviarPedido">Enviar Pedido</button>
            </div>
        </div>';
  return $buf;
}

function calculaImporte($prods, $session){
  $importe = 0.00;
  $seleccion = $session['productos'];
  foreach($seleccion as $data){
    $temporal = explode('|',$data);
    $fechaP   = $temporal[0];
    $idProd   = $temporal[1];  
    $producto = $prods[$idProd];
    $importe = $importe + $producto['precio'] + 0.00;
  }
  return $importe;
}

function formulario(){
  $buf = '
    <form>
      <div class="row">
        <div class="col-md-12">
          <div class="form-wrap">            
            <input class="form-input"  id="name" type="text" name="name" tabIndex="1" class="letras" maxlength="60"/>
            <span id="errorNombre" class="errorCampo"></span>
            <label class="form-label" for="name" >Nombre</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-wrap">
            <input class="form-input" id="email" type="email" name="email" tabIndex="2" maxlength="65" class="correo"/>
            <span id="errorEmail" class="errorCampo"></span>
            <label class="form-label" for="email">Correo Electr&oacute;nico</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-wrap">
            <input class="form-input" id="phone" type="text" name="phone" tabIndex="3"  maxlength="10" class="numeros"/>
            <span id="errorPhone" class="errorCampo"></span>
            <label class="form-label" for="phone">Celular</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-wrap">
            <input class="form-input" id="address" type="text" name="name" tabIndex="4"  />
            <span id="errorAddress" class="errorCampo"></span>
            <label class="form-label" for="address">Direcci&oacute;n</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-wrap">
            <select name="delegacion" id="delegacion" class="form-control" tabIndex="5" >
              <option value="0">Delegaci&oacute;n</option>
              <option value="1">&Aacute;lvaro Obreg&oacute;n</option>
              <option value="3">Coyoac&aacute;n</option>
              <option value="16">Miguel Hidalgo</option>
            </select>
            <label class="form-label" for="delegacion">Delegaci&oacute;n</label>
          </div>
        </div>
        <div class="col-md-6" style="text-align:justify;">
        (En caso de que no te encuentres en las delegaciones listadas, por favor comunicate al Tel:  55 51 31 86 96)
        </div>
      </div>
    </form>';
  return $buf;
}

function importe($importe , $envio, $pathWeb){
  $ruta = $pathWeb."grid-shop.php";
  $buf = '
    <div class="table-custom-responsive">
      <table class="table-custom table-custom-primary table-checkout">
        <tbody>
          <tr>
            <td>Subtotal</td>
            <td>$&nbsp;'.number_format($importe, 2, '.', '').'</td>
          </tr>
          <tr>
            <td>Env&iacute;o</td>
            <td>$&nbsp;'.number_format($envio, 2, '.', '').'</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>$&nbsp;'.number_format( ($importe + $envio ), 2, '.', '').'</td>
          </tr>
          <tr>
            <td  style="text-align:center;">
              <button type="button" id="continuarPedido" tabIndex="6" class="button button-success button-zakaria" id="continuar">Continuar pedido</button>
            </td>
            <td  style="text-align:center;">
              <button type="button" tabIndex="7" class="button button-primary button-zakaria" id="enviarPedido">Enviar Pedido</button>
            </td>
        </tbody>
      </table>
    </div>';
    return $buf;
}
?>