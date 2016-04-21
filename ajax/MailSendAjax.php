<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];
$urlSys = $_SESSION['URL_SYS'];

include_once($path['controller'].'UsuarioController.php');
$userController = new UsuarioController();

switch ($_POST["acao"]){

	case "verificaEmail":{ 
		$emailValidacao = $userController->verificaEmail($_POST["email"]);	
		print_r(trim($emailValidacao));   
		break;
	}

	case "enviaEmail":{
		$email_servidor = "criancascomoparceiras@gmail.com";
	    $para = $_POST["email"];
		$de = 'CRIANÇAS COMO PARCEIRAS';
		$assunto  = "Crianças como parceiras - Recuperar senha";

		$msg = "Olá mundo";
	 
	    $headers = "From: $email_servidor\r\n" .
               "Reply-To: $de\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
	    $headers .= "MIME-Version: 1.0\r\n";
	    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	    
	    mail($para, $assunto, nl2br($msg), $headers);

	}
}		 
?>