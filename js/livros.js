$(document).ready(function (){
    var url = window.location.href;
	var retorno = url.split("/"); 	
	retorno = retorno[4].split("?"); //local
	//retorno = retorno[3].split("?"); //servidor
	
	var obj='';
	switch (retorno[1]){
		case 'ano_1':
			cap_ano = 'ano_1';
			$('#img_teste').attr('src','img/abertura_Ca.png');
		break;
		case 'ano_2':
			cap_ano = 'ano_2';
			$('#img_teste').attr('src','img/abertura_Ca.png');
		break;
		case 'ano_3':
			cap_ano = 'ano_3';
			$('#img_teste').attr('src','img/abertura_Cab.png');
		break;
		case 'ano_4':
			cap_ano = 'ano_4';
			$('#img_teste').attr('src','img/abertura_Cab.png');
		break;
		case 'ano_5':
			cap_ano = 'ano_5';
			$('#img_teste').attr('src','img/abertura_Cab.png');
		break;
	} 
	$('.cap_5').attr('href','capitulos.php?'+cap_ano);
});
       