$(document).ready(function (e) {
    //Barra de rolagem personalizada
    $("#box_alunos_container").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: true
        }
    });
    $("#box_questoes_pendentes_container").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: true
        }
    });

    $("#txt_pesquisa_input").keyup(function () {
        var texto = $(this).val().toUpperCase();

        $('.questaoTexto').each(function () {
            if ($(this).html().toUpperCase().indexOf(texto) == -1) {
                $(this).parent().parent().parent().css('display', 'none');
            } else {
                $(this).parent().parent().parent().css('display', 'block');
            }
        });

        colorirDivs();

        //autoComplete($("#txt_pesquisa_input").val());

    });
    $("#topico").change(verificarForumTopico);
    $(".titulo_box_forum").click(function (e) {
        if ($(this).is("#txt_postagens")) {
            $("#box_alunos_container").show();
            $("#box_questoes_pendentes_container").hide();
        } else {
            $("#box_alunos_container").hide();
            $("#box_questoes_pendentes_container").show();
        }
        $(".titulo_box_forum").removeClass("ativo");
        $(this).addClass("ativo");
    });

    $("#txt_postagens").trigger("click");
    $("[data-action=aceitar]").click(function() {
        var questaoId = this.id.substring(11);
        var topicoId = this.getAttribute("data-topico");
        
        aprovarTopico(questaoId,topicoId);
    });
    
    $("[data-action=rejeitar]").click(function() {
        var questaoId = this.id.substring(12);
        var topicoId = this.getAttribute("data-topico");
        
        rejeitarTopico(questaoId,topicoId);
    });
});


function verificarForumTopico() {
    var campoNovoTopico = "<input type='text' style='opacity: 0' placeholder='Digite o nome do novo tópico' id='box_novoTopico'/>";

    if ($(this).val() == "0")
        $(campoNovoTopico).insertAfter(this).animate({opacity: 1}, 200);
    else
        $("#box_novoTopico").animate({opacity: 0}, 200, function () {
            $(this).remove();
        });
}

function colorirDivs() {
    $('.qtd_visu').removeClass('cx_rosaP cx_brancaP');
    $('.qtd_resp').removeClass('cx_brancaP cx_rosaP');
    $('.perg_box').removeClass('cx_branca cx_rosa');
    cont = 0;

    $('.questaoTexto').each(function () {
        if ($(this).is(':visible')) {
            id = $(this).attr('id');

            if (cont % 2 == 0) {
                $('#qtd_visu' + id).addClass('cx_brancaP');
                $('#qtd_resp' + id).addClass('cx_brancaP');
                $('#perg_box' + id).addClass('cx_rosa');
            } else {
                $('#qtd_visu' + id).addClass('cx_rosaP');
                $('#qtd_resp' + id).addClass('cx_rosaP');
                $('#perg_box' + id).addClass('cx_branca');
            }
            cont++;
        }
    })
}
function enviar() {
    var texto = $("#box_pergunta").val();
    var topico = $("#topico").val();
    var novoTopico;

    if ($("#box_novoTopico"))
        novoTopico = $("#box_novoTopico").val();

    if (topico === "0") {
        if (novoTopico != "" && texto != "") {
            var data = {
                "idtopico": topico,
                "novoTopico": novoTopico,
                "text": texto
            };

            criarNovoTopico(data);
        } else {
            $("#forumErroVazia").find("p.txt_vermelho").html("Preencha todos campos.");
            $("#forumErroVazia").show();
        }
    } else if (parseInt(topico) > 0) {
        if (texto != "") {
            if (topico == null) {
                $("#forumErroTopico").css('display', 'block');
                return false;
            }

            criarNovaQuestao(topico, texto);
        }
    } else {
        $("#forumErroVazia").css('display', 'block');
    }

    return false;
}


function criarNovoTopico(topico) {
    var retorno;

    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "POST",
        dataType: "json",
        data: "acao=novoTopico&topico=" + topico.novoTopico + "&status=" + topico.status,
        success: function (data) {
            retorno = data;
        },
        complete: function () {
            if (retorno.retorno.perfil == 2 || retorno.retorno.perfil == 4)
                $("#topico").append("<option value=" + retorno.retorno.id + ">" + topico.novoTopico + "</option>");
            
            if(retorno.retorno.perfil == 1)
                $("#forumNovoTopicoAluno").fadeIn(200);
            
            criarNovaQuestao(retorno.retorno.id, topico.text, retorno.retorno.perfil);
                
        }
    });
}

function criarNovaQuestao(idtopico, questao, perfil) {
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "post",
        dataType: "html",
        data: {
            "acao": "perguntar",
            "anexo": "",
            "topico": idtopico,
            "txt": questao
        },
        success: function (data) {
            if (perfil == 2 || perfil == 4) {
                $('#box_alunos').prepend(data);
                $("#forumPerguntaSucesso").fadeIn(200);
            }

            colorirDivs();
            $("#box_pergunta").val("");
            $("#box_novoTopico").val("");
            $("#topico option").eq(0).attr('selected', 'selected');
        }
    });
}

