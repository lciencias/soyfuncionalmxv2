<?php 
class Carpetas{
	private $db;
	private $data;
	private $path_sis;
	private $opc;
	private $buffer;
	
	function __construct($db,$data,$path_sis,$opc){
		$this->db       = $db;
		$this->opc      = $opc;
		$this->data     = $data;
		$this->path_sis = $path_sis;
		$this->buffer = "";
		if((int)$this->data['id'] > 0){
			$this->generaCombo();	
		}
	}
	
	private function generaCombo(){
		$sql = "SELECT nombreSo,tipo FROM biblioteca WHERE idbiblioteca = '".$this->data['id']."' LIMIT 1; ";
		$res = $this->db->sql_query($sql);
		if($this->db->sql_numrows($res)>0){
			list($name,$tipo) = $this->db->sql_fetchrow($res);
			if($this->opc == 1){
				$this->procesaCarpetas($name,$tipo);
			}else{
				$this->procesaCarpetasEdita($name,$tipo);
			}
		}
	}
	
	private function procesaCarpetas($name,$tipo){	
		$path = $this->path_sis."file-manager/Biblioteca_PIARC/".$name."/";
		if((int)$tipo == 1){
			$path = $this->path_sis."file-manager/Biblioteca_Amivtac/".$name."/";
		}
		$directorio = opendir($path); //ruta actual
		$this->buffer = "<select name='carpeta' id='carpeta' class='form-control carpetas'>";
		while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
		{
			if ($archivo != "." && $archivo != ".." && is_dir($path.$archivo)){				
				$this->buffer.= "<option val='".$archivo."'>".$archivo."</option>";
			}
		}
		$this->buffer.= "</select>";
	}

	private function procesaCarpetasEdita($name,$tipo){
		$path = $this->path_sis."file-manager/Biblioteca_PIARC/".$name."/";
		if((int)$tipo == 1){
			$path = $this->path_sis."file-manager/Biblioteca_Amivtac/".$name."/";
		}
		$directorio = opendir($path); //ruta actual
		$this->buffer = "<select name='carpeta' id='carpeta' class='form-control carpetas'>";
		while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
		{
			if ($archivo != "." && $archivo != ".." && is_dir($path.$archivo) && $archivo == $this->data['subcarpetaFile']){
			//if ($archivo != "." && $archivo != ".." && is_dir($path.$archivo)){
				$this->buffer.= "<option val='".$archivo."'>".$archivo."</option>";
			}
		}
		$this->buffer.= "</select>";
	}
	
	public function obtenCombo(){
		return $this->buffer;
	}
}
?>