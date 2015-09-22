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
        <title>Área Hospital</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/areaProfessor.css">
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
                                                <div id="seta_graph_laranja"></div>
                                                <div id="seta_graph_azul"></div>
                                            </div>
                                        </div>
                                        <div id="barras_grafico">
                                            <div id="grafico_relatorio">
                                                <div class="aluno" id="aluno1"><div id="bar1" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno2"><div id="bar2" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno3"><div id="bar3" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno4"><div id="bar4" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno5"><div id="bar5" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno6"><div id="bar6" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno7"><div id="bar7" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno8"><div id="bar8" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno9"><div id="bar9" class="graph_bar"></div></div>
                                                <div class="aluno" id="aluno10"><div id="bar10" class="graph_bar"></div></div>
                                                <div id="leg_topo">QUANTIDADE E TEMPO DE ACESSO POR CAPÍTULO(POR ALUNO)</div>
                                            </div>
                                            <div>
                                                
                                            </div>
                                            <div id="leg_esq" class="leg_lateral">
                                                <div class="leg_graph_esq">200</div>
                                                <div class="leg_graph_esq">180</div>
                                                <div class="leg_graph_esq">160</div>
                                                <div class="leg_graph_esq">140</div>
                                                <div class="leg_graph_esq">120</div>
                                                <div class="leg_graph_esq">100</div>
                                                <div class="leg_graph_esq">80</div>
                                                <div class="leg_graph_esq">60</div>
                                                <div class="leg_graph_esq">40</div>
                                                <div class="leg_graph_esq">20</div>
                                                <div id="leg_temp">TEMPO DE ACESSO (em minutos)</div>   
                                            </div>
                                            <div id="leg_dir" class="leg_lateral">
                                                <div class="leg_graph_dir">50</div>
                                                <div class="leg_graph_dir">45</div>
                                                <div class="leg_graph_dir">40</div>
                                                <div class="leg_graph_dir">35</div>
                                                <div class="leg_graph_dir">30</div>
                                                <div class="leg_graph_dir">25</div>
                                                <div class="leg_graph_dir">20</div>
                                                <div class="leg_graph_dir">15</div>
                                                <div class="leg_graph_dir">10</div>
                                                <div class="leg_graph_dir">5</div>
                                                <div id="leg_quant">QUANTIDADE DE ACESSOS</div>
                                            </div>
                                        </div>
                                        <div id="leg_bottom">
                                            <div id="aluno1" class="aluno_foto"><p><img src="imgp/foto_aluno8.png"></p></div>
                                            <div id="aluno2" class="aluno_foto"><p><img src="imgp/foto_aluno7.png"></p></div>
                                            <div id="aluno3" class="aluno_foto"><p><img src="imgp/foto_aluno6.png"></p></div>
                                            <div id="aluno4" class="aluno_foto"><p><img src="imgp/foto_aluno4.png"></p></div>
                                            <div id="aluno5" class="aluno_foto"><p><img src="imgp/foto_aluno5.png"></p></div>
                                            <div id="aluno6" class="aluno_foto"><p><img src="imgp/foto_aluno6.png"></p></div>
                                            <div id="aluno7" class="aluno_foto"><p><img src="imgp/foto_aluno7.png"></p></div>
                                            <div id="aluno8" class="aluno_foto"><p><img src="imgp/foto_aluno8.png"></p></div>
                                            <div id="aluno9" class="aluno_foto"><p><img src="imgp/foto_aluno9.png"></p></div>
                                            <div id="aluno10" class="aluno_foto"><p><img src="imgp/foto_aluno10.png"></p></div>
                                        </div>
                                    </div>
                                    <div id="footer_grafico">
                                        <div id="bt_baixar_relatorio"><p>DOWNLOAD DO RELATÓRIO</p></div>
                                        <div id="bt_mudar_grupo"><p>MUDAR GRUPO</p></div>
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
	<script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>	
    <script src="js/funcoes.js"></script>

</body>
</html>