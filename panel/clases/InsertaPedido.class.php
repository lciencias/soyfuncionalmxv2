<?php
include_once ("Comunes.class.php");
class InsertaPedido extends Comunes{
	private $db;
	public $session;
	private $data;
	private $opc;
	private $mensaje;
	private $exito;
	private $productos;
	
	function __construct($db,$session,$data,$opc){
		parent::__construct($session);
		$this->db 		   = $db;
		$this->session     = $session;
		$this->data        = $data;
		$this->opc         = $opc;
		$this->tabla       = "pedidos";
		$this->exito       = Comunes::LISTAR;
		$this->productos   = array();
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
			$sql = "SELECT a.id FROM ".$this->tabla." as a 
					WHERE a.email = '".$this->data['email']."' LIMIT 1;";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$localizado = true;	
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
		return $localizado;	
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
					if(!$this->buscar()){
						$hoy = date("Y-m-d H:i:s");
						$importe = $this->calculaImporte();
						$ins = "INSERT INTO ".$this->tabla."(fecha_pedido,importe,status,nombre,domiciio,email,telefono,delegacion)
									VALUES ('".$hoy."','".$importe."','".Comunes::SAVE."','".$this->data['nombre']."','".$this->data['address']."','".$this->data['email']."','".$this->data['phone']."','".$this->data['delegacion']."');";
						if($this->db->sql_query($ins)){
							$this->guardaProductosPedidos($this->db->sql_nextid());
						}
					}
					$this->mensaje = Comunes::MSGSUCESS;
					$this->exito   = Comunes::SAVE;
				}
    	}	
    	catch(\Exception $e){
         $this->mensaje = Comunes::MSGERROR;
      }	
    }
	}
	
	private function guardaProductosPedidos($pedidoId){
		if(count($this->session['productos']) > 0){
			foreach( $this->session['productos'] as $fecha => $data){
				$hoy = date("Y-m-d H:i:s");
				foreach($data as $idProd => $cantidad){
					$producto = $this->productos[$idProd];
					$importe  = ($cantidad * $this->productos['precio']) + 0;
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