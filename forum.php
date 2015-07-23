<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateForum.php');
$templateGeral = new Template();
$templateForum = new TemplateForum();
?>
<!doctype html>
<html>
    <head>
    	<meta charset="utf-8">
   	<title>Fórum</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/forum.css">
        <script src="//use.typekit.net/rtp0aku.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
        <script src="js/jquery-2.1.1.min.js"></script>
         
       
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="js/Forum.js"></script>

        <!--<script src="js/ScaleScript.js"></script>-->    
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
                <div id="box_forum_top">
                    <p id="txt_pergunta">TEM ALGUMA PERGUNTA?</p>
                    <textarea id="box_pergunta" placeholder="Digite aqui sua pergunta!"></textarea>
                    <button onclick="perguntar()" id="btn_perguntar">PERGUNTAR</button>
                </div>
                <div id="box_forum_botton">
                    <p id="txt_postagens">POSTAGENS RECENTES</p>
                    <p id="txt_pesquisa">
                        <input onkeypress="completar()" id="keyword" type="text" placeholder="Pesquise no fórum!">
                      
                    </p>
                    <div id="box_alunos">
                        
                    </div>
                </div>
            </div>              	
        </div>
        <div id="rodape"></div>
    </div>
</body>
</html>