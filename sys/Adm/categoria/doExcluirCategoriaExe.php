<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'CategoriaController.php');
include_once($path['beans'].'Categoria.php');
include_once($path['sys'].'Nav/Navigator.php');
$categoriaController = new CategoriaController();
$cidade = $_SESSION['CIDADE'];	
$idCategoria = $_GET["id"];
			
			
			$categoriaController->deleteCategorias($idCategoria);
				
			Navigator::goPage('categoria');			

?>