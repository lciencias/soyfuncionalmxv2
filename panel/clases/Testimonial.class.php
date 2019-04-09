<?php
include_once ("Comunes.class.php");
class Testimonial extends Comunes{
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
		$this->tabla       = "testimoniales";
		$this->exito       = Comunes::LISTAR;
		$this->total       = 0;
		$this->registros   = array();
		switch($this->opc){
			case Comunes::LISTAR:
				$this->listar();
				$this->breadcrumb();
				$this->tabla();
				break;
			case Comunes::SAVE:
				$this->guardar();
				break;
			case Comunes::EDIT:
				$this->totalTestimonial();
				$this->editar();
				break;
			case Comunes::UPDATE:
				$this->actualizar();
				break;
			case Comunes::DELETE:
				$this->eliminar();
				break;	
			case Comunes::ORDENAR:
				$this->ordenar();
				break;
            case Comunes::MOSTRAR:
                $this->activar();
				break;

            }
	}
	
	private function listar(){
		$this->registros = array();
		try{
			$sql = "SELECT a.id,concat(a.nombre,'<br>',a.testimonial) as testimonial,
					DATE_FORMAT(a.fecha,'%d-%m-%Y %H:%i') as fecha,
					a.status
					FROM ".$this->tabla." as a 
					WHERE a.status < ".Comunes::EDIT." ORDER BY a.fecha ASC;";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$this->total = $this->db->sql_numrows ($res);
				while($row = $this->db->sql_fetchass($res)){
					$this->registros[] = $row;
				}
			}
			$this->total++;
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}		
	}
	
	private function totalTestimonial(){
		try{
			$sql = "SELECT a.id
					FROM ".$this->tabla." as a 
					WHERE a.status= ".Comunes::SAVE.";";
			$res = $this->db->sql_query ($sql);
			$this->total = $this->db->sql_numrows ($res);			
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}				
	}
	
	private function guardar(){
		$fecha = date("Y-m-d H:i:s");
		try{
			$this->mensaje = "Los datos del testimonio no se cargaron correctamente";
			if(count($this->data) > 0){			
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$ins = "INSERT INTO ".$this->tabla."(nombre,fecha,status, testimonial)
						VALUES ('".$this->data['nombre']."','".$fecha."','".Comunes::LISTAR."','".$this->data['testimonial']."');";				
				$this->db->sql_query($ins);
				$this->mensaje = Comunes::MSGSUCESS;
				$this->exito   = Comunes::SAVE;
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
				$sql = "SELECT a.id,a.nombre,a.testimonial,DATE_FORMAT(a.fecha,'%d-%m-%Y %H:%i') as fecha,a.status
						FROM ".$this->tabla." as a  
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
			$this->mensaje = "Los datos del testimonio no se almacenaron correctamente";
			if(count($this->data) > 0){
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$ins = "UPDATE ".$this->tabla." set ";
				$ins .= "nombre = '".$this->data['nombre']."',
						 testimonial  = '".$this->data['testimonial']."',
						 fecha  = '".$fecha."',
						 status = '". Comunes::LISTAR."'
						 WHERE id = '".$this->data['id']."' limit 1;";
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
    
	private function activar(){
        $this->exito   = Comunes::LISTAR;
		$this->mensaje = Comunes::ERROR; 
		if((int) $this->idImagen > 0){
			try{
				$upd = "UPDATE ".$this->tabla." SET status = '". Comunes::SAVE."' WHERE id= '".$this->idImagen."' LIMIT 1;";
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
				$upd = "UPDATE ".$this->tabla." SET status = '".$valor."' WHERE id= '".$id."' LIMIT 1;";
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
			<li class="active">Testimoniales</li>
		</ol>';
	}
	
	private function tabla(){
		$this->buffer = ' <div class="table-responsive" style="overflow: auto;">
			<table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th>Testimonial</th>
						<th>Fecha de Creaci&oacute;n</th>														
						<th>Editar</th>
						<th>Mostrar</th>
						<th>Ocultar</th>				   
					</tr>
				</thead>';
		if(count($this->registros) > 0){
			$this->buffer .= '
				<tfoot>
					<tr>
						<th>Testimonial</th>
						<th style="width:15px;">Fecha de Creaci&oacute;n</th>														
						<th style="width:6px;">Editar</th>
						<th style="width:6px;">Mostrar</th>
						<th style="width:6px;">Ocultar</th>                                                   
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
				<td>'.$reg['testimonial'].'</td>
				<td>'.$reg['fecha'].'</td>
				<td>
					<a href="'.$this->session['pathWeb'].'testimonial-editar.php?id='.$reg['id'].'&'.$this->db->url().'" id="m-'.$reg['id'].'" class="editar">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
				</td>
				<td>';
					if((int) $reg['status'] == 0){
						$this->buffer .= '<a href="#" id="e-'.$reg['id'].'-6" class="mostrar">
						<span class="glyphicon glyphicon-eye-open"></span>
						</a>';
					}
					$this->buffer .= '</td><td>';
					if((int) $reg['status'] == 1){
						$this->buffer .= '<a href="#" id="e-'.$reg['id'].'-6" class="eliminar">
							<span class="glyphicon glyphicon-eye-close"></span>
						</a>';
					}															  
					$this->buffer .= '</td>
			</tr>';
				$contador++;
			}
			$this->buffer .= '</tbody>';
		}
		$this->buffer .= '</table></div>';
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

	public function obtenTotalCategorias(){
		return $this->total;
	}

	public function obtenBreadcrumb(){
		return $this->bread;
	}
}
?>