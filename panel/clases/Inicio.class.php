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
	private $arrayTotales;
	
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
		$this->arrayTotales= array();
		switch($this->opc){
			case Comunes::LISTAR:
				$this->pedidosTotales();
				$this->pedidosPendientes();
				$this->pedidosTotalesDia();
				$this->pedidosPendientesDia();
				$this->tabla();
				break;
    }
	}
	
	public function pedidosTotales(){
		try{
			$sql = "SELECT count(id) as pedidos FROM pedidos as a  WHERE a.status > ".Comunes::LISTAR.";";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$row = $this->db->sql_fetchass($res);
				$this->arrayTotales['pedidosTotales'] = $row['pedidos'];
			}
		}
		catch(Exception $e){
			die("Error: ".$e->getMesssage());
		}
	}

	public function pedidosPendientes(){
		try{
			$sql = "SELECT a.id,a.fecha_entrega,a.importe,a.id_usuario,b.nombre,b.celular
					    FROM pedidos as a left join usuarios b ON b.id = a.id_usuario
							WHERE a.status = ".Comunes::SAVE." ORDER BY a.fecha_entrega ASC;";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$this->total = $this->db->sql_numrows ($res);
				$this->arrayTotales['pedidosPendientes'] = $this->total;
				while($row = $this->db->sql_fetchass($res)){
					$this->registros[] = $row;
				}
			}
		}
		catch(Exception $e){
			die("Error: ".$e->getMesssage());
		}
	}

	public function pedidosTotalesDia(){
		$dia = date("Y-m-d");
		try{
			$sql = "SELECT count(id) as pedidos FROM pedidos as a  WHERE substr(a.fecha_entrega,1,10) = '".$dia."';";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$row = $this->db->sql_fetchass($res);
				$this->arrayTotales['pedidosTotalesDia'] = $row['pedidos'];
			}
		}
		catch(Exception $e){
			die("Error: ".$e->getMesssage());
		}
	}

	public function pedidosPendientesDia(){
		$dia = date("Y-m-d");
		try{
			$sql = "SELECT count(id) as pedidos FROM pedidos as a  WHERE a.status = ".Comunes::SAVE." AND substr(a.fecha_entrega,1,10) = '".$dia."';";
			$res = $this->db->sql_query ($sql);			
			if ($this->db->sql_numrows ($res) > 0){
				$row = $this->db->sql_fetchass($res);
				$this->arrayTotales['pedidosPendientesDia'] = $row['pedidos'];
			}
		}
		catch(Exception $e){
			die("Error: ".$e->getMesssage());
		}
	}

	public function visitantes(){

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
          <div class="small-box bg-aqua">
            <div class="inner tdCenter">
              <h3>'.(int) $this->arrayTotales['pedidosTotales'].'</h3>
              <p>Total de Pedidos</p>
            </div>
            <!--<div class="icon">
              <i class="ion ion-bag"></i>
            </div>-->
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner  tdCenter">
						<h3>'.(int) $this->arrayTotales['pedidosPendientes'].'</h3>
						<p>Pedidos por entregar</p>
            </div>
            <!--<div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>-->
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner  tdCenter">
						<h3>'.(int) $this->arrayTotales['pedidosTotalesDia'].'</h3>
						<p>Total de Pedidos del d&iacute;a</p>
					</div>
            <!--<div class="icon">
              <i class="ion ion-person-add"></i>
            </div>-->
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner  tdCenter">
						<h3>'.(int) $this->arrayTotales['pedidosPendientesDia'].'</h3>
						<p>Pedidos por entregar del d&iacute;a</p>
            </div>
            <!--<div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>-->
          </div>
        </div>
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
	
	public function obtenTotal(){
		return $this->total;
	}
	public function obtenBreadcrumb(){
		return $this->bread;
	}
}
?>