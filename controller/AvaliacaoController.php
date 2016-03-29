<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'AvaliacaoDAO.php');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcessoController
 *
 * @author Ana Carolina
 */
class AvaliacaoController {
     
    private $avaliacaoDAO;
    public function __construct()
	{
		$this->avaliacaoDAO =  new AvaliacaoDAO(new DataAccess());
	}
	
	public function insertAvaliacao($avaliacao)
	{
		return $this->avaliacaoDAO->insertAvaliacao($avaliacao);
	}
	
	public function updateAvaliacao($idavaliacao)
	{
		return $this->avaliacaoDAO->updateAvaliacao($idavaliacao);
	}
	        
    public function selectAvaliacaoByGeral()
	{
		$avaliacao = $this->avaliacaoDAO->selectAvaliacaoByGeral();
		return $avaliacao;
	}
}
?>