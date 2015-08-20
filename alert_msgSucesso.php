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
        <title>Mensagem enviada com sucesso!</title>
        
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/galeria.css">
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,400,400italic,600,600italic,200,200italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
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
            <!-- Modal -->
                <h2>Small Modal</h2>
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Sucesso</button>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Open Erro</button>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">Open Alerta</button>

                    <!-- Modal -->
                    <?php 
                        $templateGeral->textoMensagem('oi');
                        $templateGeral->tipoBotao('btn-azul');
                        $templateGeral->tipoIcone('img_erro');
                        $templateGeral->tipoModalCaixa('modal-content-azul');
                        $templateGeral->mensagemRetorno();
                    ?>
                    <!-- Fim do Modal -->
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-body">
                            <div class="img_erro"></div>
                            <div class="modal-body-container">
                                <div class="text-modal"><p class="txt-box">Erro ao cadastrar verifique os campos!</p></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                    </div>
        </div>
                    <!-- Fim do Modal -->
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal3" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-body">
                            <div class="img_alert"></div>
                            <div class="modal-body-container">
                                <div class="text-modal"><p class="txt-box">Favor preencher todos os campos!</p></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                    </div>
        </div>
                    <!-- Fim do Modal -->
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