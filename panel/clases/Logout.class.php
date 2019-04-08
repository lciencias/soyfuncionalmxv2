<?php
class Logout extends Comunes
{
  var $db;
  var $session;
  var $server;
  var $path;
  
  function __construct($db, $session, $server, $path){
  	parent::__construct($session);
    $this->db      = $db;
    $this->session = $session;
    $this->server  = $server;
    $this->path    = $path;
    $this->cadena_error="<script>location.href='".$this->path."'</script>";
    if($this->session['userId'] > 0){
      $this->CierraSession();
    }
  }
  
  function CierraSession(){
  	try{
	    $fecha=date('Y-m-d H:i:s');
	    $info = $this->detect();
	    $insLog="INSERT INTO acceso(usuario,status,fecha,ip,explorador,so,idusuario) 
	    		VALUES ('".$this->session['userEmail']."','2','".$fecha."','".$this->server['REMOTE_ADDR']."','".$info["browser"]."','".$info["os"]."','".$this->session['userId']."');";
	    $this->db->sql_query($insLog);
  	}
  	catch(\Exception $e){  		
  		$this->writeLog("Error:  ".$e->getTraceAsString(), Comunes::ERROR);
  	}
  }
}
?>