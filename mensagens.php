
﻿<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}


$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
?>
<!doctype html>
<html>
    <head>
    	<meta charset="utf-8">
   	<title>home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/mensagens.css">
        <!--<script src="//use.typekit.net/rtp0aku.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>-->
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/ScaleScript.js"></script>    
        <script src="js/Mensagem.js"></script>  
    </head>    
<body>
	<!--Conteudo Geral-->
    <div id="Container">
    	<!--Topo-->
    	<div id="topo">        	
            <?php 
                $templateGeral->topoSite();
            ?> 
        </div>
        <!--Conteudo Central-->
        <div id="Conteudo_Area">
        	<!--Area Unica-->
            <div id="Conteudo_Area_box_Grande">
                <div id="retorno" style="background: #666; height: 50px; width: 100%; color: #fff">
                    
                </div>
                
                <div id="box_msg_geral">
                    <div id="box_msg_left">
                        <div id="btn_recebidos"  class="btn_msg btn_msg_ativo"><span>RECEBIDOS(<?php echo $templateMensagens->recebidos(); ?>)</span></div>
                        <div id="btn_enviados" onclick="envidasFuncao()" class="btn_msg"><span>ENVIADOS</span></div>
                        <div id="btn_excluidos" onclick="deleteFuncao()" class="btn_msg"><span>EXCLUÍDOS</span></div>
                    </div>
                    <div id="box_msg_right_top">
                        <div id="box_NRE">
                            <a href="#" id="btn_msg_novo"></a>
                            <a href="#" id="btn_msg_responder"></a>
                            <a href="#" id="btn_msg_excluir"></a>
                        </div>
                        <div id="tbl_msg">
                            <p id="linha_titulos">
                                <span id="titulo_rem">REMETENTE</span>
                                <span id="titulo_ass">ASSUNTO</span>
                                <span id="titulo_data">DATA</span>
                            </p>
                            <div class="col1 msg_nao_lida">
                                <p class="msg_nome ">Laura Sampaio</>
                                <p class="msg_assunto">Aula 12</p>
                                <p class="msg_data">02/03/2015</p>
                            </div>
                            <div class="col1">
                                <p class="msg_nome">Laura Sampaio</p>
                                <p class="msg_assunto">Aula 12</p>
                                <p class="msg_data">02/03/2015</p>
                            </div>
                        </div>
                    </div>
                    <div id="box_msg_right_botton">
                        <p id="ass_linha">
                            <span id="ass_msg">REPOSIÇÃO</span>
                            <span id="ass_msg_data">02/03/2015 às 15:34</span>
                        </p>
                        <p id="ass_linha_rem">
                            <span id="msg_rem">REMETENTE:</span>
                            <span id="ass_msg_rem_nome">Talita Lourenço</span>
                        </p>
                        <p id="ass_linha_para">
                            <span id="msg_para">PARA:</span>
                            <span id="ass_msg_para_nome">Rosana Amaral</span>
                        </p>
                    </div>
                </div>
            </div>              	
        </div>
        <div id="rodape"></div>
    </div>
</body>
</html>
