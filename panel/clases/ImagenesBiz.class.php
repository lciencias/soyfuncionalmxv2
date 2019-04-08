<?php
class ImagenesBiz extends Comunes{
	private $db;	
	private $files;
	private $opc;
	private $idDocumento;
	private $mensaje;
	public $session;
	private $extensionesIma;	
	private $tamanoBytes;
	private $tipo;
	private $name;
	private $data;
	private $filesUpload;
	private $filesNm;
	private $minimo;
	private $imagenesWeb;
	
	function __construct($db,$session,$files,$data,$opc){
		parent::__construct($session);
		$this->db       = $db;
		$this->session  = $session;
		$this->files    = $files;
		$this->data     = $data;
		$this->opc      = (int)$opc;		
		$this->idImagenes  = array();
		$this->imagenesWeb = array();
		$this->minimo      = 0;
		$this->tamanoBytes = 419430400;
		$this->mensaje  = "";
		$this->filesUpload = $this->filesNm = array();
		$this->extensionesIma = array('gif','jpg','jpeg','png','bmp');
		switch($this->opc){
			case 0:
				break;
			case Comunes::SAVE:
				$this->guardaImagen();
				break;
			case Comunes::EDIT:
				$this->regresaImagenes();
				break;
			case Comunes::UPDATE:
				$this->actualizaImagen();
				break;
				
			case Comunes::WEB:
			    $this->regresaArchivos();
			    break;			    
		}
	}
	
	
	private function regresaArchivos(){
	    $contador = 0;
	    if(trim($this->name) != ''){
	        $sql = "SELECT iddocumento,web,archivo FROM documento WHERE iddocumento IN (".$this->name.") ORDER BY iddocumento;";
	        $res = $this->db->sql_query ($sql);
	        if ($this->db->sql_numrows ($res) > 0){
	            while(list($idFile,$nmFile,$archivo) =  $this->db->sql_fetchrow($res)){
	                if($contador == 0){
	                        $this->minimo = $idFile;
	                }
	                $this->filesUpload[$idFile] = $nmFile;
	                $this->filesNm[$idFile] = $archivo;
	                $contador++;
	            }
	            
	        }
	    }
	}
	

    private function actualizaImagen(){
		$arrayImages = array();
		try{
			foreach($this->files as $name => $file){
				if(trim($file['name']) != ''){
					if($this->validaArchivo($file)){
						$pathCom = $this->session['pathFile'].$file['name'];
					 	$path = 'downfiles/'.$file['name'];
					 	$web  = $this->session['pathFileWeb'].$file['name'];
					 	if(file_exists($pathCom)){
					 		@unlink($pathCom);
					 	}					 	
					 	if (move_uploaded_file($file['tmp_name'], $path)) {					 		
					 		$idIma = $this->actualizaArchivo($pathCom, $web, $file['name']);
					 		$arrayImages[$name] = $idIma;
					 		$this->mensaje  = Comunes::MSGSUCESS;				
					 	}
					 	else{
					 		$this->mensaje  = "No se cargo el archivo";
					 	}
					 }
					 else{
					 	$this->writeLog($this->mensaje, Comunes::INFO);
					 }
				}else{
					$campo = "f".$name;
					$arrayImages[$name] = $this->data[$campo];
				}			
			}
			$this->idImagenes = $arrayImages;
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
	}
	/**
	 * Metodo que almacena una imagen en base de datos
	 */
	private function guardaImagen(){
		try{		
			foreach($this->files as $file){
				if(trim($file['name']) != ''){					
					if($this->validaArchivo($file)){
						$pathCom = $this->session['pathFile'].$file['name'];
						$path = 'downfiles/'.$file['name'];				
						$web  = $this->session['pathFileWeb'].$file['name'];
						if(file_exists($pathCom)){
							@unlink($pathCom);
						}
						if (move_uploaded_file($file['tmp_name'], $path)) {
							$this->insertaArchivo($pathCom, $web, $file['name']);
							$this->mensaje  = Comunes::MSGSUCESS;
								
						}else{
							$this->mensaje  = "No se cargo el archivo";
						}
					}
					else{
						$this->writeLog($this->mensaje, Comunes::INFO);
					}
					
				}
			}
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
	}
	
	private function regresaImagenes(){
	    $cadena = "";
		$arrayTmp = $arrayNvo = array();
		$arrayTmp = explode(',',$this->data['idimagen']);
		if(count($arrayTmp) > 0){
			foreach($arrayTmp as $valor){
				if((int) $valor > 0){
					$arrayNvo[] = $valor;
				}
			}
			if(count($arrayNvo) > 0){
				$cadena = implode(',', $arrayNvo);
			}
		}
		$sql = "SELECT idimagen,web from imagen where idimagen in (".$cadena.") order by idimagen desc;";
		$res = $this->db->sql_query ($sql);
		if ($this->db->sql_numrows ($res) > 0){
			while(list($idimagen,$web) =  $this->db->sql_fetchrow($res)){
				$this->imagenesWeb[$idimagen] = $web;
			}			 
		}
	}
	
    
	
	
	private function actualizaArchivo($path,$web,$nMArchivo){
		$fecha = date("Y-m-d H:i:s");
		try{
			if(trim($nMArchivo) != ''){
				$ins = "INSERT INTO imagen (idusuario, archivo, ruta,fecha,status,web)
				        VALUES ('".$this->session['userId']."','".$nMArchivo."','".$path."','".$fecha."','".Comunes::SAVE."','".$web."');";
				$this->db->sql_query($ins) or die($ins);
				return $this->db->sql_nextid();
			}
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
		return 0;
	}
	
	private function insertaArchivo($path,$web,$nMArchivo){	    
		$fecha = date("Y-m-d H:i:s");	
		try{
		    if(trim($nMArchivo) != ''){
                $ins = "INSERT INTO imagen (idusuario, archivo, ruta,fecha,status,web) 
				        VALUES ('".$this->session['userId']."','".$nMArchivo."','".$path."','".$fecha."','".Comunes::SAVE."','".$web."');";
    	         $this->db->sql_query($ins);
    	         $this->idImagenes[] = $this->db->sql_nextid();
		    }
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
	}
	private function validaArchivo($file){
	    $array_ext = explode ('.',$file['name']);
		$l 		   = count ( $array_ext );
		$ext       = strtolower($array_ext [($l - 1)]);
		$size 	   = @filesize ($file['tmp_name'] );
		if(!in_array($ext, $this->extensionesIma)){
			$this->mensaje="Tipo de archivo invalido";
			return false;
		}
		if((int) $size > $this->tamanoBytes){
			$this->mensaje = "El tamaño del archivo excede el número de bytes permitidos";
			return false;				
		}
		return true;		
	}
	
	public function obtenIdsImagenes(){
		return $this->idImagenes;
	}
	
	public function obtenMensaje(){
		return $this->mensaje;
	}
	public function obtenFiles(){
	    return $this->filesUpload;
	}
	public function obtenNmFile(){
	    return $this->filesNm;
	}
	public function obtenMinimo(){
	    return $this->minimo;
	}
	public function obtenImagenesWeb(){
		return $this->imagenesWeb;
	}
	
}
?>