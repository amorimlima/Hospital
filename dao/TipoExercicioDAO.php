<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'TipoExercicio.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoExercicioDAO
 *
 * @author Kevyn
 */
class TipoExercicioDAO extends DAO{
    //put your code here
    public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($tiex)
     {
         $sql  = "insert into tipo_exercicio (txr_tipo) values ";
         $sql .= "('".$tiex->getTxr_tipo()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
      public function update($tiex)
     {
         $sql  = "update tipo_exercicio set txr_tipo = '".$tiex->getTxr_tipo()."',";
         $sql .= "where txr_id = ".$tiex->getTxr_tipo()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idtiex)
     {
        $sql = "delete from tipo_exercicio where txr_id = ".$idtiex."";
    	return $this->execute($sql);   
     }
    
     public function select($idtiex)
     {
        $sql = "select * from tipo_exercicio where txr_id = ".$idtiex." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $tiex = new TipoExercicio();
                $tiex->setTxr_id($qr["txr_id"]);
                $tiex->setTxr_tipo($qr["tipo_exercicio"]);
                
	    	    	
    	return $tiex;
     }
     
     public function selectFull()
     {
        $sql = "select * from tipo_exercicio";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $tiex = new TipoExercicio();
                $tiex->setTxr_id($qr["txr_id"]);
                $tiex->setTxr_tipo($qr["tipo_exercicio"]);
                array_push($lista, $tiex);  
                
        }    	
    	return $lista;
     }
}
?>