<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'LiberarCapituloDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemaController
 *
 * @author Carol
 */
class LiberarCapituloController {
    //put your code here
    
    private $liberarCapituloDAO;
    public function __construct()
	{
		$this->liberarCapituloDAO = new LiberarCapituloDAO(new DataAccess());
	}
	
	public function insertLiberarCapitulo($liberarcapitulo)
	{
		return $this->liberarCapituloDAO->insertLiberarCapitulo($liberarcapitulo);
	}
	
	public function updateLiberarCapitulo($idliberarcapitulo)
	{
		return $this->liberarCapituloDAO->updateLiberarCapitulo($idliberarcapitulo);
	}
	
	public function selectByIdLiberarCapitulo($idliberarcapitulo)
	{
		$tem = $this->liberarCapituloDAO->selectByIdLiberarCapitulo($idliberarcapitulo);
		return $tem;
	}
	public function deleteByIdLiberarCapitulo($idliberarcapitulo)
	{
		$tem = $this->liberarCapituloDAO->deleteByIdLiberarCapitulo($idliberarcapitulo);
		return $tem;
	}
        
    public function selectAll()
	{
		$tem = $this->liberarCapituloDAO->selectAll();
		return $tem;
	}

	public function listaCapLebaradosPraEscola($idEscola)
	{
		$valor = $this->liberarCapituloDAO->selectByIdEscola($idEscola);
		return $valor;
	}

	public function selectCapLiberadoByIdEscola($idescola)
	{
		$lib = $this->liberarCapituloDAO->selectCapByEscola($idescola);
		return $lib;
	}
}
?>