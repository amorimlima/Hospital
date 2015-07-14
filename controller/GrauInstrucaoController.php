<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'GrauInstrucaoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrauInstrucaoController
 *
 * @author Kevyn
 */
class GrauInstrucaoController {
    //put your code here
    private $grauInstrucaoDAO;
    public function __construct()
	{
		$this->grauInstrucaoDAO = new GrauInstrucaoDAO(new DataAccess());
	}
	
        
	public function insert($gra)
	{
		return $this->grauInstrucaoDAO->insert($gra);
	}
	
	public function update($gra)
	{
		return $this->grauInstrucaoDAO->update($gra);
	}
	
	public function delete($gra_id)
	{
		return $this->grauInstrucaoDAO->delete($gra_id);
	}
	
	public function select($gra_id)
	{
		$gra = $this->grauInstrucaoDAO->select($gra_id);
		return $gra;
	}
	
	public function selectAll()
	{
		$gra = $this->grauInstrucaoDAO->selectFull();
		return $gra;
	}
    
}
?>