<?php
include_once ("Comunes.class.php");
class Producto extends Comunes{

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
			case Comunes::LISTAR:
				$this->categorias();
				$this->breadcrumb();
				$this->listar();
				$this->tabla();
				break;
			case Comunes::SAVE:
				$this->categorias();
				$this->guardar();
				break;
			case Comunes::EDIT:
				//$this->totalProductos();
				//$this->categorias();
				$this->editar();
				break;
			case Comunes::UPDATE:
				$this->actualizar();
				break;
			case Comunes::DELETE:
				$this->eliminar();
				break;
			case Comunes::WEB:
				$this->listarCategoriaProductoWebArray();
				break;
			case Comunes::ORDENAR:
				$this->ordenar();
				break;
		}
	}
	
	private function totalProductos(){
		try{
			$sql = "SELECT a.id 
					FROM ".$this->tabla." as a 
					WHERE a.status= ".Comunes::SAVE.";";
			$res = $this->db->sql_query ($sql);
			$this->totalProductos = $this->db->sql_numrows ($res);			
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}				
	}
	private function categorias(){
		$this->arrayCategorias = array();
		try{
			$sql = "SELECT a.id,a.nombre FROM categorias as a
					WHERE a.status = '".Comunes::SAVE."' ORDER BY a.nombre ASC;";
			$res = $this->db->sql_query ($sql);
			if ($this->db->sql_numrows ($res) > 0){
				while(list($id,$nombre) = $this->db->sql_fetchrow($res)){
					$this->arrayCategorias[$id] = $nombre;
				}
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
		
	}
	private function filtros(){
		$this->filtro = "";
		if((int) $this->data['idanio'] > 0){
			$this->filtro = " AND a.anio = '".$this->data['idanio']."' ";
		}
	}
	
	
	private function listar(){
		$this->registros = array();
		try{
			$sql = "SELECT a.id,a.idcategoria,a.producto,a.caloria,DATE_FORMAT(a.fecha, '%d-%m-%y %H:%i:%s') AS fecha,
					a.precio,a.status,a.idimagen,c.nombre as categoria,b.archivo,b.ruta,b.web,a.orden 					
					FROM ".$this->tabla." as a 
					LEFT JOIN imagen as b ON b.idimagen = a.idimagen
					LEFT JOIN categorias as c ON c.id = a.idcategoria					
					WHERE a.status = '".Comunes::SAVE."' ORDER BY a.id asc;";
			$res = $this->db->sql_query ($sql);			
			$this->totalProductos = $this->db->sql_numrows ($res);
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

	private function guardar(){
		$fecha = date("Y-m-d H:i:s");
		try{
			$this->mensaje = "Los datos del producto no se cargaron correctamente";
			if((int)$this->idImagen > 0){			
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$ins = "INSERT INTO ".$this->tabla."(idcategoria,producto,caloria,precio,fecha, status, idImagen)
						VALUES ('".$this->data['idcategoria']."','".$this->data['producto']."','".$this->data['caloria']."',
								'".$this->data['precio']."','".$fecha."','".Comunes::SAVE."','".$this->idImagen."');";
				$res = $this->db->sql_query($ins);
				$this->mensaje = Comunes::MSGSUCESS;
				$this->exito   = 1;
			}
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
	}
	
	private function editar(){
		$this->exito = -1;
		$id = (int)$this->data['id'];
		try{
			if($id > 0){
				$this->exito = 1;
				$sql = "SELECT a.id,a.idcategoria,a.producto,a.caloria,DATE_FORMAT(a.fecha, '%d-%m-%y') AS fecha,
					a.precio,a.status,a.idimagen,a.orden,c.nombre as categoria,b.archivo,b.ruta,b.web as imagen,a.idimagen 					
					FROM ".$this->tabla." as a 
					LEFT JOIN imagen as b ON b.idimagen = a.idimagen
					LEFT JOIN categorias as c ON c.id = a.idcategoria	
					WHERE a.id = '".$id."' LIMIT 1;";					
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
	
	private function actualizar(){
		$fecha = date("Y-m-d H:i:s");
		try{
			$this->mensaje = "Los datos del producto no se cargaron correctamente";
			if(count($this->data) > 0){
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$ins = "UPDATE ".$this->tabla." set ";
				if((int)$this->idImagen > 0){
					$ins .= "idimagen     ='".$this->idImagen."',";
				}
				$ins .= " idcategoria = '".$this->data['idcategoria']."',		
						  producto    = '".$this->data['producto']."',
						  caloria     = '".$this->data['caloria']."',
						  precio      = '".$this->data['precio']."',
						  orden      = '".$this->data['orden']."',
						  fecha       = '".$fecha."',
						  status      = '". Comunes::SAVE."'
						WHERE id      = '".$this->data['id']."';";
				$this->db->sql_query($ins);
				$this->mensaje = Comunes::MSGSUCESS;
				$this->exito   = 1;
			}
		}
		catch(\Exception $e){
			$this->mensaje = Comunes::MSGERROR;
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}
		
	}
	
	private function eliminar(){
		$this->exito   = Comunes::LISTAR;
		$this->mensaje = Comunes::ERROR; 
		if((int) $this->idImagen > 0){
			try{
				$upd = "UPDATE ".$this->tabla." SET status = '". Comunes::EDIT."' WHERE id = '".$this->idImagen."' LIMIT 1;";
				$this->db->sql_query($upd);
				$this->exito = Comunes::SAVE;
				$this->mensaje = Comunes::MSGSUCESS;
			}catch(\Exception $e){
				$this->mensaje = $e->getMessage();
				$this->writeLog($e->getMessage(), Comunes::ERROR);
			}
		}
	}

	private function ordenar(){
		$id = (int) $this->data['id'];
		$valor = (int) $this->data['valor'];
		if($id > 0 && $valor > 0){
			try{
				$upd = "UPDATE ".$this->tabla." SET orden = '".$valor."' WHERE id= '".$id."' LIMIT 1;";
				$this->db->sql_query($upd);
				$this->exito = Comunes::SAVE;
				$this->mensaje = Comunes::MSGSUCESS;
			}catch(\Exception $e){
				$this->mensaje = $e->getMessage();
				$this->writeLog($e->getMessage(), Comunes::ERROR);
			}
		}	
	}
	
	private function listarCategoriaProductoWebArray(){
		$this->registros = array();
		try{
			$sql = "SELECT a.id, b.id as idproducto,b.producto,b.caloria,b.precio,b.idimagen,c.web,c.ruta 
					FROM categorias a 
					INNER JOIN productos b on b.idcategoria = a.id 
					LEFT JOIN  imagen as c on c.idimagen = b.idimagen 
					WHERE a.status = '".Comunes::SAVE."' AND b.status = '".Comunes::SAVE."' 
					ORDER BY a.orden,b.producto;";
			$res = $this->db->sql_query ($sql);			
			$this->totalProductos = $this->db->sql_numrows ($res);
			if ($this->db->sql_numrows ($res) > 0){
				while($row = $this->db->sql_fetchass($res)){
					$this->registros[$row['id']][$row['idproducto']] = $row;
				}				
			}
			$this->totalProductos++;
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		

	}


	private function breadcrumb(){
		$this->bread = '<ol class="breadcrumb">
			<li><a href="'.$this->session['pathWeb'].'"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Usuarios</li>
		</ol>';
	}
	
	private function tabla(){
		$this->buffer = ' <div class="table-responsive" style="overflow: auto;">
			<table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>Categoria</th>
						<th>Producto</th>
						<th>Caloria</th>
						<th>Precio</th>														
						<th>Editar</th>
						<th>Eliminar</th>
						<th>Ordenar</th>                                                        
					</tr>
				</thead>';
		if(count($this->registros) > 0){
			$this->buffer .= '
				<tfoot>
					<tr>
						<th>Categoria</th>
						<th>Producto</th>
						<th>Caloria</th>
						<th>Precio</th>														
						<th>Editar</th>
						<th>Eliminar</th>
						<th>Ordenar</th>                                                      
					</tr>
				</tfoot>';
		}
		$contador = 1;
		$total    = count($this->registros); 
		if(count($this->registros) > 0){
			$this->buffer .= '<tbody>';
			foreach($this->registros as $reg){
				$this->buffer .= '
				<tr class="renglon'.$reg['id'].'">
				<td>'.$reg['categoria'].'</td>
				<td>'.$reg['producto'].'</td>
				<td>'.$reg['caloria'].'</td>
				<td>'.$reg['precio'].'</td>
				<td class="tdCenter">
					<a href="#" id="mod-'.$reg['id'].'-4" class="modificarP">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
				</td>
				<td class="tdCenter">
					<a href="#" id="e-'.$reg['id'].'-4" class="eliminar">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
				<td class="tdCenter">
				<select name="orden-'.$reg['id'].'-4" id="orden-'.$reg['id'].'-4" style="width:50px;border:solid 1px #e5e5e5;" class="ordenar">
			'.$this->options($total,$reg['orden']).'
			</select>
				</td>
			</tr>';
				$contador++;
			}
			$this->buffer .= '</tbody>';
		}
		$this->buffer .= '</table></div>';
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