"use strict";

$(document).ready(function() {
    gerarPickerTipoGrafico();
    atribuirBarrasRolagem();
    menuAtribuirCapitulo();
    var data = getDadosUsuario();
    var data2 = getDadosUsuario();
    carregarGrafico(data);
    carregarTodosFiltros(data2);
    filtrosChange();
    botoesGrupo();
    voltarGrafico();
    atribuirEventosModal();
});

function gerarPickerTipoGrafico() {
    $("#tipo_grafico_picker").click(function(event) {
        event.stopPropagation();
        $(this).toggleClass("picker_expanded");
    });

    $(".tipo_grafico_picker_opcoes").children("div").click(function() {
        toggleGrafico(this);
    });

    $("body").click(function() {
        $("#tipo_grafico_picker").removeClass("picker_expanded");
    });
}

function atribuirBarrasRolagem () {
    $(".listagem_perfis_graficos").mCustomScrollbar({
        axis: "y",
        scrollButtons:{
            enable:true
        }
    });
}

function toggleGrafico(item)
{
    var texto = $(item).html();

    $("#tipo_grafico_picker").removeClass("picker_expanded");
    if (texto != $("#tipo_grafico_picker").html){
        $(".tipo_grafico_picker_opcoes").children("div").not(item).removeClass("option_selected");
        $(item).addClass("option_selected");
        $("#tipo_grafico_picker").html(texto);
        carregarGrafico(getDadosUsuario());
    }

};

function menuAtribuirCapitulo () {
    $("#liberarCapitulosTable").find("span").click(function() {
        if ($(this).is(".cap_nao_liberado")) {
            $(this).addClass("cap_liberado");
            $(this).removeClass("cap_nao_liberado");
        } else if ($(this).is(".cap_liberado")) {
            $(this).removeClass("cap_liberado");
            $(this).addClass("cap_nao_liberado");
        }
    });
}

/**
 * Volta para a listagem anterior de gráficos de relatório.
 */
function voltarGrafico()
{
    $("#btn_voltar").click(function() {
        var idusuario   = parseInt(document.getElementById("idusuario").value);
        var idescola    = parseInt(document.getElementById("idescola").value);
        var idperfil    = parseInt(document.getElementById("idperfil").value);

        $('.lista_itens_grafico').empty();

        if (idperfil == 2 && (usuario.perfil == 3 || usuario.perfil == 4)) {
            getUsrEscolaByEscola(idescola, viewUserSelected);
        } else if (idperfil == 4 && usuario.perfil == 3) {
            $("#box_perfil_selected").remove();
            carregarGrafico(getDadosUsuario());
            $("#grafInfoPerfisListados").text("Escolas");
        }
    });
}

function filtrosChange () {

    $(".filtrosSelect").change(function() {
        carregarGrafico(getDadosUsuario());

        var data = getDadosUsuario();
        $(".filtrosSelect").not(this).each(function() {
            carregaFiltro(data, this);
        });
    });
}

function carregarGrafico (data) {
    var d = data

    $('.lista_itens_grafico').html("Carregando...");
    d.acao = "carregaGrafico";
    d.grafico = $('.option_selected ').attr('id');

    $.ajax({
        url: 'ajax/RelatoriosAjax.php',
        type: 'GET',
        data: d,
                beforeSend: function() {
                    $("#grafInfoCountPerfisListados").text("(Carregando...)");
                },
        success: function(dados) {
            $('.lista_itens_grafico').html(dados);
            return false;
        },
                complete: function() {
                    countPerfisListados();
                }
    });
    return false;
}

function carregaFiltro(data, filtro) {
    var valor = $(filtro).val();
    $(filtro).html("<option>Carregando...</option>");
    data.filtro = filtro.id
    data.acao = "carregaFiltro";
    $.ajax({
        url: "ajax/RelatoriosAjax.php",
        type: "GET",
        data: data,
        success: function(d) {
            $(filtro).html(d);
        },
        complete: function() {
            if (valor != null)
                $(filtro).val(valor);
        }
    });
}

function carregarTodosFiltros(data) {
    $('.filtrosSelect').each(function() {
        carregaFiltro(data, this);
    })
}

