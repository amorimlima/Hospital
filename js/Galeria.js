$(document).ready(function () {
    $('#select_text').click(function () {
        $('#box_select').toggle();
    });

    $('.selecionado').click(function () {
        var selecionado = $(this).text();
        var id_selecionado = $(this).attr('id');
        $('#select_text').val(selecionado);
        $('#box_select').hide();
    });

    //Barra de rolagem personalizada
    $("#box_left_resultados_container").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: true
        }
    });
    //Barra de rolagem personalizada - box galeria
    $("#box_select").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: true
        }
    });
    $("#botaoCarregar").click(showFormNovoArquivo);

    var formulario = new Formulario({
            idFormulario: "form_arquivo_galeria",
            idInputFile: "file_arquivo",
            idBtnEnviar: "btn_enviar",
            idBtnCancelar: "btn_cancelar",
            aoValidar: postarPreCadastro()
    });
    
    formulario.iniciar();
});

function showFormNovoArquivo() {
    if ($("#form_novo_arquivo").is(":hidden")) {
        $("#form_novo_arquivo").show();
        $("#box_galeria").hide();
    } else {
        $("#form_novo_arquivo").hide();
        $("#box_galeria").show();
    }
}

function postarPreCadastro () {
    
}