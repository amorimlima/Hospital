<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

$path = $_SESSION['PATH_SYS'];

class TemplateCadastro
{	
	public function abasLaterais()
	{
		$logado = unserialize($_SESSION['USR']);

		switch ($logado["perfil_id"])
		{
			case 2:
				print '<nav role="navigation" class="area_tabs_cadastro">';
				print 	'<ul class="tabs_cadastro">';
				print 		'<li class="tab_cadastro tab_aluno"></li>';
				print 		'<li class="tab_cadastro tab_professor"></li>';
				print 		'<li class="tab_cadastro tab_escola tab_cadastro_inativo"></li>';
				print 	'</ul>';
				print '</nav>';
			break;
			case 3:
			case 4:
				print '<nav role="navigation" class="area_tabs_cadastro">';
				print 	'<ul class="tabs_cadastro">';
				print 		'<li class="tab_cadastro tab_aluno"></li>';
				print 		'<li class="tab_cadastro tab_professor"></li>';
				print 		'<li class="tab_cadastro tab_escola"></li>';
				print 	'</ul>';
				print '</nav>';
			break;
		}
	}
	public function botoesCadastro()
	{
		$logado = unserialize($_SESSION['USR']);

		switch ($logado["perfil_id"])
		{
			case 2:
				print '<section class="area_btns_tabs">';
				print     '<div class="btns_tabs btns_aluno">';
				print         '<ul class="lista_btns lista_btns_aluno">';
				print             '<li class="btn_tab btn_aluno btn_add_cadastro">Novo cadastro</li>';
				print             '<li class="btn_tab btn_aluno btn_update_cadastro btn_tab_ativo" id="update_cadastro">Atualizar cadastro</li>';
				print         '</ul>';
				print     '</div>';
				print     '<div class="btns_tabs btns_professor" style="display: none;">';
				print         '<ul class="lista_btns lista_btns_professor">';
				print             '<li class="btn_tab btn_professor btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>';
				print         '</ul>';
				print     '</div>';
				print '</section>';
			break;
			case 3:
				print '<section class="area_btns_tabs">';
				print     '<div class="btns_tabs btns_aluno">';
				print         '<ul class="lista_btns lista_btns_aluno">';
				print             '<li class="btn_tab btn_aluno btn_update_cadastro btn_tab_ativo" id="update_cadastro">Atualizar cadastro</li>';
				print         '</ul>';
				print     '</div>';
				print     '<div class="btns_tabs btns_professor" style="display: none;">';
				print         '<ul class="lista_btns lista_btns_professor">';
				print             '<li class="btn_tab btn_professor btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>';
				print         '</ul>';
				print     '</div>';
				print 	 '<div class="btns_tabs btns_escola" style="display: none;">';
				print 	 	'<ul class="lista_btns lista_btns_escola">';
				print 	 		'<li class="btn_tab btn_escola btn_confirm_cadastro">Pré-cadastros</li>';
				print 	 		'<li class="btn_tab btn_escola btn_add_cadastro">Novo cadastro</li>';
				print 	 		'<li class="btn_tab btn_escola btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>';
				print 	 	'</ul>';
				print 	 '</div>';
				print '</section>';
			break;
			case 4:
				print '<section class="area_btns_tabs">';
				print     '<div class="btns_tabs btns_aluno">';
				print         '<ul class="lista_btns lista_btns_aluno">';
				print             '<li class="btn_tab btn_aluno btn_add_cadastro">Novo cadastro</li>';
				print             '<li class="btn_tab btn_aluno btn_update_cadastro btn_tab_ativo" id="update_cadastro">Atualizar cadastro</li>';
				print         '</ul>';
				print     '</div>';
				print     '<div class="btns_tabs btns_professor" style="display: none;">';
				print         '<ul class="lista_btns lista_btns_professor">';
				print 			  '<li class="btn_tab btn_professor btn_add_cadastro">Novo cadastro</li>';
				print             '<li class="btn_tab btn_professor btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>';
				print         '</ul>';
				print     '</div>';
				print 	 '<div class="btns_tabs btns_escola" style="display: none;">';
				print 	 	'<ul class="lista_btns lista_btns_escola">';
				print 	 		'<li class="btn_tab btn_escola btn_update_cadastro btn_tab_ativo">Atualizar cadastro</li>';
				print 	 	'</ul>';
				print 	 '</div>';
				print '</section>';
			break;
		}
	}
}
?>