function getDadosUsuario () {
    var perfil = 3;
    var id = 0;
    var data = {};

    if (document.getElementById("idperfil") !== null)
        perfil = parseInt(document.getElementById("idperfil").value);
    else
        perfil = usuario.perfil;

    if (perfil !== 4) {
        if (document.getElementById("idusuario") !== null)
            id = parseInt(document.getElementById("idusuario").value);
        else
            id = usuario.id
    } else {
        if (document.getElementById("idescola") !== null)
            id = parseInt(document.getElementById("idescola").value);
        else
            id = usuario.escola;
    }

    data = {
        'livro' : $('#filtroLivro').val(),
        'capitulo' : $('#filtroCapitulo').val(),
        'sala' : $('#filtroSala').val(),
        'perfil' : perfil,
        'id' : id,
    };

    if (data.livro == null)
        data.livro = 0;
    if (data.capitulo == null)
        data.capitulo = 0;
    if (data.sala == null)
        data.sala = 0;

    return data;
}

function abrirEdicaoGrupo(idProfessor) {
    $("#criarGrupoContainer").show();
    $("#conteudoPrincipal").hide();
    $('#alunosContainer').html("Carregando...");
    $.ajax({
        url: "ajax/SerieAjax.php",
        data: { 'acao' : 'listarDisponiveisProfessor',
                'idProfessor' : idProfessor},
        dataType: "json",
        success: function(dataSeries) {
            var htmlSeries = "";
            for (var i = 0; i < dataSeries.length; i++)
                htmlSeries += '<option value="'+dataSeries[i].id+'">'+dataSeries[i].serie+'ª Série</option>';
            $('#grp_serie').html(htmlSeries);
            carregarPeriodosSerie(idProfessor);
        }
    });
    $('#grp_serie').change(function() {
        $('#alunosContainer').html("Carregando...");
        carregarPeriodosSerie(idProfessor);
    });

}

function carregarPeriodosSerie(idProfessor) {
    $('#grp_periodo').html('<option>Carregando...</option>');
    $.ajax({
        url: "ajax/PeriodoAjax.php",
        data: { 'acao' : 'listarDisponiveisProfessorSerie',
                'idProfessor' : idProfessor,
                'serie' : $('#grp_serie').val()},
        dataType: "json",
        success: function(dataPeriodos){
            var htmlPeriodos = "";
            for (var i = 0; i < dataPeriodos.length; i++){
                htmlPeriodos += '<option value="'+dataPeriodos[i].id+'">'+dataPeriodos[i].periodo+'</option>'
            }
            $('#grp_periodo').html(htmlPeriodos);
            carregarAluno();
            $('#grp_periodo').change(function() {
                carregarAluno();
            })
        }
    });
}

function carregarAluno() {
    $.ajax({
        url: "ajax/UsuarioAjax.php",
        data: { 'acao' : 'buscaAlunoSemGrupoBySerieEscola',
                'serie' : $('#grp_serie').val(),
                'idEscola' : $('#escola_id').attr('id_escola')},
        dataType: 'json',
        success: function(dataAlunos){
            var htmlAlunos = '';
            for (var i = 0; i < dataAlunos.length; i++){
                htmlAlunos +=   '<input name="usr_id" value="'+dataAlunos[i].idVariavel+'" type="checkbox" class="aluno_grupo" id="aluno_'+dataAlunos[i].idUsuario+'">';
                htmlAlunos +=   '<label for="aluno_'+dataAlunos[i].idUsuario+'" class="checkbox-list-item checkbox-block">';
                htmlAlunos +=       '<img src="'+dataAlunos[i].imagem+'">';
                htmlAlunos +=       dataAlunos[i].nome;
                htmlAlunos +=   '</label>';
            }
            $('#alunosContainer').html(htmlAlunos);
        }
    });
}

function botoesGrupo() {
    $('#cancelarGrupo').click(function() {
        $('#grp_periodo').html('<option>Carregando...</option>');
        $('#grp_serie').html('<option>Carregando...</option>');
        $("#criarGrupoContainer").hide();
        $("#conteudoPrincipal").show();
    });

    $('#salvarGrupo').click(function(e) {
        e.preventDefault();
        adicionarAlunosGrupo();
    });
}

