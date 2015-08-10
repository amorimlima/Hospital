<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
//include_once($path['template'].'TemplateForum.php');
$templateGeral = new Template();
//$templateForum = new TemplateForum();
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
                        <div id="Conteudo_Area_box_left">
							<div id="box_topico" class="row">
                            	 <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                    <img src="imgp/foto_aluno.png">
                                 </p>
                                <div class="col-xs-11 col-md-11 col-lg-11">
                                	<p class="dados_aluno">
                                		<span class="aluno_nome">Laura Sampaio</span>
                                		<span class="aluno_data">Postado dia 01/05/2015 às 07:29</span>
                                	</p>
                                	<p>  
                                		<span class="resp_aluno">Os sintomas da esquistossomose e da cólera são diferentes?</span>
                                	</p> 
                                </div>  
                            </div>
                            <div class="box_topico_resp">
                                <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                    <img src="imgp/foto_aluno2.png">
                                 </p>
                                <div class="col-xs-11 col-md-11 col-lg-11">
                                    <div class="dados_aluno">
                                        <span class="aluno_nome">Amauri Cardoso</span>
                                        <span class="aluno_data">Postado dia 01/05/2015 às 07:29</span>
                                    </div>
                                    <div>  
                                        <p class="resp_aluno">Os sintomas da esquistossomose são febre, calafrios, tosse e dores musculares. Já o da cólera o mais normal é a pessoa ter diarréia, náusea e vômitos. Pelos sintomas já dá para perceber que as doenças são bem diferentes!</p>
                                    </div> 
                                </div> 
                            </div>
                            <div class="box_topico_resp">
                                <p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                    <img src="imgp/foto_aluno3.png">
                                 </p>
                                <div class="col-xs-11 col-md-11 col-lg-11">
                                    <div class="dados_aluno">
                                        <span class="aluno_nome">Laura Sampaio</span>
                                        <span class="aluno_data">Postado dia 01/05/2015 às 07:29</span>
                                    </div>
                                    <div>  
                                        <p class="resp_aluno">Os sintomas da esquistossomose são febre, calafrios, tosse e dores musculares. Já o da cólera o mais normal é a pessoa ter diarréia, náusea e vômitos. Pelos sintomas já dá para perceber que as doenças são bem diferentes!</p>
                                    </div> 
                                </div> 
                             </div>
                             <button id="btn_responder" class="btn_form btn_form_forum">RESPONDER</button>
                             <div id="campo_resp">
                            	<p class="foto_aluno col-xs-1 col-md-1 col-lg-1">
                                	<img src="imgp/foto_aluno3.png">
                            	</p>
                            	<div class="col-xs-11 col-md-11 col-lg-11">
                                    <div class="dados_aluno">
                                        <span class="aluno_nome">Laura Sampaio</span>
                                        <span class="aluno_data">Postado dia 01/05/2015 às 07:29</span>
                                        <textarea id="resp_forum" placeholder="Digite aqui sua resposta!"></textarea>
                                    	<button class="btn_form btn_form_forum" id="btn_pronto">PRONTO</button>
                                    </div>
                            	</div> 
                       	 	</div>
                        </div>
                   </div>
                   <div class="col-xs-12 col-md-8 col-lg-4">     
                        <div id="Conteudo_Area_box_right">
							<div id="postagens_recentes">
                            	<p id="postagens_img"></p>
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
    <script src="js/ForumResposta.js"></script> 
</body>
</html>