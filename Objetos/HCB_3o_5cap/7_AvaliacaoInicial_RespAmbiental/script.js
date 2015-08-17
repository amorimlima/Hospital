var fs;

window.onresize=function(){resize()};

//Botão confirmar
window.onload = function() {
	setTimeout (function() {document.getElementById('bt_confirmar').style.right = '28px';},3000);
	fs = 1;
	resize();
}

/*
document.body.onload = function () {
	document.getElementById("container").style.display = "block";
    document.getElementById("preto").style.display = "none";

}*/

// Fullscreen
function reqFs() {
	switch (fs){
		case 1:
			document.getElementById('bt_Fs').style.backgroundImage = "url('img/bt_diminui.png')";
			launchIntoFullscreen(document.documentElement);
			fs = 0;
			break;
		case 0:
			document.getElementById('bt_Fs').style.backgroundImage = "url('img/bt_aumenta.png')";
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
}

function voltaAjuda() {
	document.getElementById('telaAjuda').style.top = '-250px';
}

function confirma() {
	document.getElementById('bt_confirmar').style.right = '-100px'
	setTimeout(function() {window.open("../7_avaliacao_inicial_pt_3/index.html","_self");}, 1000);
}