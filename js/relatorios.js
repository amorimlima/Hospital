"use strict";

var formNovoEnvioDoc;

var envioDocs = {
  url: "ajax/DocumentosAjax.php",
  postDoc: function(dados, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "POST",
      data: dados,
      contentType: false,
      cache: false,
      processData: false,
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage);
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  postEnvio: function(dados, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "POST",
      data: dados,
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage);
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  postRetorno: function(dados, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "POST",
      data: dados,
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage);
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  getDocumentosEnviados: function(callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=getDocumentosEnviados",
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage);
      },
      success: function(data) {
        callback(data)
      }
    })
  },
  getDocumentosRecebidos: function(callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=getEnvioEscola&idEscola=" + usuario.escola,
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage);
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  getEnvioByDocumento: function(iddocumento, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=enviosPorDocumento&idDocumento=" + iddocumento,
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage);
      },
      success: function(data) {
        callback(data);
      }
    })
  },
  getDestinatariosByDocumento: function(iddocumento, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=destinatariosPorDocumento&idDocumento="+iddocumento,
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  getRetornosByEscolaAndEnvio: function(idenvio,callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=retornosPorEnvioEscola&idEscola=" + usuario.escola + "&idEnvio=" + idenvio,
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  getDocumentoByEnvio: function(idenvio, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=documentoPorEnvio&idenvio=" + idenvio,
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  getRetorno: function(idretorno, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "GET",
      data: "acao=getRetorno&id=" + idretorno,
      dataType: "json",
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        callback(data);
      }
    });
  },
  setEnvioVisto: function(idenvio) {
    $.ajax({
      url: envioDocs.url,
      type: "POST",
      data: "acao=visualizarEnvio&idEnvio=" + idenvio,
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        console.log(parseInt(data));
      }
    });
  },
  setRetornoVisto: function(idretorno) {
    $.ajax({
      url: envioDocs.url,
      type: "POST",
      data: "acao=visualizarRetorno&idRetorno=" + idretorno,
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        console.log(parseInt(data));
      }
    });
  }
}

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

    // TESTE
    getDadosEnvioDocumentos();
});

