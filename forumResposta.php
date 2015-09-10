<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
//echo '<pre>';
//print_r($_SESSION);
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateForumResposta.php');
include_once($path['controller'].'ForumQuestaoController.php');
include_once($path['controller'].'ForumRespostaController.php');
include_once($path['funcao'].'DatasFuncao.php');
$templateGeral = new Template();
$utils = new DatasFuncao();
//echo $utils->dataTimeBRExibicao('2015-10-10 10:10:10');
$templateResposta = new TemplateForumResposta();
$questaoController = new ForumQuestaoController();
$respostasController = new ForumRespostaController();
?>
<!DOCTYPE html>
<html lang="pt-br">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Fórum Resposta</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<link rel="stylesheet" type="text/css" href="css/forumResposta.css">
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
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
                <div class="row">
                   <div class="col-xs-12 col-md-8 col-lg-8">               
                        <div id="Conteudo_Area_box_left" >
                            <div class="conteudoRespostas">
				<?php $templateResposta->listaRespostas($_GET['resp']); ?>
						
                            </div>
                        </div>
                   </div>
                   <div class="col-xs-12 col-md-8 col-lg-4">     
                        <div id="Conteudo_Area_box_right">
							<div id="postagens_recentes">
                            	<p id="postagens_img">
                                	<img src="img/postagens_recentes.png" class="img-responsive" alt=""/>
                                </p>
                                <p id="txt_pesquisa">
                                    <input id="txt_pesquisa_input"  type="text" placeholder="Pesquise no fórum!">
                                </p>
                                <div id="resultadoPesq">
                                	<div id="box_result_pesquisa">  
                                   		<?php $templateResposta->listaQuestoesRecentes(); ?>
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
    <input type="hidden" name="questao" id="questao" value="<?php echo $_GET['resp'];?>">
    <div id="respostaErroVazia" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('forum','Resposta Inválida!','erro');
		?>
	</div>
	<div id="respostaErroInesperado" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('forum','Houve um erro inesperado. tente mais tarde!','erro');
		?>
	</div>
	<div id="respostaSucesso" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('forum','Respondido com sucesso!','sucesso');
		?>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
	
    <script src="js/funcoes.js"></script>
    <script src="js/ForumResposta.js"></script> 
</body>
</html>