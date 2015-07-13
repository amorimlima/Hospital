<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'TipoEscolaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoEscolaController
 *
 * @author Kevyn
 */
class TipoEscolaController {
    //put your code here
    
    private $tipoEscolaDAO;
    public function __construct()
	{
		$this->tipoEscolaDAO = new TipoEscolaDAO(new DataAccess());
	}
	
	public function insert($tie)
	{
		return $this->tipoEscolaDAO->insert($tie);
	}
	
	public function update($tie)
	{
		return $this->tipoEscolaDAO->update($tie);
	}
	
	public function delete($idtie)
	{
		return $this->tipoEscolaDAO->delete($idtie);
	}
	
	public function select($idtie)
	{
		$tie = $this->tipoEscolaDAO->select($idtie);
		return $tie;
	}
	
	public function selectAll()
	{
		$adm = $this->tipoEscolaDAO->selectFull();
		return $adm;
	}
}
?>