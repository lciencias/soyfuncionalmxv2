<?php

function calculaImporte($prods, $session){
    $importe = 0.00;
    $seleccion = $session['productos'];
    foreach($seleccion as $fechaP => $data){
      foreach($data as $idProd => $cantidad){
        $producto = $prods[$idProd];
        $importe = $importe + ($producto['precio'] * $cantidad) + 0.00;
      }
    }
    return $importe;
  }
  
  function calculaProductos($seleccion){
    $noProductos = 0;
    foreach($seleccion as $fecha => $data){
      foreach($data as $idProd => $cantidad){
        $noProductos = $noProductos + $cantidad + 0;
      }
    }
    return $noProductos;
  }

  ?>