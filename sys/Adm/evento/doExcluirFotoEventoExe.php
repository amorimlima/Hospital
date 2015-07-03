<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'FotoEventoController.php');
include_once($path['beans'].'FotoEvento.php');
include_once($path['sys'].'Nav/Navigator.php');
$fotoEventoController = new FotoEventoController();	
$cidade = $_SESSION['CIDADE'];	
$idFotoEvento = $_GET["id"];			
    				
			$fotoEventoController->deleteFotoEvento($idFotoEvento);
				
			Navigator::goPage('evento');	
?>