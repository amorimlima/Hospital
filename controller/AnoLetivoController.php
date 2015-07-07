<?php
session_start();
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
		return $this->anoLetivoDAO->insertAno_letivo($ano);
	}
	
	public function update($ano)
	{
		return $this->anoLetivoDAO->updateAno_letivo($ano);
	}
	
	public function delete($idano)
	{
		return $this->anoLetivoDAO->deleteAno_letivo($idano);
	}
	
	public function select($idano)
	{
		$ano = $this->anoLetivoDAO->selectAno_letivo($idano);
		return $ano;
	}
	
	public function selectAll()
	{
		$ano = $this->anoLetivoDAO->selectAno_letivoFull();
		return $ano;
	}
}
?>