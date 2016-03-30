<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();
$path = $_SESSION['PATH_SYS'];

include_once ($path['controller'].'EscolaController.php');

/**
 * Description of Template
 *
 * @author MuranoDesign
 */

class TemplateGaleria{

    public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}

	public function geraFormulario()
	{
		$escolaController = new EscolaController();
		$escolas = $escolaController->selectAll();
		$logado = unserialize($_SESSION['USR']);
		if ($logado['perfil_id'] == 3){
			echo 	'<form id="form_arquivo_galeria" action="ajax/GaleriaAjax.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<input type="hidden" name="acao" value="uploadGaleria"/>
							<legend>Inserir novo arquivo na Galeria</legend>
							<div class="formfield">
								<label for="">Categoria</label>
								<span>
									<div id="categoriaPost">
									</div>
								</span>
							</div>
							<div class="formfield">
								<label for="titulo_arquivo">Título</label>
								<span>
									<input type="text" name="titulo_arquivo" id="titulo_arquivo" placeholder="Digite o título de arquivo" />
								</span>
							</div>
							<div class="formfield">
								<label for="descricao_arquivo">Descrição</label>
								<span>
									<textarea name="descricao_arquivo" id="descricao_arquivo" placeholder="Digite a descrição do arquivo"></textarea>
								</span>
							</div>
							<div class="formfield">
								<label for="">Tipo de arquivo</label>
								<span>
									<div id="tipoDeAruivo">
										<input type="radio" name="tipo_arquivo" value="0" id="tipo_arquivo_link"/>
										<label for="tipo_arquivo_link">Link</label>
										<input type="radio" name="tipo_arquivo" value="1" id="tipo_arquivo_arquivo"/>
										<label for="tipo_arquivo_arquivo">Arquivo</label>
										
									</div>
								</span>
							</div>
							<div class="formfield">
								<label for="">Arquivo</label>
								<span>
									<span>
										<input type="file" name="file_arquivo" id="file_arquivo">
									</span>
									<div>
										<label class="file" for="file_arquivo">
											<input type="button" data-for="file_arquivo" value="Selecionar arquivo" />
											<span data-for="file_arquivo">Selecione um arquivo</span>
										</label>
									</div>
								</span>
							</div>
							<div class="formfield">
								<label for="link_arquivo">Link</label>
								<span>
									<input type="text" name="link_arquivo" id="link_arquivo" placeholder="Cole aqui o link para o arquivo" />
								</span>
							</div>
						</fieldset>
						<fieldset>
							<div class="formbtns">
								<input type="button" id="btn_cancelar" value="Cancelar"/>
								<input type="reset" value="Limpar"/>
								<input type="button" id="btn_enviar" class="btn_primary" value="Enviar"/>
							</div>
						</fieldset>
					</form>';
		}
		else
		{
			echo 	'<form id="sugestaoGaleria"">
						<fieldset>
							<legend>Sugerir arquivo para a Galeria</legend>
							<div class="formfield">
								<label for="link_arquivo">Link</label>
								<span>
									<input type="text" name="titulo_arquivo" id="link_arquivo" placeholder="Insira o link do arquivo">
								</span>
							</div>
							<div class="formfield">
								<label for="descricao_arquivo">Descrição</label>
								<span>
									<textarea name="descricao_arquivo" id="descricao_arquivo" placeholder="Digite a descrição do arquivo"></textarea>
								</span>
							</div>
						</fieldset>
						<fieldset>
							<div class="formbtns">
								<input type="button" id="btn_cancelar" value="Cancelar"/>
								<input type="reset" value="Limpar"/>
								<input type="button" id="btn_enviar_sugestao" class="btn_primary" value="Enviar"/>
							</div>
						</fieldset>
					</form>';
		}
	}

	public function botaoUpload()
	{
		$logado = unserialize($_SESSION['USR']);
		if ($logado['perfil'] == 'NEC')
		{
			echo '<div id="box_carregar">
					<div id="carregarContainer">
						<div id="botaoCarregar" class="botaoCarregar"></div>
					</div>
				</div>';
		}

		else
		{
			echo '<div id="box_carregar">
					<div id="carregarContainer">
						<div id="botaoCarregar" class="botaoSugestao"></div>
					</div>
				</div>';
		}
	}

	public function modalConfirmacaoUpload()
	{
		if (isset($_SESSION['cadastro']) && $_SESSION['cadastro'] == 'ok')
       	    echo 	'<script>
       					$(document).ready(function () {
       						$("#tipoMensagem").removeClass();
    						$("#tipoMensagem").addClass("sucesso");
    						$("#modalTexto").html("Arquivo adicionado com sucesso!");
    						showModal();
       					});
       				</script>';
       	$_SESSION['cadastro'] = '';
	}
	
}
?>