function aprovarTopico(idquestao,idtopico) {
    var retorno;
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "POST",
        dataType: "json",
        data: "acao=aprovarTopico&id_topico="+idtopico,
        beforeSend: function() {
            $("#btn_aceitar"+idquestao).text("Aguarde...");
            $("#btn_aceitar"+idquestao).attr("disabled", "disabled");
            $("#btn_rejeitar"+idquestao).attr("disabled", "disabeld");
        },
        success: function(data) {
            $("#forumTopicoAprovado").fadeIn(200);
            retorno = data.retorno;
        },
        complete: function() {
            verificarQtdeTopicosPendentes();
            updateListaQuestoesTopicoAprovado(idtopico);
            getTopicoListagem(idtopico);
            listarQuestoesTopicoAprovado(idquestao, idtopico);
        }
    });
}

function getTopicoListagem(idtopico) {
    var retorno;
    
    function incluirTopicoListagem(topico) {
        var htmlTopico = "<option value=\""+topico.id+"\">"+topico.topico+"</option>";
        $("#topico").append(htmlTopico);
    }
    
    $.ajax({
       url: "ajax/ForumAjax.php",
       type: "GET",
       dataType: "json",
       data: "acao=selectTopicoAprovado&idtopico="+idtopico,
       success: function(data) {
           retorno = data;
       },
       complete: function() {
            if (!retorno.erro)
                incluirTopicoListagem(retorno.retorno);
       }
    });
}

function updateListaQuestoesTopicoAprovado(idtopico) {
    var questoesDOM = document.querySelectorAll("[data-topico='"+idtopico+"']");
    var questoesGet;
    
    function incluirQuestaoListagemRecentes(questoes) {
        var htmlQuestoes = new String();
        
        $(questoes).each(function() {
            htmlQuestoes += "<a href=\"forumResposta.php?resp="+this.id+"\" id=\"caixaQuestao"+this.id+"\"><div id=\"perg_box"+this.id+"\" class=\"perg_box row\">";
            htmlQuestoes +=     "<div class=\"perg_box_1 col-xs-12 col-md-7 col-lg-7\">";
            htmlQuestoes +=         "<p class=\"foto_aluno\"><img src=\"imgp/"+this.usuario.imagem+"\"></p>";
            htmlQuestoes +=         "<p class=\"perg_aluno questaoTexto\" id=\""+this.id+"\">"+this.questao+"</p>";
            htmlQuestoes +=         "<p class=\"nome_aluno\">"+this.usuario.nome+"</p>";
            htmlQuestoes +=         "<p class=\"post_data\">Tópico: "+this.topico.topico+" | Postado dia "+this.data+"</p>";
            htmlQuestoes +=     "</div>";
            htmlQuestoes +=     "<div class=\"perg_box_2 col-xs-12 col-md-5 col-lg-5\">";
            htmlQuestoes +=         "<p id=\"qtd_visu"+this.id+"\" class=\"qtd_visu\"><span>0</span> visualizações</p>";
            htmlQuestoes +=         "<p id=\"qtd_resp"+this.id+"\" class=\"qtd_resp\"><span>0</span> respostas</p>";
            htmlQuestoes +=     "</div>";
            htmlQuestoes += "</div></a>";
        });
        
        $("#box_alunos").prepend(htmlQuestoes);
    };
    
    $(questoesDOM).each(function(){
        $(this).parentsUntil("#box_questoes_pendentes").animate({
            opacity: 0
        }, 200,
        function() {
            $(this).remove();
        });
    });
    
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "GET",
        dataType: "json",
        data: "acao=selectQuestoesByTopico&idtopico="+idtopico,
        success: function(data) {
            questoesGet = data;
        },
        complete: function() {
            if (questoesGet)
                incluirQuestaoListagemRecentes(questoesGet.retorno);
            else
                $("#forumErroRetornarQuestao").fadeIn(200);
        }
    });
}

