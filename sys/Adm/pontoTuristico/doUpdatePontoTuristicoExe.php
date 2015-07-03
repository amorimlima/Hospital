<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'PontoTuristicoController.php');
include_once($path['beans'].'PontoTuristico.php');
include_once($path['sys'].'Nav/Navigator.php');
$pontoTuristicoController = new PontoTuristicoController();
$cidade = $_SESSION['CIDADE'];
$idPontoTuristico = $_GET["id"];	
					
		$pontoTuristico = new PontoTuristico();
		
			$pontoTuristico->setIdPontoTuristico($idPontoTuristico);
			$pontoTuristico->setCidadePontoTuristico($cidade);
			$pontoTuristico->setPontoTuristico($_POST["tituloPontoTuristico"]);
			$pontoTuristico->setTextoPontoTuristico($_POST["textoPontoTuristico"]);
			
			//print_r($pontoTuristico);
			$pontoTuristicoController->updatePontoTuristico($pontoTuristico);
				
			Navigator::goPage('pontoTuristico');			

?>