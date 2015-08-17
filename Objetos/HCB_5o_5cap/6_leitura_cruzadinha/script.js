var fs;
var gamestate = 0;
var falaPratinha = 1;

var ajudaAtiv = false;

var Anterior1;
var Anterior2;

var inputText = document.getElementsByTagName('input');

var Corretos = [0,0,0,0,0,0,0,0];

var Direcoes = {
	'Um' : [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16],
	'Dois' : [28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43],
	'Tres' : [44,45,46,47,48],
	'Quatro' : [54,55,56,57,58,59,60,61],
	'A' : [0,17,20,25,32,44,51,55,64,67],
	'B' : [26,38,49,52,62,65,68,70],
	'C' : [21,23,27,43,50,53,63,66,69],
	'D' : [16,18,19,22,24]
};

 
 

window.onresize=function(){resize()};

// Botão confirmar
window.onload = function() {
	fs = 1;
	resize();
	initPratinha();
	
}


function initPratinha()
{
	
	UpFalas();
}

// Fullscreen
function reqFs() {
	switch (fs){
		case 1:
			document.getElementById('bt_Fs').style.backgroundImage = "url('img/bt_diminuir2.png')";
			launchIntoFullscreen(document.documentElement);
			fs = 0;
			break;
		case 0:
			document.getElementById('bt_Fs').style.backgroundImage = "url('img/bt_aumentar2.png')";
			exitFullscreen();
			fs = 1;
			break;
	}
}

function launchIntoFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}

