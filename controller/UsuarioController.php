<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'UsuarioDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioController
 *
 * @author Kevyn
 */
class UsuarioController {
    //put your code here
    
    private $usuarioDAO;
    public function __construct()
	{
		$this->usuarioDAO = new UsuarioDAO(new DataAccess());
	}
	
	public function insert($user)
	{
		return $this->usuarioDAO->insert($user);
	}
	
	public function update($user)
	{
		return $this->usuarioDAO->update($user);
	}
	
	public function delete($iduser)
	{
		return $this->usuarioDAO->delete($iduser);
	}
	
	public function select($iduser)
	{
		$user = $this->usuarioDAO->select($iduser);
		return $user;
	}
	
	public function selectAll()
	{
		$user = $this->usuarioDAO->selectFull();
		return $user;
	}
}
?>