function adicionarAlunosGrupo() {
     var alunos = "";
    $('.aluno_grupo:checked').each(function() {
            if (alunos === "")
                alunos = "(" + $(this).val();
            else
                alunos += ", " + $(this).val();
    });
    alunos += ")";
    $.ajax({
            url: "ajax/RelatoriosAjax.php",
            data: { 'acao' : 'adicionarGrupoProfessorSeriePeriodo',
                    'alunos' : alunos,
                    'idProfessor' : $('#professor_id').attr('id_professor'),
                    'serie' : $('#grp_serie').val(),
                    'periodo' : $('#grp_periodo').val()},
            type: "POST",
            success: function() {
            }
    });

    $('#tipoMensagem').removeClass();
    $('#tipoMensagem').addClass("sucesso");
    $("#modalTexto").html('Alunos atribuidos ao grupo!');
    $('.modal').show();
    $('.modal-backdrop').show();
    $('#cancelarGrupo').trigger('click');
}

/**
 * Exibe o modal#userInfoModal e chama a requisição dos dados <br>
 * do usuário
 *
 * @param {String, Number} idusr Id do usuário a ser buscado
 */
function showModalUserBasicInfo(idusr) {
    $("#userInfoModalBg").fadeIn(400);
    $("#userInfoModal").animate({top: "20%"}, 400);

    getDadosDoUsuario(idusr, viewUserBasicInfo);
}

/**
 * Faz a requisição dos dados do usuário selecionado e executa <br>
 * callback
 *
 * @param {Number, String} idusr Id do usuário a ser buscado
 * @param {Object} callback Função a ser chamada no método success()
 */
function getDadosDoUsuario(idusr, callback) {
    $.ajax({
        url: "ajax/UsuarioAjax.php",
        type: "GET",
        dataType: "json",
        data: "acao=dadosGenericos&id=" + idusr,
        success: function(data) { console.log(data); callback(data); },
        error: function(e) { console.error("Erro" + " /// " + e.txtStatus); }
    });
}

/**
 * Pega os dados do usuário tipo escola associado à escola passada
 *
 * @param {String, Number} idescola Id da escola a ser buscada
 * @param {Object} callback Função a ser chamada no método success()
 */
function getUsrEscolaByEscola(idescola, callback) {
    $.ajax({
        url: 'ajax/UsuarioAjax.php',
        type: 'GET',
        data: {
            'acao' : 'getUsrEscolaByEscola',
            'id'   : idescola
        },
        dataType: 'json',
        success: function(escola) {
            callback(escola);
        }
    });
}

/**
 * Insere o html das informações báscas do usuário selecionado
 *
 * @param {Object} userData Objeto JSON com os dados do usuário
 */
function viewUserBasicInfo(userData) {
    $("#userInfoModal").html(gerarHtmlUserBasicInfo(userData));
}

/**
 * Cria o html com os dados básicos do usuário selecionado
 *
 * @param {Object} userData Objeto JSON com os dados do usuário
 * @returns {String} HTML do conteúdo do modal
 */
