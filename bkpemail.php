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

		// $msg  ='<!DOCTYPE html>';
		// $msg .='<html lang="pt">';
		// $msg .='<head>';
		// $msg .='<meta charset="UTF-8" />';
		// $msg .='</head>';
		// $msg .='<body>';
		// $msg .='<div id="container" style="padding: 15px;background-color: #f7f7f7;">';
		// $msg .='<h1 style="margin: 0; margin-bottom: 15px; font-family: arial; font-size: 22px; font-weight: bold; color: #999;">Redefinição de senha</h1>';
		// $msg .='<hr style="border: 0; background-color: #ccc; height: 1px;">';
		// $msg .='<div id="conteudo_mensagem" style="font-size: 16px; font-family: Arial; font-weight: normal; color: #666">';
		// $msg .='<p>Para redefinir sua senha, <a href=/index.php?recup=".$email" style="color: #728C07; font-weight: bold; text-decoration: none;">clique aqui</a></p>';
		// $msg .='<p>Caso o link não esteja funcionando, copie e cole a url abaixo em seu navegador:</p>';
		// $msg .='<p style="color: #728C07">/index.php?recup='.$email.'</p>';
		// $msg .='</div>';
		// $msg .='<hr style="border: 0; background-color: #ccc; height: 1px;">';
		// $msg .='<div id="assinatura" style="text-align: right;">';
		// $msg .='<img src="http://187.73.149.26:8080/img/logo/logo_lg.png" height="60px" />';
		// $msg .='</div>';
		// $msg .='</div>';
		// $msg .='</body>';
		// $msg .='</html>';
		$email = $_POST["email"];
		$msg ="olá";		

		$email_servidor = "criancascomoparceiras@gmail.com";
	    $para = $email;
		$de = 'CRIANÇAS COMO PARCEIRAS';
		$assunto  = "Crianças como parceiras - Recuperar senha";		

		$headers = "From: $email_servidor\n" .
               "Reply-To: $de\n" .
               "X-Mailer: PHP/" . phpversion() . "\n";
    	$headers .= "MIME-Version: 1.0\n";
    	$headers .= "Content-type: text/html; charset=utf-8\n";
    	$headers .= "Return-Path: criancascomoparceiras@gmail.com\n"; 
    	$headers .= "X-Priority: 1\n"; 

	  	$envio = mail($para, $assunto, nl2br($msg), $headers, "-f$email_servidor");

		if($envio)
		 echo "Mensagem enviada com sucesso";
		else
		 echo "A mensagem não pode ser enviada";

		break;

	}
}		 
?>
