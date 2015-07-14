<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'RespostaTxt.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespostaTxtDAO
 *
 * @author Kevyn
 */
class RespostaTxtDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($ret)
     {
         $sql  = "insert into resposta_txt (rspt_usuario,rspt_exercicio,rspt_questao,rspt_resposta) values ";
         $sql .= "('".$ret->getRspt_usuario()."','".$ret->getRspt_exercicio()."',";
         $sql .= "'".$ret->getRspt_questao()."','".$ret->getRspt_resposta()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ret)
     {
        $sql  = "update resposta_txt set rspt_usuario = '".$ret->getRspt_usuario()."',";
    	$sql .= "rspt_exercicio = '".$ret->getRspt_exercicio()."',";
        $sql .= "rspt_questao = '".$ret->getMl_tipo_email()."',";
    	$sql .= "rspt_resposta = '".$ret->getRspt_resposta()."' ";
        $sql .= "where  rspt_id = ".$ret->getRspt_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idret)
     {
         $sql = "delete from resposta_txt where rspt_id = ".$idret."";
    	return $this->execute($sql); 
     }
     
     public function select($idret)
     {
        $sql = "select * from resposta_txt where rspt_id = ".$idret." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $ret = new RespostaTxt();
                $ret->setRspt_id($qr["rspt_id"]);
                $ret->setRspt_usuario($qr["rspt_usuario"]);
                $ret->setRspt_exercicio($qr["rspt_exercicio"]);
                $ret->setRspt_questao($qr["rspt_questao"]);
                $ret->setRspt_resposta($qr["rspt_resposta"]);
                
	    	    	
    	return $ret;
     }
     
     public function selectFull()
     {
        $sql = "select * from resposta_txt";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $ret = new RespostaTxt();
                $ret->setRspt_id($qr["rspt_id"]);
                $ret->setRspt_usuario($qr["rspt_usuario"]);
                $ret->setRspt_exercicio($qr["rspt_exercicio"]);
                $ret->setRspt_questao($qr["rspt_questao"]);
                $ret->setRspt_resposta($qr["rspt_resposta"]);
                array_push($lista, $ret);
                
        } 	    	
    	return $lista;
     }
}
?>