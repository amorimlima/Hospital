$(document).ready(function (){
    var url = window.location.href;
	var retorno = url.split("/"); 	
	retorno = retorno[4].split("?"); 
	
	var obj='';
	switch (retorno[1]){
		case 'ano_1':
			cap_ano = 'ano_1';
		break;
		case 'ano_2':
			cap_ano = 'ano_2';
		break;
		case 'ano_3':
			cap_ano = 'ano_3';
		break;
		case 'ano_4':
			cap_ano = 'ano_4';
		break;
		case 'ano_5':
			cap_ano = 'ano_5';
		break;
	} 
	$('.cap_5').attr('href','capitulos.php?'+cap_ano);
});
       