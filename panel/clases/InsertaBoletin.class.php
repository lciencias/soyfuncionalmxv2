<?php
include_once ("Comunes.class.php");
class InsertaBoletin extends Comunes{
	private $db;
	public $session;
	private $data;
	private $opc;
	private $mensaje;
	private $exito;
	private $tabla;
	
	
	function __construct($db,$session,$data,$opc){
		parent::__construct($session);
		$this->db 		   = $db;
		$this->session     = $session;
		$this->data        = $data;
		$this->opc         = $opc;
		$this->tabla       = "boletin";
		$this->exito       = Comunes::LISTAR;
		
		switch($this->opc){
			case Comunes::SAVE:
				$this->guardar();
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
        if ( $this->session['visitante'] == $this->data['sessionId'] && trim($this->data['email']) != ""  && strlen(trim($this->data['email'])) > 3){
            try{
                $this->mensaje = "Los datos del boletin no se cargaron correctamente";
                if(count($this->data) > 0){			
                    foreach($this->data as $key => $value){
                        $this->data[$key] = $this->eliminaCaracteresInvalidos($value);
					}
					if(!$this->buscar()){
						$ins = "INSERT INTO ".$this->tabla."(email,fecha,status)
						VALUES ('".$this->data['email']."','".$fecha."','".Comunes::SAVE."');";				
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
	
	
	
	public function obtenExito(){
		return $this->exito;
	}

	public function obtenMensaje(){
		return $this->mensaje;
	}
}
?>