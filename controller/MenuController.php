<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'MenuDAO.php');
include_once($path['dao'].'AcessoDAO.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuController
 *
 * @author Kevyn
 */
class MenuController {
    private $menuDAO;
    public function __construct()
	{
		$this->menuDAO =  new MenuDAO(new DataAccess());
	}
	
	public function insert($mnu)
	{
		return $this->menuDAO->insert($mnu);
	}
	
	public function update($mnu)
	{
		return $this->menuDAO->update($mnu);
	}
	
	public function delete($idmnu)
	{
		return $this->menuDAO->delete($idmnu);
	}
	
	public function select($idmnu)
	{
		$mnu = $this->menuDAO->select($idmnu);
		return $mnu;
	}
        
        public function selectTipo($tipo){
                 $mnu = $this->menuDAO->selectTipo($tipo);
		return $mnu;
        }
        
        public function selectTipoPerfil($tipo,$perfil){
            $mnu = $this->menuDAO->selectTipoPerfil($tipo,$perfil);
	    return $mnu;
        }
	
	public function selectAll()
	{
		$mnu = $this->menuDAO->selectFull();
		return $mnu;
	}
}
?>