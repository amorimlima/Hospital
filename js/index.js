"use strict";
var estado = "login";
var formulario;

$(document).ready(atribuirEventos);

function atribuirEventos() {
    $("#link_pre_cadastro").click(toggleFormPreCadastro);
    $("#cancel_pre_cadastro").click(toggleFormPreCadastro);

    formulario = new Formulario({
        idFormulario: "formulario_pre_cadastro",
        idBtnEnviar: "enviar_pre_cadastro",
        idBtnCancelar: "cancel_pre_cadastro"
    });

    $("#btLogar").click(validarLogin);
    $("#enviar_pre_cadastro").click(formulario.validar)
    $("input:radio").filter("[name=esc_tipo_escola]").change(mudarTipoEscola);

    /* Barra de rolagem */
    $(".form_barra").mCustomScrollbar({ axis: "y", scrollButtons: { enable:true } });
}

function toggleFormPreCadastro() {
    switch (estado) {
        case "login":
            $("#login").hide();
            $("#form_pre_cadastro").show();

            estado = "cadastro";
        break;
        case "cadastro":
            $("#login").show();
            $("#form_pre_cadastro").hide();

            estado = "login";
        break;
    }
}

function validarLogin() {
    $("#result").html('').removeClass();
    var user = $("#usuario").val();
    var senha = $("#senha").val();

    if (user !== "" && senha !== "") {
        $.ajax({
            url:'auth.php',
            type:'post',
            dataType:'json',
            data:{'usuario':user,'senha':senha},
            success:function(data){
                if(data.erro == true) {
                    alert(data.msg);
                } else {
                    window.location.href=data.url;
                }
            }
        });
    } else {
        alert('Os campos são obrigatórios!');
    }
    return false;
}

function mudarTipoEscola() {
	var radioChecked = $("input:radio").filter("[name=esc_tipo_escola]:checked");
	var tipoEscolaHtml = new String();

	if ($(radioChecked).attr("id") === "escola_publica") {
            tipoEscolaHtml += "<option value=\"1\" selected>Municipal</option>";
            tipoEscolaHtml += "<option value=\"2\">Estadual</option>";
            tipoEscolaHtml += "<option value=\"3\">Federal</option>";

            $("#administracao").html(tipoEscolaHtml);
	} else {
            tipoEscolaHtml += "<option value=\"4\" selected>Particular</option>";

            $("#administracao").html(tipoEscolaHtml);
	}
}