function exitFullscreen() {
  if(document.exitFullscreen) {
    document.exitFullscreen();
  } else if(document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if(document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  }
}

// Ajuda
function chamarAjuda() {
	document.getElementById('telaAjuda').style.top = '277px';
	ajudaAtiv=true;
	$('#Cruzadinha_back').css('pointer-events','none');
	$('#pratinha_inativo').css('pointer-events','none');
	$('#pratinha_ativo').css('pointer-events','none');
}

function voltaAjuda() {
	document.getElementById('telaAjuda').style.top = '-250px';
	ajudaAtiv=false;
	$('#Cruzadinha_back').css('pointer-events','all');
	$('#pratinha_inativo').css('pointer-events','all');
	$('#pratinha_ativo').css('pointer-events','all');
}

function confirmar() {
	document.getElementById('bt_confirmar').style.right = '-100px';
	setTimeout (function() {window.location.href = '../7_Entrevista/index.html';}, 1000)
}

function TrocaFala()
{
	if(gamestate ==0)
	{
		if(falaPratinha == 6)
		{
			loadCruzadinha();
		}
		if(falaPratinha == 10)
		{
			$('#Dica').css('left','0px');
			$('#Cruzadinha_back').css('left','1024px');
		}

		if(falaPratinha < 12)
		{
			$('#Texto'+falaPratinha).css('opacity','0');
			$('#Texto'+(falaPratinha+1)).css('opacity','1');
			falaPratinha++;
		} else {
			$('#Dica').css('left','-1024px');
			$('#Cruzadinha_back').css('left','0px');
			DownFalas();
		}
	} else if(gamestate == 1)
	{
		if(falaPratinha < 14)
		{
			$('#Texto'+falaPratinha).css('opacity','0');
			$('#Texto'+(falaPratinha+1)).css('opacity','1');
			falaPratinha++;
		} else {
			DownFalas();
			setTimeout (function() {window.location.href = '../7_Entrevista/index.html';}, 1000)
		}
	}
}

function UpFalas()
{
	$('#pratinha_ativo').css('bottom','24px');
	for(var a=1; a<15; a++)
	{
		$('#Texto'+a).css('bottom','0px');
	}
	$('#pratinha_inativo').css('left','-100px');
	$('#bt_ajuda').css('pointer-events','none');
}

function DownFalas()
{
	$('#pratinha_ativo').css('bottom','-300px');
	for(var a=1; a<15; a++)
	{
		$('#Texto'+a).css('bottom','-324px');
	}
	if(gamestate == 0){$('#pratinha_inativo').css('left','25px');}
	$('#bt_ajuda').css('pointer-events','all');
}

function ClickedPratinhaInativo()
{
	if(gamestate == 0 ) 
	{
		$('#Texto'+falaPratinha).css('opacity','0');
		falaPratinha = 11;
		$('#Texto'+falaPratinha).css('opacity','1');
		$('#Dica').css('left','0px');
		$('#Cruzadinha_back').css('left','1024px');
	}

	UpFalas();
}

function loadCruzadinha()
{
	for(var a=0; a<ArrayLocais.length; a++)
	{
		for(var b=0; b<ArrayLocais[a].length;b++)
		{
			if(ArrayLocais[a][b] == 1)
			{
				document.getElementById('Cruzadinha_back').innerHTML += "<div class='containTextbox' style='top:"+((a*34.8)+191)+"px;left:"+((b*37)+119)+"px;'><input maxlength='1' type='text' /></div>";
			}
		}
	}

	var x = inputText;
	var inputList = Array.prototype.slice.call(inputText)

	for(var d=0; d<inputText.length; d++)
	{
		inputList[d].addEventListener("keypress",clearTextbox.bind(false, d),false);
		inputList[d].addEventListener("keypress",nextTextbox.bind(false, d),false);
		inputList[d].addEventListener("click",function(){Anterior2=0;Anterior1=0;});
	}

	window.setInterval(function(){ if(gamestate == 0){VerificaResposta();};},100);

}

function clearTextbox(numero)
{
	if(!inputText[numero].readOnly)
	{
		inputText[numero].value="";
	}
}

function nextTextbox(numero)
{
	console.log(numero);

	Anterior2 = Anterior1;
	Anterior1 = numero;

	
	for(var a=0; a< Direcoes.D.length-1; a++)
	{
		if(numero == Direcoes.D[a]){inputText[Direcoes.D[a+1]].focus();}
	}

	for(var a=0; a< Direcoes.C.length-1; a++)
	{
		if(numero == Direcoes.C[a]){inputText[Direcoes.C[a+1]].focus();}
	}


	for(var a=0; a< Direcoes.B.length-1; a++)
	{
		if(numero == Direcoes.B[a]){inputText[Direcoes.B[a+1]].focus();}
	}


	for(var a=0; a< Direcoes.A.length-1; a++)
	{
		if(numero == Direcoes.A[a]){inputText[Direcoes.A[a+1]].focus();}
	}


	for(var a=0; a< Direcoes.Quatro.length-1; a++)
	{
		if(Direcoes.Quatro[a] != 55)
		{
			if(numero == Direcoes.Quatro[a]){inputText[Direcoes.Quatro[a+1]].focus();}
		} else {
			if(Anterior2 != 51)
			{
				if(numero == Direcoes.Quatro[a]){inputText[Direcoes.Quatro[a+1]].focus();}
			}
		}
	}

	for(var a=0; a< Direcoes.Tres.length-1; a++)
	{
		if(Direcoes.Tres[a] != 44)
		{
			if(numero == Direcoes.Tres[a]){inputText[Direcoes.Tres[a+1]].focus();}
		} else {
			if(Anterior2 != 32)
			{
				if(numero == Direcoes.Tres[a]){inputText[Direcoes.Tres[a+1]].focus();}
			}
		}
	}


	for(var a=0; a< Direcoes.Dois.length-1; a++)
	{
		if(Direcoes.Dois[a] != 32 && Direcoes.Dois[a] != 38)
		{
			if(numero == Direcoes.Dois[a]){inputText[Direcoes.Dois[a+1]].focus();}
		} else {
			if(Anterior2 != 25 && Anterior2 != 26)
			{
				if(numero == Direcoes.Dois[a]){inputText[Direcoes.Dois[a+1]].focus();}
			}
		}
	}



	for(var a=0; a< Direcoes.Um.length-1; a++)
	{
		if(numero == Direcoes.Um[a]){inputText[Direcoes.Um[a+1]].focus();}
	}



	/*else{
		inputText[numero+1].focus();
	}*/
	
}



function VerificaResposta()
{

	var localUm ="";
	for(var a=0; a<Direcoes.Um.length; a++)
	{
		localUm+=inputText[(Direcoes.Um[a])].value;
	}

	var localDois ="";
	for(var a=0; a<Direcoes.Dois.length; a++)
	{
		localDois+=inputText[(Direcoes.Dois[a])].value;
	}

	var localTres ="";
	for(var a=0; a<Direcoes.Tres.length; a++)
	{
		localTres+=inputText[(Direcoes.Tres[a])].value;
	}

	var localQuatro ="";
	for(var a=0; a<Direcoes.Quatro.length; a++)
	{
		localQuatro+=inputText[(Direcoes.Quatro[a])].value;
	}

	var localA ="";
	for(var a=0; a<Direcoes.A.length; a++)
	{
		localA+=inputText[(Direcoes.A[a])].value;
	}

	var localB ="";
	for(var a=0; a<Direcoes.B.length; a++)
	{
		localB+=inputText[(Direcoes.B[a])].value;
	}

	var localC ="";
	for(var a=0; a<Direcoes.C.length; a++)
	{
		localC+=inputText[(Direcoes.C[a])].value;
	}

	var localD ="";
	for(var a=0; a<Direcoes.D.length; a++)
	{
		localD+=inputText[(Direcoes.D[a])].value;
	}

	

	var resUm = localUm.toUpperCase();
	if(resUm == "PROTETORAURICULAR"){Desabilitar('Um');}

	var resDois = localDois.toUpperCase();
	if(resDois == "ÓCULOSDEPROTEÇÃO" || resDois == "OCULOSDEPROTECAO"){Desabilitar('Dois');}

	var resTres = localTres.toUpperCase();
	if(resTres == "LUVAS"){Desabilitar('Tres');}

	var resQuatro = localQuatro.toUpperCase();
	if(resQuatro == "CAPACETE"){Desabilitar('Quatro');}

	var resA = localA.toUpperCase();
	if(resA == "PIOMOLHADO"){Desabilitar('A');}

	var resB = localB.toUpperCase();
	if(resB == "CORRIMÃO" || resB == "CORRIMAO"){Desabilitar('B');}

	var resC = localC.toUpperCase();
	if(resC == "ERGONOMIA"){Desabilitar('C');}

	var resD = localD.toUpperCase();
	if(resD == "RUÍDO" || resD == "RUIDO"){Desabilitar('D');}


	
}

function Desabilitar(Escolha)
{

	if(Escolha == 'Um')
	{
		for(var a=0; a<Direcoes.Um.length; a++)
		{
			inputText[(Direcoes.Um[a])].readOnly = true;
			inputText[(Direcoes.Um[a])].style.color = 'blue';
			Corretos[0] = 1;
		}
	}

	if(Escolha == 'Dois')
	{
		for(var a=0; a<Direcoes.Dois.length; a++)
		{
			inputText[(Direcoes.Dois[a])].readOnly = true;
			inputText[(Direcoes.Dois[a])].style.color = 'blue';


			Corretos[1] = 1;
		}

		inputText[28].value = "Ó";
		inputText[41].value = "Ç";
		inputText[42].value = "Ã";
	}

	if(Escolha == 'Tres')
	{
		for(var a=0; a<Direcoes.Tres.length; a++)
		{
			inputText[(Direcoes.Tres[a])].readOnly = true;
			inputText[(Direcoes.Tres[a])].style.color = 'blue';
			Corretos[2] = 1;
		}
	}

	if(Escolha == 'Quatro')
	{
		for(var a=0; a<Direcoes.Quatro.length; a++)
		{
			inputText[(Direcoes.Quatro[a])].readOnly = true;
			inputText[(Direcoes.Quatro[a])].style.color = 'blue';
			Corretos[3] = 1;
		}
	}

	if(Escolha == 'A')
	{
		for(var a=0; a<Direcoes.A.length; a++)
		{
			inputText[(Direcoes.A[a])].readOnly = true;
			inputText[(Direcoes.A[a])].style.color = 'blue';


			Corretos[4] = 1;
		}
	}

	if(Escolha == 'B')
	{
		for(var a=0; a<Direcoes.B.length; a++)
		{
			inputText[(Direcoes.B[a])].readOnly = true;
			inputText[(Direcoes.B[a])].style.color = 'blue';
			Corretos[5] = 1;
		}
		inputText[68].value = "Ã";
	}

	if(Escolha == 'C')
	{
		for(var a=0; a<Direcoes.C.length; a++)
		{

			inputText[(Direcoes.C[a])].readOnly = true;
			inputText[(Direcoes.C[a])].style.color = 'blue';

			Corretos[6] = 1;
		}
		
	}


	if(Escolha == 'D')
	{
		for(var a=0; a<Direcoes.D.length; a++)
		{

			inputText[(Direcoes.D[a])].readOnly = true;
			inputText[(Direcoes.D[a])].style.color = 'blue';

			Corretos[7] = 1;
		}
		
		inputText[19].value = "Í";
	}


	if(Corretos[0] == 1 && 
		Corretos[1] == 1 &&
		Corretos[2] == 1 &&
		Corretos[3] == 1 &&
		Corretos[4] == 1 &&
		Corretos[5] == 1 &&
		Corretos[6] == 1 &&
		Corretos[7] == 1)
	{
		gamestate = 1;
		$('#Texto'+falaPratinha).css('opacity','0');
		falaPratinha = 13;
		$('#Texto'+falaPratinha).css('opacity','1');
		UpFalas();
	}

}