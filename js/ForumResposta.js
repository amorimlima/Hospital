$(document).ready(function (){
    $('#btn_responder').click(function(){
		$(this).css('display','none');
		$('#campo_resp').css('display','block');
	});
        
    $("#box_Respostas").mCustomScrollbar({
        axis:"y", // vertical and horizontal scrollbar
	scrollButtons:{
            enable:true
	}
    });
    
    $("#box_result_pesquisa").mCustomScrollbar({
        axis:"y", // vertical and horizontal scrollbar
	scrollButtons:{
            enable:true
	}
    });
    
});