<?php
if (!isset($_SESSION['PATH_SYS'])) {
	require_once '_loadPaths.inc.php';
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'] . 'Template.php');
include_once($path['template'] . 'TemplateGaleria.php');
$templateGeral = new Template();
$templateGaleria = new TemplateGaleria();
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
		<link rel="stylesheet" href="css/modulos/formulario.css">
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
												<div id="select_text"></div>
												<div id="box_select">
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
									</div>
								</div>
							</div>
							<div id="form_novo_arquivo" style="display: none;">
								<div>
									<?php
										$templateGaleria->geraFormulario();
									?>			
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-12 col-lg-4">
						<div id="Conteudo_Area_box_right">
							<div id="box_mais_vistos">
								<p id="topo_mais_vistos"></p>
								<div id="container_mv_box">
									<div class="row">
										<div class="mv_caixa">
										</div>
									</div>
									<div class="">
										<div class="mv_caixa">
										</div>
									</div>
								</div>
							</div>
							<?php
								$templateGaleria->botaoUpload();
							?>
						</div>
                        <div class="modal fade in" id="myModal" role="dialog" style="display: none;">
                            <div class="modal-dialog modal-sm">
                                <div class="borda_laranja">
                                    <div class="modal-body">
                                        <div id="tipoMensagem"></div>
                                        <div class="modal-body-container">
                                            <div class="text-modal">
                                                <p class="txt_laranja" id="modalTexto"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn_laranja botao_modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-backdrop fade in" style="display: none;"></div>
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
		<script src="js/lib/jquery.maskedinput.js" type="text/javascript"></script>
		<script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
		<script src="js/funcoes.js"></script>
		<script src="js/modulos/formulario.js"></script>
		<script src="js/Galeria.js"></script>
		<?php
			$templateGaleria->modalConfirmacaoUpload();
    	?>
	</body>
</html>