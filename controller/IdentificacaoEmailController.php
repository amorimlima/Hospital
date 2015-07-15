<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'IdentificacaoEmailDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IdentificacaoEmailController
 *
 * @author Kevyn
 */
class IdentificacaoEmailController {
    //put your code here
    
    private $identificacaoEmailDAO;
    public function __construct()
	{
		$this->identificacaoEmailDAO = new IdentificacaoEmailDAO(new DataAccess());
	}
	
	public function insert($ide)
	{
		return $this->identificacaoEmailDAO->insert($ide);
	}
	
	public function update($ide)
	{
		return $this->identificacaoEmailDAO->update($ide);
	}
	
	public function delete($idide)
	{
		return $this->identificacaoEmailDAO->delete($idide);
	}
	
	public function select($idide)
	{
		$ide = $this->identificacaoEmailDAO->select($idide);
		return $ide;
	}
	
	public function selectAll()
	{
		$ide = $this->identificacaoEmailDAO->selectFull();
		return $ide;
	}
}
?>