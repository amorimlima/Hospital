"use strict";

$(document).ready(function() {
	gerarPickerTipoGrafico();
	atribuirBarrasRolagem();
	menuAtribuirCapitulo();
	var data = getDadosUsuario();
	var data2 = getDadosUsuario();
	carregarGrafico(data);
	carregarTodosFiltros(data2);
	filtrosChange();
	botoesGrupo();
	botaoModal();
    voltarGrafico();
});

function gerarPickerTipoGrafico() {
	$("#tipo_grafico_picker").click(function(event) {
		event.stopPropagation();
		$(this).toggleClass("picker_expanded");
	});

	$(".tipo_grafico_picker_opcoes").children("div").click(function() {
		toggleGrafico(this);
	});

	$("body").click(function() {
		$("#tipo_grafico_picker").removeClass("picker_expanded");
	});
}

function atribuirBarrasRolagem () {
	$(".listagem_perfis_graficos").mCustomScrollbar({
		axis: "y",
		scrollButtons:{
			enable:true
		}
	});
}

function toggleGrafico(item)
{
	var texto = $(item).html();

	$("#tipo_grafico_picker").removeClass("picker_expanded");
	if (texto != $("#tipo_grafico_picker").html){
		$(".tipo_grafico_picker_opcoes").children("div").not(item).removeClass("option_selected");
		$(item).addClass("option_selected");
		$("#tipo_grafico_picker").html(texto);
		carregarGrafico(getDadosUsuario());
	}
	
};

function menuAtribuirCapitulo () {
	$("#liberarCapitulosTable").find("span").click(function() {
		if ($(this).is(".cap_nao_liberado")) {
			$(this).addClass("cap_liberado");
			$(this).removeClass("cap_nao_liberado");
		} else if ($(this).is(".cap_liberado")) {
			$(this).removeClass("cap_liberado");
			$(this).addClass("cap_nao_liberado");
		}
	});
}

function voltarGrafico()
{
	$("#btn_voltar").click(function() {
		$('.lista_itens_grafico').empty();
		if ($('#box_perfil_selected').length > 0){
			if($('#professor_id').length > 0 )
			{
				var escolaId = $('#escola_id').attr('id_escola');
				$('#box_perfil_selected').remove();
				$.ajax({
					url: 'ajax/RelatoriosAjax.php',
					type: 'GET',
					data: {	'acao' : 'escolaPorId',
							'id' : escolaId},
					dataType: 'json',
					success: function(escola) {
						viewEscola(escola);
					}
				});
				carregarGrafico(getDadosUsuario());
			}
			else
			{
				$('#box_perfil_selected').remove();
				carregarGrafico(getDadosUsuario());
			}
		}
	});
}

function filtrosChange () {

	$(".filtrosSelect").change(function() {
		carregarGrafico(getDadosUsuario());

		var data = getDadosUsuario();
		$(".filtrosSelect").not(this).each(function() {
			carregaFiltro(data, this);
		});
	});
}

function carregarGrafico (data) {
	var d = data
	
	$('.lista_itens_grafico').html("Carregando...");
	d.acao = "carregaGrafico";
	d.grafico = $('.option_selected ').attr('id');
	
	$.ajax({
		url: 'ajax/RelatoriosAjax.php',
		type: 'GET',
		data: d,
		success: function(dados) {
			$('.lista_itens_grafico').html(dados);
			return false;
		}
	});
	return false;
}

function carregaFiltro(data, filtro) {
	var valor = $(filtro).val();
	$(filtro).html("<option>Carregando...</option>");
	data.filtro = filtro.id
	data.acao = "carregaFiltro";
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: data,
		success: function(d) {
			console.log(d);
			$(filtro).html(d);
		},
		complete: function() {
			if (valor != null)
				$(filtro).val(valor);
		}
	});
}

function carregarTodosFiltros(data) {
	$('.filtrosSelect').each(function() {
		carregaFiltro(data, this);
	})
}

