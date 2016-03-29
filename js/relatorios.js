"use strict";
var escolaAtiva;
var professorAtivo;

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
	$("#tipo_grafico_picker").click(function(event) {
		event.stopPropagation();
	});

	$("#btn_voltar").click(voltarGrafico);

	$("#liberarCapitulosTable").find("span").click(function() {
		if ($(this).is(".cap_nao_liberado")) {
			$(this).addClass("cap_liberado");
			$(this).removeClass("cap_nao_liberado");
		} else if ($(this).is(".cap_liberado")) {
			$(this).removeClass("cap_liberado");
			$(this).addClass("cap_nao_liberado");
		}
	});

	graficoGaleria();
	carregarGraficos();


};

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
};

function showLiberarCapitulos()
{
	$("#liberarCapitulos").hide();
	$("#conteudoPrincipal").hide();
	$("#liberarCapituloContainer").show();
};

function concluirLiberarCapitulos()
{
	$("#liberarCapitulos").show();
	$("#conteudoPrincipal").show();
	$("#liberarCapituloContainer").hide();
	$("#liberarCapituloContainer").empty();
};

function voltarGrafico()
{
	if (escolaAtiva && professorAtivo) {
		getEscolaById(escolaAtiva);
		professorAtivo = false;
	} else if (escolaAtiva && !professorAtivo) {
		getEscolas();
		escolaAtiva = false;
	}
};

/* ============================================ */
/* 					ESCOLA 						*/
/* ============================================ */
function getEscolas()
{
	var escolas;

	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=listarEscolas",
		dataType: "json",
		success: function(data) {
			escolas = data;
		},
		complete: function() {
			viewEscolas(escolas);
		}
	});
};

function getEscolaById(idEscola)
{
	var escola; 
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=escolaPorId&id="+idEscola,
		dataType: "json",
		beforeSend: function () {
			$(".lista_itens_grafico").empty();
		},
		success: function(data) {
			escola = data;
		},
		complete: function() {
			escolaAtiva = escola.id;
			viewEscolaSelected(escola);
			getProfessoresByEscola(idEscola);
		}
	});
};

function viewEscolas(escolas)
{
	var htmlListaEsc = "";
	$("#box_perfil_selected").remove();

	if (escolas.length > 0) {
		for (var a in escolas) {
			htmlListaEsc += '<div onclick="getEscolaById('+escolas[a].id+')">';
			htmlListaEsc += 	'<div class="row">';
			htmlListaEsc += 		'<div class="col-md-4">';
			htmlListaEsc += 			'<div class="grafico_desc" id="esc_id_'+escolas[a].id+'">';
			htmlListaEsc += 				'<div>';
			htmlListaEsc += 					'<span>'+escolas[a].nome+'</span>';
			htmlListaEsc += 				'</div>';
			htmlListaEsc += 			'</div>';
			htmlListaEsc += 		'</div>';
			htmlListaEsc += 		'<div class="col-md-8">';
			htmlListaEsc += 			'<div class="grafico_chart">';
			htmlListaEsc += 				'<svg class="chart">';
			htmlListaEsc += 					'<rect y="0" width="41%" height="18" class="chart_acesso"></rect>';
			htmlListaEsc += 					'<rect y="22" width="67%" height="18" class="chart_download"></rect>';
			htmlListaEsc += 				'</svg>';
			htmlListaEsc += 			'</div>';
			htmlListaEsc += 		'</div>';
			htmlListaEsc += 	'</div>';
			htmlListaEsc += '</div>';
		};
	} else {
		htmlListaEsc += '<div class="alert alert-warning">Nenhuma escola encontrada;</div>';
	}

	$(".lista_itens_grafico").html(htmlListaEsc)
};

function viewEscolaSelected(escola)
{
	var htmlEscSelected = "";
	$("#box_perfil_selected").remove();

	htmlEscSelected +=	'<div id="box_perfil_selected" class="box_perfil_selected">';
	htmlEscSelected +=		'<div class="foto_perfil_selected"></div>';
	htmlEscSelected +=		'<div clas="info_perfil_selected">';
	htmlEscSelected +=			'<div class="nome_perfil_selected">'+escola.nome+'</div>';
	htmlEscSelected +=			'<div class="razaoSocial_perfil_selected">Razão social: '+escola.razao_social+'</div>';
	htmlEscSelected +=			'<div class="dados_perfil_selected">Cidade: '+escola.endereco.cidade+' | Estado: '+escola.endereco.uf+' | Site: '+escola.site+'</div>';
	htmlEscSelected +=			'<div class="acoes_perfil_selected"><a href="cadastro.php"><span>Ver dados cadastrais</span></a> | <span class="lib_cap" id="lib_cap_'+escola.id+'" onclick="getCapitulosByEscola('+escola.id+')">Liberar capítulos</span></div>';
	htmlEscSelected +=		'</div>';
	htmlEscSelected +=	'</div>';

	$(".tipo_grafico_picker_opcoes").after(htmlEscSelected);
};

