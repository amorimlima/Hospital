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
            alert("Deu ruim");
        }
    });
    formulario.iniciar();

    $("#tipo_outro").change(function () {
        if ($(this).is(":checked"))
            $("#tipo_outro_especificacao").prop('disabled', false);
        else
            $("#tipo_outro_especificacao").prop('disabled', true);
    });

    $("#ideb_nao_sabe").change(function () {
        if ($(this).is(":checked"))
            $("#ideb").prop("disabled", true);
        else
            $("#ideb").prop("disabled", false);
    });

    $("#projetos_anteriores_null").change(function () {
        if ($(this).is(":checked"))
            $("#projetos_anteriores").prop("disabled", true);
        else
            $("#projetos_anteriores").prop("disabled", false);
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
        if ($("#atividades_familia_nao").is(":checked"))
            $("#atividades_familiares").prop("disabled", true);
        else
            $("#atividades_familiares").prop("disabled", false);
    });
}

function enviarFormulario() {
    var form = $("#pesquisa_escola").serialize();    
    window.location.href = "pesquisa_pdf.php?"+form;
}