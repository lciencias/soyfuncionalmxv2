<?php
class BusquedaGeneral extends Comunes{
	private $db;
	private $data;
	private $registros;
	private $arrayNombres;
	private $arrayUrls;
	private $arrayTablas;
	
	private $noRegistros;

	
	function __construct($db,$data){
		$this->db        = $db;
		$this->data      = $data;
		$this->registros = $this->tablas = $this->arrayNombres = $this->arrayUrls = array();
		if(isset($this->data['search']) && trim($this->data['search']) !== '') {
			$this->noRegistros = 0;
			$this->data['search'] = $this->eliminaCaracteresInvalidosBusqueda($this->data['search']);
			$this->tablas();
			$this->consultaGeneral();
		}
	}
	function consultaGeneral() {
		if(count($this->tablas) > 0) {
			foreach($this->tablas as $ind => $arrayTmp){
				$consulta = $this->construyeQuery($arrayTmp['sql'],$arrayTmp['filtros'],$arrayTmp['orden']);
				$this->registros[$arrayTmp['nombre']] = $this->ejecutaQuery($consulta);
			}		
		}
	}
	
	function ejecutaQuery($consulta){
		$regs = array();
		try{			
			$res = $this->db->sql_query ($consulta) or die("Error en la consulta:  ".$consulta);
			$num = $this->db->sql_numrows ($res); 
			$this->noRegistros = $this->noRegistros + $num; 
			if ( $num > 0){
				while($row = $this->db->sql_fetchass($res)){
					$regs[] = $row;							
				}
			}
			return $regs;
		}
		catch (\Exception $e){
			die($e->getMessage());			
		}		
		
	}
	function tablas(){
		$this->arrayNombres[0] = "Acuerdo";	
		$this->arrayNombres[1] = "Becas";			
		$this->arrayNombres[2] = "Biblioteca Amivtac";
		$this->arrayNombres[3] = "Biblioteca Piarc";
		$this->arrayNombres[4] = "Capitulos Estados";
		$this->arrayNombres[5] = "Cargo";
		$this->arrayNombres[6] = "Cargo Delegaci&oacute;n";
		$this->arrayNombres[7] = "Comite";
		$this->arrayNombres[8] = "Coordinador";
		$this->arrayNombres[9] = "Delegaci&oacute;n";
		$this->arrayNombres[10] = "Eventos";
		$this->arrayNombres[11] = "Noticias";
		$this->arrayNombres[12] = "Presidente";
		$this->arrayNombres[13] = "Red Presidente";
		$this->arrayNombres[14] = "Revista";
		$this->arrayNombres[15] = "Socio";
		$this->arrayNombres[16] = "Vinculo";
		$this->arrayNombres[17] = "Biblioteca Amivtac";
		$this->arrayNombres[18] = "Biblioteca Piarc";
		
		$this->arrayUrls[0] = "acuerdos-convenios.php";	
		$this->arrayUrls[1] = "index.php";			
		$this->arrayUrls[2] = "biblioteca-amivtac.php?id=";
		$this->arrayUrls[3] = "biblioteca-piarc.php?id=";
		$this->arrayUrls[4] = "delegaciones.php";
		$this->arrayUrls[5] = "mesa-directiva.php";
		$this->arrayUrls[6] = "delegaciones.php";
		$this->arrayUrls[7] = "comites-amivtac.php";
		$this->arrayUrls[8] = "mesa-directiva.php";
		$this->arrayUrls[9] = "delegaciones.php";
		$this->arrayUrls[10] = "evento.php?idevento=";
		$this->arrayUrls[11] = "noticia.php?idnoticia=";
		$this->arrayUrls[12] = "mesa-directiva.php";
		$this->arrayUrls[13] = "expresidentes.php";
		$this->arrayUrls[14] = "Revista";
		$this->arrayUrls[15] = "socios-honor.php";
		$this->arrayUrls[16] = "index.php";
		$this->arrayUrls[17] = "biblioteca-amivtac.php?id=";
		$this->arrayUrls[18] = "biblioteca-piarc.php?id=";
		
		$this->tablas[0]["nombre"]  = "Acuerdo";
		$this->tablas[0]["sql"]     = "select idacuerdo as id,nombre,texto,fecha,CONCAT(nombre,'<br>',texto) AS descrip from acuerdo where status = 1 ";
		$this->tablas[0]["filtros"] = "nombre|texto";
		$this->tablas[0]["orden"]   = "nombre";
		$this->tablas[0]["campos"] = "select idacuerdo,nombre,texto,fecha";
		
		$this->tablas[1]["nombre"] = "Becas";
		$this->tablas[1]["sql"] = "select idbeca as id ,nombre,descripcion,CONCAT(nombre,'<br>',descripcion) AS descrip,fecha from beca where status = 1 ";
		$this->tablas[1]["filtros"] = "nombre|descripcion";
		$this->tablas[1]["orden"] = "nombre";
		$this->tablas[1]["campos"] = "idbeca,nombre,descripcion,fecha";
				
		$this->tablas[2]["nombre"] = "Biblioteca Amivtac";
		$sql = "SELECT a.idbiblioteca as id,a.nombre,a.fecha,a.nombre AS descrip FROM biblioteca as a WHERE a.status = 1 and a.tipo = 1 ";
		
		$this->tablas[2]["sql"] = $sql;
		$this->tablas[2]["filtros"] = "a.nombre";
		$this->tablas[2]["orden"]   = "a.idbiblioteca";
		$this->tablas[2]["campos"]  = "idbiblioteca,idarchivo";

		$this->tablas[3]["nombre"] = "Biblioteca Piarc";
		$sql = "SELECT a.idbiblioteca as id,a.nombre,a.fecha,a.nombre AS descrip FROM biblioteca as a WHERE a.status = 1 and a.tipo = 2 ";
		$this->tablas[3]["sql"] = $sql;
		$this->tablas[3]["filtros"] = "a.nombre";
		$this->tablas[3]["orden"]   = "a.idbiblioteca";
		$this->tablas[3]["campos"]  = "idbiblioteca,nombre,fecha";
		
		$this->tablas[4]["nombre"] = "Capitulos Estados";
		$this->tablas[4]["sql"] = "select id ,idcapitulo,nombre,presidente,fecha_toma,objetivo,CONCAT(nombre,'<br>',presidente,'<br>',objetivo) AS descrip,idestado,fecha from capitulos where status = 1 ";
		$this->tablas[4]["filtros"] = "nombre|presidente|objetivo";
		$this->tablas[4]["orden"] = "nombre";
		$this->tablas[4]["campos"] = "id,idcapitulo,nombre,presidente,fecha_toma,objetivo,fecha";
		
		$this->tablas[5]["nombre"] = "Cargo";
		$this->tablas[5]["sql"] = "select idcargo as id ,nombre,cargo,CONCAT(nombre,'<br>',cargo) AS descrip,fecha from cargo where status = 1 ";
		$this->tablas[5]["filtros"] = "nombre|cargo";
		$this->tablas[5]["orden"] = "nombre";
		$this->tablas[5]["campos"] = "idcargo,nombre,cargo";
		
		$this->tablas[6]["nombre"] = "Cargo Delegacion";
		$this->tablas[6]["sql"] = "select idcargodelegacion as id ,iddelegacion,nombre,cargo,CONCAT(nombre,'<br>',cargo) AS descrip,'' as fecha from cargodelegacion where estatus = 1 ";
		$this->tablas[6]["filtros"] = "nombre|cargo";
		$this->tablas[6]["orden"] = "nombre";
		$this->tablas[6]["campos"] = "idcargodelegacion,iddelegacion,nombre,cargo";
		
		$this->tablas[7]["nombre"] = "Comite";
		$this->tablas[7]["sql"] = "select idcomite as id,tipo,nombre,presidente,fecha,objetivo,correo,CONCAT(nombre,'<br>',presidente,'<br>',objetivo,'<br>',correo) AS descrip from comite where status = 1 ";
		$this->tablas[7]["filtros"] = "nombre|presidente|objetivo|correo";
		$this->tablas[7]["orden"] = "nombre";
		$this->tablas[7]["campos"] = "idcomite,tipo,nombre,presidente,fecha,objetivo,correo";
	
		$this->tablas[8]["nombre"] = "Coordinador";
		$this->tablas[8]["sql"] = "select idcoordinador as id,nombre,coordinacion,fecha,CONCAT(nombre,'<br>',coordinacion) AS descrip from coordinador where status = 1 ";
		$this->tablas[8]["filtros"] = "nombre|coordinacion";
		$this->tablas[8]["orden"] = "nombre";
		$this->tablas[8]["campos"] = "idcoordinador,nombre,coordinacion,fecha";
		
		$this->tablas[9]["nombre"] = "Delegaci&acute;n";
		$this->tablas[9]["sql"] = "select iddelegacion as id,tipo,nombre,fecha,direccion,objetivo,CONCAT(nombre,'<br>',direccion,'<br>',objetivo) AS descrip from delegacion where status = 1 ";
		$this->tablas[9]["filtros"] = "nombre|direccion|objetivo";
		$this->tablas[9]["orden"] = "nombre";
		$this->tablas[9]["campos"] = "iddelegacion,tipo,nombre,fecha,direccion,objetivo";
		
		$this->tablas[10]["nombre"] = "Eventos";
		$this->tablas[10]["sql"] = "select idevento as id ,titulo as nombre,texto1,texto2,nota,descripcion,fecha_evento,fecha,CONCAT(titulo	,'<br>',texto1,'<br>',texto2,'<br>',nota,'<br>',descripcion) AS descrip from evento where status = 1 ";
		$this->tablas[10]["filtros"] = "titulo|texto1|texto2|texto2|nota|descripcion";
		$this->tablas[10]["orden"] = "titulo";
		$this->tablas[10]["campos"] = "idevento,titulo,texto1,texto2,nota,descripcion,fecha_evento,fecha";
		
		$this->tablas[11]["nombre"] = "Noticias";
		$this->tablas[11]["sql"] = "select idnoticia as id,titulo as nombre,fecha_noticia as fecha,descripcion,texto1,texto2,texto3,nota,CONCAT(titulo,'<br>',texto1,'<br>',texto2,'<br>',texto3,'<br>',nota,'<br>',descripcion) AS descrip from noticia where status=1 ";		
		$this->tablas[11]["filtros"] = "titulo|descripcion|texto1|texto2|nota";
		$this->tablas[11]["orden"] = "titulo";
		$this->tablas[11]["campos"] = "idnoticia,titulo,fecha_noticia,descripcion,texto1,texto2,texto3,nota";
		
		$this->tablas[12]["nombre"] = "Presidente";
		$this->tablas[12]["sql"] = "select idpresidente as id,nomesa,presidente as nombre,fecha,CONCAT(nomesa,'<br>',presidente) AS descrip  from presidente where status = 1 ";
		$this->tablas[12]["filtros"] = "presidente";
		$this->tablas[12]["orden"] = "presidente";
		$this->tablas[12]["campos"] = "idpresidente,nomesa,presidente,fecha";
	
		$this->tablas[13]["nombre"] = "Red Presidente";
		$this->tablas[13]["sql"] = "select idredpresidente as id ,idcomite,nombre,cargo,CONCAT(nombre,'<br>',cargo) AS descrip from redpresidente where estatus = 1 ";
		$this->tablas[13]["filtros"] = "nombre|cargo";
		$this->tablas[13]["orden"] = "nombre";
		$this->tablas[13]["campos"] = "idredpresidente,idcomite,nombre,cargo";
		
		$this->tablas[14]["nombre"] = "Revista";
		$this->tablas[14]["sql"] = "select idrevista as id,no,titulo as nombre,periodo,anio,resena,url,CONCAT(titulo,'<br>',resena) AS descrip,CONCAT(periodo,', ',anio) AS fecha from revista where status =1 ";
		$this->tablas[14]["filtros"] = "titulo|resena|periodo|anio";
		$this->tablas[14]["orden"] = "titulo";
		$this->tablas[14]["campos"] = "idrevista,no,titulo,periodo,anio,resena";
		
		$this->tablas[15]["nombre"] = "Socio";
		$this->tablas[15]["sql"] = "select idsocio as id,nombre,fecha,CONCAT(finado,'&nbsp;',nombre) AS descrip from socio where status = 1 ";
		$this->tablas[15]["filtros"] = "nombre";
		$this->tablas[15]["orden"] = "nombre";
		$this->tablas[15]["campos"] = "idsocio,nombre,fecha";

		$this->tablas[16]["nombre"] = "Vinculo";
		$this->tablas[16]["sql"] = "select id,nombre,fecha,url,concat(nombre,'<br>',url) as descrip from vinculo where status = 1 ";
		$this->tablas[16]["filtros"] = "nombre|url";
		$this->tablas[16]["orden"] = "nombre";
				
		$this->tablas[17]["nombre"] = "Biblioteca Amivtac";
		$sql = "SELECT b.idbiblioteca as id,b.idarchivo,b.subcarpeta as nombre,b.autor,b.descripcion,b.subcarpeta as descrip,b.fecha_material as fecha FROM archivos b WHERE b.tipo = 1 ";		
		$this->tablas[17]["sql"] = $sql;
		$this->tablas[17]["filtros"] = "b.subcarpeta|b.autor|b.descripcion";
		$this->tablas[17]["orden"]   = "b.idbiblioteca,b.idarchivo";
		$this->tablas[17]["campos"]  = "idbiblioteca,idarchivo";

		$this->tablas[18]["nombre"] = "Biblioteca Piarc";
		$sql = "SELECT b.idbiblioteca as id,b.idarchivo,b.subcarpeta as nombre,b.autor,b.descripcion,b.subcarpeta as descrip,b.fecha_material as fecha FROM archivos b WHERE b.tipo = 2 ";
		$this->tablas[18]["sql"] = $sql;
		$this->tablas[18]["filtros"] = "b.subcarpeta|b.autor|b.descripcion";
		$this->tablas[18]["orden"]   = "b.idbiblioteca,b.idarchivo";
		$this->tablas[18]["campos"]  = "idbiblioteca,nombre,fecha";
		
	}
	
	function construyeQuery($consulta,$filtros,$orden){
		$sql    = $filtro = "";		
		$tmp    = array(); 
		$cadena = $this->data['search'];
		$campos = explode( '|', $filtros);
		if ( count($campos) > 0 ) {
			foreach($campos as $campo){
				$tmp[] = $campo. " like '%".$this->data['search']."%' ";
			}
			$filtro = " ( ".implode(' OR ',$tmp)." ) ";
			$sql = $consulta." AND ".$filtro."  ORDER BY ".$orden." ;";		
		}
		return $sql;
	}
		
	function obtenRegistros(){
		return $this->registros;
	}
	
	function obtenNombres(){
		return $this->arrayNombres;
	}
	function totalRegistro(){
		return $this->noRegistros;
	}
	function obtenMeses(){
		return array(1 => 'Enero',2 => 'Febrero',3 => 'Marzo',4 => 'Abril',5 => 'Mayo',6 => 'Junio',7 => 'Julio',8 => 'Agosto',9 => 'Septiembre',10 => 'Octubre',11 => 'Noviembre',12 => 'Diciembre');
	}
	function obtenUrl(){
		return $this->arrayUrls;
	}
}
?>