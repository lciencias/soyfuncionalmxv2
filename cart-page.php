<?php
  include_once("include.php");
  include_once($pathCla."Conexion.class.php");
  include_once($pathCla."Comunes.class.php");
  include_once($pathCla."Producto.class.php");
  include_once($pathSis."panel/DBconfig.php");
  $db     = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
  $prod   = new Producto($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB2);
  $prods  = $prod->obtenRegistros();
  calculaImporte($prods, $_SESSION);
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
    <!--<section class="breadcrumbs-custom">
      <div class="parallax-container" data-parallax-img="<?=$pathWeb?>images/breadcrumbs-bg.jpg">
        <div class="breadcrumbs-custom-body parallax-content context-dark darken-overlay">
          <div class="container">
            <h2 class="breadcrumbs-custom-title">Pedido</h2>
          </div>
        </div>
      </div>
    </section>-->
    <section>
      <div class="container">
      <?php
        $fechas = obtenFechas($_SESSION);
        $buffer = numeroPedido($prods, $_SESSION);
        $buffer.= generaTabs($fechas);
        $buffer.= contenidos($fechas, $prods, $_SESSION, $pathweb);
        $buffer.= botonEnviarPedido($pathWeb);
        echo $buffer;
      ?>
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
        Importe del d&iacute;a:<span> $ '.number_format($precioDia, 2, '.', '').'</span>
      </h6>
      <input type="hidden" id="importedia-'.$fecha.'" value="'.number_format($precioDia, 2, '.', '').'">
      </span></h6></div>';
  return $buffer;        
}

function generaTabs($arrayFechas){
  $contador = 0;
  $buf   = "";
  if(count($arrayFechas) > 0){
    $buf .= ' <ul class="nav nav-tabs" role="tablist">';
    foreach($arrayFechas as $fecha){
      $tmp = ($contador == 0) ? " class='active' " : " ";
      $buf .= '<li '.$tmp.'>
          <a href="#hometab'.$contador.'" role="tab" data-toggle="tab">
          <span style="color:#002857">Pedido del d&iacute;a: <b>'.$fecha.'</b></span></a>
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
  $buf = '						
    <div class="cart-inline-header">
      <h5 class="cart-inline-title" id="noPedido">
        No. de Pedido:<span> '.$session['visitante'].'</span>
      </h5>
      <h6 class="cart-inline-title" id="impPedido">
        <input type="hidden" id="importeTotal" value="'.$importe.'">
        Importe:&nbsp;<span id="txtImporteTotal">&nbsp;$&nbsp;'.number_format($importe, 2, '.', '').'</span>
      </h6>
      <span id="ayuda" style="font-size:14px;color:#ff0000;font-weight:bold;"></span>
    </div>';
    return $buf;
}

function botonEnviarPedido($pathWeb){
  $buf = '<div class="cart-inline-footer">
            <div class="group-sm">
              <a class="button button-primary button-zakaria" href="'.$pathWeb.'cart-page.php">Enviar Pedido</a>
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
?>