function getCapitulosByEscola(idEscola)
{
	var capitulos;

	$.ajax({
		url: "ajax/LiberarCapituloAjax.php",
		type: "GET",
		data: "acao=listar&id="+idEscola,
		dataType: "json",
		success: function(data) {
			capitulos = data;
		},
		complete: function() {
			viewCapitulosLiberados(idEscola,capitulos);
		}
	});
};

function viewCapitulosLiberados(idEscola,capitulos)
{
	var htmlTable = '<h1>Liberar capítulos</h1>';

	htmlTable += '<table id="liberarCapitulosTable" class="liberar_capitulos_table">';

	for (var i = 0; i <= 5; i++) {
		if (i === 0) {
			htmlTable += '<thead>';
			htmlTable += 	'<tr>';

			for (var j = 0; j <= 5; j++) {
				if (j === 0)
					htmlTable += '<th class="blank">&nbsp;</th>';
				else
					htmlTable += '<th>Livro '+j+'</th>'
			};

			htmlTable += 	'</tr>';
			htmlTable += '</thead>';
		} else {
			if (i === 1)
				htmlTable += '<tbody>';

			htmlTable += '<tr>';

			for (var j = 0; j <= 5; j++) {
				if (j === 0)
					htmlTable += '<td class="capitulo">Capítulo '+i+'</td>';
				else
					htmlTable += '<td><span data-liberado="0" data-livro="'+j+'" data-capitulo="'+i+'" onclick="toggleCapitulo('+idEscola+','+i+','+j+')" class="cap_nao_liberado"></span></td>';
			};

			htmlTable += '</tr>';

			if (i === 5)
				htmlTable += '</tbody>';
		};
	};

	htmlTable += '</table>';
	htmlTable += '<div>';
	htmlTable += 	'<button id="concluirLiberarCapitulos" class="btn_primary" onclick="concluirLiberarCapitulos()">Concluir</button>';
	htmlTable += '</div>';

	$("#liberarCapituloContainer").html(htmlTable);
	showLiberarCapitulos();

	for (var a in capitulos) {
		$("[data-capitulo="+capitulos[a].capitulo+"]").each(function() {
			if ($(this).is("[data-livro="+capitulos[a].livro+"]")) {
				$(this).attr("class","cap_liberado");
				$(this).attr("data-liberado","1");
				$(this).attr("data-id",capitulos[a].id)
			};
		});
	};
};

function toggleCapitulo(idEscola, cap, livro)
{
	if ($("[data-capitulo="+cap+"][data-livro="+livro+"]").is("[data-liberado=0]")) {
		liberarCapitulo(idEscola,cap,livro);
	} else if($("[data-capitulo="+cap+"][data-livro="+livro+"]").is("[data-liberado=1]")) {
		var idCap = $("[data-capitulo="+cap+"][data-livro="+livro+"]").attr("data-id");
		bloquearCapitulo(idCap, cap, livro);
	}
};

function bloquearCapitulo(idCap,cap,livro)
{
	var retorno;
	$.ajax({
		url: "ajax/LiberarCapituloAjax.php",
		type: "POST",
		data: "acao=deletar&id="+idCap,
		dataType: "json",
		success: function(data) {
			console.info(data.mensagem);
		},
		complete: function () {
			$("#mensagemSucessoDeletar").show();
			updateToggledCap("bloquear",null,cap,livro);
		}
	});
};

function liberarCapitulo(idEscola,cap,livro)
{
	var retorno;
	$.ajax({
		url: "ajax/LiberarCapituloAjax.php",
		type: "POST",
		data: "acao=liberar&escola="+idEscola+"&capitulo="+cap+"&livro="+livro,
		dataType: "json",
		success: function(data) {
			retorno = data;
		},
		complete: function() {
			$("#mensagemCapituloLiberado").show();
			updateToggledCap(retorno.acao,retorno.id,retorno.capitulo,retorno.livro);
		}
	});
};

function updateToggledCap(acao,id,capitulo,livro)
{
	if (acao === "liberar") {
		$("[data-capitulo="+capitulo+"][data-livro="+livro+"]").attr("class","cap_liberado");
		$("[data-capitulo="+capitulo+"][data-livro="+livro+"]").attr("data-liberado","1");
		$("[data-capitulo="+capitulo+"][data-livro="+livro+"]").attr("data-id",id);
	} else if (acao === "bloquear") {
		$("[data-capitulo="+capitulo+"][data-livro="+livro+"]").attr("class","cap_nao_liberado");
		$("[data-capitulo="+capitulo+"][data-livro="+livro+"]").attr("data-liberado","0");
		$("[data-capitulo="+capitulo+"][data-livro="+livro+"]").removeAttr("data-id");
	}
};

