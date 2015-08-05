<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateForum.php');
$templateGeral = new Template();
$templateForum = new TemplateForum();
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
    	<link rel="stylesheet" type="text/css" href="css/forum.css">
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
                                    <p id="txt_pergunta">TEM ALGUMA PERGUNTA?</p>
                                    <form role="form" id="frm_pergunta">
                                        <textarea id="box_pergunta" class="form-control" rows="5" placeholder="Digite aqui sua pergunta!"></textarea>
                                        <button id="btn_perguntar">PERGUNTAR</button>
                                    </form>
                                </div>
                             </div>
                       		<div class="col-xs-12 col-md-12 col-lg-12">
                                <div id="box_forum_botton">
                                    <p id="txt_postagens">POSTAGENS RECENTES</p>
                                    <p id="txt_pesquisa">
                                        <input type="text" placeholder="Pesquise no fórum!">
                                    </p>
                                    <div id="box_alunos">
                                        <div class="perg_box cx_rosa row">
                                            <div class="perg_box_1 col-xs-12 col-md-8 col-lg-8">
                                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                                <p class="nome_aluno">Laura Sampaio</p>
                                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                                            </div>                                
                                            <div class="perg_box_2 col-xs-12 col-md-4 col-lg-4">
                                                <p class="qtd_visu cx_brancaP"><span>8</span> visualizações</p>
                                                <p class="qtd_resp cx_brancaP"><span>3</span> respostas</p>
                                            </div>  
                                        </div>
                                        <div class="perg_box cx_branca row">
                                            <div class="perg_box_1 col-xs-12 col-md-8 col-lg-8">
                                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                                <p class="nome_aluno">Laura Sampaio</p>
                                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                                            </div>                                
                                            <div class="perg_box_2 col-xs-12 col-md-4 col-lg-4">
                                                <p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
                                                <p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
                                            </div>  
                                        </div>
                                        <div class="perg_box cx_branca row">
                                            <div class="perg_box_1 col-xs-12 col-md-8 col-lg-8">
                                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                                <p class="nome_aluno">Laura Sampaio</p>
                                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                                            </div>                                
                                            <div class="perg_box_2 col-xs-12 col-md-4 col-lg-4">
                                                <p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
                                                <p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
                                            </div>  
                                        </div>
                                        <div class="perg_box cx_branca row">
                                            <div class="perg_box_1 col-xs-12 col-md-8 col-lg-8">
                                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                                <p class="nome_aluno">Laura Sampaio</p>
                                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                                            </div>                                
                                            <div class="perg_box_2 col-xs-12 col-md-4 col-lg-4">
                                                <p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
                                                <p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
                                            </div>  
                                        </div>
                                        <div class="perg_box cx_branca row">
                                            <div class="perg_box_1 col-xs-12 col-md-8 col-lg-8">
                                                <p class="foto_aluno"><img src="imgp/foto_aluno.png"></p>
                                                <p class="perg_aluno">QUAL É A DIFERENÇA ENTRE ESQUISTOSSOMOSE E CÓLERA?</p>
                                                <p class="nome_aluno">Laura Sampaio</p>
                                                <p class="post_data">Postado dia 02/05/2015 às 15:30</p>
                                            </div>                                
                                            <div class="perg_box_2 col-xs-12 col-md-4 col-lg-4">
                                                <p class="qtd_visu cx_rosaP"><span>8</span> visualizações</p>
                                                <p class="qtd_resp cx_rosaP"><span>3</span> respostas</p>
                                            </div>  
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/funcoes.js"></script>
</body>
</html>