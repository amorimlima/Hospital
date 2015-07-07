<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Categoria.php');
/**
 * Description of CategoriaDAO
 *
 * @author Lombardi
 */
class CategoriaDAO extends DAO{

    public function  __construct($da) {
        parent::__construct($da);
    }
    
    public function insertCategorias($categoria)
    {
    	$sql  = "insert into categorias (categoria,tituloCategoria,cidadeCategoria,enderecoCategoria,telefoneCategoria) values ";
    	$sql .= "('".$categoria->getCategoria()."','".$categoria->getTituloCategoria()."',".$categoria->getCidadeCategoria().",";
    	$sql .= "'".$categoria->getEnderecoCategoria()."','".$categoria->getTelefoneCategoria()."')";
       
		echo $sql;
    	return $this->execute($sql);
    }
    
	public function updateCategorias($categoria)
    {
    	$sql  = "update categorias set categoria = '".$categoria->getCategoria()."',";
    	$sql .= "tituloCategoria = '".$categoria->getTituloCategoria()."',";
    	$sql .= "cidadeCategoria = ".$categoria->getCidadeCategoria().",";
    	$sql .= "enderecoCategoria = '".$categoria->getEnderecoCategoria()."',";
    	$sql .= "telefoneCategoria = '".$categoria->getTelefoneCategoria()."'";
    	$sql .= "where idCategoria = ".$categoria->getIdCategoria()." limit 1";
    	return $this->execute($sql);
    	    	
    }
    
	public function deleteCategorias($idCategoria)
    {
    	$sql = "delete from categorias where idCategoria = ".$idCategoria."";
    	return $this->execute($sql);
    }
    
    public function selectCategorias($idCategoria)
    {
    	$sql = "select * from categorias where idCategoria = ".$idCategoria." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

	    	$categoria = new Categoria();
	    	$categoria->setIdCategoria($qr["idCategoria"]);
	    	$categoria->setCategoria($qr["categoria"]);
	    	$categoria->setTituloCategoria($qr["tituloCategoria"]);
	    	$categoria->setCidadeCategoria($qr["cidadeCategoria"]);
	    	$categoria->setEnderecoCategoria($qr["enderecoCategoria"]);
	    	$categoria->setTelefoneCategoria($qr["telefoneCategoria"]);
	    	    	
    	return $categoria;
    }
    
    public function selectAllCategoriasByCidade($idCidade,$categoria)
    {
    	$sql = "select * from categorias where cidadeCategoria = ".$idCidade." and categoria = '".$categoria."'";
    	$lista = array();
    	$result = $this->retrieve($sql);
    	while ($qr = mysql_fetch_array($result))
    	{    		
    		$categoria = new Categoria();
    		$categoria->setIdCategoria($qr["idCategoria"]);
    		$categoria->setCategoria($qr["categoria"]);
    		$categoria->setTituloCategoria($qr["tituloCategoria"]);
    		$categoria->setCidadeCategoria($qr["cidadeCategoria"]);
    		$categoria->setEnderecoCategoria($qr["enderecoCategoria"]);
	    	$categoria->setTelefoneCategoria($qr["telefoneCategoria"]);    		
    		array_push($lista, $categoria);    		
    	}	
    	return $lista;	    	
    }

    public function selectAllCategorias($categoria)
    {
    	$sql = "select * from categorias where categoria = '".$categoria."' order by rand() limit 10";
    	$lista = array();
    	$result = $this->retrieve($sql);
    	while ($qr = mysql_fetch_array($result))
    	{    		
    		$categoria = new Categoria();
    		$categoria->setIdCategoria($qr["idCategoria"]);
    		$categoria->setCategoria($qr["categoria"]);
    		$categoria->setTituloCategoria($qr["tituloCategoria"]);
    		$categoria->setCidadeCategoria($qr["cidadeCategoria"]);
    		$categoria->setEnderecoCategoria($qr["enderecoCategoria"]);
	    	$categoria->setTelefoneCategoria($qr["telefoneCategoria"]);    		
    		array_push($lista, $categoria);    		
    	}	
    	return $lista;	    	
    }
}
?>