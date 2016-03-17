var formulario;
$(document).ready(function () {
    criarDropDown();
    atribuirBarrasDeRolagem();
    atribuirPesquisa();
    criarFormulario();   
    formulario.iniciar();
    carregarGaleria();
    carregarMaisVistos();
    $('body').click(function() {
        $('#box_select').hide();
    });
    $('.botao_modal').click(function(){
        hideModal();
    });
});

function carregarGaleria () {
    $.ajax({
        url: "ajax/GaleriaAjax.php",
        type: "GET",
        data: {"acao":"listaMaisRecentes"},
        dataType: "json",
        success:function(galerias) {
            var htmlCentral = '';
            for(var i = 0; i < galerias.length; i++)
            {
                var date = new Date(galerias[i].data);
                var dataPostagem = date.toLocaleDateString()+" "+ date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'})
                htmlCentral +=  '<div class="gal_caixa">';
                htmlCentral +=      '<div class="gal_dados">';
                htmlCentral +=          '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" href="'+galerias[i].arquivo+'"><div class="gal_'+galerias[i].categoria.classe+'_icon"></div></a>';
                htmlCentral +=          '<div class="gal_categoria">'+galerias[i].categoria.categoria+'</div>';
                htmlCentral +=      '</div>';
                htmlCentral +=      '<div class="gal_caixa_texto">'
                htmlCentral +=          '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><div class="gal_caixa_texto_titulo">'+galerias[i].nome+"</div></a>";
                htmlCentral +=          '<div class="gal_caixa_texto_sub">'+ dataPostagem +"</div>";
                htmlCentral +=          '<div class="gal_caixa_texto_corpo">'+galerias[i].descricao+"</div>";
                htmlCentral +=      '</div>';
                htmlCentral +=  '</div>';
            }
            if(htmlCentral == '')
                    htmlCentral = '<div class="alert alert-warning" style="margin: 0 20px;">Nenhum item cadastrado.</div>';
                $('#mCSB_1_container').html(htmlCentral);
        },
        error: function(error) {
            console.error("Erro: \n" + error.responseText);
        }
    });
}

function criarDropDown () {
    carregarCategorias();
    abrirSelectCateoria();
}

function atribuirClickSelect () {
    $('.opcoesCategorias').click(function(){
        $('#select_text').html($(this).html());
        $('#box_select').hide();
        $.ajax({
            url: "ajax/GaleriaAjax.php",
            type: "GET",
            data: { "acao":"listaCategorias",
                    "categoria": $(this)[0].id.split("_")[1]},
            dataType: "json",
            success:function(galerias) {
                var htmlCentral = '';
                for(var i = 0; i < galerias.length; i++)
                {
                    htmlCentral +=  '<div class="gal_caixa">';
                    htmlCentral +=      '<div class="gal_dados">';
                    htmlCentral +=          '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><div class="gal_'+galerias[i].categoria.classe+'_icon"></div></a>';
                    htmlCentral +=          '<div class="gal_categoria">'+galerias[i].categoria.categoria+'</div>';
                    htmlCentral +=      '</div>';
                    htmlCentral +=      '<div class="gal_caixa_texto">'
                    htmlCentral +=          '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><div class="gal_caixa_texto_titulo">'+galerias[i].nome+"</div></a>";
                    htmlCentral +=          '<div class="gal_caixa_texto_sub">'+galerias[i].data+"</div>";
                    htmlCentral +=          '<div class="gal_caixa_texto_corpo">'+galerias[i].descricao+"</div>";
                    htmlCentral +=      '</div>';
                    htmlCentral +=  '</div>';
                }
                if(htmlCentral == '')
                    htmlCentral = '<div class="alert alert-warning" style="margin: 0 20px;">Nenhum item cadastrado.</div>';
                $('#mCSB_1_container').html(htmlCentral);
            },
            error: function(error) {
                console.error("Erro: \n" + error.responseText);
            }
        });
    });
}

function abrirSelectCateoria () {
    $('#select_text').click(function(e){
       $('#box_select').toggle();
       e.stopPropagation();
    });
}

