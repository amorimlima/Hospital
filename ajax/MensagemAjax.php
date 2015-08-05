<?php
//if(!isset($_SESSION['PATH_SYS'])){
    require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
//}
$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'MensagemController.php');
include_once($path['beans'].'Mensagem.php');
include_once($path['template'].'TemplateMensagens.php');
$template = new TemplateMensagens();
$mensagemController = new MensagemController();
//$_POST["acao"] = "listaEnviadasMobileDetalhe";
switch ($_POST["acao"]){
    case "deleteMensagem":{
      
        $idmens = $_POST["id"];
        $mensagem = $mensagemController->selectMensagem($idmens);
    
        if(!empty($mensagem->getMsg_id())){
            $mensagemController->delete($_POST["id"]);  
            $result = Array('ok'=>true,'msg'=>'<div class="alert alert-danger"><i class="fa fa-times"></i> Deletado com sucesso!</div>');
          echo json_encode($mensagem);
        }
        break;
    }
    
    case "deletadas":{
        
        $mensagem = $mensagemController->deletadas();

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
            
            //onclick="EnviadasDetalheFuncao('.$value->getMsg_id().')"
                echo '<div id="msg_valores_'.$value->getMsg_id().'"   class="col1">
                      <p class="msg_nome ">'.$value->getMsg_id().'</p>
                      <p class="msg_assunto">'.$value->getMsg_assunto().'</p>
                      <p class="msg_data">'.$value->getMsg_data().'</p>
                </div>';
        }               
        break;
       
            break;
    }
    
    case "responder":{
        
        
        
    }
    
    case "novo":{
        echo '<p id="ass_linha">
                      <span id="ass_msg">REPOSIÇÃO</span>
                      <span id="ass_msg_data"></span>
                      </p>
                      <p id="ass_linha_rem">
                      <span id="msg_rem">REMETENTE:</span>
                      <span id="ass_msg_rem_nome"></span>
                      </p>
                      <p id="ass_linha_para">
                      <span id="msg_para">PARA:</span>
                      <span id="ass_msg_para_nome"></span>
                      </p>

                      <div id="ass_linha_titulo_msg">
                      <span id="msg_msg"></span>
                      </div>
                      
                      <div id="ass_resposta_msg">
                        <p id="ass_linha_titulo_resp">
                           <span id="ass_msg_resp">ENVIAR</span>
                        </p>
                        <textarea name="msg_resposta" rows=7 cols=105> 
                        </textarea>
                      </div>
                      
                       <div id="btn_msg_resposta">
                         <input type="button" onclick="responder()" name="enviar" value="Enviar">
                      </div>';
        
        break;
    }
    
    
    case "listaEnviadas":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaEnviadas($idmens);

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
                echo '<div id="msg_valores_'.$value->getMsg_id().'" onclick="EnviadasDetalheFuncao('.$value->getMsg_id().')"  class=" enviado col1">
                      <p class="msg_nome ">'.$value->getMsg_id().'</p>
                      <p class="msg_assunto">'.$value->getMsg_assunto().'</p>
                      <p class="msg_data">'.$value->getMsg_data().'</p>
                </div>';
        }               
        break;
    }
    
    case "listaEnviadosMobile":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaEnviadas($idmens);

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
                 
                
             echo'<p class="row" id="linha_titulos">
                    <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_rem">REMETENTE</span>
                    <span class="col-xs-6 col-md-6 col-lg-6" id="titulo_ass">ASSUNTO</span>
                    <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_data">DATA</span>
                </p>
             
                <div id="box_msg_recebidas_mobile" onclick="EnviadasMobileDetalheFuncao('.$value->getMsg_id().')" >
                    <div id="msg_valores_'.$value->getMsg_id().'"   class="col1-mobile row">
                        <div class="row" data-toggle="collapse" data-target="#abrir_msg_'.$value->getMsg_id().'">
                          <p class="msg_nome_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_id().'</p>
                          <p class="msg_assunto_mobile col-xs-6 col-md-6 col-lg-6">'.$value->getMsg_assunto().'</p>
                          <p class="msg_data_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_data().'</p>
                    </div>
                    <div class="row msg_detalhe" id="abrir_msg_'.$value->getMsg_id().'">
                            
                    </div>
                </div>';
             
        }               
                                                    
        
        break;
    }
    
    case "listaRecebidos":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaRecebidos($idmens);

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
                echo '<div id="msg_valores_'.$value->getMsg_id().'"  onclick="RecebidasDetalheFuncao('.$value->getMsg_id().')" class=" recebido '.$naolida.' col1">
                      <p class="msg_nome ">'.$value->getMsg_id().'</p>
                      <p class="msg_assunto">'.$value->getMsg_assunto().'</p>
                      <p class="msg_data">'.$value->getMsg_data().'</p>
                </div>';
        }               
        break;
    }
    
    case "listaRecebidosMobile":{
         $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->listaRecebidos($idmens);

        foreach ($mensagem as $value) {
            if($value->getMsg_lida() === 'n'){
                $naolida = 'msg_nao_lida';
            }else{
                $naolida = '';
            }
                echo '<p class="row" id="linha_titulos">
                        <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_rem">REMETENTE</span>
                        <span class="col-xs-6 col-md-6 col-lg-6" id="titulo_ass">ASSUNTO</span>
                        <span class="col-xs-3 col-md-3 col-lg-3" id="titulo_data">DATA</span>
                    </p>
                    
                <div id="box_msg_recebidas_mobile" >
                    <div id="msg_valores_'.$value->getMsg_id().'" onclick="RecebidasMobileDetalheFuncao('.$value->getMsg_id().')" class="col1-mobile row">
                            <div class="row" data-toggle="collapse" data-target="#abrir_msg_'.$value->getMsg_id().'">
                            <p class="msg_nome_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_id().'</p>
                            <p class="msg_assunto_mobile col-xs-6 col-md-6 col-lg-6">'.$value->getMsg_assunto().'</p>
                            <p class="msg_data_mobile col-xs-3 col-md-3 col-lg-3">'.$value->getMsg_data().'</p>
                        </div>
                        
                        <div class="row msg_detalhe" id="abrir_msg_'.$value->getMsg_id().'">
                            
                        </div>
                    </div>
                    <!--Box que abre quando clicar na msg-->

                   
                </div>';
                    
        }    
         break;
    }
    
    case "listaEnviadasDetalhe":{
         $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        
        $mensagem->getMsg_id();
        
   
                echo '<p id="ass_linha">
                        <span id="ass_msg">REPOSIÇÃO</span>
                        <span id="ass_msg_data">'.$mensagem->getMsg_data().'</span>
                      </p>
                      <p id="ass_linha_rem">
                        <span id="msg_rem">REMETENTE:</span>
                        <span id="ass_msg_rem_nome">'.$mensagem->getMsg_remetente().'</span>
                      </p>
                      <p id="ass_linha_para">
                        <span id="msg_para">PARA:</span>
                        <span id="ass_msg_para_nome">'.$mensagem->getMsg_destinatario().'</span>
                      </p>

                      <div id="ass_linha_titulo_msg">
                        <span id="msg_msg">'.$mensagem->getMsg_mensagem().'</span>
                      </div>
                      
                      <div id="ass_resposta_msg">
                        <p id="ass_linha_titulo_resp">
                           <span id="ass_msg_resp">RESPOSTA</span>
                        </p>
                      <textarea name="msg_resposta" rows=7 cols=105> 
                      </textarea>
                      </div>';
                      //</div>';     <div id="tbl_msg_detalhe">
               
        break;
    }
    
    case "listaEnviadasMobileDetalhe":{
        
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        
        $mensagem->getMsg_id();
        
       echo '<p>'.$mensagem->getMsg_mensagem().'</p>';
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

        echo '<p>'.$mensagem->getMsg_mensagem().'</p>';
        //.$mensagem->getMsg_mensagem().
        break;
    }
    
    
    
    case "listaRecebidasDetalhe":{
        $idmens = $_POST["id"];
        
        $mensagem = $mensagemController->detalhe($idmens);
        if($mensagem->getMsg_lida() == 'n'){
            
            $mensagemController->msgLida($idmens);
            // $template->recebidos();
        }

        $mensagem->getMsg_id();
       
   
                echo '<p id="ass_linha">
                        <span id="ass_msg">REPOSIÇÃO</span>
                        <span id="ass_msg_data">'.$mensagem->getMsg_data().'</span>
                      </p>
                      <p id="ass_linha_rem">
                        <span id="msg_rem">REMETENTE:</span>
                        <span id="ass_msg_rem_nome">'.$mensagem->getMsg_remetente().'</span>
                      </p>
                        <p id="ass_linha_para">
                        <span id="msg_para">PARA:</span>
                        <span id="ass_msg_para_nome">'.$mensagem->getMsg_destinatario().'</span>
                      </p>
                      <div id="ass_linha_titulo_msg">
                        <span id="msg_msg">'.$mensagem->getMsg_mensagem().'</span>
                      </div>
                      
                      <div id="ass_resposta_msg">
                       <p id="ass_linha_titulo_resp">
                           <span id="ass_msg_resp">RESPOSTA</span>
                       </p>
                        <textarea name="msg_resposta" rows=7 cols=105> 
                        </textarea>
                      </div>';
               
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