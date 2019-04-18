<?php
include_once ("Comunes.class.php");
class InsertaPregunta extends Comunes{
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
		$this->tabla       = "preguntas";
		$this->exito       = Comunes::LISTAR;
		
		switch($this->opc){
			case Comunes::SAVE:
				$this->guardar();
                break;
        }
	}
	
	private function guardar(){
        $fecha = date("Y-m-d H:i:s");
        $this->mensaje = Comunes::MSGERROR;
        $this->exito   = Comunes::LISTAR;
        if ( $this->session['visitante'] == $this->data['sessionId'] && trim($this->data['pregunta']) != ""  && strlen(trim($this->data['pregunta'])) > 3){
            try{
                $this->mensaje = "Los datos de la pregunta no se cargaron correctamente";
                if(count($this->data) > 0){			
                    foreach($this->data as $key => $value){
                        $this->data[$key] = $this->eliminaCaracteresInvalidos($value);
                    }
                    $ins = "INSERT INTO ".$this->tabla."(pregunta,fecha,status, respuesta)
                            VALUES ('".$this->data['pregunta']."','".$fecha."','".Comunes::LISTAR."','');";				
                    $this->db->sql_query($ins);
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