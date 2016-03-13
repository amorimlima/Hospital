var formulario;
$(document).ready(function () {
    criarDropDown();
    atribuirBarrasDeRolagem();
    atribuirPesquisa();
    criarFormulario();    
    formulario.iniciar();
    carregarGaleria();
    carregarMaisVistos();
    atribuirContagem();
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
                $('#mCSB_1_container').html(htmlCentral);
            },
            error: function(error) {
                console.error("Erro: \n" + error.responseText);
            }
        });
    });
}

function abrirSelectCateoria () {
    $('#select_text').click(function(){
       $('#box_select').toggle();
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
            for(var i = 0; i < categorias.length; i++){
                htmlCategorias += '<span id="cat_'+categorias[i].id+'" class="opcoesCategorias">'+categorias[i].categoria+'</span>'
            }
            $('#mCSB_2_container').html(htmlCategorias);
            atribuirClickSelect();
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
}


function criarFormulario () {
    $("#botaoCarregar").click(showFormNovoArquivo);

    formulario = new Formulario({
        idFormulario: "form_arquivo_galeria",
        idInputFile: "file_arquivo",
        idBtnEnviar: "btn_enviar",
        idBtnCancelar: "btn_cancelar",
        aoValidar: function() { postarPreCadastro(); },
        aoCancelar: function() { showFormNovoArquivo(); }
    });
}

function showFormNovoArquivo() {
    if ($
        ("#form_novo_arquivo").is(":hidden")) {
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