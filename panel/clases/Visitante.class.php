<?php
class Visitante extends Comunes
{
	var $db;
	var $session;
	var $server;
	var $visita;
	var $opc;
	function __construct($db, $session, $server,$opc){
    	$this->db      = $db;
    	$this->session = $session;
    	$this->server  = $server;
    	$this->visita  = 0;
    	$this->opc     = $opc;
    	
    	if($this->opc == 0){
    			$this->insertaSession();
    	}else{
    		$this->regresaContador();
    	}
  	}
  	
  	function insertaSession(){
  		$fecha = date ( 'Y-m-d H:i:s' );
        $fechaC= date ( 'Y-m-d' );
        try{  
            $info = $this->detect ();
            $sql  = "SELECT idvisitante FROM visitantes where ip='".$this->server ['REMOTE_ADDR']."' AND explorador='".$info ["browser"]."' AND so='".$info ["os"]."' and SUBSTR(fecha,1,10) ='".$fechaC."' limit 1;";
            $res = $this->db->sql_query($sql) or die("error:  ".$sql. " ".print_r($this->db->sql_error()));
            if($this->db->sql_numrows($res) == 0){  		
                $insVisita = "INSERT INTO visitantes(fecha,ip,explorador,so) VALUES ('".$fecha."','" . $this->server ['REMOTE_ADDR'] . "','" . $info ["browser"] . "','" . $info ["os"] . "');";
                $this->db->sql_query ( $insVisita);
                $this->actualizaContador();
            }
        }
        catch(Exception $e){
            die("Error:  ".$e->getMessahe());
        }	
  	}
  	
  	function actualizaContador(){
        try{  
            $noVisita = "UPDATE visita as a set a. contador = a.contador + 1; ";
            $this->db->sql_query ( $noVisita);
        }
        catch(Exception $e){
            die("Error:  ".$e->getMessahe());
        }	   
  	}
  
  	function regresaContador(){
        try{
  		    $sql ="SELECT contador FROM visita LIMIT 1;";
  		    $res = $this->db->sql_query($sql);
  		    if($this->db->sql_numrows($res) > 0){
  			    list($this->visita) = $this->db->sql_fetchrow($res);
            }
        }
        catch(Exception $e){
            die("Error:  ".$e->getMessahe());
        }	
  	}
  	function obtenNoVisita(){
  		return (int)$this->visita;
  	}
}
?>