<?php

class AtividadeExtra
{

	private $ate_id;

	private $ate_atividade;
	private $ate_descricao;
	private $ate_arquivo;
	private $ate_data;

	public function AtividadeExtra()
	{
	}

	public function getAte_id()
	{
		return $this->ate_id;
	}

	public function getAte_atividade()
	{
		return $this->ate_atividade;
	}

	public function getAte_descricao()
	{
		return $this->ate_descricao;
	}

	public function getAte_arquivo()
	{
		return $this->ate_arquivo;
	}

	public function getAte_data()
	{
		return $this->ate_data;
	}



	public function setAte_id($value)
	{
		$this->ate_id = $value;
	}

	public function setAte_atividade($value)
	{
		$this->ate_atividade = $value;
	}

	public function setAte_descricao($value)
	{
		$this->ate_descricao = $value;
	}

	public function setAte_arquivo($value)
	{
		$this->ate_arquivo = $value;
	}

	public function setAte_data($value)
	{
		$this->ate_data = $value;
	}

}

?>