function carregarCategorias () {
    $.ajax({
        url: "ajax/GaleriaAjax.php",
        type: "GET",
        data: {"acao": "listaCategoriasGaleria"},
        dataType: "json",
        success:function(categorias){
            htmlCategorias = "";
            htmlCategoriasRadio = "";
            for(var i = 0; i < categorias.length; i++){
                htmlCategorias += '<span id="cat_'+categorias[i].id+'" class="opcoesCategorias">'+categorias[i].categoria+'</span>'
                htmlCategoriasRadio += '<input type="radio" name="cat_arquivo" value="'+categorias[i].id+'" id="cat_upload_'+categorias[i].id+'"/>';
                htmlCategoriasRadio += '<label for="cat_upload_'+categorias[i].id+'">'+categorias[i].categoria+'</label>';
            }
            $('#mCSB_2_container').html(htmlCategorias);
            $('#categoriaPost').html(htmlCategoriasRadio);
            atribuirClickSelect();
        }, complete: function() {
            trocarCategoriaArquivo();
        }
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

function atribuirPesquisa () {
    var typingTimer; 
    var doneTypingInterval = 1000; 
    $('#assuno_text').on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            $.ajax({
                url: "ajax/GaleriaAjax.php",
                type: "GET",
                data: { "acao":"listaNome",
                        "nome": $('#assuno_text').val()
                    },
                dataType: "json",
                success:function(galerias) {
                    var htmlCentral = '';
                    for(var i = 0; i < galerias.length; i++)
                    {
                        var date = new Date(galerias[i].data);
                        var dataPostagem = date.toLocaleDateString()+" "+ date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
                        htmlCentral +=  '<div class="gal_caixa">';
                        htmlCentral +=      '<div class="gal_dados">';
                        htmlCentral +=          '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><div class="gal_'+galerias[i].categoria.classe+'_icon"></div></a>';
                        htmlCentral +=          '<div class="gal_categoria">'+galerias[i].categoria.categoria+'</div>';
                        htmlCentral +=      '</div>';
                        htmlCentral +=      '<div class="gal_caixa_texto">'
                        htmlCentral +=          '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><div class="gal_caixa_texto_titulo">'+galerias[i].nome+"</div></a>";
                        htmlCentral +=          '<div class="gal_caixa_texto_sub">'+dataPostagem+"</div>";
                        htmlCentral +=          '<div class="gal_caixa_texto_corpo">'+galerias[i].descricao+"</div>";
                        htmlCentral +=      '</div>';
                        htmlCentral +=  '</div>';
                    }
                    if(htmlCentral == '')
                        htmlCentral = '<div class="alert alert-warning" style="margin: 0 20px;">Nenhum item cadastrado.</div>';
                    $('#mCSB_1_container').html(htmlCentral);
                },
                error: function(error) {
                    console.error("Erro: \n" + error.responseText);
                }
            });
        }, doneTypingInterval);
    });

    $('#assuno_text').on('keydown', function () {
        clearTimeout(typingTimer);
    });
}

function carregarMaisVistos () {
    $.ajax({
        url:"ajax/GaleriaAjax.php",
        type:"GET",
        data: {
            acao: "listaMaisVistos"
        },
        dataType: 'json',
        success: function(galerias) {
            htmlMaisVistos = "";
            for (var i = 0; i < galerias.length; i++) {
                var date = new Date(galerias[i].data);
                var dataPostagem = date.toLocaleDateString()+" "+ date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
                htmlMaisVistos +=   '<div class="row">';
                htmlMaisVistos +=       '<div class="mv_caixa">';
                htmlMaisVistos +=           '<div class="mv_caixa_icon">';
                htmlMaisVistos +=               '<div class="mv_'+galerias[i].categoria.classe+'">';
                htmlMaisVistos +=                   '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><div class="icon_'+galerias[i].categoria.classe+'"></div></a>';
                htmlMaisVistos +=                   '<div class="icon_texto">'+galerias[i].categoria.categoria+'</div>';
                htmlMaisVistos +=               '</div>';
                htmlMaisVistos +=           '</div>';
                htmlMaisVistos +=           '<div class="txt_mv_caixa">';
                htmlMaisVistos +=               '<a onclick="contagemVisualizacoes('+galerias[i].id+')" target="_blank" class="linkGaleria" id="gal_'+galerias[i].id+'" href="'+galerias[i].arquivo+'"><p class="txt_mv_caixa_titulo">'+galerias[i].nome+'</p></a>';
                htmlMaisVistos +=               '<p class="txt_mv_caixa_sub">'+galerias[i].descricao+'</p>';
                htmlMaisVistos +=               '<p class="txt_mv_caixa_data">'+dataPostagem+'</p>';
                htmlMaisVistos +=           '</div>';
                htmlMaisVistos +=           '<div class="clear"></div>';
                htmlMaisVistos +=       '</div>';
                htmlMaisVistos +=   '</div>'; 
            };
            if (htmlMaisVistos == '')
                htmlMaisVistos += '<div class="alert alert-warning" style="margin: 0;">Nenhum item cadastrado.</div>';
            $('#container_mv_box').html(htmlMaisVistos);
        }
    });
}

function contagemVisualizacoes (id) {
    var d = null;
    $.ajax({
        url:"ajax/GaleriaAjax.php",
        type:"POST",
        data:{
            'acao' : 'novaVisualizacao',
            'id': id
        },
        success: function(data) {
            d = data;
        }

    });
    console.log(d);
    return d;
};


