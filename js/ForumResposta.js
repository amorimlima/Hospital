function listaRespostas(a){
    $.ajax({
        url: "ajax/ForumAjax.php",
        type: "post",
        dataType: "html",
        data: {
            acao: "listaRespostaQuestao",
            resp: a
        },
        success: function (a)
        {
            $(".conteudoRespostas").html(a)
        }
    })
}

function autoCompleteRespostas(a)
{
    $.ajax(
    {
        url: "ajax/ForumAjax.php",
        type: "post",
        dataType: "html",
        data: {
            acao: "listaQuestoesRecentes",
            texto: a
        },
        success: function (a)
        {
            $("#box_result_pesquisa").html(a)
        }
    })
}
$(document).ready(function ()
{
    $("#postagens_recentes, .conteudoRespostas").mCustomScrollbar({
        axis: "y",
        scrollButtons: {
            enable: !0
        }
    });

	$("#txt_pesquisa_input").keyup(function (){
        autoCompleteRespostas($("#txt_pesquisa_input").val())
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

	$("body").delegate("#btn_pronto", "click", function (){
        usuario = $(this).attr("idAluno");
		resposta = $("#resp_forum").val();
		questao = resp, "" == resposta ? (alert("Resposta Inválida!!"), !1) : void $.ajax(
        {
            url: "ajax/ForumAjax.php",
            type: "post",
            dataType: "json",
            data: {
                acao: "NovaRespostaQuestao",
                questao: questao,
                resposta: resposta,
                usuario: usuario
            },
            success: function ()
            {
                listaRespostas(resp)
            }
        })
    })
});