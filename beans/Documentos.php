<?php

class Documentos
{ 
	private $doc_id;

	private $doc_assunto;
	private $doc_descricao;
	private $doc_arquivo;

	public function Documentos()
	{

	}

	public function getDoc_id()
	{
		return $this->doc_id;
	}

	public function getDoc_assunto()
	{
		return $this->doc_assunto;
	}

	public function getDoc_descricao()
	{
		return $this->doc_descricao;
	}

	public function getDoc_arquivo()
	{
		return $this->doc_arquivo;
	}


	public function setDoc_id($val)
	{
		$this->doc_id = $val;
	}

	public function setDoc_assunto($val)
	{
		$this->doc_assunto = $val;
	}

	public function setDoc_descricao($val)
	{
		$this->doc_descricao = $val;
	}

	public function setDoc_arquivo($val)
	{
		$this->doc_arquivo = $val;
	}

}
?>