<?php
include_once ("Comunes.class.php");
class EnviaEmailPedido extends Comunes{
	public  $session;
	private $data;
  private $opc;
  private $productos;
	private $mensaje;
	private $exito;

	
	
	function __construct($session, $data, $opc, $productos){
		parent::__construct($session);
		$this->session     = $session;
		$this->data        = $data;
    $this->opc         = $opc;
    $this->productos   = $productos;
		$this->exito       = Comunes::LISTAR;
		
		switch($this->opc){
			case Comunes::SAVE:
				$this->enviaCorreo();
                break;
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
		    			  $this->db->sql_query($ins);
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
	
	private function calculaImporte(){
    return $this->session['importe'] + 0;
  }
	
	public function obtenExito(){
		return $this->exito;
	}

	public function obtenMensaje(){
		return $this->mensaje;
	}
}
?>