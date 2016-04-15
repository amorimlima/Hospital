<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];

include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateLivros.php');
$templateGeral = new Template();
$templateLivros = new TemplateLivros();

$logado = unserialize($_SESSION['USR']);
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
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <input type="hidden" value="<?php echo $logado['id'];?>" name="idUsuario" id="idUsuario">
  	<div id="container">
        <div class="row">
           <?php 
				$templateGeral->topoSite();
			?>       
        </div>
        <div id="Conteudo_Area">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-lg-8">
               		<div  id="Conteudo_Area_box_left">
                        <a href="#">                        	
                        	<img src="" alt="" id="img_teste"/>   	
                        </a>
                    </div>
                </div>
                
                <div class="col-xs-12 col-md-4 col-lg-4">
                	<div id="Conteudo_Area_box_right">
                        <div id="btn_exercicio">
                        	<?php $templateLivros->listaCapitulosLiberados(); ?>
                        </div>
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
    <script src="js/livros.js"></script>
  </body>
</html>