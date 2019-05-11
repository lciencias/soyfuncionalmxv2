<?php
include_once ("Comunes.class.php");
class EnviaEmailPedido extends Comunes{
	public  $db;
	private $mensaje;
	private $exito;
	private $registros;

	function __construct($db){
		$this->db     = $db;
		$this->exito  = Comunes::LISTAR;
		$this->mensaje= Comunes::MSGERROR;
		$this->procesaCorreos();
		$this->envia();
	}

	private function procesaCorreos(){
		$this->registros = array();
		try{
			$sql = "SELECT id, email, copia, body from correos where estatus = 0 ORDER BY id asc;";
			$res = $this->db->sql_query($sql);		
			if ($this->db->sql_numrows ($res) > 0){
				while($row = $this->db->sql_fetchass()){
					$this->registros[] = $row;
				}
			}
		}
		catch(Exception $e){
			$this->mensaje = $e->getMessage();
		}
	}

  private function envia(){
		$emailFrom = array ("admin@soyfuncionalmx.com" => "Administrador Soy Funcional MX");
		$tituloMnesaje = "Solicitud de Pedido por Internet";
		if(count($this->registros) > 0){
			foreach($this->registros as $data){
				$body    = $data['body'];
				$emailTo = $data['email'];
				$copia   = $data['copia'];
				try{
					$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
										->setUsername('cubesoftw@gmail.com')
										->setPassword('Vallesoswa990205pwd!');
					$mailer    = Swift_Mailer::newInstance($transport);
					$message   = Swift_Message::newInstance($tituloMnesaje)
											->setFrom($emailFrom)
											->setTo($emailTo)
											->setBcc($copia)
											->setBody($body,'text/html')
											->addPart($body,'text/plain');
					//if (($mailer->send($message)) > 0){
						$this->actualizaEstatus($data['id']);
						$this->exito = Comunes::SAVE;
						$this->mensaje = Comunes::MSGSUCESS;
					//}
				}
				catch(Exception $e){
					$this->exito = Comunes::LISTAR;
					$this->mensaje  = $e->getMessage();
				}
			}
		}else{
			$this->exito = Comunes::LISTAR;
			$this->mensaje  = "No existen correos por enviar";
		}
  }
	
	private function actualizaEstatus($id){
		try{
			$sql = "UPDATE correos SET estatus= '".Comunes::SAVE."' WHERE id = '".$id."' LIMIT 1;";
			$this->db->sql_query($sql);
		}
		catch(Exception $e){
			$this->mensaje = $e->getMessage();
		}
	}
	public function obtenExito(){
		return $this->exito;
	}

	public function obtenMensaje(){
		return $this->mensaje;
	}
}
?>