<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Calendario.php');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalendarioDAO
 *
 * @author Kevyn
 */
class CalendarioDAO extends DAO{
    //put your code here
    
     public function  __construct($da) {
        parent::__construct($da);
    }
    
     public function insertCalendario($cal)
     {
         $sql  = "insert into calendario (cld_data_inicio,cld_data_fim,cld_evento,cld_ano_letivo,cld_tipo_evento,cld_descricao,cld_imagem,cld_hora_inicio,cld_hora_fim,cld_visivel) values ";
         $sql .= "('".$cal->getCld_data_inicio()."','".$cal->getCld_data_fim()."',".$cal->getCld_evento().",";
         $sql .= "'".$cal->getCld_ano_letivo()."','".$cal->getCld_tipo_evento()."')";
         $sql .= "'".$cal->getCld_descricao()."','".$cal->getCld_imagem()."')";         
         $sql .= "'".$cal->getCld_hora_inicio()."','".$cal->getCld_hora_fim()."')";   
         $sql .= "'".$cal->getCld_visivel()."','";   
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function updateCalendario($cal)
     {
        $sql  = "update calendario set cld_data_inicio = '".$cal->getCld_data_inicio()."',";
    	$sql .= "cld_data_fim = '".$cal->getCld_data_fim()."',";
    	$sql .= "cld_evento = ".$cal->getCld_evento().",";
    	$sql .= "cld_ano_letivo = '".$cal->getCld_ano_letivo()."',";
    	$sql .= "cld_tipo_evento = '".$cal->getCld_tipo_evento()."'";
        $sql .= "cld_descricao = '".$cal->getCld_descricao()."'";
        $sql .= "cld_imagem = '".$cal->getCld_imagem()."'";
        $sql .= "cld_hora_inicio = '".$cal->getCld_hora_inicio()."'";
        $sql .= "cld_hora_fim = '".$cal->getCld_hora_fim()."'";
        $sql .= "cld_visivel = '".$cal->getCld_visivel()."'";
    	$sql .= "where cld_id = ".$cal->getCld_id()." limit 1";
    	return $this->execute($sql);
     }
     
     public function deleteCalendario($idcal)
     {
        $sql = "delete from calendario where cld_id = ".$idcal."";
    	return $this->execute($sql);   
     }
     
     public function selectCalendario($idcal)
     {
        $sql = "select * from calendario where cld_id = ".$idcal." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);
        
                
                $cal = new Calendario();
                $cal->setCld_id($qr["cld_id"]);
                $cal->setCld_data_inicio($qr["cld_data_inicio"]);
                $cal->setCld_data_fim($qr["cld_data_fim"]);
                $cal->setCld_evento($qr["cld_evento"]);
                $cal->setCld_ano_letivo($qr["cld_ano_letivo"]);
                $cal->setCld_tipo_evento($qr["cld_tipo_evento"]);
                $cal->setCld_descricao($qr["cld_descricao"]);
                $cal->setCld_imagem($qr["cld_imagem"]);
                $cal->setCld_hora_inicio($qr["cld_hora_inicio"]);
                $cal->setCld_hora_fim($qr["cld_hora_fim"]);
                $cal->setCld_visivel($qr["cld_visivel"]);
	    	    	
    	return $cal;
     }
     public function selectCalendarioFull()
     {
        $sql = "select * from calendario";
    	$result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysql_fetch_array($result))
    	{  
                $cal = new Calendario();
                $cal->setCld_id($qr["cld_id"]);
                $cal->setCld_data_inicio($qr["cld_data_inicio"]);
                $cal->setCld_data_fim($qr["cld_data_fim"]);
                $cal->setCld_evento($qr["cld_evento"]);
                $cal->setCld_ano_letivo($qr["cld_ano_letivo"]);
                $cal->setCld_tipo_evento($qr["cld_tipo_evento"]);
                $cal->setCld_descricao($qr["cld_descricao"]);
                $cal->setCld_imagem($qr["cld_imagem"]);
                $cal->setCld_hora_inicio($qr["cld_hora_inicio"]);
                $cal->setCld_hora_fim($qr["cld_hora_fim"]);
                $cal->setCld_visivel($qr["cld_visivel"]);
                array_push($lista, $cal);    
        }
	    	    	
    	return $lista;
     }
     
     
     
}

?>
