<?php
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'AdministracaoController.php');
include_once($path['template'].'Template.php');

$templateGeral = new Template();
$AdmController = new AdministracaoController();


$adms = $AdmController->selectAll();
//echo "<pre>";
//print_r($adms);
//echo "</pre>";
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/modulos/formulario.css" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo-container">
                        <img src="img/logo/logo_lg.png">
                    </div>
                </div>
            </div>
            <div id="Conteudo_Area" style="<?=(isset($_GET['recSenha']) == 'alt@' || $_GET['newPass'])?'display:none':'display:block'?>">
	            <div class="row" id="login">
	                <div class="col-md-8">
	                	<div id="Conteudo_Area_box_left">
							<img id="abertura" src="img/abertura_Ca.png">
						</div>
	                </div>
	                <div class="col-md-4">
	                	<div id="Conteudo_Area_box_right">
		                    <div class="login-panel-container">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <form class="form center-block">
		                                    <div class="form-group">
		                                        <label for"usuario">USUÁRIO</label>
		                                        <input type="text" class="form-control input-lg form-actions" name="usuario" id="usuario" value="">
		                                    </div>
		                                    <div class="form-group">
		                                        <label for"usuario">SENHA</label>
		                                        <input type="password" class="form-control input-lg form-actions" name="senha" id="senha" value="">
		                                    </div>
		                                    <div class="form-group">
		                                        <button class="btn btn-primary btn-lg" id="btLogar">Entrar</button>
		                                    </div>
		                                </form>
		                                <div class="link">
		                                    <a href="index.php?recSenha=alt@">Esqueceu a senha?</a>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="link">
		                            <p>Gostou do projeto e deseja fazer parte? <br /><a class="link_pre_cadastro" id="link_pre_cadastro" href="#">Solicite o cadastro da sua escola!</a></p>
		                        </div>
		                    </div>
		                </div>
	                </div><!-- 
	                <div class="col-md-4">
	                    <div class="pratinha"></div>
	                </div> -->
	                <div class="col-md-2">&nbsp;</div>
	            </div>	            
            </div>            
            <div id="form_recuperar_senha" class="row" style="<?=isset($_GET['recSenha']) == 'alt@'?'display:block':'display:none'?>" >
            	<div class="formulario_panel" style="margin-bottom: 220px;">
            		<form action="" id="formulario_recuperar_senha">
            			<fieldset>
            				<legend>Recuperar senha</legend>
            				<div class="formfield">
            					<label for="campo_email">E-mail</label>
            					<span>
            						<input type="text" id="campo_email" name="usr_email" placeholder="Digite seu email">
            					</span>
            				</div>
            			</fieldset>
            			<fieldset>
            				<div class="formbtns">
	                            <input type="button" id="cancel_recuperar_senha" onclick="recuperarSenha()" value="Cancelar" />
                                <input type="button" id="enviar_recuperar_senha" onclick="esqueceuSenha()" class="btn_primary" data-form="formulario_recuperar_senha" value="Enviar" />
	                        </div>
            			</fieldset>
            		</form>
            	</div>
            </div>
            <div id="form_recuperar_senha" class="row" style="<?=isset($_GET['newPass']) ?'display:block':'display:none'?>">
            	<div class="formulario_panel">
            		<form action="" id="formulario_recuperar_senha">
            			<fieldset>
            				<legend>Redefinir senha</legend>
            				<div class="formfield">
            					<label for="campo_email">Nova Senha</label>
            					<span>
            						<input type="password" id="usr_new" name="usr_new" placeholder="Digite uma nova senha">
            					</span>
            				</div>
            				<div class="formfield">
            					<label for="campo_email">Confirmar Senha</label>
            					<span>
            						<input type="password" id="usr_conf" name="usr_conf" placeholder="Confirme sua senha">
            						<input type="hidden" id="emailRec" name="email" value="<?=base64_decode($_GET['newPass'])?>">
            					</span>
            				</div>
            			</fieldset>
            			<fieldset>
            				<div class="formbtns">            					
                                <input type="button" id="enviar_recuperar_senha" onclick="alterarSenha()" class="btn_primary" data-form="formulario_recuperar_senha" value="Enviar" />
	                        </div>
            			</fieldset>
            		</form>
            	</div>
            </div>
            <div class="row" id="form_pre_cadastro"  style="display: none;">
                <div id="Conteudo_Area">
                    <div class="formulario_panel">
                        <div id="form_barra" class="form_barra">
	                        <form action="" id="formulario_pre_cadastro">
	                            <fieldset>
	                                <legend>Registro de interesse de escola</legend>
	                                <div class="formfield">
	                                    <label for="nome_escola">Nome da escola</label>
	                                    <span>
	                                        <input id="nome_escola" name="esc_escola" type="text" placeholder="Digite o nome de sua escola" class="obrigatorio" msgVazio="O campo nome é obrigatório"/>
	                                    </span>
	                                </div>
	                                <div class="formfield">
	                                    <label for="razao_social">Razão social</label>
	                                    <span>
	                                        <input id="razao_social" name="esc_razao_social" type="text" placeholder="Digite a razão social de sua escola" class="obrigatorio" msgVazio="O razão social nome é obrigatório"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="cnpj">CNPJ</label>
	                                    <span>
	                                        <input class="cnpj obrigatorio" id="cnpj" name="esc_cnpj" type="text" placeholder="00.000.000/0000-00" msgVazio="O campo CNPJ é obrigatório">
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="">Tipo</label>
	                                    <span>
	                                        <div>
	                                            <input type="radio" name="esc_tipo_escola" checked value="1" id="escola_publica">
	                                            <label for="escola_publica">Pública</label>
	                                            <input type="radio" name="esc_tipo_escola" value="2" id="escola_particular">
	                                            <label for="escola_particular">Privada</label>
	                                        </div>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="administracao">Administração</label>
	                                    <span>
	                                        <select id="administracao" name="esc_administracao">
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
	                                <div class="formfield formfield-s">
	                                    <label for="cep">CEP</label>
	                                    <span>
	                                        <input class="cep obrigatorio" id="cep" name="end_cep" type="text" placeholder="00000-000" msgVazio="O campo CEP é obrigatório" />
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-g">
	                                    <label for="logradouro">Logradouro</label>
	                                    <span>
	                                        <input id="logradouro" name="end_logradouro" type="text" class="obrigatorio" msgVazio="O campo logradouro é obrigatório"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="numero">Número</label>
	                                    <span>
	                                        <input id="numero" name="end_numero" type="text" min="1" class="obrigatorio" msgVazio="O campo número é obrigatório"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="complemento">Complemento</label>
	                                    <span>
	                                        <input id="complemento" name="end_complemento" type="text"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="bairro">Bairro</label>
	                                    <span>
	                                        <input id="bairro" name="end_bairro" type="text" class="obrigatorio" msgVazio="O campo bairro é obrigatório"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-m">
	                                    <label for="estado">Estado</label>
	                                    <span>
	                                        <select id="estado" name="end_uf" class="obrigatorio" msgVazio="O campo estado é obrigatório">
	                                            
	                                        </select>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-m">
	                                    <label for="cidade">Cidade</label>
	                                    <span>
	                                        <select id="cidade" name="end_cidade" class="obrigatorio">
	                                            <option value="0" selected disabled hidden>Selecione um estado</option>
	                                        </select>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="login_escola">Login</label>
	                                    <span>
	                                        <input id="login_escola" name="login_escola" type="text" placeholder="Nome do Usuário" />
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="email">E-Mail</label>
	                                    <span>
	                                        <input id="email" name="end_email" type="text" placeholder="exemplo@escola.br" class="obrigatorio" msgVazio="O campo email é obrigatório"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="tel_comercial">Tel. Comercial</label>
	                                    <span>
	                                        <input class="tel obrigatorio" id="tel_comercial" name="end_telefone_comercial" type="text" placeholder="(DDD) 0000-0000" msgVazio="O campo telefone é obrigatório"/>
	                                    </span>
	                                </div>
	                            </fieldset>
	                            <fieldset>
	                                <div class="formfield">
	                                    <label for="nome_diretor">Diretor</label>
	                                    <span>
	                                        <input id="nome_diretor" name="dir_diretor" type="text" placeholder="Digite o nome do diretor de sua escola" />
	                                    </span>
	                                </div>
	                                <div class="formfield">
	                                    <label for="email_diretor">E-Mail</label>
	                                    <span>
	                                        <input id="email_diretor" name="dir_email" type="text" placeholder="diretor@escola.br" />
	                                    </span>
	                                </div>
	                            </fieldset>
	                            <fieldset>
	                                <div class="formfield">
	                                    <label for="nome_coordenador">Coordenador</label>
	                                    <span>
	                                        <input id="nome_coordenador" name="dir_diretor" type="text" placeholder="Digite o nome do coordenador do projeto em sua escola" />
	                                    </span>
	                                </div>
	                                <div class="formfield">
	                                    <label for="email_coordenador">E-Mail</label>
	                                    <span>
	                                        <input id="email_coordenador" name="dir_email" type="text" placeholder="coordenador@escola.br" />
	                                    </span>
	                                </div>
	                            </fieldset>
	                            <fieldset>
	                                <div class="formbtns">
	                                    <input type="button" id="cancel_pre_cadastro" value="Cancelar" />
	                                    <input type="reset" value="Limpar"/>
                                            <input type="button" id="enviar_pre_cadastro" class="btn_primary" data-form="formulario_pre_cadastro" value="Enviar" />
	                                </div>
	                            </fieldset>
	                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
		        <div class="row" id="rodape"></div>
		        <div id="margin"></div>
		    </footer>
        </div>        
        <div id="mensagemCampoVazio" class='modalMensagem' style="display:none">
			<?php
				$templateGeral->mensagemRetorno('mensagens','<span id="textoMensagemVazio"></span>','erro');
			?>
		</div>
		<div id="mensagemSucessoCadastro" style="display:none" class='modalMensagem'>
			<?php
				$templateGeral->mensagemRetorno('mensagens','Solicitação de cadastrado feita com sucesso!','sucesso');
			?>
		</div>

		<div id="mensagemErroCampoNull" class='modalMensagem' style="display:none">
			<?php
				$templateGeral->mensagemRetorno('mensagens','Os campos senha e confirma senha são obrigatórios!','erro');
			?>
		</div>
		<div id="mensagemErroCamposDiferentes" class='modalMensagem' style="display:none">
			<?php
				$templateGeral->mensagemRetorno('mensagens','As senhas digitadas não correspondem!','erro');
			?>
		</div>
		<div id="mensagemEmailVerifique" class='modalMensagem' style="display:none">
			<?php
				$templateGeral->mensagemRetorno('mensagens','Este email não existe em nossa base de dados!','erro');
			?>
		</div>
		<div id="mensagemSucessoAlterou" class='modalMensagem' style="display:none">
			<?php
				$templateGeral->mensagemRetorno('mensagens','Senha redefinida com sucesso!','sucesso');
			?>
		</div>
		<div id="mensagemSucessoVerifique" class='modalMensagem' style="display:none">
			<?php
				$templateGeral->mensagemRetorno('mensagens','Cheque o email fornecido no cadastro para alterar a sua senha. Caso nenhuma mensagem da plataforma tenha chegado, verifique sua caixa de spam e lixeira.','alerta');
			?>
		</div>
		<div id="mensagemLoginInvalido" class="modalMensagem" style="display:none">
			<?php
				$templateGeral->mensagemRetorno("mensagens","Login e/ou senha inválido(s).", "erro");
			?>
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
    <script src="js/EstadoCidade.js"></script>
	<script src="js/funcoes.js"></script>
</html>