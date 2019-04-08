<?php
class Comunes {
    public $cadena_error;
    public $pathWeb;
    public $session;
    public $meses;
    public $mesesC;
    public $dias;
    public $anos;
    public $estados;
    const ERROR   = "Error";
    const DEBUG   = "Debug";
    const INFO    = "Info";
    const LISTAR  = 0;
    const SAVE    = 1;
    const EDIT    = 2;
    const UPDATE  = 3;
    const DELETE  = 4;
    const LISTAR2 = 5;
    const UPDATE2 = 6;
    const WEB     = 7;
    const AJAX    = 8;
    const WEB2    = 9;    
    const MOSTRAR = 10;
    const ORDENAR = 11;    
    const MSGERROR  = "Error inesperado favor de notificar al administrador.";
    const MSGSUCESS = "Operacion realizada correctamente.";
    
    
    function __construct($session) {
    	$this->session = $session;
    	$this->meses   = array(1 => 'Ene',2 => 'Feb',3 => 'Mar',4 => 'Abr',5 => 'May',6 => 'Jun',7 => 'Jul',8 => 'Ago',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');    	
    	$this->dias    = array('Monday' => 'Lunes','Tuesday' => 'Martes','Wednesday' => 'Miércoles','Thursday' => 'Jueves','Friday' => 'Viernes','Saturday' => 'Sábado','Sunday' => 'Domingo');
    	$this->estados = array(1 => 'Aguascalientes',2 => 'Baja California',3 => 'Baja California Sur',
    						   4 => 'Campeche',5 => 'Coahuila',6 => 'Colima',7 => 'Chiapas',8 => 'Chihuahua',9 => 'Ciudad de México',
    						   10 => 'Durango',11 => 'Guanajuato',12 => 'Guerrero',13 => 'Hidalgo',14 => 'Jalisco',15 => 'México',
    						   16 => 'Michoacán',17 => 'Morelos',18 => 'Nayarit',19 => 'Nuevo León',20 => 'Oaxaca',21 => 'Puebla',
    						   22 => 'Querétaro',23 => 'Quintana Roo',24 => 'San Luis Potosí',25 => 'Sinaloa',26 => 'Sonora',
    						   27 => 'Tabasco',28 => 'Tamaulipas',29 => 'Tlaxcala',30 => 'Veracruz',31 => 'Yucatán',32 => 'Zacatecas');
    	
    	$this->anios();
        $this->cadena_error = "<script>location.href='../logout.php'</script>";
    }
    function eliminaCaracteresInvalidosBusqueda($valor) {
        $valor = str_replace("'", "", $valor);
        $valor = str_replace('"', '', $valor);
		$valor = trim($valor);
    	$valor = strip_tags($valor);
        $valor = addslashes($valor);
        $valor = utf8_decode($valor);
        return $valor;
    }
    
    
    function eliminaCaracteresInvalidos($valor) {
        $valor = str_replace("'", "", $valor);
        $valor = str_replace('"', '', $valor);
        //$valor = str_replace(' ', '', $valor);
        return $valor;
    }
    function limpiaCadenas($valor) {
        $valor = trim($valor);
    	$valor = strip_tags($valor);
        $valor = addslashes($valor);
        $valor = utf8_decode($valor);
        return $valor;
    }
	function anios(){
		$this->anos = array();
		$fin    = 2023;
		$inicio = 2009;
		for($i = $fin; $i>= $inicio; $i--){
			$this->anos[] = $i;
		}
		return $this->anos;
	}
    function Formato_Fecha($fecha) {
        return trim(substr($fecha, 8, 2) . "-" . substr($fecha, 5, 2) . "-" . substr($fecha, 0, 4));
    }
    function Formato_Fecha_Biz($fecha) {
    	return trim(substr($fecha, 6, 4) . "-" . substr($fecha, 3, 2) . "-" . substr($fecha, 0, 2));
    }
    
    function muestraAyuda($texto) {
        //return "&nbsp;&nbsp;<a href='#' class='ayudas' rel='popover' data-content='" . $texto . "' data-original-title='Ayuda SiSec'>&nbsp;?&nbsp;</a>";
        // return "&nbsp;&nbsp;<button type=\"button\" style=\"padding-top:0px;width:15px;height:17px;font-size:8px;\" class=\"btn-mio ayudas\" id=\"example\" data-toggle=\"popover\" title=\"Ayuda Sisec\" data-content=\"".$texto."\" >?</button>";
    }
    function LimpiaValores($datos) {
        if (count($datos) > 0) {
            foreach ($datos as $clave => $valor) {
                $datos [$clave] = utf8_decode(addslashes(trim($valor)));
            }
        }
        return $datos;
    }
    function procesando($opcion) {
        $posiciones = $width = $height = $top = 0;
        switch ($opcion) {
            case 1 :
                $posiciones = 100;
                $width = 135;
                $height = 115;
                $top = 180;
                break;
            case 2 :
                $posiciones = 860;
                $width = 135;
                $height = 115;
                $top = 180;
                break;
            case 3:
                $posiciones = 760;
                $width = 135;
                $height = 115;
                $top = 480;
                break;
            case 4:
                $posiciones = 760;
                $width = 135;
                $height = 115;
                $top = 340;
                break;
            case 5 :
                $posiciones = 860;
                $width = 135;
                $height = 115;
                $top = 340;
                break;
        }
        return "<div id='div_procesando' style='position: absolute;width:" . $width . "px;height:" . $height . "px;z-index: 1;left:" . $posiciones . "px;top:" . $top . "px;overflow: visible;'>
            	<img src='" . $this->path . "imagenes/load.gif' border='0'  id='procesando' ><br>
            	<span id='t_procesando' class='procesando'>Procesando.....</span>
          	</div>";
    }
    function GeneraOrden($consec, $ord, $_id, $catalogoId) {
        $consec = 25;
        $idDiv = "o-" . $catalogoId . "-" . $_id;
        $tmp = "";
        $combo = "<select name='" . $idDiv . "' id='" . $idDiv . "' requerid class='bootstrap-select ordenes' style='width:50px;'>";
        for ($i = 1; $i <= $consec; $i ++) {
            $tmp = "";
            if ($i == $ord) {
                $tmp = " selected ";
            }
            $combo .= "<option value='" . $i . "' " . $tmp . ">" . $i . "</option>";
        }
        $combo .= "</select>";
        return $combo;
    }
    function Genera_Archivo($bufferExcel,$path_sis) {
	$this->eliminaTemporales($path_sis);
        $num = rand(1, 100000);
        $archivo = "tmp/file" . $num . ".xls";
        $buffer_salida = '<br><a href="' . $archivo . '" target="_blank" class="btn btn-primary exportar"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Exportar a Excel</a>';
        $f1 = fopen($archivo, "w+");
        fwrite($f1, $bufferExcel);
        fclose($f1);
        return $buffer_salida;
    }
    function insertaBitacora($data, $session, $idProyecto, $idActividad, $idMeta, $idAvance, $estatus) {
        $ins = "INSERT INTO log_proyectos (user_id,proyecto_id,actividad_id,meta_id,avance_id,estatus,ip)
 			  VALUES ('" . $session['userId'] . "','" . $idProyecto . "','" . $idActividad . "','" . $idMeta . "','" . $idAvance . "','" . $estatus . "','" . $session['ip'] . "');";
        $res = $this->db->sql_query($ins) or die($this->cadena_error);
    }
    function detect(){
    	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
    	$os=array("WIN","MAC","LINUX");
    	$info['browser'] = "OTHER";
    	$info['os'] = "OTHER";
    	# buscamos el navegador con su sistema operativo
    	foreach($browser as $parent){
    		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
    		$f = $s + strlen($parent);
    		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
    		$version = preg_replace('/[^0-9,.]/','',$version);
    		if ($s){
    			$info['browser'] = $parent;
    			$info['version'] = $version;
    		}
    	}
    	# obtenemos el sistema operativo
    	foreach($os as $val){
    		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
    			$info['os'] = $val;
    	}
    	# devolvemos el array de valores
    	return $info;
    }
  
    public function limpiaArchivo($nombre){
//    	$nombre = utf8_encode($nombre);
    	$nombre = str_replace(' ','_',$nombre);
    	$nombre = str_replace('Á','A',$nombre);
    	$nombre = str_replace('É','E',$nombre);
    	$nombre = str_replace('Í','I',$nombre);
    	$nombre = str_replace('Ó','O',$nombre);
    	$nombre = str_replace('Ú','U',$nombre);
    	$nombre = str_replace('Ñ','N',$nombre);
    	$nombre = str_replace('á','a',$nombre);
    	$nombre = str_replace('é','e',$nombre);
    	$nombre = str_replace('í','i',$nombre);
    	$nombre = str_replace('ó','o',$nombre);
    	$nombre = str_replace('ú','p',$nombre);
    	$nombre = str_replace('ñ','ñ',$nombre);
    	return $nombre;
    	
    }
    public function writeLog($cadena,$tipo)
    {
    	$arch = fopen($this->session['pathSys']."log/log_".date("Ymd").".log", "a+");    
    	fwrite($arch, "[".date("Y-m-d H:i:s.u")." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['HTTP_X_FORWARDED_FOR']." - $tipo ] ".$cadena."\n");
    	fclose($arch);
    }
  
    public function options($total,$selec){
		$cadena = "";
		for($i=1; $i <= $total; $i++){
			$tmp = "";
			if($i == $selec){
				$tmp = " SELECTED ";
			}
			$cadena.="<option value ='".$i."' ".$tmp.">".$i."</option>";
		}
		return $cadena;
	}
    private function movil(){
		$tablet_browser = 0;
		$mobile_browser = 0;
		$body_class = 'desktop';		
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
			$body_class = "tablet";
		}		
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
			$body_class = "mobile";
		}		
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
			$body_class = "mobile";
		}
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
				'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
				'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
				'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
				'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
				'newt','noki','palm','pana','pant','phil','play','port','prox',
				'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
				'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
				'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
				'wapr','webc','winw','winw','xda ','xda-');
		
		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}
		
		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
			$mobile_browser++;
			//Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}
		$esMovil = 0;
		if ($tablet_browser > 0) {
			$esMovil = 2;
		}
		else if ($mobile_browser > 0) {
			$esMovil = 3;
		}
		else {
			$esMovil = 1;		
		}
		return $esMovil;
    }
    
    public function debug($data){
    	echo"<pre>";
    	print_r($data);
    	echo"</pre>";
    	die();
    }
}
?>