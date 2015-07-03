<?php  
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'PatrocinioController.php');
include_once($path['beans'].'Patrocinio.php');
include_once($path['sys'].'Nav/Navigator.php');
include_once($path['dao'].'Functions.php');
include_once($path['controller'].'Thumbs.php');
$patrocinioController = new PatrocinioController();
$cidade = $_SESSION['CIDADE'];	
$idPatrocinio = $_GET["id"];
			
			
			$patrocinioController->deletePatrocinio($idPatrocinio);
				
			Navigator::goPage('patrocinio');			

?>