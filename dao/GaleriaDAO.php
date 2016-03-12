<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Galeria.php');
include_once($path['beans'].'Categoria_Galeria.php');
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
         $sql  = "insert into galeria (glr_nome, glr_arquivo, glr_descricao, glr_aluno,glr_professor, glr_escola, glr_categoria, glr_visualizacoes) values ";
         $sql .= "('".$glr->getGlr_nome()."'),'";
         $sql .= "('".$glr->getGlr_arquivo()."'),'";
         $sql .= "('".$glr->getGlr_descricao()."'),'";
         $sql .= "('".$glr->getGlr_aluno()."'),'";
         $sql .= "('".$glr->getGlr_professor()."'),'";
         $sql .= "('".$glr->getGlr_escola()."'),'";
         $sql .= "('".$glr->getGlr_categoria()."'),";
         $sql .= "('".$glr->getGlr_visualizacoes()."')";
		echo $sql;
    	return $this->execute($sql);
     }

     public function update($glr)
     {
        $sql  = "update grupo set";
        $sql .= "glr_nome = '".$glr->getGlr_nome()."',";
        $sql .= "glr_arquivo = '".$glr->getGlr_arquivo()."',";
        $sql .= "glr_descricao = '".$glr->getGlr_descricao()."',";
        $sql .= "glr_aluno = '".$glr->getGlr_aluno()."',";
        $sql .= "glr_professor = '".$glr->getGlr_professor()."',";
        $sql .= "glr_escola = '".$glr->getGlr_escola()."',";
        $sql .= "glr_categoria = '".$glr->getGlr_escola()."',";
        $sql .= "glr_visualizacoes = '".$glr->getGlr_visualizacoes()."',";
        $sql .= "where  glr_idgaleria = ".$glr->getGlr_idgaleria()." limit 1";
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
    	$qr = mysql_fetch_array($result);

                $glr = new Galeria();
                $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
                $glr->setGlr_nome($qr["glr_nome"]);
                $glr->setGlr_arquivo($qr["glr_arquivo"]);
                $glr->setGlr_descricao($qr["glr_descricao"]);
                $glr->setGlr_aluno($qr["glr_aluno"]);
                $glr->setGlr_professor($qr["glr_professor"]);
                $glr->setGlr_escola($qr["glr_escola"]);
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
            $glr->setGlr_aluno($qr["glr_aluno"]);
            $glr->setGlr_professor($qr["glr_professor"]);
            $glr->setGlr_escola($qr["glr_escola"]);
            $glr->setGlr_categoria($qr["glr_categoria"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
    	}

    	return $lista;
     }

     public function selectNome($nome)
     {
     	$sql = "select * from  `galeria` where  `glr_nome` like  '%".$nome."%'";
     	$result = $this->retrieve($sql);
    	$lista = array();
    	while ($qr = mysql_fetch_array($result))
    	{
    		$glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_aluno($qr["glr_aluno"]);
            $glr->setGlr_professor($qr["glr_professor"]);
            $glr->setGlr_escola($qr["glr_escola"]);
            $glr->setGlr_categoria($qr["glr_categoria"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
    	}

    	return $lista;
     }

     public function selectCategoria($categoria)
     {
        $sql = "select * from  `galeria` where  `glr_categoria` = ".$categoria." ";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysql_fetch_array($result))
        {
            $glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_aluno($qr["glr_aluno"]);
            $glr->setGlr_professor($qr["glr_professor"]);
            $glr->setGlr_escola($qr["glr_escola"]);
            $glr->setGlr_categoria($qr["glr_categoria"]);
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
        $sql .= "LIMIT 0 , 20";
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
            array_push($lista, $glr);
        }

        return $lista;
     }

     public function selectMaisVistos()
     {
        $sql = "select * from  `galeria` order by `glr_visualizacoes` desc limit 0, 3";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysql_fetch_array($result))
        {
            $glr = new Galeria();
            $glr->setGlr_idgaleria($qr["glr_idgaleria"]);
            $glr->setGlr_nome($qr["glr_nome"]);
            $glr->setGlr_arquivo($qr["glr_arquivo"]);
            $glr->setGlr_descricao($qr["glr_descricao"]);
            $glr->setGlr_aluno($qr["glr_aluno"]);
            $glr->setGlr_professor($qr["glr_professor"]);
            $glr->setGlr_escola($qr["glr_escola"]);
            $glr->setGlr_categoria($qr["glr_categoria"]);
            $glr->setGlr_visualizacoes($qr["glr_visualizacoes"]);
            array_push($lista, $glr);
        }

        return $lista;
     }


}