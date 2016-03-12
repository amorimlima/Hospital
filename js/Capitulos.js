$(document).ready(function (){
	posicionarBolinhas();	

	var contador = 0;
	var qtd_total_obj = 

	verificaExercicio();

	$('.tema').click(function(){
		var classe = $(this).attr('class');		
		classe = classe.split(" ");
		$('.'+classe[2]).addClass('obj_icone_ativo');	
		
		var id = $(this).attr('id');
		var idTema = $(this).attr('url');
		var qtd_total_obj = $('#'+id).attr('qtd');

		contador ++;
		if(contador==qtd_total_obj){
			$('#btn_exercicio_5_parabens').css('display','none');
			$('#btn_exercicio_5_parabens_brilho').css('display','block');
		}

		
		$('#img_teste').css('display','none'); 
		$('#objeto').attr('src','Objetos/'+idTema+'/index.html').css({'display':'block'}); 

		console.log(idTema);

		risizeObj();

	});
});

function verificaExercicio(){
	var url   = window.location.search.replace("?", "");
	var items = url.split("=");
	var capitulo = items[1];
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
        	console.log(data);
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
	var capitulo = items[1];
	var curvaExercicios = new Curva(parseInt(capitulo));

	for (var i = 0; i < $(".obj_icone").length; i++){
		var pos = curvaExercicios.getRelativePosition(i*1/($(".obj_icone").length-1));
		$(".obj_icone")[i].style.left = pos[0] + "px";
		$(".obj_icone")[i].style.bottom = pos[1] + "px";
	}
}