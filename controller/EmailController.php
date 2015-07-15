<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'EmailDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailController
 *
 * @author Kevyn
 */
class EmailController {
    //put your code here
    
    private $emailDAO;
    public function __construct()
	{
		$this->emailDAO = new EmailDAO(new DataAccess());
	}
	
	public function insert($eml)
	{
		return $this->emailDAO->insert($eml);
	}
	
	public function update($eml)
	{
		return $this->emailDAO->update($eml);
	}
	
	public function delete($ideml)
	{
		return $this->emailDAO->delete($ideml);
	}
	
	public function select($ideml)
	{
		$eml = $this->emailDAO->select($ideml);
		return $eml;
	}
	
	public function selectAll()
	{
		$eml = $this->emailDAO->selectFull();
		return $eml;
	}
}
?>