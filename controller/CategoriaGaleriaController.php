<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'CategoriaGaleriaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaGaleriaController
 *
 * @author Diego
 */
class CategoriaGaleriaController {
    //put your code here
    
    private $categoriaGleriaDAO;
    public function __construct()
	{
		$this->categoriaGaleriaDAO = new CategoriaGaleriaDAO(new DataAccess());
	}
		
	public function select($idglr)
	{
		$glr = $this->categoriaGaleriaDAO->select($idglr);
		return $glr;
	}
	
	public function selectAll()
	{
		$glr = $this->categoriaGaleriaDAO->selectFull();
		return $glr;
	}

	public function listCateoria($categoria)
	{
		$glr = $this->categoriaGaleriaDAO->selectCategoria($categoria);
		return $glr;
	}
}
?>