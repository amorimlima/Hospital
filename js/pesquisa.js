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
            abrirModal("modalDocsUpload");
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
    $("#inputDocUpload").change(function() {
        updateFileUploadView(this);
    });
}

function enviarFormulario() {
    var form = $("#pesquisa_escola").serialize();

    $.ajax({
        url: "ajax/EscolaJSONAjax.php",
        type: "POST",
        dataType: "json",
        data: "acao=novoPreCadastro&"+form,
        beforeSend: function() {
            $("#enviar_pesquisa_escola").prop("disabled",true);
            $("#limpar_pesquisa_escola").prop("disabled",true);
            $("#enviar_pesquisa_escola").val("Aguarde...");
        },
        success: function(d) {
            console.log(d);
            uploadDocumentoPreCadastro(d.idesj);
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

// Documentos para pré-cadastro
function abrirModal(idmodal) {
    var modal = document.getElementById(idmodal);
    var bg = document.getElementById("modalDocsBg");

    bg.classList.remove("hidden");
    bg.classList.remove("fade-out");
    bg.classList.add("fade-in");
    modal.classList.remove("hidden");
    modal.classList.remove("modal-doc-out");
    modal.classList.add("modal-doc-in");
}

function fecharModal(idmodal) {
    var modal = document.getElementById(idmodal);
    var bg = document.getElementById("modalDocsBg");

    bg.classList.remove("fade-in");
    bg.classList.add("fade-out");
    modal.classList.remove("modal-doc-in");
    modal.classList.add("modal-doc-out");

    bg.addEventListener("webkitAnimationEnd",
        function(evt) {
            toggleVisibility(this);
            toggleVisibility(modal);
    });
    bg.addEventListener("animationend",
        function(evt) {
            toggleVisibility(this);
            toggleVisibility(modal);
    });
}

function verificarArquivo() {
    fecharModal('modalDocsUpload');
}

function toggleVisibility(element) {
    if (window.getComputedStyle(element).opacity == "0") {
        element.classList.remove("visible");
        element.classList.add("hidden");
    }
}

function hasFile(input) {
    if (input.files.length > 0)
        return true;
    else
        return false;
}

function updateFileUploadView(input) {
    var fileName = document.getElementById("fileName");
    var getFileTrigger = document.getElementById("getFileTrigger");
    var btnFinalizar = document.getElementById("btnFinalizar");

    if(hasFile(input)) {
        fileName.classList.remove("hidden");

        if (input.files[0].type == "application/msword" ||
            input.files[0].type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
            fileName.innerText = input.files[0].name;
            fileName.classList.add("text-success");
            fileName.classList.remove("text-danger");
            getFileTrigger.innerText = "Alterar arquivo";
            btnFinalizar.disabled = false;
        } else {
            fileName.innerText = "Formato de arquivo inválido.";
            fileName.classList.remove("text-success");
            fileName.classList.add("text-danger");
            getFileTrigger.innerText = "Clique aqui para inserir o arquivo";
            btnFinalizar.disabled = true;
        }
    } else {
        fileName.innerText = "{{Arquivo}}";
        fileName.classList.add("hidden");
        getFileTrigger.innerText = "Clique aqui para inserir o arquivo";
        btnFinalizar.disabled = true;
    }
}

function uploadDocumentoPreCadastro(idesj) {
    var inputDocUpload = document.getElementById("inputDocUpload");
    var file = inputDocUpload.files[0];

    var formData = new FormData();
    formData.append("acao", "uploadArquivoPreCadastro");
    formData.append("arquivo", file);
    formData.append("idesj", idesj);
    
    $.ajax({
        url         : "ajax/EscolaJSONAjax.php",
        type        : "POST",
        dataType    : "json",
        contentType : "multipart/form-data",
        data        : formData,
        processData : false,
        success     : function(d) {
            console.log(d);
            $("#mensagemPesquisaSalvaComSucesso").fadeIn(200);
        },
        error       : function(error) {
            console.error(error.textStatus + "///" + error.errorThrown);
        }
    });
}



















