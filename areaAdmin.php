<?php 

if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();

$logado = unserialize($_SESSION['USR']);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Área Administração</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="css/areaAdmin.css">
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
               <div class="col-xs-12 col-md-12 col-lg-12"  id="area_geral">   
                    <div id="Conteudo_Area_box_Grande">
                        <div class="box_area_admin">
                            <div class="topo_box_area_admin">
                                <!-- Cabeçalho -->
                            </div>
                            <main class="conteudo_box_area_admin">
                                <!-- Conteúdo principal -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <section class="area_btns_tabs">
                                            <div class="btns_tabs btns_aluno">
                                                <ul class="lista_btns_aluno">
                                                    <li class="btn_aluno btn_add_cadastro">Novo cadastro</li>
                                                    <li class="btn_aluno btn_update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_professor">
                                                <ul class="lista_btns_professor">
                                                    <li class="btn_professor btn_confirm_cadastro">Confirmar Cadastro</li>
                                                    <li class="btn_professor btn_add_cadastro">Novo cadastro</li>
                                                    <li class="btn_professor btn_update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_escola">
                                                <ul class="lista_btns_escola">
                                                    <li class="btn_escola btn_confirm_cadastro">Confirmar Cadastro</li>
                                                    <li class="btn_escola btn_add_cadastro">Novo cadastro</li>
                                                    <li class="btn_escola btn_update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-2">
                                        <nav role="navigation" class="area_tabs_cadastro">
                                            <ul class="tabs_cadastro">
                                                <li class="tab_cadastro tab_aluno">Professor</li>
                                                <li class="tab_cadastro tab_professor">Aluno</li>
                                                <li class="tab_cadastro tab_escola">Escola</li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="col-xs-12 col-md-10">
                                        <section class="area_conteudo_tabs">
                                            <div class="conteudo_tab conteudo_aluno"></div>
                                            <div class="conteudo_tab conteudo_professor"></div>
                                            <div class="conteudo_tab conteudo_escola"></div>
                                        </section>
                                    </div>
                                </div>
                            </main>
                        </div>

                        <!-- Modal -->
                        <!-- Trigger the modal with a button
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button> -->
                        <!-- Modal -->
                        <div class="modal fade" id="feedback_nova_mensagem" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="img_check" id="img_modal"></div>
                                        <div class="modal-body-container">
                                            <div class="text-modal"><p class="txt-box" id="texto_box"><!-- Sua mensagem foi enviada com sucesso! --></p></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="modalOk()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim do Modal -->
                    </div>              	
                </div>
            </div>
        </div>
        <footer>
            <div class="row" id="rodape"></div>
        </footer>
    </div>
	
	<!--Sempre que for utilizar uma mensagem, criar uma div com a classe modalMensagem e com o display none-->
	<div id="mensagemErroDeletar" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('mensagens','Selecione uma mensagem para ser deletada!','erro');
		?>
	</div>
	<div id="mensagemSucessoDeletar" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','Mensagem deletada com sucesso!','sucesso');
		?>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="js/funcoes.js"></script>
	<script src="js/Mensagem.js"></script>
</body>
</html>
