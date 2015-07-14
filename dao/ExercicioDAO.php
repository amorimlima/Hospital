<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Exercicio.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExercicioDAO
 *
 * @author Kevyn
 */
class ExercicioDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($exe)
     {
         $sql  = "insert into exercicio (exe_tipo,exe_serie,exe_tema,exe_capitulo) values ";
         $sql .= "('".$exe->getexe_tipo()."','";
         $sql .= "'".$exe->getexe_serie()."','".$exe->getexe_tema()."',";
         $sql .= "'".$exe->getexe_capitulo()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($exe)
     {
        $sql  = "update exercicio set exe_tipo = '".$exe->getexe_tipo()."',";
    	$sql .= "exe_serie = '".$exe->getexe_serie()."',";
    	$sql .= "exe_tema = ".$exe->getexe_tema().",";
        $sql .= "exe_capitulo = ".$exe->getexe_capitulo().",";
        $sql .= "where exe_id = ".$exe->getexe_id()." limit 1";
        
        return $this->execute($sql);
     }
     
     public function delete($idexe)
     {
         $sql = "delete from exercicio where exe_id = ".$idexe."";
    	return $this->execute($sql); 
     }
     
     public function select($idexe)
     {
        $sql = "select * from exercicio where exe_id = ".$idexe." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

        
                $exe = new Exercicio;
                $exe->setexe_id($qr["exe_id"]);
                $exe->setexe_tipo($qr["exe_tipo"]);
                $exe->setexe_serie($qr["exe_serie"]);
                $exe->setexe_tema($qr["exe_tema"]);
                $exe->setexe_capitulo($qr["exe_capitulo"]);
              	
    	return $exe;
     }
     
     public function selectFull()
     {
        $sql = "select * from exercicio";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $exe = new Exercicio;
                $exe->setexe_id($qr["exe_id"]);
                $exe->setexe_tipo($qr["exe_tipo"]);
                $exe->setexe_serie($qr["exe_serie"]);
                $exe->setexe_tema($qr["exe_tema"]);
                $exe->setexe_capitulo($qr["exe_capitulo"]);
                array_push($lista, $exe);
        }
    	return $lista;
     }
     
     
}
?>