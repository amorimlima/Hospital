<?php
if (!isset($_SESSION['PATH_SYS'])) {
    require_once '_loadPaths.inc.php';
}
$path = $_SESSION['PATH_SYS'];
include_once($path['template'] . 'Template.php');
include_once($path['template'] . 'TemplateMensagens.php');
include_once($path['template'] . 'TemplateRelatorio.php');
include_once($path['controller'] . 'EscolaController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['controller'] . 'SerieController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path["controller"] . "LiberarCapituloController.php");
include_once($path["controller"] . "AvaliacaoController.php");

$templateGeral = new Template();
$templateMensagens = new TemplateMensagens();
$templateRelatorio = new TemplateRelatorio();
$usuarioController = new UsuarioController();
$escolaController = new EscolaController();
$serieController = new SerieController();
$liberarCapituloController = new LiberarCapituloController();
$avaliacaoController = new AvaliacaoController();

$professor = $usuarioController->selectByPerfilUsuario(2);
$serie = $serieController->selectAll();
$escolas = $escolaController->selectAll();

$logado = unserialize($_SESSION['USR']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Relatórios</title>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/modulos/formulario.css">
        <link rel="stylesheet" type="text/css" href="css/box-modal.css">
        <link rel="stylesheet" type="text/css" href="css/relatorios.css">
        <link rel="stylesheet" type="text/css" href="css/documento.css">
        <link href='http://fonts.googleapis.com/css?family=Overlock:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="js/malihu.3.0.3/mCustomScrollbar.css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <input type="hidden" value="<?php echo $logado['id']; ?>" name="idUsuario" id="idUsuario">
        <div id="container">
            <div class="row">
                <?php
                $templateGeral->topoSite();
                ?>
            </div>
            <!-- Comentário -->
            <div id="Conteudo_Area">
                <div class="col-xs-12 col-md-12 col-lg-12"  id="area_geral">
                    <div id="Conteudo_Area_box_Grande">
                        <div class="container_conteudo_geral">
                            <div class="row">
                                <div class="col-sm-12 col-md-9">
                                    <span class="header"></span>
                                    <div id="conteudoPrincipal" class="conteudo_principal" style="display: none">
                                        <div id="tipo_grafico_picker" class="tipo_grafico_picker">Acessos e Downloads na Galeria (em %)</div>
                                        <div class="tipo_grafico_picker_opcoes">
                                            <div id="graficoGaleria" class="option_selected opcoes_graficos" data-grafico="1">Acessos e Downloads na Galeria (em %)</div>
                                            <div id="graficoExercicios" class="opcoes_graficos" data-grafico="2">Exercícios (em %)</div>
                                            <div id="graficoPrePos" class="opcoes_graficos" data-grafico="3">Pré e Pós Avaliação (em %)</div>
                                        </div>
                                        <div id="listagemRelatorio" class="listagem_perfis_graficos">
                                            <div id="grafico1" class="grafico">
                                                <div class="lista_itens_grafico">
                                                    <?php //$templateRelatorio->graficoEscolas();  ?>
                                                </div>
                                            </div>
                                            <div id="grafico2" class="grafico" style="display: none;">
                                                <div class="lista_itens_grafico">
                                                    Carregando...
                                                </div>
                                            </div>
                                        </div>
                                        <div id="infosGraficos" class="infos_grafico">
                                            <img src="img/ic_voltar_g.png" id="btn_voltar" class="btn_voltar">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="graf_info itens_info">
                                                        <span id="grafInfoPerfisListados">Escolas</span>
                                                        <span id="grafInfoCountPerfisListados">(Carregando...)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="graf_info charts_info">
                                                        <span style="left: 0%">0%</span>
                                                        <span style="left: 10%">10%</span>
                                                        <span style="left: 20%">20%</span>
                                                        <span style="left: 30%">30%</span>
                                                        <span style="left: 40%">40%</span>
                                                        <span style="left: 50%">50%</span>
                                                        <span style="left: 60%">60%</span>
                                                        <span style="left: 70%">70%</span>
                                                        <span style="left: 80%">80%</span>
                                                        <span style="left: 90%">90%</span>
                                                        <span style="left: 100%">100%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="liberarCapituloContainer" class="liberar_capitulo_container" style="display:none">
                                    </div>
                                    <?php if($logado["perfil_id"] == 3 || $logado["perfil_id"] == 4) { ?>
                                    <div id="envioDocumentosContainer" class="envio_documentos_container" style="display:block">
                                      <?php include_once("envioDocumentsTemp.php"); ?>
                                    </div>
                                    <?php } ?>
                                    <div id="criarGrupoContainer" class="liberar_grupo_container" style="display:none">
                                        <form action="">
                                            <fieldset>
                                                <legend>Novo grupo</legend>
                                                <div class="formfield formfield-s">
                                                    <label for="">Série</label>
                                                    <span>
                                                        <select name="grp_serie" id="grp_serie">
                                                            <option>Carregando...</option>
                                                        </select>
                                                    </span>
                                                </div>
                                                <div class="formfield formfield-s">
                                                    <label for="">Período</label>
                                                    <span>
                                                        <select name="grp_periodo" id="grp_periodo">
                                                            <option>Carregando...</option>
                                                        </select>
                                                    </span>
                                                </div>
                                                <div class="formfield formfield-s" style="visibility: hidden"></div>
                                                <div class="formfield">
                                                    <label for="">Buscar aluno</label>
                                                    <span>
                                                        <input type="text" class="campo-pesquisa" placeholder="Digite o nome do aluno"/>
                                                    </span>
                                                </div>
                                                <div class="formfield">
                                                    <span>
                                                        <div id="alunosContainer" class="checkbox-list checkbox-block-list">
                                                            Carregando...
                                                        </div>
                                                    </span>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="formbtns">
                                                    <input type="reset" id="cancelarGrupo" value="Voltar"/>
                                                    <input type="submit" id="salvarGrupo" value="Salvar"/>
                                                </div>
                                            </fieldset>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="conteudo_lateral">
                                        <div class="form_filtros">
                                            <h2>Gerar relatório</h2>
                                            <label for="filtroLivro">Livro</label>
                                            <select id="filtroLivro" class="filtrosSelect">
                                                <?php //$templateRelatorio->getLivros($par);  ?>
                                            </select>
                                            <label for="filtroCapitulo">Capítulo</label>
                                            <select id="filtroCapitulo" class="filtrosSelect">
                                                <?php //$templateRelatorio->getCapitulos($par);  ?>
                                            </select>
                                            <label for="filtroSala">Sala</label>
                                            <select id="filtroSala" class="filtrosSelect">
                                                <?php //$templateRelatorio->getSalas($par);  ?>
                                            </select>

                                            <?php
                                            if ($logado["perfil_id"] == 3) {
                                                $templateRelatorio->printCountUsuariosPorPerfil();
                                            }
                                            ?>
                                        </div>
                                        <div class="legenda_grafico">
                                            <h2>Legenda</h2>
                                            <div id="legendaGrafico1">
                                                <div><img src="img/leg_graf_acessos.png" alt="Quantidade de acessos à galeria"><span>Quantidade de acessos à galeria</span></div>
                                                <div><img src="img/leg_graf_downloads.png" alt="Quantidade de downloads de conteúdo"><span>Quantidade de downloads de conteúdo</span></div>
                                            </div>
                                            <div id="legendaGrafico2" style="display: none;">
                                                <div><img src="img/leg_graf_acertos_pre.png" alt="Acertos - pré-avaliação"><span>Acertos - pré-avaliação</span></div>
                                                <div><img src="img/leg_graf_acertos_pos.png" alt="Acertos - pós-avaliação"><span>Acertos - pós-avaliação</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade in" id="myModal" role="dialog" style="display: none;">
                        <div class="modal-dialog modal-sm">
                            <div class="borda_laranja">
                                <div class="modal-body">
                                    <div id="tipoMensagem"></div>
                                    <div class="modal-body-container">
                                        <div class="text-modal">
                                            <p class="txt_laranja" id="modalTexto"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn_laranja botao_modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade in" style="display: none;"></div>
                </div>
            </div>
        </div>
        <footer>
            <?php
            $templateGeral->rodape();
            ?>
        </footer>

        <!-- Modal de visualização das infos básicas do usuário -->

        <div id="userInfoModalBg" class="user-info-modal-bg" data-component="modal">
            <div id="userInfoModal" class="user-info-modal">
                <p class="text-center">Carregando...</p>
            </div>
        </div>

        <!-- Fim modal de visualização das infos básicas do usuário -->

        <!--Sempre que for utilizar uma mensagem, criar uma div com a classe modalMensagem e com o display none-->
        <div id="mensagemCapituloLiberado" class='modalMensagem' style="display:none">
            <?php
            $templateGeral->mensagemRetorno('livros', 'Capítulo liberado com sucesso!', 'sucesso');
            ?>
        </div>
        <div id="mensagemSucessoDeletar" style="display:none" class='modalMensagem'>
            <?php
            $templateGeral->mensagemRetorno('livros', 'Capítulo bloqueado com sucesso!', 'sucesso');
            ?>
        </div>
        <div id="mensagemSucessoEnvioDoc" class="modalMensagem" style="display: none">
            <?php
            $templateGeral->mensagemRetorno("livros", "Documento enviado com sucesso", "sucesso");
            ?>
        </div>

        <!--  Modal envio documentos -->

        <?php
        // APAGAR ISSO PELO AMOR DE DEUS
        $nomes = ["Escola da Ponte", "Desembargador Amorim Lima", "Escolinha do Diego", "Heat high school"];
        ?>

        <div id="envioDocModalBg" class="envio-doc-modal-bg">
            <div id="envioDocModal" class="envio-doc-modal" data-component="modal">
          <!-- Envio existente -->
            </div>
        </div>


        <!-- Modal novo envio de documento -->
        <div id="formEnvioDocModalBg" class="envio-doc-modal-bg">
          <!-- Formulário novo envio -->
          <div id="formEnvioDocModal" class="modal-generic">
            <p class="text-center">Carregando...</p>
          </div>
        </div>

    </body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/lib/jquery.mask.js"></script>
    <script type="text/javascript" src="js/lib/jquery.maskedinput.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/malihu.3.0.3/mCustomScrollbar.js"></script>
    <script src="js/malihu.3.0.3/mCustomScrollbar.concat.min.js"></script>
    <script src="bootstrap/js/bootstrap-datepicker.js"></script>
    <script src="js/modulos/formulario.js"></script>
    <script src="js/EstadoCidade.js"></script>
    <script src="js/funcoes.js"></script>
    <script src="js/cadastro.js" async></script>
    <script src="js/relatorios.js" async></script>
    <script src="js/documento.js" async></script>
    <script src="js/liberarCapitulos.js" async></script>
    <script src="js/goMobileUpload.js"></script>
</html>
