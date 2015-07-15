<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'CategoriaFuncionalDAO.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaFuncionalController
 *
 * @author Kevyn
 */
class CategoriaFuncionalController {
    //put your code here
    
    private $categoriaFuncionalDAO;
	
	public function __construct()
	{
		$this->categoriaFuncionalDAO = new CategoriaFuncionalDAO(new DataAccess);
	}
	
	public function insert($cat)
	{
		return $this->categoriaFuncionalDAO->insert($cat);
	}
	
	public function update($cat)
	{
		return $this->categoriaFuncionalDAO->update($cat);
	}
	
	public function delete($idcat)
	{
		return $this->categoriaFuncionalDAO->delete($idcat);
	}
	
	public function select($idcat)
	{
		$cat = $this->categoriaFuncionalDAO->select($idcat);
		return $cat;
	}
	
        public function selectAll()
	{
		$cat = $this->categoriaFuncionalDAO->selectFull();
		return $cat;
	}
	
}
?>