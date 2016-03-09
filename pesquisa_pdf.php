<?php
require_once '_loadPaths.inc.php';
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
                </div>
            </div>
            <div class="row">
            <?php
            	$tipo_escola = [];
            	if (isset($_GET["tipo_educacao_infantil"])) 	{ array_push($tipo_escola, "Educação Infantil"); }
            	if (isset($_GET["tipo_ensino_fund_1"])) 		{ array_push($tipo_escola, "Ensino Fundamental I"); }
				if (isset($_GET["tipo_ensino_fund_2"])) 		{ array_push($tipo_escola, "Ensino Fundamental II"); }
				if (isset($_GET["tipo_ensino_medio"])) 			{ array_push($tipo_escola, "Ensino Médio"); }
				if (isset($_GET["tipo_tecnico_profissional"])) 	{ array_push($tipo_escola, "Ensino Técnico Profissionalizante"); }
				if (isset($_GET["tipo_formacao_professores"])) 	{ array_push($tipo_escola, "Formação de professores"); }
				if (isset($_GET["tipo_outro"]))					{ array_push($tipo_escola, $_GET["tipo_outro_especificacao"]); }

				echo "<pre>";
				var_dump($tipo_escola);
				echo "</pre>";

				$ideb = isset($_GET["ideb_nulo"]) ? "Não fornecido" : $_GET["ideb"] ;
				$projetos_anteriores = isset($_GET["projetos_anteriores_null"]) ? "Não participou de nenhum projeto" : $_GET["projetos_anteriores"];
				$sala_info = $_GET["sala_info"] == 1 ? "Sim" : "Não";
				$acesso_internet;

				if ($_GET["sala_info"] == 1) { $acesso_internet = $_GET["acesso_internet"] == 1 ? "Sim" : "Não"; }

				echo "<pre>";
				var_dump($ideb);
				var_dump($projetos_anteriores);
				var_dump($sala_info);
				var_dump($acesso_internet);
				echo "</pre>";

				$atividades_familiares 	= $_GET["atividades_familia"] == 1 ? $_GET["atividades_familiares"] : "Não";

				$reuniao_de_pais 		= $_GET["reuniao_de_pais"];
				$procura_professor 		= $_GET["procura_professor"];
				$atividades_extra 		= $_GET["atividades_extra"];
				$reforco_rec 			= $_GET["reforco_rec"];
				$recursos_basicos 		= $_GET["recursos_basicos"];
				$atividades_recreativas = $_GET["atividades_recreativas"];
				$canais_comunicacao 	= $_GET["canais_comunicacao"];
				$auxilia_filhos 		= $_GET["auxilia_filhos"];
				$acompanha_curriculo 	= $_GET["acompanha_curriculo"];

				echo "<pre>";
				var_dump($atividades_familiares);
				var_dump($reuniao_de_pais);
				var_dump($procura_professor);
				var_dump($atividades_extra);
				var_dump($reforco_rec);
				var_dump($recursos_basicos);
				var_dump($atividades_recreativas);
				var_dump($canais_comunicacao);
				var_dump($auxilia_filhos);
				var_dump($acompanha_curriculo);
				echo "</pre>";

            ?>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="js/lib/jquery.mask.js"></script>
    <script type="text/javascript" src="js/lib/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/modulos/formulario.js"></script>
    <script type="text/javascript" src="js/index.js"></script>

</html>