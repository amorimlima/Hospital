<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'AnoLetivo.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnoLetivoDAO
 *
 * @author Kevyn
 */
class AnoLetivoDAO extends DAO {
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
    }
    
       public function insert($ano)
     {
         $sql  = "insert into ano_letivo (ano_ano) values ";
         $sql .= "('".$ano->getAno()."','";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ano)
     {
         $sql  = "update ano_letivo set ano_ano = '".$ano->getAno()."',";
         $sql .= "where ano_id = ".$ano->getNlt_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idano)
     {
        $sql = "delete from ano_letivo where ano_id = ".$idano."";
    	return $this->execute($sql);   
     }
     
     public function select($idano)
     {
        $sql = "select * from ano_letivo where ano_id = ".$idano." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);
        
                $ano = new AnoLetivo();
	    	$ano->setNlt_id($qr["ano_id"]);
	    	$ano->setAno($qr["ano_ano"]);
	    	    	
    	return $ano;
     }
     
     public function selectFull()
     {
        $sql = "select * from ano_letivo";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
        
                $ano = new AnoLetivo();
	    	$ano->setNlt_id($qr["ano_id"]);
	    	$ano->setAno($qr["ano_ano"]);
	    	array_push($lista, $ano);      	
        }
    	return $lista;
     }
     
     
    
}
?>