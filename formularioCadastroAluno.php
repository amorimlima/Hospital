<!--
*
* Formulário de cadastro de alunos
*
-->

<form action="" class="form_cadastro cadastro_aluno cadastroAlunoContent" id="formCadastroAluno" style="display: none;">
    <fieldset class="form_divisao" id="dados_escolares">
        <legend class="form_divisao_titulo">Dados Escolares</legend>
        <div class="form_celula_m">
            <input type="hidden" id="selectEscolaAluno"/>
            <label for="selectProfessorAluno" class="form_info info_m">Professor<span class="asterisco">*</span></label>
            <span class="select_container">
                <select name="selectProfessorAluno" id="selectProfessorAluno" class="form_value form_select value_m formAluno obrigatorioAluno" msgVazio="O campo professor é obrigatório" required>
                    <!--  ATENÇÂO - Se mudar o texto desse option precisa mudar em mais dois lugares no arquivo cadastro.js. -->
                    <option value="" disabled selected>Selecione primeiro a escola e a série</option>
                </select>
            </span>
        </div>
        <div class="form_celula_m value_last">
            <label for="selectSerieAluno" class="form_info info_p">Série<span class="asterisco">*</span></label>
            <span class="select_container">
                <select name="selectSerieAluno" id="selectSerieAluno" class="form_value form_select value_m formAluno obrigatorioAluno" msgVazio="O campo série é obrigatório" required onChange="listaProfessores('')">
                    <option value="" disabled selected>Selecione a série</option>
                    <?= $serieHtml; ?>
                </select>
            </span>
        </div>
        <div class="form_celula_p">
            <label for="selectPeriodoAluno" class="form_info info_p">Ano Letivo<span class="asterisco">*</span></label>
            <span class="select_container">
                <select name="selectAnoAluno" id="selectAnoAluno" class="form_value form_select value_p" required>
                    <?php
                    if (count($anos) > 0) {
                        foreach ($anos as $a) {
                            $selected = '';
                            $classe = '';
                            if (date('Y') == $a->getAno_ano()) {
                                $classe = 'class="anoAtual"';
                                //$selected = 'selected';
                            }
                            echo '<option ' . $selected . ' ' . $classe . ' value="' . utf8_encode($a->getAno_id()) . '">' . utf8_encode($a->getAno_ano()) . '</option>';
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
            <label for="inputRgAluno" class="form_info info_p">RG</label>
            <span class="input_container">
                <input type="text" name="inputRgAluno" id="inputRgAluno" class="form_value form_text value_p formAluno" OnKeyPress="formatar('##.###.###', this)" maxlength="10"/>
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
            <label for="inputEmailAluno" class="form_info info_p">E-mail</label>
            <span class="input_container">
                <input type="text" name="inputEmailAluno" id="inputEmailAluno" class="form_value form_text value_p formAluno" required />
            </span>
        </div>
        <div class="form_celula_g" style="height: auto">
            <label for="cadastroImagem" class="form_info info_p">Foto</label>

            <span class="input_container spanImagem" id="spanImagemAluno">

                <div id="cadastroImagemUpload">
                    <div id="cadastroImagem" class="divImagem"></div>
                    <div id="car"></div>
                    <div id="imgUp" style="position:relative"><img src="" width="150" height="150"/></div>
                    <input name="imagem" type="hidden" id="imagem" value=""></td>
                </div>
            </span>
        </div>
    </fieldset>
    <fieldset class="form_divisao">
        <legend class="form_divisao_titulo">Acesso</legend>
        <div class="form_celula_p">
            <label for="inputUsuarioAluno" class="form_info info_p">Usuário<span class="asterisco">*</span></label>
            <span class="input_container">
                <input type="text" name="inputUsuarioAluno" id="inputUsuarioAluno" class="form_value form_text value_p formAluno obrigatorioAluno" msgVazio="O campo usuário é obrigatório" placeholder="Insira um usuário de usuário" required maxlength="10"/>
            </span>
        </div>
        <div class="form_celula_p" style="display: none">
            <label for="inputSenhaAtual" class="form_info info_p">Senha Atual</label>
            <span class="input_container">
                <input type="password" name="inputSenhaAtual" id="inputSenhaAtual" class="form_value form_text value_p formAluno" placeholder="Insira a senha atual" maxlength="10"/>
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
                    <p class="regra_char_mai text-danger">Número</p>
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
        <input type="button" value="Voltar" class="form_btn btn_reset" id="voltarAluno" /> 
        <input type="button" value="Limpar" onclick="limparCadastro('formAluno')" class="form_btn btn_reset" id="resetarAluno" />
        <input type="submit" value="Enviar" class="form_btn btn_submit" id="cadastroAluno" />
    </div>
</form>