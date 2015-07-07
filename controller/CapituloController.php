<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'CapituloDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CapituloController
 *
 * @author Kevyn
 */
class CapituloController {
    //put your code here
    private $capituloDAO;
    public function __construct()
	{
		$this->capituloDAO = new CapituloDAO(new DataAccess());
	}
	
	public function insert($cap)
	{
		return $this->capituloDAO->insert($cap);
	}
	
	public function update($cap)
	{
		return $this->capituloDAO->update($cap);
	}
	
	public function delete($idcap)
	{
		return $this->capituloDAO->delete($idcap);
	}
	
	public function select($idcap)
	{
		$cap = $this->capituloDAO->select($idcap);
		return $cap;
	}
	
	public function selectAll()
	{
		$cap = $this->capituloDAO->selectFull();
		return $cap;
	}
}
?>