function rejeitarTopico(idquestao, idtopico) {
    var htmlFormJustificativa  = "<div id=\"justificativa"+idtopico+"\" class=\"form_justificativa_container col-xs-12\">";
        htmlFormJustificativa +=    "<textarea id=\"txtJustificativa"+idtopico+"\" name=\"mensagem\" class=\"input input-block input-noresize\" placeholder=\"Digite o porquê de estar rejeitando este tópico\" style=\"height:0;\">";
        htmlFormJustificativa +=    "</textarea>";
        htmlFormJustificativa +=    "<div class=\"btns_container\">";
        htmlFormJustificativa +=        "<button type=\"button\" class=\"btn\" data-action=\"cancelar\" data-questao=\""+idquestao+"\" data-topico=\""+idtopico+"\">Cancelar</button>";
        htmlFormJustificativa +=        "<button type=\"button\" class=\"btn btn-primary\" data-action=\"confirmar\" data-questao=\""+idquestao+"\" data-topico=\""+idtopico+"\">Confirmar</button>";
        htmlFormJustificativa +=    "</div>";
        htmlFormJustificativa += "</div>";
    
    $("#btn_aceitar"+idquestao).attr("disabled","disabled");
    $("#btn_rejeitar"+idquestao).attr("disabled","disabled");
    
    $("#box_questao"+idquestao).find(".row").append(htmlFormJustificativa);
    $("#justificativa"+idtopico).find("textarea").animate({height: "90px"}, 200);
    
    $("[data-action='confirmar']").click(function() {
        var idtopico = this.getAttribute("data-topico");
        var txtJustificativa = $("#txtJustificativa"+idtopico).val();
        
        vaildarJustificativaRejeicao(idtopico, txtJustificativa);
    });
    
    $("[data-action='cancelar']").click(function() {
        var idtopico = this.getAttribute("data-topico");
        
        $("#justificativa"+idtopico).animate({height: 0}, 200,
            function() {
                $(this).remove();
                $("[data-action=aceitar]").filter("[data-topico='"+idtopico+"']").removeAttr("disabled");
                $("[data-action=rejeitar]").filter("[data-topico='"+idtopico+"']").removeAttr("disabled");
            }
        );
    });
    
    $("#txtJustificativa"+idtopico).keyup(function() {
        $(this).removeClass("input-missing");
        $("#txtJustificativa"+idtopico).attr("placeholder", "Digite o porquê de estar rejeitando este tópico");
        
    });
    
}

function vaildarJustificativaRejeicao(idtopico, justificativa) {
    if (idtopico) {
        if (justificativa) {
            confirmarJustificativaRejeicao(idtopico,justificativa);
        } else {
            $("#txtJustificativa"+idtopico).addClass("input-missing");
            $("#txtJustificativa"+idtopico).attr("placeholder", "Este campo é obrigatório");
        }
    } else {
        $("#forumErroGenerico").fadeIn(200);
    }
}

function confirmarJustificativaRejeicao(idtopico,justificativa) {
    function deletarTopico() {
        $.ajax({
            url: "ajax/ForumAjax.php",
            type: "POST",
            dataType: "json",
            data: "acao=rejeitarTopico&idtopico="+idtopico,
            beforeSend: function() {
                $("#txtJustificativa"+idtopico).attr("disabled", "disabled");
                $("[data-action=cancelar]").filter("[data-topico="+idtopico+"]").attr("disabled", "disabled");
                $("[data-action=confirmar]").filter("[data-topico="+idtopico+"]").attr("disabled", "disabled");
                $("[data-action=confirmar]").filter("[data-topico="+idtopico+"]").html("Aguarde...");
            },
            success: function(data) {
                if (data.topico.id && data.questao.autor) {
                    enviarJustificativaRejeicao(data.topico, data.questao);
                }
            },
            error: function() {
                console.error("Erro ao deletar tópico");
            }
        });
    }
    
    function enviarJustificativaRejeicao(topico,questao) {
        var assunto = "Seu tópico \""+topico.topico+"\" foi rejeitado.";
        var mensagem  = "Olá, "+questao.autor.nome.split(" ")[0]+".\n";
            mensagem += "Seu tópico \""+topico.topico+"\" foi rejeitado, ";
            mensagem += "e sua questão \""+questao.questao+"\" apagada. \n\n";
            mensagem += "Justificativa: \n"+justificativa;
        
        $.ajax({
            url: "ajax/MensagemAjax.php",
            type: "POST",
            dataType: "json",
            data: "acao=inserirMensagem&destinatarios="+questao.autor.id+"&assunto="+assunto+"&mensagem="+mensagem,
            success: function() {
                $("#forumRejeicaoJustificada").fadeIn(200);
            },
            error: function() {
                console.error("Erro ao enviar justificativa");
            },
            complete: function() {
                $("#box_questao"+questao.id).animate({opacity: 0}, 200, function() {
                    $(this).remove();
                    verificarQtdeTopicosPendentes();
                });
            }
        });
    }
    
    deletarTopico();
}

function verificarQtdeTopicosPendentes() {
    var topicos = $("#box_questoes_pendentes > div");
    var htmlAlerta = new String();
    
    if (topicos.length === 0) {
        htmlAlerta += "<div id=\"alert_sem_topicos_pendentes\" class=\"alert_container\" style=\"display: none;\">";
        htmlAlerta +=    "<div class=\"alert alert-warning\">Nenhum tópico ou questão pendente de aprovação.</div>";
        htmlAlerta += "</div>";
        
        $("#box_questoes_pendentes").html(htmlAlerta);
        $("#alert_sem_topicos_pendentes").fadeIn(200);
    }
    
    atualizarCountTopicosPendentes(topicos.length);
} 

function atualizarCountTopicosPendentes(count) {
    if (count > 0) {
        $("#countTopicosPendentes").text(count);
    } else {
        $("#countTopicosPendentes").remove();
    }
}