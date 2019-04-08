<?php
include_once ("Comunes.class.php");
class Archivos extends Comunes{

	private $db;
	public $session;
	private $data;
	private $tipo;
	private $opc;
	private $mensaje;
	private $exito;
	private $registros;
	private $tabla;
	private $idImagen;
	private $idDocumento;
	private $nombreCarpeta;
	private $tipoBiblioteca;
	private $directorio;
	private $max;
	function __construct($db,$session,$data,$idImagen, $idDocumento,$opc,$tipoBiblioteca){
		parent::__construct($session);
		$this->db 		   = $db;
		$this->session     = $session;
		$this->data        = $data;
		$this->opc         = $opc;
		$this->idImagen    = $idImagen;
		$this->idDocumento = $idDocumento;
		$this->tipoBiblioteca = $tipoBiblioteca;
		$this->directorio = "file-manager/Biblioteca_PIARC/";
		if((int)$this->tipoBiblioteca == 1){
		    $this->directorio = "file-manager/Biblioteca_Amivtac/";
		}
		$this->mensaje     = "";
		$this->tabla       = "archivos";
		$this->exito       = Comunes::LISTAR;
		$this->nombreCarpeta ="";
		$this->max = 25;
		$this->registros= array();
		switch($this->opc){
			case Comunes::LISTAR:
				$this->listarArchivos();
				break;
			case Comunes::SAVE:
				$this->guardaArchivos();
				break;
			case Comunes::EDIT:
				$this->editaArchivos();
				break;
			case Comunes::UPDATE:
				$this->actualizaArchivos();
				break;
			case Comunes::DELETE:
				$this->eliminaArchivos();
				break;
			case Comunes::MOSTRAR:
				$this->publicarArchivos();
				break;
				
		}
	}
	
