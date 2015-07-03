<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'PontoTuristico.php');
include_once($path['controller'].'PontoTuristicoController.php');
include_once($path['sys'].'Nav/Navigator.php');
$cidade = $_SESSION['CIDADE'];		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../../css/jquery.tabs-ie.css" rel="stylesheet" type="text/css" />
</head>
<body id="adm">
	<div id="topo"></div>
    <div id="menu">
    	<ul>
        	<li><a href="../categoria/categoria.php">Categoria</a></li>
            <li><a href="../evento/evento.php">Eventos</a></li>
            <li><a href="../galeria/galeriaFotos.php"> Galeria de Fotos</a></li>
            <li><a href="../patrocinio/patrocinio.php">Patrocinios</a></li>
            <li><a href="pontoTuristico.php">Ponto Turístico</a></li>
            <li><a href="../mapa/mapa.php">Mapa</a></li>
            <li><a href="../../Auth/doLogout.php">Sair</a></li>
        </ul>
    </div>
	<div id="corpo">
   	<p><a href="novoPontoTuristico.php">Cadastrar novo Ponto Turístico</a></p>   
   <?php    		
   		$pontoTuristicoController = new PontoTuristicoController();	  
	   	$listaPontoTuristico = $pontoTuristicoController->selectAllPontoTuristicoByCidade($cidade);
		echo '<table border="0" cellspacing="2" cellpadding="2">
			  		<td align="center" width="750" bgcolor="#FFCC99">PONTO TURÍSTICO</td>
					<td align="center"  width="62" bgcolor="#FFCC99">FOTOS</td>
					<td width="68" bgcolor="#FFCC99"></td>
					<td width="68" bgcolor="#FFCC99"></td>';
		$i=0;
		foreach ($listaPontoTuristico as $pontoTuristico)
		{
			if($i % 2 ){
					$bgcolor = "#FFDDBB";
				}else{
					$bgcolor = "#FFE6CC";   
				}	 				
			echo'<tr>
					<td width="750" bgcolor="'.$bgcolor.'">'.$pontoTuristico->getPontoTuristico().'</td>
					<td width="62" bgcolor="'.$bgcolor.'"><a href="fotoPontoTuristico.php?id='.$pontoTuristico->getIdPontoTuristico().'" class="fotos"></a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="editarPontoTuristico.php?id='.$pontoTuristico->getIdPontoTuristico().'" class="editar">EDITAR</a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="doExcluirPontoTuristicoExe.php?id='.$pontoTuristico->getIdPontoTuristico().'"  class="excluir">EXCLUIR</a></td>
       		 	</tr>';
		$i++;
		} 
		echo '</table>';
   ?>
</div>        
</div>	 
</body>
</html>