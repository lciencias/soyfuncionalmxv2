<?php
include_once ("Comunes.class.php");
class Pedidos extends Comunes{
	private $db;
	public $session;
	private $data;
	private $idImagen;
	private $opc;
	private $mensaje;
	private $exito;
	private $registros;
	private $tabla;
	private $buffer;
	private $total;
	
	function __construct($db,$session,$data,$idImagen,$opc){
		parent::__construct($session);
		$this->db 		   = $db;
		$this->session     = $session;
		$this->data        = $data;
		$this->idImagen    = $idImagen;
		$this->opc         = $opc;
		$this->mensaje     = "";
		$this->buffer      = "";
		$this->tabla       = "pedidos";
		$this->exito       = Comunes::LISTAR;
		$this->total       = 0;
		$this->registros   = array();
		switch($this->opc){
			case Comunes::LISTAR:
				$this->breadcrumb();
				$this->listarPedido();
				$this->tabla();
				break;
			case Comunes::SAVE:
				$this->guardaPedido();
				break;
			case Comunes::EDIT:
				$this->totalPedido();
				$this->editaPedido();
				break;
			case Comunes::UPDATE:
				$this->actualizaPedido();
				break;
			case Comunes::DELETE:
				$this->eliminaPedido();
				break;	
			case Comunes::ORDENAR:
				$this->ordenaRegstro();
				break;
            case Comunes::MOSTRAR:
                $this->activaPedido();
				break;

            }
	}
	
	private function listarPedido(){
		$this->registros = array();
		try{
			$sql = "SELECT a.id,DATE_FORMAT(a.fecha_pedido,'%d-%m-%Y') as fecha_pedido,
					DATE_FORMAT(a.fecha_entrega,'%d-%m-%Y') as fecha_entrega,
					a.importe,a.id_usuario,a.status,b.nombre,b.apellidos,b.email,b.celular
					FROM ".$this->tabla." as a LEFT JOIN usuarios as b ON b.id = a.id_usuario
					WHERE a.status = ".Comunes::SAVE." ORDER BY a.fecha_entrega ASC;";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$this->total = $this->db->sql_numrows($res);
				while($row = $this->db->sql_fetchass($res)){
					$this->registros[] = $row;
				}
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
	
	private function totalPedido(){
	}
	
	private function guardaPedido(){
	}
	
	private function editaPedido(){
	}
	
	
	private function actualizaPedido(){
	}
	
	
	private function eliminaPedido(){
		$this->exito   = Comunes::LISTAR;
		$this->mensaje = Comunes::ERROR; 
		if((int) $this->idImagen > 0){
			try{
				$upd = "UPDATE ".$this->tabla." SET status = '". Comunes::LISTAR."' WHERE id= '".$this->idImagen."' LIMIT 1;";
				$this->db->sql_query($upd);
				$this->exito = Comunes::SAVE;
				$this->mensaje = Comunes::MSGSUCESS;
			}catch(\Exception $e){
				$this->mensaje = $e->getMessage();
				$this->writeLog($e->getMessage(), Comunes::ERROR);
			}
		}
    }

	private function breadcrumb(){
		$this->bread = '<ol class="breadcrumb">
			<li><a href="'.$this->session['pathWeb'].'"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Pedidos</li>
		</ol>';
	}
	
	private function tabla(){
		$this->buffer = ' <div class="table-responsive" style="overflow: auto;">
			<table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>No. Pedido</th>
						<th>Nombre</th>
						<th>Celular</th>
						<th>Fecha solicitud</th>
						<th>Fecha Entrega</th>
						<th>Atendido</th>
					</tr>
				</thead>';
		if(count($this->registros) > 0){
			$this->buffer .= '
				<tfoot>
					<tr>
						<th>No. Pedido</th>
						<th>Nombre</th>
						<th>Celular</th>
						<th>Fecha solicitud</th>
						<th>Fecha Entrega</th>
						<th>Atendido</th>
					</tr>
				</tfoot>';
		}
		$total    = count($this->registros); 
		if(count($this->registros) > 0){
			$this->buffer .= '<tbody>';
			foreach($this->registros as $reg){
				$this->buffer .= '
				<tr class="renglon'.$reg['id'].'">
				<td class="tdLeft">'.str_pad($reg['id'],6,'0',STR_PAD_LEFT).'</td>
				<td>'.trim($reg['nombre'])." ".$reg['apellidos'].'</td>
				<td class="tdLeft">'.$reg['celular'].'</td>
				<td class="tdCenter">'.$reg['fecha_pedido'].'</td>
				<td class="tdCenter">'.$reg['fecha_entrega'].'</td>
				<td>';
					$this->buffer .= '<a href="#" id="e-'.$reg['id'].'-5" class="eliminar">
						<span class="glyphicon glyphicon-eye-close"></span>
					</a>';
				$this->buffer .= '</td>
			</tr>';
			}
			$this->buffer .= '</tbody>';
		}
		$this->buffer .= '</table></div>';
	}


	private function activaPedido(){
    }
	private function ordenaRegstro(){
	}
	
	function obtenBreadcrumb(){
		$this->bread;
	}
	function obtenExito(){
		return $this->exito;
	}

	function obtenMensaje(){
		return $this->mensaje;
	}

	function obtenBuffer(){
		return $this->buffer;
	}
	
	function obtenRegistros(){
		return $this->registros;
	}
	function obtenTotalCategorias(){
		return $this->total;
	}
}
?>