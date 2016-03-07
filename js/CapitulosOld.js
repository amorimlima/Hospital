$(document).ready(function (){
    var url = window.location.href;
	var retorno = url.split("/"); 	
	retorno = retorno[4].split("?");
	retorno = retorno[1].split("_");
	var ano = retorno[1];
	var livro;

	if (retorno.length < 3)
	{
		livro = 1;
	}
	else
	{
		livro = retorno[3];
	}

	var livroPath = "HCB_" + ano + "o_" + livro + "cap/";

	var objList;

	$.ajax({
		url: "Objetos/" + livroPath + "key.json",
		async: false,
		'dataType': "json",
		success: function (data) {
            objList = data;
        }
	});

	obj = 	livroPath + objList[0];
	var qtd_total_obj = objectLength(objList);

	var htmlObjetivos = "";

	for (var i = 0; i < objectLength(objList); i++)
	{
		htmlObjetivos += "<span id='" + livroPath 	+ objList[i] + "' class='tema obj_icone obj_icone" + qtd_total_obj + "_" + (i+1) + "'></span>"
	}

	$("#linha_atividade").html(htmlObjetivos);
	

	$('#objeto').attr('src','Objetos/'+obj+'/index.html').css({'display':'block'});
	
	var contador = 0;
	$('.tema').click(function(){
		var classe = $(this).attr('class');		
		classe = classe.split(" ");
		$('.'+classe[2]).addClass('obj_icone_ativo');	
		contador ++;
		if(contador==qtd_total_obj){
			$('#btn_exercicio_5_parabens').css('display','none');
			$('#btn_exercicio_5_parabens_brilho').css('display','block');
		}

		var idTema = $(this).attr('id');
		$('#img_teste').css('display','none'); 
		$('#objeto').attr('src','Objetos/'+idTema+'/index.html').css({'display':'block'}); 
		risizeObj();

	});
});

function objectLength (object) {
	var key, count = 0;

	for(key in object)
	  if(object.hasOwnProperty(key))
	    count++;

	return count;
}