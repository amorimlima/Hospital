﻿<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateCapitulos.php');
$templateGeral = new Template();
$templateCapitulo = new TemplateCapitulos();

$logado = unserialize($_SESSION['USR']);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Capitulos</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/capitulos.css">
    <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<div id="container">
        <input type="hidden" value="<?php echo $logado['id'];?>" name="idUsuario" id="idUsuario">
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
                           <?= $templateCapitulo->listaExercicios("ok") ?>	
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                	<div id="Conteudo_Area_box_right">
                        <?php $cssMapa = $templateCapitulo->listaFundo();?>
                        <div <?=$cssMapa['idFundo']?> >
                        	<div <?=$cssMapa['parabens']?> ></div>
                            <div <?=$cssMapa['parabens_brilho']?> ></div>
                            <div id="caminho">
                                <div class="row">                                    
                                    <div class="linha_atividade">
                                        <?php 
                                            $retorno = $templateCapitulo->listaExercicios("n_ok");
                                            if($retorno == "erro"){
                                                $templateGeral->mensagemRetorno('exercicios','Este capitulo não está liberado!','erro');
                                            }else{
                                                $retorno;
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php if ($logado["perfil"] != "Aluno"): ?>
                                    <a href="documentos/CAP<?=$_GET["capitulo"]?>_L<?=$_GET["ano"]?>_OP.pdf"
                                       target="_blank"
                                       title="Ver as orientações ao professor">
                                        <div class="download-op"><span>Ver OP</span></div>
                                    </a>
                                <?php endif; ?>
                            </div>
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
    <script src="js/parametrizacaoCaminhos.js"></script>
    <script src="js/Capitulos.js"></script>
  </body>
</html>