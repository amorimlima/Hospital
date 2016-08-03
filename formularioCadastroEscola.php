<!--
*
* Formulário de cadastro de Escolas
*
-->

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
        <div class="form_celula_m">
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
        <div class="form_celula_p">
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
                                                                <div class="form_celula_p value_last">
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
        <div class="form_celula_g" style="height: auto">
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
                    <p class="regra_char_mai text-danger">Número</p>
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