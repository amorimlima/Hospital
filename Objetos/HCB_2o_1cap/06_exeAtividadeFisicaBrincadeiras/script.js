var fs;
var gamestate = 0;
var falaPratinha = 1;

var ajudaAtiv = false;

var valido = false;

var Anterior1;
var Anterior2;

var inputText = document.getElementsByTagName('input');

var Corretos = [0,0,0,0,0,0];

var Direcoes = {
	'Um' : [10,11,12,13,14,15],
	'Dois' : [17,18,19,20,21,22,23,24,25],
	'Tres' : [27,28,29,30,31,32,33,34,35,36,37],
	'Quatro' : [41,42,43,44,45],
	'A' : [2,4,6,8,11,16,23,26,33,38,39,40,44],
	'B' : [0,1,3,5,7,9,15]
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

		if(falaPratinha < 2)
		{
			$('#Texto'+falaPratinha).css('opacity','0');
			$('#Texto'+(falaPratinha+1)).css('opacity','1');
			falaPratinha++;

		}
		else if(falaPratinha == 2 && !valido)
		{
			loadCruzadinha();
			DownFalas();
		} else if(falaPratinha == 2 && valido)
		{
			DownFalas();

		}

	} else if(gamestate == 1)
	{
		if(falaPratinha < 2)
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

		$('#Texto1').css('bottom','0px');
		$('#Texto2').css('bottom','0px');
	
	$('#pratinha_inativo').css('left','-100px');
	$('#bt_ajuda').css('pointer-events','none');
}

function DownFalas()
{
	$('#pratinha_ativo').css('bottom','-300px');

		$('#Texto1').css('bottom','-324px');
		$('#Texto2').css('bottom','-324px');
	
	if(gamestate == 0){$('#pratinha_inativo').css('left','25px');}
	$('#bt_ajuda').css('pointer-events','all');
}

function ClickedPratinhaInativo()
{
	if(gamestate == 0 ) 
	{
		$('#Texto'+falaPratinha).css('opacity','0');
		falaPratinha = 1;
		$('#Texto'+falaPratinha).css('opacity','1');
		//$('#Dica').css('left','0px');
		//$('#Cruzadinha_back').css('left','1024px');
	}

	UpFalas();
}

