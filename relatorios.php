<?php
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php';
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');
include_once($path['template'].'TemplateRelatorio.php');
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'SerieController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path["controller"]."LiberarCapituloController.php");


$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
$templateRelatorio = new TemplateRelatorio();
$usuarioController = new UsuarioController();
$escolaController = new EscolaController();
$serieController = new SerieController();
$liberarCapituloController = new LiberarCapituloController();


$professor = $usuarioController->selectByPerfilUsuario(2);
$serie = $serieController->selectAll();
$escolas = $escolaController->selectAll();

$logado = unserialize($_SESSION['USR']);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Relatórios</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/box-modal.css">
    <link rel="stylesheet" type="text/css" href="css/relatorios.css">
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
  	<input type="hidden" value="<?php echo $logado['id'];?>" name="idUsuario" id="idUsuario">
  	<div id="container">
        <div class="row">
			<?php
            	$templateGeral->topoSite();
            ?>
        </div>
        <div id="Conteudo_Area">
               <div class="col-xs-12 col-md-12 col-lg-12"  id="area_geral">
                    <div id="Conteudo_Area_box_Grande">
                        <div class="container_conteudo_geral">
                        	<div class="row">
                        		<div class="col-sm-12 col-md-9">
                        			<span class="header"></span>
									<div id="conteudoPrincipal" class="conteudo_principal">
										<div id="tipo_grafico_picker" class="tipo_grafico_picker">Acessos e Downloads na Galeria (em %)</div>
										<div class="tipo_grafico_picker_opcoes">
											<div id="graficoGaleria" class="option_selected">Acessos e Downloads na Galeria (em %)</div>
											<div id="graficoExercicios">Exercícios (em %)</div>
										</div>
										<div class="listagem_perfis_graficos">
											<div id="grafico1" class="grafico">
												<div class="lista_itens_grafico">
													<?php //$templateRelatorio->graficoEscolas(); ?>
												</div>
											</div>
											<div id="grafico2" class="grafico" style="display: none;">
												<div class="lista_itens_grafico">	
												</div>
											</div>
                                        </div>
										<div class="infos_grafico">
											<img src="img/ic_voltar_g.png" id="btn_voltar" class="btn_voltar"></span>
											<div class="row">
												<div class="col-md-4">
													<div class="graf_info itens_info">Escolas</div>
												</div>
												<div class="col-md-8">
													<div class="graf_info charts_info">
														<span style="left: 0%">0%</span>
														<span style="left: 10%">10%</span>
														<span style="left: 20%">20%</span>
														<span style="left: 30%">30%</span>
														<span style="left: 40%">40%</span>
														<span style="left: 50%">50%</span>
														<span style="left: 60%">60%</span>
														<span style="left: 70%">70%</span>
														<span style="left: 80%">80%</span>
														<span style="left: 90%">90%</span>
														<span style="left: 100%">100%</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="liberarCapituloContainer" class="liberar_capitulo_container" style="display:none">
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="conteudo_lateral">
										<div class="form_filtros">
											<h2>Gerar relatório</h2>
											<label for="filtroLivro">Livro</label>
											<select id="filtroLivro">
												<option val="" selected>Todos</option>
											</select>
											<label for="filtroCapitulo">Capítulo</label>
											<select id="filtroCapitulo">
												<option val="" selected>Todos</option>
											</select>
											<label for="filtroSala">Sala</label>
											<select id="filtroSala">
												<option val="" selected>Todos</option>
											</select>
											<button id="visualizarRelatorio">Visualizar</button>
											<button id="baixarRelatorio" class="btn_primary">Baixar relatório</button>
										</div>
										<div class="legenda_grafico">
											<h2>Legenda</h2>
											<div id="legendaGrafico1">
												<div><img src="img/leg_graf_acessos.png" alt="Quantidade de acessos à galeria"><span>Quantidade de acessos à galeria</span></div>
												<div><img src="img/leg_graf_downloads.png" alt="Quantidade de downloads de conteúdo"><span>Quantidade de downloads de conteúdo</span></div>
											</div>
											<div id="legendaGrafico2" style="display: none;">
												<div><img src="img/leg_graf_acertos_pre.png" alt="Acertos - pré-avaliação"><span>Acertos - pré-avaliação</span></div>
												<div><img src="img/leg_graf_acertos_pos.png" alt="Acertos - pós-avaliação"><span>Acertos - pós-avaliação</span></div>
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

	<!--Sempre que for utilizar uma mensagem, criar uma div com a classe modalMensagem e com o display none-->
	<div id="mensagemCapituloLiberado" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('livros','Capítulo liberado com sucesso!','sucesso');
		?>
	</div>
	<div id="mensagemSucessoDeletar" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('livros','Capítulo bloqueado com sucesso!','sucesso');
		?>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="js/funcoes.js"></script>
    <script src="js/relatorios.js"></script>
</body>
</html>
