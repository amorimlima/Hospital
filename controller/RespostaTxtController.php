<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'RespostaTxtDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespostaTxtController
 *
 * @author Kevyn
 */
class RespostaTxtController {
    //put your code here
    
    private $respostaTxtDAO;
    public function __construct()
	{
		$this->respostaTxtDAO = new RespostaTxtDAO(new DataAccess());
	}
	
	public function insert($ret)
	{
		return $this->respostaTxtDAO->insert($ret);
	}
	
	public function update($ret)
	{
		return $this->respostaTxtDAO->update($ret);
	}
	
	public function delete($idret)
	{
		return $this->respostaTxtDAO->delete($idret);
	}
	
	public function select($idret)
	{
		$ret = $this->respostaTxtDAO->select($idret);
		return $ret;
	}
	
	public function selectAll()
	{
		$ret = $this->respostaTxtDAO->selectFull();
		return $ret;
	}

	public function selectExeByAluno($idExercicio,$idUsuario,$questao)
	{
		return $this->respostaTxtDAO->selectExeByAluno($idExercicio,$idUsuario,$questao);
	}
}
?>