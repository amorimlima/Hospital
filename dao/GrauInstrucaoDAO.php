<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'GrauInstrucao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrauInstrucaoDAO
 *
 * @author Kevyn
 */
class GrauInstrucaoDAO extends DAO{
    //put your code here
     public function __construct($da) {
        parent::__construct($da);
    }
    
    public function insert($gra)
     {
        $sql  = "insert into grau_instrucao (grt_instrucao) values ";
        $sql .= "('".$gra->getGrt_instrucao()."')";
		echo $gra;
    	return $this->execute($sql);
     }
     
     public function update($gra)
     {
         $sql  = "update grau_instrucao set grt_instrucao = '".$gra->getGrt_instrucao()."',";
         $sql .= "where grt_id = ".$gra->getGrt_id()." limit 1";
         return $this->execute($sql);
     } 
     
      public function delete($gra_id)
     {
        $sql = "delete from grau_instrucao where grt_id = ".$gra_id."";
    	return $this->execute($sql);   
     }
     
     public function select($gra_id)
     {
        $sql = "select * from grau_instrucao where grt_id = ".$gra_id." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);
        
                $gra = new GrauInstrucao();
                $gra->setGrt_id($qr["grt_id"]);
                $gra->setGrt_instrucao($qr["grau_instrucao"]);
                 	
    	return $gra;
     }
     
     public function selectFull()
     {
        $sql = "select * from grau_instrucao";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $gra = new GrauInstrucao();
                $gra->setGrt_id($qr["grt_id"]);
                $gra->setGrt_instrucao($qr["grau_instrucao"]);
                array_push($lista, $gra);
        }       	
    	return $lista;
     }
}
?>