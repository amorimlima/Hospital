<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
$templateGeral = new Template();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Galeria</title>
        
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/galeria.css">
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
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
               <div class="col-xs-12 col-md-12 col-lg-8">               
                    <div id="Conteudo_Area_box_left">
                        <div id="box_galeria">
                            <p id="topo_galeria"></p>
                            <div id="box_cat">
                                <p id="box_right_1_box_titulo_1">CATEGORIA</p>
                                <div class="box_right_1_box_select">
                                    <input type="text" id="select_text">
                                    <div id="box_select">
                                        <span id="1" class="selecionado">Vídeo</span>
                                        <span id="2" class="selecionado">Hiperlink</span>
                                        <span id="3" class="selecionado">PDF</span>
                                        <span id="4" class="selecionado">Audio</span>
                                        <span id="5" class="selecionado">Foto</span>
                                    </div>
                                </div>
                            </div>
                            <div id="box_ass">
                                <p id="box_right_1_box_titulo_2">ASSUNTO</p>
                                <div class="box_right_1_box_select">
                                    <input type="text" id="assuno_text" placeholder="Digite o assunto que deseja pesquisar!">
                                </div>
                            </div>
                        </div>
                    </div> 
               </div>
               <div class="col-xs-12 col-md-12 col-lg-4">     
                    <div id="Conteudo_Area_box_right">
                        <div id="box_mais_vistos">
                            <p id="topo_mais_vistos"></p>
                        </div>
                        <div id="box_carregar"></div>
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
</body>
</html>