	private function listarArchivos(){		
		$this->registros = array();
		$filtro = "";
		if((int)$this->data['id'] > 0){
			$filtro = " and a.idbiblioteca= '".$this->data['id']."' ";
		}
		try{
			$sql = "SELECT a.idarchivo,a.idbiblioteca,a.subcarpeta,a.tipo,DATE_FORMAT(a.fecha, '%d-%m-%y %H:%i:%s') AS fecha, 
					a.status,a.idusuario,a.autor,a.fecha_material,a.idevento,a.descripcion,a.iddocumento,a.idimagen,a.publicar,
					a.ruta,a.web,b.web as imagen,c.web as documento,d.titulo,a.ids,a.urls,a.temario
					FROM ".$this->tabla." as a 
					LEFT JOIN imagen as b ON b.idimagen = a.idimagen
					LEFT JOIN documento as c ON c.iddocumento = a.iddocumento
					LEFT JOIN evento as d ON d.idevento  = a.idevento
					WHERE a.status = ".Comunes::SAVE." 
					AND a.tipo='".$this->idImagen."' ".$filtro." ORDER BY a.idarchivo ASC;";
			
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				while($row = $this->db->sql_fetchass($res)){
					$this->registros[] = $row;
				}
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
	
	private function crearSubCarpeta($filename){		
		if (!is_dir($filename)) {
			if(!mkdir($this->session['pathFile'].$this->data['subcarpeta'], 0777,true)) {
				return 0;
			}
		}
		return 1;
	}

	private function renombraCarpeta($subCarpetaAnt,$subCarpeta){
		try{
			if(!$this->contieneArchivos($subCarpetaAnt)){
				if(!rename ($subCarpetaAnt, $subCarpeta)) {
					return 0;
				}
			}
			return 1;
		}
		catch (\Exception $e){
			die($e->getMessage());
			$this->writeLog($e->getMessage(), Comunes::ERROR);
			return 0;
		}		
	}

	private function contieneArchivos($carpeta){
		try{
			if (is_dir($carpeta)) {
				$carpeta = @scandir($carpeta);
				if (count($carpeta) > 2){
					return 1;
				}
			}
			return  0;
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
			return  0;
		}		
	}
	private function eliminaCarpeta($carpeta){
		try{
			if(!$this->contieneArchivos($carpeta)){
				if (is_dir($carpeta) && rmdir($carpeta)) {
					return 1;
				}
			}
			return 0;
		}
		catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
			return 0;
		}		
		
	}
	
	private function existeCarpeta($carpeta){
		try{
			if (file_exists($carpeta)) {
				return 1;
			}
			return 0;
		}
		catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
			return 0;
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
					$nombreCarpeta = $nombreCarpeta.'/';
				}
			}
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
		return $nombreCarpeta;
		
	}
	
	private function guardaArchivos(){		
		$fecha = date("Y-m-d H:i:s");
		$urls  = "";
		try{							
			$this->mensaje = "Los archivos no se cargaron correctamente";
			if(count($this->data) > 0){
				$urls = $this->generaUrls();
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}				
				$this->carpetaPadre= $this->regresaCarpetaPadre($this->data['idbiblioteca']);
				//die("carpeta:  ".$this->session['pathSys'].$this->directorio.$this->carpetaPadre.$this->data['carpeta']);
				if($this->carpetaPadre  != ''){
					if($this->existeCarpeta($this->session['pathSys'].$this->directorio.$this->carpetaPadre.$this->data['carpeta'])){						
					    $ruta = $this->session['pathSys'].$this->directorio.$this->carpetaPadre.$this->data['carpeta'];
						$web  = $this->session['pathWeb'].$this->directorio.$this->carpetaPadre.$this->data['carpeta'];
						$fechaMaterial = "0000-00-00";
						if(trim($this->data['fecha_material'])!= ''){
							$fechaMaterial = $this->Formato_Fecha_Biz($this->data['fecha_material']);
						}
						$ids = $this->regresaIds();
						$ins = "INSERT INTO ".$this->tabla."(idbiblioteca,idusuario,subcarpeta,tipo,fecha, status,autor,fecha_material,idevento,descripcion,iddocumento,idimagen,publicar,ruta,web,ids,temario,urls,subcarpetaFile)
								VALUES ('".$this->data['idbiblioteca']."','".$this->session['userId']."', '".$this->data['subcarpeta']."','".$this->data['tipo']."','".$fecha."','".Comunes::SAVE."',
											'".$this->data['autor']."','".$fechaMaterial."','".$this->data['idevento']."','".$this->data['descripcion']."','".$this->idDocumento."','".$this->idImagen."','0','".$ruta."','".$web."','".$ids."','".$this->data['temario']."','".$urls."','".$this->data['carpeta']."');";
						$this->db->sql_query($ins);
						$this->mensaje = Comunes::MSGSUCESS;
						$this->exito   = Comunes::SAVE;
					}else{
						$this->mensaje = "La subcarpeta NO existe.";
						$this->exito   = Comunes::LISTAR;						
					}
				}else{
					$this->mensaje = "La carpeta NO existe.";
					$this->exito   = Comunes::LISTAR;						
				}
			}
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
	}
	
	private function editaArchivos(){
		$this->exito = -1;
		$id = (int)$this->data['id'];
		try{
			if($id > 0){
				$this->exito = 1;
				$sql = "SELECT a.idarchivo,a.idbiblioteca,a.subcarpeta,a.tipo,DATE_FORMAT(a.fecha, '%d-%m-%y %H:%i:%s') AS fecha,
					a.status,a.idusuario,a.autor,DATE_FORMAT(a.fecha_material, '%d-%m-%Y') AS fecha_material,a.idevento,a.descripcion,a.iddocumento,a.idimagen,a.publicar,
					a.ruta,a.web,b.web as imagen,c.web as documento,d.titulo,a.ids,a.temario,a.urls,a.subcarpetaFile
					FROM ".$this->tabla." as a
					LEFT JOIN imagen as b ON b.idimagen = a.idimagen
					LEFT JOIN documento as c ON c.iddocumento = a.iddocumento
					LEFT JOIN evento as d on d.idevento  = a.idevento
					WHERE a.idarchivo = ".$id." LIMIT 1;";
				//die($sql);
				$res = $this->db->sql_query ($sql);
				if ($this->db->sql_numrows ($res) > 0){
					$this->registros = $this->db->sql_fetchass($res);
				}			
			}
		}
		catch(\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
		
	private function actualizaArchivos(){
			$this->exito   = Comunes::LISTAR;
			$this->mensaje = "Los archivos no se cargaron correctamente";
		try{
			if(trim($this->data['subcarpeta']) != ''){		
				$urls = $this->generaUrls();
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$this->carpetaPadre= $this->regresaCarpetaPadre($this->data['idbiblioteca']);
				if($this->carpetaPadre  != ''){
				    if($this->existeCarpeta($this->session['pathSys'].$this->directorio.$this->carpetaPadre.$this->data['carpeta'])){											
				        $ruta = $this->session['pathSys'].$this->directorio.$this->carpetaPadre.$this->data['carpeta'];
						$web  = $this->session['pathWeb'].$this->directorio.$this->carpetaPadre.$this->data['carpeta'];
						$ins = "UPDATE ".$this->tabla." set ";
						if((int)$this->idImagen > 0){
							$ins .= "idimagen     ='".$this->idImagen."',";
						}
						if((int)$this->idDocumento > 0){
							$ins .= "iddocumento     ='".$this->idDocumento."',";
						}
						$fechaMaterial = "0000-00-00";
						if(trim($this->data['fecha_material'])!= ''){
							$fechaMaterial = $this->Formato_Fecha_Biz($this->data['fecha_material']);						
						}
						$ids = $this->regresaIds();
						$ins .= " subcarpeta  = '".$this->data['subcarpeta']."',
						  		  tipo 		  = '".$this->data['tipo']."',
						  		  status	  = '".Comunes::SAVE."',
						  		  autor    	  = '".$this->data['autor']."',
						  	      fecha_material = '".$fechaMaterial."',
						  		  idevento    = '".$this->data['idevento']." ',
						  		  descripcion = '".$this->data['descripcion']." ',
						  		  temario = '".$this->data['temario']." ',
						  		  ruta 		  = '".$ruta." ',
						  		  web 		  = '".$web." ',
						  		  urls        = '".$urls."',
                                  ids 		  = '".$ids." '
						WHERE idarchivo = '".$this->data['idarchivo']."' limit 1;";
						$this->db->sql_query($ins);
						$this->mensaje = Comunes::MSGSUCESS;
						$this->exito   = Comunes::SAVE;					
					}else{
							$this->mensaje = "La subcarpeta no existe";
					}
				}
				else{
					$this->mensaje = "La subcarpeta no sta asignada a ninguna carpeta";
				}
			}else{
				$this->mensaje = "La subcarpeta no se le puede cambiar el nombre";				
			}
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
	
	private function regresaIds(){
	    $array = array();
	    if(count($this->data['ids']) > 0){
	        $array = implode(',' ,$this->data['ids']); 
	    }
	    return $array;
	}
	
	private function eliminaArchivos(){
		$this->exito   = Comunes::LISTAR;
		$this->mensaje = Comunes::ERROR; 
		if((int) $this->idImagen > 0){
			try{ 
 				$sql = "SELECT idbiblioteca FROM ".$this->tabla." WHERE idarchivo = '".$this->idImagen."' LIMIT 1;";
 				$res = $this->db->sql_query ($sql);
 				if ($this->db->sql_numrows ($res) > 0){
 					list($idbiblioteca) = $this->db->sql_fetchrow($res);
 				}
				$upd = "UPDATE ".$this->tabla." SET status = '". Comunes::UPDATE."' WHERE idarchivo = '".$this->idImagen."' LIMIT 1;";
				$this->db->sql_query($upd);
				$this->exito = Comunes::SAVE;
				$this->mensaje = Comunes::MSGSUCESS;
			}catch(\Exception $e){
				$this->mensaje = $e->getMessage();
				$this->writeLog($e->getMessage(), Comunes::ERROR);
			}
		}
	}
	
	private function publicarArchivos(){
		$arrayEventos = explode('|',$this->data['id']);
		$this->exito   = Comunes::LISTAR;
		$this->mensaje = Comunes::ERROR;
		if(count($arrayEventos) > 0){
			$upd = "UPDATE ".$this->tabla." SET mostrar= '". Comunes::LISTAR."';";
			$this->db->sql_query($upd);
			foreach ($arrayEventos as $id){
				if((int) $id > 0){
					try{
						$upd = "UPDATE ".$this->tabla." SET publicar= '". Comunes::SAVE."' WHERE idarchivo= '".$id."' LIMIT 1;";
						$this->db->sql_query($upd);
						$this->exito = Comunes::SAVE;
						$this->mensaje = Comunes::MSGSUCESS;
					}catch(\Exception $e){
						$this->mensaje = $e->getMessage();
						$this->writeLog($e->getMessage(), Comunes::ERROR);
					}
				}
			}
		}
		
	}
	
	private function generaUrls(){
		$url = array();
		for($i=1; $i<=$this->max; $i++){
			$campo = "url".$i;			
			if(trim($this->data[$campo]) != ''){
				$url[] = $this->data[$campo];
			}			
		}
		return implode("|",$url);
	}
	
	function obtenExito(){
		return $this->exito;
	}

	function obtenMensaje(){
		return $this->mensaje;
	}
	
	function obtenRegistros(){
		return $this->registros;
	}
}
?>