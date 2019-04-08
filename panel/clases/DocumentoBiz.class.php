<?php
class DocumentoBiz extends Comunes{
	private $db;	
	private $files;
	private $opc;
	private $idDocumento;
	private $mensaje;
	public $session;
	private $extensionesIma;	
	private $extensionesDoc;
	private $tamanoBytes;
	private $tipo;
	private $name;
	private $data;
	private $filesUpload;
	private $filesNm;
	private $minimo;
	
	function __construct($db,$session,$files,$data,$opc,$tipo,$name){
		parent::__construct($session);
		$this->db       = $db;
		$this->session  = $session;
		$this->files    = $files;
		$this->data     = $data;
		$this->opc      = (int)$opc;
		$this->tipo     = $tipo;
		$this->name     = $name;
		
		$this->idDocumento = $this->minimo = 0;
		$this->tamanoBytes = 419430400;
		$this->mensaje  = "";
		$this->filesUpload = $this->filesNm = array();
		$this->extensionesIma = array('gif','jpg','jpeg','png','bmp');
		$this->extensionesDoc = array('doc','docx','xls','xlsx','pdf','ppt','pptx','txt','zip');
		$this->extensionesBib = array('doc','docx','pdf','zip');
		switch($this->opc){
			case 0:
				break;
			case 1:
				$this->guardaImagen();
				break;
			case 2:
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
	
	private function regresaCarpetaPadre($idBibioteca){
	    $nombreCarpeta="";
	    try{
	        if((int)$idBibioteca > 0){
	            $sqlB = "SELECT nombreSo FROM biblioteca WHERE idbiblioteca = '".$idBibioteca."' LIMIT 1;";
	            $resB = $this->db->sql_query($sqlB);
	            if ($this->db->sql_numrows ($resB) > 0){
	                list($nombreCarpeta) = $this->db->sql_fetchrow($resB);
	                $nombreCarpeta = $nombreCarpeta;
	            }
	        }
	    }
	    catch(\Exception $e){
	        $this->writeLog($e->getMessage(), Comunes::ERROR);
	    }
	    return $nombreCarpeta;
	    
	}
	
	/**
	 * Metodo que almacena una imagen en base de datos
	 */
	private function guardaImagen(){
	    if((int) $this->data['idbiblioteca'] > 0 && trim($this->data['carpeta']) != ''){
	        $carpetaPadre = $this->regresaCarpetaPadre($this->data['idbiblioteca']);
	        $carpetaPadre = $carpetaPadre."/".$this->data['carpeta']."/";
	    }
		switch($this->tipo){
		    case 1:
		        $nMArchivo = trim($this->files[$this->name]['name']);
		        $pathCom = $this->session['pathSys']."file-manager/revistas/".$this->files[$this->name]['name'];
		        $web  = $this->session['pathWeb']."file-manager/revistas/".$this->files[$this->name]['name'];
		        break;
		    case 2:
		        $nMArchivo  = trim($this->data[$this->name]);
		        $pathCom = $this->session['pathSys']."file-manager/Biblioteca_Amivtac/".$carpetaPadre.$this->data[$this->name];
		        $web  = $this->session['pathWeb']."file-manager/Biblioteca_Amivtac/".$carpetaPadre.$this->data[$this->name];
		        break;
		    case 3:
		        $nMArchivo  = trim($this->data[$this->name]);
		        $pathCom = $this->session['pathSys']."file-manager/Biblioteca_PIARC/".$carpetaPadre.$this->data[$this->name];
		        $web  = $this->session['pathWeb']."file-manager/Biblioteca_PIARC/".$carpetaPadre.$this->data[$this->name];
		        break;
		    default:
		        $nMArchivo  = trim($this->files[$this->name]['name']);
		        $pathCom = $this->session['pathSys']."file-manager/revistas/".$this->files[$this->name]['name'];
		        $web  = $this->session['pathWeb']."file-manager/revistas/".$this->files[$this->name]['name'];
		        break;		        
		}
		try{		
			if($this->validaArchivo()){
				try{
				    $this->insertaArchivo($pathCom, $web, $nMArchivo);
					$this->mensaje  = Comunes::MSGSUCESS;
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
	
	private function insertaArchivo($path,$web,$nMArchivo){	    
		$fecha = date("Y-m-d H:i:s");	
		try{
		    if(trim($nMArchivo) != ''){
                $ins = "INSERT INTO documento (idusuario, archivo, ruta,fecha,status,web) 
				        VALUES ('".$this->session['userId']."','".$nMArchivo."','".$path."','".$fecha."','".Comunes::SAVE."','".$web."');";
    	         $this->db->sql_query($ins);
    	         $this->idDocumento = $this->db->sql_nextid();
		    }
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
	}
	private function validaArchivo(){
	    return true;
	    /*$array_ext = explode ('.',$this->files[$this->name]['name']);
		$l 		   = count ( $array_ext );
		$ext       = strtolower($array_ext [($l - 1)]);
		$size 	   = @filesize ($this->files[$this->name]['tmp_name'] );
		if(!in_array($ext, $this->extensionesDoc)){
			$this->mensaje="Tipo de archivo invalido";
			return false;
		}
		if((int) $size > $this->tamanoBytes){
			$this->mensaje = "El tamaño del archivo excede el número de bytes permitidos";
			return false;				
		}
		return true;*/		
	}
	
	public function obtenIdDocumento(){
		return $this->idDocumento;
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
}
?>