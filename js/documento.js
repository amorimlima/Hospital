"use strict";

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
  },
  rejeitarRetorno: function(idretorno, callback) {
    $.ajax({
      url: envioDocs.url,
      type: "POST",
      data: "acao=rejeitarRetorno&idRetorno=" + idretorno,
      error: function(e) {
        console.log(e.errorThrown + " // " + e.txtMessage)
      },
      success: function(data) {
        callback(data);
      }
    });
  }
}

$(document).ready(function() {
  getDadosEnvioDocumentos();
});

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
    $("#formEnvioDocModal").parent().fadeOut(400);
}

function validarFormNovoDocumentoEnvio() {
  var destinatariosValido = false;
  var valido = true;
  $("#submitNovoDocEnvio").attr("disabled", "disabled");
  $("#submitNovoDocEnvio").text("Aguarde...");

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
  } else {
    $("#submitNovoDocEnvio").removeAttr("disabled");
    $("#submitNovoDocEnvio").text("Enviar");
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

  envioDocs.postEnvio($(form).serialize(), function(data) {
    $("#docAssunto").val("");
    $("#docDescricao").val("");
    $("#listaDestinatarios").find("input:checkbox").prop(":checked", false);
    $("#submitNovoDocEnvio").removeAttr("disabled");
    $("#submitNovoDocEnvio").text("Enviar");
    //closeFormNovoEnvioDocModal()
  });
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

        if (!data[i].verificadores.retornos_nao_vistos)
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
    console.log(data);
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
          html += '<div class="envio-doc clickable" onclick="viewRetorno(' + retornos[i].id + ')">';
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
    html +=       '<span class="glyphicon glyphicon-remove-circle text-danger"></span>';
    html +=       '<span class="link text-danger" onclick="rejeitarRetorno(this, ' + dor.id + ', ' + dor.envio.id + ')">Rejeitar retorno</span>'
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

function rejeitarRetorno(span, id, envio) {
  span.innerText = "Aguarde...";
  span.classList.add("click-desativado");

  envioDocs.rejeitarRetorno(id, function(data) {
    viewEnvioDocumento(envio);
  })
}






























