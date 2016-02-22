$(document).ready(function() {
	$("#tipo_grafico_picker").click(function() {
		$(this).toggleClass("picker_expanded");
	});
	$(".listagem_perfis_graficos").mCustomScrollbar({
		axis: "y",
		scrollButtons:{
			enable:true
		}
	});
});