function gerarPickerTipoGrafico() {
    $("#tipo_grafico_picker").click(function(event) {
        event.stopPropagation();
        $(this).toggleClass("picker_expanded");
    });

    $(".tipo_grafico_picker_opcoes").children("div").click(function() {
        var grafico = $(this).attr("data-grafico");

        toggleGrafico(this, grafico);
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
    // $(".envio-doc-lista").mCustomScrollbar({
    //   axis: "y",
    //   scrollButtons: {
    //     enable: true
    //   }
    // });
}

function toggleGrafico(item, grafico)
{
    var texto = $(item).html();

    $("#tipo_grafico_picker").removeClass("picker_expanded");
    if (texto != $("#tipo_grafico_picker").html){
        $(".tipo_grafico_picker_opcoes").children("div").not(item).removeClass("option_selected");
        $(item).addClass("option_selected");
        $("#tipo_grafico_picker").html(texto);
        carregarGrafico(getDadosUsuario());
        updateLegendaGrafico(grafico);
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

    calcularAlturaMaximaListagem();

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
    closeUserInfoModal();
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
        success: function(data) { callback(data); },
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
    atribuirEventosModal();
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

    if (userData.perfil.id == 1)
        htmlInfos += gerarHtmlBasicInfoAluno(userData);
    else if (userData.perfil.id == 2)
        htmlInfos += gerarHtmlBasicInfoProfessor(userData);
    else if (userData.perfil.id == 4)
        htmlInfos += gerarHtmlBasicInfoEscola(userData);

    htmlInfos +=        "</div>";
    htmlInfos +=        "<div class='col-md-4'>";
    htmlInfos +=            "<div class='user-info-foto'>";
    htmlInfos +=                "<img src='imgp/" + userData.imagem + "' title='" + userData.nome + "' alt='" + userData.nome + "' height='auto' max-width='80px' />";
    htmlInfos +=            "</div>";
    htmlInfos +=        "</div>";
    htmlInfos +=    "</div>";
    htmlInfos += "</div>";
    htmlInfos += "<div class='user-info-modal-footer'>";

    if (userData.perfil.id == 1)
        htmlInfos += gerarHtmlFooterBasicInfoAluno(userData);
    else if (userData.perfil.id == 2)
        htmlInfos += gerarHtmlFooterBasicInfoProfessor(userData);
    else if (userData.perfil.id == 4)
        htmlInfos += gerarHtmlFooterBasicInfoEscola(userData);

    htmlInfos += "</div>";

    return htmlInfos;
}


/**
 * Gera o html base com as informações básicas do usuário <br>
 * selecionado e solicita o resto de acordo com o perfil.
 *
 * @param {Object} usr JSON com os dados do usuário
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
    html +=         "</div>";
    html +=     "</div>";
    html +=     "<div class='user-info-modal-footer'>";
    html +=         "<div class='user-info-btns'>";

    html += usr.perfil.id == 2 ?
            gerarHtmlFooterBasicInfoProfessor(usr) :
            gerarHtmlFooterBasicInfoEscola(usr);

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
 * do tipo "Aluno".
 *
 * @param {Object} JSON com os dados do aluno
 * @returns {String} HTML com as informações básicas do aluno
 */
function gerarHtmlBasicInfoAluno(usr) {
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
    html +=    "<span class='user-info-value'>" + usr.grupo.nome + "</span><br />";
    html +=    "<span class='user-info-label'>Professor: </span>";
    html +=    "<span class='user-info-value'>" + usr.grupo.professor + "</span> <br />";
    html +=    "<span class='user-info-label'>Período: </span>";
    html +=    "<span class='user-info-value'>" + (usr.grupo.periodo == 1 ? "Manhã" : "Tarde") + "</span> | ";
    html +=    "<span class='user-info-label'>Série: </span>";
    html +=    "<span class='user-info-value'>" + usr.grupo.serie + "&#170; série</span>";
    html += "</p>";

    return html;
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
 * Gera o html com as informações básicas do usuário <br>
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
 * Gera o html do rodapé das informações básicas do usuário <br>
 * do tipo "Escola".
 *
 * @param {Object} JSON com os dados da escola
 * @returns {String} HTML do rodapé das informações básicas da escola
 */
function gerarHtmlFooterBasicInfoAluno(usr) {
    var html = "";

    if (usuario.perfil == 4 || usuario.perfil == 2) { // Verificar se o usuário logado é do tipo "Escola" ou "Professor"
        html += "<div class='user-info-btns'>";
        html +=     "<a href='cadastro.php'>";
        html +=         "<span class='link' onclick='closeUserInfoModal()'>Ver dados cadastrais</span>";
        html +=     "</a>";
        html += "</div>";
    }

    return html;
}

/**
 * Gera o html do rodapé das informações básicas do usuário <br>
 * do tipo "Professor".
 *
 * @param {Object} JSON com os dados do professor
 * @returns {String} HTML do rodapé das informações básicas do professor
 */
function gerarHtmlFooterBasicInfoProfessor(usr) {
    var html = "";

    if (usuario.perfil == 4) { // Verificar se o usuário logado é do tipo "Escola"
        html += "<div class='user-info-btns'>";
        html +=     "<a href='cadastro.php'>";
        html +=         "<span class='link' onclick='closeUserInfoModal()'>Ver dados cadastrais</span>";
        html +=     "</a>";
        html +=     " | ";
        html +=     "<span id='editar_grupos' class='link' onclick='abrirEdicaoGrupo(" + usr.id + ")'>Editar grupos</span>";
        html += "</div>";
    }

    return html;
}

/**
 * Gera o html do rodapé das informações básicas do usuário <br>
 * do tipo "Aluno".
 *
 * @param {Object} JSON com os dados do aluno
 * @returns {String} HTML do rodapé das informações básicas do aluno
 */
function gerarHtmlFooterBasicInfoEscola(usr) {
    var html = "";

    if (usuario.perfil == 3) { // Verificar se usuário logado é do tipo "NEC"
        html += "<div class='user-info-btns'>";
        html +=     "<a href='cadastro.php'>";
        html +=         "<span class='link' onclick='closeUserInfoModal()'>Ver dados cadastrais</span>";
        html +=     "</a>";
        html +=     " | ";
        html +=     "<span id='lib_cap_" + usr.escola.id + "' class='link' onclick='getCapitulosByEscola(" + usr.escola.id + ")'>";
        html +=         "Liberar capítulos";
        html +=     "</span>";
        html += "</div>";
    }

    return html;
}

/**
 * Atribui os eventos referentes ao modal#userInfoModal: <br>
 * - Ao clicar no bg, o modal fecha <br>
 * - Ao pressionar a tecla "Esc", o modal fecha <br>
 * - Ao clicar sobre o modal#userInfoModal, o evento de click é anulado
 */
function atribuirEventosModal() {
    $(document).keyup(function(evt) {
      if (evt.keyCode == 27) { // Veririficar se a tecla apertada é a "Esc"
        closeUserInfoModal();
        closeEnvioDocModal();
        closeFormNovoEnvioDocModal();
      }
    });

    $("#userInfoModalBg").click(function(evt) {
      closeUserInfoModal();
    });

    $("#envioDocModalBg").click(function(evt) {
      closeEnvioDocModal();
    });

    $("#userInfoModal").click(function(evt) {
      evt.stopPropagation();
    });

    $("#envioDocModal").click(function(evt) {
      evt.stopPropagation();
    });
}

/**
 * Faz a contagem dos perfis listados no relatório e exibe no <br>
 * span#grafInfoCountPerfisListados
 */
function countPerfisListados() {
    var perfis = $(".lista_itens_grafico")
                    .filter(":visible")
                    .children("div");

    $("#grafInfoCountPerfisListados").text("(" + perfis.length + ")");
}

/**
 * Calcula a altura disponível para a listagem dos gráficos de <br>
 * relatório e seta como altura máxima do container
 */
function calcularAlturaMaximaListagem() {
    var alturaPicker    = $("#tipo_grafico_picker").outerHeight();
    var alturaCabecalho = $("#box_perfil_selected").outerHeight();
    var alturaInfos     = $("#infosGraficos").outerHeight();
    var alturaTotal     = $("#conteudoPrincipal").innerHeight() - 35;
    var altura  = alturaTotal - (alturaPicker + alturaCabecalho + alturaInfos);

    $("#listagemRelatorio").css("max-height", altura + "px");
}

/**
 * Atualiza a legenda dos gráficos dependendo do tipo de relatório solicitado.
 * @param {String, Number} grafico  Número do gráfico, na ordem que aparece <br>
 *                                  no picker
 */
function updateLegendaGrafico(grafico) {
    var legenda = $("#legendaGrafico1")[0];
    var valores = { "legenda1": "", "legenda2": "" };
    var html = "";

    if (grafico == 1) {
        valores.legenda1 = "Quantidade de acessos à galeria";
        valores.legenda2 = "Quantidade de downloads de conteúdo";
    } else if (grafico == 2) {
        valores.legenda1 = "Exercícios completados";
        valores.legenda2 = "Exercícios corretos";
    } else if (grafico == 3) {
        valores.legenda1 = "Acertos em pré-avaliações";
        valores.legenda2 = "Acertos em pós-avaliações";
    }

    html += "<div>";
    html +=     "<img src='img/leg_graf_acessos.png' alt='" + valores.legenda1 + "' />";
    html +=     "<span>" + valores.legenda1 + "</span>";
    html += "</div>";
    html += "<div>";
    html +=     "<img src='img/leg_graf_downloads.png' alt='" + valores.legenda2 + "' />";
    html +=     "<span>" + valores.legenda2 + "</span>";
    html += "</div>";

    $(legenda).html(html);
}

/* Envio de documentos */
function showModalEnvioDoc() {
  $("#envioDocModalBg").fadeIn(400);
  $("#envioDocModal").animate({top: "20%"}, 400);
  $("#envioDocListaDestinatarios").mCustomScrollbar({
    axis: "y",
    scrollButtons: {
      enable: true
    }
  });
}

function showModalNovoEnvioDoc() {
  $("#formEnvioDocModalBg").fadeIn(400);
  $("#formEnvioDocModal").animate({top: "0"}, 400);
}

function closeEnvioDocModal() {
    $("#envioDocModal").animate({top: "-5%"}, 400);
    $("#envioDocModal").parent().fadeOut(400, function() {
      $("#envioDocModal").html("<p class='text-center'>Carregando...</p>");
    });
}

function getEscolas(callback) {
  $.ajax({
    url: "ajax/RelatoriosAjax.php",
    type: "GET",
    dataType: "json",
    data: "acao=listarEscolas",
    success: function(escolas) {
      callback(escolas);
    }
  });
}



function filtrarPanelList(input) {
  var lista = $("#"+input).next().find(".envio-doc");
  var texto = $("#"+input).val().toLowerCase();

  if (texto !== ""){
    $(lista).each(function(i) {
      if ($(lista).eq(i).find(".envio-doc-title").text()
          .trim().toLowerCase().indexOf(texto) >= 0)
        $(lista).eq(i).show();
      else
        $(lista).eq(i).hide();
    })
  } else {
    $(lista).show();
  }
}

function viewFormNovoEnvioDocumento(form) {
  var html = buildFormNovoEnvioDocumento;
  showModalNovoEnvioDoc();
  $("#formEnvioDocModal").html(html);
  getEscolas(viewListaSelectDestinatarios);
}

function buildFormNovoEnvioDocumento(escolas) {
  var html = "";

  html+= '<div class="envio-doc-content">';
  html+=   '<div class="envio-doc-modal-header">';
  html+=     '<h2>Envio de documento</h2>';
  html+=   '</div>';
  html+=   '<div class="envio-doc-modal-body">';
  html+=     '<form id="formNovoDoc" method="post" enctype="multipart/form-data">';
  html+=       '<fieldset>';
  html+=         '<legend>Cadastro de documento</legend>';
  html+=         '<div class="formfield">';
  html+=           '<label>Assunto</label>';
  html+=           '<span>';
  html+=             '<input id="docAssunto" name="assunto" class="obrigatorio" type="text" maxlength="100" placeholder="Digite o assunto do documento" />';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="formfield">';
  html+=           '<label>Descrição</label>';
  html+=           '<span>';
  html+=             '<textarea id="docDescricao" name="descricao" class="obrigatorio" type="text" maxlength="500" placeholder="Digite a descrição do documento (opcional)"></textarea>';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="formfield">';
  html+=           '<label for="">Arquivo</label>';
  html+=           '<span>';
  html+=             '<span>';
  html+=               '<input name="doc_arquivo" type="file" id="docArquivo">';
  html+=             '</span>';
  html+=             '<div>';
  html+=               '<label class="file" for="docArquivo">';
  html+=                 '<input type="button" onclick="$(\'#docArquivo\').trigger(\'click\')" value="Selecionar arquivo" />';
  html+=                 '<span data-for="file_arquivo">Selecione um arquivo</span>';
  html+=               '</label>';
  html+=             '</div>';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="formfield">';
  html+=           '<label for="">Retorno</label>';
  html+=           '<span>';
  html+=             '<div>';
  html+=               '<input id="doeRetorno" type="checkbox" name="tipo_arquivo" value="0" id="tipo_arquivo_link"/>';
  html+=               '<label for="doeRetorno">Solicitar um retorno das escolas</label>';
  html+=             '</div>';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="envio-doc-panel">';
  html+=           '<h4>Destinatários</h4>';
  html+=           '<input id="inputFiltroDest" onkeyup="filtrarPanelList(\'inputFiltroDest\')" class="form-control filtro-envio-doc" type="text" name="filtro-envio-doc" placeholder="Pesquisar" />';
  html+=           '<div id="listaDestinatarios" class="envio-doc-lista">';
  html+=             '<div class="item-container">Carregando...</span>';
  html+=           '</div>';
  html+=         '</div>';
  html+=       '</fieldset>';
  html+=       '<fieldset>';
  html+=         '<div class="formbtns">';
  html+=           '<button id="submitNovoDocEnvio" type="button" class="btn btn-primary" onclick="validarFormNovoDocumentoEnvio()">Enviar</button>';
  html+=         '</div>';
  html+=       '</fieldset>';
  html+=     '</form>';
  html+=     '<div class="hidden">';
  html+=       '<form id="docForm" action="ajax/DocumentosAjax.php" method="POST" enctype="multipart/form-data">';
  html+=         '<input type="hidden" name="acao" value="postDocumento" />';
  html+=         '<input type="hidden" name="assunto" value="" />';
  html+=         '<input type="hidden" name="descricao" value="" />';
  html+=       '</form>';
  html+=       '<form id="envioDocForm" action="ajax/DocumentosAjax.php" method="POST">';
  html+=         '<input type="hidden" name="acao" value="postEnvio" >';
  html+=         '<input type="hidden" name="documento" value="" />';
  html+=         '<input type="hidden" name="destinatario" value="" />';
  html+=         '<input type="hidden" name="retorno" value="" />';
  html+=       '</form>';
  html+=     '</div>';
  html+=   '</div>';
  html+= '</div>';

  return html;
}

function buildListaSelectDestinatarios(escolas) {
  var html = "";
  for (var i in escolas) {
    html += '<div class="envio-doc item-container item-check-container">';
    html +=   '<div class="envio-doc-header">';
    html +=     '<input name="doe_destinatario[]" id="esc'+escolas[i].id+'" type="checkbox" value="'+escolas[i].id+'">';
    html +=     '<label for="esc'+escolas[i].id+'" class="envio-doc-title">';
    html +=       escolas[i].nome;
    html +=     '</label>';
    html +=   '</div>';
    html +=   '<div class="envio-doc-label"></div>';
    html += '</div>';
  }
  return html;
}

function viewListaSelectDestinatarios(escolas) {
  var html = buildListaSelectDestinatarios(escolas);
  $("#listaDestinatarios").html(html);
  $("#listaDestinatarios").mCustomScrollbar({"axis":"y","scrollButtons":{"enable": true}});
}

function closeFormNovoEnvioDocModal() {
    $("#formEnvioDocModal").animate({top: "-5%"}, 400);
    $("#formEnvioDocModal").parent().fadeOut(400, function() {
        
    });
}

function validarFormNovoDocumentoEnvio() {
  var destinatariosValido = false;
  var valido = true;

  // Verifica se nenhuma escola está selecionada
  $("#listaDestinatarios").find("input:checkbox").each(function(i) {
    if ($("#listaDestinatarios").find("input:checkbox").eq(i).is(":checked")) {
      destinatariosValido = true;
    }
  });

  // Verifica se o assunto do documento está vazio
  if ($("#docAssunto").val() == "") {
    $("#docAssunto").addClass("input_faltando");
    valido = false;
  } else {
    $("#docAssunto").removeClass("input_faltando");
  }

  // Verifica se o arquivo está vazio
  if ($("#docArquivo")[0].files.length == 0) {
    $("#docArquivo").parent().parent().addClass("input_faltando");
    valido = false;
  } else {
    $("#docArquivo").parent().parent().removeClass("input_faltando");
  }

  if (!destinatariosValido) {
    $("#listaDestinatarios").addClass("input_faltando");
    valido = false;
  } else {
    $("#listaDestinatarios").removeClass("input_faltando");
  }

  if (valido && destinatariosValido) {
    var form = document.getElementById("docForm");
    var docArquivo = $("#docArquivo")[0].files[0];
    var doeDestinatarios = [];
    var formData;

    $(form).find("input[name='assunto']").val($("#docAssunto").val());
    $(form).find("input[name='descricao']").val($("#docDescricao").val());

    formData = new FormData(form);
    formData.append("arquivo", docArquivo);

    envioDocs.postDoc(formData, createEnvioDocumento);
  }
}

function createEnvioDocumento(documento) {
  var form = document.getElementById("envioDocForm");
  var listaDestinatarios = [];

  $("#listaDestinatarios input:checkbox:checked").each(function(i) {
    listaDestinatarios.push($("#listaDestinatarios input:checkbox:checked").eq(i).val());
  });

  $(form).find("input[name='documento']").val(documento.trim());
  $(form).find("input[name='destinatario']").val(listaDestinatarios.toString());
  $(form).find("input[name='retorno']").val($("#doeRetorno").is(":checked") ? 1 : 0);

  envioDocs.postEnvio($(form).serialize(), function() {closeFormNovoEnvioDocModal()});
}

function getDadosEnvioDocumentos() {
  if (usuario.perfil == 3)
    viewDocumentosEnviados();
  else if (usuario.perfil == 4)
    viewDocumentosRecebidos();
}

function viewDocumentosEnviados() {
  envioDocs.getDocumentosEnviados(function(data) {
    var html = "";
    if (data.length > 0) {
      for (var i in data) {
        html += '<div class="envio-doc clickable" onclick="viewEnvioDocumento(\''+data[i].documento_envio.documento.id+'\')">';
        html +=  '<div class="envio-doc-header">';
        html +=    '<span class="envio-doc-title">';

        if (data[i].verificadores.retornos_nao_vistos)
          html +=      '<strong>' + data[i].documento_envio.documento.assunto + '</strong>';
        else
          html +=      data[i].documento_envio.documento.assunto;

        html +=    '</span>';
        html +=    '<span class="envio-doc-date text-right">'+data[i].documento_envio.data_envio+'</span>';
        html +=  '</div>';
        html +=  '<div class="envio-doc-label">';
        html +=    '<div class="envio-doc-icones">';

        if (data[i].documento_envio.documento.descricao) {
          html +=      '<span class="glyphicon glyphicon-align-left">';
          html +=        '<span class="icon-label">Este documento possui descrição</span>';
          html +=      '</span>';
        }

        if (data[i].documento_envio.retorno) {
          if (data[i].verificadores.retornos_pendentes) {
            html +=      '<span class="glyphicon glyphicon-record">';
            html +=        '<span class="icon-label">Retornos pendentes</span>';
            html +=      '</span>';
          } else {
            html +=      '<span class="glyphicon glyphicon-ok-circle text-success">';
            html +=        '<span class="icon-label text-success">Sem retornos pendentes</span>';
            html +=      '</span>';
          }
        }

        html +=    '</div>';
        html +=  '</div>';
        html += '</div>';
      }
    } else {
      html += '<div class="alert alert-warning">';
      html +=   'Ainda não há nenhum documento enviado';
      html += '</div>';
    }

    $("#envioDocumentosLista").html(html);
    $("#envioDocumentosLista").mCustomScrollbar({
      axis: "y",
      scrollButtons: {
        enable: true
      }
    });
  });
}

function viewDocumentosRecebidos() {
  envioDocs.getDocumentosRecebidos(function(data) {
    var html = "";
    if (data.length > 0) {
      for (var i in data) {
        html += '<div class="envio-doc clickable" onclick="verEnvioRecebido(' + data[i].documento.id + ')">';
        html +=  '<div class="envio-doc-header">';
        html +=    '<span class="envio-doc-title">';

        if (data[i].visto)
          html +=        '<strong>' + data[i].documento.assunto + '</strong>';
        else
          html +=        data[i].documento.assunto;

        html +=    '</span>';
        html +=    '<span class="envio-doc-date text-right">' + data[i].data_envio+ '</span>';
        html +=  '</div>';
        html +=  '<div class="envio-doc-label">';
        html +=    '<div class="envio-doc-icones">';

        if (data[i].documento.descricao) {
          html +=      '<span class="glyphicon glyphicon-align-left">';
          html +=        '<span class="icon-label">Este documento possui descrição</span>';
          html +=      '</span>';
        }

        if (data[i].retorno) {
          if (data[i].retorno_rejeitado) {
            html +=      '<span class="glyphicon glyphicon-exclamation-sign text-danger">';
            html +=        '<span class="icon-label text-danger">Retorno rejeitado pelo NEC</span>';
            html +=      '</span>';
          } else {
            if (data[i].retorno_pendente) {
              html +=      '<span class="glyphicon glyphicon-upload">';
              html +=        '<span class="icon-label">Retorno não enviado</span>';
              html +=      '</span>';
            } else {
              html +=      '<span class="glyphicon glyphicon-upload text-success">';
              html +=        '<span class="icon-label text-success">Retorno enviado</span>';
              html +=      '</span>';
            }
          }
        }

        html +=    '</div>';
        html +=  '</div>';
        html += '</div>';
      }
    } else {
      html += '<div class="alert alert-warning">';
      html +=   'Nenhum documento recebido até agora.';
      html += '</div>';
    }

    $("#envioDocumentosLista").html(html);
    $("#envioDocumentosLista").mCustomScrollbar({
      axis: "y",
      scrollButtons: {
        enable: true
      }
    });
  });
}

function verEnvioRecebido(id) {
  showModalEnvioDoc();
  envioDocs.getEnvioByDocumento(id, function(doe) {
    envioDocs.setEnvioVisto(doe.id);
    var html = "";

    html += '<div class="envio-doc-modal-content">';
    html +=   '<div class="envio-doc-modal-header">';
    html +=     '<h2>Documento recebido</h2>';
    html +=   '</div>';
    html +=   '<div class="envio-doc-modal-body">';
    html +=     '<h3 name="assunto_documento">' + doe.documento.assunto + '</h3>';
    html +=     '<h6>Recebido em <span name="data_envio">' + doe.data_envio + '</span></h6>';
    html +=     '<h5>Descrição</h5>';
    html +=     '<p name="descricao_documento">';
    html +=       doe.documento.descricao;
    html +=     '</p>';
    html +=     '<p name="download_documento">';
    html +=       '<span class="glyphicon glyphicon-download-alt"></span>';
    html +=       '<a href="'+doe.documento.arquivo+'" target="_blank">Download do documento</a>';
    html +=     '</p>';

    if(doe.retorno) {
      html +=     '<div class="envio-doc-panel">';
      html +=       '<h4>Retornos</h4>';
      html +=       '<div id="retornosEnvioDoc" class="envio-doc-lista">';
      html +=         '<div class="alert alert-warning">Carregando retornos...</div>';
      html +=       '</div>';
      html +=     '</div>';
    }

    html +=     '<div class="text-right">';
    html +=       '<button id="btnNovoRetorno" type="button" class="btn btn-primary" disabled="disabled" onclick="showFormNovoRetorno(' + doe.id + ')">';
    html +=         'Enviar retorno';
    html +=       '</button>';
    html +=     '</div>';
    html +=   '</div>';
    html += '</div>';

    $("#envioDocModal").html(html);

    envioDocs.getRetornosByEscolaAndEnvio(doe.id, function(retornos) {
      var html = "";

      if (retornos.length > 0) {
        if (retornos[retornos.length - 1].rejeitado)
          $("#btnNovoRetorno").removeAttr("disabled");

        for (var i in retornos) {
          html += '<div class="envio-doc" onclick="viewRetorno(' + retornos[i].id + ')">';
          html +=  '<div class="envio-doc-header">';
          html +=    '<span class="envio-doc-title">';
          html +=        retornos[i].documento.assunto;
          html +=    '</span>';
          html +=    '<span class="envio-doc-date text-right">' + retornos[i].data+ '</span>';
          html +=  '</div>';
          html +=  '<div class="envio-doc-label">';
          html +=    '<div class="envio-doc-icones">'

          if (retornos[i].documento.descricao) {
            html +=      '<span class="glyphicon glyphicon-align-left">';
            html +=        '<span class="icon-label">Este documento possui descrição</span>';
            html +=      '</span>';
          }

          if (retornos[i].rejeitado) {
            html +=      '<span class="glyphicon glyphicon-exclamation-sign text-danger">';
            html +=        '<span class="icon-label text-danger">Retorno rejeitado pelo NEC</span>';
            html +=      '</span>';
          } else {
            if (retornos[i].pendente) {
              html +=      '<span class="glyphicon glyphicon-upload">';
              html +=        '<span class="icon-label">Retorno não enviado</span>';
              html +=      '</span>';
            } else {
              html +=      '<span class="glyphicon glyphicon-upload text-success">';
              html +=        '<span class="icon-label text-success">Retorno enviado</span>';
              html +=      '</span>';
            }
          }

          html +=    '</div>';
          html +=  '</div>';
          html += '</div>';
        }
      } else {
        html +=   '<div class="alert alert-warning">Nenhum retorno enviado</div>';
        $("#btnNovoRetorno").removeAttr("disabled");
      }

      $("#retornosEnvioDoc").html(html);
      $("#retornosEnvioDoc").mCustomScrollbar({
        axis:"y",
        scrollButtons: {
          enable: true
        }
      });
    })
  });
}

function viewEnvioDocumento(id) {
  showModalEnvioDoc();

  envioDocs.getEnvioByDocumento(id, function(doe) {
    var html = "";

    html += '<div class="envio-doc-modal-content">';
    html +=   '<div class="envio-doc-modal-header">';
    html +=     '<h2>Documento enviado</h2>';
    html +=   '</div>';
    html +=   '<div class="envio-doc-modal-body">';
    html +=     '<h3 name="assunto_documento">' + doe.documento.assunto + '</h3>';
    html +=     '<h6>Enviado em <span name="data_envio">' + doe.data_envio + '</span></h6>';
    html +=     '<h5>Descrição</h5>';
    html +=     '<p name="descricao_documento">';
    html +=       doe.documento.descricao;
    html +=     '</p>';
    html +=     '<p name="download_documento">';
    html +=       '<span class="glyphicon glyphicon-download-alt"></span>';
    html +=       '<a href="'+doe.documento.arquivo+'" target="_blank">Download do documento</a>';
    html +=     '</p>';
    html +=     '<div class="envio-doc-panel">';
    html +=       '<h4>Destinatários</h4>';
    html +=       '<input id="filtroDestinatarios" onkeyup="filtrarPanelList(\'filtroDestinatarios\')" class="form-control filtro-envio-doc" type="text" name="filtro-envio-doc" placeholder="Pesquisar" />';
    html +=       '<div id="envioDocListaDestinatarios" class="envio-doc-lista">';
    html +=         '<div class="alert alert-warning">Carregando destinatários...</div>';
    html +=       '</div>';
    html +=     '</div>';
    html +=   '</div>';
    html += '</div>';

    $("#envioDocModal").html(html);

    envioDocs.getDestinatariosByDocumento(doe.documento.id, function(envios) {
      var html = "";

      for (var i = 0; i < envios.length; i++) {
        if (envios[i].retorno.id !== undefined)
          html += '<div class="envio-doc clickable" onclick="viewRetornoRecebido(' + envios[i].retorno.id + ')">';
        else
          html += '<div class="envio-doc">';

        html +=   '<div class="envio-doc-header">';
        html +=     '<span name="nome_destinatario" class="envio-doc-title">';

        if (envios[i].visto)
          html += envios[i].destinatario.nome
        else
          html +=     '<strong>' + envios[i].destinatario.nome + '</strong>';

        html +=     '</span>';
        html +=   '</div>';
        html +=   '<div class="envio-doc-label">';
        html +=     '<div class="envio-doc-icones">';

        if (envios[i].retorno) {
          if (envios[i].retorno.id != undefined) {
            if (envios[i].retorno.documento.descricao) {
              // Retorno possui comentário (campo 'doc_descricao' no banco)
              html +=       '<span class="glyphicon glyphicon-comment">';
              html +=         '<span class="icon-label">Este retorno possui comentário</span>';
              html +=       '</span>';
            }

            if (!envios[i].retorno.rejeitado) {
              // Retorno recebido e não rejeitado (pelo menos ainda)
              html +=       '<span class="glyphicon glyphicon-ok-circle text-success">';
              html +=         '<span class="icon-label text-success">Retorno recebido</span>';
              html +=       '</span>';
            } else {
              // Retorno rejeitado e, portanto, pendente
              html +=      '<span class="glyphicon glyphicon-exclamation-sign text-danger">';
              html +=        '<span class="icon-label text-danger">Retorno rejeitado</span>';
              html +=      '</span>';
              html +=       '<span class="glyphicon glyphicon-record">';
              html +=         '<span class="icon-label">Retorno pendente</span>';
              html +=       '</span>';
            }
          } else {
            html +=       '<span class="glyphicon glyphicon-record">';
            html +=         '<span class="icon-label">Retorno pendente</span>';
            html +=       '</span>';
          }
        }

        html +=     '</div>';
        html +=   '</div>';
        html += '</div>';
      }

      $("#envioDocListaDestinatarios").html(html);
      $("#envioDocListaDestinatarios").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
          enable: true
        }
      });
    });
  });
}

function showFormNovoRetorno(idenvio) {
  var html = "";

  html+= '<div class="envio-doc-content">';
  html+=   '<div class="envio-doc-modal-header">';
  html+=     '<h2>Retorno de documento</h2>';
  html+=   '</div>';
  html+=   '<div class="envio-doc-modal-body">';
  html+=     '<form id="formNovoDoc" method="post" enctype="multipart/form-data">';
  html+=       '<fieldset>';
  html+=         '<legend>Cadastro de documento</legend>';
  html+=         '<div class="formfield">';
  html+=           '<label>Assunto</label>';
  html+=           '<span>';
  html+=             '<input id="docAssunto" name="assunto" value="Caregando..." type="text" maxlength="100" placeholder="Digite o assunto do documento" readonly="readonly"/>';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="formfield">';
  html+=           '<label>Descrição</label>';
  html+=           '<span>';
  html+=             '<textarea id="docDescricao" name="descricao" class="obrigatorio" type="text" maxlength="500" placeholder="Digite a descrição do documento (opcional)"></textarea>';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="formfield">';
  html+=           '<label for="">Arquivo</label>';
  html+=           '<span>';
  html+=             '<span>';
  html+=               '<input name="doc_arquivo" type="file" id="docArquivo">';
  html+=             '</span>';
  html+=             '<div>';
  html+=               '<label class="file" for="docArquivo">';
  html+=                 '<input type="button" onclick="$(\'#docArquivo\').trigger(\'click\')" value="Selecionar arquivo" />';
  html+=                 '<span data-for="file_arquivo">Selecione um arquivo</span>';
  html+=               '</label>';
  html+=             '</div>';
  html+=           '</span>';
  html+=         '</div>';
  html+=         '<div class="formbtns">';
  html+=           '<button id="submitNovoDocEnvio" type="button" class="btn btn-primary" onclick="validarFormNovoRetorno()" disabled="disabled" >Enviar</button>';
  html+=         '</div>';
  html+=       '</fieldset>';
  html+=     '</form>';
  html+=     '<div class="hidden">';
  html+=       '<form id="docForm" action="ajax/DocumentosAjax.php" method="POST" enctype="multipart/form-data">';
  html+=         '<input type="hidden" name="acao" value="postDocumento" />';
  html+=         '<input type="hidden" name="assunto" value="" />';
  html+=         '<input type="hidden" name="descricao" value="" />';
  html+=       '</form>';
  html+=       '<form id="retornoDocForm" action="ajax/DocumentosAjax.php" method="POST">';
  html+=         '<input type="hidden" name="acao" value="postRetorno" >';
  html+=         '<input type="hidden" name="documento" value="" />';
  html+=         '<input type="hidden" name="remetente" value="' + usuario.escola + '" />';
  html+=         '<input type="hidden" name="envio" value="' + idenvio + '" />';
  html+=       '</form>';
  html+=     '</div>';
  html+=   '</div>';
  html+= '</div>';

  $("#envioDocModal").html(html);

  envioDocs.getDocumentoByEnvio(idenvio, function(doc) {
    $("#submitNovoDocEnvio").removeAttr("disabled");
    $("#docAssunto").val("RE: " + doc.assunto);
  });
}

function validarFormNovoRetorno() {
  var valido = true;
  $("#submitNovoDocEnvio").attr("disabled", "disabled");
  $("#submitNovoDocEnvio").text("Aguarde...");

  // Verifica se o arquivo está vazio
  if ($("#docArquivo")[0].files.length == 0) {
    $("#docArquivo").parent().parent().addClass("input_faltando");
    valido = false;
  } else {
    $("#docArquivo").parent().parent().removeClass("input_faltando");
  }

  if (valido) {
    var form = document.getElementById("docForm");
    var docArquivo = $("#docArquivo")[0].files[0];
    var formData;

    $(form).find("input[name='assunto']").val($("#docAssunto").val());
    $(form).find("input[name='descricao']").val($("#docDescricao").val());

    formData = new FormData(form);
    formData.append("arquivo", docArquivo);

    envioDocs.postDoc(formData, function(doc) {
      $("#retornoDocForm").find("input[name='documento']").val(parseInt(doc));

      envioDocs.postRetorno($("#retornoDocForm").serialize(), function(dor) {
        viewRetorno(parseInt(dor));
        viewDocumentosRecebidos();
      });
    });
  }
}

function viewRetorno(id) {
  $("#envioDocModal").html("Carregando...");

  envioDocs.getRetorno(id, function(dor) {
    var html = "";

    html += '<div class="envio-doc-modal-content">';
    html +=   '<div class="envio-doc-modal-header">';
    html +=     '<h2>Retorno enviado</h2>';
    html +=   '</div>';
    html +=   '<div class="envio-doc-modal-body">';
    html +=     '<h3 name="assunto_documento">' + dor.documento.assunto + '</h3>';
    html +=     '<h6>Enviado em <span name="data_envio">' + dor.data + '</span></h6>';
    html +=     '<h5>Comentário</h5>';
    html +=     '<p name="descricao_documento">';
    html +=       dor.documento.descricao;
    html +=     '</p>';
    html +=     '<p name="download_documento">';
    html +=       '<span class="glyphicon glyphicon-download-alt"></span>';
    html +=       '<a href="' + dor.documento.arquivo + '" target="_blank">Download do documento</a>';
    html +=     '</p>';
    html +=     '<p>';
    html +=       '<span class="glyphicon glyphicon-arrow-left"></span>';
    html +=       '<span class="link" onclick="verEnvioRecebido(' + dor.envio.id + ')">Voltar</span>';
    html +=     '</p>';
    html +=   '</div>';
    html += '</div>';

    $("#envioDocModal").html(html);
  });
}

function getRetornoEnvioDoc(id) {
  $("#envioDocModal").html("Carregando...");

  envioDocs.getRetorno(id, function(dor) {
    var html = "";

    html += '<div class="envio-doc-modal-content">';
    html +=   '<div class="envio-doc-modal-header">';
    html +=     '<h2>Retorno enviado</h2>';
    html +=   '</div>';
    html +=   '<div class="envio-doc-modal-body">';
    html +=     '<h3 name="assunto_documento">' + dor.documento.assunto + '</h3>';
    html +=     '<h6>Enviado em <span name="data_envio">' + dor.data + '</span></h6>';
    html +=     '<h5>Comentário</h5>';
    html +=     '<p name="descricao_documento">';
    html +=       dor.documento.descricao;
    html +=     '</p>';
    html +=     '<p name="download_documento">';
    html +=       '<span class="glyphicon glyphicon-download-alt"></span>';
    html +=       '<a href="'+dor.documento.arquivo+'">Download do documento</a>';
    html +=     '</p>';
    html +=     '<p>';
    html +=       '<span class="glyphicon glyphicon-arrow-left"></span>';
    html +=       '<span class="link" onclick="viewEnvioDocumento(\'' + dor.envio.documento + '\')">Voltar</span>';
    html +=     '</p>';
    html +=   '</div>';
    html += '</div>';

    $("#envioDocModal").html(html);
  });
}

function viewRetornoRecebido(id) {
  $("#envioDocModal").html("Carregando...");

  envioDocs.getRetorno(id, function(dor) {
    envioDocs.setRetornoVisto(dor.id);
    var html = "";

    html += '<div class="envio-doc-modal-content">';
    html +=   '<div class="envio-doc-modal-header">';
    html +=     '<h2>Retorno recebido</h2>';
    html +=   '</div>';
    html +=   '<div class="envio-doc-modal-body">';
    html +=     '<h3 name="assunto_documento">' + dor.documento.assunto + '</h3>';
    html +=     '<h6>Recebido em <span name="data_envio">' + dor.data + '</span> de <span> ' + dor.remetente.nome + ' </span></h6>';
    html +=     '<h5>Comentário</h5>';
    html +=     '<p name="descricao_documento">';
    html +=       dor.documento.descricao;
    html +=     '</p>';
    html +=     '<p name="download_documento">';
    html +=       '<span class="glyphicon glyphicon-download-alt"></span>';
    html +=       '<a href="' + dor.documento.arquivo + '" target="_blank">Download do documento</a>';
    html +=     '</p>';
    html +=     '<p>';
    html +=       '<span class="glyphicon glyphicon-arrow-left"></span>';
    html +=       '<span class="link" onclick="viewEnvioDocumento(' + dor.envio.documento + ')">Voltar</span>';
    html +=     '</p>';
    html +=   '</div>';
    html += '</div>';

    $("#envioDocModal").html(html);
  });
}















