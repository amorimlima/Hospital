<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'GaleriaFoto.php');
include_once($path['controller'].'GaleriaFotoController.php');
include_once($path['sys'].'Nav/Navigator.php');
$galeriaFotoController = new GaleriaFotoController();
$cidade = $_SESSION['CIDADE'];	
$idGaleriaFoto = $_GET['id'];

	
	$galeriaFotoController->deleteGaleriaFoto($idGaleriaFoto);
	
	Navigator::goPage('galeria');
?>
