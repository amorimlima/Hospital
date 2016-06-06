<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EscolaJSON
 *
 * @author Lucas
 */
class EscolaJSON {
	private $ejs_id;
	private $ejs_escola;
	private $ejs_string;

	public function EscolaJSON() {}

	public function getEjs_id() {
		return $this->ejs_id;
	}

	public function getEjs_escola() {
		return $this->ejs_escola;
	}

	public function getEjs_string() {
		return $this->ejs_string;
	}


	public function setEjs_id($id) {
		$this->ejs_id = $id;
	}

	public function setEjs_escola($escola) {
		$this->ejs_escola = $escola;
	}

	public function setEjs_string($string) {
		$this->ejs_string = $string;
	}
}

?>