<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'CalendarioDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalendarioController
 *
 * @author Kevyn
 */
class CalendarioController {
    //put your code here
    
    private $calendarioDAO;
    public function __construct()
	{
		$this->calendarioDAO = new CalendarioDAO(new DataAccess());
	}
	
	public function insert($cal)
	{
		return $this->calendarioDAO->insertCalendario($cal);
	}
	
	public function update($cal)
	{
		return $this->calendarioDAO->updateCalendario($cal);
	}
	
	public function delete($idcal)
	{
		return $this->calendarioDAO->deleteCalendario($idcal);
	}
	
	public function select($idcal)
	{
		$cal = $this->calendarioDAO->selectCalendario($idcal);
		return $cal;
	}
	
	public function selectAll()
	{
		$cal = $this->calendarioDAO->selectAno_letivoFull();
		return $cal;
	}
}
?>