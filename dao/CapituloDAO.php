<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Capitulo.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CapituloDAO
 *
 * @author Kevyn
 */
class CapituloDAO extends DAO{
    //put your code here
     public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($cap)
     {
         $sql  = "insert into capitulo (cpt_capitulo) values ";
         $sql .= "('".$cap->getCpt_capitulo()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($cap)
     {
         $sql  = "update capitulo set cpt_capitulo = '".$cap->getCpt_capitulo()."',";
         $sql .= "where cpt_id = ".$cap->getCpt_id()." limit 1";
         return $this->execute($sql);
     }
     
     public function delete($idcap)
     {
         $sql = "delete from capitulo where cpt_id = ".$idcap."";
    	return $this->execute($sql); 
     }
     
     public function select($idcap)
     {
        $sql = "select * from capitulo where cpt_id = ".$idcap." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $cap = new Capitulo();
                $cap->setCpt_capitulo($qr["cpt_capitulo"]);
                $cap->setCpt_id($qr["cpt_id"]);
	 
    	return $cap;
     }
     
    public function selectFull()
     {
        $sql = "select * from capitulo";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $cap = new Capitulo();
                $cap->setCpt_capitulo($qr["cpt_capitulo"]);
                $cap->setCpt_id($qr["cpt_id"]);
                array_push($lista, $cap);   
        }
    	return $lista;
     }
    
}
?>