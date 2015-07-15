<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'UsuarioGrupoMensagemDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioGrupoMensagemController
 *
 * @author Kevyn
 */
class UsuarioGrupoMensagemController {
    //put your code here
     private $usuarioGrupoMensagemDAO;
    public function __construct()
	{
		$this->usuarioGrupoMensagemDAO = new UsuarioGrupoMensagemDAO(new DataAccess());
	}
	
	public function insert($ugm)
	{
		return $this->usuarioGrupoMensagemDAO->insert($ugm);
	}
	
	public function update($ugm)
	{
		return $this->usuarioGrupoMensagemDAO->update($ugm);
	}
	
	public function delete($idugm)
	{
		return $this->usuarioGrupoMensagemDAO->delete($idugm);
	}
	
	public function select($idugm)
	{
		$ugm = $this->usuarioGrupoMensagemDAO->select($idugm);
		return $ugm;
	}
	
	public function selectAll()
	{
		$ugm = $this->usuarioGrupoMensagemDAO->selectFull();
		return $ugm;
	}
}
?>