function getDadosUsuario () {
	var perfil = 3;//Padrão
	var id;
	if ($('#box_perfil_selected').length > 0){
		if ($('#professor_id').length > 0)
		{
			console.log('perfil = 2');
			perfil = 2;
			id = $('#professor_id').attr('id_professor');
		}
		else
		{
			console.log('perfil = 4');
			perfil = 4;
			id = $('#escola_id').attr('id_escola');
		}
	}
	else
	{
		perfil = usuario.perfil;
		if (perfil != 4)
			id = usuario.id;
		else
			id = usuario.escola;
	}
	
	
	
	var data = {
		'livro' : $('#filtroLivro').val(),
		'capitulo' : $('#filtroCapitulo').val(),
		'sala' : $('#filtroSala').val(),
		'perfil' : perfil,
		'id' : id,
	};

	if (data.livro == null)
		data.livro = 0;
	if (data.capitulo == null)
		data.capitulo = 0;
	if (data.sala == null)
		data.sala = 0;

	return data;
}

function viewEscola(escola)
{
	var htmlEscSelected = "";	

	htmlEscSelected +=	'<div id="box_perfil_selected" class="box_perfil_selected ficha_dados">';
	htmlEscSelected +=		'<div class="foto_perfil_selected"></div>';
	htmlEscSelected += 		'<input type="hidden" id="escola_id" id_escola="'+escola.id+'"/>';
	htmlEscSelected +=		'<div class="info_perfil_selected">';
	htmlEscSelected +=			'<div class="nome_perfil_selected">'+escola.nome+'</div>';
	htmlEscSelected +=			'<div class="razaoSocial_perfil_selected">Razão social: '+escola.razao_social+'</div>';
	htmlEscSelected += 			'<div class="dados_perfil_selected">Tipo: '+escola.tipo_escola+' | Administração: '+escola.administracao+'</div>';
	htmlEscSelected +=			'<div class="dados_perfil_selected">Cidade: '+escola.endereco.cidade+' | Estado: '+escola.endereco.uf+' | Site: '+escola.site+'</div>';
	htmlEscSelected +=			'<div class="dados_perfil_selected">Diretor: '+escola.diretor.nome+' | E-mail: '+escola.diretor.email+'</div>';
	htmlEscSelected +=			'<div class="acoes_perfil_selected"><a href="cadastro.php"><span>Ver dados cadastrais</span></a> | <span class="lib_cap" id="lib_cap_'+escola.id+'" onclick="getCapitulosByEscola('+escola.id+')">Liberar capítulos</span></div>';
	htmlEscSelected +=		'</div>';
	htmlEscSelected +=	'</div>';

	$(".tipo_grafico_picker_opcoes").after(htmlEscSelected);
}

