<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'TipoEvento.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoEventoDAO
 *
 * @author Kevyn
 */
class TipoEventoDAO {
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($tiev)
     {
         $sql  = "insert into tipo_evento (tpv_evento) values ";
         $sql .= "('".$tiev->getTpv_evento()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($tiev)
     {
         $sql  = "update tipo_evento set tpv_evento = '".$tiev->getTpv_evento()."',";
         $sql .= "where  tpv_id = ".$tiev->getTpv_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idtiev)
     {
        $sql = "delete from tipo_evento where tpv_id = ".$idtiev."";
    	return $this->execute($sql);   
     }
     
     public function select($idtiev)
     {
        $sql = "select * from tipo_evento where tpv_id = ".$idtiev." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $tiev = new TipoEvento();
                $tiev->setTpv_id($qr["tpv_id"]);
                $tiev->setTpv_evento($qr["tpv_evento"]);
	    	    	
    	return $tiev;
     }
     
     public function selectFull()
     {
        $sql = "select * from tipo_evento";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $tiev = new TipoEvento();
                $tiev->setTpv_id($qr["tpv_id"]);
                $tiev->setTpv_evento($qr["tpv_evento"]);
                 array_push($lista, $tiev);
        }  	    	
    	return $lista;
     }
}
?>