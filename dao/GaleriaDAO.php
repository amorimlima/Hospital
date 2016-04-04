<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Galeria.php');
include_once($path['beans'].'CategoriaGaleria.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GaleriaDAO
 *
 * @author Diego
 */
class GaleriaDAO extends DAO{

	public function  __construct($da) {
        parent::__construct($da);
     }

     public function insert($glr)
     {
         $sql  = "insert into galeria (glr_nome, glr_arquivo, glr_descricao, glr_data, glr_categoria, glr_visualizacoes) values ";
         $sql .= "('".$glr->getGlr_nome()."', ";
         $sql .= "'".$glr->getGlr_arquivo()."', ";
         $sql .= "'".$glr->getGlr_descricao()."', ";
         $sql .= "'".$glr->getGlr_data()."', ";
         $sql .= "'".$glr->getGlr_categoria()."',";
         $sql .= "'".$glr->getGlr_visualizacoes()."')";
		echo $sql;
    	return $this->execute($sql);
     }

     public function update($glr)
     {
        $sql  = "update galeria set ";
        $sql .= "glr_nome = '".$glr->getGlr_nome()."', ";
        $sql .= "glr_arquivo = '".$glr->getGlr_arquivo()."', ";
        $sql .= "glr_descricao = '".$glr->getGlr_descricao()."', ";
        $sql .= "glr_data = '".$glr->getGlr_data()."', ";
        $sql .= "glr_categoria = '".$glr->getGlr_categoria()."', ";
        $sql .= "glr_visualizacoes = '".$glr->getGlr_visualizacoes()."' ";
        $sql .= "where  glr_idgaleria = ".$glr->getGlr_idgaleria()." limit 1";
        echo $sql;
        return $this->execute($sql);
     }

     public function delete($idglr)
     {
         $sql = "delete from grupo where grp_id = ".$idglr."";
    	return $this->execute($sql); 
     }

     public function select($idglr)
     {
        $sql = "select * from galeria where glr_idgaleria = ".$idglr." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);
                $glr = new Galeria();
                $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
                $glr->setGlr_nome($qr["glr_nome"]);
                $glr->setGlr_arquivo($qr["glr_arquivo"]);
                $glr->setGlr_descricao($qr["glr_descricao"]);
                $glr->setGlr_data($qr["glr_data"]); 
                $glr->setGlr_categoria($qr["glr_categoria"]);
                $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);  

    	return $glr;
     }

     public function selectFull()
     {
        $sql = "select * from galeria";
    	$result = $this->retrieve($sql);
    	$lista = array();
    	while ($qr = mysqli_fetch_array($result))
    	{
    		$glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_data($qr["glr_data"]); 
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
    	}

    	return $lista;
     }

     public function selectNome($nome)
     {
     	$sql =  "SELECT *";
        $sql .= "FROM galeria glr ";
        $sql .= "JOIN categorias_galeria ctg ON ctg.ctg_id = glr.glr_categoria ";
        $sql .= "WHERE glr.glr_nome LIKE  '%".$nome."%'";
     	$result = $this->retrieve($sql);
    	$lista = array();
    	while ($qr = mysqli_fetch_array($result))
    	{
    		$glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_data($qr["glr_data"]); 
            $glr->setGlr_categoria(new CategoriaGaleria());
            $glr->getGlr_categoria()->setCtg_id($qr["ctg_id"]);
            $glr->getGlr_categoria()->setCtg_categoria($qr["ctg_categoria"]);
            $glr->getGlr_categoria()->setCtg_classe($qr["ctg_classe"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
    	}

    	return $lista;
     }

     public function selectCategoria($categoria)
     {
        $sql = "SELECT *";
        $sql .= "FROM galeria glr ";
        $sql .= "JOIN categorias_galeria ctg ON ctg.ctg_id = glr.glr_categoria ";
        if($categoria!="todos"){
           $sql .= "WHERE glr.glr_categoria = ".$categoria; 
        }        
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
            $glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_data($qr["glr_data"]);            
            $glr->setGlr_categoria(new CategoriaGaleria());
            $glr->getGlr_categoria()->setCtg_id($qr["ctg_id"]);
            $glr->getGlr_categoria()->setCtg_categoria($qr["ctg_categoria"]);
            $glr->getGlr_categoria()->setCtg_classe($qr["ctg_classe"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
        }

        return $lista;
     }

     public function selectMaisRecentes()
     {
        $sql =  "SELECT * ";
        $sql .= "FROM galeria glr ";
        $sql .= "JOIN categorias_galeria ctg ON ctg.ctg_id = glr.glr_categoria ";
        $sql .= "ORDER BY glr.glr_data DESC ";
        //$sql .= "LIMIT 0 , 20";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
            $glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_data($qr["glr_data"]);
            $glr->setGlr_categoria(new CategoriaGaleria());
            $glr->getGlr_categoria()->setCtg_id($qr["ctg_id"]);
            $glr->getGlr_categoria()->setCtg_categoria($qr["ctg_categoria"]);
            $glr->getGlr_categoria()->setCtg_classe($qr["ctg_classe"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
        }

        return $lista;
     }

     public function selectMaisVistos()
     {
        $sql =  "SELECT * ";
        $sql .= "FROM galeria glr ";
        $sql .= "JOIN categorias_galeria ctg ON ctg.ctg_id = glr.glr_categoria ";
        $sql .= "ORDER BY glr.glr_visualizacoes DESC ";
        $sql .= "LIMIT 0 , 3";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
            $glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_data($qr["glr_data"]);
            $glr->setGlr_categoria(new CategoriaGaleria());
            $glr->getGlr_categoria()->setCtg_id($qr["ctg_id"]);
            $glr->getGlr_categoria()->setCtg_categoria($qr["ctg_categoria"]);
            $glr->getGlr_categoria()->setCtg_classe($qr["ctg_classe"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
        }

        return $lista;
     }
}