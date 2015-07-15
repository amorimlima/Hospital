<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Tema.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemaDAO
 *
 * @author Kevyn
 */
class TemaDAO {
    //put your code here
    
     public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($tem)
     {
         $sql  = "insert into tema (tm_tema,tm_capitulo) values ";
         $sql .= "('".$tem->getTm_tema()."','";
         $sql .= "'".$tem->getTm_capitulo()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($tem)
     {
        $sql  = "update tema set tm_tema = '".$tem->getTm_tema()."',";
    	$sql .= "tm_capitulo = '".$tem->getTm_capitulo()."',";
        $sql .= "where  tm_id = ".$tem->getTm_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($tem)
     {
         $sql = "delete from tema where tm_id = ".$tem->getTm_id()."";
    	return $this->execute($sql); 
     }
     
     public function select($idtem)
     {
        $sql = "select * from tema where tm_id = ".$idtem." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $tem = new Tema();
                $tem->setTm_id($qr["tm_id"]);
                $tem->setTm_tema($qr["tm_tema"]);
                $tem->setTm_capitulo($qr["tm_capitulo"]);
                	    	
    	return $tem;
     }
     
     
     public function selectFull()
     {
        $sql = "select * from tema";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $tem = new Tema();
                $tem->setTm_id($qr["tm_id"]);
                $tem->setTm_tema($qr["tm_tema"]);
                $tem->setTm_capitulo($qr["tm_capitulo"]);
                array_push($lista, $tem);
        }    	    	
    	return $lista;
     }
     
}
?>