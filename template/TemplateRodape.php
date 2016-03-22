<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

class TemplateRodape{
	public static $path;

	public function rodape() {
		echo '<div class="row" id="rodape"></div>';
		echo '<div class="murano"></div>';
	}
}
?>