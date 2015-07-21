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
                    <button id="btn_perguntar">PERGUNTAR</button>
                </div>
                <div id="box_forum_botton">
                    <p id="txt_postagens">POSTAGENS RECENTES</p>
                    <p id="txt_pesquisa">
                        <input type="text" placeholder="Pesquise no fórum!">
                    </p>
                    <div id="box_alunos">
                        <div class="perg_box cx_rosa">
                            <div class="perg_box_1">
                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                <p class="nome_aluno">Laura Sampaio</p>
                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                            </div>
                            <div class="perg_box_2">
                                <p class="qtd_visu cx_brancaP"><span>8</span> visualizações</p>
                                <p class="qtd_resp cx_brancaP"><span>3</span> respostas</p>
                            </div>
                        </div>
                        <div class="perg_box cx_branca">
                            <div class="perg_box_1">
                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                <p class="nome_aluno">Laura Sampaio</p>
                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                            </div>
                            <div class="perg_box_2">
                                <p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
                                <p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>              	
        </div>
        <div id="rodape"></div>
    </div>
</body>
</html>