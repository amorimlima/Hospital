$(document).ready(function (){
    $('#select_text').click(function(){
       $('#box_select').toggle(); 
    });
    
    $('.selecionado').click(function(){
       var selecionado = $(this).text(); 
       var id_selecionado = $(this).attr('id');
       $('#select_text').val(selecionado);
       $('#box_select').hide();
    });    
});
        
       