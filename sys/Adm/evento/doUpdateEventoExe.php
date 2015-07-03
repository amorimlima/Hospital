<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EventoController.php');
include_once($path['beans'].'Evento.php');
include_once($path['sys'].'Nav/Navigator.php');
$eventoController = new EventoController();
$cidade = $_SESSION['CIDADE'];	
$id = $_GET["id"];	
					
		$evento = new Evento();
		
			$evento = new Evento();
			$evento->setIdEvento($id);
    		$evento->setTituloEvento($_POST["tituloEvento"]);		
    		$evento->setCidadeEvento($cidade);
    		$evento->setDataEvento($_POST["dataEvento"]);
    		$evento->setTextoEvento($_POST["textoEvento"]);
			
			//print_r($id);
			$eventoController->updateEvento($evento);
				
				Navigator::goPage('evento');		

?>