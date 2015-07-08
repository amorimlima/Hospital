<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'AcessoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcessoController
 *
 * @author Kevyn
 */
class AcessoController {
     private $acessoDAO;
    public function __construct()
	{
		$this->acessoDAO =  new AcessoDAO(new DataAccess());
	}
	
	public function insert($ace)
	{
		return $this->acessoDAO->insert($ace);
	}
	
	public function update($ace)
	{
		return $this->acessoDAO->update($ace);
	}
	
	public function delete($prf_id,$id_menu)
	{
		return $this->acessoDAO->delete($prf_id, $id_menu);
	}
	
	public function select($prf_id,$id_menu)
	{
		$end = $this->acessoDAO->select($prf_id, $id_menu);
		return $end;
	}
        
        public function  selectPerfil($idace){
                $end = $this->acessoDAO->selectPerfil($idace);
		return $end;
        }

        public function  selectMenu($idace){
                $end = $this->acessoDAO->selectMenu($idace);
		return $end;
        }
        
        public function selectAll()
	{
		$end = $this->acessoDAO->selectFull();
		return $end;
	}
}
?>