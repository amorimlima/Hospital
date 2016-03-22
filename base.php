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
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

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
           <div class="col-lg-12" id="topo">
                <div class="row" id="row_logout">                    
                    <div class="col-xs-12 col-md-6 col-lg-7 pull-right" id="boxMenu">
                    	<div id="user_logout">
                        	<div id="user_logout_pequena">
                                <p id="user_logado">Rosana Amaral</p>
                                <span id="separador">
                                    <img class="img-responsive" src="img/separador.png" width="2" height="22" alt=""/>
                                </span>
                                <p id="logout">SAIR</p>
                            </div>
                        </div>
                        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        <nav id="bs-navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                            <ul class="nav navbar-nav" id="menu">
                                <li>
                                    <a href="livros.php" id="mn_livros">Livros</a>
                                    <!--<ul id="sbm_exercicios">
                                        <li><a href="#">1º Ano</a></li>
                                        <li><a href="#">2º Ano</a></li>
                                        <li><a href="#">3º Ano</a></li>
                                        <li><a href="#">4º Ano</a></li>
                                        <li><a href="#">5º Ano</a></li>
                                    </ul>-->
                                </li>
                                <li>
                                    <a href="mensagens.php" id="mn_mensagens">Mensagens</a>
                                </li>
                                <li>
                                    <a href="forum.php" id="mn_forum">Fórum</a>
                                </li>
                                <li>
                                    <a href="galeria.php" id="mn_galeria">Galeria</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="row">                	
                    <div class="col-xs-12 col-md-6 col-lg-5" id="logo">
                        <a href="index.php"><img src="img/logo.png"/></a>
                    </div>                    
                </div>
           </div>       
        </div>
        <div id="Conteudo_Area">
            <div class="row">
               <div class="col-xs-12 col-md-12 col-lg-8">
               		<div  id="Conteudo_Area_box_left">
                        <a href="#">
                            <!--<iframe id="objeto" src="Objetos/_embed/index.html" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" msallowfullscreen="true" width="100%" height="100%"></iframe>-->
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                	<div id="Conteudo_Area_box_right">
                    </div>
                </div>
            </div>
        </div>
        <footer>
        <?php
            $templateGeral->rodape();
        ?>
        </footer>
    </div>    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/funcoes.js"></script>
  </body>
</html>