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
    <title>Home</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/capitulos.css">
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
  	<div id="container">
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
                            <iframe id="objeto" src="" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" msallowfullscreen="true"></iframe>  	
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                	<div id="Conteudo_Area_box_right">
                        <div id="btn_exercicio">
                        	<div id="btn_exercicio_5_parabens"></div>
                            <div id="btn_exercicio_5_parabens_brilho"></div>
                            <div id="caminho">
                                <div class="row">
                                    <div class="linha linha_atividade1">
                                        <span id="HCB_1o_5cap/2_Avaliacao_Inicial_pt2" class="tema obj_icone obj_icone20_1"></span>
                                        <span id="HCB_1o_5cap/3_Texto_INMETRO" class="tema obj_icone obj_icone20_2"></span>
                                        <span id="HCB_1o_5cap/4_Atividade_quarto" class="tema obj_icone obj_icone20_3"></span>
                                        <span id="HCB_1o_5cap/5_videoTomada" class="tema obj_icone obj_icone20_4"></span>
                                        <span id="HCB_1o_5cap/6_Video_Cocorico" class="tema obj_icone obj_icone20_5"></span>
                                        <span id="HCB_1o_5cap/7_Curiosidade_Pratinha" class="tema obj_icone obj_icone20_6"></span>
                                        <span id="HCB_1o_5cap/8_Seguranca_na_Cozinha" class="tema obj_icone obj_icone20_7"></span>
                                        <span id="HCB_1o_5cap/9_Labirinto" class="tema obj_icone obj_icone20_8"></span>
                                        <span id="HCB_1o_5cap/10_Avaliacao_Inicial_pt1" class="tema obj_icone obj_icone20_9"></span>
                                        <span id="HCB_1o_5cap/11_Atividade_Ruidos_Sala" class="tema obj_icone obj_icone20_10"></span>
                                        <span id="HCB_1o_5cap/12_Atividade_Inicial_Meio_Ambiente" class="tema obj_icone obj_icone20_11"></span>
                                        <span id="HCB_1o_5cap/13_Texto_Reciclagem" class="tema obj_icone obj_icone20_12"></span>
                                        <span id="HCB_1o_5cap/14_Questoes_certo_ou_errado" class="tema obj_icone obj_icone20_13"></span>
                                        <span id="HCB_1o_5cap/15_Boliche" class="tema obj_icone obj_icone20_14"></span>
                                        <span id="HCB_1o_5cap/16_Entrevista" class="tema obj_icone obj_icone20_15"></span>                         
                                        <span id="HCB_1o_5cap/17_Curiosidade_Pratinha" class="tema obj_icone obj_icone20_16"></span>
                                        <span id="HCB_1o_5cap/18_Video_Papel" class="tema obj_icone obj_icone20_17"></span>
                                        <span id="HCB_1o_5cap/19_Arvore" class="tema obj_icone obj_icone20_18"></span>
                                        <span id="HCB_1o_5cap/20_Avaliacao_final" class="tema obj_icone obj_icone20_19"></span>
                                        <span id="HCB_1o_5cap/21_FB_Final" class="tema obj_icone obj_icone20_20"></span>
                                    </div>
                                    <div class="linha linha_atividade2">
                                        <span id="HCB_2o_5cap/01_Atividade_Inicial_1" class="tema obj_icone obj_icone1"></span>
                                        <span id="HCB_2o_5cap/02_video_segurancaEmCasa" class="tema obj_icone obj_icone2"></span>
                                        <span id="HCB_2o_5cap/03_Perigos_banheiro" class="tema obj_icone obj_icone3"></span>
                                        <span id="HCB_2o_5cap/04_AvaliacaoInicial_2" class="tema obj_icone obj_icone4"></span>
                                        <span id="HCB_2o_5cap/05_Leitura" class="tema obj_icone obj_icone5"></span>
                                        <span id="HCB_2o_5cap/06_quebracabeca" class="tema obj_icone obj_icone6"></span>
                                        <span id="HCB_2o_5cap/07_Entrevista" class="tema obj_icone obj_icone7"></span>
                                        <span id="HCB_2o_5cap/08_video_transito" class="tema obj_icone obj_icone8"></span>
                                        <span id="HCB_2o_5cap/09_atividade_inicial_3" class="tema obj_icone obj_icone9"></span>
                                        <span id="HCB_2o_5cap/10_video_monica" class="tema obj_icone obj_icone10"></span>
                                        <span id="HCB_2o_5cap/11_Pratinha_Cipa" class="tema obj_icone obj_icone11"></span>
                                        <span id="HCB_2o_5cap/12_Pintar_ColetaSeletiva" class="tema obj_icone obj_icone12"></span>
                                        <span id="HCB_2o_5cap/13_Avaliacao_Final" class="tema obj_icone obj_icone13"></span>
                                        <span id="HCB_2o_5cap/14_FB_Final" class="tema obj_icone obj_icone14"></span>                                     
                                    </div>
                                    <div class="linha linha_atividade3">
                                        <span id="HCB_3o_5cap/1_avaliacao_inicial_pt_1" class="tema obj_icone obj_icone15_1"></span>
                                        <span id="HCB_3o_5cap/2_ComodosDaCasa" class="tema obj_icone obj_icone15_2"></span>
                                        <span id="HCB_3o_5cap/3_Memoria" class="tema obj_icone obj_icone15_3"></span>
                                        <span id="HCB_3o_5cap/4_AvaliacaoInicial_Ruido" class="tema obj_icone obj_icone15_4"></span>
                                        <span id="HCB_3o_5cap/5_Atencao_Barulhos" class="tema obj_icone obj_icone15_5"></span>
                                        <span id="HCB_3o_5cap/6_Pratinha_musicaAlta" class="tema obj_icone obj_icone15_6"></span>
                                        <span id="HCB_3o_5cap/7_AvaliacaoInicial_RespAmbiental" class="tema obj_icone obj_icone15_7"></span>
                                        <span id="HCB_3o_5cap/8_CacaPalavras" class="tema obj_icone obj_icone15_8"></span>
                                        <span id="HCB_3o_5cap/8.2_videoLixo" class="tema obj_icone obj_icone15_9"></span>
                                        <span id="HCB_3o_5cap/9_JogoTabuleiro" class="tema obj_icone obj_icone15_10"></span>
                                        <span id="HCB_3o_5cap/10_Pratinha_desperdicio" class="tema obj_icone obj_icone15_11"></span>
                                        <span id="HCB_3o_5cap/11_SaibaMais_MensagemSecreta" class="tema obj_icone obj_icone15_12"></span>
                                        <span id="HCB_3o_5cap/12_Entrevista" class="tema obj_icone obj_icone15_13"></span>
                                        <span id="HCB_3o_5cap/13_AvaliacaoFinal" class="tema obj_icone obj_icone15_14"></span>
                                        <span id="HCB_3o_5cap/14_FB_Final" class="tema obj_icone obj_icone15_15"></span>     
                                    </div>
                                    <div class="linha linha_atividade4">
                                        <span id="HCB_4o_5cap/1_avaliacao_inicial_pt_1" class="tema obj_icone obj_icone15_1"></span>
                                        <span id="HCB_4o_5cap/2_Leitura_EPC-EPI" class="tema obj_icone obj_icone15_2"></span>
                                        <span id="HCB_4o_5cap/3_Entrevista_segurancaTrabalho" class="tema obj_icone obj_icone15_3"></span>
                                        <span id="HCB_4o_5cap/4_Diversao-Bingo" class="tema obj_icone obj_icone15_4"></span>
                                        <span id="HCB_4o_5cap/5_Avaliacao_inicial_pt_2" class="tema obj_icone obj_icone15_5"></span>
                                        <span id="HCB_4o_5cap/6_video-ergonomia" class="tema obj_icone obj_icone15_6"></span>
                                        <span id="HCB_4o_5cap/7_Na_Pratica" class="tema obj_icone obj_icone15_7"></span>
                                        <span id="HCB_4o_5cap/8_avaliacao_inicial_pt_3" class="tema obj_icone obj_icone15_8"></span>
                                        <span id="HCB_4o_5cap/9_matematicaContas" class="tema obj_icone obj_icone15_9"></span>
                                        <span id="HCB_4o_5cap/10_Arte_bombeiro" class="tema obj_icone obj_icone15_10"></span>
                                        <span id="HCB_4o_5cap/11_Pratinha_Curiosidade" class="tema obj_icone obj_icone15_11"></span>
                                        <span id="HCB_4o_5cap/12_Texto_Queimaduras" class="tema obj_icone obj_icone15_12"></span>
                                        <span id="HCB_4o_5cap/13_Producao_Texto_Cartaz" class="tema obj_icone obj_icone15_13"></span>
                                        <span id="HCB_4o_5cap/14_avaliacaoFinal" class="tema obj_icone obj_icone15_14"></span>
                                        <span id="HCB_4o_5cap/15_FB_Final" class="tema obj_icone obj_icone15_15"></span>
                                    </div>
                                    <div class="linha linha_atividade5">
                                        <span id="HCB_5o_5cap/1_avaliacao_inicial_pt_1" class="tema obj_icone obj_icone15_1"></span>
                                        <span id="HCB_5o_5cap/2_videoErgonomia" class="tema obj_icone obj_icone15_2"></span>
                                        <span id="HCB_5o_5cap/3_Pratinha_Curiosidade" class="tema obj_icone obj_icone15_3"></span>
                                        <span id="HCB_5o_5cap/4_Napratica_exercicios" class="tema obj_icone obj_icone15_4"></span>
                                        <span id="HCB_5o_5cap/5_AvaliacaoInicial_pt2_Acidentes" class="tema obj_icone obj_icone15_5"></span>
                                        <span id="HCB_5o_5cap/6_Leitura_Cruzadinha" class="tema obj_icone obj_icone15_6"></span>
                                        <span id="HCB_5o_5cap/7_Entrevista" class="tema obj_icone obj_icone15_7"></span>
                                        <span id="HCB_5o_5cap/8_AvaliacaoInicial_pt3_Incendio" class="tema obj_icone obj_icone15_8"></span>
                                        <span id="HCB_5o_5cap/9_Matematica_PainelPosicoes" class="tema obj_icone obj_icone15_9"></span>
                                        <span id="HCB_5o_5cap/10_Pratinha_Curiosidade" class="tema obj_icone obj_icone15_10"></span>
                                        <span id="HCB_5o_5cap/11_saibamaisAlcool" class="tema obj_icone obj_icone15_11"></span>
                                        <span id="HCB_5o_5cap/12_AvaliacaoInicial_pt4_MapaRiscos" class="tema obj_icone obj_icone15_12"></span>
                                        <span id="HCB_5o_5cap/13_Fazer_MapadeRiscos" class="tema obj_icone obj_icone15_13"></span>
                                        <span id="HCB_5o_5cap/14_AvaliacaoFinal" class="tema obj_icone obj_icone15_14"></span>
                                        <span id="HCB_5o_5cap/15_FB_Final" class="tema obj_icone obj_icone15_15"></span>
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
    <script src="js/Capitulos.js"></script>
  </body>
</html>