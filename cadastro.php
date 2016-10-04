<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'SerieController.php');
include_once($path['controller'].'PeriodoController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'AdministracaoController.php');
include_once($path['controller'].'TipoEscolaController.php');
include_once($path['controller'].'AnoLetivoController.php');
include_once($path['controller'].'GrauInstrucaoController.php');
include_once($path['controller'].'CategoriaFuncionalController.php');

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
$usuarioController = new UsuarioController();
$escolaController = new EscolaController();
$serieController = new SerieController();
$AdmController = new AdministracaoController();
$tipoEscolaController = new TipoEscolaController();
$anoController = new AnoLetivoController();
$grauInstController = new GrauInstrucaoController();
$categoriaController = new CategoriaFuncionalController();
$periodoController = new PeriodoController();

$escolas = $escolaController->selectAll();
//$professor = $usuarioController->selectByPerfilUsuario(2);
$periodos = $periodoController->selectAll();
$serie = $serieController->selectAll();
$adms = $AdmController->selectAll();
$tiposEscola = $tipoEscolaController->selectAll();
$anos = $anoController->selectAll();
$graus = $grauInstController->selectAll();
$cats = $categoriaController->selectAll();
//echo "<pre>";
//print_r($cats);
//echo "</pre>";

$escolasHtml = '';
$serieHtml = '';
$serieCheckbox = '';
$periodosHtml = "";
$escolaEdicao = "";

$isVisible = [
    "aluno"     => "display: none;",
    "professor" => "display: none;",
    "escola"    => "display: none;"
];


if (isset($_GET["perfil"])) {
    if (intval($_GET["perfil"]) == 1)
        $isVisible["aluno"] = "";
    elseif (intval($_GET["perfil"]) == 2)
        $isVisible["professor"] = "";
    elseif (intval($_GET["perfil"]) == 4)
        $isVisible["escola"] = "";
}

if (isset($_GET["usuario"])){

}

if(count($serie)>0){
	foreach($serie as $s) {
   		$serieHtml .= '<option value="'.utf8_encode($s->getSri_id()).'">'.utf8_encode($s->getSri_serie()).'</option>';
   		$serieCheckbox .= '<input type="checkbox" id="serieProf'.$s->getSri_id().'" class="seriesProfessor" value="'.$s->getSri_id().'"><label for="serie1">'.$s->getSri_serie().'ª</label> ';
    }
}

if(count($escolas)>0) {
	foreach($escolas as $esc) {
    	$escolasHtml .= '<option value="'.utf8_encode($esc->getesc_id()).'">'.utf8_encode($esc->getesc_razao_social()).'</option>';
    }
}

if(count($periodos)>0) {
    foreach ($periodos as $prd) {
        $periodosHtml .= "<option value='".utf8_encode($prd->getPrd_id())."''>".utf8_encode($prd->getPrd_periodo())."</option>";
    }
}

$logado = unserialize($_SESSION['USR']);
$class = $logado['perfil'] == "Professor" ? "tab_cadastro_professor" : "tab_cadastro";
$largura = $logado['perfil'] == "Aluno" || $logado['perfil'] == "NEC" ? '' : "col-md-10";

?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Administração</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/box-modal.css">
    
    <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="css/cadastro.css">
    
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-datepicker.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<input type="hidden" value="<?php echo $logado['id'];?>" name="idUsuario" id="idUsuario">
  	<?php if (isset($_GET["usuario"])) { ?>
    <input type="hidden" value="<?php echo $_GET['usuario'];?>" name="escolaEdicao" id="escolaEdicao">
    <?php } ?>

    <div id="container">
        <div class="row">
			<?php 
            	$templateGeral->topoSite();
            ?>            
        </div>
        <div id="Conteudo_Area">
        	<div class="row">
               <div class="col-xs-12 col-md-12 col-lg-12"  id="area_geral">   
                    <div id="Conteudo_Area_box_Grande">
                        <div class="box_area_admin">
                            <div class="topo_box_area_admin">
                                <img src="img/administracao.png" />
                            </div>
                            <main class="conteudo_box_area_admin">
                                <!-- Conteúdo principal -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php if ($logado['perfil'] != "Aluno") { ?><section class="area_btns_tabs">
                                            <div class="btns_tabs btns_aluno" <?php echo $logado["perfil"] === "NEC" ? "style='display: none;'" : "" ?> >
                                                <ul class="lista_btns lista_btns_aluno">
                                                    <li class="btn_tab btn_aluno btn_add_cadastro" onclick="limparCadastro('formAluno')">Novo cadastro</li>
                                                    <li class="btn_tab btn_aluno btn_update_cadastro btn_tab_ativo" id="update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_professor" style="display: none;">
                                                <ul class="lista_btns lista_btns_professor">
                                                    <?php if ($logado['perfil'] != "Professor") { ?> <li class="btn_tab btn_professor btn_add_cadastro" onclick="limparCadastro('formProf')">Novo cadastro</li> <?php } ?>
                                                    <li class="btn_tab btn_professor btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_escola" <?php echo $logado["perfil"] != "NEC" ? "style='display: none;'" : "" ?> >
                                                <ul class="lista_btns lista_btns_escola">
                                                    <?php if ($logado["perfil"] === "NEC") { ?>
                                                        <li class="btn_tab btn_escola btn_confirm_cadastro">Pré-cadastro</li>
                                                        <li class="btn_tab btn_escola btn_add_cadastro" onclick="limparCadastro('formEscola')">Novo cadastro</li>
                                                    <?php } ?>
                                                    <li class="btn_tab btn_escola btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                        </section><?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-2">
                                        <?php if($logado['perfil'] != "Aluno" && $logado['perfil'] != "NEC"){ ?>
                                            <nav role="navigation" class="area_tabs_cadastro">
                                                <ul class="tabs_cadastro">
                                                    <li class="<?= $class; ?> tab_aluno tab_cadastro_ativo" pagina="lista_btns_aluno"></li>
                                                    <li class="<?= $class; ?> tab_professor" pagina="lista_btns_professor"></li>
                                                    <?php if($logado['perfil'] != "Professor"){ ?>
                                                        <li class="<?= $class; ?> tab_escola" pagina="lista_btns_escola"></li>
                                                    <?php }?>
                                                </ul>
                                            </nav>
                                        <?php } ?>
                                    </div>
                                    <div class="col-xs-12 <?= $largura  ?>">
                                        <section class="area_conteudo_tabs">
                                            <div class="conteudo_tab conteudo_aluno" <?= $logado["perfil"] === "NEC" ? "style='display: none;'" : "" ?> >
                                                
                                                <?php include("formularioCadastroAluno.php"); ?>
                                                
                                                <section class="update_cadastro update_aluno cadastroAlunoContent" id="updateAlunoContainer">
                                                    <h2 class="section_header update_cad_aluno_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_aluno_accordion">
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_professor" style="display: none;">
                                            	
                                                <?php include("formularioCadastroProfessor.php"); ?>
                                               
                                                <section class="update_cadastro update_prof cadastroProfContent" id="updateProfContainer">
                                                    <h2 class="section_header update_cad_prof_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_prof_accordion">
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_escola" <?= $logado["perfil"] != "NEC" ? "style='display: none;'" : "" ?> >

                                            <?php if ($logado["perfil"] === "NEC") { ?>
                                                <section class="confirm_cadastro confirm_escola cadastroEscolaContent">
                                                    <h2 class="section_header update_cad_escola_header">Escolas pré-cadastradas</h2>
                                                    <div class="accordion_cad_container confirm_escola_accordion">
                                                        <!-- Content generated by JavaScript -->
                                                    </div>
                                                </section>
                                            <?php } ?>

                                                <?php include("formularioCadastroEscola.php"); ?>
                                                
                                                <section class="update_cadastro update_escola cadastroEscolaContent" id="updateEscolaContainer">
                                                    <h2 class="section_header update_cad_escola_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_escola_accordion">
                                                       
                                                    </div>
                                                </section>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </main>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="feedback_nova_mensagem" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="img_check" id="img_modal"></div>
                                        <div class="modal-body-container">
                                            <div class="text-modal"><p class="txt-box" id="texto_box"><!-- Sua mensagem foi enviada com sucesso! --></p></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="modalOk()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalDelMsg" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="img_alert" id="img_modal"></div>
                                        <div class="text-modal"><p class="txt-box" id="texto_box">Tem certeza que deseja excluir este perfil?</p></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="generic_btn" data-dismiss="modal" onclick="confirmDelPerfil()">Sim</button>
                                        <button type="button" class="generic_btn" data-dismiss="modal" onclicl="cancelDelPerfil()">Não</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim do Modal -->
                    </div>              	
                </div>
            </div>
        </div>
        <footer>
            <div class="row" id="rodape"></div>
        </footer>
    </div>
	
	<!--Sempre que for utilizar uma mensagem, criar uma div com a classe modalMensagem e com o display none-->
	<div id="mensagemCampoVazio" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('mensagens','<span id="textoMensagemVazio"></span>','erro');
		?>
	</div>
	<div id="mensagemSucessoCadastro" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','Cadastro efetuado com sucesso!','sucesso');
		?>
	</div>
	<div id="mensagemSucessoEdicao" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','Cadastro editado com sucesso!','sucesso');
		?>
	</div>
	<div id="mensagemErroCadastro" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','Erro ao salvar!','erro');
		?>
	</div>
	<div id="mensagemErroImagem" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','<span id="textoMensagemImagem"></span>','erro');
		?>
	</div>
    <div id="mensagemAprovado" class="modalMensagem" style="display:none;">
        <?php
            $templateGeral->mensagemRetorno("mensagens","Cadastro aprovado com sucesso.", "sucesso");
        ?>
    </div>
    <div id="mensagemRejeitado" class="modalMensagem" style="display:none;">
        <?php
            $templateGeral->mensagemRetorno("mensagens","Cadastro rejeitado com sucesso.", "sucesso");
        ?>
    </div>
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="bootstrap/js/bootstrap-datepicker.js"></script>
    <script src="js/EstadoCidade.js"></script>
    <script src="js/funcoes.js"></script>
	<script src="js/cadastro.js"></script>
	<script src="js/goMobileUpload.js"></script>

    <?php if ($logado["perfil"] === "NEC") { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn_escola.btn_update_cadastro").trigger("click");
        });
    </script>
    <?php } ?>

</body>
</html>
