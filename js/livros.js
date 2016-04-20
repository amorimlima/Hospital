$(document).ready(function (){
    var url = window.location.href;
	var retorno = url.split("/"); 	
	retorno = retorno[retorno.length-1].split("?");

	var serie = "";

	if(typeof retorno[1] == "undefined"){
		serie = 'ano_'+usuario.serie;
	}else{
		serie = retorno[1];
	}

	var obj='';
	switch (serie){
		case 'ano_1':
			cap_ano = 'ano=1';
			$('#img_teste').attr('src','img/abertura_Ca.png');
			$('#img_teste').attr("style","height: 591px;")
		break;
		case 'ano_2':
			cap_ano = 'ano=2';
			$('#img_teste').attr('src','img/abertura_Ca.png');
			$('#img_teste').attr("style","height: 591px;")
		break;
		case 'ano_3':
			cap_ano = 'ano=3';
			$('#img_teste').attr('src','img/abertura_Cab.png');
			$('#img_teste').attr("style","height: 591px;")
		break;
		case 'ano_4':
			cap_ano = 'ano=4';
			$('#img_teste').attr('src','img/abertura_Cab.png');
			$('#img_teste').attr("style","height: 591px;")
		break;
		case 'ano_5':
			cap_ano = 'ano=5';
			$('#img_teste').attr('src','img/abertura_Cab.png');
			$('#img_teste').attr("style","height: 591px;")
		break;
	}
	$('.cap_1').attr('href','capitulos.php?'+cap_ano+"&capitulo=1");
	$('.cap_2').attr('href','capitulos.php?'+cap_ano+"&capitulo=2");
	$('.cap_3').attr('href','capitulos.php?'+cap_ano+"&capitulo=3");
	$('.cap_4').attr('href','capitulos.php?'+cap_ano+"&capitulo=4");
	$('.cap_5').attr('href','capitulos.php?'+cap_ano+"&capitulo=5");
});