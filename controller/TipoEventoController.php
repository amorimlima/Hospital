<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'TipoEventoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoEventoController
 *
 * @author Kevyn
 */
class TipoEventoController {
    //put your code here
    private $tipoEventoDAO;
    public function __construct()
	{
		$this->tipoEventoDAO = new TipoEventoDAO(new DataAccess());
	}
	
	public function insert($tiev)
	{
		return $this->tipoEventoDAO->insert($tiev);
	}
	
	public function update($tiev)
	{
		return $this->tipoEventoDAO->update($tiev);
	}
	
	public function delete($idtiev)
	{
		return $this->tipoEventoDAO->delete($idtiev);
	}
	
	public function select($idtiev)
	{
		$tiev = $this->tipoEventoDAO->select($idtiev);
		return $tiev;
	}
	
	public function selectAll()
	{
		$tiev = $this->tipoEventoDAO->selectFull();
		return $tiev;
	}
    
}
?>