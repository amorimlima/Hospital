<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();
$path = $_SESSION['PATH_SYS'];

include_once ($path['controller'].'EscolaController.php');
include_once ($path['controller'].'GaleriaController.php');

include_once($path['funcao'].'DatasFuncao.php');
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
		if (isset($_SESSION['cadastro']))
		{
			if ($_SESSION['cadastro'] == 'ok')
       	    	echo 	'<script>
       						$(document).ready(function () {
       							$("#tipoMensagem").removeClass();
    							$("#tipoMensagem").addClass("sucesso");
    							$("#modalTexto").html("Arquivo adicionado com sucesso!");
    							showModal();
       						});
       					</script>';
       		else if ($_SESSION['cadastro'] == 'excedeu')
       			echo 	'<script>
       						$(document).ready(function () {
       							$("#tipoMensagem").removeClass();
    							$("#tipoMensagem").addClass("erro");
    							$("#modalTexto").html("O arquivo deve ter menos de 30Mb!");
    							showModal();
       						});
       					</script>';
		}
			
       	$_SESSION['cadastro'] = '';
	}

	public function listaGaleria()
	{
		$galeriaController = new GaleriaController();
		$galeria = $galeriaController->selectMaisRecentes();
	
		foreach ($galeria as $key => $value) {
			echo '<div class="gal_caixa">
			    	<div class="gal_dados">
						<a onclick="contagemVisualizacoes('.$value->getGlr_idgaleria().')" target="_blank" class="linkGaleria" href=\"'.$value->getGlr_arquivo().'">
							<div class="gal_'.$value->getGlr_categoria()->getCtg_classe().'_icon"></div>
						</a>
			        <div class="gal_categoria">'.utf8_encode($value->getGlr_categoria()->getCtg_categoria()).'</div>
			    </div>
			    <div class="gal_caixa_texto">
			        <a onclick="contagemVisualizacoes('.$value->getGlr_idgaleria().')" target="_blank" class="linkGaleria" id="gal_'.$value->getGlr_idgaleria().'" href="'.$value->getGlr_arquivo().'">
			        	<div class="gal_caixa_texto_titulo">'.utf8_encode($value->getGlr_nome()).'</div>
			        </a>
			        <div class="gal_caixa_texto_sub">dataPostagem</div>
			        <div class="gal_caixa_texto_corpo">'.utf8_encode($value->getGlr_descricao()).'</div>
			    </div>
			</div>';

		}	
	}	

	public function listaMaisVistosGaleria()
	{
		$galeriaController = new GaleriaController();
		$galeria = $galeriaController->selectMaisVistos();
		$dataFuncao = new DatasFuncao();
	
		foreach ($galeria as $key => $value) {
			echo    '<div class="row">
		                <div class="mv_caixa">
			                <div class="mv_caixa_icon">
			                	<div class="mv_'.$value->getGlr_categoria()->getCtg_classe().'">
				                	<a onclick="contagemVisualizacoes('.$value->getGlr_idgaleria().')" target="_blank" class="linkGaleria" id="gal_'.$value->getGlr_idgaleria().'" href="'.$value->getGlr_arquivo().'">
				                		<div class="icon_'.$value->getGlr_categoria()->getCtg_classe().'"></div>
				                	</a>
				                	<div class="icon_texto">'.utf8_encode($value->getGlr_categoria()->getCtg_categoria()).'</div>
				                </div>
			                </div>
			                <div class="txt_mv_caixa">
			                	<a onclick="contagemVisualizacoes('.$value->getGlr_idgaleria().')" target="_blank" class="linkGaleria" id="gal_'.$value->getGlr_idgaleria().'" href="'.$value->getGlr_arquivo().'">
			                		<p class="txt_mv_caixa_titulo">'.utf8_encode($value->getGlr_nome()).'</p>
			                	</a>
			               		<p class="txt_mv_caixa_sub">'.utf8_encode($value->getGlr_descricao()).'</p>
			                	<p class="txt_mv_caixa_data">'.$dataFuncao->dataBR($value->getGlr_data()).'</p>
			                </div>
			                <div class="clear"></div>
		                </div>
		            </div>';

		}	
	}
}
?>
