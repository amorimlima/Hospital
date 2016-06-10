<?php
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php';
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EscolaJSONController.php');

function gerarPDF()
{
	//Carregar dados

	$escolaJSONController = new EscolaJSONController();
	$esj = EscolaJSONController::selectByIdEscola($_GET["idesc"]);
	$data = json_decode($esj, true);

	// Tipo da escola
	$tipo_educacao_infantil 	= isset($data["tipo_educacao_infantil"]) ? "<li>Educação infantil</li>" : "";
	$tipo_ensino_fund_1 		= isset($data["tipo_ensino_fund_1"]) ? "<li>Ensino Fundamental I</li>" : "";
	$tipo_ensino_fund_2 		= isset($data["tipo_ensino_fund_2"]) ? "<li>Ensino Fundamental II</li>" : "";
	$tipo_ensino_medio 			= isset($data["tipo_ensino_medio"]) ? "<li>Ensino Médio</li>" : "";
	$tipo_tecnico_profissional 	= isset($data["tipo_tecnico_profissional"]) ? "<li>Ensino técnico profissionalizante</li>" : "";
	$tipo_formacao_professores 	= isset($data["tipo_formacao_professores"]) ? "<li>Formação de professores</li>" : "";
	$tipo_outro_especificacao 	= isset($data["tipo_outro_especificacao"]) ? "<li>{$data["tipo_outro_especificacao"]}</li>" : "";

	// Dados gerais da escola
	$ideb 					= isset($data["ideb_nulo"]) ? "Não fornecido" : $data["ideb"];
	$projetos_anteriores 	= isset($data["projetos_anteriores_null"]) ? "Não participou de nenhum projeto" : $data["projetos_anteriores"];
	$sala_info 				= $data["sala_info"] == 1 ? "Sim" : "Não";
	$acesso_internet 		= ($data["sala_info"] == 1 && $data["acesso_internet"] == 1) ? "Sim" : "Não";

	// Questões familiares
	$atividades_familiares 	= (isset($data["atividades_familia"]) && $data["atividades_familia"] == 1) ? $data["atividades_familiares"] : "Não";

	// Dados sobre os pais
	$reuniao_de_pais 		= $data["reuniao_de_pais"];
	$procura_professor 		= $data["procura_professor"];
	$atividades_extra 		= $data["atividades_extra"];
	$reforco_rec 			= $data["reforco_rec"];
	$recursos_basicos 		= $data["recursos_basicos"];
	$atividades_recreativas = $data["atividades_recreativas"];
	$canais_comunicacao 	= $data["canais_comunicacao"];
	$auxilia_filhos 		= $data["auxilia_filhos"];
	$acompanha_curriculo 	= $data["acompanha_curriculo"];

	// Dados sobre a participação no projeto
	$motivos_participacao 	= $data["motivos_participacao"];
	$acesso_plataforma 		= isset($data["acesso_plataforma"]) ? "Sim" : "Não";
	$download_offline 		= isset($data["download_offline"]) ? "Sim" : "Não";
	$download_impressao 	= isset($data["download_impressao"]) ? "Sim" : "Não";

	$info_salas = [];
	$info_salas["1º ano"] = [];
	$info_salas["2º ano"] = [];
	$info_salas["3º ano"] = [];
	$info_salas["4º ano"] = [];
	$info_salas["5º ano"] = [];

	foreach ($info_salas as $ano => $vetor) {
		$num_ano = substr($ano, 0, 1);

		array_push($info_salas[$ano], $data["total_alunos_" . $num_ano . "ano"]);
		array_push($info_salas[$ano], $data["total_alunos_part_" . $num_ano . "ano"]);
		array_push($info_salas[$ano], $data["total_salas_" . $num_ano . "ano"]);
		array_push($info_salas[$ano], $data["total_salas_part_" . $num_ano . "ano"]);
	}

	$r = '<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
				<title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
				<link href="css/pesquisa_pdf.css" rel="stylesheet" />
				<style>
				* {
	font-size: 12px;
	font-family: Helvetica, Arial, sans-serif;
}

.identidade_unidade_ensino {
	padding: 20px;
}
.identidade_unidade_ensino > h1 {
	font-size: 20px;
	margin-top: 0;
	margin-bottom: 20px;
	color: #404040;
}
.identidade_unidade_ensino > div > h2 {
	font-size: 18px;
	color: #666;
	margin-top: 10px;
	margin-bottom: 10px;
}
.info_content {
	padding: 20px;
	padding-top: 0;
	border-bottom: 1px solid #ccc;
}
.info_content > h2 {
	font-size: 20px;
}
.info_content > ul {
	padding-left: 15px;
}
.info_content > ul > li {
	font-size: 14px;
	color: #666;
}
.info_content > div {
	margin-bottom: 10px;
}
.info_content > div > span {
	color: #999;
}
.info_content > div > div:nth-child(1) {
	color: #999;
}
.info_content > div > div:nth-child(2) {
	font-size: 14px;
	color: #444;
}
.info_content > div > div:nth-child(3) {
	margin-top: 10px;
	font-size: 14px;
}
.info_content > section {
	margin-bottom: 10px;
}
.info_content > section > div {
	margin-bottom: 4px;
}
.info_content > section > div > span {
	color: #999;
}
				</style>
			</head>
			<body>
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="logo-container">
								<img src="../img/logo/logo_md.png">
							</div>
							<div class="pesquisa_pre_cadastro">
								<div class="identidade_unidade_ensino">
									<h1>Identidade da Unidade de Ensino</h1>
									<div class="tipo_unidade_ensino">
										<h2>Tipo de estabelecimento</h2>
										<div class="info_content">
											<ul>';
	$r.= 										$tipo_educacao_infantil;
	$r.= 										$tipo_ensino_fund_1;
	$r.= 										$tipo_ensino_fund_2;
	$r.=										$tipo_ensino_medio;
	$r.=										$tipo_tecnico_profissional;
	$r.=										$tipo_formacao_professores;
	$r.=										$tipo_outro_especificacao;
	$r.= '									</ul>
											<div>
												<span>IDEB:</span>';
	$r.= 										$ideb;
	$r.= '									</div>
											<div>
												<span>Projetos anteriores:</span>';
	$r.= 										$projetos_anteriores;
	$r.= '									</div>
											<div>
												<span>Sala de informática:</span>';
	$r.= 										$sala_info;
	$r.= '									</div>';
	if ($data["sala_info"] == 1) {
		$r.= '								<div>
												<span>Acesso à internet:</span>';
		$r.= 									$acesso_internet;
		$r.= '								</div>';
	}
	$r.= '								</div>
									</div>
									<div class="comunidade_escolar">
										<h2>Sobre a comunidade escolar</h2>
										<div class="info_content">
											<div>
												<div>A escola possui atividades para aumentar o envolvimeno da família?</div>
												<div>';
	$r.= 											($data["atividades_familia"] == 1 ? "Sim" : "Não");
	$r.= '										</div>
											</div>';
	if ($data["atividades_familia"] == 1) {
		$r.= '								<div>';
		$r.= 									$atividades_familiares;
		$r.= '								</div>';
	}
	$r.= '								</div>
										<h2>Dados sobre os pais/responsáveis</h2>
										<div class="info_content">
											<div>
												<div>Participam das reuniões de pais</div>
												<div>';
	$r.= 											$reuniao_de_pais;
	$r.= '										</div>
											</div>
											<div>
												<div>Procuram o professor quando têm dúvidas</div>
												<div>';
	$r.= 											$procura_professor;
	$r.= '										</div>
											</div>
											<div>
												<div>Propiciam aos alunos a chance de participar de atividades extracurriculares</div>
												<div>';
	$r.= 											$atividades_extra;
	$r.= '										</div>
											</div>
											<div>
												<div>Permitem aos alunos participar das aulas de reforço</div>
												<div>';
	$r.= 											$reforco_rec;
	$r.= '										</div>
											</div>
											<div>
												<div>Fornecem aos alunos recursos básicos ao rendimento escolar</div>
												<div>';
	$r.= 											$recursos_basicos;
	$r.= '										</div>
											</div>
											<div>
												<div>Participam das atividades recreativas da escola</div>
												<div>';
	$r.= 											$atividades_recreativas;
	$r.= '										</div>
											</div>
											<div>
												<div>Participam dos canais de comunicação da escola com os pais</div>
												<div>';
	$r.= 											$canais_comunicacao;
	$r.= '										</div>
											</div>
											<div>
												<div>Auxiliam os alunos nos deveres de casa</div>
												<div>';
	$r.= 											$auxilia_filhos;
	$r.= '										</div>
											</div>
											<div>
												<div>Acompanham o conteúdo curricular trabalhado em aula</div>
												<div>'; 
	$r.= 											$acompanha_curriculo;
	$r.= '										</div>
											</div>
										</div>
										<h2>Sobre o Projeto</h2>
										<div class="info_content">
											<div>
												<div>Motivos para participar do projeto</div>
												<div>';
	$r.= 											$motivos_participacao;
	$r.= '										</div>
											</div>
											<div>
												<div>Acessará a plataforma</div>
												<div>';
	$r.= 											$acesso_plataforma;
	$r.= '										</div>
											</div>
											<div>
												<div>Download dos materiais e acesso off line</div>
												<div>';
	$r.= 											$download_offline;
	$r.= '										</div>
											</div>
											<div>
												<div>Download dos materiais em pdf e impressão de apostilas</div>
												<div>';
	$r.= 											$download_impressao;
	$r.= '										</div>
											</div>
										</div>
										<h2>Alunos e salas</h2>
										<div class="info_content">';
	$num_ano = 1;
	foreach ($info_salas as $ano)
	{
		$r.= "								<section>";
		$r.= "									<div><span>Quantidade de alunos do " . $num_ano . "º ano:</span> " . $ano[0] . "</div>";
		$r.= "									<div><span>Quantidade de alunos participantes do " . $num_ano . "º ano:</span> " . $ano[1] . "</div>";
		$r.= "									<div><span>Quantidade de salas do " . $num_ano . "º ano:</span> " . $ano[2] . "</div>";
		$r.= "									<div><span>Quantidade de salas participantes do " . $num_ano . "º ano:</span> " . $ano[3] . "</div>";
		$r.= "								</section>";
		$num_ano++;
	}
	$r.= '								</div>
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
		  </html>';

	return $r;
}
?>										