<?php
$tipo_escola = [];
if (isset($_GET["tipo_educacao_infantil"])) {
	array_push($tipo_escola, "Educação Infantil");
}
if (isset($_GET["tipo_ensino_fund_1"])) {
	array_push($tipo_escola, "Ensino Fundamental I");
}
if (isset($_GET["tipo_ensino_fund_2"])) {
	array_push($tipo_escola, "Ensino Fundamental II");
}
if (isset($_GET["tipo_ensino_medio"])) {
	array_push($tipo_escola, "Ensino Médio");
}
if (isset($_GET["tipo_tecnico_profissional"])) {
	array_push($tipo_escola, "Ensino Técnico Profissionalizante");
}
if (isset($_GET["tipo_formacao_professores"])) {
	array_push($tipo_escola, "Formação de professores");
}
if (isset($_GET["tipo_outro"])) {
	array_push($tipo_escola, $_GET["tipo_outro_especificacao"]);
}	

$dados_escola = [];
$dados_escola["Ideb"] = isset($_GET["ideb_nulo"]) ? "Não fornecido" : $_GET["ideb"];
$dados_escola["Projetos anteriores"] = isset($_GET["projetos_anteriores_null"]) ? "Não participou de nenhum projeto" : $_GET["projetos_anteriores"];
$dados_escola["Sala de Informática"] = $_GET["sala_info"] == 1 ? "Sim" : "Não";
$acesso_internet;

if ($_GET["sala_info"] == 1) {
	$acesso_internet = $_GET["acesso_internet"] == 1 ? "Sim" : "Não";
}

$atividades_familiares = $_GET["atividades_familia"] == 1 ? $_GET["atividades_familiares"] : "Não";

$dados_pais = [];
$dados_pais["Participam das reuniões de pais"] = $_GET["reuniao_de_pais"];
$dados_pais["Procuram o professor quando têm dúvidas"] = $_GET["procura_professor"];
$dados_pais["Propiciam aos alunos a chance de participar de atividades extracurriculares"] = $_GET["atividades_extra"];
$dados_pais["Permitem aos alunos participar das aulas de reforço"] = $_GET["reforco_rec"];
$dados_pais["Fornecem aos alunos recursos básicos ao rendimento escolar"] = $_GET["recursos_basicos"];
$dados_pais["Participam das atividades recreativas da escola"] = $_GET["atividades_recreativas"];
$dados_pais["Participam dos canais de comunicação da escola com os pais"] = $_GET["canais_comunicacao"];
$dados_pais["Auxiliam os alunos nos deveres de casa"] = $_GET["auxilia_filhos"];
$dados_pais["Acompanham o conteúdo curricular trabalhado em aula"] = $_GET["acompanha_curriculo"];

$sobre_projeto = [];
$sobre_projeto["Motivos para participar do projeto"] = $_GET["motivos_participacao"];
$sobre_projeto["Acessará a plataforma"] = isset($_GET["acesso_plataforma"]) ? "Sim" : "Não";
$sobre_projeto["Download dos materiais e acesso off line"] = isset($_GET["download_offline"]) ? "Sim" : "Não";
$sobre_projeto["Download dos materiais em pdf e impressão de apostilas"] = isset($_GET["download_impressao"]) ? "Sim" : "Não";

$info_salas = [];
$info_salas["1º ano"] = [];
$info_salas["2º ano"] = [];
$info_salas["3º ano"] = [];
$info_salas["4º ano"] = [];
$info_salas["5º ano"] = [];

foreach ($info_salas as $ano => $vetor) {
	$num_ano = substr($ano, 0, 1);

	array_push($info_salas[$ano], $_GET["total_alunos_" . $num_ano . "ano"]);
	array_push($info_salas[$ano], $_GET["total_alunos_part_" . $num_ano . "ano"]);
	array_push($info_salas[$ano], $_GET["total_salas_" . $num_ano . "ano"]);
	array_push($info_salas[$ano], $_GET["total_salas_part_" . $num_ano . "ano"]);
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/pesquisa_pdf.css" rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="logo-container">
						<img src="img/logo/logo_md.png">
					</div>
					<div class="pesquisa_pre_cadastro">
						<div class="identidade_unidade_ensino">
							<h1>Identidade da Unidade de Ensino</h1>
							<div class="tipo_unidade_ensino">
								<h2>Tipo de estabelecimento</h2>
								<div class="info_content">
									<?php
									echo "<ul>";
									foreach ($tipo_escola as $tipo) {
										echo "<li>" . $tipo . "</li>";
									}
									echo "</ul>";

									foreach ($dados_escola as $dado => $valor) {
										echo "<div>";
										echo "<span>" . $dado . ":</span> " . $valor;
										echo "</div>";
									}

									if (!is_null($acesso_internet)) {
										echo "<div>";
										echo "<span>Acesso à internet: " . $acesso_internet . "</span>";
										echo "</div>";
									}
									?>
								</div>
							</div>
							<div class="comunidade_escolar">
								<h2>Sobre a comunidade escolar</h2>
								<div class="info_content">
									<?php
									echo "<div>";
									echo "<div>A escola possui atividades para aumentar o envolvimeno da família?</div> <div>" . ($_GET["atividades_familia"] == 1 ? "Sim" : "Não") . "</div>";
									if ($_GET["atividades_familia"] == 1) {
										echo "<div>";
										echo $atividades_familiares;
										echo "</div>";
									}
									echo "</div>"
									?>
								</div>
								<h2>Dados sobre os pais/responsáveis</h2>
								<div class="info_content">
									<?php
									foreach ($dados_pais as $dado => $valor) {
										echo "<div>";
										echo "<div>" . $dado . ":</div> <div>" . $valor . "</div>";
										echo "</div>";
									}
									?>
								</div>
								<h2>Sobre o Projeto</h2>
								<div class="info_content">
									<?php
									foreach ($sobre_projeto as $dado => $valor) {
										echo "<div>";
										echo "<div>" . $dado . ":</div> <div>" . $valor . "</div>";
										echo "</div>";
									}
									?>
								</div>
								<h2>Alunos e salas</h2>
								<div class="info_content">
									<?php
									$num_ano = 1;

									foreach ($info_salas as $ano) {
										echo "<section>";
										echo "<div><span>Quantidade de alunos do " . $num_ano . "º ano:</span> " . $ano[0] . "</div>";
										echo "<div><span>Quantidade de alunos participantes do " . $num_ano . "º ano:</span> " . $ano[1] . "</div>";
										echo "<div><span>Quantidade de salas do " . $num_ano . "º ano:</span> " . $ano[2] . "</div>";
										echo "<div><span>Quantidade de salas participantes do " . $num_ano . "º ano:</span> " . $ano[3] . "</div>";
										echo "</section>";

										$num_ano++;
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<script type="text/javascript" src="js/lib/jquery.mask.js"></script>
	<script type="text/javascript" src="js/lib/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="js/modulos/formulario.js"></script>

	<script>
		$(document).ready(function () {
			var html = $("html").html();
			window.location.href = "gerarPDF.php?html=" + html;
		});
	</script>

</html>