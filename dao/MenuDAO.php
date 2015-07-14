<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Menu.php');
include_once($path['beans'].'Acesso.php');
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
         $sql  = "insert into menu (tipo_menu,btn_menu,ordem_menu) values ";
         $sql .= "('".$mnu->getTipo_menu()."','";
         $sql .= "('".$mnu->getBtn_menu()."','".$mnu->getOrdem_menu()."',";
    	return $this->execute($sql);
     }
     
     public function update($mnu)
     {
        $sql  = "update menu set tipo_menu = '".$mnu->getTipo_menu()."',";
    	$sql .= "btn_menu = '".$mnu->$mnu->getBtn_menu()."',";
    	$sql .= "ordem_menu = ".$mnu->$mnu->getOrdem_menu().",";
        
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
                $mnu->setOrdem_menu($qr["Ordem_menu"]);
       
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
                $mnu->setOrdem_menu($qr["ordem_menu"]);
                array_push($lista, $mnu);
        }
    	return $lista;
     }
     
     public function selectTipo($tipo)
     {
        $sql = "select * from menu where tipo_menu = ".$tipo."";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $mnu = new Menu();
                $mnu->setId_men($qr["id_menu"]);
                $mnu->setTipo_menu($qr["tipo_menu"]);
                $mnu->setBtn_menu($qr["btn_menu"]);
                $mnu->setOrdem_menu($qr["ordem_menu"]);
                array_push($lista, $mnu);
        }
    	return $lista;
     }
     
      public function selectTipoPerfil($tipo,$perfil)
     {
        $sql = "SELECT * FROM  `acesso` a";
        $sql.= " JOIN menu m ON m.id_menu = a.id_menu";
        $sql.= " JOIN perfil p ON p.prf_id = a.prf_id";
        $sql.= " WHERE a.prf_id =".$perfil." and m.tipo_menu = '".$tipo."'";        
        $sql.= "order by ordem_menu ASC";
        
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $mnu = new Menu();
                $mnu->setId_men($qr["id_menu"]);
                $mnu->setTipo_menu($qr["tipo_menu"]);
                $mnu->setBtn_menu($qr["btn_menu"]);
                $mnu->setOrdem_menu($qr["ordem_menu"]);
                array_push($lista, $mnu);
        }
    	return $lista;
     }    
}
?>