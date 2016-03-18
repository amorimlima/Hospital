"use strict";
$(document).ready(atribuirEventos);

function atribuirEventos()
{
	$("#tipo_grafico_picker").click(function() {
		$(this).toggleClass("picker_expanded");
	});
	$(".listagem_perfis_graficos").mCustomScrollbar({
		axis: "y",
		scrollButtons:{
			enable:true
		}
	});
	$(".tipo_grafico_picker_opcoes").children("div").click(function() {
		toggleGrafico(this);
	});
	$("body").click(function() {
		$("#tipo_grafico_picker").removeClass("picker_expanded");
	});
	$(".tipo_grafico_picker_opcoes").click(function(event) {
		event.stopPropagation();
	});
	$("#tipo_grafico_picker").click(function(event) {
		event.stopPropagation();
	});

	$("#liberarCapitulos").click(showLiberarCapitulos);
	$("#cancelarLiberarCapitulos").click(cancelLiberarCapitulos);
	$("#salvarLiberarCapitulos").click(saveLiberarCapitulos);

	$("#liberarCapitulosTable").find("span").click(function() {
		if ($(this).is(".cap_nao_liberado")) {
			$(this).addClass("cap_liberado");
			$(this).removeClass("cap_nao_liberado");
		} else if ($(this).is(".cap_liberado")) {
			$(this).removeClass("cap_liberado");
			$(this).addClass("cap_nao_liberado");
		}
	});

	$(".grafico_desc").click(function() {
		accessEscolaInfo(this);
	})
}
function toggleGrafico(item)
{
	var idNum = $(item).attr("id").substring(11);
	var texto = $(item).html();

	$("#tipo_grafico_picker").removeClass("picker_expanded");
	$(".tipo_grafico_picker_opcoes").children("div").not(item).removeClass("option_selected");
	$(".grafico").not("#grafico"+idNum).hide();
	$(".legenda_grafico").children("div").not("#legendaGrafico"+idNum).hide()
	$("#legendaGrafico"+idNum).show();
	$(item).addClass("option_selected");
	$("#grafico"+idNum).show();
	$("#tipo_grafico_picker").html(texto);
}
function showLiberarCapitulos()
{
	$("#liberarCapitulos").hide();
	$("#conteudoPrincipal").hide();
	$("#liberarCapituloContainer").show();
}
function cancelLiberarCapitulos()
{
	$("#liberarCapitulos").show();
	$("#conteudoPrincipal").show();
	$("#liberarCapituloContainer").hide();
}
function saveLiberarCapitulos()
{
	$("#liberarCapitulos").show();
	$("#conteudoPrincipal").show();
	$("#liberarCapituloContainer").hide();
}

/* ============================================ */
/* 					ESCOLA 						*/
/* ============================================ */
function getEscolas()
{
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=listarEscolas",
		dataType: "json",
		success: function(escolas) {
			for (var a in escolas) {
				console.log(escolas[a]);
			}
		}
	});
}

function accessEscolaInfo(escola)
{
	var idEscola = escola.id.split("_")[2];
	getEscolaById(idEscola);
}

function getEscolaById(idEscola)
{
	var escola; 
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=escolaPorId&id="+idEscola,
		dataType: "json",
		success: function(data) {
			escola = data;
		},
		complete: function() {
			viewEscolaSelected(escola);
			getProfessoresByEscola(idEscola);
		}
	});
}

function viewEscolaSelected(escola)
{
	var htmlEscSelected = "";

	htmlEscSelected +=	'<div id="box_perfil_selected" class="box_perfil_selected">';
	htmlEscSelected +=		'<div class="foto_perfil_selected"></div>';
	htmlEscSelected +=		'<div clas="info_perfil_selected">';
	htmlEscSelected +=			'<div class="nome_perfil_selected">'+escola.nome+'</div>';
	htmlEscSelected +=			'<div class="razaoSocial_perfil_selected">Razão social: '+escola.razao_social+'</div>';
	htmlEscSelected +=			'<div class="dados_perfil_selected">Cidade: '+escola.endereco.cidade+' | Estado: '+escola.endereco.uf+' | Site: '+escola.site+'</div>';
	htmlEscSelected +=			'<div class="acoes_perfil_selected"><a href="cadastro.php"><span>Ver dados cadastrais</span></a> | <span class="lib_cap" id="lib_cap_'+escola.id+'"></span></div>';
	htmlEscSelected +=		'</div>';
	htmlEscSelected +=	'</div>';

	console.log(htmlEscSelected);
	$("#tipo_grafico_picker").next("")
}

/* ============================================ */
/* 					PROFESSOR					*/
/* ============================================ */
function getProfessoresByEscola(idEscola)
{
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=professoresPorEscola&id="+idEscola,
		dataType: "json",
		success: function(professores) {
			console.log(professores);
		}
	});
}