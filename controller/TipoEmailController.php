<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'TipoEmailDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoEmailController
 *
 * @author Kevyn
 */
class TipoEmailController {
    //put your code here
     private $tipoEmailDAO;
    public function __construct()
	{
		$this->tipoEmailDAO = new TipoEmailDAO(new DataAccess());
	}
	
	public function insert($tie)
	{
		return $this->tipoEmailDAO->insert($tie);
	}
	
	public function update($tie)
	{
		return $this->tipoEmailDAO->update($tie);
	}
	
	public function delete($idtie)
	{
		return $this->tipoEmailDAO->delete($idtie);
	}
	
	public function select($idtie)
	{
		$tie = $this->tipoEmailDAO->select($idtie);
		return $tie;
	}
	
	public function selectAll()
	{
		$tie = $this->tipoEmailDAO->selectFull();
		return $tie;
	}
}
?>