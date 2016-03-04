<?php
require_once '_loadPaths.inc.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/modulos/formulario.css" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" /><!-- -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo-container">
                        <img src="img/logo/logo_lg.png">
                    </div>
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-4">
                    <div class="login-panel-container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form center-block">
                                    <div class="form-group">
                                        <label for"usuario">USUÁRIO</label>
                                        <input type="text" class="form-control input-lg form-actions" name="usuario" id="usuario" value="hcbAluno">
                                    </div>
                                    <div class="form-group">
                                        <label for"usuario">SENHA</label>
                                        <input type="password" class="form-control input-lg form-actions" name="senha" id="senha" value="123">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-lg" id="btLogar">Entrar</button>
                                    </div>
                                </form>
                                <div class="link">
                                    <a href="#">Esqueceu a senha?</a>
                                </div>
                            </div>
                        </div>

                        <div class="link">
                            <p>Gostou do projeto e deseja fazer parte? <br /><a class="link_pre_cadastro" id="link_pre_cadastro" href="#">Solicite o cadastro da sua escola!</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pratinha"></div>
                </div>
                <div class="col-md-2">&nbsp;</div>
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
	                                        <input id="nome_escola" name="esc_escola" type="text" placeholder="Digite o nome de sua escola" />
	                                    </span>
	                                </div>
	                                <div class="formfield">
	                                    <label for="razao_social">Razão social</label>
	                                    <span>
	                                        <input id="razao_social" name="esc_razao_social" type="text" placeholder="Digite a razão social de sua escola" />
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="cnpj">CNPJ</label>
	                                    <span>
	                                        <input class="cnpj" id="cnpj" name="esc_cnpj" type="text" placeholder="00.000.000/0000-00"/>
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
	                                            <option value="1" selected>Municipal</option>
	                                            <option value="2">Estadual</option>
	                                            <option value="3">Federal</option>
	                                        </select>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="cep">CEP</label>
	                                    <span>
	                                        <input class="cep" id="cep" name="end_cep" type="text" placeholder="00000-000"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-g">
	                                    <label for="logradouro">Logradouro</label>
	                                    <span>
	                                        <input id="logradouro" name="end_logradouro" type="text"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="numero">Número</label>
	                                    <span>
	                                        <input id="numero" name="end_numero" type="number" min="1" />
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
	                                        <input id="bairro" name="end_bairro" type="text"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-m">
	                                    <label for="estado">Estado</label>
	                                    <span>
	                                        <select id="estado" name="end_uf">
	                                            <option value="0" selected disabled hidden>Selecione um estado</option>
	                                            <option value="1">Estado 1</option>
	                                        </select>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-m">
	                                    <label for="cidade">Cidade</label>
	                                    <span>
	                                        <select id="cidade" name="end_cidade">
	                                            <option value="0" selected disabled hidden>Selecine uma cidade</option>
	                                            <option value="1">Cidade 1</option>
	                                        </select>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-g">
	                                    <label for="email">E-Mail</label>
	                                    <span>
	                                        <input id="email" name="end_email" type="text" placeholder="exemplo@escola.br"/>
	                                    </span>
	                                </div>
	                                <div class="formfield formfield-s">
	                                    <label for="tel_comercial">Tel. Comercial</label>
	                                    <span>
	                                        <input class="tel" id="tel_comercial" name="end_telefone_comercial" type="text" placeholder="(DDD) 0000-0000" />
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
	                                    <button id="cancel_pre_cadastro">Cancelar</button>
	                                    <input type="reset" value="Limpar"/>
	                                    <button id="enviar_pre_cadastro" class="btn_primary" data-form="formulario_pre_cadastro">Enviar</button>
	                                </div>
	                            </fieldset>
	                        </form>
                            </div>
                    </div>
                </div>
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