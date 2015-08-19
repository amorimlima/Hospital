<?php 

if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mensagens</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="css/mensagens.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div id="container">
        <div class="row">
			<?php 
            	$templateGeral->topoSite();
            ?>            
        </div>
        <div id="Conteudo_Area">
        	<div class="row">
               <div class="col-xs-12 col-md-12 col-lg-12"  id="area_geral">   
                    <div id="Conteudo_Area_box_Grande">
                        <div id="conteudo_mensagem">
                            <div id="box_msg_geral">                        	
                                <div class="row">               					
                   					<div class="col-xs-12 col-md-12 col-lg-8 pull-right">
                                        <!--<div id="conteudo_mensagem">-->
                                            <div class="row" id="ln_NRE">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div id="box_NRE">
                                                        <a href="#" onclick="novo()" id="btn_msg_novo"></a>
                                                        <a href="#" onclick="responder()" class="margin_ambas" id="btn_msg_responder"></a>
                                                        <a href="#" onclick="deleteFuncao()" id="btn_msg_excluir"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="desk-msg">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div id="tbl_msg">
                                                        <p id="linha_titulos" class="row">
                                                            <span id="titulo_rem" class="col-lg-3 font-SSP">REMETENTE</span>
                                                            <span id="titulo_ass" class="col-lg-7 font-SSP">ASSUNTO</span>
                                                            <span id="titulo_data" class="col-lg-2 font-SSP">DATA</span>
                                                        </p>
                                                        <div id="box_msg_listas">
                                                        	<div id="box_recebe_msg">
                                                        		<?php $templateMensagens->mensagensRecebidas(20);?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="box_msg_right_botton">
                                                        <p id="ass_linha">
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
                                                        <div id="ass_resposta_msg">
                                                            <textarea id="ass_msg_resp"></textarea>
                                                        </div>
                                                    </div>
                                             	</div>
                                            </div>
                                        <!--</div>-->
                                    </div>                                
                                    <div class="col-xs-12 col-md-12 col-lg-4 pull-left" id="box_msg_left">   
                                        <!--Menu geral-->
                                        <div id="mn_geral">
                                            <div id="btn_recebidos" onclick="recebidasFuncao()" class="btn_msg btn_msg_ativo">
                                                <span id="n_msg">RECEBIDOS(<?php echo $templateMensagens->recebidos(); ?>)</span>                                    	</div>
                                            <div id="btn_enviados" onclick="envidasFuncao()" class="btn_msg"><span>ENVIADOS</span></div>
                                            <div id="btn_excluidos" onclick="deletadas()"  class="btn_msg"><span>EXCLUÍDOS</span></div>
                                        </div>  
                                        <!--Menu mobile-->
    									<div class="panel-group" id="mn_mobile" role="tablist" aria-multiselectable="true">  
      									  <div class="panel">
                                            <div role="tab" id="headingOne">
                                                <div onclick="recebidasFuncaoMobile()" id="btn_recebidos" class="btn_msg btn_msg_ativo panel-title collapsed" role="button" data-toggle="collapse" data-parent="#mn_mobile" href="#box-recebidas" aria-expanded="false" aria-controls="box-recebidas" data-target="#box-recebidas">
                                                  <span>RECEBIDOS(<?php echo $templateMensagens->recebidos(); ?>)</span>
                                                </div>                                          
                                            </div>
                                        
                                            <div id="box-recebidas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                              <div class="panel-body">
                                                 <div class=" col-xs-12 col-md-12 col-lg-12">                                                <div id="box_msg_recebidas_mobile"></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
      
                                          <div class="panel">
                                            <div role="tab" id="headingTwo">
                                                <div onclick="envidasFuncaoMobile()" id="btn_enviados" class="btn_msg btn_msg_ativo panel-title collapsed" role="button" data-toggle="collapse" data-parent="#mn_mobile" href="#box-enviados" aria-expanded="false" aria-controls="box-enviados" data-target="#box-enviados">
                                                  <span>ENVIADOS</span>
                                                </div>
                                              
                                            </div>
                                        
                                            <div id="box-enviados" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                              <div class="panel-body">
                                                 <div class=" col-xs-12 col-md-12 col-lg-12">                                                            
                                                    <div id="box_msg_enviadas_mobile">
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="panel">
                                            <div role="tab" id="headingThree">
                                                <div role="button" data-toggle="collapse" data-parent="#mn_mobile" href="#box-excluidos" aria-expanded="false" aria-controls="box-excluidos" id="btn_excluidos" onclick="deletadasFuncaoMobile()" class="btn_msg btn_msg_ativo panel-title collapsed" data-target="#box-excluidos">
                                                  <span>EXCLUÍDOS</span>
                                                </div>
                                            </div>
                                            <div id="box-excluidos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" id="box-excluidos">
                                              <div class="panel-body">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div id="box_msg_excluidas_mobile">
                                                    
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                            	</div>                            
                            </div>
                        </div>
                        <!-- Modal -->
                                <!-- Trigger the modal with a button
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button> -->

                                <!-- Modal -->
                                <div class="modal fade" id="feedback_nova_mensagem" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="img_check" id="img_modal"></div>
                                        <div class="modal-body-container">
                                            <div class="text-modal"><p class="txt-box" id="texto_box">Sua mensagem foi enviada com sucesso!</p></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="modalOk()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim do Modal -->

                        <!-- nova mensagem -->
                        <div id="nova_mensagem">
                            <!-- área de botões -->
                            <div id="nova_mensagem_topo">
                                <div class="nova_mensagem_btns" id="nova_msg_enviar" onclick="checkEnviar()" data-toggle="modal" data-target="#feedback_nova_mensagem"></div>
                                <div class="nova_mensagem_btns" id="nova_msg_anexar"></div>
                            </div>

                            <!-- área de campos do formulário -->
                            <div id="nova_mensagem_form">
                                <div class="campo_nova_mensagem" id="mensagem_para">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-2 col-lg-2 nome_campo">PARA:</div>
                                        <div class="col-xs-12 col-md-10 col-lg-10">
                                            <input type="text" name="para" id="mensagem_campo_para" class="mensagem_campo">
                                        </div>
                                    </div>
                                </div>
                                <div class="campo_nova_mensagem" id="mensagem_assunto">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-2 col-lg-2 nome_campo">ASSUNTO:</div>
                                        <div class="col-xs-12 col-md-10 col-lg-10">
                                            <input type="text" name="assunto" id="mensagem_campo_assunto" class="mensagem_campo">
                                        </div>
                                    </div>
                                </div>
                                <div class="campo_nova_mensagem" id="mensagem_conteudo">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-2 col-lg-2 nome_campo">MENSAGEM:</div>
                                        <div class="col-xs-12 col-md-10 col-lg-10">
                                            <textarea name="conteudo" id="mensagem_campo_conteudo" class="mensagem_campo"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>              	
                </div>
            </div>
        </div>
        <footer>
            <div class="row" id="rodape"></div>
        </footer>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="js/funcoes.js"></script>
	<script src="js/Mensagem.js"></script>
</body>
</html>
