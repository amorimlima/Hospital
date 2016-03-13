<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'GaleriaDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GaleriaController
 *
 * @author Diego
 */
class GaleriaController {
    //put your code here
    
    private $galeriaDAO;
    public function __construct()
	{
		$this->galeriaDAO = new GaleriaDAO(new DataAccess());
	}
	
	public function insert($glr)
	{
		return $this->galeriaDAO->insert($glr);
	}
	
	public function update($glr)
	{
		$result = $this->galeriaDAO->update($glr);
		print_r($result);
		return $result;
	}
	
	public function delete($idglr)
	{
		return $this->galeriaDAO->delete($idglr);
	}
	
	public function select($idglr)
	{
		$glr = $this->galeriaDAO->select($idglr);
		return $glr;
	}
	
	public function selectAll()
	{
		$glr = $this->galeriaDAO->selectFull();
		return $glr;
	}

	public function selectMaisRecentes()
	{
		$glr = $this->galeriaDAO->selectMaisRecentes();
		return $glr;
	}

	public function selectMaisVistos()
	{
		$glr = $this->galeriaDAO->selectMaisVistos();
		return $glr;
	}

	public function selectNome($nomeGaleria)
	{
		$glr = $this->galeriaDAO->selectNome($nomeGaleria);
		return $glr;
	}

	public function selectCategoria($categoria)
	{
		$glr = $this->galeriaDAO->selectCategoria($categoria);
		return $glr;
	}
}
?>