function gerarHtmlUserBasicInfo(userData) {
    var htmlInfos = "";

    // Cabeçalho
    htmlInfos += "<div class='user-info-modal-header'>";
    htmlInfos +=    "<h2>" + userData.perfil.tipo + "</h2>";
    htmlInfos +=    "<span class='glyphicon glyphicon-remove ic-close-user-info-modal' onclick='closeUserInfoModal()'></span>";
    htmlInfos += "</div>";

    // Corpo
    htmlInfos += "<div class='user-info-modal-body'>";
    htmlInfos +=    "<div class='row'>";
    htmlInfos +=        "<div class='col-md-8'>";
    htmlInfos +=            "<p class='user-info'>";
    htmlInfos +=                "<span class='user-info-label'>Nome: </span>";
    htmlInfos +=                "<span class='user-info-value'>" + userData.nome + "</span>";
    htmlInfos +=            "</p>";

    if (userData.perfil.id == 1) {
        htmlInfos += "<p class='user-info'>";
        htmlInfos +=    "<span class='user-info-label'>Escola: </span>";
        htmlInfos +=    "<span class='user-info-value'>" + userData.escola.nome + "</span>";
        htmlInfos += "</p>";
        htmlInfos += "<p class='user-info'>";
        htmlInfos +=    "<span class='user-info-label'>Localização: </span>";
        htmlInfos +=    "<span class='user-info-value'>" + userData.endereco.cidade + " - " + userData.endereco.uf + "</span>";
        htmlInfos += "</p>";
        htmlInfos += "<p class='user-info'>";
        htmlInfos +=    "<span class='user-info-label'>Grupo: </span>";
        htmlInfos +=    "<span class='user-info-value'>" + userData.grupo.nome + "</span><br />";
        htmlInfos +=    "<span class='user-info-label'>Professor: </span>";
        htmlInfos +=    "<span class='user-info-value'>" + userData.grupo.professor + "</span> <br />";
        htmlInfos +=    "<span class='user-info-label'>Período: </span>";
        htmlInfos +=    "<span class='user-info-value'>" + (userData.grupo.periodo == 1 ? "Manhã" : "Tarde") + "</span> | ";
        htmlInfos +=    "<span class='user-info-label'>Série: </span>";
        htmlInfos +=    "<span class='user-info-value'>" + userData.grupo.serie + "&#170; série</span>";
        htmlInfos += "</p>";
    } else if (userData.perfil.id == 2) {
        htmlInfos += gerarHtmlBasicInfoProfessor(userData);
    } else if (userData.perfil.id == 4) {
        htmlInfos += gerarHtmlBasicInfoEscola(userData);
    } else {
        console.info("Usuário NEC");
    }

    htmlInfos +=        "</div>";
    htmlInfos +=        "<div class='col-md-4'>";
    htmlInfos +=            "<div class='user-info-foto'>";
    htmlInfos +=                "<img src='imgp/" + userData.imagem + "' title='" + userData.nome + "' alt='" + userData.nome + "' height='auto' max-width='80px' />";
    htmlInfos +=            "</div>";
    htmlInfos +=        "</div>";
    htmlInfos +=        "<div class='user-info-btns'>";
    htmlInfos +=            "<a href='cadastro.php?perfil=" + userData.perfil.id + "&usuario=" + userData.id + "'>";
    htmlInfos +=                "<span>Ver dados cadastrais</span>";
    htmlInfos +=            "</a>";
    htmlInfos +=        "</div>";
    htmlInfos +=    "</div>";
    htmlInfos += "</div>";

    return htmlInfos;
}


/**
 * Gera o html base com as informações básicas do usuário <br>
 * selecionado e solicita o resto de acordo com o perfil.
 *
 * @param {Object} JSON com os dados do usuário
 */
function viewUserSelected(usr) {
    var html = "";

    if (usr.perfil.id == 2)
        $("#grafInfoPerfisListados").text("Alunos");
    else if (usr.perfil.id == 4)
        $("#grafInfoPerfisListados").text("Professores");
    else
        $("#grafInfoPerfisListados").text("Escolas");

    $("#box_perfil_selected").remove();

    html += '<div id="box_perfil_selected" class="box_perfil_selected ficha_dados">';
    html +=     "<input type='hidden' id='idusuario' value='" + usr.id + "' />";
    html +=     "<input type='hidden' id='idperfil' value='" + usr.perfil.id + "' />";
    html +=     "<input type='hidden' id='idescola' value='" + usr.escola.id + "' />";
    html +=     "<div class='user-info-modal-body'>";
    html +=         "<div class='row'>";
    html +=             "<div class='col-md-8'>";
    html +=                 "<div class='user-info-modal-header'>";
    html +=                     "<h2>" + usr.nome + "</h2>";
    html +=                 "</div>";

    html += usr.perfil.id === 2 ?
                gerarHtmlBasicInfoProfessor(usr) :
                gerarHtmlBasicInfoEscola(usr);

    html +=             "</div>";
    html +=             "<div class='col-md-4'>";
    html +=                 "<div class='user-info-foto'>";
    html +=                     "<img src='imgp/" + usr.imagem + "' title='" + usr.nome + "' alt='" + usr.nome + "' height='auto' max-width='80px' />";
    html +=                 "</div>";
    html +=             "</div>";
    html +=             "<div class='user-info-btns'>";
    html +=                 "<a href='cadastro.php?perfil=" + usr.perfil.id + "&usuario=" + usr.id + "'>";
    html +=                     "<span>Ver dados cadastrais</span>";
    html +=                 "</a>";
    html +=             "</div>";
    html +=         "</div>";
    html +=     "</div>";
    html += "</div>";

    $(".tipo_grafico_picker_opcoes").after(html);
    carregarGrafico(getDadosUsuario());
}

