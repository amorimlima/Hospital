<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'TipoExercicioDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoExercicioController
 *
 * @author Kevyn
 */
class TipoExercicioController {
    //put your code here
     private $tipoExercicioDAO;
    public function __construct()
	{
		$this->tipoExercicioDAO = new TipoExercicioDAO(new DataAccess()); 
	}
	
	public function insert($tiex)
	{
		return $this->tipoExercicioDAO->insert($tiex);
	}
	
	public function update($tiex)
	{
		return $this->tipoExercicioDAO->update($tiex);
	}
	
	public function delete($idtiex)
	{
		return $this->tipoExercicioDAO->delete($idtiex);
	}
	
	public function select($idtiex)
	{
		$tiex = $this->tipoExercicioDAO->select($idtiex);
		return $tiex;
	}
        
        public function selectAll()
	{
		$tiex = $this->tipoExercicioDAO->selectFull();
		return $tiex;
	}
}
?>
