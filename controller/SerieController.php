<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'SerieDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerieController
 *
 * @author Kevyn
 */
class SerieController {
    //put your code here
    
    private $serieDAO;
    public function __construct()
	{
		$this->serieDAO = new SerieDAO(new DataAccess()); 
	}
	
	public function insert($ser)
	{
		return $this->serieDAO->insert($ser);
	}
	
	public function update($ser)
	{
		return $this->serieDAO->update($ser);
	}
	
	public function delete($idser)
	{
		return $this->serieDAO->delete($idser);
	}
	
	public function select($idser)
	{
		$ser = $this->serieDAO->select($idser);
		return $ser;
	}
	
	public function selectAll()
	{
		$ser = $this->serieDAO->selectFull();
		return $ser;
	}

	public function listarDisponiveisProfessorSemGrupo($idProfessor)
	{
		$ser = $this->serieDAO->listarDisponiveisProfessorSemGrupo($idProfessor);
		return $ser;
	}

	public function listarDisponiveisProfessor($idProfessor)
	{
		$ser = $this->serieDAO->listarDisponiveisProfessor($idProfessor);
		return $ser;
	}
}
