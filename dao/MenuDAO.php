<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Menu.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuDAO
 *
 * @author Kevyn
 */
class MenuDAO extends DAO{
    
     public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($mnu)
     {
         $sql  = "insert into menu (tipo_menu,btn_menu,obj_menu) values ";
         $sql .= "('".$mnu->getTipo_menu()."','";
         $sql .= "('".$mnu->getBtn_menu()."','".$mnu->getObj_menu()."',";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($mnu)
     {
        $sql  = "update menu set tipo_menu = '".$mnu->getTipo_menu()."',";
    	$sql .= "btn_menu = '".$mnu->$mnu->getBtn_menu()."',";
    	$sql .= "obj_menu = ".$mnu->$mnu->getObj_menu().",";
        
        return $this->execute($sql);
     }
     
     public function delete($idmnu)
     {
         $sql = "delete from menu where id_menu = ".$idmnu."";
    	return $this->execute($sql); 
     }
     
     public function select($idmnu)
     {
        $sql = "select * from menu where id_menu = ".$idmnu." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $mnu = new Menu();
                $mnu->setId_men($qr["id_menu"]);
                $mnu->setTipo_menu($qr["tipo_menu"]);
                $mnu->setBtn_menu($qr["btn_menu"]);
                $mnu->setObj_menu($qr["obj_menu"]);
       
    	return $mnu;
     }
     
     public function selectFull()
     {
        $sql = "select * from menu";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $mnu = new Menu();
                $mnu->setId_men($qr["id_menu"]);
                $mnu->setTipo_menu($qr["tipo_menu"]);
                $mnu->setBtn_menu($qr["btn_menu"]);
                $mnu->setObj_menu($qr["obj_menu"]);
                array_push($lista, $mnu);
        }
    	return $lista;
     }
}
?>