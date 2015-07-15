<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'RespostaMultiplaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespostaMultiplaController
 *
 * @author Kevyn
 */
class RespostaMultiplaController {
    //put your code here
    
    private $respostaMultiplaDAO;
    public function __construct()
	{
		$this->respostaMultiplaDAO = new RespostaMultiplaDAO(new DataAccess());
	}
	
	public function insert($rem)
	{
		return $this->respostaMultiplaDAO->insert($rem);
	}
	
	public function update($rem)
	{
		return $this->respostaMultiplaDAO->update($rem);
	}
	
	public function delete($idrem)
	{
		return $this->respostaMultiplaDAO->delete($idrem);
	}
	
	public function select($idrem)
	{
		$rem = $this->respostaMultiplaDAO->select($idrem);
		return $rem;
	}
	
	public function selectAll()
	{
		$rem = $this->respostaMultiplaDAO->selectFull();
		return $rem;
	}
}
?>