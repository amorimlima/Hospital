<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'ForumResposta.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumRespostaDAO
 *
 * @author Kevyn
 */
class ForumRespostaDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($for)
     {
         $sql  = "insert into  forum_resposta (frr_usuario,frr_resposta,frr_questao,frr_anexo,frr_data) values ";
         $sql .= "('".$for->getFrr_usuario()."','".$for->getFrr_resposta()."',";
         $sql .= "'".$for->getFrr_questao()."',";
         $sql .= "'".$for->getFrr_anexo()."','".$for->getFrr_data()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($for)
     {
        $sql  = "update forum_resposta set frr_usuario = '".$for->getFrr_usuario()."',";
    	$sql .= "frr_resposta = '".$for->getFrr_resposta()."',";
        $sql .= "frr_questao = '".$for->getFrr_questao()."',";
        $sql .= "frr_anexo = '".$for->getFrr_anexo()."',";
    	$sql .= "frr_data = ".$for->getFrr_data().",";
        $sql .= "where  frr_id = ".$for->getFrr_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idfor)
     {
         $sql = "delete from forum_resposta where frr_id = ".$idfor."";
    	return $this->execute($sql); 
     }
     
     public function select($idfor)
     {
        $sql = "select * from forum_resposta where frr_id = ".$idfor." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $for = new ForumResposta();
                $for->setFrr_id($qr["frr_id"]);
                $for->setFrr_usuario($qr["frr_usuario"]);
                $for->setFrr_resposta($qr["frr_resposta"]);
                $for->setFrr_questao($qr["frr_questao"]);
                $for->setFrr_anexo($qr["frr_anexo"]);
                $for->setFrr_data($qr["frr_data"]);
                
	    	    	
    	return $for;
     }
     
     public function selectFull()
     {
        $sql = "select * from forum_resposta";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $for = new ForumResposta();
                $for->setFrr_id($qr["frr_id"]);
                $for->setFrr_usuario($qr["frr_usuario"]);
                $for->setFrr_resposta($qr["frr_resposta"]);
                $for->setFrr_questao($qr["frr_questao"]);
                $for->setFrr_anexo($qr["frr_anexo"]);
                $for->setFrr_data($qr["frr_data"]);
                array_push($lista, $for);
                
        }    	
    	return $lista;
     }
     
}
?>