/**
 * Fecha o modal#userInfoModal
 */
function closeUserInfoModal() {
    $("#userInfoModal").animate({top: "10%"}, 400);
    $("#userInfoModal").parent().fadeOut(400, function() {
        $("#userInfoModal").html("<p class='text-center'>Carregando...</p>");
    });
}

/**
 * Gera o html com as informações básicas do usuário <br>
 * do tipo "Professor".
 *
 * @param {Object} JSON com os dados do professor
 * @returns {String} HTML com as informações básicas do professor
 */
function gerarHtmlBasicInfoProfessor(usr) {
    var html = "";

    html += "<p class='user-info'>";
    html +=    "<span class='user-info-label'>Escola: </span>";
    html +=    "<span class='user-info-value'>" + usr.escola.nome + "</span>";
    html += "</p>";
    html += "<p class='user-info'>";
    html +=    "<span class='user-info-label'>Localização: </span>";
    html +=    "<span class='user-info-value'>" + usr.endereco.cidade + " - " + usr.endereco.uf + "</span>";
    html += "</p>";
    html += "<p class='user-info'>";
    html +=    "<span class='user-info-label'>Grupo: </span>";
    html +=    "<span class='user-info-value'>" + usr.grupo.nome + "</span> <br />";
    html +=    "<span class='user-info-label'>Período: </span>";
    html +=    "<span class='user-info-value'>" + (usr.grupo.periodo == 1 ? "Manhã" : "Tarde") + "</span> | ";
    html +=    "<span class='user-info-label'>Série: </span>";
    html +=    "<span class='user-info-value'>" + usr.grupo.serie + "&#170; série</span>";
    html += "</p>";

    return html;
}

/**
 * Gera o html com as informações básicas do usuário
 * do tipo "Escola".
 *
 * @param {Object} JSON com os dados da escola
 * @returns {String} HTML com as informações básicas da escola
 */
function gerarHtmlBasicInfoEscola(usr) {
    var html = "";

    html += "<p class='user-info'>";
    html +=    "<span class='user-info-label'>NSE: </span>";
    html +=    "<span class='user-info-value'>" + usr.nse + "</span>";
    html += "</p>";
    html += "<p class='user-info'>";
    html +=    "<span class='user-info-label'>Localização: </span>";
    html +=    "<span class='user-info-value'>" + usr.endereco.cidade + " - " + usr.endereco.uf + "</span>";
    html += "</p>";
    html += "<p class='user-info'>";
    html +=    "<span class='user-info-label'>Professores: </span>";
    html +=    "<span class='user-info-value'>" + usr.numero_professores + "</span> | ";
    html +=    "<span class='user-info-label'>Alunos: </span>";
    html +=    "<span class='user-info-value'>" + usr.numero_alunos + "</span>";
    html += "</p>";

    return html;
}

/**
 * Atribui os eventos referentes ao modal#userInfoModal: <br>
 * - Ao clicar na div#userInfoModalBg, o modal fecha <br>
 * - Ao pressionar a tecla "Esc", o modal fecha <br>
 * - Ao clicar sobre o modal#userInfoModal, o evento de click é anulado
 */
function atribuirEventosModal() {
    document.onkeyup = function(evt) {
        if (evt.keyCode == 27)
            closeUserInfoModal();
    };

    document.getElementById("userInfoModalBg")
            .onclick = closeUserInfoModal;

    document.getElementById("userInfoModal")
            .onclick = function(evt) {
                evt.stopPropagation();
    };
}

/**
 * Faz a contagem dos perfis listados no relatório e exibe no
 * span#grafInfoCountPerfisListados
 */
function countPerfisListados() {
    var perfis = $(".lista_itens_grafico")
                    .filter(":visible")
                    .children("div");

    $("#grafInfoCountPerfisListados").text("(" + perfis.length + ")");
}