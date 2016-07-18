var atividades;

$(document).ready(function (){
	posicionarBolinhas();
    atribuirEventos();

	var contador = 0;
	verificaExercicio();

	var url   = window.location.search.replace("?", "");
	var items = url.split("=");
	var capitulo = parseInt(items[1]);
	var ano = 0;
	if(items[0] == 'ano'){
		ano = parseInt(items[1]);
		capitulo = parseInt(url.split("&")[1].split("=")[1]);
	}

	if (usuario.perfil == 1)
		carregarAtividadesAluno(capitulo, ano);
	else
		carregarAtividades(capitulo, ano);


    $("#objeto").load(atualizarPercursoCapitulo);
});

function carregarAtividadesAluno (capitulo, ano) {
	$.ajax({
    	url: 'ajax/ExerciciosAjax.php',
    	data: {	'acao' : 'verificaExercicio', 'capitulo' : capitulo },
    	dataType: 'json',
    	success: function(d) {
            atividades = d;
    		for (var i = 0; i < d.length; i++){
    			if (d[i].completo == "N") {
    				$('#obj_'+d[i].id_exercicio).attr('pathObjeto', 'Objetos/'+ano+'ano/'+capitulo+'capitulo/'+d[i].nome_exercicio.trim()+'/index.html');

    				$('#obj_'+d[i].id_exercicio).click(function(){
                        console.log(this);
    					$('#objeto').attr('src', $(this).attr('pathObjeto')).css({'display':'block'});

						risizeObj();
					});

    				break;
    			} else {
    				$('#obj_'+d[i].id_exercicio).css('background', 'url("img/circulo_parabens.png") no-repeat');
    				$('#obj_'+d[i].id_exercicio).attr('pathObjeto', 'Objetos/'+ano+'ano/'+capitulo+'capitulo/'+d[i].nome_exercicio.trim()+'/index.html');

    				$('#obj_'+d[i].id_exercicio).click(function(){
                        console.log(this);
    					$('#objeto').attr('src', $(this).attr('pathObjeto')).css({'display':'block'});

						risizeObj();
					});
    			}
    		}
    	}
    });
}

function carregarAtividades (capitulo, ano) {
	$.ajax({
		url: 'ajax/ExerciciosAjax.php',
    	data: {	'acao' 		: 'exercicioSerieCapitulo',
    			'capitulo'	: capitulo,
    			'serie'		: ano},
    	dataType: 'json',
    	success: function(d) {
            console.log(d);
    		for (var i = 0; i < d.length; i++){
    			$('#obj_'+d[i].exe_id).attr('pathObjeto', 'http://187.73.149.26:8080/Objetos/'+ano+'ano/'+capitulo+'capitulo/'+d[i].exe_nome.trim()+'/index.html');
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
    	    success: function (data)
    	    {
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
		var pos = curvaExercicios.getRelativePosition(i*1/($(".obj_icone").length-1));

		$(".obj_icone")[i].style.left = pos[0] + "px";
		$(".obj_icone")[i].style.bottom = pos[1] + "px";
	}
}

function isCapituloFinalizado() {
    var bolinhas = document.querySelectorAll(".obj_icone");

    for (var i = 0; i < bolinhas.length; i++) {
        if (bolinhas[i].style.background.includes("img/circulo_avancar_cap_1.png")) {
            return false;
        }
    }

    return true;
}

function atualizarPercursoCapitulo() {
    var bolinhas = document.querySelectorAll("#caminho .obj_icone");

    for (var i = 0; i < bolinhas.length; i++) {
        if (bolinhas[i].style.background.includes("img/circulo_avancar_cap_1.png")) {
            bolinhas[i].style.background = "url(img/circulo_parabens.png) no-repeat";
            break;
        }
    }

    if (isCapituloFinalizado()) {
        console.info("Capítulo finalizado");
    } else {
        console.info("Capítulo não finalizado");
    }
}

function atribuirEventos() {
}