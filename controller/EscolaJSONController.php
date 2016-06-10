<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'EscolaJSONDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EscolaJSONController
 *
 * @author Lucas
 */
class EscolaJSONController {
    //put your code here

    private $escolaJSONDAO;
    public function __construct()
	{
		$this->escolaJSONDAO = new EscolaJSONDAO(new DataAccess());
	}

	public function insert($esj)
	{
		return $this->escolaJSONDAO->insert($esj);
	}

	public function update($esj)
	{
		return $this->escolaJSONDAO->update($esj);
	}

	public function delete($idesj)
	{
		return $this->escolaJSONDAO->delete($idesj);
	}

	public function select($idesj)
	{
		$esj = $this->escolaJSONDAO->select($idesj);
		return $esj;
	}

	public function selectAll()
	{
		$esj = $this->escolaJSONDAO->selectFull();
		return $esj;
	}

	public function insertAndReturnId($esj)
	{
		return $this->escolaJSONDAO->insertAndReturnId($esj);
	}

	public static function selectByIdEscola($idesc)
	{
		$esjDAO = new EscolaJSONDAO(new DataAccess());
		return $esjDAO->selectByIdEscola($idesc)->getEsj_string();
	}
}
?>