function viewProfessorSelected(professor)
{
	var htmlProfSelected = "";
	var data_nascimento = professor.data_nascimento.split("-")[2]+"/"+professor.data_nascimento.split("-")[1]+"/"+professor.data_nascimento.split("-")[0];
	var data_entrada = professor.data_entrada_escola.split("-")[2]+"/"+professor.data_entrada_escola.split("-")[1]+"/"+professor.data_entrada_escola.split("-")[0];
	var rg = professor.rg.slice(0,2)+"."+professor.rg.slice(2,5)+"."+professor.rg.slice(5,8)+"-"+professor.rg.slice(8);
	var cpf = professor.cpf.slice(0,3)+"."+professor.cpf.slice(3,6)+"."+professor.cpf.slice(6,9)+"-"+professor.cpf.slice(9);
	$("#box_perfil_selected").remove();

	htmlProfSelected +=	'<div id="box_perfil_selected" class="box_perfil_selected ficha_dados">';
	htmlProfSelected +=		'<div class="foto_perfil_selected"></div>';
	htmlProfSelected +=		'<div clas="info_perfil_selected">';
	htmlProfSelected += 	'<input type="hidden" id="professor_id" id_professor="'+professor.id+'"/>';
	htmlProfSelected += 	'<input type="hidden" id="escola_id" id_escola="'+professor.escola+'"/>';
	htmlProfSelected +=			'<div class="nome_perfil_selected">'+professor.nome+'</div>';
	htmlProfSelected +=			'<div class="dados_perfil_selected">Escola: '+professor.escola_nome+' | Entrada na escola: '+data_entrada+'</div>';
	htmlProfSelected +=			'<div class="dados_perfil_selected">RG: '+rg+' | CPF: '+cpf+' | Data de nascimento: '+data_nascimento+'</div>';
	htmlProfSelected +=			'<div class="acoes_perfil_selected"><a href="cadastro.php"><span>Ver dados cadastrais</span></a> | <span id="editar_grupos">Editar grupos</span></div>';
	htmlProfSelected +=		'</div>';
	htmlProfSelected +=	'</div>';

	$(".tipo_grafico_picker_opcoes").after(htmlProfSelected);
	$('#editar_grupos').click(function() {
		abrirEdicaoGrupo(professor.id);
	});
}

function viewEscolaSelected(escola)
{
	var htmlEscSelected = "";
	$("#box_perfil_selected").remove();

	htmlEscSelected +=	'<div id="box_perfil_selected" class="box_perfil_selected ficha_dados">';
	htmlEscSelected +=		'<div class="foto_perfil_selected"></div>';
	htmlEscSelected +=		'<div class="info_perfil_selected">';
	htmlEscSelected += 		'<input type="hidden" id="escola_id" id_escola="'+escola.id+'"/>';
	htmlEscSelected +=			'<div class="nome_perfil_selected">'+escola.nome+'</div>';
	htmlEscSelected +=			'<div class="razaoSocial_perfil_selected">Razão social: '+escola.razao_social+'</div>';
	htmlEscSelected += 			'<div class="dados_perfil_selected">Tipo: '+escola.tipo_escola+' | Administração: '+escola.administracao+'</div>';
	htmlEscSelected +=			'<div class="dados_perfil_selected">Cidade: '+escola.endereco.cidade+' | Estado: '+escola.endereco.uf+' | Site: '+escola.site+'</div>';
	htmlEscSelected +=			'<div class="dados_perfil_selected">Diretor: '+escola.diretor.nome+' | E-mail: '+escola.diretor.email+'</div>';
	htmlEscSelected +=			'<div class="acoes_perfil_selected"><a href="cadastro.php"><span>Ver dados cadastrais</span></a> | <span class="lib_cap" id="lib_cap_'+escola.id+'" onclick="getCapitulosByEscola('+escola.id+')">Liberar capítulos</span></div>';
	htmlEscSelected +=		'</div>';
	htmlEscSelected +=	'</div>';

	$(".tipo_grafico_picker_opcoes").after(htmlEscSelected);
}

function professorGetById(idProfessor) {
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=usuarioPorId&id="+idProfessor,
		dataType: "json",
		success: function(d) {
			viewProfessorSelected(d);
			carregarGrafico(getDadosUsuario());
		}		
	});
}

function escolaGetById(idEscola) {
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		type: "GET",
		data: "acao=escolaPorId&id="+idEscola,
		dataType: "json",
		success: function(d) {
			viewEscolaSelected(d);
			carregarGrafico(getDadosUsuario());
		}		
	});
}

function abrirEdicaoGrupo(idProfessor) {
	$("#criarGrupoContainer").show();
	$("#conteudoPrincipal").hide();
	$('#alunosContainer').html("Carregando...");
	$.ajax({
		url: "ajax/SerieAjax.php",
		data: {	'acao' : 'listarDisponiveisProfessor',
				'idProfessor' : idProfessor},
		dataType: "json",
		success: function(dataSeries) {
			var htmlSeries = "";
			for (var i = 0; i < dataSeries.length; i++)
				htmlSeries += '<option value="'+dataSeries[i].id+'">'+dataSeries[i].serie+'ª Série</option>';
			$('#grp_serie').html(htmlSeries);
			carregarPeriodosSerie(idProfessor);
		}
	});
	$('#grp_serie').change(function() {
		$('#alunosContainer').html("Carregando...");
		carregarPeriodosSerie(idProfessor);
	});

}

