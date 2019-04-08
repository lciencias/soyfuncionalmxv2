<?php
class ValidaUsuario extends Comunes {
	var $db;
	var $data;
	var $mensaje;
	var $path;
	var $cadena_error;
	var $user_id;
	var $user_nm;
	var $user_email;
	var $updated_at;
	var $exito;
	var $server;
	var $session;
	function __construct($db, $data, $server, $session, $path) {
		parent::__construct ( $session );
		$this->db = $db;
		$this->data = $data;
		$this->path = $path;
		$this->server = $server;
		$this->session = $session;
		$this->user_id = 0;
		$this->user_nm = $this->updated_at = "";
		$this->mensaje = "Favor de teclear las claves de acceso";
		$this->exito = 0;
		$this->cadena_error = "<script>location.href='" . $this->path . "'</script>";
		if ((trim ( $this->data ['usuario'] ) != "") && (trim ( $this->data ['clave'] ) != "")) {
			$this->data ['usuario'] = trim ( $this->eliminaCaracteresInvalidos ( $this->data ['usuario'] ) );
			$this->data ['clave'] = trim ( $this->eliminaCaracteresInvalidos ( $this->data ['clave'] ) );
			$this->valida ();
		}
	}
	public function valida() {
		$fecha = date ( 'Y-m-d H:i:s' );
		try {
			$info = $this->detect ();
			$sql = "SELECT id,name,email,updated_at FROM users WHERE activo='1'
	          AND email='" . $this->data ['usuario'] . "' AND password = PASSWORD('" . $this->data ['clave'] . "') 
			  LIMIT 1;";
			$res = $this->db->sql_query ( $sql );
			if ($this->db->sql_numrows ( $res ) > 0) {
				$this->exito = 1;
				list ( $this->user_id, $this->user_nm, $this->user_email, $this->updated_at ) = $this->db->sql_fetchrow ( $res );
				$insLog = "INSERT INTO acceso(usuario,status,fecha,ip,explorador,so,idusuario) VALUES ('" . $this->data ['usuario'] . "','1','" . $fecha . "','" . $this->server ['REMOTE_ADDR'] . "','" . $info ["browser"] . "','" . $info ["os"] . "','" . $this->user_id . "');";
				$this->db->sql_query ( $insLog );
			} else {				
				$insLog = "INSERT INTO acceso(usuario,status,fecha,ip,explorador,so,idusuario) VALUES ('" . $this->data ['usuario'] . "','0','" . $fecha . "','" . $this->server ['REMOTE_ADDR'] . "','" . $info ["browser"] . "','" . $info ["os"] . "','1');";
				$this->db->sql_query ( $insLog );
				
				$this->mensaje = "Las claves son incorrectas";
			}
		} catch ( \Exception $e ) {
			$this->writeLog ( $e->getMessage (), Comunes::ERROR );
		}
	}
	public function obtenIdUser() {
		return $this->user_id;
	}
	public function obtenNmUser() {
		return $this->user_nm;
	}
	public function obtenExito() {
		return $this->exito;
	}
	public function obtenMensaje() {
		return $this->mensaje;
	}
	public function obtenEmailUser() {
		return $this->user_email;
	}
}
?>