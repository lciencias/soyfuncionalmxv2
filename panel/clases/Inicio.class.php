<?php
include_once ("Comunes.class.php");
class Inicio extends Comunes{
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
	
	private function guardar(){
	}
	
	private function editar(){
	}
	
	private function actualizar(){
	}
	
	private function eliminar(){
    }
    
	private function activar(){
	}
	
	private function ordenar(){
	}
	
	private function breadcrumb(){
		$this->bread = '<ol class="breadcrumb">
			<li><a href="'.$this->session['pathWeb'].'"><i class="fa fa-dashboard"></i> Inicio</a></li>
		</ol>';
	}
	
	private function tabla(){
		$this->buffer = '
		<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>';
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