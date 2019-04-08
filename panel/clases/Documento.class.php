<?php
class Documento extends Comunes{
	private $db;	
	private $files;
	private $opc;
	private $idDocumento;
	private $mensaje;
	public $session;
	private $extensionesIma;
	private $extensionesDoc;
	private $tamanoBytes;
	
	function __construct($db,$session,$files,$opc){
		parent::__construct($session);
		$this->db       = $db;
		$this->session  = $session;
		$this->files    = $files;
		$this->opc      = (int)$opc;
		$this->idDocumento = 0;
		$this->tamanoBytes = 419430400;
		$this->mensaje  = "";
		$this->extensionesIma = array('gif','jpg','jpeg','png','bmp');
		$this->extensionesDoc = array('doc','docx','xls','xlsx','pdf','ppt','pptx','txt','zip');
		$this->extensionesBib = array('doc','docx','pdf','zip');
		switch($this->opc){
			case 0:
				break;
			case 1:
				$this->guardaImagen();
				break;
		}
	}
	
	/**
	 * Metodo que almacena una imagen en base de datos
	 */
	private function guardaImagen(){
		$this->files['documento']['name'] = $this->limpiaArchivo($this->files['documento']['name']);
		$pathCom = $this->session['pathFile'].$this->files['documento']['name'];
		$path = 'downfiles/'.$this->files['documento']['name'];		
		
		$web  = $this->session['pathFileWeb'].$this->files['documento']['name'];
		try{		
			if($this->validaArchivo()){
				try{
					if (move_uploaded_file($this->files['documento']['tmp_name'], $path)) {
						$this->insertaArchivo($pathCom, $web);
						$this->mensaje  = Comunes::MSGSUCESS;
					} else {
						$this->mensaje  = "No se cargo el archivo";
					}
				}catch(\Exception $e){
					$this->mensaje = Comunes::MSGERROR;
					$this->writeLog($e->getMessage(), Comunes::ERROR);
				}					
			}else{
				$this->writeLog($this->mensaje, Comunes::INFO);
			}
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
	}
	
	private function insertaArchivo($path,$web){
		$fecha = date("Y-m-d H:i:s");	
		try{
			$ins = "INSERT INTO documento (idusuario, archivo, ruta,fecha,status,web) 
				VALUES ('".$this->session['userId']."','".$this->files['documento']['name']."','".$path."','".$fecha."','".Comunes::SAVE."','".$web."');";
			$this->db->sql_query($ins);
			$this->idDocumento = $this->db->sql_nextid();			
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
	}
	private function validaArchivo(){
		$array_ext = explode ('.',$this->files['documento']['name']);
		$l 		   = count ( $array_ext );
		$ext       = strtolower($array_ext [($l - 1)]);
		$size 	   = @filesize ($this->files['documento']['tmp_name'] );
		if(!in_array($ext, $this->extensionesDoc)){
			$this->mensaje="Tipo de archivo invalido";
			return false;
		}
		if((int) $size > $this->tamanoBytes){
			$this->mensaje = "El tamaño del archivo excede el número de bytes permitidos";
			return false;				
		}
		return true;		
	}
	
	public function obtenIdDocumento(){
		return $this->idDocumento;
	}
	
	public function obtenMensaje(){
		return $this->mensaje;
	}
	
}
?>