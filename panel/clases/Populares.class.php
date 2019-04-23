<?php
include_once ("Comunes.class.php");
class Populares extends Comunes{

	private $db;
	public $session;
	private $data;
	private $idImagen;
	private $opc;
	private $mensaje;
	private $exito;
	private $registros;
	private $tabla;
	private $filtro;
	private $arrayCategorias;
	private $totalProductos;
	
	function __construct($db,$session,$data,$idImagen,$opc){
		parent::__construct($session);
		$this->db 		   = $db;
		$this->session     = $session;
		$this->data        = $data;
		$this->idImagen    = $idImagen;
		$this->filtro      = "";
		$this->opc         = $opc;
		$this->mensaje     = "";
		$this->tabla       = "productos";
		$this->exito       = Comunes::LISTAR;
		$this->registros= array();
		$this->totalProductos = 0;		
		$this->arrayCategorias = array();

		switch($this->opc){
			case Comunes::WEB:
				$this->listarPopularesWebArray();
				break;
		}
	}
	
	
	
	private function listar(){
	}

	private function guardar(){
	}
	
	private function editar(){
	}
	
	private function actualizar(){	
	}
	
	private function eliminar(){
	}

	private function ordenar(){
	}
	
	private function listarPopularesWebArray(){
		$this->registros = array();
		try{
            $sql = "SELECT a.id_producto, count(a.id_producto) as total,b.producto,
                    b.precio ,b.idimagen,c.web
                    FROM pedidos_productos as a 
                    JOIN productos as b ON b.id = a.id_producto 
                    JOIN imagen as c ON c.idimagen = b.idimagen  
                    WHERE  b.status = '".Comunes::SAVE."'
                    GROUP BY  a.id_producto ORDER BY count(a.id_producto) desc limit 3;";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				while($row = $this->db->sql_fetchass($res)){
					$this->registros[] = $row;
				}				
			}
			$this->totalProductos++;
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}


	private function breadcrumb(){
	}
	
	private function tabla(){
	}

	public function obtenCategorias(){
		return $this->arrayCategorias;
	}
	
	public function obtenExito(){
		return $this->exito;
	}

	public function obtenMensaje(){
		return $this->mensaje;
	}
	
	public function obtenBuffer(){
		return $this->buffer;
	}

	public function obtenRegistros(){
		return $this->registros;
	}

	public function obtenTotalProductos(){
		return $this->totalProductos;
	}
	
	public function obtenBreadcrumb(){
		return $this->bread;
	}
}
?>