function carregarPeriodosSerie(idProfessor) {
	$('#grp_periodo').html('<option>Carregando...</option>');
	$.ajax({
		url: "ajax/PeriodoAjax.php",
		data: {	'acao' : 'listarDisponiveisProfessorSerie',
				'idProfessor' : idProfessor,
				'serie' : $('#grp_serie').val()},
		dataType: "json",
		success: function(dataPeriodos){
			var htmlPeriodos = "";
			for (var i = 0; i < dataPeriodos.length; i++){
				htmlPeriodos += '<option value="'+dataPeriodos[i].id+'">'+dataPeriodos[i].periodo+'</option>'
			}
			$('#grp_periodo').html(htmlPeriodos);
			carregarAluno();
			$('#grp_periodo').change(function() {
				carregarAluno();
			})
		}
	});
}

function carregarAluno() {
	$.ajax({
		url: "ajax/UsuarioAjax.php",
		data: {	'acao' : 'buscaAlunoSemGrupoBySerieEscola',
				'serie' : $('#grp_serie').val(),
				'idEscola' : $('#escola_id').attr('id_escola')},
		dataType: 'json',
		success: function(dataAlunos){
			var htmlAlunos = '';
			for (var i = 0; i < dataAlunos.length; i++){
				htmlAlunos += 	'<input name="usr_id" value="'+dataAlunos[i].idVariavel+'" type="checkbox" class="aluno_grupo" id="aluno_'+dataAlunos[i].idUsuario+'">';
				htmlAlunos += 	'<label for="aluno_'+dataAlunos[i].idUsuario+'" class="checkbox-list-item checkbox-block">';
				htmlAlunos += 		'<img src="'+dataAlunos[i].imagem+'">';
				htmlAlunos += 		dataAlunos[i].nome;
				htmlAlunos += 	'</label>';
			}
			$('#alunosContainer').html(htmlAlunos);
		}
	});
}

function botoesGrupo() {
	$('#cancelarGrupo').click(function() {
		$('#grp_periodo').html('<option>Carregando...</option>');
		$('#grp_serie').html('<option>Carregando...</option>');
		$("#criarGrupoContainer").hide();
		$("#conteudoPrincipal").show();
	});

	$('#salvarGrupo').click(function(e) {
		e.preventDefault();
		adicionarAlunosGrupo();
	});
}

function adicionarAlunosGrupo() {
	 var alunos = "";
	$('.aluno_grupo:checked').each(function() {
		if (alunos === "")
			alunos = "(" + $(this).val();
		else
			alunos += ", " + $(this).val();
	});
	alunos += ")";
	$.ajax({
		url: "ajax/RelatoriosAjax.php",
		data: {	'acao' : 'adicionarGrupoProfessorSeriePeriodo',
				'alunos' : alunos,
				'idProfessor' : $('#professor_id').attr('id_professor'),
				'serie' : $('#grp_serie').val(),
				'periodo' : $('#grp_periodo').val()},
		type: "POST",
		success: function() {
		}
	});

	$('#tipoMensagem').removeClass();
    $('#tipoMensagem').addClass("sucesso");
    $("#modalTexto").html('Alunos atribuidos ao grupo!');
    $('.modal').show();
    $('.modal-backdrop').show();
    $('#cancelarGrupo').trigger('click');
}

function botaoModal() {
	$('.botao_modal').click(function(){
        hideModal();
    });
}

function hideModal(){
    $('.modal-backdrop').hide();
    $('.modal').hide();
}