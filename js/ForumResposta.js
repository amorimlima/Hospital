// Barra de rolagem personalizada
$(document).ready(function ()
{
    var idfrq = $("#idfrq").val();
    barraDeRolagem();

    $("#txt_pesquisa_input").keyup(function (){
        texto = $(this).val().toUpperCase();; 
        var cont = 0;

        if (texto != ''){
            $('#listaRecentes').css('display','none');
            $('#listaPesquisa').css('display','block');

            $('.perguntaPesquisa').each(function(){
                if($(this).html().toUpperCase().indexOf(texto)==-1) {
                    $(this).parent().css('display','none');
                } else {
                    $(this).parent().css('display','block');

                    if (cont%2 == 0) $(this).parent().css('background','#fdf0e7');
                            else $(this).parent().css('background','#ffffff');

                    cont++;
                }
            });
        } else {
            $('#listaRecentes').css('display','block');
            $('#listaPesquisa').css('display','none');
        }	
	//autoCompleteRespostas($("#txt_pesquisa_input").val())
    });

	$("body").delegate("#btn_responder", "click", function (){
        $(this).css("display", "none");
        var a = new Date;
        dia = a.getDate();
		mes = a.getMonth() + 1;
		ano = a.getFullYear()
		hora = a.getHours();
		min = a.getMinutes();
		seg = a.getSeconds();
		dt = [dia, mes, ano].join("/") + " \xe0s" + [hora, min].join(":");
		$(".dataResposta").text(dt), $("#campo_resp").css("display", "block")
    });

	$("#btn_pronto").click(validarEnviarForumResposta);

    listarRespostas(idfrq,0);
    
    $("#btnCarregarFrr").click(function() {
        var min = $(this).attr("data-min");
        listarRespostas(idfrq,min);
    });
});

function atualizarVisitas(questao){
	var total = $("#totalVis"+questao).text();
	total++;

	if (total == 1)	$("#totalVisTexto"+questao).html('<span id="totalVis'+questao+'">1</span> Visualização');
		else $("#totalVisTexto"+questao).html('<span id="totalVis'+questao+'">'+total+'</span> Visualizações');
	return false;
}

function barraDeRolagem () {
    $("#resultadoPesq, #box_Respostas_container").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: !0
        }
    });
}

function listarRespostas(idfrq,min) {
    var htmlFrr = "";
    
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "GET",
        dataType: "json",
        data: "acao=selectRangeByQuestao&idfrq="+idfrq+"&min="+min,
        beforeSend: function () {
            $("#btnCarregarFrr").text("Carregando...");
            $("#btnCarregarFrr").attr("disabled","disabled");
        },
        success: function(data) {
            var marginRight = "";
            if (data.length > 0) {
                marginRight = data.length > 4 ? "margin_right" : "";
                for (var a in data) {
                    htmlFrr += viewForumResposta(data[a], marginRight);
                }
            } else {
                htmlFrr = "<div class=\"alert alert-warning\">Nenhuma resposta encontrada.</div>";
            }
        },
        error: function() {
            htmlFrr = "<div class=\"alert alert-danger\">Erro ao carregar as respostas.</div>";
        },
        complete: function () {
            $("#fbCarregandoFrr").remove();
            $("#box_Respostas").append(htmlFrr);
            verificarQtdeForumResposta();
        }
    });
}

function viewForumResposta(resposta, marginRight) {
    var htmlFrr = "";
    var data = resposta.data.split(" ")[0];
    var datahorario = resposta.data.split(" ")[1];
    var horario = datahorario.split(":")[0]+":"+datahorario.split(":")[1];

    htmlFrr +=  "<div class=\"box_topico_resp "+marginRight+"\">";
    htmlFrr +=      "<p class=\"foto_aluno col-xs-1\">";
    htmlFrr +=          "<img src=\"imgp/"+resposta.usuario.imagem+"\" />";
    htmlFrr +=      "</p>";
    htmlFrr +=      "<div class=\"col-xs-11\">";
    htmlFrr +=          "<div class=\"dados_aluno\">";
    htmlFrr +=              "<span class=\"aluno_nome\">"+resposta.usuario.nome+"</span>";
    htmlFrr +=              "<span class=\"aluno_data\">Respondido dia "+data+" às "+horario+"</span>";
    htmlFrr +=          "</div>";
    htmlFrr +=          "<div>";
    htmlFrr +=              "<p class=\"resp_aluno\">"+resposta.resposta+"</p>";
    htmlFrr +=          "</div>";
    htmlFrr +=      "</div>";
    htmlFrr +=      "<div style=\"clear: both;\"></div>";
    htmlFrr +=  "</div>";

    return htmlFrr;
}

function verificarQtdeForumResposta() {
    var qtdeExibida = $(".box_topico_resp").length;
    var qtdeTotal = parseInt($("#frrQtde").val());
    
    if (qtdeExibida < qtdeTotal) {
        $("#btnCarregarFrr").text("Carregar mais");
        $("#btnCarregarFrr").removeAttr("disabled");
        $("#btnCarregarFrr").attr("data-min",qtdeExibida);
    } else {
        $("#containerCarregarRespostas").html("<span id=\"fbTudoCarregado\">Todas as respostas carregadas</span>");
    }
    
    $("#containerCarregarRespostas").show();
}

function validarEnviarForumResposta() {
    if ($("#resp_forum").val() != "") {
        var dados = $("#formNovaResposta").serialize();
        
        $.ajax({
            url: "ajax/ForumAjax.php",
            type: "post",
            dataType: "json",
            data: dados,
            beforeSend: function( ){
                $("#resp_forum").attr("disabled","disabled");
                $("#btn_pronto").attr("disabled","disabled");
                $("#btn_pronto").text("Aguarde...");
            },
            success: function (data){
                var questao = $("#idfrq").val();
                var frrVal = $("#frrQtde").val();
                var frrQtde = ++frrVal;
                
                if (frrVal == 0)
                    $("#totalRespTexto"+questao).html('<span id="totalResp'+questao+'">1</span> Resposta');
                else
                    $("#totalRespTexto"+questao).html('<span id="totalResp'+questao+'">'+frrQtde+'</span> Respostas');
                
                $("#frrQtde").val(frrQtde);
                getNovaForumResposta(data);
            }
        });
    } else {
        $('#respostaErroVazia').fadeIn(200);
    }
}

function getNovaForumResposta(resposta) {
    var htmlFrr = "";
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "GET",
        dataType: "json",
        data: "acao=selectForumResposta&idfrr="+resposta.id,
        success: function(data) {
            var marginRight = "";
            
            if (parseInt($("#frrQtde").val()) > 4)
                marginRight = "margin_right";
                
            htmlFrr += viewForumResposta(data,marginRight);
        },
        error: function() {
            htmlFrr = "<div class=\"alert alert-danger\">Erro ao carregar a nova resposta.</div>"; 
        },
        complete: function () {
            $("#respostaSucesso").fadeIn(200);
            $("#box_Respostas").prepend(htmlFrr);
            $("#resp_forum").val("");
            $("#btn_pronto").text("Responder");
            $("#resp_forum").removeAttr("disabled");
            $("#btn_pronto").removeAttr("disabled");
        }
    });
}