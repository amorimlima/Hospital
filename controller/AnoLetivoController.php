<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'AnoLetivoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnoLetivoController
 *
 * @author Kevyn
 */
class AnoLetivoController {
    //put your code here
    private $anoLetivoDAO;
    public function __construct()
	{
		$this->anoLetivoDAO = new AnoLetivoDAO(new DataAccess());
	}
	
        
	public function insert($ano)
	{
		return $this->anoLetivoDAO->insert($ano);
	}
	
	public function update($ano)
	{
		return $this->anoLetivoDAO->update($ano);
	}
	
	public function delete($idano)
	{
		return $this->anoLetivoDAO->delete($idano);
	}
	
	public function select($idano)
	{
		$ano = $this->anoLetivoDAO->select($idano);
		return $ano;
	}
	
	public function selectAll()
	{
		$ano = $this->anoLetivoDAO->selectFull();
		return $ano;
	}
}
?>