<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Perfil.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilDAO
 *
 * @author Kevyn
 */
class PerfilDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
    
    public function insert($prf)
     {
         $sql  = "insert into perfil (prf_perfil,url,pagina) values ";
         $sql .= "('".$prf->getPrf_perfil()."',";
         $sql .= "'".$prf->getPrf_url()."','".$prf->getPrf_pagina()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($prf)
     {
         $sql  = "update perfil set prf_perfil = '".$prf->getPrf_perfil()."',";
         $sql .= "url = '".$prf->getPrf_url()."',";
    	 $sql .= "pagina = '".$prf->getPrf_pagina()."',";
         $sql .= "where prf_id = ".$prf->getPrf_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idprf)
     {
        $sql = "delete from perfil where prf_id = ".$idprf."";
    	return $this->execute($sql);   
     }
     
     public function select($idprf)
     {
        $sql = "select * from perfil where prf_id = ".$idprf." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $prf = new Perfil();
                $prf->setPrf_id($qr["prf_id"]);
                $prf->setPrf_perfil($qr["prf_perfil"]);
                $prf->setPrf_url($qr["url"]);
                $prf->setPrf_pagina($qr["pagina"]);
                 	
    	return $prf;
     }
     
     public function selectFull()
     {
        $sql = "select * from perfil";
    	$result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $prf = new Perfil();
                $prf->setPrf_id($qr["prf_id"]);
                $prf->setPrf_perfil($qr["prf_perfil"]);
                $prf->setPrf_url($qr["url"]);
                $prf->setPrf_pagina($qr["pagina"]);
                array_push($lista, $prf);   
        }
    	return $lista;
     }
     
     
}
?>