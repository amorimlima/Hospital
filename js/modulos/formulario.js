"use strict";

function Formulario(formId, idInputFile) {
	this.id = formId;
	this.idInputFile = idInputFile;
}

Formulario.prototype.aplicarMascaras = function () {
	$("#" + this.id).find(".cep").mask("99999-999");
	$("#" + this.id).find(".tel").mask("(99) 9999-9999");
	$("#" + this.id).find(".cel").mask("(99) 99999-9999");
	$("#" + this.id).find(".cpf").mask("999.999.999-99");
	$("#" + this.id).find(".cnpj").mask("99.999.999/9999-99")
	$("#" + this.id).find(".data").mask("99/99/9999");
}

Formulario.prototype.alterarArquivoSelecionado = function (button) {
	var inputId = $(button).attr("data-for");

	$("#" + inputId).trigger("click");
	$("span").filter("[data-for='" + inputId + "']").html("Selecione um arquivo");
}

Formulario.prototype.alterarNomeArquivo = function (input) {
	var file = input.files[0];
	var inputId = input.id;

	if (file !== undefined)
		$("#" + self.id).find("span").filter("[data-for='" + inputId + "']").html(file.name);
	else
		$("#" + self.id).find("span").filter("[data-for='" + inputId + "']").html("Selecione um arquivo");
}

Formulario.prototype.validar = function () {
	var statusForm = 0;
	var formId = this.getAttribute("data-form");
	var textInputs = $("#"+formId).find("input:text");
	var comboboxes = $("#"+formId).find("select");
	console.log(comboboxes)

	for (var a = 0; a < textInputs.length; a++) {
		if ($($(textInputs).get(a)).val() === "") {
			$($(textInputs).get(a)).addClass("input_faltando");
			statusForm = 1;
		} else {
			$($(textInputs).get(a)).removeClass("input_faltando");
		}
	}

	for (var b = 0; b < comboboxes.length; b++) {
		if ($($(comboboxes).get(b)).find(":selected").val() == "0" || $($(comboboxes).get(b)).find(":selected").val() == "") {
			$($(comboboxes).get(b)).addClass("input_faltando");
			statusForm = 1;
		} else {
			$($(comboboxes).get(b)).removeClass("input_faltando");
		}
	}

}