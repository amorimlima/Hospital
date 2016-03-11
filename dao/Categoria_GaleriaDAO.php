<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Categoria_Galeria.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria_GaleriaDAO
 *
 * @author Diego
 */
class Galeria_CategoriaDAO extends DAO{

	public function  __construct($da) {
        parent::__construct($da);
     }

     public function select($id)
     {
        $sql = "select * from categoria_galeria where ctg_id = ".$id." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $ctg = new Categoria_Galeria();
                $ctg->setCtg_id($qr["ctg_id"]);
                $ctg->setCtg_categoria($qr["ctg_categoria"]);

    	return $ctg;
     }

     public function selectFull()
     {
        $sql = "select * from categoria_galeria";
    	$result = $this->retrieve($sql);
    	$lista = array();
    	while ($qr = mysqli_fetch_array($result))
    	{
    		$ctg = new Categoria_Galeria();
            $ctg->setCtg_id($qr["ctg_id"]);
            $ctg->setCtg_categoria($qr["ctg_categoria"]);
            array_push($lista, $ctg);
    	}

    	return $lista;
     }

?>