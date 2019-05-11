<?php
include_once ("Comunes.class.php");
class InsertaPedido extends Comunes{
	private $db;
	public  $session;
	private $data;
	private $opc;
	private $mensaje;
	private $exito;
	private $productos;
	private $usuario;
	private $delegaciones;
	
	function __construct($db,$session,$data,$opc){
		parent::__construct($session);
		$this->db 		   = $db;
		$this->session     = $session;
		$this->data        = $data;
		$this->opc         = $opc;
		$this->tabla       = "pedidos";
		$this->exito       = Comunes::LISTAR;
		$this->productos   = array();
		$this->delegaciones = array(1 => 'Alvaro Obregon', 3 => 'Coyoacan', 16 => 'Miguel Hidalgo');
		$this->catalogoProductos();	
		switch($this->opc){
			case Comunes::SAVE:
				$this->guardar();
                break;
        }
	}

	private function catalogoProductos(){
		$this->productos   = array();
		try{
			$sql = "SELECT b.id as idproducto,b.producto,b.caloria,b.precio,b.idimagen,c.web,c.ruta 
					FROM productos b  
					LEFT JOIN  imagen as c on c.idimagen = b.idimagen 
					WHERE  b.status = '".Comunes::SAVE."' 
					ORDER BY b.id;";
					
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				while($row = $this->db->sql_fetchass($res)){
					$this->productos[$row['idproducto']] = $row;
				}				
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
	
	private function buscar(){
		$localizado = false;
		try{
			$sql = "SELECT * FROM usuarios as a 
							WHERE a.email = '".$this->data['email']."' OR telefono='".$this->data['phone']."' LIMIT 1;";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$this->usuario = $this->db->sql_fetchass();
				$localizado = true;	
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
		return $localizado;	
	}
	private function generaPassword(){
		return substr( md5(microtime()), 1, 8);
	}

	private function insertaUsuario(){
		
		if(!$this->buscar()){
			$hoy      = date("Y-m-d H:i:s");
			$passwordS = $this->generaPassword();
			$password  = "PASSWORD('".$passwordS."')";
			$insUser = "INSERT INTO usuarios (nombre, email, telefono,domicilio, id_delegacion,delegacion, contrasenaS, contrasena, fecha_alta, fecha_ult_acceso, activo)
									VALUES ('".$this->data['nombre']."','".$this->data['email']."',
												  '".$this->data['phone']."','".$this->data['address']."',
													'".$this->data['delegacion']."','".$this->delegaciones[$this->data['delegacion']]."',
													'".$passwordS."',".$password.",'".$hoy."','".$hoy."','".Comunes::SAVE."');";
			$resUser = $this->db->sql_query($insUser);
			$idUser  = $this->db->sql_nextid();
		}else{
			$idUser  = $this->usuario['id'];
		}
		return $idUser;
	}


	private function guardar(){
    $fecha = date("Y-m-d H:i:s");
    $this->mensaje = Comunes::MSGERROR;
    $this->exito   = Comunes::LISTAR;
    if ( $this->session['visitante'] == $this->data['sessionId'] 
              && trim($this->data['email']) != ""
              && trim($this->data['nombre']) != ""
              && trim($this->data['phone']) != ""
              && trim($this->data['address']) != ""
              && trim($this->data['delegacion']) != ""
              && strlen(trim($this->data['nombre'])) > 5
              && strlen(trim($this->data['email'])) > 5
              && strlen(trim($this->data['phone'])) == 10
              && strlen(trim($this->data['address'])) > 10
              && (int) $this->data['delegacion'] >= 0 ){
    	try{
        $this->mensaje = "El pedido no se cargo correctamente";
        if(count($this->data) > 0){			
          foreach($this->data as $key => $value){
            $this->data[$key] = $this->eliminaCaracteresInvalidos($value);
					}
					$idUser = $this->insertaUsuario(); 
					if( (int) $idUser > 0 ){
						$hoy = date("Y-m-d H:i:s");
						$importe = $this->calculaImporte();
						$ins = "INSERT INTO ".$this->tabla."(fecha_pedido,importe,status,id_usuario)
									VALUES ('".$hoy."','".$importe."','".Comunes::SAVE."','".$idUser."');";
						$this->db->sql_query($ins);
						$idPedido = $this->db->sql_nextid();
						$this->guardaProductosPedidos($idPedido);
						$this->insertaCorreo($idUser, $idPedido);
						$this->mensaje = Comunes::MSGSUCESS;
					  $this->exito   = Comunes::SAVE;
					}
				}
    	}	
    	catch(\Exception $e){
         $this->mensaje = Comunes::MSGERROR;
      }	
    }
	}
	
	private function construyeCuerpo(){
		$tituloMensaje = "Pedido por Intenert ";
		$body  = "<p>Nuevo pedido realizado por Internet</p>";
    $body .= "<br><p>Nombre: <b>".utf8_encode($this->data['nombre'])."</b></p>";
    $body .= "<br><p>Numero de celular: <b>".$this->data['phone']."</b></p>";
    $body .= "<br><p>Correo Electronico: <b>".$this->data['email']."</b></p>";
		$body .= "<br><p>Domicilio: <b>".utf8_encode($this->data['address'])."</b></p>";
		$body .= "<br><p>Delegación: <b>".$this->delegaciones[$this->data['delegacion']]."</b></p>";
    $body .= "<br> Pedido<br>";
		$body .= "<table style='100%' class='table'>
								<thead>
									<tr>
										<th>Cantidad</th>
										<th>Producto</th>
										<th>Precio Unitario</th>
										<th>Importe</th>
									</tr>
								</thead>
								<tbody>";
		$importeTotal = 0.00;
		$importeProdu = 0.00;
		foreach($this->session['productos'] as $fecha => $data){
			foreach($data as $idProd => $cantidad){
				$producto = $this->productos[$idProd];
				$importeProdu = ($cantidad * $producto['precio']) + 0;
				$importeTotal = $importeTotal + $importeProdu + 0;
				$body.= "<tr>
									<td>".$cantidad."</td>
									<td>".utf8_encode($producto['producto'])."</td>
									<td>".number_format($producto['precio'],2,'.',',')."</td>
									<td>".number_format(($importeProdu),2,'.',',')."</td>
									</tr>";
				}
			}
			$body .="</tbody>";
			$body .="<tfoot><tr><td colspan='3'>Total:</td><td>".number_format($importeTotal,2, '.',',')."</td></tr></tfoot></table>";
			$body_html="<html><head><title>".$tituloMensaje."</title></head><body><p>".$body."</p></body></html>";
			return $body_html;
	}


	private function insertaCorreo($idUser, $idPedido){
		$hoy = date("Y-m-d H:i:s");
		$body  = $this->construyeCuerpo();
		$email = "hola@soyfuncionalmx.com";
		$copia = "lciencias@gmail.com";
		try{
			$insEmail = 'INSERT INTO correos (id_usuario, id_pedido, email, copia, body, estatus,fecha)
									VALUES ("'.$idUser.'","'.$idPedido.'","'.$email.'","'.$copia.'","'.$body.'","0","'.$hoy.'");';
			$this->db->sql_query($insEmail);

		}
		catch(Exception $e){
			$this->mensaje = Comunes::MSGERROR;
		}
	}
	private function guardaProductosPedidos($pedidoId){
		if(count($this->session['productos']) > 0){
			foreach( $this->session['productos'] as $fecha => $data){
				$hoy = date("Y-m-d H:i:s");
				foreach($data as $idProd => $cantidad){
					$producto = $this->productos[$idProd];
					$importe  = ($cantidad * $producto['precio']) + 0;
					$ins = "INSERT INTO pedidos_productos(id_pedido,id_producto,cantidad,unitario, importe,fecha) 
								  VALUES ('".$pedidoId."','".$idProd."','".$cantidad."','".$producto['precio']."','".$importe."','".$hoy."');";
					$this->db->sql_query($ins);
				}
			}
		}
	}

	private function calculaImporte(){
		$importe = 0.00;
  	$seleccion = $this->session['productos'];
  	foreach($seleccion as $fechaP => $data){
    	foreach($data as $idProd => $cantidad){
      	$producto = $this->productos[$idProd];
      	$importe = $importe + ($producto['precio'] * $cantidad) + 0.00;
			}
  	}
  	return $importe;
  }
	
	public function obtenExito(){
		return $this->exito;
	}

	public function obtenMensaje(){
		return $this->mensaje;
	}

	public function obtenCatalogoProductos(){
		return $this->productos;
	}
}
?>