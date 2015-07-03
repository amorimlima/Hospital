<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'FotoPontoTuristicoController.php');
include_once($path['beans'].'fotoPontoTuristico.php');
include_once($path['sys'].'Nav/Navigator.php');
$fotoPontoTuristicoController = new FotoPontoTuristicoController();
	
$cidade = $_SESSION['CIDADE'];	
$idFotoPontoTuristico = $_GET["id"];
			
			//print_r($idFotoPontoTuristico);		
			$fotoPontoTuristicoController->deleteFotoPontoTuristicos($idFotoPontoTuristico);
				
			Navigator::goPage('pontoTuristico');	
?>