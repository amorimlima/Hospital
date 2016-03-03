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
include_once($path['controller'].'UsuarioController.php');


$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
$usuarioController = new UsuarioController();
$escolaController = new EscolaController();
$serieController = new SerieController();

$escolas = $escolaController->selectAll();
$professor = $usuarioController->selectByPerfilUsuario(2);
$serie = $serieController->selectAll();

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
                                                    <li class="btn_tab btn_aluno btn_add_cadastro">Novo cadastro</li>
                                                    <li class="btn_tab btn_aluno btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_professor" style="display: none;">
                                                <ul class="lista_btns lista_btns_professor">
                                                    <li class="btn_tab btn_professor btn_add_cadastro">Novo cadastro</li>
                                                    <li class="btn_tab btn_professor btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_escola" style="display: none;">
                                                <ul class="lista_btns lista_btns_escola">
                                                    <li class="btn_tab btn_escola btn_update_cadastro">Confirmar cadastro</li>
                                                    <li class="btn_tab btn_escola btn_add_cadastro">Novo cadastro</li>
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
                                                <li class="tab_cadastro tab_aluno"></li>
                                                <li class="tab_cadastro tab_professor tab_cadastro_ativo"></li>
                                                <li class="tab_cadastro tab_escola"></li>
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
                                                            <label for="selectEscolaAluno" class="form_info info_m">Escola</label>
                                                            <span class="select_container">
                                                                <select name="selectEscolaAluno" id="selectEscolaAluno" class="form_value form_select value_m" required>
                                                                    <option value="" disabled selected>Selecione a escola</option>
                                                                    <?php

                                                                        if(count($escolas)>0) {
                                                                            foreach($escolas as $esc) {
                                                                                echo '<option value="'.utf8_encode($esc->getesc_id()).'">'.$esc->getesc_razao_social().'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="selectProfessorAluno" class="form_info info_m">Professor</label>
                                                            <span class="select_container">
                                                                <select name="selectProfessorAluno" id="selectProfessorAluno" class="form_value form_select value_m" required>
                                                                    <option value="" disabled selected>Selecione o professor</option>
                                                                    <?php
                                                                       if(count($professor)>0){
                                                                           foreach($professor as $prof) {
                                                                               echo '<option value="'.utf8_encode($prof->getUsr_id()).'">'.utf8_encode($prof->getUsr_nome()).'</option>';
                                                                           }
                                                                       }
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="selectPeriodoAluno" class="form_info info_p">Período</label>
                                                            <span class="select_container">
                                                                <select name="selectPeriodoAluno" id="selectPeriodoAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o período</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="selectSerieAluno" class="form_info info_p">Serie</label>
                                                            <span class="select_container">
                                                                <select name="selectSerieAluno" id="selectSerieAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione a série</option>
                                                                    <?php
                                                                    if(count($serie)>0){
                                                                        foreach($serie as $s) {
                                                                            echo '<option value="'.utf8_encode($s->getSri_id()).'">'.utf8_encode($s->getSri_serie()).'</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTurmaAluno" class="form_info info_p">Turma</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTurmaAluno" id="inputTurmaAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Pessoais</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeAluno" class="form_info info_g">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeAluno" id="inputNomeAluno" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascimentoAluno" class="form_info info_p">Nascimento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNascimentoAluno" id="inputNascimentoAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgAluno" class="form_info info_p">RG</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRgAluno" id="inputRgAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfAluno" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCpfAluno" id="inputCpfAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputRuaAluno" class="form_info info_g">Rua</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRuaAluno" id="inputRuaAluno" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaAluno" class="form_info info_p">Número</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNumCasaAluno" id="inputNumCasaAluno" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCompCasaAluno" class="form_info info_p">Complemento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCompCasaAluno" id="inputCompCasaAluno" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCepAluno" class="form_info info_p">CEP</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCepAluno" id="inputCepAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputBairroAluno" class="form_info info_p">Bairro</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputBairroAluno" id="inputBairroAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="inputPaisAluno" name="inputPaisAluno" value="Brasil" />
                                                        <div class="form_celula_p">
                                                            <label for="inputEstadoAluno" class="form_info info_p">Estado</label>
                                                            <span class="select_container">
                                                                <select name="inputEstadoAluno" id="inputEstadoAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCidadeAluno" class="form_info info_p">Cidade</label>
                                                            <span class="select_container">
                                                                <select name="inputCidadeAluno" id="inputCidadeAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione a cidade</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelResAluno" class="form_info info_p">Tel. Residencial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelResAluno" id="inputTelResAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelCelAluno" class="form_info info_p">Tel. Celular</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelCelAluno" id="inputTelCelAluno" class="form_value form_text value_p" />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTelComAluno" class="form_info info_p">Tel. Comercial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelComAluno" id="inputTelComAluno" class="form_value form_text value_p" />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputEmailAluno" class="form_info info_p">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailAluno" id="inputEmailAluno" class="form_value form_text value_p" required />
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
                                                            <label for="inputUsuarioAluno" class="form_info info_p">Usuário</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputUsuarioAluno" id="inputUsuarioAluno" class="form_value form_text value_p" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputSenhaAluno" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputSenhaAluno" id="inputSenhaAluno" class="form_value form_text value_p" placeholder="Insira uma senha" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmAluno" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputSenhaConfirmAluno" id="inputSenhaConfirmAluno" class="form_value form_text value_p" placeholder="Confirme a senha" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroAluno" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_aluno cadastroAlunoContent" id="updateAlunoContainer">
                                                    <h2 class="section_header update_cad_aluno_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_aluno_accordion">


														<a href="#updateAlunoCont1" class="accordion_info_toggler updateAlunoToggler" data-toggle="collapse">
												            <div class="accordion_info" id="updateAlunoInfo1">Diego de Moraes Garcia</div>
												        </a>
												        <div class="accordion_content collapse" id="updateAlunoCont1">
												            <div class="content_col_info">
																<table>
												                    <tr class="content_info_row">
												                         <td colspan="3"><span class="content_info_label">Escola:</span> <span class="content_info_txt">Pontifícia Universidade Católica de São Paulo</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td colspan="2"><span class="content_info_label">Professor:</span> <span class="content_info_txt">Eduardo Savino Gomes</span></td>
												                        <td><span class="content_info_label">Sala:</span> <span class="content_info_txt">LAB-010</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td><span class="content_info_label">Nascimento:</span> <span class="content_info_txt">07/01/1990</span></td>
												                        <td><span class="content_info_label">RG:</span> <span class="content_info_txt">98.765.423-2</span></td>
												                        <td><span class="content_info_label">CPF:</span> <span class="content_info_txt">345.678.901-23</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td colspan="2">
												                            <span class="content_info_label">Endereço:</span>
												                            <span class="content_info_txt">
												                                Rua Monte Alegre, 984, Perdizes - São Paulo - SP
												                            </span>
												                        </td>
												                        <td><span class="content_info_label">CEP:</span> <span class="content_info_txt">05014-901</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td><span class="content_info_label">Tel.:</span> <span class="content_info_txt">(11) 4325-4343</span></td>
												                        <td colspan="2"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">dugo.03@gmail.com</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td colspan="3"><span class="content_info_label">Usuário:</span> <span class="content_info_txt">diego_moraes</span></td>
												                    </tr>
												                </table>
												            </div>
												            <div class="content_col_btns">
												                <button id="btnDelAluno1" class="section_btn btn_del_cad btnDelCadAluno">Excluir cadastro</button>
												                <button id="btnUpdateAluno1" class="section_btn btn_update_cad btnUpdateCadAluno">Alterar Dados</button>
												            </div>
												        </div>

                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_professor" style="display: none;">
                                                <form action="" class="form_cadastro cadastro_prof cadastroProfContent" id="formCadastroProf" style="display: none;">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Pessoais</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeProf" class="form_info info_g">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeProf" id="inputNomeProf" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascimentoProf" class="form_info info_p">Nascimento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNascimentoProf" id="inputNascimentoProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgProf" class="form_info info_p">RG</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRgProf" id="inputRgProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfProf" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCpfProf" id="inputCpfProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputRuaProf" class="form_info info_g">Rua</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRuaProf" id="inputRuaProf" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaProf" class="form_info info_p">Número</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNumCasaProf" id="inputNumCasaProf" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCompCasaProf" class="form_info info_p">Complemento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCompCasaProf" id="inputCompCasaProf" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCepProf" class="form_info info_p">CEP</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCepProf" id="inputCepProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputBairroProf" class="form_info info_p">Bairro</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputBairroProf" id="inputBairroProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="inputPaisProf" name="inputPaisProf" value="Brasil" />
                                                        <div class="form_celula_p">
                                                            <label for="inputEstadoProf" class="form_info info_p">Estado</label>
                                                            <span class="select_container">
                                                                <select name="" id="inputEstadoProf" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCidadeProf" class="form_info info_p">Cidade</label>
                                                            <span class="select_container">
                                                                <select name="inputCidadeProf" id="inputCidadeProf" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione a cidade</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelResProf" class="form_info info_p">Tel. Residencial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelResProf" id="inputTelResProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelCelProf" class="form_info info_p">Tel. Celular</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelCelProf" id="inputTelCelProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTelComProf" class="form_info info_p">Tel. Comercial</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelComProf" id="inputTelComProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputEmailProf" class="form_info info_g">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailProf" id="inputEmailProf" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioProf" class="form_info info_p">Usuário</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputUsuarioProf" id="inputUsuarioProf" class="form_value form_text value_p" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputSenhaProf" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputSenhaProf" id="inputSenhaProf" class="form_value form_text value_p" placeholder="Insira uma senha" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmProf" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputSenhaConfirmProf" id="inputSenhaConfirmProf" class="form_value form_text value_p" placeholder="Confirme a senha" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroProfessor" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_prof cadastroProfContent" id="updateProfContainer">
                                                    <h2 class="section_header update_cad_prof_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_prof_accordion">


														<a href="#updateProfCont1" class="accordion_info_toggler updateProfToggler" data-toggle="collapse">
												            <div class="accordion_info" id="updateProfInfo1">Andressa de Cardoso Dias</div>
												        </a>
												        <div class="accordion_content collapse" id="updateProfCont1">
												            <div class="content_col_info">
																<table>
												                    <tr class="content_info_row">
												                        <td><span class="content_info_label">Nascimento:</span> <span class="content_info_txt">10/05/1977</span></td>
												                        <td><span class="content_info_label">RG:</span> <span class="content_info_txt">12.345.678-9</span></td>
												                        <td><span class="content_info_label">CPF:</span> <span class="content_info_txt">123.456.789-10</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td colspan="2"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">
												                            Rua Embirussú, 56 - Vila Beatriz - SP - São Paulo</span></td>
												                        <td><span class="content_info_label">CEP:</span> <span class="content_info_txt">03434-034</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td><span class="content_info_label">Tel.:</span> <span class="content_info_txt">(11) 3432-9174</span></td>
												                        <td colspan="2"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">andressadecardoso@gmail.com</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td colspan="3"><span class="content_info_txt">E.M.E.F. Deputado Januário Mantelli Neto - 3º série A - Manhã</span></td>
												                    </tr>
												                    <tr class="content_info_row">
												                        <td colspan="3"><span class="content_info_label">Usuário</span> <span class="content_info_txt">andressa_card</span></td>
												                    </tr>
												                </table>
															</div>
												            <div class="content_col_btns">
												                <button id="btnDelProf1" class="section_btn btn_del_cad btnDelCadProf">Excluir cadastro</button>
												                <button id="btnUpdateProf1" class="section_btn btn_update_cad btnUpdateCadProf">Alterar Dados</button>
												            </div>
												        </div>



                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_escola" style="display: none;">
                                                <form action="" class="form_cadastro cadastro_escola cadastroEscolaContent" id="formCadastroEscola" style="display: none;">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados</legend>
                                                        <div class="form_celula_m">
                                                            <label for="inputNomeEscola" class="form_info info_m">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputNomeEscola" id="inputNomeEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputCodigoEscola" class="form_info info_m">Código</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCodigoEscola" id="inputCodigoEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputRuaEscola" class="form_info info_m">Rua</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputRuaEscola" id="inputRuaEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputBairroEscola" class="form_info info_m">Bairro</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputBairroEscola" id="inputBairroEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaEscola" class="form_info info_p">Número</label>
                                                            <span class="input_container">
                                                                <input type="number" name="inputNumCasaEscola" id="inputNumCasaEscola" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCompCasaEscola" class="form_info info_p">Complemento</label>
                                                            <span class="input_container">
                                                                <input type="number" name="inputCompCasaEscola" id="inputCompCasaEscola" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="inputPaisEscola" name="inputPaisEscola" value="Brasil" />
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEstadoEscola" class="form_info info_p">Estado</label>
                                                            <span class="select_container">
                                                                <select name="inputEstadoEscola" id="inputEstadoEscola" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCidadeEscola" class="form_info info_p">Cidade</label>
                                                            <span class="select_container">
                                                                <select name="inputCidadeEscola" id="inputCidadeEscola" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione a cidade</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCepEscola" class="form_info info_p">CEP</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputCepEscola" id="inputCepEscola" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTelefoneEscola" class="form_info info_p">Telefone</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputTelefoneEscola" id="inputTelefoneEscola" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_g">
                                                            <label for="inputEmailEscola" class="form_info info_g">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputEmailEscola" id="inputEmailEscola" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioEscola" class="form_info info_p">Usuário</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputUsuarioEscola" id="inputUsuarioEscola" class="form_value form_text value_p" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputSenhaEscola" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputSenhaEscola" id="inputSenhaEscola" class="form_value form_text value_p" placeholder="Insira uma senha" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmEscola" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="inputSenhaConfirmEscola" id="inputSenhaConfirmEscola" class="form_value form_text value_p" placeholder="Confirme a senha" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroEscola" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_escola cadastroProfContent" id="updateProfContainer">
                                                    <h2 class="section_header update_cad_escola_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_escola_accordion">
                                                        <a href="#updateEscolaCont1" class="accordion_info_toggler updateAlunoToggler" data-toggle="collapse">
                                                            <div class="accordion_info" id="updateEscolaInfo1">E.M.E.F. Deputado Januário Mantelli Neto </div>
                                                        </a>
                                                        <div class="accordion_content collapse" id="updateEscolaCont1">
                                                            <div class="content_col_info">
                                                                <table>
                                                                    <tr class="content_info_row">
                                                                        <td colspan="2"><span class="content_info_label">Endereço:</span> <span class="content_info_txt">Rua Caiçara do Rio do Vento, 43 - Vila Cisper - São Paulo - SP</span></td>
                                                                        <td><span class="content_info_label">CEP:</span> <span class="content_info_txt">03817-090</span></td>
                                                                    </tr>
                                                                    <tr class="content_info_row">
                                                                    	<td colspan="2"><span class="content_info_label">E-mail:</span> <span class="content_info_txt">nanda_hr@outlook.com</span></td>
                                                                    	<td><span class="content_info_label">Tel.:</span> <span class="content_info_txt">+55 (11) 96543-9876</span></td>
                                                                    </tr>
                                                                    <tr class="content_info_row">
                                                                    	<td colspan="3"><span class="content_info_label">Código:</span> <span class="content_info_txt">567</span></td>
                                                                    </tr>
                                                                    <tr class="content_info_row">
                                                                    	<td colspan="3"><span class="content_info_label">Usuário:</span> <span class="content_info_txt">emef_januario</span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="content_col_btns">
                                                                <button class="section_btn btn_del_cad">Excluir cadastro</button>
                                                                <button class="section_btn btn_update_cad">Alterar Dados</button>
                                                            </div>
                                                        </div>
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
                                        <button type="button" class="generic_btn" data-dismiss="modal" onclick="">Sim</button>
                                        <button type="button" class="generic_btn" data-dismiss="modal" onclicl="">Não</button>
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
	<div id="mensagemErroDeletar" class='modalMensagem' style="display:none">
		<?php
			$templateGeral->mensagemRetorno('mensagens','Selecione uma mensagem para ser deletada!','erro');
		?>
	</div>
	<div id="mensagemSucessoDeletar" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','Mensagem deletada com sucesso!','sucesso');
		?>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="js/funcoes.js"></script>
	<script src="js/cadastro.js"></script>
</body>
</html>
