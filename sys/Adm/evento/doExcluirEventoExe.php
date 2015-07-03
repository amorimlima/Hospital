<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EventoController.php');
include_once($path['beans'].'Evento.php');
include_once($path['sys'].'Nav/Navigator.php');
$eventoController = new EventoController();
$cidade = $_SESSION['CIDADE'];
$idEvento = $_GET['id'];	
					
			
			//print_r($idEvento);

			$eventoController->deleteEvento($idEvento);
				
			Navigator::goPage('evento');	

?>