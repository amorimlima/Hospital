<?php

class DocumentoRetorno
{ 
	private $dor_id;

	private $dor_documento;
	private $dor_remetente;
	private $dor_envio;
	private $dor_visto;
	private $dor_rejeitado;
	private $dor_data;

	public function DocumentoRetorno()
	{

	}

	public function getDor_id()
	{
		return $this->dor_id;
	}

	public function getDor_documento()
	{
		return $this->dor_documento;
	}

	public function getDor_remetente()
	{
		return $this->dor_remetente;
	}

	public function getDor_envio()
	{
		return $this->dor_envio;
	}

	public function getDor_visto()
	{
		return $this->dor_visto;
	}

	public function getDor_rejeitado()
	{
		return $this->dor_rejeitado;
	}

	public function getDor_data()
	{
		return $this->dor_data;
	}



	public function setDor_id($val)
	{
		$this->dor_id = $val;
	}

	public function setDor_documento($val)
	{
		$this->dor_documento = $val;
	}

	public function setDor_remetente($val)
	{
		$this->dor_remetente = $val;
	}

	public function setDor_envio($val)
	{
		$this->dor_envio = $val;
	}

	public function setDor_visto($val)
	{
		$this->dor_visto = $val;
	}

	public function setDor_rejeitado($val)
	{
		$this->dor_rejeitado = $val;
	}

	public function setDor_data($val)
	{
		$this->dor_data = $val;
	}
}
?>