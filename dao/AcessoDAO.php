<?php
//session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Acesso.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcessoDAO
 *
 * @author Kevyn
 */
class AcessoDAO extends DAO{
    
    public function __construct($da) {
        parent::__construct($da);
    }
    
    public function insert($ace)
     {
         $sql  = "insert into acesso (prf_id,id_menu) values ";
        $sql .= "('".$ace->getPrf_id()."','".$ace->getId_menu()."')";
		echo $ace;
    	return $this->execute($sql);
     }
     
     public function update($ace)
     {
         $sql  = "update acesso set prf_id = '".$ace->getPrf_id()."',";
         $sql .= "id_menu = '".$ace->getId_menu();
         $sql .= "where prf_id = ".$ace->getPrf_id()." and id_menu=".$ace->getId_menu()." limit 1";
         return $this->execute($sql);
     } 
     
      public function delete($prf_id,$id_menu)
     {
        $sql = "delete from acesso where prf_id = ".$prf_id." and id_menu =".$id_menu."";
    	return $this->execute($sql);   
     }
     
      public function selectPerfil($idace)
     {
        $sql = "select * from acesso where prf_id = ".$idace." ";
    	$result = $this->retrieve($sql);
        $lista = array();
    	while ($qr = mysql_fetch_array($result))
    	{

                $ace = new Acesso();
                $ace->setId_menu($qr["id_menu"]);
                $ace->setPrf_id($qr["prf_id"]);
                array_push($lista, $ace);   
        }  	
    	return $lista;
     }
     
     
     public function selectMenu($idace)
     {
         $sql = "select * from acesso where id_menu = ".$idace." ";
    	$result = $this->retrieve($sql);
        $lista = array();
    	while ($qr = mysql_fetch_array($result))
    	{

                $ace = new Acesso();
                $ace->setId_menu($qr["id_menu"]);
                $ace->setPrf_id($qr["prf_id"]);
                array_push($lista, $ace);   
        }  	
    	return $lista;
     }
     
     public function select($prf_id,$id_menu){
        $sql = "select * from acesso where prf_id = ".$prf_id." and id_menu = ".$id_menu."";
    	$result = $this->retrieve($sql);
        $qr = mysql_fetch_array($result);
    	
                $ace = new Acesso();
                $ace->setId_menu($qr["id_menu"]);
                $ace->setPrf_id($qr["prf_id"]);   
       
    	return $ace;
     }
     
     
     public function selectFull()
     {
        $sql = "select * from acesso";
    	$result = $this->retrieve($sql);
        $lista = array();
    	while ($qr = mysql_fetch_array($result))
    	{

                $ace = new Acesso();
                $ace->setId_menu($qr["id_menu"]);
                $ace->setPrf_id($qr["prf_id"]);
                array_push($lista, $ace);   
        }  	
    	return $lista;
     }

}
?>