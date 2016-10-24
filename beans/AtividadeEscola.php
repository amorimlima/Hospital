<?php

class AtividadeEscola
{

	private $aes_id;

	private $aes_escola;
	private $aes_atividade;
	private $aes_visualizado;

	public function AtividadeEscola()
	{
	}


	public function getAes_id()
	{
		return $this->aes_id;
	}

	public function getAes_escola()
	{
		return $this->aes_escola;
	}

	public function getAes_atividade()
	{
		return $this->aes_atividade;
	}

	public function getAes_visualizado()
	{
		return $this->aes_visualizado;
	}



	public function setAes_id($value)
	{
		$this->aes_id = $value;
	}

	public function setAes_escola($value)
	{
		$this->aes_escola = $value;
	}

	public function setAes_atividade($value)
	{
		$this->aes_atividade = $value;
	}

	public function setAes_visualizado($value)
	{
		$this->aes_visualizado = $value;
	}

}

?>