/* ============================================ */
/* 					PROFESSOR					*/
/* ============================================ */
function getProfessoresByEscola(idEscola)
{
	var professores;
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=galeriaEscola&idEscola="+idEscola,
		success: function(data) {
			$(".lista_itens_grafico").html(data);
		}
	});
};

function getProfessorById(idProf)
{
	var professor; 
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=professorPorId&id="+idProf,
		dataType: "json",
		beforeSend: function() {
			$(".lista_itens_grafico").empty();
		},
		success: function(data) {
			professor = data;
		},
		complete: function() {
			professorAtivo = professor.id;
			viewProfessorSelected(professor);
			getAlunosByProfessor(professor);
		},
		error: function(e) {
			console.error(e);
		}
	});
};

function viewProfessoresByEscola(professores)
{
	var htmlProfsEsc = "";

	if (professores.length > 0) {
		for (var c in professores) {
			htmlProfsEsc += '<div onclick="getProfessorById('+professores[c].id+')">';
			htmlProfsEsc += 	'<div class="row">';
			htmlProfsEsc += 		'<div class="col-md-4">';
			htmlProfsEsc += 			'<div class="grafico_desc" id="prof_id_'+professores[c].id+'">';
			htmlProfsEsc += 				'<div>';
			htmlProfsEsc += 					'<img src="'+professores[c].imagem+'" alt="'+professores[c].nome.split(" ")[0]+'" title="'+professores[c].nome+'" />';
			htmlProfsEsc += 					'<span>'+professores[c].nome+'</span>';
			htmlProfsEsc += 				'</div>';
			htmlProfsEsc += 			'</div>';
			htmlProfsEsc += 		'</div>';
			htmlProfsEsc += 		'<div class="col-md-8">';
			htmlProfsEsc += 			'<div class="grafico_chart">';
			htmlProfsEsc += 				'<svg class="chart">';
			htmlProfsEsc += 					'<rect y="0" width="41%" height="18" class="chart_acesso"></rect>';
			htmlProfsEsc += 					'<rect y="22" width="67%" height="18" class="chart_download"></rect>';
			htmlProfsEsc += 				'</svg>';
			htmlProfsEsc += 			'</div>';
			htmlProfsEsc += 		'</div>';
			htmlProfsEsc += 	'</div>';
			htmlProfsEsc += '</div>';
		};
	} else {
		htmlProfsEsc += '<div class="alert alert-warning">Nenhum professor encontrado.</div>';
	};

	$(".lista_itens_grafico").html(htmlProfsEsc);
};

function viewProfessorSelected(professor)
{
	var htmlProfSelected = "";
	var data_nascimento = professor.data_nascimento.split("-")[2]+"/"+professor.data_nascimento.split("-")[1]+"/"+professor.data_nascimento.split("-")[0];
	var data_entrada = professor.data_entrada_escola.split("-")[2]+"/"+professor.data_entrada_escola.split("-")[1]+"/"+professor.data_entrada_escola.split("-")[0];
	$("#box_perfil_selected").remove();

	htmlProfSelected +=	'<div id="box_perfil_selected" class="box_perfil_selected">';
	htmlProfSelected +=		'<div class="foto_perfil_selected"></div>';
	htmlProfSelected +=		'<div clas="info_perfil_selected">';
	htmlProfSelected +=			'<div class="nome_perfil_selected">'+professor.nome+'</div>';
	htmlProfSelected +=			'<div class="dados_perfil_selected">Data de nascimento: '+data_nascimento+' | Entrada na escola: '+data_entrada+'</div>';
	htmlProfSelected +=			'<div class="acoes_perfil_selected"><a href="cadastro.php"><span>Ver dados cadastrais</span></a></div>';
	htmlProfSelected +=		'</div>';
	htmlProfSelected +=	'</div>';

	$(".tipo_grafico_picker_opcoes").after(htmlProfSelected);
};

function carregarGraficos () {
	$('#graficoGaleria').click(function() {
		graficoGaleria();
		event.stopPropagation();
	});
	$('#graficoExercicios').click(function() {
		graficoExercicios();
		event.stopPropagation();
	});
}

function graficoGaleria () {
	console.log('ok');
	$.ajax({
		url: 'ajax/RelatoriosAjax.php',
		type: 'GET',
		data: {'acao' : 'graficoGaleria'},
		success: function(dados) {
			$('.lista_itens_grafico').html(dados);
			$('#grafico1').css('display', 'block');
		}
	});
}

function graficoExercicios () {
	$.ajax({
		url: 'ajax/RelatoriosAjax.php',
		type: 'GET',
		data: {'acao' : 'graficoExercicios'},
		success: function(dados) {
			$('.lista_itens_grafico').html(dados);
			$('#grafico1').css('display', 'block');
		}
	});
}

/* ============================================ */
/* 					ALUNO						*/
/* ============================================ */