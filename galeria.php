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
        <title>Galeria</title>
        
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">        
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
        <link rel="stylesheet" type="text/css" href="css/galeria.css">
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
           <?php 
				$templateGeral->topoSite();
			?>       
        </div>
        <div id="Conteudo_Area">
            <div class="row">
               <div class="col-xs-12 col-md-12 col-lg-8">
                    <div id="Conteudo_Area_box_left">
                        <div id="box_galeria">
                            <p id="topo_galeria"></p>
                            <div id="box_gal_pesquisa">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div id="box_cat">
                                        <p id="box_right_1_box_titulo_1" class="titulo">CATEGORIA</p>
                                        <div class="box_right_1_box_select">
                                            <input type="text" id="select_text">
                                            <div id="box_select">
                                                <span id="1" class="selecionado">Vídeo</span>
                                                <span id="2" class="selecionado">Hiperlink</span>
                                                <span id="3" class="selecionado">PDF</span>
                                                <span id="4" class="selecionado">Audio</span>
                                                <span id="5" class="selecionado">Foto</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div id="box_ass">
                                        <p id="box_right_1_box_titulo_2" class="titulo">ASSUNTO</p>
                                        <div class="box_right_1_box_select">
                                            <input type="text" id="assuno_text" placeholder="Digite o assunto que deseja pesquisar!">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box_left_gal_results">
                            <p id="box_left_box_titulo_results" class="titulo">RESULTADOS DA PESQUISA</p>
                            <div id="box_left_resultados_container">
                                <div class="gal_caixa1">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">Os riscos do tabagismo</div>
                                        <div class="gal_caixa_texto_sub">Postado por Isabela Oliveira dia 15/04/2015 às 21:16</div>
                                        <div class="gal_caixa_texto_corpo">O documentário gravado por aluno de Medicina da Unisaúde apresenta as consequências do tabagismo para o corpo do homem e os riscos diretos envolvidos nessa prática.</div>
                                    </div>
                                </div>
                                <div class="gal_caixa2">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">O que é ser fumante passivo?</div>
                                        <div class="gal_caixa_texto_sub">Postado por Vitor Velasques dia 10/04/2015 às 17:34</div>
                                        <div class="gal_caixa_texto_corpo">Reportagem da TV Saúde sobre as consequências de conviver com um fumante.</div>
                                    </div>
                                </div>
                                <div class="gal_caixa1">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">Qual a relação entre câncer de pulmão e o tabagismo?</div>
                                        <div class="gal_caixa_texto_sub">Postado por Mateus Salgado dia 01/04/2015 às 13:49</div>
                                        <div class="gal_caixa_texto_corpo">Entenda os perigos da prática do tabagismo e dos riscos que o fumante se expõe.</div>
                                    </div>
                                </div>
                                <div class="gal_caixa2">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">Campanha do Ministério da Saúde sobre Tabagismo</div>
                                        <div class="gal_caixa_texto_sub">Postado por Mateus Salgado dia 01/04/2015 às 13:49</div>
                                        <div class="gal_caixa_texto_corpo">Vídeo para conscientização da população sobre o tabagismo veiculada em 2008.</div>
                                    </div>
                                </div>

                                <!-- Daqui para baixo, só teste -->

                                <div class="gal_caixa1">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">Os riscos do tabagismo</div>
                                        <div class="gal_caixa_texto_sub">Postado por Isabela Oliveira dia 15/04/2015 às 21:16</div>
                                        <div class="gal_caixa_texto_corpo">O documentário gravado por aluno de Medicina da Unisaúde apresenta as consequências do tabagismo para o corpo do homem e os riscos diretos envolvidos nessa prática.</div>
                                    </div>
                                </div>
                                <div class="gal_caixa2">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">O que é ser fumante passivo?</div>
                                        <div class="gal_caixa_texto_sub">Postado por Vitor Velasques dia 10/04/2015 às 17:34</div>
                                        <div class="gal_caixa_texto_corpo">Reportagem da TV Saúde sobre as consequências de conviver com um fumante.</div>
                                    </div>
                                </div>
                                <div class="gal_caixa1">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">Qual a relação entre câncer de pulmão e o tabagismo?</div>
                                        <div class="gal_caixa_texto_sub">Postado por Mateus Salgado dia 01/04/2015 às 13:49</div>
                                        <div class="gal_caixa_texto_corpo">Entenda os perigos da prática do tabagismo e dos riscos que o fumante se expõe.</div>
                                    </div>
                                </div>
                                <div class="gal_caixa2">
                                    <div class="gal_video">
                                        <div class="gal_video_icon"></div>
                                        <div class="gal_video_texto">VIDEO</div>
                                    </div>
                                    <div class="gal_caixa_texto">
                                        <div class="gal_caixa_texto_titulo">Campanha do Ministério da Saúde sobre Tabagismo</div>
                                        <div class="gal_caixa_texto_sub">Postado por Mateus Salgado dia 01/04/2015 às 13:49</div>
                                        <div class="gal_caixa_texto_corpo">Vídeo para conscientização da população sobre o tabagismo veiculada em 2008.</div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                    <div id="Conteudo_Area_box_right">
                        <div id="box_mais_vistos">
                            <p id="topo_mais_vistos"></p>
                            <div id="container_mv_box">
                                <div class="">
                                    <div class="mv_caixa">
                                        <div class="mv_caixa_icon">
                                            <div class="mv_video">
                                                <div class="icon_video"></div>
                                                <div class="icon_texto">Os riscos do cigarro</div>
                                            </div>
                                        </div>
                                        <div class="txt_mv_caixa">
                                            <p class="txt_mv_caixa_titulo">Os riscos do cigarro</p>
                                            <p class="txt_mv_caixa_sub">Postado por Miriam Sagawa </p>
                                            <p class="txt_mv_caixa_data">03/02/2015 às 15:16</p>
                                            
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mv_caixa">
                                        <div class="mv_caixa_icon">
                                            <div class="mv_foto">
                                                <div class="icon_foto"></div>
                                                <div class="icon_texto">Parques ecológicos</div>
                                            </div>
                                        </div>
                                        <div class="txt_mv_caixa">
                                            <p class="txt_mv_caixa_titulo">Parques ecológicos</p>
                                            <p class="txt_mv_caixa_sub">Postado por Maria Aparecida </p>
                                            <p class="txt_mv_caixa_data">12/01/2015 às 17:34</p>
                                         
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mv_caixa">
                                        <div class="mv_caixa_icon">
                                            <div class="mv_jogo">
                                                <div class="icon_jogo"></div>
                                                <div class="icon_texto">Reciclagem - O Jogo</div>
                                            </div>
                                        </div>
                                        <div class="txt_mv_caixa">
                                            <p class="txt_mv_caixa_titulo">Reciclagem - O Jogo</p>
                                            <p class="txt_mv_caixa_sub">Postado por Mateus Salgado </p>
                                            <p class="txt_mv_caixa_data">26/04/2015 às 13:49</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="box_carregar">
                            <div id="carregarContainer">
                                <div class="botaoCarregar"></div>
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
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="js/funcoes.js"></script>
    <script src="js/Galeria.js"></script>
</body>
</html>