function loadCruzadinha()
{

	var numExemplos = 0;

	for(var a=0; a<ArrayLocais.length; a++)
	{
		for(var b=0; b<ArrayLocais[a].length;b++)
		{
			if(ArrayLocais[a][b] == 1)
			{
				document.getElementById('Cruzadinha_back').innerHTML += "<div class='containTextbox' style='top:"+((a*36.4)+121)+"px;left:"+((b*37)+283)+"px;'><input maxlength='1' type='text' /></div>";
			} else if (ArrayLocais[a][b] == 2)
			{
				document.getElementById('Cruzadinha_back').innerHTML += "<div class='containTextbox' style='top:"+((a*36.4)+121)+"px;left:"+((b*37)+283)+"px;'><input maxlength='1' type='text' readOnly='true' style='color:#3d7ace;' value='"+ValoresExemplos[numExemplos]+"' /></div>";
				numExemplos++;
			} else if (ArrayLocais[a][b] == 3)
			{
				document.getElementById('Cruzadinha_back').innerHTML += "<div class='containTextbox' style='top:"+((a*36.4)+121)+"px;left:"+((b*37)+283)+"px;'><input maxlength='1' type='text' readOnly='true' style='color:#3d7ace;' value='*' /></div>";
				numExemplos++;
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

	valido = true;

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

	window.setTimeout(function(){
		

		console.log(numero);

		Anterior2 = Anterior1;
		Anterior1 = numero;

		

		for(var a=0; a< Direcoes.B.length-1; a++)
		{
			if(numero == Direcoes.B[a]){inputText[Direcoes.B[a+1]].focus();}
		}


		for(var a=0; a< Direcoes.A.length-1; a++)
		{
			if(numero == Direcoes.A[a])
			{
				if(numero == 11)
				{

					inputText[Direcoes.A[a+2]].focus();
				} else {

					inputText[Direcoes.A[a+1]].focus();
				}
			}
		}


		for(var a=0; a< Direcoes.Quatro.length-1; a++)
		{

			if(Anterior2 != 40)
			{
				if(numero == Direcoes.Quatro[a]){inputText[Direcoes.Quatro[a+1]].focus();}
			}

		}

		for(var a=0; a< Direcoes.Tres.length-1; a++)
		{
			
			if(Anterior2 != 26)
			{
				if(numero == Direcoes.Tres[a])
				{
					if(Anterior2 == 31)
					{
						inputText[Direcoes.Tres[a+2]].focus();

					} else {

						inputText[Direcoes.Tres[a+1]].focus();
					}
				}
			}

		}


		for(var a=0; a< Direcoes.Dois.length-1; a++)
		{

			if(Anterior2 != 16 && Anterior2 != 11)
			{
				if(numero == Direcoes.Dois[a]){inputText[Direcoes.Dois[a+1]].focus();}
			}

		}



		for(var a=0; a< Direcoes.Um.length-1; a++)
		{

			if(Anterior2 != 8)
			{
				if(numero == Direcoes.Um[a]){inputText[Direcoes.Um[a+1]].focus();}
			}
			
		}


	},10);


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


	var resUm = localUm.toUpperCase();
	if(resUm == "PETECA"){Desabilitar('Um');}

	var resDois = localDois.toUpperCase();
	if(resDois == "BICICLETA"){Desabilitar('Dois');}

	var resTres = localTres.toUpperCase();
	if(resTres == "PULAR*CORDA"){Desabilitar('Tres');}

	var resQuatro = localQuatro.toUpperCase();
	if(resQuatro == "VOLEI" || resQuatro == "VÔLEI"){Desabilitar('Quatro');}

	var resA = localA.toUpperCase();
	if(resA == "PIQUE-ESCONDE"){Desabilitar('A');}

	var resB = localB.toUpperCase();
	if(resB == "CORRIDA"){Desabilitar('B');}


	
}

function Desabilitar(Escolha)
{

	if(Escolha == 'Um')
	{
		for(var a=0; a<Direcoes.Um.length; a++)
		{
			inputText[(Direcoes.Um[a])].readOnly = true;
			inputText[(Direcoes.Um[a])].style.color = '#3d7ace';
			Corretos[0] = 1;
		}
	}

	if(Escolha == 'Dois')
	{
		for(var a=0; a<Direcoes.Dois.length; a++)
		{
			inputText[(Direcoes.Dois[a])].readOnly = true;
			inputText[(Direcoes.Dois[a])].style.color = '#3d7ace';


			Corretos[1] = 1;
		}

	}

	if(Escolha == 'Tres')
	{
		for(var a=0; a<Direcoes.Tres.length; a++)
		{
			inputText[(Direcoes.Tres[a])].readOnly = true;
			inputText[(Direcoes.Tres[a])].style.color = '#3d7ace';
			Corretos[2] = 1;
		}
	}

	if(Escolha == 'Quatro')
	{
		for(var a=0; a<Direcoes.Quatro.length; a++)
		{
			inputText[(Direcoes.Quatro[a])].readOnly = true;
			inputText[(Direcoes.Quatro[a])].style.color = '#3d7ace';
			Corretos[3] = 1;
		}
	}

	if(Escolha == 'A')
	{
		for(var a=0; a<Direcoes.A.length; a++)
		{
			inputText[(Direcoes.A[a])].readOnly = true;
			inputText[(Direcoes.A[a])].style.color = '#3d7ace';


			Corretos[4] = 1;
		}
	}

	if(Escolha == 'B')
	{
		for(var a=0; a<Direcoes.B.length; a++)
		{
			inputText[(Direcoes.B[a])].readOnly = true;
			inputText[(Direcoes.B[a])].style.color = '#3d7ace';
			Corretos[5] = 1;
		}
	}



	if(Corretos[0] == 1 && 
		Corretos[1] == 1 &&
		Corretos[2] == 1 &&
		Corretos[3] == 1 &&
		Corretos[4] == 1 &&
		Corretos[5] == 1)
	{
		/*gamestate = 1;
		$('#Texto'+falaPratinha).css('opacity','0');
		falaPratinha = 3;
		$('#Texto'+falaPratinha).css('opacity','1');
		UpFalas();*/

		window.setTimeout(function() {window.location.href = '../07_posAtividadeFisicaBrincadeiras/index.html';}, 2000);
	}

}