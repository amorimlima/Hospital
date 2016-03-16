<?php
if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'UsuarioVariavelDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioVariavelController
 *
 * @author Kevyn
 */
class UsuarioVariavelController {
    //put your code here
    
    private $usuarioVariavelDAO;
    public function __construct()
	{
		$this->usuarioVariavelDAO = new UsuarioVariavelDAO(new DataAccess());
	}
	
	public function insert($userv)
	{
		return $this->usuarioVariavelDAO->insert($userv);
	}
	
	public function update($userv)
	{
		return $this->usuarioVariavelDAO->update($userv);
	}
	
	public function delete($iduserv)
	{
		return $this->usuarioVariavelDAO->delete($iduserv);
	}
	
	public function select($iduserv)
	{
		$userv = $this->usuarioVariavelDAO->select($iduserv);
		return $userv;
	}

	public function selectByIdUsuario($iduser)
	{
		$userv = $this->usuarioVariavelDAO->selectByIdUsuario($iduser);
		return $userv;
	}
	
	public function selectAll()
	{
		$userv = $this->usuarioVariavelDAO->selectFull();
		return $userv;
	}

	
}
?>