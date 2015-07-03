<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'MapaController.php');
include_once($path['beans'].'Mapa.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$mapaController = new MapaController();
$cidade = $_SESSION['CIDADE'];	
$idMapa = $_GET["id"];
			
			$mapaController->deleteMapa($idMapa);
				
			Navigator::goPage('mapa');	

?>