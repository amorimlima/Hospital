"use strict";

function Formulario(attr) {
    var self = this;
    
    this.idFormulario = attr.idFormulario;
    this.idInputFile = attr.idInputFile;
    this.idBtnEnviar = attr.idBtnEnviar;
    this.idBtnCancelar = attr.idBtnCancelar
    this.aoValidar = attr.aoValidar ? attr.aoValidar : function () {return false;}; 
    
    this.aplicarMascaras = function () {
        $("#" + this.idFormulario).find(".cep").mask("99999-999");
        $("#" + this.idFormulario).find(".tel").mask("(99) 9999-9999");
        $("#" + this.idFormulario).find(".cel").mask("(99) 99999-9999");
        $("#" + this.idFormulario).find(".cpf").mask("999.999.999-99");
        $("#" + this.idFormulario).find(".cnpj").mask("99.999.999/9999-99");
        $("#" + this.idFormulario).find(".data").mask("99/99/9999");
    }

    this.alterarArquivoSelecionado = function (button) {
        var inputId = $(button).attr("data-for");

        $("#" + this.idFormulario).trigger("click");
        $("#" + this.idFormulario).filter("span[data-for='" + this.idInputFile + "']")
        $("span").filter("[data-for='" + inputId + "']").html("Selecione um arquivo");
    }

    this.alterarNomeArquivo = function () {
        var file = document.getElementById(self.idInputFile).files[0];

        if (file !== undefined)
            $("#" + self.idFormulario).find("span").filter("[data-for='" + self.idInputFile + "']").html(file.name);
        else
            $("#" + self.idFormulario).find("span").filter("[data-for='" + self.idInputFile + "']").html("Selecione um arquivo");
    }

    this.validar = function () {
        var statusForm = 0;

        $("#" + self.idFormulario).find("input:text").each(function() {
            if ($(this).val() === "") {
                $(this).addClass("input_faltando");
                statusForm = 1;
            } else {
                $(this).removeClass("input_faltando");
            }
        });

        $("#" + self.idFormulario).find("select").each(function() {
            if ($(this).find(":selected").val() === "0" || $(this).find(":selected").val() === "") {
                $(this).addClass("input_faltando");
                statusForm = 1;
            } else {
                $(this).removeClass("input_faltando");
            }
        });
        
        $("#" + self.idFormulario).find("textarea").each(function() {
            if ($(this).val() === "") {
                $(this).addClass("input_faltando");
                statusForm = 1;
            } else {
                $(this).removeClass("input_faltando");
            }
        });

        if (statusForm === 0) {
            console.info("Formulário válido");
        } else {
            console.info("Formulário inválido");
            
            $("#" + self.idFormulario).find($(".input_faltando").get(0)).focus();
            return false;
        }
    }
    
    this.iniciar = function() {
        $("#" + this.idBtnEnviar).click(this.validar);
    }
}