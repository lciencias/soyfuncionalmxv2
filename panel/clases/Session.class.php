<?php
include_once ("Comunes.class.php");
class Session extends Comunes{
    var $db;
    var $sesion;
    var $sesionGenerada;
    var $server;
    
    function __construct($db,$session,$server) {
        $this->db		       = $db;        
        $this->server          = $server;
        $this->session         = $session;
        $this->sesionGenerada  = '';
        $this->Consulta_Sesion();
    }
    
    function GeneraSesion()
    {
        $this->sesionGenerada = md5(rand(100000,10000000));        
    }
    
    function Consulta_Sesion()
    {
    	$this->GeneraSesion();
        if((int) $this->session['userId'] > 0)
        {
        	try{
	            $fecha_i	  		  = date('Y-m-d')." 00:01:01";
	            $fecha_c	  		  = date('Y-m-d')." 23:59:59";
	            $sql = "SELECT id FROM sessiones WHERE session='".$this->sesionGenerada."' 
	            		AND timestamp BETWEEN '".$fecha_i."' AND '".$fecha_c."' LIMIT 1;";
	            $res = $this->db->sql_query($sql);
	            if($this->db->sql_numrows($res) == 0){
	                $this->Inserta_Sesion();
	            }
        	}
        	catch(\Exception $e){
        		$this->writeLog("Error:  ".$e->getTraceAsString(), Comunes::ERROR);
        	}        	 
        }
    }
    
    function Inserta_Sesion(){
        $fecha=date('Y-m-d H:i:s');
        try{
        	$ins="INSERT INTO sessiones(session_user,session,timestamp,session_ip) 
        			VALUES ('".$this->session['userId']."','".$this->sesionGenerada."','".$fecha."','".$this->server['REMOTE_ADDR']."');";
        	$res_ins = $this->db->sql_query($ins);
        }
        catch(\Exception $e){
        	$this->writeLog("Error:  ".$e->getTraceAsString(), Comunes::ERROR);
        }
        
    }
    function Obten_Sesion()
    {
        return $this->sesionGenerada;
    }
}
?>