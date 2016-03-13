$(document).ready(function (){
	posicionarBolinhas();	

	var contador = 0;
	verificaExercicio();

	$('.tema').click(function(){	
		
		var idTema = $(this).attr('url');
		$('#objeto').attr('src','Objetos/'+idTema+'/index.html').css({'display':'block'});

		var url   = window.location.search.replace("?", "");
		var items = url.split("=");
		var capitulo = parseInt(items[1]);
		if(items[0] == 'ano'){
			items = url.split("&");
			capitulo = items[1].split("=")[1];
			$('.tema').css('background', 'url(img/circulo_avancar_cap_'+capitulo+'.png) no-repeat');
		}

    	$(this).css('background', 'url(img/circulo_parabens.png) no-repeat');


		risizeObj();

	});
});

function verificaExercicio(){
	var url   = window.location.search.replace("?", "");
	var items = url.split("=");
	var capitulo = parseInt(items[1]);
	if(items[0] != 'ano')
	{
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