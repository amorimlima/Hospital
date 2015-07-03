<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'CategoriaController.php');
include_once($path['beans'].'Categoria.php');
include_once($path['sys'].'Nav/Navigator.php');
$categoriaController = new CategoriaController();
$cidade = $_SESSION['CIDADE'];	
 					
		$categoria = new Categoria();
			
			$categoria->setIdCategoria($_GET["id"]);
			$categoria->setCategoria($_GET["categoria"]);
			$categoria->setTituloCategoria($_POST["tituloCategoria"]);
			$categoria->setCidadeCategoria($cidade);
			$categoria->setEnderecoCategoria($_POST["endCategoria"]);
			$categoria->setTelefoneCategoria($_POST["telefoneCategoria"]);
			
			
			//print_r($categoria);
			$categoriaController->updateCategorias($categoria);
				
				Navigator::goPage('categoria');	
?>
