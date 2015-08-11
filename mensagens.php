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
    <link rel="stylesheet" type="text/css" href="css/mensagens.css">	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//use.typekit.net/rtp0aku.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
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
                        <div id="box_msg_geral">                        	
                            <div class="row">               					
               					<div class="col-xs-12 col-md-12 col-lg-8 pull-right"> 
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
                                                <p id="linha_titulos">
                                                    <span id="titulo_rem">REMETENTE</span>
                                                    <span id="titulo_ass">ASSUNTO</span>
                                                    <span id="titulo_data">DATA</span>
                                                </p>
                                                <div id="box_msg_listas"></div>
                                            </div>
                                            <div id="box_msg_right_botton"></div>
                                     	</div>
                                    </div>
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
    <script src="js/funcoes.js"></script>
	<script src="js/Mensagem.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			recebidasFuncaoMobile();
		});
	</script>
</body>
</html>
