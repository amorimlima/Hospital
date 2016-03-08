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
	
	public function insertComID($user){
		return $this->usuarioDAO->insertComID($user);
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
        
    public function  selectbyPerfil($idescola){
        $user = $this->usuarioDAO->selectbyPerfil($idescola);
        return $user;
    }

    public function selectAll()
	{
		$user = $this->usuarioDAO->selectFull();
		return $user;
	}
	
	public function autenticaUsuario($usuario,$senha)
	{
		$user = $this->usuarioDAO->autenticaUsuario($usuario,$senha);
		return $user;
	}
	public function selectByPerfilUsuario($idPerfil){
		$user = $this->usuarioDAO->selectByPerfilUsuario($idPerfil);
		return $user;
	}
	
	public function ultimoIDUsuario(){
		return $this->usuarioDAO->ultimoIDUsuario();
	}
	
	public function buscaUsuarioByLetraNome($letraDigitada,$perfil_id,$escola)
	{
		$user = $this->usuarioDAO->buscaUsuarioByLetraNome($letraDigitada,$perfil_id,$escola);
		return $user;
	}	
	
}
?>
