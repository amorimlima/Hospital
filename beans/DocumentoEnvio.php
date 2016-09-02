<?php

class DocumentoEnvio
{ 
	private $doe_id;

	private $doe_documento;
	private $doe_destinatario;
	private $doe_data_envio;
	private $doe_visto;
	private $doe_retorno;

	public function DocumentoEnvio()
	{

	}

	public function getDoe_id()
	{
		return $this->doe_id;
	}

	public function getDoe_documento()
	{
		return $this->doe_documento;
	}

	public function getDoe_destinatario()
	{
		return $this->doe_destinatario;
	}

	public function getDoe_data_envio()
	{
		return $this->doe_data_envio;
	}

	public function getDoe_visto()
	{
		return $this->doe_visto;
	}

	public function getDoe_retorno()
	{
		return $this->doe_retorno;
	}



	public function setDoe_id($val)
	{
		$this->doe_id = $val;
	}

	public function setDoe_documento($val)
	{
		$this->doe_documento = $val;
	}

	public function setDoe_destinatario($val)
	{
		$this->doe_destinatario = $val;
	}

	public function setDoe_data_envio($val)
	{
		$this->doe_data_envio = $val;
	}

	public function setDoe_visto($val)
	{
		$this->doe_visto = $val;
	}

	public function setDoe_retorno($val)
	{
		$this->doe_retorno = $val;
	}
}
?>