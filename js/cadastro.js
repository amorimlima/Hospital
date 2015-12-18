var tabs = $('.tab_cadastro');
var containers = $('.conteudo_tab');
var btns = $('.btns_tabs');

$(document).ready(function() {
	$('.conteudo_tab').mCustomScrollbar({
		axis:"y",
		scrollButtons:{
			enable:true
		}
	});

for ( var i = 0; i < tabs.length; i++ )
{
	$($(tabs).get(i)).click(function() {
		tabNavigation(this)
	});
}

tabNavigation(tabs[0]);

});

function tabNavigation(tabToShow)
{
	for ( var i = 0; i < tabs.length; i++ )
	{
		if ( tabs[i] == tabToShow )
		{
			$($(containers).get(i)).show();
			$($(btns).get(i)).show();

			$($(tabs).get(i)).addClass('tab_cadastro_ativo');
		}
		else
		{
			$($(containers).get(i)).hide();
			$($(btns).get(i)).hide();

			$($(tabs).get(i)).removeClass('tab_cadastro_ativo');
		}
	}
}