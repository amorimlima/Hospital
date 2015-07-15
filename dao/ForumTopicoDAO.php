<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'ForumTopico.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumTopicoDAO
 *
 * @author Kevyn
 */
class ForumTopicoDAO {
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($frt)
     {
         $sql  = "insert into forum_topico (frt_topico) values ";
         $sql .= "('".$frt->getFrt_topico()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($frt)
     {
         $sql  = "update forum_topico set frt_topico = '".$frt->getFrt_topico()."',";
         $sql .= "where frt_id = ".$frt->getFrt_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idfrt)
     {
        $sql = "delete from forum_topico where frt_id = ".$idfrt."";
    	return $this->execute($sql);   
     }
     
     public function select($idfrt)
     {
        $sql = "select * from forum_topico where frt_id = ".$idfrt." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $frt = new ForumTopico();
                $frt->setFrt_id($qr["frt_id"]);
                $frt->setFrt_topico($qr["frt_topico"]);
	    	    	
    	return $frt;
     }
     
     public function selectFull()
     {
        $sql = "select * from forum_topico where frt_id = ".$idfrt." ";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $frt = new ForumTopico();
                $frt->setFrt_id($qr["frt_id"]);
                $frt->setFrt_topico($qr["frt_topico"]);
                array_push($lista, $frt);
        }	    	
    	return $lista;
     }
}
?>