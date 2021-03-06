<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];
$urlSys = $_SESSION['URL_SYS'];

include_once($path['controller'].'UsuarioController.php');
include_once($path['PHPMailer'].'class.phpmailer.php');

$userController = new UsuarioController();

switch ($_POST["acao"]){

	case "verificaEmail":{ 
		$emailValidacao = $userController->verificaEmail($_POST["email"]);	
		if($emailValidacao!=0){
			print_r(json_encode($emailValidacao));
		}else{
			echo 0;
		}
		break;
	}

	case "enviaEmail":{
		// Inicia a classe PHPMailer
		$mail = new PHPMailer();

			$destinatario = base64_encode($_POST["email"]);
			// // Define os dados do servidor e tipo de conexão
			// $mail->IsSMTP(); // Define que a mensagem será SMTP
			// $mail->Host = "localhost"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
			// $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
			// $mail->Username = 'usuário de smtp'; // Usuário do servidor SMTP (endereço de email)
			// $mail->Password = 'senha de smtp'; // Senha do servidor SMTP (senha do email usado)
			 
			// Define o remetente
			$mail->From = "criancascomoparceiras@gmail.com"; // Seu e-mail
			$mail->Sender = "criancascomoparceiras@gmail.com"; // Seu e-mail
			$mail->FromName = "HCB"; // Seu nome
			 
			// Define os destinatário(s)
			$mail->AddAddress($_POST["email"]);
			 
			// Define os dados técnicos da Mensagem
			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			 
			// Define a mensagem (Texto e Assunto)
			$mail->Subject  = "Recuperar senha"; // Assunto da mensagem
			$mail->Body = '<body>
				<div id="container" style="padding: 15px;background-color: #f7f7f7;">
				<h1 style="margin: 0; margin-bottom: 15px; font-family: arial; font-size: 22px; font-weight: bold; color: #999;">Redefinição de senha</h1>
				<hr style="border: 0; background-color: #ccc; height: 1px;">
				<div id="conteudo_mensagem" style="font-size: 16px; font-family: Arial; font-weight: normal; color: #666">
				<p>Para redefinir sua senha clique no link abaixo!</a></p>
				<p>Caso o link não esteja funcionando, copie e cole a url abaixo em seu navegador:</p>
				<p style="color: #728C07"><a href="http://187.73.149.26:8080/index.php?newPass='.$destinatario.'">http://187.73.149.26:8080/redefinir.php?newPass='.$destinatario.'</p>
				</div>
				<hr style="border: 0; background-color: #ccc; height: 1px;">
				<div id="assinatura" style="text-align: right;">
					<img src="http://187.73.149.26:8080/img/logo/logo_lg.png" height="60px" />
				</div>
				</div>
				</body>';
			 
			// Envia o e-mail
			$enviado = $mail->Send();
			 
			// Limpa os destinatários e os anexos
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
			 
			// Exibe uma mensagem de resultado
			if ($enviado) {
				echo "ok";
			} else {
				echo "n_ok";
			}

		}
	}		 
?>