function criarFormulario () {
    $("#botaoCarregar").click(showFormNovoArquivo);

    if($('#form_arquivo_galeria').length > 0)
    {
       formulario = new Formulario({
            idFormulario: "form_arquivo_galeria",
            idInputFile: "file_arquivo",
            idBtnEnviar: "btn_enviar",
            idBtnCancelar: "btn_cancelar",
            aoValidar: function() { postarPreCadastro(); },
            aoCancelar: function() { showFormNovoArquivo(); }
        }); 
    }
    else
    {
        formulario = new Formulario({
            idFormulario: "sugestaoGaleria",
            idBtnEnviar: "btn_enviar_sugestao",
            idBtnCancelar: "btn_cancelar",
            aoValidar: function() { postarSugestao(); },
            aoCancelar: function() { showFormNovoArquivo(); }
        });
    }

    
};

function showFormNovoArquivo() {
    if ($("#form_novo_arquivo").is(":hidden")) {
        $("#form_novo_arquivo").show();
        $("#box_galeria").hide();
    } else {
        $("#form_novo_arquivo").hide();
        $("#box_galeria").show();
        formulario.limpar();
    }
};

function postarPreCadastro () {
    if(cadastroCompleto())
    {
        $('#form_arquivo_galeria')[0].submit();
    }
    else
    {
        showModal();
    }

};

function postarSugestao () {
    if (sugestaoCompleta())
    {
        $.ajax({
            url: "ajax/MensagemAjax.php",
            type: "POST",
            data: {
                "acao" : "sugestaoGaleria",
                "mensagem" : $('#link_arquivo').val() + '\n' +$('#descricao_arquivo').val()
            },
        }); 
    }
    showModal();
}

function cadastroCompleto () {
    if ($('#titulo_arquivo').val() == "")
    {
        $('#tipoMensagem').removeClass();
        $('#tipoMensagem').addClass("erro");
        $("#modalTexto").html('É necessário fornecer um nome ao arquivo!');
        return false;
    }

    else if ($('#descricao_arquivo').val() == "")
    {
        $('#tipoMensagem').removeClass();
        $('#tipoMensagem').addClass("erro");
        $("#modalTexto").html('É necessário fornecer uma descricao ao arquivo!');
        return false;
    }

    else if ($('#link_arquivo').val() == ""  && $('#file_arquivo').val() == "")
    {
        $('#tipoMensagem').removeClass();
        $('#tipoMensagem').addClass("erro");
        $("#modalTexto").html('É necessário selecionar um arquivo!');
        return false;
    }

    else
        return true;

}

function sugestaoCompleta () {
    if($('#link_arquivo').val() == ""){
        $('#tipoMensagem').removeClass();
        $('#tipoMensagem').addClass("erro");
        $("#modalTexto").html('É necessário fornecer link!');
        return false;
    }
    else if ($('#descricao_arquivo').val() == ""){
        $('#tipoMensagem').removeClass();
        $('#tipoMensagem').addClass("erro");
        $("#modalTexto").html('É necessário fornecer uma descrição!');
        return false;
    }
    else
    {
        $('#tipoMensagem').removeClass();
        $('#tipoMensagem').addClass("sucesso");
        $('#modalTexto').html('Sugestão mandada com sucesso.');
        $('#btn_cancelar').trigger('click');
        return true;
    }
}

function showModal () {
    $('.modal-backdrop').show();
    $('.modal').show();
}

function hideModal(){
    $('.modal-backdrop').hide();
    $('.modal').hide();
}

function trocarCategoriaArquivo() {
    $("input[name=cat_arquivo]").change(function() {
        if ($("#cat_upload_1").is(":checked")) {
            $("#tipoDeAruivo").parentsUntil("fieldset").show();
            $("#tipo_arquivo_link").trigger("click");
            $("#file_arquivo").attr("accept", "video/*");
        } else if ($("#cat_upload_2").is(":checked")) {
            $("#tipoDeAruivo").parentsUntil("fieldset").show();
            $("#tipo_arquivo_link").trigger("click");
            $("#file_arquivo").attr("accept", "image/*");
        } else if ($("#cat_upload_3").is(":checked")) {
            $("#tipoDeAruivo").parentsUntil("fieldset").hide();
            $("#tipo_arquivo_link").trigger("click");
        }
    });
    $("input[name=tipo_arquivo").change(function() {
        if ($("#tipo_arquivo_link").is(":checked")) {
            $("#link_arquivo").removeClass("nao_enviar");
            $("#link_arquivo").parentsUntil("fieldset").show();
            $("#file_arquivo").addClass("nao_enviar");
            $("input[data-for=file_arquivo]").parentsUntil("fieldset").hide();
        } else if ($("#tipo_arquivo_arquivo").is(":checked")) {
            $("#link_arquivo").addClass("nao_enviar");
            $("#link_arquivo").parentsUntil("fieldset").hide();
            $("#file_arquivo").removeClass("nao_enviar");
            $("input[data-for=file_arquivo]").parentsUntil("fieldset").show();
        }
    });
    $("#cat_upload_1").trigger("click");
};