<?php
//if(!isset($_SESSION['PATH_SYS'])){
    require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
//}
$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'MensagemController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['beans'].'Mensagem.php');
include_once($path['template'].'TemplateMensagens.php');
$template = new TemplateMensagens();
$mensagemController = new MensagemController();
$usuarioController = new UsuarioController();
//$_POST["acao"] = "listaEnviadasMobileDetalhe";
switch ($_POST["acao"]){
    case "deleteMensagem":{
      
        $idmens = $_POST["id"];
        $mensagem = $mensagemController->selectMensagem($idmens);
    
        if(!empty($mensagem->getMsg_id())){
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
        
        $mensagem = $mensagemController->deletadas();
		
		
		if (count($mensagem)>0){
			foreach ($mensagem as $value) {
				//Fazer uma comparação com o usuário logado para listar o outro e o tipo da mensagem!!
				// if ($value->getMsg_destinatario() == $usuarioLogado->getUsr_nome){
					// $usuario = $usuarioController->select($value->getMsg_remetente());
				// }else{
					// $usuario = $usuarioController->select($value->getMsg_destinatario());
				// }
				$usuario = $usuarioController->select($value->getMsg_destinatario());
				
				echo'<div id="msg_valores_'.$value->getMsg_id().'" class="lixeira col1 row">
					  <p class="msg_check col-lg-1"><span class="check-box"></span></p>	
					  <div  onclick="RecebidasDetalheFuncao('.$value->getMsg_id().')">			  
						<p class="msg_nome col-lg-2">'.utf8_encode($usuario->getUsr_nome()).'</p>
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
         $mensagem = $mensagemController->deletadas();

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
            
                
              echo'<div id="msg_valores_'.$value->getMsg_id().'"   class="row col1-mobile" onclick="EnviadasMobileDetalheFuncao('.$value->getMsg_id().')">
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
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaEnviadas($idmens);
		if (count($mensagem)>0){
			foreach ($mensagem as $value) {
				$usuario = $usuarioController->select($value->getMsg_destinatario());
				echo'<div id="msg_valores_'.$value->getMsg_id().'" class=" enviado col1 row">
						<p class="msg_check col-lg-1"><span class="check-box"></span></p>
						<div  onclick="RecebidasDetalheFuncao('.utf8_encode($value->getMsg_id()).')">				  				  
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
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaRecebidos($idmens);

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
        
        $mensagem->getMsg_id();
        
		$result = Array(
			'data'=>$mensagem->getMsg_data(),
			'remetente'=>$mensagem->getMsg_remetente(),
			'destinatario'=>$mensagem->getMsg_destinatario(),
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
		
		$remetente = $usuarioController->select($iduser);
		$destinatario = 'Usuário Logado'; //Pegar da sessão quando tiver!!
       
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
    }
           
}

?>