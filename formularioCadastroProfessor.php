<!--
*
* Formulário de cadastro de Professores
*
-->
 

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
                    <!-- <option value='3'>Unidade Escolar</option> -->
                </select>
            </span>
        </div>
        <div class="form_celula_p">
            <label for="inputNascimentoProf" class="form_info info_p">Nascimento<span class="asterisco">*</span></label>
            <span class="input_container">
                <input type="text" name="inputNascimentoProf" id="inputNascimentoProf" class="form_value form_text value_p formProf obrigatorioProf" required msgVazio="O campo nascimento é obrigatório"  OnKeyPress="formatar('##/##/####', this)"  maxlength="10"/>
            </span>
        </div>
        <div class="form_celula_p">
            <label for="inputRgProf" class="form_info info_p">RG<span class="asterisco">*</span></label>
            <span class="input_container">
                <input type="text" name="inputRgProf" id="inputRgProf" class="form_value form_text value_p formProf obrigatorioProf" required OnKeyPress="formatar('##.###.###', this)" maxlength="10" msgVazio="O campo RG é obrigatório"/>
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
                <input type="text" name="inputCompCasaProf" id="inputCompCasaProf" class="form_value form_number value_p formProf"/>
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
        <div class="form_celula_g" style="height: auto">
            <label for="cadastroImagem" class="form_info info_p">Foto</label>
            <span class="input_container spanImagem" id="spanImagemProfessor"></span>
        </div>
    </fieldset>
    <fieldset class="form_divisao" id="divisao_grupo">
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
        <div class="form_celula_p" style="display: none">
            <label for="inputSenhaAtualProf" class="form_info info_p">Senha Atual</label>
            <span class="input_container">
                <input type="password" name="inputSenhaAtualProf" id="inputSenhaAtualProf" class="form_value form_text value_p  formProf" placeholder="Insira a senha atual"/>
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
                    <p class="regra_char_mai text-danger">Número</p>
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

        <input type="button" value="Voltar" class="form_btn btn_reset" id="voltarProf" />
        <input type="reset" value="Limpar" class="form_btn btn_reset" id="resetarProf"/>
        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroProf" />
    </div>
</form>