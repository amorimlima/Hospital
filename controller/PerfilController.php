<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'PerfilDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilController
 *
 * @author Kevyn
 */
class PerfilController {
    //put your code here
    
    private $perfilDAO;
    public function __construct()
	{
		$this->perfilDAO = new PerfilDAO(new DataAccess());
	}
	
	public function insert($prf)
	{
		return $this->perfilDAO->insert($prf);
	}
	
	public function update($prf)
	{
		return $this->perfilDAO->update($prf);
	}
	
	public function delete($idprf)
	{
		return $this->perfilDAO->delete($idprf);
	}
	
	public function select($idprf)
	{
		$prf = $this->perfilDAO->select($idprf);
		return $prf;
	}
	
	public function selectAll()
	{
		$prf = $this->perfilDAO->selectFull();
		return $prf;
	}
    
}
?>