<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ExercicioDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExercicioController
 *
 * @author Kevyn
 */
class ExercicioController {
    //put your code here
    
    private $exercicioDAO;
    public function __construct()
	{
		$this->exercicioDAO =  new ExercicioDAO(new DataAccess());
	}
	
	public function insert($exe)
	{
		return $this->exercicioDAO->insert($exe);
	}
	
	public function update($exe)
	{
		return $this->exercicioDAO->update($exe);
	}
	
	public function delete($idexe)
	{
		return $this->exercicioDAO->delete($idexe);
	}
	
	public function select($idexe)
	{
		$exe = $this->exercicioDAO->select($idexe);
		return $exe;
	}
	
	public function selectAll()
	{
		$exe = $this->exercicioDAO->selectFull();
		return $exe;
	}
}
?>
