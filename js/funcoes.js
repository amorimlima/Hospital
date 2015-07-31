$(document).ready(function(e) {
	var largura = $('#objeto').width();
	var altura  = ( 74 * largura ) / 100;	
	$('#objeto').css('height', Math.round(altura+10) + 'px');
});
