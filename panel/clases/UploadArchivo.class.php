<?php
class UploadArchivo extends Comunes{
	private $db;
	private $files;
	private $opc;
	private $idDocumento;
	private $mensaje;
	public $session;
	private $data;
	private $extensionesIma;
	private $extensionesDoc;
	private $tamanoBytes;
	
	function __construct($db,$session,$data,$files,$opc){
		parent::__construct($session);
		$this->db          = $db;
		$this->session     = $session;
		$this->data        = $data;        
		$this->files       = $files;
		$this->opc         = (int)$opc;
		$this->idDocumento = 0;
		$this->tamanoBytes = 419430400;
		$this->mensaje     = "";
		$this->extensionesBib = array('doc','docx','pdf','zip');
		$this->guardaImagen();
	}
	
	/**
	 * Metodo que almacena una imagen en base de datos
	 */
	private function guardaImagen(){
		try{
			if((int)$this->data['idbiblioteca'] > 0 && trim($this->data['subcarpeta'])!= ''){
				$nombreCarpeta = $this->regresaCarpetaPadre($this->data['idbiblioteca']);
				if($nombreCarpeta != ''){
					$this->files['documento']['name'] = $this->limpiaArchivo($this->files['documento']['name']);
					$subcarpeta = $this->session['pathFile'].$nombreCarpeta.$this->data['subcarpeta'];
					$subcarpetaW=$this->session['pathFileWeb'].$nombreCarpeta.$this->data['subcarpeta'];
					if($this->existeCarpeta($subcarpeta)){  // SI no existe la subcarpeta
						if($this->crearSubCarpeta($subcarpeta)){
							$this->cargaArchivo($nombreCarpeta,$subcarpeta,$subcarpetaW,$this->files['documento']['name']);
						}else{
							$this->mensaje  = "Error al cargar la subcarpeta de nombre: ".$this->data['subcarpeta'];
						}
					}else{  // SI existe la subcarpeta
						$this->cargaArchivo($nombreCarpeta,$subcarpeta,$subcarpetaW,$this->files['documento']['name']);
					}
				}			
			}
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
	
	private function insertaArchivo($path,$web){
		$fecha = date("Y-m-d H:i:s");
		try{
			$ins = "INSERT INTO documento (idusuario, archivo, ruta,fecha,status,web)
				VALUES ('".$this->session['userId']."','".trim($this->files['documento']['name'])."','".trim($path)."','".$fecha."','".Comunes::SAVE."','".trim($web)."');";
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
		if(!in_array($ext, $this->extensionesBib)){
			$this->mensaje="Tipo de archivo invalido";
			return false;
		}
		if((int) $size > $this->tamanoBytes){
			$this->mensaje = "El tamaño del archivo excede el número de bytes permitidos";
			return false;
		}
		return true;
	}
	
	private function cargaArchivo($nombreCarpeta,$subcarpeta,$subcarpetaW,$archivo){
		$pathCom = $subcarpeta.'/'.$archivo;
		$web     = $subcarpetaW.'/'.$archivo;
		$path = 'downfiles/'.$nombreCarpeta.$this->data['subcarpeta']."/".$this->files['documento']['name'];
		try{
			if($this->validaArchivo()){
				if (move_uploaded_file($this->files['documento']['tmp_name'], $path)) {
					$this->insertaArchivo($pathCom, $web);
					$this->mensaje  = Comunes::MSGSUCESS;
				} else {
					$this->mensaje  = "No se cargo el archivo";
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
	
	private function regresaCarpetaPadre($idBibioteca){
		$nombreCarpeta="";
		try{
			if((int)	$idBibioteca > 0){
				$sqlB = "SELECT nombre FROM biblioteca WHERE idbiblioteca = '".$idBibioteca."' LIMIT 1;";
				$resB = $this->db->sql_query($sqlB);
				if ($this->db->sql_numrows ($resB) > 0){
					list($nombreCarpeta) = $this->db->sql_fetchrow($resB);
					$nombreCarpeta = $nombreCarpeta.'/';
				}
			}
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
		return $nombreCarpeta;	
	}
	
	private function existeCarpeta($carpeta){
		try{
			if (file_exists($carpeta)) {
				return 0;
			}
			return 1;
		}
		catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
			return 0;
		}
	}
	
	private function crearSubCarpeta($filename){
		if (!is_dir($filename)) {
			if(!mkdir($filename, 0777,true)) {
				return 0;
			}
		}
		return 1;
	}
	
	
	public function obtenIdDocumento(){
		return $this->idDocumento;
	}
	
	public function obtenMensaje(){
		return $this->mensaje;
	}
	
	}
	?>