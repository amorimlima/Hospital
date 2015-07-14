<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'TipoEscola.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoEscolaDAO
 *
 * @author Kevyn
 */
class TipoEscolaDAO {
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($tie)
     {
         $sql  = "insert into tipo_escola (tps_tipo_escola) values ";
         $sql .= "('".$tie->getTps_tipo_escola()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
      public function update($tie)
     {
         $sql  = "update tipo_escola set tps_tipo_escola = '".$tie->getTps_tipo_escola()."',";
         $sql .= "where tps_id = ".$tie->getTps_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idtie)
     {
        $sql = "delete from tipo_escola where tps_id = ".$idtie."";
    	return $this->execute($sql);   
     }
     
     public function select($idtie)
     {
        $sql = "select * from tipo_escola where tps_id = ".$idtie." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $tie = new TipoEscola();
                $tie->setTps_id($qr["tps_id"]);
                $tie->setTps_tipo_escola($qr["tps_tipo_escola"]);
	    	    	
    	return $tie;
     }
     
     public function selectFull()
     {
        $sql = "select * from tipo_escola";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $tie = new TipoEscola();
                $tie->setTps_id($qr["tps_id"]);
                $tie->setTps_tipo_escola($qr["tps_tipo_escola"]);
                array_push($lista, $tie); 
        }   	
    	return $lista;
     }
}
?>
