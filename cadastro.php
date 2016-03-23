<?php 
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'].'Template.php');
include_once($path['template'].'TemplateMensagens.php');
include_once($path['template'].'TemplateCadastro.php');
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'SerieController.php');
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'AdministracaoController.php');
include_once($path['controller'].'TipoEscolaController.php');
include_once($path['controller'].'AnoLetivoController.php');
include_once($path['controller'].'GrauInstrucaoController.php');
include_once($path['controller'].'CategoriaFuncionalController.php');

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
$templateCadastro = new TemplateCadastro();
$usuarioController = new UsuarioController();
$escolaController = new EscolaController();
$serieController = new SerieController();
$AdmController = new AdministracaoController();
$tipoEscolaController = new TipoEscolaController();
$anoController = new AnoLetivoController();
$grauInstController = new GrauInstrucaoController();
$categoriaController = new CategoriaFuncionalController();

$escolas = $escolaController->selectAll();
//$professor = $usuarioController->selectByPerfilUsuario(2);
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
if(count($serie)>0){
	foreach($serie as $s) {
   		$serieHtml .= '<option value="'.utf8_encode($s->getSri_id()).'">'.utf8_encode($s->getSri_serie()).'</option>';
    }
}

if(count($escolas)>0) {
	foreach($escolas as $esc) {
    	$escolasHtml .= '<option value="'.utf8_encode($esc->getesc_id()).'">'.utf8_encode($esc->getesc_razao_social()).'</option>';
    }
}

$path = $_SESSION['PATH_SYS'];
$logado = unserialize($_SESSION['USR']);

