<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Questao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestaoDAO
 *
 * @author Kevyn
 */
class QuestaoDAO extends DAO{
    //put your code here
    
     public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($ques)
     {
         $sql  = "insert into questao (qst_numero,qst_questao,qst_exercicio) values ";
         $sql .= "('".$ques->getQst_numero()."','";
         $sql .= "'".$ques->getQst_questao()."','".$ques->getQst_exercicio()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ques)
     {
        $sql  = "update questao set qst_numero = '".$ques->getQst_numero()."',";
    	$sql .= "qst_questao = '".$ques->getQst_questao()."',";
    	$sql .= "qst_exercicio = '".$ques->getQst_exercicio()."',";
        $sql .= "where  qst_id = ".$ques->getQst_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idques)
     {
         $sql = "delete from questao where qst_id = ".$idques."";
    	return $this->execute($sql); 
     }
     
     public function select($idques)
     {
        $sql = "select * from questao where qst_id = ".$idques." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $ques = new Questao();
                $ques->setQst_id($qr["qst_id"]);
                $ques->setQst_numero($qr["qst_numero"]);
                $ques->setQst_questao($qr["qst_questao"]);
                $ques->setQst_exercicio($qr["qst_exercicio"]);
                
	    	    	
    	return $ques;
     }
     
     public function selectFull()
     {
        $sql = "select * from questao";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $ques = new Questao();
                $ques->setQst_id($qr["qst_id"]);
                $ques->setQst_numero($qr["qst_numero"]);
                $ques->setQst_questao($qr["qst_questao"]);
                $ques->setQst_exercicio($qr["qst_exercicio"]);
                array_push($lista, $ques);
        }	    	
    	return $lista;
     }
}
?>