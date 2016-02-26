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
    <title> ## Template para formulários ## </title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/box-modal.css">
    <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
   	<link rel="stylesheet" href="css/modulos/formulario.css">
   	<style>
   		.container_conteudo_geral {
   			height: 100%;
   			background-color: #fff;
   		}
   	</style>
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
                        <div class="container_conteudo_geral">
                        <form action="">
                        	<fieldset>
                        	<legend>Título para o fieldset</legend>
                        		<div class="formfield">
                        			<label for="">Exemplo de label/etiqueta com muito texto</label>
                        			<span>
                        				<input type="text"/>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-g">
                        			<label for="">Label</label>
                        			<span>
                        				<select>
                        					<option value="">Combobox</option>
                        				</select>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-s">
                        			<label for="">Label</label>
                        			<span>
                        				<select>
                        					<option value="">Combobox</option>
                        				</select>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-m">
                        			<label for="">Label</label>
                        			<span>
                        				<input type="text"/>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-m">
                        			<label for="">Label</label>
                        			<span>
                        				<select>
                        					<option value="">Combobox</option>
                        				</select>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-s">
                        			<label for="">Radios</label>
                        			<span>
                        				<div>
                        					<input type="radio" name="radio" checked id="Radio1">
                        					<label for="Radio1">Radio1</label>
                        					<input type="radio" name="radio" id="Radio2">
                        					<label for="Radio2">Radio2</label>
                        				</div>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-s">
                        			<label for="">Checkboxes</label>
                        			<span>
                        				<div>
                        					<input type="checkbox" checked id="Checkbox1">
                        					<label for="Checkbox1">Checkbox1</label>
                        					<input type="checkbox" id="Checkbox2">
                        					<label for="Checkbox2">Checkbox2</label>
                        				</div>
                        			</span>
                        		</div>
                        		<div class="formfield formfield-s">
                        			<label for="">Campo pequeno e label grande</label>
                        			<span>
                        				<input type="text" placeholder="Nada bom..." />
                        			</span>
                        		</div>
                        		<div class="formfield">
                        			<label for="">Mensagem</label>
                        			<span>
                        				<textarea placeholder="Campo para textos longos"></textarea>
                        			</span>
                        		</div>
                                <div class="formfield formfield-g formfield-only">
                                    <label for="">Campo sozinho</label>
                                    <span>
                                        <input type="text" placeholder="Largura menor que 100%" />
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
                        	</fieldset>
                        	<fieldset>
                        		<div class="formbtns">
                        			<input type="reset" value="Limpar"/>
                        			<input type="submit" value="Enviar"/>
                        		</div>
                        	</fieldset>
                        </form>

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
    <script src="js/relatorios.js"></script>
</body>
</html>
