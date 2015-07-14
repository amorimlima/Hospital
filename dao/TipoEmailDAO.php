<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'TipoEmail.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoEmailDAO
 *
 * @author Kevyn
 */
class TipoEmailDAO {
    //put your code here
     public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($tie)
     {
         $sql  = "insert into tipo_email (tml_tipo) values ";
         $sql .= "('".$tie->getTml_tipo()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($tie)
     {
         $sql  = "update tipo_email set tml_tipo = '".$tie->getTml_tipo()."',";
         $sql .= "where tml_id = ".$tie->getTml_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idtie)
     {
        $sql = "delete from tipo_email where tml_id = ".$idtie."";
    	return $this->execute($sql);   
     }
     
     public function select($idtie)
     {
        $sql = "select * from tipo_email where tml_id = ".$idtie." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);
        
                $tie = new TipoEmail();
                $tie->setTml_id($qr["tml_id"]);
                $tie->setTml_tipo($qr["tml_tipo"]);
                      
    	return $tie;
     }
     
     public function selectFull()
     {
        $sql = "select * from tipo_email";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $tie = new TipoEmail();
                $tie->setTml_id($qr["tml_id"]);
                $tie->setTml_tipo($qr["tml_tipo"]);
                array_push($lista, $tie);  
        }             
    	return $lista;
     }
}
?>