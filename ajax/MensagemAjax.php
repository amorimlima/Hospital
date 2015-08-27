<?php

require_once '../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'MensagemController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['beans'].'Mensagem.php');
include_once($path['template'].'TemplateMensagens.php');
$template = new TemplateMensagens();
$mensagemController = new MensagemController();
$usuarioController = new UsuarioController();
//$_POST["acao"] = "listaEnviadasMobileDetalhe";
//print_r($_POST);
switch ($_POST["acao"]){
     case "deleteMensagem":{      
        $idmens = $_POST["id"];
        $mensagem = $mensagemController->selectMensagem($idmens);
		if($mensagem->getMsg_id()!=NULL){
          $mensagemController->delete($_POST["id"]);  
          $result = Array('ok'=>true,'msg'=>'<div class="alert alert-danger"><i class="fa fa-times"></i> Deletado com sucesso!</div>');
          echo json_encode($mensagem);
       	}else{
          $mensagemController->deleteDefinitivo($_POST["id"]);  
          $result = Array('ok'=>true,'msg'=>'<div class="alert alert-danger"><i class="fa fa-times"></i> Deletado com sucesso!</div>');
          echo json_encode($mensagem);
        }
        break;
    }
    
    case "deletadas":{
        
		$logado = unserialize($_SESSION['USR']);
        $mensagem = $mensagemController->deletadasByUsuario($logado['id']);
		
		
		if (count($mensagem)>0){
			foreach ($mensagem as $value){
				//Fazer uma comparação com o usuário logado para listar o outro e o tipo da mensagem!!
				$logado = unserialize($_SESSION['USR']);
				$userLogado = $logado['id'];
				if ($value->getMsg_destinatario() == $userLogado){
					$usuario = $usuarioController->select($value->getMsg_remetente());
					$tipo = '(recebida)';
				 }else{
					$usuario = $usuarioController->select($value->getMsg_destinatario());
					$tipo = '(enviada)';	
				 }
				//$usuario = $usuarioController->select($value->getMsg_destinatario());
				
				echo'<div id="msg_valores_'.$value->getMsg_id().'" class="lixeira col1 row">
					  <p class="msg_check col-lg-1"><span class="check-box"></span></p>	
					  <div  onclick="RecebidasDetalheFuncao('.$value->getMsg_id().')">			  
						<p class="msg_nome col-lg-2">'.utf8_encode($usuario->getUsr_nome()).' '.$tipo.'</p>
						<p class="msg_assunto col-lg-7">'.utf8_encode($value->getMsg_assunto()).'</p>
						<p class="msg_data col-lg-2">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
					  </div>
				</div>';
			}
		}else {
			echo '<div class="alert alert-warning" role="alert"><strong>Nenhuma mensagem em sua Lixeira.</strong></div>';
		}
        break;
    }
    
    case "deletadasMobile":{
        $logado = unserialize($_SESSION['USR']);
        $mensagem = $mensagemController->deletadasByUsuario($logado['id']);

        echo '<p class="row" id="linha_titulos">
                <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_rem">REMETENTE</span>
                <span class="col-xs-6 col-md-6 col-lg-6" id="titulo_ass">ASSUNTO</span>
                <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_data">DATA</span>
              </p>';
        
		foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
            
                
              echo'<div id="msg_valores_'.$value->getMsg_id().'"   class="row col1-mobile" onclick="EnviadasMobileDetalhDetalheFuncao('.$value->getMsg_id().')">
						<div class="row" data-toggle="collapse" data-target="#abrir_msg_'.$value->getMsg_id().'">
							  <p class="msg_nome_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_id().'</p>
							  <p class="msg_assunto_mobile col-xs-6 col-md-6 col-lg-6">'.utf8_encode($value->getMsg_assunto()).'</p>
							  <p class="msg_data_mobile col-xs-3 col-md-3 col-lg-3">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
						</div>
						<div class="row msg_detalhe" id="abrir_msg_'.$value->getMsg_id().'"></div>
				    </div>';
                    
        }               
        break;
    }
    
    
    case "responder":{
        
        
        
    }
    
    case "novo":{
        
    }    
    
    case "listaEnviadas":{
        $idUser = $_POST["id"];
        
        $mensagem = $mensagemController->listaEnviadas($idUser);

		if (count($mensagem)>0){
			foreach ($mensagem as $value) {

				$usuario = $usuarioController->select($value->getMsg_destinatario());
				echo'<div id="msg_valores_'.$value->getMsg_id().'" class=" enviado col1 row">
						<p class="msg_check col-lg-1"><span class="check-box"></span></p>
						<div  onclick="EnviadasDetalheFuncao('.utf8_encode($value->getMsg_id()).')">				  				  
						  <p class="msg_nome col-lg-2">'.utf8_encode($usuario->getUsr_nome()).'</p>
						  <p class="msg_assunto col-lg-7">'.utf8_encode($value->getMsg_assunto()).'</p>
						  <p class="msg_data col-lg-2">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
						</div>
					</div>';		
			}               
		}else {
			echo '<div class="alert alert-warning" role="alert"><strong>Nenhuma mensagem enviada.</strong></div>';
		}
		break;
    }
	
    
    case "listaEnviadosMobile":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaEnviadas($idmens);

         echo '<p class="row" id="linha_titulos">
                <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_rem">REMETENTE</span>
                <span class="col-xs-6 col-md-6 col-lg-6" id="titulo_ass">ASSUNTO</span>
                <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_data">DATA</span>
              </p>';
         
        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }                 
                
             echo'<div id="msg_valores_'.$value->getMsg_id().'"   class="row col1-mobile " onclick="EnviadasMobileDetalheFuncao('.$value->getMsg_id().')">
                        <div class="row" data-toggle="collapse" data-target="#abrir_msg_'.$value->getMsg_id().'">
                          <p class="msg_nome_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_id().'</p>
                          <p class="msg_assunto_mobile col-xs-6 col-md-6 col-lg-6">'.utf8_encode($value->getMsg_assunto()).'</p>
                          <p class="msg_data_mobile col-xs-3 col-md-3 col-lg-3">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
                    </div>
                    <div class="row msg_detalhe" id="abrir_msg_'.$value->getMsg_id().'">
                            
                    </div>';             
        }               
                                                    
        
        break;
    }
    
    case "listaRecebidos":{
        $iduser = $_POST["id"];
        
        $mensagem = $mensagemController->listaRecebidos($iduser);

		if (count($mensagem)>0){
			foreach ($mensagem as $value) {
				$usuario = $usuarioController->select($value->getMsg_remetente());
				if($value->getMsg_lida() === 'n'){
					$naolida = 'msg_nao_lida';
				}else{
					$naolida = '';
				}				
				
				echo'<div id="msg_valores_'.$value->getMsg_id().'" class=" recebido '.$naolida.' col1 row">
						  <p class="msg_check col-lg-1"><span class="check-box"></span></p>	
						  <div onclick="RecebidasDetalheFuncao('.$value->getMsg_id().')" > 			  
							<p class="msg_nome col-lg-2">'.utf8_encode($usuario->getUsr_nome()).'</p>
							<p class="msg_assunto col-lg-7">'.utf8_encode($value->getMsg_assunto()).'</p>
							<p class="msg_data col-lg-2">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
						 </div>
					  </div>';			
			}
        }else {
			echo '<div class="alert alert-warning" role="alert"><strong>Nenhuma mensagem em sua Caixa de Entrada.</strong></div>';
		}
			   
        break;
    }
    
    case "listaRecebidosMobile":{
         $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaRecebidos($idmens);

        echo '<p class="row" id="linha_titulos">
                <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_rem">REMETENTE</span>
                <span class="col-xs-6 col-md-6 col-lg-6" id="titulo_ass">ASSUNTO</span>
                <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_data">DATA</span>
              </p>';

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
                echo '<div id="msg_valores_'.$value->getMsg_id().'" onclick="RecebidasMobileDetalheFuncao('.$value->getMsg_id().')" class=" '.$naolida.' row col1-mobile ">
                            <div class="row" data-toggle="collapse" data-target="#abrir_msg_'.$value->getMsg_id().'">
                            <p class="msg_nome_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_id().'</p>
                            <p class="msg_assunto_mobile col-xs-6 col-md-6 col-lg-6">'.utf8_encode($value->getMsg_assunto()).'</p>
                            <p class="msg_data_mobile col-xs-3 col-md-3 col-lg-3">'.date('d/m/Y',strtotime($value->getMsg_data())).'</p>
                        </div>
                        
                        <div class="row msg_detalhe" id="abrir_msg_'.$value->getMsg_id().'">
                            
                        </div>
                    </div>';
                    
        }    
         break;
    }
    
    case "listaEnviadasDetalhe":{
        
		$idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        
		$logado = unserialize($_SESSION['USR']);
		$remetente = $logado['nome'];
		$destinatario = $usuarioController->select($mensagem->getMsg_destinatario());

		$result = Array(
			'data'=>$mensagem->getMsg_data(),
			'remetente'=>utf8_encode($remetente),
			'destinatario'=>utf8_encode($destinatario->getUsr_nome()),
			'mensagem'=>utf8_encode($mensagem->getMsg_mensagem())
		);
		
        echo json_encode($result);
		   
        break;
    }
    
    case "listaEnviadasMobileDetalhe":{
        
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        
        $mensagem->getMsg_id();
        
       echo '<p>'.utf8_encode($mensagem->getMsg_mensagem()).'</p>';
        //.$mensagem->getMsg_mensagem().
        break;
    }
    
    case "listaRecebidasMobileDetalhe":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        if($mensagem->getMsg_lida() == 'n'){
            
            $mensagemController->msgLida($idmens);
            // $template->recebidos();
        }

        echo '<p>'.utf8_encode($mensagem->getMsg_mensagem()).'</p>';
        //.$mensagem->getMsg_mensagem().
        break;
    }
    
    
    
    case "listaRecebidasDetalhe":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        if($mensagem->getMsg_lida() == 'n'){
            
            $mensagemController->msgLida($idmens);
        }
		
		$remetente = $usuarioController->select($mensagem->getMsg_remetente());
		$logado = unserialize($_SESSION['USR']);
		$destinatario = $logado['nome'];
       
		$result = Array(
			'data'=>$mensagem->getMsg_data(),
			'remetente'=>$remetente->getUsr_nome(),
			'destinatario'=>utf8_encode($destinatario),
			'mensagem'=>utf8_encode($mensagem->getMsg_mensagem())
		);
		
		echo json_encode($result);
               
        break;
    }
    
    case "recarrega":{
         $idmens = $_POST["id"];
         $valor = $mensagemController->count($idmens);
         $result = Array('qtd'=>$valor);
         echo json_encode($result);
		 
		 break;
    }
           
}

?> 