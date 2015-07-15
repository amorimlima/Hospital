<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'MensagemDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MensagemController
 *
 * @author Kevyn
 */
class MensagemController {
    //put your code here
    
    private $mensagemDAO;
    public function __construct()
	{
		$this->mensagemDAO = new MensagemDAO(new DataAccess());
	}
	
	public function insert($mens)
	{
		return $this->mensagemDAO->insert($mens);
	}
	
	public function update($mens)
	{
		return $this->mensagemDAO->update($mens);
	}
	
	public function delete($idmens)
	{
		return $this->mensagemDAO->delete($idmens);
	}
	
	public function select($idmens)
	{
		$mens = $this->mensagemDAO->select($idmens);
		return $mens;
	}
	
	public function selectAll()
	{
		$mens = $this->mensagemDAO->selectFull();
		return $mens;
	}
}
?>