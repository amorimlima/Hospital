<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'CategoriaFuncional.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaFuncionalDAO
 *
 * @author Kevyn
 */
class CategoriaFuncionalDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
    public function insert($cat)
     {
         $sql  = "insert into categoria_funcional (ctf_categoria) values ";
         $sql .= "('".$cat->getCtf_categoria()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($cat)
     {
         $sql  = "update categoria_funcional set ctf_categoria = '".$cat->getCtf_categoria()."'";
         $sql .= "where ctf_id = ".$cat->getCtf_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idcat)
     {
        $sql = "delete from categoria_funcional where ctf_id = ".$idcat."";
    	return $this->execute($sql);   
     }
     
     public function select($idcat)
     {
        $sql = "select * from categoria_funcional where ctf_id = ".$idcat." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $cat = new CategoriaFuncional();
                $cat->setCtf_categoria($qr["ctf_categoria"]);
                $cat->setCtf_id($qr["ctf_id"]);
                   	
    	return $cat;
     }
     
     public function selectFull()
     {
        $sql = "select * from categoria_funcional";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $cat = new CategoriaFuncional();
                $cat->setCtf_categoria($qr["ctf_categoria"]);
                $cat->setCtf_id($qr["ctf_id"]);
                array_push($lista, $cat); 
        }
    	return $lista;
         
     }
}
?>