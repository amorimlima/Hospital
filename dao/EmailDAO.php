<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Email.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailDAO
 *
 * @author Kevyn
 */
class EmailDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($eml)
     {
         $sql  = "insert into email (email_usuario,email_tipo_email,email_identificacao_email) values ";
         $sql .= "('".$eml->getMl_usuario()."','";
         $sql .= "'".$eml->getMl_tipo_email()."','".$eml->getMl_identificacao_email()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($eml)
     {
        $sql  = "update email set email_usuario = '".$eml->getMl_usuario()."',";
    	$sql .= "email_tipo_email = '".$eml->getMl_tipo_email()."',";
    	$sql .= "email_identificacao_email = '".$eml->getMl_identificacao_email()."'";
        $sql .= "where  email_id = ".$eml->getMl_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($ideml)
     {
         $sql = "delete from email where email_id = ".$ideml."";
    	return $this->execute($sql); 
     }
     
     public function select($ideml)
     {
        $sql = "select * from email where email_id = ".$ideml." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $eml = new Email();
                $eml->setMl_id($qr["email_id"]);
                $eml->setMl_usuario($qr["email_usuario"]);
                $eml->setMl_tipo_email($qr["email_usuario"]);
                $eml->setMl_identificacao_email($qr["email_identificacao_email"]);
                
	    	    	
    	return $eml;
     }
     
      public function selectFull()
     {
        $sql = "select * from email";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $eml = new Email();
                $eml->setMl_id($qr["email_id"]);
                $eml->setMl_usuario($qr["email_usuario"]);
                $eml->setMl_tipo_email($qr["email_usuario"]);
                $eml->setMl_identificacao_email($qr["email_identificacao_email"]);
                array_push($lista, $eml);
        }
    	return $lista;
     }
}
?>