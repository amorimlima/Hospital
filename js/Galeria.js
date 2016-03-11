var formulario;
$(document).ready(function () {
    carregarGaleria();
    criarDropDown();
    atribuirBarrasDeRolagem();
    $("#botaoCarregar").click(showFormNovoArquivo);

    formulario = new Formulario({
        idFormulario: "form_arquivo_galeria",
        idInputFile: "file_arquivo",
        idBtnEnviar: "btn_enviar",
        idBtnCancelar: "btn_cancelar",
        aoValidar: function() { postarPreCadastro(); },
        aoCancelar: function() { showFormNovoArquivo(); }
    });
    
    formulario.iniciar();
});

function carregarGaleria () {
    $.ajax({
        url:'ajax/GaleriaAjax.php',
        type:'get',
        data:{
            'acao':'listaMaisRecentes',
        },
        dataType: 'json',
        success:function(galerias)
        {
            console.log(galerias);
            var htmlCentral = '';
            for(var i = 0; i < galerias.length; i++)
            {
                htmlCentral +=  '<div class="gal_caixa">';
                htmlCentral +=      '<div class="gal_dados">';
                htmlCentral +=          '<a href="'+galerias.arquivo+'"><div class="gal_'+galerias.+'_icon"></div></a>';
                htmlCentral +=          '<div gal_categoria>'+/*categoria*/+'</div>';
                htmlCentral +=      '</div>';
                htmlCentral +=      '<div class="gal_caixa_texto">'
                htmlCentral +=          '<a href="'+galerias.arquivo+'"><div class="gal_caixa_texto_titulo">'+galerias.nome+"</div></a>";
                htmlCentral +=          '<div class="gal_caixa_texto_sub">'+galerias.data+"</div>";
                htmlCentral +=          '<div class="gal_caixa_texto_corpo">'+galerias.descricao+"</div>";
                htmlCentral +=      '</div>';
                htmlCentral +=  '</div>';
            }
        }
    });
}

function criarDropDown () {
    //Carregar categorias
    abrirSelectCateoria();
    atribuirClickSelect();
}

function atribuirClickSelect () {
    $('.selecionado').click(function(){
       var selecionado = $(this).text();
       var id_selecionado = $(this).attr('id');
       $('#select_text').val(selecionado);
       $('#box_select').hide();
       //TODO: fazer requisição por itens do tipo selecionado
    });
}

function abrirSelectCateoria () {
    $('#select_text').click(function(){
       $('#box_select').toggle();
    });
}

function atribuirBarrasDeRolagem () {
    atribuirBarraConteudoCentral();
    atribuirBarraMenuCategorias();
}

function atribuirBarraConteudoCentral () {
    $("#box_left_resultados_container").mCustomScrollbar({
        axis:"y",
        scrollButtons:{
            enable:true
        }
    });
}

function atribuirBarraMenuCategorias () {
    $("#box_select").mCustomScrollbar({
        axis:"y",
        scrollButtons:{
          enable:true
        }
    });
}

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
    console.info("Requisição para registro de interesse");
}