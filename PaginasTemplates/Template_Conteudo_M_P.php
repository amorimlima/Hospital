<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
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
        <script src="js/ScaleScript.js"></script>            
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
            	Conteudo com area grande
            </div>      
            <div id="Conteudo_Area_box_right">
            	Conteudo com area pequeno
            </div>     	
        </div>
        <div id="rodape"></div>
    </div>
</body>
</html>