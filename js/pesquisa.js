"use strict";
var pesquisa;
var formulario;

$(document).ready(atribuirEventos);

function atribuirEventos() {
    formulario = new Formulario({
        idFormulario: "pesquisa_escola",
        idInputFile: null,
        idBtnEnviar: "enviar_pesquisa_escola",
        idBtnCancelar: null,
        aoValidar: function () {
            enviarFormulario();
        },
        aoInvalidar: function () {
            return;
        }
    });
    formulario.iniciar();

    $("#tipo_outro").change(function () {
        if ($(this).is(":checked")) {
            $("#tipo_outro_especificacao").prop('disabled', false);
            $("#ideb").removeClass("obrigatorio");
        } else {
            $("#tipo_outro_especificacao").prop('disabled', true);
            $("#ideb").addClass("obrigatorio");
        }
    });

    $("#ideb_nao_sabe").change(function () {
        if ($(this).is(":checked")) {
            $("#ideb").prop("disabled", true);
            $("#ideb").removeClass("obrigatorio");
        } else {
            $("#ideb").prop("disabled", false);
            $("#ideb").addClass("obrigatorio");
        }
    });

    $("#projetos_anteriores_null").change(function () {
        if ($(this).is(":checked")) {
            $("#projetos_anteriores").prop("disabled", true);
            $("#ideb").removeClass("obrigatorio");
        } else {
            $("#projetos_anteriores").prop("disabled", false);
            $("#ideb").addClass("obrigatorio");
        }
    });

    $("input[name=sala_info]").change(function () {
        if ($("#sala_info_nao").is(":checked")) {
            $("#acesso_internet_nao").prop("disabled", true);
            $("#acesso_internet_sim").prop("disabled", true);
            $("#acesso_internet_nao").prop("checked", false);
            $("#acesso_internet_sim").prop("checked", false);
        } else {
            $("#acesso_internet_nao").prop("disabled", false);
            $("#acesso_internet_sim").prop("disabled", false);
        }
    });
    $("input[name=atividades_familia]").change(function () {
        if ($("#atividades_familia_nao").is(":checked")) {
            $("#atividades_familiares").prop("disabled", true);
            $("#ideb").removeClass("obrigatorio");
        } else {
            $("#atividades_familiares").prop("disabled", false);
            $("#ideb").addClass("obrigatorio");
        }
    });

    $(".botao_modal").click(voltarParaPaginaLogin);
}

function enviarFormulario() {
    var form = $("#pesquisa_escola").serialize();

    $.ajax({
        url: "geradorJSON.php",
        type: "POST",
        dataType: "json",
        data: form,
        beforeSend: function() {
            $("#enviar_pesquisa_escola").prop("disabled",true);
            $("#limpar_pesquisa_escola").prop("disabled",true);
            $("#enviar_pesquisa_escola").val("Aguarde...");
        },
        success: function(d) {
            $("#mensagemPesquisaSalvaComSucesso").fadeIn(200);
            console.log(d);
        },
        error: function() {
            $("#mensagemErroAoEnviarPesquisa").fadeIn(200);
        },
        complete: function() {
            $("#enviar_pesquisa_escola").prop("disabled",false);
            $("#limpar_pesquisa_escola").prop("disabled",false);
            $("#limpar_pesquisa_escola").trigger("click");
        }
    });
}

function voltarParaPaginaLogin() {
    window.location.href = "index.php";
}