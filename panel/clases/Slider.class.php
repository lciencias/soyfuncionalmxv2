<?php
include_once ("Comunes.class.php");
class Slider extends Comunes{

	private $db;
	public $session;
	private $data;
	private $idImagen;
	private $idImagenMovil;
	private $opc;
	private $mensaje;
	private $exito;
	private $registros;
	private $tabla;
	private $buffer;
	private $total;
	
	function __construct($db,$session,$data,$idImagen,$opc,$idImagenMovil){
		parent::__construct($session);
		$this->db = $db;
		$this->session  = $session;
		$this->data     = $data;
		$this->idImagen = $idImagen;
		$this->idImagenMovil = $idImagenMovil;
		$this->opc      = $opc;
		$this->mensaje  = "";
		$this->buffer   = "";
		$this->tabla    = "slide";
		$this->exito    = Comunes::LISTAR;
		$this->registros= array();
		$this->total    = 0;
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
				$this->editar();
				$this->totalCategoria();
				
				break;
			case Comunes::UPDATE:
				$this->actualizar();
				break;
			case Comunes::DELETE:
				$this->eliminar();
				break;				
			case Comunes::WEB:
				$this->listarSlideWebArray();
				$this->listarSlideWeb();
				break;
			case Comunes::ORDENAR:
				$this->ordenaRegstro();
				break;
		}
	}
	
	private function listarSlideWeb(){
		$contador = 0;	
		$arraySlide = array();
		try{
			$sql = "SELECT a.idslide,a.nombre,DATE_FORMAT(a.fecha, '%d-%m-%y %H:%i:%s') AS fecha,
					a.texto_corto,a.texto_grande,a.texto_boton,a.url,b.web,c.web as webMovil
					FROM ".$this->tabla." as a 
					JOIN imagen as b ON b.idimagen = a.idImagen
					JOIN imagen as c ON c.idimagen = a.idimagenMovil
					WHERE a.status = ".Comunes::SAVE." ORDER BY a.orden ASC;";
		
			$res = $this->db->sql_query ($sql);
			if ($this->db->sql_numrows ($res) > 0){
				$this->buffer = '<div class="carousel-inner" role="listbox">';
				while(list($idslide,$nombre,$fecha,$texto_corto,$texto_grande,$texto_boton,$url,$web,$webMovil) = $this->db->sql_fetchrow($res)){
					$class = "";
					if($contador == 0){
						$class = "active";
					}					
					$this->buffer .='<!-- Slide '.($contador + 1 ).' -->
						<div class="item '.$class.'">';
					if((int) $this->movil() > 1 && trim($webMovil) != ''){
						$this->buffer .='<img src="'.$webMovil.'" alt="" />';
					}
					else{
						$this->buffer .='<img src="'.$web.'" alt="" />';
					}
					$this->buffer .='<div class="carousel-caption">              
	                			<div class="tp-caption sfl title-slide center" data-x="40" data-y="210" data-speed="1000" data-start="1000" data-easing="Power3.easeInOut">
									'.trim($texto_corto).'
								</div>
	                			<div class="tp-caption sfr desc-slide center" data-x="40" data-y="140" data-speed="1000" data-start="1500" data-easing="Power3.easeInOut">
									'.trim($texto_grande).'
								</div>
	                			<div class="tp-caption sfr desc-slide center" data-x="40" data-y="180" data-speed="1000" data-start="1500" data-easing="Power3.easeInOut"></div>';
								if(trim($url) != ''){
									$this->buffer .='<div class="tp-caption sfr flat-button-slider" data-x="40" data-y="320" data-speed="1000" data-start="2000" data-easing="Power3.easeInOut"><a href="'.$url.'" target="new">'.trim($texto_boton).'</a>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>';
								}
	            		$this->buffer .='</div>
	          			</div>';
					$arraySlide[$contador] = $class;
					$contador++;
				}
				$this->buffer .='<ol class="carousel-indicators">';
				foreach($arraySlide as $id => $clase){
					$this->buffer .='<li data-target="#myCarousel" data-slide-to="'.$id.'" class="'.$clase.'"></li>';
				}
				$this->buffer .='</ol>';
				$this->buffer .='</div>';
			}
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}	
	}
	
	
	private function listarSlideWebArray(){
		$this->registros = array();
		try{
			$sql = "SELECT a.idslide,a.nombre,DATE_FORMAT(a.fecha, '%d-%m-%y %H:%i:%s') AS fecha, a.orden,
					a.texto_corto,a.texto_grande,a.texto_boton,a.url,a.idImagen,b.web,c.web as webMovil
					FROM ".$this->tabla." as a 
					JOIN imagen as b ON b.idimagen = a.idImagen 
					JOIN imagen as c ON c.idimagen = a.idimagenMovil
					WHERE a.status = ".Comunes::SAVE." ORDER BY a.orden ASC;";			
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
	
	private function totalCategoria(){
		try{
			$sql = "SELECT a.idslide
					FROM ".$this->tabla." as a 
					WHERE a.status= ".Comunes::SAVE.";";
			$res = $this->db->sql_query ($sql);
			$this->total = $this->db->sql_numrows ($res);			
		}catch (\Exception $e){
			$this->writeLog($e->getMessage(), Comunes::ERROR);
		}				
	}
	
	private function listar(){
		$this->registros = array();
		try{
			$sql = "SELECT idslide,nombre,DATE_FORMAT(fecha, '%d-%m-%y %H:%i:%s') AS fecha, orden 
					FROM ".$this->tabla." WHERE status = 1 ORDER BY idslide desc;";
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
	private function guardar(){
		$fecha = date("Y-m-d H:i:s");
		try{
			$this->mensaje = "La imagen no se cargo correctamente";
			if((int)$this->idImagen > 0){			
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$ins = "INSERT INTO ".$this->tabla."(nombre, fecha, status, orden, texto_corto, texto_grande, texto_boton, url, idImagen,idimagenMovil)
						VALUES ('".$this->data['nombre']."','".$fecha."','".Comunes::SAVE."','".$this->data['orden']."','".$this->data['texto_corto']."','".$this->data['texto_grande']."','".$this->data['texto_boton']."','".$this->data['url']."','".$this->idImagen."','".$this->idImagenMovil."');";
				
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
				$sql = "SELECT a.idslide,a.nombre,DATE_FORMAT(a.fecha,'%d-%m-%y %H:%i:%s') AS fecha,a.texto_corto,a.texto_grande,
						a.texto_boton,a.url,a.idimagen,b.archivo,b.ruta,b.web,c.web as webMovil,a.orden 
						FROM ".$this->tabla." a 
								LEFT JOIN imagen b on b.idimagen = a.idimagen 
								LEFT JOIN imagen c on c.idimagen = a.idimagenMovil
								WHERE a.idslide = '".$id."' LIMIT 1;";
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
		$anadir = "";
		try{
			$this->mensaje = "La imagen no se cargo correctamente";
			if((int)$this->idImagen > 0){
				foreach($this->data as $key => $value){
					$this->data[$key] = $this->eliminaCaracteresInvalidos($value);
				}
				$ins = "UPDATE ".$this->tabla." set 
							nombre = '".$this->data['nombre']."',
							fecha  = '".$fecha."', 
							status = '".Comunes::SAVE."',
							orden  = '".$this->data['orden']."', 
							texto_corto  = '".$this->data['texto_corto']."',
							texto_grande = '".$this->data['texto_grande']."', 
							texto_boton  ='".$this->data['texto_boton']."',
							url          ='".$this->data['url']."',
							idimagenMovil = '".($this->idImagenMovil + 0)."',
							idImagen     ='".$this->idImagen."' WHERE idslide = '".$this->data['idslide']."' limit 1;";
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
				$upd = "UPDATE ".$this->tabla." SET status = '". Comunes::EDIT."' WHERE idslide = '".$this->idImagen."' LIMIT 1;";
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
			<li class="active">Banners</li>
		</ol>';
	}
	private function ordenaRegstro(){
		$id = (int) $this->data['id'];
		$valor = (int) $this->data['valor'];
		if($id > 0 && $valor > 0){
			try{
				$upd = "UPDATE ".$this->tabla." SET orden = '".$valor."' WHERE idslide= '".$id."' LIMIT 1;";
				$this->db->sql_query($upd);
				$this->exito = Comunes::SAVE;
				$this->mensaje = Comunes::MSGSUCESS;
			}catch(\Exception $e){
				$this->mensaje = $e->getMessage();
				$this->writeLog($e->getMessage(), Comunes::ERROR);
			}
		}	
	}
	

	private function tabla(){
		$this->buffer = ' <div class="table-responsive" style="overflow: auto;">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Fecha</th>
						<th>Editar</th>
                        <th>Eliminar</th>
                        <th>Orden</th>
                    </tr>
				</thead>';											
			if(count($registros) > 0){
				$this->buffer = '
				<tfoot>
					<tr>
						<th>Nombre</th>
						<th>Fecha</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
						<th>Orden</th>
					</tr>
				</tfoot>';											
			}
			$this->buffer .= '<tbody>';
			$contador = 1;
			$total = count($this->registros);
			if(count($this->registros) > 0){
				foreach($this->registros as $reg){
					$this->buffer .= '
						<tr class="renglon'.$reg['idslide'].'">
							<td>'.$reg['nombre'].'</td>
							<td>'.$reg['fecha'].'</td>
							<td>
								<a href="'.$path_web.'banner-editar.php?id='.$reg['idslide'].'&'.$db->url().'" id="m-'.$reg['idslide'].'" class="editar">
								<img src="'.$path_lib.'dist/img/icons/editar.png">
								</a>
							</td>
							<td>
								<a href="#" id="e-'.$reg['idslide'].'-1" class="eliminar">
									<img src="'.$path_lib.'dist/img/sweetalert/eliminar.png"																	
									alt="alert" class="img-responsive model_img" id="sa-warning'.$reg['idslide'].'">
    							</a>
							</td>
    						<td>
    							<select name="orden-'.$reg['idslide'].'-1" id="orden-'.$reg['idslide'].'-1" style="width:50px;border:solid 1px #e5e5e5;" class="ordenar">
									'.$this->options($total,$reg['orden']).'
								</select>
    						</td>
						</tr>';
						$contador++;
				}
			}
			$this->buffer .= '
				</tbody>
				</table></div>';
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
	
	public function obtenBreadcrumb(){
		return $this->bread;
	}
	
	public function obtenTotal(){
		return $this->total;
	}
}
?>