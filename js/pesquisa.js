"use strict";
var pesquisa;
var formulario;

$(document).ready(atribuirEventos);

function atribuirEventos() {
    formulario = new Formulario({
        idFormulario: "formulario_pre_cadastro",
        idInputFile: null,
        idBtnEnviar: "enviar_pre_cadastro",
        idBtnCancelar: "cancel_pre_cadastro",
        aoValidar: function() { alert("Bom"); },
        aoInvalidar: function() { alert("Mal"); }
    });
}