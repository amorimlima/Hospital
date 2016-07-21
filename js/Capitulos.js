var ctx;

var capitulo = {
    "exercicios": [],
    "exercicioAtual": {"id_exercicio": 0, "nome_exercicio": null, "completo": "N"},
    "finalizado": false
}

$(document).ready(function (){
    posicionarBolinhas();

    ctx = window.location.search;
    ctx = ctx.replace(/\?/g,"").split("&");
    ctx = {
        "ano"      : parseInt(ctx[0].split("=")[1]),
        "capitulo" : parseInt(ctx[1].split("=")[1])
    };


    var contador = 0;
    verificaExercicio();

    if (usuario.perfil == 1)
        carregarAtividadesAluno(ctx.capitulo, ctx.ano);
    else
        carregarAtividades(ctx.capitulo, ctx.ano);
});

// Carrega as atividades do capitulo caso o perfil logado seja o de aluno
function carregarAtividadesAluno (cap, ano) {
    $.ajax({
        url: 'ajax/ExerciciosAjax.php',
        data: { 'acao' : 'verificaExercicio', 'capitulo' : cap },
        dataType: 'json',
        success: function(exercicios) {
            exercicios.forEach(function(exercicio) {
                capitulo.exercicios.push(exercicio);
            });

            init();
        }
    });
}

// Carrega as atividades do capitulo caso o perfil logado seja qualquer um diferente de aluno
function carregarAtividades (capitulo, ano) {
    $.ajax({
        url: 'ajax/ExerciciosAjax.php',
        data: { 'acao'      : 'exercicioSerieCapitulo',
                'capitulo'  : capitulo,
                'serie'     : ano},
        dataType: 'json',
        success: function(d) {
            console.log(d);
            for (var i = 0; i < d.length; i++){
                $('#obj_'+d[i].exe_id).attr('pathObjeto', 'Objetos/'+ano+'ano/'+capitulo+'capitulo/'+d[i].exe_nome.trim()+'/index.html');
                $('#obj_'+d[i].exe_id).click(function(){
                    $('#objeto').attr('src', $(this).attr('pathObjeto')).css({'display':'block'});
                    risizeObj();
                });
            }
        }
    });
}

function verificaExercicio(){
    var url   = window.location.search.replace("?", "");
    var items = url.split("=");
    var capitulo = parseInt(items[1]);
    if(items[0] != 'ano') {
        $.ajax({
            url: "ajax/ExerciciosAjax.php",
            type: "post",
            dataType: "json",
            data: {
                'acao': "verificaExercicio",
                'capitulo': capitulo
            },
            success: function (data) {
                var capituloCompleto = true;
                for(var i = 0; i < data.length; i++){
                    if(data[i].completo === "N"){
                        $('#obj_'+data[i].id_exercicio).css('background', 'url(img/circulo_avancar_cap_'+capitulo+'.png) no-repeat');
                        capituloCompleto = false;
                    }else{
                        $('#obj_'+data[i].id_exercicio).css('background', 'url(img/circulo_parabens.png) no-repeat');
                    }

                }
                if (capituloCompleto){
                    $('#btn_exercicio_'+capitulo+'_parabens_brilho').css("display", "block");
                }
            }
        });
    }
    else
    {
        var items = url.split("&");
        var capitulo = items[1].split("=")[1];
        $('.obj_icone').css('background', 'url(img/circulo_avancar_cap_'+capitulo+'.png) no-repeat');
    }
}

function objectLength (object) {
    var key, count = 0;

    for(key in object)
      if(object.hasOwnProperty(key))
        count++;

    return count;
}

