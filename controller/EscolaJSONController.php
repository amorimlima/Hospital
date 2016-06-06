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

	public function insert($ejs)
	{
		return $this->escolaJSONDAO->insert($ejs);
	}

	public function update($ejs)
	{
		return $this->escolaJSONDAO->update($ejs);
	}

	public function delete($idejs)
	{
		return $this->escolaJSONDAO->delete($idejs);
	}

	public function select($idejs)
	{
		$ejs = $this->escolaJSONDAO->select($idejs);
		return $ejs;
	}

	public function selectAll()
	{
		$ejs = $this->escolaJSONDAO->selectFull();
		return $ejs;
	}

	public function insertAndReturnId($ejs)
	{
		return $this->escolaJSONDAO->insertAndReturnId($ejs);
	}

	public function selectByIdEscola($idesc)
	{
		return $this->escolaJSONDAO->selectByIdEscola($idesc);
	}
}
?>