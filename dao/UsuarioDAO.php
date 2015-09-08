<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Usuario.php');
include_once($path['beans'].'Perfil.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author Kevyn
 */
class UsuarioDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($user)
     {
         $sql  = "insert into usuario (usr_nome,usr_data_nascimento,usr_endereco, usr_escola,usr_data_entrada_escola,usr_nse,usr_perfil,usr_login,usr_senha) values ";
         $sql .= "('".$user->getUsr_nome()."',";
         $sql .= "'".$user->getUsr_data_nascimento()."',";
         $sql .= "'".$user->getUsr_endereco()."',";
         $sql .= "'".$user->getUsr_escola()."',";
         $sql .= "'".$user->getUsr_data_entrada_escola()."','".$user->getUsr_nse()."',";
         $sql .= "'".$user->getUsr_perfil()."',";
         $sql .= "'".$user->getUsr_login()."',";
         $sql .= "'".$user->getUsr_senha()."')";
		//echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($user)
     {
        $sql  = "update usuario set usr_nome = '".$user->getUsr_nome()."',";
    	$sql .= "usr_data_nascimento = '".$user->getUsr_data_nascimento()."',";
    	$sql .= "usr_endereco = ".$user->getUsr_endereco().",";
        $sql .= "usr_escola = '".$user->getUsr_escola()."',";
        $sql .= "usr_data_entrada_escola = '".$user->getUsr_data_entrada_escola()."',";
        $sql .= "usr_nse = ".$user->getUsr_nse().",";
        $sql .= "usr_perfil = ".$user->getUsr_perfil().",";
        $sql .= "usr_login = ".$user->getUsr_login().",";
        $sql .= "usr_senha = ".$user->getUsr_senha();
        $sql .= " where usr_id = ".$user->getUsr_id()." limit 1";
        
        return $this->execute($sql);
     }
     
     public function delete($iduser)
     {
         $sql = "delete from usuario where usr_id = ".$iduser."";
    	return $this->execute($sql); 
     }
     
     public function select($iduser)
     {
        $sql = "select * from usuario where usr_id = ".$iduser." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);
        
                $user = new Usuario();
                $user->setUsr_id($qr["usr_id"]);
                $user->setUsr_nome($qr["usr_nome"]);
                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $user->setUsr_endereco($qr["usr_endereco"]);
                $user->setUsr_escola($qr["usr_escola"]);
                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $user->setUsr_nse($qr["usr_nse"]);
                $user->setUsr_perfil($qr["usr_perfil"]);
                //$user->setUsr_login($qr["usr_login"]);
            	//$user->setUsr_senha($qr["usr_senha"]);
                
              	
    	return $user;
     }
     
     public function selectbyPerfil($idescola){
        $sql = "select * from usuario where usr_perfil <> 6 and usr_escola = ".$idescola."";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $user = new Usuario();
                $user->setUsr_id($qr["usr_id"]);
                $user->setUsr_nome($qr["usr_nome"]);
                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $user->setUsr_endereco($qr["usr_endereco"]);
                $user->setUsr_escola($qr["usr_escola"]);
                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $user->setUsr_nse($qr["usr_nse"]);
                $user->setUsr_perfil($qr["usr_perfil"]);
                $user->setUsr_login($qr["usr_login"]);
            	$user->setUsr_senha($qr["usr_senha"]);
                array_push($lista, $user);
                
        }	
    	return $lista;
     }

      public function selectFull()
     {
        $sql = "select * from usuario";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

        
                $user = new Usuario();
                $user->setUsr_id($qr["usr_id"]);
                $user->setUsr_nome($qr["usr_nome"]);
                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $user->setUsr_endereco($qr["usr_endereco"]);
                $user->setUsr_escola($qr["usr_escola"]);
                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $user->setUsr_nse($qr["usr_nse"]);
                $user->setUsr_perfil($qr["usr_perfil"]);
                $user->setUsr_login($qr["usr_login"]);
            	$user->setUsr_senha($qr["usr_senha"]);
                array_push($lista, $user);
                
        }	
    	return $lista;
     }
     
	public function autenticaUsuario($usuario,$senha){
		$sql = "select * from usuario inner join perfil ON usr_perfil = prf_id
				where usr_login = '".$usuario."' and usr_senha = '".$senha."' limit 1";
		$user = array();
		$result = $this->retrieve($sql);
		if(mysqli_num_rows($result)>0){
    		$qr = mysqli_fetch_array($result);
		
    		$user = array(
				'usr_id' 	=> $qr["usr_id"],
    			'usr_nome' 	=> $qr["usr_nome"],
    			'prf_perfil'=> $qr["prf_perfil"],
    			'prf_url'	=> $qr["url"],
    			'prf_pagina'=> $qr["pagina"]
			);
		}
		
		//print_r($u);
		return $user;
	}
	

}
?>