//print_r($anos);
//echo "<br>"; 
//foreach ($anos as $a){
//	print_r($a->getAno_ano());
//	echo "<br>";
//	echo "<br>";
//}

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
                                        <?php
                                            $templateCadastro->botoesCadastro();
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-2">
                                        <?php
                                            $templateCadastro->abasLaterais();
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-md-10">
                                        <section class="area_conteudo_tabs">
                                            <div class="conteudo_tab conteudo_aluno">
                                                <?php
                                                    if ($logado["perfil_id"] != 3 && $logado["perfil_id"] != 1) 
                                                    {
                                                        echo '<form action="" class="form_cadastro cadastro_aluno cadastroAlunoContent" id="formCadastroAluno" style="display: none;">';
                                                        echo     '<fieldset class="form_divisao">';
                                                        echo         '<legend class="form_divisao_titulo">Dados Escolares</legend>';
                                                        echo         '<div class="form_celula_m">';
                                                        echo             '<label for="selectEscolaAluno" class="form_info info_m">Escola</label>';
                                                        echo             '<span class="select_container">';
                                                        echo                 '<select name="selectEscolaAluno" id="selectEscolaAluno" class="form_value form_select value_m obrigatorioAluno" msgVazio="O campo escola é obrigatório" required onChange="listaProfessores()">';
                                                        echo                     '<option value="" disabled selected>Selecione a escola</option>';
        												echo                     $escolasHtml;
                                                        echo                '</select>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_m value_last">';
                                                        echo            '<label for="selectSerieAluno" class="form_info info_m">Série</label>';
                                                        echo            '<span class="select_container">';
                                                        echo                '<select name="selectSerieAluno" id="selectSerieAluno" class="form_value form_select value_m obrigatorioAluno" msgVazio="O campo série é obrigatório" required onChange="listaProfessores()">';
                                                        echo                    '<option value="" disabled selected>Selecione a série</option>';
                                                        echo                    $serieHtml;
                                                        echo                '</select>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_m">';
                                                        echo            '<label for="selectProfessorAluno" class="form_info info_m" >Professor</label>';
                                                        echo            '<span class="select_container">';
                                                        echo                '<select name="selectProfessorAluno" id="selectProfessorAluno" class="form_value form_select value_m obrigatorioAluno" msgVazio="O campo professor é obrigatório" required>';
                                                                                //ATENÇÂO - Se mudar o texto desse option precisa mudar em mais dois lugares no arquivo cadastro.js. -->
                                                        echo                    '<option value="" disabled selected>Selecione primeiro a escola e a série</option>';
                                                        echo                '</select>';
                                                        echo            '</span>';
                                                        echo        '</div>';
        												echo		'<div class="form_celula_m value_last">';
                                                        echo            '<label for="selectPeriodoAluno" class="form_info info_m">Ano Letivo</label>';
                                                        echo            '<span class="select_container">';
                                                        echo                '<select name="selectAnoAluno" id="selectAnoAluno" class="form_value form_select value_m" required>';
                                                                                if(count($anos)>0){
                                                                                    foreach($anos as $a) {
                                                                                    	$selected = '';
                                                                                    	if (date(Y) == $a->getAno_ano()) $selected = 'selected';
                                                                                        echo '<option '.$selected.' value="'.utf8_encode($a->getAno_id()).'">'.utf8_encode($a->getAno_ano()).'</option>';
                                                                                    }
                                                                                }
                                                        echo                '</select>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                                    /*<div class="form_celula_p value_last">
                                                                    <label for="inputTurmaAluno" class="form_info info_p">Sala</label>
                                                                        <span class="input_container">
                                                                            <input type="text" name="inputTurmaAluno" id="inputTurmaAluno" class="form_value form_text value_p"/>
                                                                        </span>
                                                                    </div>*/
                                                        echo        '</fieldset>';
                                                        echo        '<fieldset class="form_divisao">';
                                                        echo            '<legend class="form_divisao_titulo">Dados Pessoais</legend>';
                                                        echo            '<div class="form_celula_g">';
                                                        echo                '<label for="inputNomeAluno" class="form_info info_g">Nome</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputNomeAluno" id="inputNomeAluno" class="form_value form_text value_g obrigatorioAluno" msgVazio="O campo nome é obrigatório" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputNascimentoAluno" class="form_info info_p">Nascimento</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputNascimentoAluno" id="inputNascimentoAluno" class="form_value form_text value_p obrigatorioAluno data" msgVazio="O campo nascimento é obrigatório" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputRgAluno" class="form_info info_p">RG</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputRgAluno" id="inputRgAluno" class="form_value form_text value_p obrigatorioAluno" msgVazio="O campo RG é obrigatório" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p value_last">';
                                                        echo                '<label for="inputCpfAluno" class="form_info info_p">CPF</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputCpfAluno" id="inputCpfAluno" class="form_value form_text value_p obrigatorioAluno" msgVazio="O campo CPF é obrigatório" OnKeyPress="formatar(\'###.###.###-##\', this, \'cpf\')" maxlength="14" />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_g">';
                                                        echo                '<label for="inputRuaAluno" class="form_info info_g">Rua</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputRuaAluno" id="inputRuaAluno" class="form_value form_text value_g obrigatorioAluno" msgVazio="O campo rua é obrigatório" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputNumCasaAluno" class="form_info info_p">Número</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputNumCasaAluno" id="inputNumCasaAluno" class="form_value form_number value_p obrigatorioAluno" msgVazio="O campo número é obrigatório" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputCompCasaAluno" class="form_info info_p">Complemento</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputCompCasaAluno" id="inputCompCasaAluno" class="form_value form_number value_p" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p value_last">';
                                                        echo                '<label for="inputCepAluno" class="form_info info_p">CEP</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputCepAluno" id="inputCepAluno" class="form_value form_text value_p obrigatorioAluno" msgVazio="O campo CEP é obrigatório" required OnKeyPress="formatar(\'##.###-###\', this)" maxlength="10"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputBairroAluno" class="form_info info_p">Bairro</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputBairroAluno" id="inputBairroAluno" class="form_value form_text value_p obrigatorioAluno" msgVazio="O campo bairro é obrigatório" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<input type="hidden" id="inputPaisAluno" name="inputPaisAluno" value="Brasil" />';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputEstadoAluno" class="form_info info_p">Estado</label>';
                                                        echo                '<span class="select_container">';
                                                        echo                    '<select name="inputEstadoAluno" id="inputEstadoAluno" class="form_value form_select value_p obrigatorioAluno" msgVazio="O campo estado é obrigatório" required>';
                                                        echo                    '</select>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p value_last">';
                                                        echo                '<label for="inputCidadeAluno" class="form_info info_p">Cidade</label>';
                                                        echo                '<span class="select_container">';
                                                        echo                    '<select name="inputCidadeAluno" id="inputCidadeAluno" class="form_value form_select value_p obrigatorioAluno" msgVazio="O campo cidade é obrigatório" required>';
                                                        echo                        '<option value="" disabled selected>Selecione um estado</option>';
                                                        echo                    '</select>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputTelResAluno" class="form_info info_p">Tel. Residencial</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputTelResAluno" id="inputTelResAluno" class="form_value form_text value_p obrigatorioAluno" required  OnKeyPress="formatar(\'## ####-#####\', this)"  maxlength="13" msgVazio="Pelo menos um número de telefone deve ser cadastrado"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputTelCelAluno" class="form_info info_p">Tel. Celular</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputTelCelAluno" id="inputTelCelAluno" class="form_value form_text value_p" OnKeyPress="formatar(\'## ####-#####\', this)"  maxlength="13"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p value_last">';
                                                        echo                '<label for="inputTelComAluno" class="form_info info_p">Tel. Comercial</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputTelComAluno" id="inputTelComAluno" class="form_value form_text value_p" OnKeyPress="formatar(\'## ####-#####\', this)"  maxlength="13"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_g">';
                                                        echo                '<label for="inputEmailAluno" class="form_info info_p">E-mail</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputEmailAluno" id="inputEmailAluno" class="form_value form_text value_p" required />';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_g" style="height: auto; min-height: 40px;">';
                                                        echo               '<label for="cadastroImagem" class="form_info info_p">Foto</label>';
                                                        echo                 '<span class="input_container spanImagem" id="spanImagemAluno">';
                                                        echo                 	'<div id="cadastroImagemUpload">';
        		                                        echo                  	'<div id="cadastroImagem" class="divImagem"></div>';
        											 	echo					'<div id="car"></div>';
        											 	echo				    '<br><div id="imgUp" style="position:relative; top: -11px;"><img src="" width="150" height="150"/><br/></div>';
        											 	echo				    '<input name="imagem" type="hidden" id="imagem" value=""></td>';
        											 	echo			    '</div>';
        											 	echo			'</span>';
                                                        echo            '</div>';
                                                        echo        '</fieldset>                                                ';
                                                        echo        '<fieldset class="form_divisao">';
                                                        echo            '<legend class="form_divisao_titulo">Acesso</legend>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputUsuarioAluno" class="form_info info_p">Usuário</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="text" name="inputUsuarioAluno" id="inputUsuarioAluno" class="form_value form_text value_p obrigatorioAluno" msgVazio="O campo usuário é obrigatório" placeholder="Insira um usuário de usuário" required maxlength="10"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p">';
                                                        echo                '<label for="inputSenhaAluno" class="form_info info_p">Senha</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="password" name="inputSenhaAluno" id="inputSenhaAluno" class="form_value form_text value_p  obrigatorioAluno" msgVazio="O campo senha é obrigatório" placeholder="Insira uma senha" required maxlength="10"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_p value_last">';
                                                        echo                '<label for="inputSenhaConfirmAluno" class="form_info info_p">Senha</label>';
                                                        echo                '<span class="input_container">';
                                                        echo                    '<input type="password" name="inputSenhaConfirmAluno" id="inputSenhaConfirmAluno" class="form_value form_text value_p" placeholder="Confirme a senha" required maxlength="10"/>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo        '</fieldset>';
                                                        echo        '<div class="form_btns_container">';
                                                        echo            '<input type="reset" value="Limpar" class="form_btn btn_reset" />';
                                                        echo            '<input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroAluno" />';
                                                        echo        '</div>';
                                                        echo    '</form>';
                                                    }
                                                ?>
                                                <section class="update_cadastro update_aluno cadastroAlunoContent" id="updateAlunoContainer">
                                                    <h2 class="section_header update_cad_aluno_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_aluno_accordion">
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="conteudo_tab conteudo_professor" style="display: none;">
                                            	
                                                <?php
                                                    if ($logado["perfil_id"] == 4)
                                                    {
                                                        echo '<form action="" class="form_cadastro cadastro_prof cadastroProfContent" id="formCadastroProf" style="display: none;">';
                                                        echo     '<fieldset class="form_divisao">';
                                                        echo         '<legend class="form_divisao_titulo">Dados Pessoais</legend>';
                                                        echo             '<div class="form_celula_g">';
                                                        echo                 '<label for="inputNomeProf" class="form_info info_m">Nome</label>';
                                                        echo                 '<span class="input_container">';
                                                        echo                     '<input type="text" name="inputNomeProf" id="inputNomeProf" class="form_value form_text value_m obrigatorioProf" required msgVazio="O campo nome é obrigatório"/>';
                                                        echo                 '</span>';
                                                        echo             '</div>';
                                                        echo             '<div class="form_celula_m">';
                                                        echo                 '<label for="selectSerieProf" class="form_info info_p">Série</label>';
                                                        echo                 '<span class="select_container">';
                                                        echo                     '<select name="selectSerieProf" id="selectSerieProf" class="form_value form_select value_p obrigatorioProf" msgVazio="O campo série é obrigatório" required>';
                                                        echo                         '<option value="" disabled selected>Selecione a série</option>';
                                                        echo                         $serieHtml;
                                                        echo                    '</select>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo           ' <div class="form_celula_m value_last">';
                                                        echo               ' <label for="selectCategoriaProf" class="form_info info_m">Categoria Funcional</label>';
                                                        echo               ' <span class="select_container">';
                                                        echo                   ' <select name="selectCategoriaProf" id="selectCategoriaProf" class="form_value form_select value_m"required>';
                                                        echo                       ' <option value="null" selected>Selecione a categoria</option>';

                                                                                    if(count($cats)>0){
                                                                                        foreach($cats as $c) {
                                                                                            //echo '<option value="'.$g->getGrt_id().'">'.utf8_encode($s->getGrt_instrucao()).'</option>';
                                                                                            echo '<option value="'.$c->getctf_id().'">'.utf8_encode($c->getctf_categoria()).'</option>';
                                                                                        }
                                                                                    }

                                                        echo                    '</select>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_m">';
                                                        echo                '<label for="selectGrauProf" class="form_info info_m">Instrução</label>';
                                                        echo                '<span class="select_container">';
                                                        echo                    '<select name="selectGrauProf" id="selectGrauProf" class="form_value form_select value_m"required>';
                                                        echo                        '<option value="null" selected>Selecione a intrução</option>';

                                                                                    if(count($graus)>0){
                                                                                        foreach($graus as $g) {
                                                                                            //echo '<option value="'.$g->getGrt_id().'">'.utf8_encode($s->getGrt_instrucao()).'</option>';
                                                                                            echo '<option value="'.$g->getGrt_id().'">'.utf8_encode($g->getGrt_instrucao()).'</option>';
                                                                                        }
                                                                                    }

                                                        echo                    '</select>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo            '<div class="form_celula_m value_last">';
                                                        echo                '<label for="selectGrauProf" class="form_info info_g">Perfil</label>';
                                                        echo                '<span class="select_container">';
                                                        echo                    '<select name="perfil" id="perfil" class="form_value form_select value_g" required>';
                                                        echo                        '<option value="2" selected>Professor</option>';
                                                        echo                        '<option value="4">Unidade Escolar</option>';
                                                        echo                    '</select>';
                                                        echo                '</span>';
                                                        echo            '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputNascimentoProf" class="form_info info_p">Nascimento</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputNascimentoProf" id="inputNascimentoProf" class="form_value form_text value_p obrigatorioProf data" required msgVazio="O campo nascimento é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputRgProf" class="form_info info_p">RG</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputRgProf" id="inputRgProf" class="form_value form_text value_p obrigatorioProf" required msgVazio="O campo RG é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p value_last">';
                                                        echo            '<label for="inputCpfProf" class="form_info info_p">CPF</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputCpfProf" id="inputCpfProf" class="form_value form_text value_p obrigatorioProf" required OnKeyPress="formatar(\'###.###.###-##\', this)" msgVazio="O campo CPF é obrigatório" maxlength="14"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_g">';
                                                        echo            '<label for="inputRuaProf" class="form_info info_g">Rua</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputRuaProf" id="inputRuaProf" class="form_value form_text value_g obrigatorioProf" required msgVazio="O campo rua é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputNumCasaProf" class="form_info info_p">Número</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputNumCasaProf" id="inputNumCasaProf" class="form_value form_number value_p obrigatorioProf" required msgVazio="O campo número é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputCompCasaProf" class="form_info info_p">Complemento</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputCompCasaProf" id="inputCompCasaProf" class="form_value form_number value_p" required />';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p value_last">';
                                                        echo            '<label for="inputCepProf" class="form_info info_p">CEP</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputCepProf" id="inputCepProf" class="form_value form_text value_p obrigatorioProf" required msgVazio="O campo CEP é obrigatório" OnKeyPress="formatar(\'##.###-###\', this)" maxlength="10"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputBairroProf" class="form_info info_p">Bairro</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputBairroProf" id="inputBairroProf" class="form_value form_text value_p obrigatorioProf" required msgVazio="O campo bairro é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<input type="hidden" id="inputPaisProf" name="inputPaisProf" value="Brasil" />';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputEstadoProf" class="form_info info_p">Estado</label>';
                                                        echo            '<span class="select_container">';
                                                        echo                '<select name="" id="inputEstadoProf" class="form_value form_select value_p obrigatorioProf" required msgVazio="O campo estado é obrigatório">';
                                                                            //<!-- <option value="" disabled selected>Selecione o estado</option>-->';
                                                        echo                '</select>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p value_last">';
                                                        echo            '<label for="inputCidadeProf" class="form_info info_p">Cidade</label>';
                                                        echo            '<span class="select_container">';
                                                        echo                '<select name="inputCidadeProf" id="inputCidadeProf" class="form_value form_select value_p obrigatorioProf" required msgVazio="O campo cidade é obrigatório">';
                                                        echo                    '<option value="" disabled selected>Selecione a cidade</option>';
                                                        echo                '</select>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputTelResProf" class="form_info info_p">Tel. Residencial</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputTelResProf" id="inputTelResProf" class="form_value form_text value_p obrigatorioProf" required OnKeyPress="formatar(\'## ####-#####\', this)" msgVazio="Pelo menos um número de telefone deve ser cadastrado" maxlength="13"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputTelCelProf" class="form_info info_p">Tel. Celular</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputTelCelProf" id="inputTelCelProf" class="form_value form_text value_p" OnKeyPress="formatar(\'## ####-#####\', this)" maxlength="13"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p value_last">';
                                                        echo            '<label for="inputTelComProf" class="form_info info_p">Tel. Comercial</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputTelComProf" id="inputTelComProf" class="form_value form_text value_p" OnKeyPress="formatar(\'## ####-#####\', this)" maxlength="13"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_g">';
                                                        echo            '<label for="inputEmailProf" class="form_info info_g">E-mail</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputEmailProf" id="inputEmailProf" class="form_value form_text value_g  obrigatorioProf" required msgVazio="O campo email é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_g" style="height: auto; min-height: 40px;">';
                                                        echo            '<label for="cadastroImagem" class="form_info info_p">Foto</label>';
                                                        echo            '<span class="input_container spanImagem" id="spanImagemProfessor"></span>';
                                                        echo        '</div>';
                                                        echo    '</fieldset>';
                                                        echo    '<fieldset class="form_divisao">';
                                                        echo        '<legend class="form_divisao_titulo">Acesso</legend>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputUsuarioProf" class="form_info info_p">Usuário</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="text" name="inputUsuarioProf" id="inputUsuarioProf" class="form_value form_text value_p  obrigatorioProf" placeholder="Insira um nome de usuário" required msgVazio="O campo usuário é obrigatório"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p">';
                                                        echo            '<label for="inputSenhaProf" class="form_info info_p">Senha</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="password" name="inputSenhaProf" id="inputSenhaProf" class="form_value form_text value_p  obrigatorioProf" placeholder="Insira uma senha" required msgVazio="O campo senha é obrigatório" maxlength="10"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo        '<div class="form_celula_p value_last">';
                                                        echo            '<label for="inputSenhaConfirmProf" class="form_info info_p">Senha</label>';
                                                        echo            '<span class="input_container">';
                                                        echo                '<input type="password" name="inputSenhaConfirmProf" id="inputSenhaConfirmProf" class="form_value form_text value_p" placeholder="Confirme a senha" required maxlength="10"/>';
                                                        echo            '</span>';
                                                        echo        '</div>';
                                                        echo    '</fieldset>';
                                                        echo    '<div class="form_btns_container">';
                                                        echo        '<input type="reset" value="Limpar" class="form_btn btn_reset" />';
                                                        echo        '<input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroProfessor" />';
                                                        echo    '</div>';
                                                        echo '</form>';
                                                    }
                                                ?>

                                                <section class="update_cadastro update_prof cadastroProfContent" id="updateProfContainer">
                                                    <h2 class="section_header update_cad_prof_header">Atualizar Cadastro</h2>
                                                    <div class="accordion_cad_container update_prof_accordion">
                                                    </div>
                                                </section>
                                            </div>
                                            <?php
                                                echo '<div class="conteudo_tab conteudo_escola" style="display: none;">';

                                                if ($logado["perfil_id"] == 3)
                                                {
                                                    echo '<section class="update_cadastro confirm_escola cadastroEscolaContent" id="cadastroEscolaContainer">';
                                                    echo     '<h2 class="section_header confirm_cad_escola_header">Pré-cadastros</h2>';
                                                    echo     '<div class="accordion_cad_container confirm_escola_accordion"> ';
                                                    echo     '</div>';
                                                    echo '</section>';
                                                    echo '<form action="" class="form_cadastro cadastro_escola cadastroEscolaContent" id="formCadastroEscola" style="display: none;">';
                                                    echo     '<fieldset class="form_divisao">';
                                                    echo         '<legend class="form_divisao_titulo">Dados</legend>';
                                                    echo         '<div class="form_celula_g">';
                                                    echo             '<label for="inputNomeEscola" class="form_info info_g">Nome</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputNomeEscola" id="inputNomeEscola" class="form_value form_text value_g obrigatorioEscola" msgVazio="O campo nome é obrigatório" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_g">';
                                                    echo             '<label for="inputRazaoEscola" class="form_info info_g">Razão Social</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputRazaoEscola" id="inputRazaoEscola" class="form_value form_text value_g obrigatorioEscola" msgVazio="O campo razão social é obrigatório" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_m">';
                                                    echo             '<label for="inputCodigoEscola" class="form_info info_m">NSE</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputNseEscola" id="inputNseEscola" class="form_value form_text value_m"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_m value_last">';
                                                    echo             '<label for="inputCodigoEscola" class="form_info info_m">Código</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="number" name="inputCodigoEscola" id="inputCodigoEscola" class="form_value form_text value_m"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputCnpjEscola" class="form_info info_p">CNPJ</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputCnpjEscola" id="inputCnpjEscola" class="form_value form_text value_p  obrigatorioEscola"  msgVazio="O campo CNPJ é obrigatório" required maxlength="18" OnKeyPress="formatar(\'##.###.###/####-##\', this)"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputAdmEscola" class="form_info info_p">Administração</label>';
                                                    echo             '<span class="select_container">';
                                                    echo                 '<select name="inputAdmEscola" id="inputAdmEscola" class="form_value form_select value_p obrigatorioEscola"  msgVazio="O campo administração é obrigatório" required>';
                                                                        //<!-- <option value="" disabled selected>Selecione a cidade</option> -->
                                                                        
                                                                          if(count($adms)>0) {
                                                                                foreach($adms as $a) {
                                                                                  echo '<option value="'.$a->getadm_id().'">'.utf8_encode($a->getadm_administracao()).'</option>';
                                                                                }
                                                                            }
                                                                        
                                                    echo                '</select>';
                                                    echo            '</span>';
                                                    echo        '</div>';
                                                    echo        '<div class="form_celula_p value_last">';
                                                    echo            '<label for="inputTipoEscola" class="form_info info_p">Tipo de escola</label>';
                                                    echo            '<span class="select_container">';
                                                    echo                '<select name="inputTipoEscola" id="inputTipoEscola" class="form_value form_select value_p obrigatorioEscola"  msgVazio="O campo tipo da escola é obrigatório" required>';
                                                                        //<!--<option value="" disabled selected>Selecione a cidade</option>-->
                                                                         
                                                                         if(count($tiposEscola)>0) {
                                                                             foreach($tiposEscola as $t) {
                                                                                    echo '<option value="'.$t->gettps_id().'">'.$t->gettps_tipo_escola().'</option>';
                                                                             }
                                                                          }
                                                                        
                                                    echo                 '</select>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_m">';
                                                    echo             '<label for="inputRuaEscola" class="form_info info_m">Rua</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputRuaEscola" id="inputRuaEscola" class="form_value form_text value_m obrigatorioEscola" msgVazio="O campo rua é obrigatório" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_m value_last">';
                                                    echo             '<label for="inputBairroEscola" class="form_info info_m">Bairro</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputBairroEscola" id="inputBairroEscola" class="form_value form_text value_m obrigatorioEscola" msgVazio="O campo bairro é obrigatório" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputNumCasaEscola" class="form_info info_p">Número</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputNumCasaEscola" id="inputNumCasaEscola" class="form_value form_number value_p obrigatorioEscola" msgVazio="O campo número é obrigatório" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputCompCasaEscola" class="form_info info_p">Complemento</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputCompCasaEscola" id="inputCompCasaEscola" class="form_value form_number value_p" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p value_last">';
                                                    echo             '<label for="inputEstadoEscola" class="form_info info_p">Estado</label>';
                                                    echo             '<span class="select_container">';
                                                    echo                 '<select name="inputEstadoEscola" id="inputEstadoEscola" class="form_value form_select value_p obrigatorioEscola" msgVazio="O campo estado é obrigatório" required>';
                                                    echo                 '</select>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputCidadeEscola" class="form_info info_p">Cidade</label>';
                                                    echo             '<span class="select_container">';
                                                    echo                 '<select name="inputCidadeEscola" id="inputCidadeEscola" class="form_value form_select value_p obrigatorioEscola" msgVazio="O campo cidade é obrigatório" required>';
                                                    echo                 '</select>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputCepEscola" class="form_info info_p">CEP</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputCepEscola" id="inputCepEscola" class="form_value form_text value_p obrigatorioEscola" msgVazio="O campo CEP é obrigatório" required OnKeyPress="formatar(\'##.###-###\', this)"  maxlength="10"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p value_last">';
                                                    echo             '<label for="inputTelefoneEscola" class="form_info info_p">Telefone</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputTelefoneEscola" id="inputTelefoneEscola" class="form_value form_text value_p obrigatorioEscola" msgVazio="O campo telefone é obrigatório" required OnKeyPress="formatar(\'## ####-#####\', this)"  maxlength="13"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_g">';
                                                    echo             '<label for="inputEmailEscola" class="form_info info_g">E-mail</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputEmailEscola" id="inputEmailEscola" class="form_value form_text value_g obrigatorioEscola" msgVazio="O campo email é obrigatório" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_g" style="height: auto; min-height: 40px;">';
                                                    echo             '<label for="cadastroImagem" class="form_info info_p">Foto</label>';
                                                    echo             '<span class="input_container spanImagem" id="spanImagemEscola"></span>';
                                                    echo         '</div>';
                                                    echo     '</fieldset>';
                                                    echo     '<fieldset class="form_divisao">';
                                                    echo         '<legend class="form_divisao_titulo">Acesso</legend>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputUsuarioEscola" class="form_info info_p">Usuário</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="text" name="inputUsuarioEscola" id="inputUsuarioEscola" class="form_value form_text value_p obrigatorioEscola" msgVazio="O campo usuário é obrigatório" placeholder="Insira um nome de usuário" required />';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p">';
                                                    echo             '<label for="inputSenhaEscola" class="form_info info_p">Senha</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="password" name="inputSenhaEscola" id="inputSenhaEscola" class="form_value form_text value_p obrigatorioEscola" msgVazio="O campo senha é obrigatório" placeholder="Insira uma senha" required maxlength="10"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo         '<div class="form_celula_p value_last">';
                                                    echo             '<label for="inputSenhaConfirmEscola" class="form_info info_p">Senha</label>';
                                                    echo             '<span class="input_container">';
                                                    echo                 '<input type="password" name="inputSenhaConfirmEscola" id="inputSenhaConfirmEscola" class="form_value form_text value_p" placeholder="Confirme a senha" required maxlength="10"/>';
                                                    echo             '</span>';
                                                    echo         '</div>';
                                                    echo     '</fieldset>';
                                                    echo     '<div class="form_btns_container">';
                                                    echo         '<input type="reset" value="Limpar" class="form_btn btn_reset" />';
                                                    echo         '<input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroEscola" />';
                                                    echo     '</div>';
                                                    echo '</form>';
                                                }
                                                echo     '<section class="update_cadastro update_escola cadastroEscolaContent" id="updateEscolaContainer">';
                                                echo         '<h2 class="section_header update_cad_escola_header">Atualizar Cadastro</h2>';
                                                echo         '<div class="accordion_cad_container update_escola_accordion"> ';
                                                echo         '</div>';
                                                echo     '</section>';
                                                echo '</div>';
                                            ?>
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
			$templateGeral->mensagemRetorno('mensagens','Cadastrado efetuado com sucesso!','sucesso');
		?>
	</div>
		<div id="mensagemErroCadastro" style="display:none" class='modalMensagem'>
		<?php
			$templateGeral->mensagemRetorno('mensagens','Erro ao cadastrar!','erro');
		?>
	</div>
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
