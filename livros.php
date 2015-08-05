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
    <title>Home</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/livros.css">
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
               		<div  id="Conteudo_Area_box_left">
                        <a href="#">
                            <iframe id="objeto" src="" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" msallowfullscreen="true"></iframe>
                        	<img src="img/atividade.png" alt="" id="img_teste" class="img-responsive"/>   	
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                	<div id="Conteudo_Area_box_right">
                        <input type="radio" name="tabs" class="tabs" id="tab1" checked>
                        <label for="tab1">1º Ano</label>
                        <div>
                            <p>Capítulo 5</p>
                            <p class="tema" id="1_ano/Capitulo_5/1_Introducao_Pratinha">Tema Segurança em casa</p>
                            <p class="tema" id="1_ano/Capitulo_5/1_Introducao_Pratinha">Tema Meio Ambiente</p>
                        </div>                    
                        <input type="radio" name="tabs" class="tabs" id="tab2">
                        <label for="tab2">2º Ano</label>
                        <div>
                          <p>2-5º Capitulo</p>
                        </div>        
                       	<input type="radio" name="tabs" class="tabs" id="tab3">
                        <label for="tab3">3º Ano</label>
                        <div>
                          <p>3-5º Capitulo</p>
                        </div>
                        <input type="radio" name="tabs" class="tabs" id="tab4">
                        <label for="tab4">4º Ano</label>
                        <div>
                          <p>4-5º Capitulo</p>
                        </div> 
                        <input type="radio" name="tabs" class="tabs" id="tab5">
                        <label for="tab5" style="margin-right:0">5º Ano</label>
                        <div>
                          <p>5-5º Capitulo</p>
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
  </body>
</html>