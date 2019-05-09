<?php
include_once ("Comunes.class.php");
class EnviaEmailPedido extends Comunes{
	public  $session;
	private $data;
  private $opc;
  private $productos;
	private $mensaje;
	private $exito;

	
	
	function __construct($session, $data, $opc, $productos){
		parent::__construct($session);
		$this->session     = $session;
		$this->data        = $data;
    $this->opc         = $opc;
    $this->productos   = $productos;
		$this->exito       = Comunes::LISTAR;
		
		switch($this->opc){
			case Comunes::SAVE:
				$this->enviaCorreo();
                break;
        }
	}

  private function enviaCorreo(){
    $tituloMensaje = "Pedido por Intenert ";
    $body  = "<p>Nuevo pedido realizado por Internet</p>";
    $body .= "<br><p>Nombre: <b>Luis antonio Hernandez nieto</b></p>";
    $body .= "<br><p>Numero de celular: <b>55 45 43 44 50</b></p>";
    $body .= "<br><p>Correo Electronico: <b>lciencias@gmail.com</b></p>";
    $body .= "<br><p>Domicilio: <b>Jardines de Santa Barbara, Coyoacan Ciudad de Mexico 01020</b></p>";
    $body .= "<br> Pedido<br>";
    $body .= "<table style='100%'><tr><th>Cantidad</th><th>producto</th><th>Precio</th></tr>";
    $body .= "<tr><td>1</td><td>Carne<
		$body_html="<html><head><title>".$tituloMensaje."</title></head><body><p>".$body."</p></body></html>";
		$emailFrom = array ("lciencias@gmail.com" => "Administrador SISEC");		
    try
 		{
 			$transport = Swift_SmtpTransport::newInstance('smtp.df.gob.mx',25)->setUsername('pat@df.gob.mx')->setPassword('gp=a5=d8');
 			$mailer    = Swift_Mailer::newInstance($transport);
 			$message   = Swift_Message::newInstance($tituloMnesaje)->setFrom($emailFrom)->setTo($emailTo)->setBody($body_html,'text/html')->addPart($body_html,'text/plain');
 			if (($mailer->send($message)) > 0)
 			{
 				$this->exito = 1;
 			}
 		}
 		catch(Exception $e){
 			$this->exito = 0;
 			echo "Error:  ".$e->getMessage();
     }
  }
	
	private function calculaImporte(){
    return $this->session['importe'] + 0;
  }
	
	public function obtenExito(){
		return $this->exito;
	}

	public function obtenMensaje(){
		return $this->mensaje;
	}
}
?>