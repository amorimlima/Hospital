<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'IdentificacaoEmail.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IdentificacaoEmailDAO
 *
 * @author Kevyn
 */
class IdentificacaoEmailDAO {
    //put your code here
    public function __construct($da) {
        parent::__construct($da);
    }
    
    public function insert($ide)
     {
        $sql  = "insert into identificacao_email (idn_identificacao) values ";
        $sql .= "('".$ide->getidn_identificacao()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ide)
     {
         $sql  = "update identificacao_email set idn_identificacao = '".$ide->getidn_identificacao()."',";
         $sql .= "where idn_id = ".$ide->getidn_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idide)
     {
        $sql = "delete from identificacao_email where idn_id = ".$idide."";
    	return $this->execute($sql);   
     }
     
     public function select($idide)
     {
        $sql = "select * from identificacao_email where idn_id = ".$idide." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $ide = new IdentificacaoEmail();
                $ide->setidn_id($qr["idn_id"]);
                $ide->setidn_identificacao($qr["idn_identificacao"]);

	    	    	
    	return $ide;
     }
     
     public function selectFull()
     {
        $sql = "select * from identificacao_email";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $ide = new IdentificacaoEmail();
                $ide->setidn_id($qr["idn_id"]);
                $ide->setidn_identificacao($qr["idn_identificacao"]);
                array_push($lista, $ide);

        }  	    	
    	return $lista;
     }
}
?>