function posicionarBolinhas () { 
    var url   = window.location.search.replace("?", "");
    var items = url.split("=");
    var capitulo = parseInt(items[1]);
    if(items[0] == 'ano'){
        items = url.split("&");
        capitulo = items[1].split("=")[1];
    }
    var curvaExercicios = new Curva(parseInt(capitulo));

    for (var i = 0; i < $(".obj_icone").length; i++){
        var pos = curvaExercicios.getRelativePosition(i * 1 / ($(".obj_icone").length - 1));

        $(".obj_icone")[i].style.left = pos[0] + "px";
        $(".obj_icone")[i].style.bottom = pos[1] + "px";
    }
}

// Eventos e funções iniciais, ao carregar as atividades do capítulo
function init() {
    var posicoes = document.querySelectorAll("#caminho .obj_icone");
    var objeto = document.getElementById("objeto");
    var basePath = "Objetos/" + ctx.ano + "ano/" + ctx.capitulo + "capitulo/";

    for (var i in capitulo.exercicios) {
        posicoes[i].setAttribute("pathObjeto", basePath + capitulo.exercicios[i].nome_exercicio + "/index.html");

        posicoes[i].onclick = function(ev) {
            objeto.src = this.getAttribute("pathObjeto");

            for (var a in capitulo.exercicios) {
                if (this.getAttribute("pathObjeto").contains(capitulo.exercicios[a].nome_exercicio)) {
                    capitulo.exercicioAtual = capitulo.exercicios[a];
                    break;
                }
            }
        }

        // Verifica se o exercício já está completo para atualizar a posição no percurso
        // Se não estiver completo, carrega a atividade no <iframe>
        if (capitulo.exercicios[i].completo == "S") {
            posicoes[i].style.background = "url(\"img/circulo_parabens.png\") no-repeat";
        } else {
            objeto.src = basePath + capitulo.exercicios[i].nome_exercicio + "/index.html";
            break;
        }
    }

    atribuirEventosIframe();
}

// Verificar alterações no <iframe>
function atribuirEventosIframe() {
    document.getElementById("objeto").onload = function(e) {
        var pathObj = this.contentWindow.location.pathname;
        var nomeObj = pathObj.slice(pathObj.indexOf("capitulo/") + 9, pathObj.lastIndexOf("/index.html"));
        var posicoes = document.querySelectorAll("#caminho .obj_icone");

        for (var a = 0; a < capitulo.exercicios.length; a++) {
            // Seta a atividade atual para a que está sendo feita no momento
            if (capitulo.exercicios[a].nome_exercicio == nomeObj) {
                capitulo.exercicioAtual = capitulo.exercicios[a];

                // Verifica se a atividade atual já não havia sido realizada antes
                if (capitulo.exercicios[a].completo == "N" && a > 0) {
                    capitulo.exercicios[a].onclick = function(ev) {
                        document.getElementById("objeto").src = this.getAttribute("pathObjeto");

                        for (var b in capitulo.exercicios) {
                            if (this.getAttribute("pathObjeto").contains(capitulo.exercicios[b].nome_exercicio)) {
                                capitulo.exercicioAtual = capitulo.exercicios[b];
                                break;
                            }
                        }
                    }

                    // Atualiza o estilo da posição anterior à nova atividade no percurso
                    posicoes[a].setAttribute("pathObjeto", pathObj);
                    posicoes[a - 1].style.background = "url(\"img/circulo_parabens.png\") no-repeat";
                    capitulo.exercicios[a - 1].completo = "S";
                }

                break;
            }
        }

        // Verificar se o capítulo está completo para exibir o feedback de "PARABÉNS"
        if (isCapituloCompleto()) {
            posicoes[posicoes.length - 1].style.background = "url(\"img/circulo_parabens.png\") no-repeat";
            $("#btn_exercicio_" + ctx.capitulo + "_parabens").hide();
            $("#btn_exercicio_" + ctx.capitulo + "_parabens_brilho").show();
        }
    }
}

// Verificar se o capítulo está completo
function isCapituloCompleto() {
    if (capitulo.exercicioAtual.id_exercicio == capitulo.exercicios[capitulo.exercicios.length - 1].id_exercicio)
        capitulo.completo = true;

    return capitulo.completo;
}