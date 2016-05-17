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
                                        <section class="area_btns_tabs">
                                            <div class="btns_tabs btns_aluno">
                                                <ul class="lista_btns lista_btns_aluno">
                                                    <li class="btn_tab btn_aluno btn_add_cadastro" onclick="limparCadastro('formAluno')">Novo cadastro</li>
                                                    <li class="btn_tab btn_aluno btn_update_cadastro btn_tab_ativo" id="update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_professor" style="display: none;">
                                                <ul class="lista_btns lista_btns_professor">
                                                    <li class="btn_tab btn_professor btn_add_cadastro" onclick="limparCadastro('formProf')">Novo cadastro</li>
                                                    <li class="btn_tab btn_professor btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_escola" style="display: none;">
                                                <ul class="lista_btns lista_btns_escola">
                                                    <li class="btn_tab btn_escola btn_add_cadastro" onclick="limparCadastro('formEscola')">Novo cadastro</li>
                                                    <li class="btn_tab btn_escola btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-2">
                                        <nav role="navigation" class="area_tabs_cadastro">
                                            <ul class="tabs_cadastro">
                                                <li <?php if($logado['perfil'] == "Professor") {?> 
                                                        class="tab_cadastro_professor tab_aluno tab_cadastro_ativo" 
                                                    <?php }
                                                          else{ ?>
                                                          class="tab_cadastro tab_aluno tab_cadastro_ativo"
                                                    <?php } ?>
                                                    pagina="lista_btns_aluno"></li>
                                                <li <?php if($logado['perfil'] == "Professor") {?> 
                                                        class="tab_cadastro_professor tab_professor" 
                                                    <?php }
                                                          else{ ?>
                                                          class="tab_cadastro tab_professor"
                                                    <?php } ?> pagina="lista_btns_professor"></li>
                                                <?php if($logado['perfil'] != "Professor") {?>
                                                    <li class="tab_cadastro tab_escola" pagina="lista_btns_escola"></li>
                                                <?php }?>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="col-xs-12 col-md-10">
                                        <section class="area_conteudo_tabs">
                                            <div class="conteudo_tab conteudo_aluno">
                                                <form action="" class="form_cadastro cadastro_aluno cadastroAlunoContent" id="formCadastroAluno" style="display: none;">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Escolares</legend>
                                                        <div class="form_celula_m">
                                                            <label for="selectEscolaAluno" class="form_info info_m">Escola<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="selectEscolaAluno" id="selectEscolaAluno" class="form_value form_select formAluno obrigatorioAluno" msgVazio="O campo escola é obrigatório" required onChange="listaProfessores('')">
                                                                    <option value="" disabled selected>Selecione a escola</option>
                                                                    <?php
																		echo $escolasHtml;
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="form_celula_p">
                                                            <label for="selectSerieAluno" class="form_info info_p">Série<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="selectSerieAluno" id="selectSerieAluno" class="form_value form_select value_p formAluno obrigatorioAluno" msgVazio="O campo série é obrigatório" required onChange="listaProfessores('')">
                                                                    <option value="" disabled selected>Selecione a série</option>
                                                                    <?php
                                                                    	echo $serieHtml;
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                          
                                                        <div class="form_celula_m">
                                                            <label for="selectProfessorAluno" class="form_info info_m">Professor<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="selectProfessorAluno" id="selectProfessorAluno" class="form_value form_select value_m formAluno obrigatorioAluno" msgVazio="O campo professor é obrigatório" required>
                                                                
                                                                	<!--  ATENÇÂO - Se mudar o texto desse option precisa mudar em mais dois lugares no arquivo cadastro.js. -->
                                                                    <option value="" disabled selected>Selecione primeiro a escola e a série</option>
                                                                    
                                                                 </select>
                                                            </span>
                                                        </div>
                                                        
														<div class="form_celula_p">
                                                            <label for="selectPeriodoAluno" class="form_info info_p">Ano Letivo<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="selectAnoAluno" id="selectAnoAluno" class="form_value form_select value_p" required>
                                                                    <?php
                                                                    if(count($anos)>0){
                                                                    	foreach($anos as $a) {
                                                                    		$selected = '';
                                                                    		$classe = '';
                                                                        	if (date('Y') == $a->getAno_ano()) {
                                                                        		$classe = 'class="anoAtual"'; 
                                                                        		//$selected = 'selected';
                                                                        	}
                                                                            echo '<option '.$selected.' '.$classe.' value="'.utf8_encode($a->getAno_id()).'">'.utf8_encode($a->getAno_ano()).'</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Pessoais</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeAluno" class="form_info info_g">Nome<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeAluno" id="inputNomeAluno" class="form_value form_text value_g formAluno obrigatorioAluno" msgVazio="O campo nome é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascimentoAluno" class="form_info info_p">Nascimento<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNascimentoAluno" id="inputNascimentoAluno" class="form_value form_text value_p formAluno obrigatorioAluno" msgVazio="O campo nascimento é obrigatório" required OnKeyPress="formatar('##/##/####', this)"  maxlength="10"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgAluno" class="form_info info_p">RG<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRgAluno" id="inputRgAluno" class="form_value form_text value_p formAluno obrigatorioAluno" msgVazio="O campo RG é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfAluno" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCpfAluno" id="inputCpfAluno" class="form_value form_text value_p formAluno" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14" />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputRuaAluno" class="form_info info_g">Rua<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRuaAluno" id="inputRuaAluno" class="form_value form_text value_g formAluno obrigatorioAluno" msgVazio="O campo rua é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaAluno" class="form_info info_p">Número<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNumCasaAluno" id="inputNumCasaAluno" class="form_value form_number value_p formAluno obrigatorioAluno" msgVazio="O campo número é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCompCasaAluno" class="form_info info_p">Complemento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCompCasaAluno" id="inputCompCasaAluno" class="form_value form_number value_p formAluno" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCepAluno" class="form_info info_p">CEP<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCepAluno" id="inputCepAluno" class="form_value form_text value_p formAluno obrigatorioAluno" msgVazio="O campo CEP é obrigatório" required OnKeyPress="formatar('##.###-###', this)" maxlength="10"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputBairroAluno" class="form_info info_p">Bairro<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputBairroAluno" id="inputBairroAluno" class="form_value form_text value_p formAluno obrigatorioAluno" msgVazio="O campo bairro é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="inputPaisAluno" name="inputPaisAluno" value="Brasil" />
                                                        <div class="form_celula_p">
                                                            <label for="inputEstadoAluno" class="form_info info_p">Estado<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputEstadoAluno" id="inputEstadoAluno" class="form_value form_select value_p formAluno obrigatorioAluno" msgVazio="O campo estado é obrigatório" required>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCidadeAluno" class="form_info info_p">Cidade<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputCidadeAluno" id="inputCidadeAluno" class="form_value form_select value_p formAluno obrigatorioAluno" msgVazio="O campo cidade é obrigatório" required>
                                                                    <option value="" disabled selected>Selecione um estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelResAluno" class="form_info info_p">Tel. Residencial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelResAluno" id="inputTelResAluno" class="form_value form_text value_p formAluno obrigatorioAluno" required  OnKeyPress="formatar('## ####-#####', this)"  maxlength="13" msgVazio="Pelo menos um número de telefone deve ser cadastrado"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelCelAluno" class="form_info info_p">Tel. Celular</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelCelAluno" id="inputTelCelAluno" class="form_value form_text value_p formAluno" OnKeyPress="formatar('## ####-#####', this)"  maxlength="13"/>
					
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTelComAluno" class="form_info info_p">Tel. Comercial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelComAluno" id="inputTelComAluno" class="form_value form_text value_p formAluno" OnKeyPress="formatar('## ####-#####', this)"  maxlength="13"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputEmailAluno" class="form_info info_p">E-mail<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailAluno" id="inputEmailAluno" class="form_value form_text value_p formAluno" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="cadastroImagem" class="form_info info_p">Foto</label>
                                                           
                                                             <span class="input_container spanImagem" id="spanImagemAluno">
                                                             
                                                             	<div id="cadastroImagemUpload">
		                                                        	<div id="cadastroImagem" class="divImagem"></div>
			
																	<div id="car"></div>
																    <br><div id="imgUp" style="position:absolute"><img src="" width="150" height="150"/><br/></div>
																    <input name="imagem" type="hidden" id="imagem" value=""></td>
															    </div>
															</span>
                                                        </div>
                                                    </fieldset>
                                                    <!--<fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados do Responsável</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeRespAluno" class="form_info info_g">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeRespAluno" id="inputNomeRespAluno" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascRespAluno" class="form_info info_p">Nascimento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNascRespAluno" id="inputNascRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgRespAluno" class="form_info info_p">RG</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRgRespAluno" id="inputRgRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfRespAluno" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCpfRespAluno" id="inputCpfRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputTelRespAluno" class="form_info info_m">Telefone</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelRespAluno" id="inputTelRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputEmailRespAluno" class="form_info info_m">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailRespAluno" id="inputEmailRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>-->
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioAluno" class="form_info info_p">Usuário<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputUsuarioAluno" id="inputUsuarioAluno" class="form_value form_text value_p formAluno obrigatorioAluno" msgVazio="O campo usuário é obrigatório" placeholder="Insira um usuário de usuário" required maxlength="10"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p" style="position: relative;">
                                                            <label for="inputSenhaAluno" class="form_info info_p">Senha<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="password" name="inputSenhaAluno" data-inputType="senha" id="inputSenhaAluno" class="form_value form_text value_p  formAluno obrigatorioAluno" msgVazio="O campo senha é obrigatório" placeholder="Insira uma senha" required maxlength="10"/>
                                                            </span>
                                                            <div id="regrasSenhaAluno" class="panel panel-default regras_senha" style="display: none;">
                                                                <div class="panel-body">
                                                                    <p class="regra_char_esp text-danger">Caracter especial</p>
                                                                    <p class="regra_char_mai text-danger">Maiúscula</p>
                                                                    <p class="regra_char_min text-danger">Minúscula</p>
                                                                    <p class="regra_length text-danger">Entre 6 e 10 caracteres</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmAluno" class="form_info info_p">Senha<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="password" name="inputSenhaConfirmAluno" id="inputSenhaConfirmAluno" class="form_value form_text value_p formAluno" placeholder="Confirme a senha" required maxlength="10"/>
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        
                                                        <input type="hidden" value="" id="idAluno" />
                                                        <input type="hidden" value="" id="idUsuarioVariavelAluno" />
                                                        <input type="hidden" value="" id="idEnderecoAluno" />
                                                        
                                                        <input type="button" value="Limpar" onclick="limparCadastro('formAluno')" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroAluno" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_aluno cadastroAlunoContent" id="updateAlunoContainer">
                                                    <h2 class="section_header update_cad_aluno_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_aluno_accordion">
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_professor" style="display: none;">
                                            	
                                                <form action="" class="form_cadastro cadastro_prof cadastroProfContent" id="formCadastroProf" style="display: none;">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Pessoais</legend>
                                                        <div class="form_celula_m">
                                                            <label for="inputNomeProf" class="form_info info_m">Nome<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeProf" id="inputNomeProf" class="form_value form_text value_m formProf obrigatorioProf" required msgVazio="O campo nome é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="selectGrauProf" class="form_info info_m">Perfil<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="perfil" id="perfil" class="form_value form_select value_m formProf obrigatorioProf" required msgVazio="O campo perfil é obrigatório">
                                                                    <option value='' disabled selected>Selecione o perfil</option>
                                                                    <option value='2'>Professor</option>
                                                                    <option value='3'>Unidade Escolar</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <!-- <div class="form_celula_m ">
                                                            <label for="selectCategoriaProf" class="form_info info_m">Categoria Funcional<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="selectCategoriaProf" id="selectCategoriaProf" class="form_value form_select value_m formProf obrigatorioProf" required msgVazio="O campo cateoria funcional é obrigatório">
                                                                	<option value='' disabled selected>Selecione uma categoria funcional</option>
                                                                    <?php
//                                                                    	if(count($cats)>0){
//																			foreach($cats as $c) {
//																		   		//echo '<option value="'.$g->getGrt_id().'">'.utf8_encode($s->getGrt_instrucao()).'</option>';
//																		   		echo '<option value="'.$c->getctf_id().'">'.utf8_encode($c->getctf_categoria()).'</option>';
//																		    }
//																		}
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="selectGrauProf" class="form_info info_m">Instrução<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="selectGrauProf" id="selectGrauProf" class="form_value form_select value_m formProf obrigatorioProf" required msgVazio="O campo do grau deinstrução é obrigatório">
                                                                	<option value='' disabled selected>Selecione uma instrução</option>
                                                                    <?php
//                                                                    	if(count($graus)>0){
//																			foreach($graus as $g) {
//																		   		//echo '<option value="'.$g->getGrt_id().'">'.utf8_encode($s->getGrt_instrucao()).'</option>';
//																		   		echo '<option value="'.$g->getGrt_id().'">'.utf8_encode($g->getGrt_instrucao()).'</option>';
//																		    }
//																		}
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>-->
                                                        <div class="form_celula_p">
                                                            <label for="inputNascimentoProf" class="form_info info_p">Nascimento<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNascimentoProf" id="inputNascimentoProf" class="form_value form_text value_p formProf obrigatorioProf" required msgVazio="O campo nascimento é obrigatório"  OnKeyPress="formatar('##/##/####', this)"  maxlength="10"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgProf" class="form_info info_p">RG<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRgProf" id="inputRgProf" class="form_value form_text value_p formProf obrigatorioProf" required msgVazio="O campo RG é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfProf" class="form_info info_p">CPF<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCpfProf" id="inputCpfProf" class="form_value form_text value_p formProf obrigatorioProf" required OnKeyPress="formatar('###.###.###-##', this)" msgVazio="O campo CPF é obrigatório" maxlength="14"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputRuaProf" class="form_info info_g">Rua<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRuaProf" id="inputRuaProf" class="form_value form_text value_g formProf obrigatorioProf" required msgVazio="O campo rua é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaProf" class="form_info info_p">Número<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNumCasaProf" id="inputNumCasaProf" class="form_value form_number value_p formProf obrigatorioProf" required msgVazio="O campo número é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCompCasaProf" class="form_info info_p">Complemento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCompCasaProf" id="inputCompCasaProf" class="form_value form_number value_p formProf" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCepProf" class="form_info info_p">CEP <span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCepProf" id="inputCepProf" class="form_value form_text value_p formProf obrigatorioProf" required msgVazio="O campo CEP é obrigatório" OnKeyPress="formatar('##.###-###', this)" maxlength="10"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputBairroProf" class="form_info info_p">Bairro<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputBairroProf" id="inputBairroProf" class="form_value form_text value_p formProf obrigatorioProf" required msgVazio="O campo bairro é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="inputPaisProf" name="inputPaisProf" value="Brasil" />
                                                        <div class="form_celula_p">
                                                            <label for="inputEstadoProf" class="form_info info_p">Estado<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="" id="inputEstadoProf" class="form_value form_select value_p formProf obrigatorioProf" required msgVazio="O campo estado é obrigatório">
                                                                    <!-- <option value="" disabled selected>Selecione o estado</option>-->
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCidadeProf" class="form_info info_p">Cidade<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputCidadeProf" id="inputCidadeProf" class="form_value form_select value_p formProf obrigatorioProf" required msgVazio="O campo cidade é obrigatório">
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelResProf" class="form_info info_p">Tel. Residencial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelResProf" id="inputTelResProf" class="form_value form_text value_p formProf obrigatorioProf" required OnKeyPress="formatar('## ####-#####', this)" msgVazio="Pelo menos um número de telefone deve ser cadastrado" maxlength="13"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelCelProf" class="form_info info_p">Tel. Celular</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelCelProf" id="inputTelCelProf" class="form_value form_text value_p formProf" OnKeyPress="formatar('## ####-#####', this)" maxlength="13"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTelComProf" class="form_info info_p">Tel. Comercial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelComProf" id="inputTelComProf" class="form_value form_text value_p formProf" OnKeyPress="formatar('## ####-#####', this)" maxlength="13"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputEmailProf" class="form_info info_g">E-mail<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailProf" id="inputEmailProf" class="form_value form_text value_g  formProf obrigatorioProf" required msgVazio="O campo email é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="cadastroImagem" class="form_info info_p">Foto</label>
                                                            <span class="input_container spanImagem" id="spanImagemProfessor"></span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Grupos</legend>
                                                        <div class="form_celula_p">
                                                            <label for="" class="form_info info_p">Série<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="" id="inputSerieProf1" data-grupoAttr="serie" name="grp_serie" class="form_value form_select value_p formProf obrigatorioProf" required msgVazio="O campo série é obrigatório">
                                                                    <option value="" disabled hidden selected>Selecione uma série</option>
                                                                    <?php echo $serieHtml; ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="" class="form_info info_p">Período<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="" id="inputPeriodoProf1" data-grupoAttr="periodo" name="grp_periodo" class="form_value form_select value_p formProf obrigatorioProf" required msgVazio="O campo período é obrigatório">
                                                                    <option value="" disabled hidden selected>Selecione um período</option>
                                                                    <?php echo $periodosHtml; ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div id="acaoNovaSerieContainer" class="acao_form"><span id="inserirNovaSerie"><span class="glyphicon glyphicon-plus"></span> Inserir nova série</span></div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioProf" class="form_info info_p">Usuário<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputUsuarioProf" id="inputUsuarioProf" class="form_value form_text value_p  formProf obrigatorioProf" placeholder="Insira um nome de usuário" required msgVazio="O campo usuário é obrigatório"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p" style="position: relative;">
                                                            <label for="inputSenhaProf" class="form_info info_p">Senha<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="password" name="inputSenhaProf" id="inputSenhaProf" data-inputType="senha" class="form_value form_text value_p  formProf obrigatorioProf" placeholder="Insira uma senha" required msgVazio="O campo senha é obrigatório" maxlength="10"/>
                                                            </span>
                                                            <div id="regrasSenhaProf" class="panel panel-default regras_senha" style="display: none;">
                                                                <div class="panel-body">
                                                                    <p class="regra_char_esp text-danger">Caracter especial</p>
                                                                    <p class="regra_char_mai text-danger">Maiúscula</p>
                                                                    <p class="regra_char_min text-danger">Minúscula</p>
                                                                    <p class="regra_length text-danger">Entre 6 e 10 caracteres</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmProf" class="form_info info_p">Senha<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="password" name="inputSenhaConfirmProf" id="inputSenhaConfirmProf" class="form_value form_text value_p formProf" placeholder="Confirme a senha" required maxlength="10"/>
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                    	
                                                    	<input type="hidden" value="" id="idProfessor" class="formProf"/>
                                                        <input type="hidden" value="" id="idGrupoProfessor" class="formProf"/>
                                                        <input type="hidden" value="" id="idUsuarioVariavelProfessor" class="formProf"/>
                                                        <input type="hidden" value="" id="idEnderecoProfessor" class="formProf"/>
                                                        <!-- <input type="hidden" value="" id="serieProf" class="formProf"/> -->
                                                        
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroProfessor" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_prof cadastroProfContent" id="updateProfContainer">
                                                    <h2 class="section_header update_cad_prof_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_prof_accordion">
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_escola" style="display: none;">
                                                <form action="" class="form_cadastro cadastro_escola cadastroEscolaContent" id="formCadastroEscola" style="display: none;">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeEscola" class="form_info info_g">Nome<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeEscola" id="inputNomeEscola" class="form_value form_text value_g formEscola obrigatorioEscola" msgVazio="O campo nome é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputRazaoEscola" class="form_info info_g">Razão Social<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRazaoEscola" id="inputRazaoEscola" class="form_value form_text value_g formEscola obrigatorioEscola" msgVazio="O campo razão social é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputCodigoEscola" class="form_info info_m">NSE</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNseEscola" id="inputNseEscola" class="form_value form_text value_m formEscola"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputCodigoEscola" class="form_info info_m">Código</label>
                                                            <span class="input_container">
                                                                <input type="number" name="inputCodigoEscola" id="inputCodigoEscola" class="form_value form_text value_m formEscola"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCnpjEscola" class="form_info info_p">CNPJ<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCnpjEscola" id="inputCnpjEscola" class="form_value form_text value_p  formEscola obrigatorioEscola formEscola"  msgVazio="O campo CNPJ é obrigatório" required maxlength='18' OnKeyPress="formatar('##.###.###/####-##', this)"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputAdmEscola" class="form_info info_p">Administração<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputAdmEscola" id="inputAdmEscola" class="form_value form_select value_p obrigatorioEscola"  msgVazio="O campo administração é obrigatório" required>
                                                                    <!-- <option value="" disabled selected>Selecione a cidade</option> -->
                                                                    <?php 
                                                                      if(count($adms)>0) {
                                                                            foreach($adms as $a) {
                                                                              echo '<option value="'.$a->getadm_id().'">'.utf8_encode($a->getadm_administracao()).'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
														<div class="form_celula_p">
                                                            <label for="inputTipoEscola" class="form_info info_p">Tipo de escola<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputTipoEscola" id="inputTipoEscola" class="form_value form_select value_p obrigatorioEscola"  msgVazio="O campo tipo da escola é obrigatório" required>
                                                                    <!--<option value="" disabled selected>Selecione a cidade</option>-->
                                                                    <?php 
                                                                     if(count($tiposEscola)>0) {
                                                                         foreach($tiposEscola as $t) {
                                                                         		echo '<option value="'.$t->gettps_id().'">'.$t->gettps_tipo_escola().'</option>';
                                                                         }
                                                                      }
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputRuaEscola" class="form_info info_m">Rua<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRuaEscola" id="inputRuaEscola" class="form_value form_text value_m formEscola obrigatorioEscola" msgVazio="O campo rua é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputBairroEscola" class="form_info info_m">Bairro<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputBairroEscola" id="inputBairroEscola" class="form_value form_text value_m formEscola obrigatorioEscola" msgVazio="O campo bairro é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaEscola" class="form_info info_p">Número<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNumCasaEscola" id="inputNumCasaEscola" class="form_value form_number value_p formEscola obrigatorioEscola" msgVazio="O campo número é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCompCasaEscola" class="form_info info_p">Complemento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCompCasaEscola" id="inputCompCasaEscola" class="form_value form_number value_p formEscola" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEstadoEscola" class="form_info info_p">Estado<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputEstadoEscola" id="inputEstadoEscola" class="form_value form_select value_p formEscola obrigatorioEscola" msgVazio="O campo estado é obrigatório" required>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCidadeEscola" class="form_info info_p">Cidade<span class="asterisco">*</span></label>
                                                            <span class="select_container">
                                                                <select name="inputCidadeEscola" id="inputCidadeEscola" class="form_value form_select value_p formEscola obrigatorioEscola" msgVazio="O campo cidade é obrigatório" required>
                                                                	<option value="" disabled selected>Selecione um estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCepEscola" class="form_info info_p">CEP<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCepEscola" id="inputCepEscola" class="form_value form_text value_p formEscola obrigatorioEscola" msgVazio="O campo CEP é obrigatório" required OnKeyPress="formatar('##.###-###', this)"  maxlength="10"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTelefoneEscola" class="form_info info_p">Telefone<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelefoneEscola" id="inputTelefoneEscola" class="form_value form_text value_p formEscola obrigatorioEscola" msgVazio="O campo telefone é obrigatório" required OnKeyPress="formatar('## ####-#####', this)"  maxlength="13"/>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputEmailEscola" class="form_info info_g">E-mail<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailEscola" id="inputEmailEscola" class="form_value form_text value_g formEscola obrigatorioEscola" msgVazio="O campo email é obrigatório" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="cadastroImagem" class="form_info info_p">Foto</label>
                                                            <span class="input_container spanImagem" id="spanImagemEscola"></span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioEscola" class="form_info info_p">Usuário<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                            	<input type="text" name="inputUsuarioEscola" id="inputUsuarioEscola" class="form_value form_text value_p formEscola obrigatorioEscola" msgVazio="O campo usuário é obrigatório" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p" style="position: relative;">
                                                            <label for="inputSenhaEscola" class="form_info info_p">Senha<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="password" name="inputSenhaEscola" data-inputType="senha" id="inputSenhaEscola" class="form_value form_text value_p formEscola obrigatorioEscola" msgVazio="O campo senha é obrigatório" placeholder="Insira uma senha" required maxlength="10"/>
                                                            </span>
                                                            <div id="regrasSenhaEscola" class="panel panel-default regras_senha" style="display: none;">
                                                                <div class="panel-body">
                                                                    <p class="regra_char_esp text-danger">Caracter especial</p>
                                                                    <p class="regra_char_mai text-danger">Maiúscula</p>
                                                                    <p class="regra_char_min text-danger">Minúscula</p>
                                                                    <p class="regra_length text-danger">Entre 6 e 10 caracteres</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmEscola" class="form_info info_p">Senha<span class="asterisco">*</span></label>
                                                            <span class="input_container">
                                                                <input type="password" name="inputSenhaConfirmEscola" id="inputSenhaConfirmEscola" class="form_value form_text value_p formEscola" placeholder="Confirme a senha" required maxlength="10"/>
                                                            </span>
                                                        </div>

                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="hidden" value="" class="form_btn btn_submit" id="idEscola" />
                                                        <input type="hidden" value="" class="form_btn btn_submit" id="idUsuarioEscola" />
                                                        <input type="hidden" value="" class="form_btn btn_submit" id="idEnderecoEscola" />
                                                        
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroEscola" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_escola cadastroProfContent" id="updateEscolaContainer">
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
</body>
</html>
