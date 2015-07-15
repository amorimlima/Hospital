<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'ForumQuestao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumQuestaoDAO
 *
 * @author Kevyn
 */
class ForumQuestaoDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($foq)
     {
         $sql  = "insert into forum_questao (frq_usuario,frq_questao,frq_anexo,frq_data,frq_topico) values ";
         $sql .= "('".$foq->getFrq_usuario()."','".$foq->getFrq_questao()."',";
         $sql .= "'".$foq->getFrq_anexo()."','".$foq->getFrq_data()."','".$foq->getFrq_topico()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
      public function update($foq)
     {
        $sql  = "update forum_questao set frq_usuario = '".$foq->getFrq_usuario()."',";
    	$sql .= "frq_questao = '".$foq->getFrq_questao()."',";
    	$sql .= "frq_anexo = ".$foq->getFrq_anexo().",";
        
        $sql .= "frq_data = ".$foq->getFrq_data().",";
        $sql .= "frq_topico = ".$foq->getFrq_topico().",";
        $sql .= "where  frq_id = ".$foq->getFrq_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idfoq)
     {
         $sql = "delete from forum_questao where frq_id = ".$idfoq."";
    	return $this->execute($sql); 
     }
     
     public function select($idfoq)
     {
        $sql = "select * from forum_questao where frq_id = ".$idfoq." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $foq = new ForumQuestao();
                $foq->setFrq_id($qr["frq_id"]);
                $foq->setFrq_usuario($qr["frq_usuario"]);
                $foq->setFrq_questao($qr["frq_questao"]);
                $foq->setFrq_anexo($qr["frq_anexo"]);
                $foq->setFrq_data($qr["frq_data"]);
                $foq->setFrq_topico($qr["frq_topico"]);
                
	    	    	
    	return $foq;
     }
     
     public function selectFull()
     {
        $sql = "select * from forum_questaos";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $foq = new ForumQuestao();
                $foq->setFrq_id($qr["frq_id"]);
                $foq->setFrq_usuario($qr["frq_usuario"]);
                $foq->setFrq_questao($qr["frq_questao"]);
                $foq->setFrq_anexo($qr["frq_anexo"]);
                $foq->setFrq_data($qr["frq_data"]);
                $foq->setFrq_topico($qr["frq_topico"]);
                array_push($lista, $foq);
        }    	
    	return $lista;
     }
}
?>