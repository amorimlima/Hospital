<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'AdministracaoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministracaoController
 *
 * @author Kevyn
 */
class AdministracaoController {
    //put your code here
    
    private $administracaoDAO;
    public function __construct()
	{
		$this->administracaoDAO = new AdministracaoDAO(new DataAccess());
	}
	
	public function insert($adm)
	{
		return $this->administracaoDAO->insert($adm);
	}
	
	public function update($adm)
	{
		return $this->administracaoDAO->update($adm);
	}
	
	public function delete($idadm)
	{
		return $this->administracaoDAO->delete($idadm);
	}
	
	public function select($idadm)
	{
		$adm = $this->administracaoDAO->select($idadm);
		return $adm;
	}
	
	public function selectAll()
	{
		$adm = $this->administracaoDAO->selectFull();
		return $adm;
	}
}
?>