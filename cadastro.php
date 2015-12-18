<?php 

if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();

$logado = unserialize($_SESSION['USR']);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Área Administração</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
                                <!-- Cabeçalho -->
                            </div>
                            <main class="conteudo_box_area_admin">
                                <!-- Conteúdo principal -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <section class="area_btns_tabs">
                                            <div class="btns_tabs btns_aluno" style="display: none;">
                                                <ul class="lista_btns lista_btns_aluno">
                                                    <li class="btn_tab btn_aluno btn_add_cadastro btn_tab_ativo">Novo cadastro</li>
                                                    <li class="btn_tab btn_aluno btn_update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_professor">
                                                <ul class="lista_btns lista_btns_professor">
                                                    <li class="btn_tab btn_professor btn_confirm_cadastro">Confirmar Cadastro</li>
                                                    <li class="btn_tab btn_professor btn_add_cadastro btn_tab_ativo">Novo cadastro</li>
                                                    <li class="btn_tab btn_professor btn_update_cadastro">Atualizar cadastro</li>
                                                </ul>
                                            </div>
                                            <div class="btns_tabs btns_escola" style="display: none;">
                                                <ul class="lista_btns lista_btns_escola">
                                                    <li class="btn_tab btn_escola btn_confirm_cadastro">Confirmar Cadastro</li>
                                                    <li class="btn_tab btn_escola btn_add_cadastro btn_tab_ativo">Novo cadastro</li>
                                                    <li class="btn_tab btn_escola btn_update_cadastro">Atualizar cadastro</li>
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
                                            <div class="conteudo_tab conteudo_aluno" style="display: none;">
                                                <form action="" class="form_cadastro cadastro_aluno cadastroAlunoContent" id="formCadastroAluno">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Escolares</legend>
                                                        <div class="form_celula_m">
                                                            <label for="selectEscolaAluno" class="form_info info_m">Escola</label>
                                                            <span class="select_container">
                                                                <select name="" id="selectEscolaAluno" class="form_value form_select value_m" required>
                                                                    <option value="" disabled selected>Selecione a escola</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="selectProfessorAluno" class="form_info info_m">Professor</label>
                                                            <span class="select_container">
                                                                <select name="" id="selectProfessorAluno" class="form_value form_select value_m" required>
                                                                    <option value="" disabled selected>Selecione o professor</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="selectPeriodoAluno" class="form_info info_p">Período</label>
                                                            <span class="select_container">
                                                                <select name="" id="selectPeriodoAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o período</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="selectSerieAluno" class="form_info info_p">Serie</label>
                                                            <span class="select_container">
                                                                <select name="" id="selectSerieAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione a série</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputTurmaAluno" class="form_info info_p">Turma</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputTurmaAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Pessoais</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeAluno" class="form_info info_g">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNomeAluno" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascimentoAluno" class="form_info info_p">Nascimento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNascimentoAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgAluno" class="form_info info_p">RG</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputRgAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfAluno" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCpfAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputRuaAluno" class="form_info info_m">Rua</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputRuaAluno" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputBairroAluno" class="form_info info_m">Bairro</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputBairroAluno" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaAluno" class="form_info info_p">Número</label>
                                                            <span class="input_container">
                                                                <input type="number" name="" id="inputNumCasaAluno" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCidadeAluno" class="form_info info_p">Cidade</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCidadeAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEstadoAluno" class="form_info info_p">Estado</label>
                                                            <span class="select_container">
                                                                <select name="" id="inputEstadoAluno" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCepAluno" class="form_info info_p">CEP</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCepAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelefoneAluno" class="form_info info_p">Telefone</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputTelefoneAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEmailAluno" class="form_info info_p">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputEmailAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados do Responsável</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeRespAluno" class="form_info info_g">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNomeRespAluno" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascRespAluno" class="form_info info_p">Nascimento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNascRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgRespAluno" class="form_info info_p">RG</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputRgRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfRespAluno" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCpfRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputTelRespAluno" class="form_info info_m">Telefone</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputTelRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputEmailRespAluno" class="form_info info_m">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputEmailRespAluno" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioAluno" class="form_info info_p">Usuário</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputUsuarioAluno" class="form_value form_text value_p" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputSenhaAluno" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputSenhaAluno" class="form_value form_text value_p" placeholder="Insira uma senha" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmAluno" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputSenhaConfirmAluno" class="form_value form_text value_p" placeholder="Confirme a senha" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_aluno cadastroAlunoContent" id="updateAlunoContainer" style="display: none;"></section>
                                            </div>
                                            <div class="conteudo_tab conteudo_professor">
                                                <section class="confirm_cadastro confirm_aluno cadastroProfContent" id="confirmProfContainer" style="display: none;"></section>
                                                <form action="" class="form_cadastro cadastro_prof cadastroProfContent" id="formCadastroProf">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados Pessoais</legend>
                                                        <div class="form_celula_g">
                                                            <label for="inputNomeProf" class="form_info info_g">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNomeProf" class="form_value form_text value_g" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNascimentoProf" class="form_info info_p">Nascimento</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNascimentoProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputRgProf" class="form_info info_p">RG</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputRgProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputCpfProf" class="form_info info_p">CPF</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCpfProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputRuaProf" class="form_info info_m">Rua</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputRuaProf" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputBairroProf" class="form_info info_m">Bairro</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputBairroProf" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaProf" class="form_info info_p">Número</label>
                                                            <span class="input_container">
                                                                <input type="number" name="" id="inputNumCasaProf" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCidadeProf" class="form_info info_p">Cidade</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCidadeProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEstadoProf" class="form_info info_p">Estado</label>
                                                            <span class="select_container">
                                                                <select name="" id="inputEstadoProf" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCepProf" class="form_info info_p">CEP</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCepProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelefoneProf" class="form_info info_p">Telefone</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputTelefoneProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEmailProf" class="form_info info_p">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputEmailProf" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioProf" class="form_info info_p">Usuário</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputUsuarioProf" class="form_value form_text value_p" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputSenhaProf" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputSenhaProf" class="form_value form_text value_p" placeholder="Insira uma senha" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmProf" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputSenhaConfirmProf" class="form_value form_text value_p" placeholder="Confirme a senha" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_aluno cadastroProfContent" id="updateProfContainer" style="display: none;"></section>
                                            </div>
                                            <div class="conteudo_tab conteudo_escola" style="display: none;">
                                                <form action="" class="form_cadastro cadastro_escola cadastroEscolaContent" id="formCadastroEscola">
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Dados</legend>
                                                        <div class="form_celula_m">
                                                            <label for="inputNomeEscola" class="form_info info_m">Nome</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputNomeEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputCodigoEscola" class="form_info info_m">Código</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCodigoEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m">
                                                            <label for="inputRuaEscola" class="form_info info_m">Rua</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputRuaEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_m value_last">
                                                            <label for="inputBairroEscola" class="form_info info_m">Bairro</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputBairroEscola" class="form_value form_text value_m" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputNumCasaEscola" class="form_info info_p">Número</label>
                                                            <span class="input_container">
                                                                <input type="number" name="" id="inputNumCasaEscola" class="form_value form_number value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCidadeEscola" class="form_info info_p">Cidade</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCidadeEscola" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEstadoEscola" class="form_info info_p">Estado</label>
                                                            <span class="select_container">
                                                                <select name="" id="inputEstadoEscola" class="form_value form_select value_p" required>
                                                                    <option value="" disabled selected>Selecione o estado</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputCepEscola" class="form_info info_p">CEP</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputCepEscola" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputTelefoneEscola" class="form_info info_p">Telefone</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputTelefoneEscola" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputEmailEscola" class="form_info info_p">E-mail</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputEmailEscola" class="form_value form_text value_p" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form_divisao">
                                                        <legend class="form_divisao_titulo">Acesso</legend>
                                                        <div class="form_celula_p">
                                                            <label for="inputUsuarioEscola" class="form_info info_p">Usuário</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputUsuarioEscola" class="form_value form_text value_p" placeholder="Insira um nome de usuário" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p">
                                                            <label for="inputSenhaEscola" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputSenhaEscola" class="form_value form_text value_p" placeholder="Insira uma senha" required />
                                                            </span>
                                                        </div>
                                                        <div class="form_celula_p value_last">
                                                            <label for="inputSenhaConfirmEscola" class="form_info info_p">Senha</label>
                                                            <span class="input_container">
                                                                <input type="text" name="" id="inputSenhaConfirmEscola" class="form_value form_text value_p" placeholder="Confirme a senha" required />
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form_btns_container">
                                                        <input type="reset" value="Limpar" class="form_btn btn_reset" />
                                                        <input type="submit" value="Enviar" class="form_btn btn_submit" />
                                                    </div>
                                                </form>
                                                <section class="update_cadastro update_aluno cadastroProfContent" id="updateProfContainer" style="display: none;"></section>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </main>
                        </div>

                        <!-- Modal -->
                        <!-- Trigger the modal with a button
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button> -->
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
