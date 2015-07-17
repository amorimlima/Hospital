
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
                 
                
                <div id="box_msg_geral">
                    <div id="box_msg_left">
                        <div id="btn_recebidos" onclick="recebidasFuncao()" class="btn_msg btn_msg_ativo">
                            <span id="n_msg">RECEBIDOS(<?php echo $templateMensagens->recebidos(); ?>)</span>
                            
                        </div>
                        <div id="btn_enviados" onclick="envidasFuncao()" class="btn_msg"><span>ENVIADOS</span></div>
                        <div id="btn_excluidos" onclick="deletadas()"  class="btn_msg"><span>EXCLUÍDOS</span></div>
                    </div>
                    <div id="box_msg_right_top">
                        <div id="box_NRE">
                            <a href="#" id="btn_msg_novo"></a>
                            <a href="#" id="btn_msg_responder"></a>
                            <a href="#" onclick="deleteFuncao()" id="btn_msg_excluir"></a>
                        </div>
                        <div id="tbl_msg">
                            <p id="linha_titulos">
                                <span id="titulo_rem">REMETENTE</span>
                                <span id="titulo_ass">ASSUNTO</span>
                                <span id="titulo_data">DATA</span>
                            </p>
                            <div id="box_msg_teste"> 
                            </div>
                        </div>
                    </div>
                    <div id="box_msg_right_botton">
                       
                    </div>
                </div>
            </div>              	
        </div>
        <div id="rodape"></div>
    </div>
</body>
</html>
