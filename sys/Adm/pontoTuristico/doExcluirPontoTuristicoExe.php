<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'PontoTuristicoController.php');
include_once($path['beans'].'PontoTuristico.php');
include_once($path['sys'].'Nav/Navigator.php');
$pontoTuristicoController = new PontoTuristicoController();
$cidade = $_SESSION['CIDADE'];	
$idPontoTuristico = $_GET['id'];
					
		print_r($idPontoTuristico);
		$pontoTuristicoController->deletePontoTuristico($idPontoTuristico);
				
		Navigator::goPage('pontoTuristico');			

?>