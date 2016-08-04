function getCapitulosByEscola(idEscola)
{
	$.ajax({
		url: "ajax/LiberarCapituloAjax.php",
		type: "GET",
		data: "acao=listar&id="+idEscola,
		dataType: "json",
		success: function(capitulos) {
			viewCapitulosLiberados(idEscola, capitulos);
		}
	});
};

function viewCapitulosLiberados(idEscola,capitulos)
{
	closeUserInfoModal();
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

function concluirLiberarCapitulos()
{
	$("#liberarCapitulos").show();
	$("#conteudoPrincipal").show();
	$("#liberarCapituloContainer").hide();
	$("#liberarCapituloContainer").empty();
};

function showLiberarCapitulos()
{
	$("#liberarCapitulos").hide();
	$("#conteudoPrincipal").hide();
	$("#liberarCapituloContainer").show();
};

function toggleCapitulo(idEscola, cap, livro)
{
	if (! $("[data-capitulo="+cap+"][data-livro="+livro+"]").hasClass("inativo")){
		if ($("[data-capitulo="+cap+"][data-livro="+livro+"]").is("[data-liberado=0]")) {
			liberarCapitulo(idEscola,cap,livro);
		} else if($("[data-capitulo="+cap+"][data-livro="+livro+"]").is("[data-liberado=1]")) {
			var idCap = $("[data-capitulo="+cap+"][data-livro="+livro+"]").attr("data-id");
			bloquearCapitulo(idCap, cap, livro);
		}
	}
	
};

function bloquearCapitulo(idCap,cap,livro)
{
	$.ajax({
		url: "ajax/LiberarCapituloAjax.php",
		type: "POST",
		data: "acao=deletar&id="+idCap,
		dataType: "json",
		beforeSend: function() {
			$('[data-livro = '+livro+'][data-capitulo = '+cap+']').addClass("inativo");
		},
		success: function(data) {
			console.info(data.mensagem);
			$("#mensagemSucessoDeletar").show();
			updateToggledCap("bloquear",null,cap,livro);
		},
		complete: function () {
			$('[data-livro = '+livro+'][data-capitulo = '+cap+']').removeClass("inativo");
		}
	});
};

function liberarCapitulo(idEscola,cap,livro)
{
	$.ajax({
		url: "ajax/LiberarCapituloAjax.php",
		type: "POST",
		data: "acao=liberar&escola="+idEscola+"&capitulo="+cap+"&livro="+livro,
		dataType: "json",
		beforeSend: function() {
			$('[data-livro = '+livro+'][data-capitulo = '+cap+']').addClass("inativo");
		}, 
		success: function(retorno) {
			$("#mensagemCapituloLiberado").show();
			updateToggledCap(retorno.acao,retorno.id,retorno.capitulo,retorno.livro);
		},
		complete: function() {
			$('[data-livro = '+livro+'][data-capitulo = '+cap+']').removeClass("inativo");
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