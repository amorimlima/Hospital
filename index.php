<?php 
require_once '_loadPaths.inc.php';
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
$templateGeral = new Template();
?>
<!doctype html>
<html>
    <head>
   	<meta charset="utf-8">
   	<title>home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!--<script src="//use.typekit.net/rtp0aku.js"></script>
		<script>try{Typekit.load();}catch(e){}</script>-->
       	<script src="js/jquery-2.1.1.min.js"></script>   
        <script src="js/c2runtime.js"></script>   
        <script src="js/ScaleScript.js"></script>  
        <script src="js/Funcoes.js"></script>           
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
        	<!--Area Duas colunas Media e Pequena-->         
            <div id="Conteudo_Area_box_left">
            	<iframe id="" src="Objetos/4_Atividade_Quarto/index.html" width="100%" height="100%"></iframe>
            </div>      
            <div id="Conteudo_Area_box_right">
            </div>     	
        </div>
        <div id="rodape"></div>
    </div>
</body>
</html>