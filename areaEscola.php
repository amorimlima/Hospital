<?php 

if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
//echo '<pre>';
//print_r($_SESSION);
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
        <title>Área Escola</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/areaHospital.css">
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>    
<body>
    <!-- Kevyn -->
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
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">               
                        <div id="Conteudo_Area_box_left">
                            <div id="box_relatorios">
                                <p id="topo_relatorios"></p>
                                <div id="grafico_container">
                                    <div id="area_grafico">
                                        <div id="topo_grafico">
                                            <div id="header_grafico">
                                                <div id="seta_graph_cima"></div>
                                            </div>
                                        </div>
                                        <div id="leg_left">
                                            <div class="legenda_graph">100</div>
                                            <div class="legenda_graph">90</div>
                                            <div class="legenda_graph">80</div>
                                            <div class="legenda_graph">70</div>
                                            <div class="legenda_graph">60</div>
                                            <div class="legenda_graph">50</div>
                                            <div class="legenda_graph">40</div>
                                            <div class="legenda_graph">30</div>
                                            <div class="legenda_graph">20</div>
                                            <div class="legenda_graph">10</div>
                                        </div>
                                        <div id="barras_grafico">
                                            <div id="grafico_relatorio">
                                                <div class="escola" id="escola1"><div id="bar1" class="graph_bar"></div></div>
                                                <div class="escola" id="escola2"><div id="bar2" class="graph_bar"></div></div>
                                                <div class="escola" id="escola3"><div id="bar3" class="graph_bar"></div></div>
                                                <div class="escola" id="escola4"><div id="bar4" class="graph_bar"></div></div>
                                                <div class="escola" id="escola5"><div id="bar5" class="graph_bar"></div></div>
                                                <div class="escola" id="escola6"><div id="bar6" class="graph_bar"></div></div>
                                                <div class="escola" id="escola7"><div id="bar7" class="graph_bar"></div></div>
                                                <div class="escola" id="escola8"><div id="bar8" class="graph_bar"></div></div>
                                                <div class="escola" id="escola9"><div id="bar9" class="graph_bar"></div></div>
                                                <div class="escola" id="escola10"><div id="bar10" class="graph_bar"></div></div>
                                                <div id="seta_graph_baixo"></div>
                                            </div>
                                        </div>
                                        <div id="leg_bottom">
                                            <div id="escola1" class="escola_numero"><p>Escola 1</p></div>
                                            <div id="escola2" class="escola_numero"><p>Escola 2</p></div>
                                            <div id="escola3" class="escola_numero"><p>Escola 3</p></div>
                                            <div id="escola4" class="escola_numero"><p>Escola 4</p></div>
                                            <div id="escola5" class="escola_numero"><p>Escola 5</p></div>
                                            <div id="escola6" class="escola_numero"><p>Escola 6</p></div>
                                            <div id="escola7" class="escola_numero"><p>Escola 7</p></div>
                                            <div id="escola8" class="escola_numero"><p>Escola 8</p></div>
                                            <div id="escola9" class="escola_numero"><p>Escola 9</p></div>
                                            <div id="escola10" class="escola_numero"><p>Escola 10</p></div>
                                        </div>
                                    </div>
                                    <div id="footer_grafico">
                                        <div id="bt_baixar_relatorio"><p>BAIXAR RELATORIO</p></div>
                                    </div>
                                </div>
                                <div id="aviso_mobile_relatorios">
                                    <p>A visualização dos gráficos do relatório não está disponível em dispositivos móveis.</p>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">     
                        <div id="Conteudo_Area_box_right">
                            <div id="box_livros" class="box_left">
                                <p id="topo_livros"></p>
                                <div id="bt_livro_container">
                                    <a href="livros.php?ano_1"><p class="bt_livro_ano"><span class="livro_ano" id="livro_1_ano">1º Ano</span></p></a>
                                    <a href="livros.php?ano_2"><p class="bt_livro_ano"><span class="livro_ano" id="livro_2_ano">2º Ano</span></p></a>
                                    <a href="livros.php?ano_3"><p class="bt_livro_ano"><span class="livro_ano" id="livro_3_ano">3º Ano</span></p></a>
                                    <a href="livros.php?ano_4"><p class="bt_livro_ano"><span class="livro_ano" id="livro_4_ano">4º Ano</span></p></a>
                                    <a href="livros.php?ano_5"><p class="bt_livro_ano"><span class="livro_ano" id="livro_5_ano">5º Ano</span></p></a>
                                </div>
                            </div>
                            <div id="box_mensagens" class="box_left">
                                <p id="topo_mensagens"><span class="msg_label">1</span></p>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>REMETENTE</th>
                                            <th>ASSUNTO</th>
                                            <th>DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="mensagem_nao_lida">
                                            <td>Laura Sampaio</td>
                                            <td>Aula 12</td>
                                            <td>02/03/2015</td>
                                        </tr>
                                        <tr>
                                            <td>Talita Lourenço</td>
                                            <td>Reposição</td>
                                            <td>02/03/2015</td>
                                        </tr>
                                        <tr>
                                            <td>Maurício Santos</td>
                                            <td>Dúvida ex. 3</td>
                                            <td>01/03/2015</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="box_carregar" class="box_left">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div id="bt_carregar"></div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div id="contaier_boxes_carregar">
                                            <div class="box_carregar">
                                                <div class="box_carregar_conteudo">
                                                    <div class="box_carregar_icon" id="icon_hiperlink_sm"></div>
                                                    <p class="box_carregar_legenda">Hiperlink</p>
                                                </div>
                                            </div>
                                            <div class="box_carregar">
                                                <div class="box_carregar_conteudo">
                                                    <div class="box_carregar_icon" id="icon_video_sm"></div>
                                                    <p class="box_carregar_legenda">Video</p>
                                                </div>
                                            </div>
                                            <div class="box_carregar">
                                                <div class="box_carregar_conteudo">
                                                    <div class="box_carregar_icon" id="icon_pdf_sm"></div>
                                                    <p class="box_carregar_legenda">Documento PDF</p>
                                                </div>
                                            </div>
                                            <div class="box_carregar">
                                                <div class="box_carregar_conteudo">
                                                    <div class="box_carregar_icon" id="icon_outros_sm"></div>
                                                    <p class="box_carregar_legenda">Outros</p>
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
	<script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>	
    <script src="js/funcoes.js"></script>

</body>
</html>