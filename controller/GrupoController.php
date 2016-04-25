<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'GrupoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoController
 *
 * @author Kevyn
 */
class GrupoController {
    //put your code here
    
     private $grupoDAO;
    public function __construct()
	{
		$this->grupoDAO = new GrupoDAO(new DataAccess());
	}
	
	public function insert($gru)
	{
		return $this->grupoDAO->insert($gru);
	}
	
	public function update($gru)
	{
		return $this->grupoDAO->update($gru);
	}
	
	public function delete($idgru)
	{
		return $this->grupoDAO->delete($idgru);
	}
	
	public function select($idgru)
	{
		$gru = $this->grupoDAO->select($idgru);
		return $gru;
	}
	
	public function selectAll()
	{
		$gru = $this->grupoDAO->selectFull();
		return $gru;
	}
	
	public function selectByProfessor($idProfessor)
	{
		$gru = $this->grupoDAO->selectByProfessor($idProfessor);
		return $gru;
	}

	public function listarProfessorSeriePeriodo($idProfessor, $serie, $periodo)
	{
		$gru = $this->grupoDAO->listarProfessorSeriePeriodo($idProfessor, $serie, $periodo);
		return $gru;
	}

}
?>