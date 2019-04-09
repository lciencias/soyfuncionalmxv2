<?php
class Imagen extends Comunes{
	private $db;	
	private $files;
	private $opc;
	private $idImagen;
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
		$this->idImagen = 0;
		$this->tamanoBytes = 4194304;
		$this->mensaje  = "";
		$this->extensionesIma = array('gif','jpg','jpeg','png','bmp');
		$this->extensionesDoc = array('doc','docx','xls','xlsx','pdf','ppt','pptx','txt');
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
		$this->files['imagen']['name'] = utf8_encode($this->files['image']['name']);
		$pathCom = $this->session['pathSys']."img/banners/".$this->files['image']['name'];
		$path = 'img/banners/'.$this->files['image']['name'];		
		$web  = $this->session['pathWeb']."img/banners/".$this->files['image']['name'];		
		try{			
			if($this->validaArchivo()){
				try{
					if (move_uploaded_file($this->files['image']['tmp_name'], $path)) {
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
			$ins = "INSERT INTO imagen (idusuario, archivo, ruta,fecha,status,web) 
				VALUES ('".$this->session['userId']."','".$this->files['imagen']['name']."','".$path."','".$fecha."','".Comunes::SAVE."','".$web."');";
			$this->db->sql_query($ins);
			$this->idImagen = $this->db->sql_nextid();			
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
	}
	private function validaArchivo(){
		$array_ext = explode ('.',$this->files['imagen']['name']);
		$l 		   = count ( $array_ext );
		$ext       = strtolower($array_ext [($l - 1)]);
		$size 	   = @filesize ($this->files['imagen']['tmp_name'] );
		if(!in_array($ext, $this->extensionesIma)){
			$this->mensaje="Tipo de archivo invalido";
			return false;
		}
		if((int) $size > $this->tamanoBytes){
			$this->mensaje = "El tama�o del archivo excede el n�mero de bytes permitidos";
			return false;				
		}
		return true;		
	}
	
	public function obtenIdImagen(){
		return $this->idImagen;
	}
	
	public function obtenMensaje(){
		return $this->mensaje;
	}
	
}
?>