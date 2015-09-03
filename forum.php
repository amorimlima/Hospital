<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateForum.php');
include_once($path['controller'].'ForumTopicoController.php');
$templateGeral = new Template();
$templateForum = new TemplateForum();
$topicoController = new ForumTopicoController();
$topicos = $topicoController->selectAll();
//print_r($topicos);
?>
<!DOCTYPE html>
<html lang="pt-br">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Fórum</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">    	
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
        <link rel="stylesheet" type="text/css" href="css/forum.css">        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->        
    </head>    
<body>
	<!--Conteudo Geral-->
    <div id="container">
    	<!--Topo-->
    	<div class="row">
            <?php 
				$templateGeral->topoSite();
			?>      
        </div>
        <!--Conteudo Central-->
        <div id="Conteudo_Area">
            <div class="row">
               <div class="col-xs-12 col-md-12 col-lg-12" id="area_geral">
                    <div id="Conteudo_Area_box_Grande">
                    	<div class="row">
                        	<div class="col-xs-12 col-md-12 col-lg-12">
                                <div id="box_forum_top">
                                    <p class="txt_pergunta">TEM ALGUMA PERGUNTA?</p>
                                    <div role="form" id="frm_pergunta">
                                        <select id="topico" placeholder="Tópico">
                                            <option value="" selected disabled>Tópico</option>
                                            <?php
                                            foreach ($topicos as $t){
                                                echo '<option value="'.$t->getFrt_id().'">'.$t->getFrt_topico().'</option>';
                                            }
                                          ?>
                                        </select>
                                        <textarea id="box_pergunta" class="form-control" rows="5" placeholder="Digite aqui sua pergunta!"></textarea>
                                        <button onClick="enviar()" id="btn_perguntar" class="btn_form btn_form_forum">PERGUNTAR</button>
                                    </div>
                                </div>
                             </div>
                       		<div class="col-xs-12 col-md-12 col-lg-12">
                                <div id="box_forum_botton">
                                    <p id="txt_postagens">POSTAGENS RECENTES</p>
                                    <p id="txt_pesquisa">
                                        <input id="txt_pesquisa_input" onkeypress="autoComplete()" type="text" placeholder="Pesquise no fórum!">
                                    </p>
                                    <div id="box_alunos_container">
                                        <div id="box_alunos">
                                             <?php $templateForum->listaAlunos()?>                           
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>              	
        </div>
        <footer>
            <div class="row" id="rodape"></div>
        </footer>
    </div>
	
	<!-- Modais com as mensagens de erro/sucesso -->
	<div id="forumErroVazia" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('forum','Preencha o campo da pergunta!','erro');
		?>
	</div>
	<div id="forumErroInesperado" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('forum','Houve um erro inesperado. tente mais tarde!','erro');
		?>
	</div>
	<div id="forumPerguntaSucesso" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('forum','Pergunta criada com sucesso!','sucesso');
		?>
	</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="js/funcoes.js"></script>
    <script src="js/Forum.js"></script> 
</body>
</html>