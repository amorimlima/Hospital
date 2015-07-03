<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EventoController.php');
include_once($path['beans'].'Evento.php');
include_once($path['sys'].'Nav/Navigator.php');
$eventoController = new EventoController();
$cidade = $_SESSION['CIDADE'];	
					
		$evento = new Evento();
			
    		$evento->setTituloEvento($_POST["tituloEvento"]);		
    		$evento->setCidadeEvento($cidade);
    		$evento->setDataEvento($_POST["dataEvento"]);
    		$evento->setTextoEvento($_POST["textoEvento"]);
			
			//echo"<pre>";
			//print_r($evento);
			$eventoController->insertEvento($evento);
				
			Navigator::goPage('evento');	

?>