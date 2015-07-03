<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'Evento.php');
include_once($path['controller'].'EventoController.php');
include_once($path['sys'].'Nav/Navigator.php');
$cidade = $_SESSION['CIDADE'];		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Categoria</title> 
<link href="../../../css/jquery.tabs-ie.css" rel="stylesheet" type="text/css" />
</head>
<body id="adm">
	<div id="topo"></div>
    <div id="menu">
    	<ul>
        	<li><a href="../categoria/categoria.php">Categoria</a></li>
            <li><a href="evento.php">Eventos</a></li>
            <li><a href="../galeria/galeriaFotos.php"> Galeria de Fotos</a></li>
            <li><a href="../patrocinio/patrocinio.php">Patrocinios</a></li>
            <li><a href="../pontoTuristico/pontoTuristico.php">Ponto Turístico</a></li>
            <li><a href="../mapa/mapa.php">Mapa</a></li>
            <li><a href="../../Auth/doLogout.php">Sair</a></li>
        </ul>
    </div>
	<div id="corpo">
   	<p><a href="novoEvento.php">Cadastrar novo Evento</a></p>   
   <?php    		
   		$eventoController = new EventoController();	  
	   	$listaEvento = $eventoController->selectAllEventoByCidadePainel($cidade);
		echo '<table border="0" cellspacing="2" cellpadding="2">
			  		<td align="center" width="500" bgcolor="#FFCC99">EVENTO</td>
					<td align="center"  width="95" bgcolor="#FFCC99">DATA</td>
					<td align="center"  width="62" bgcolor="#FFCC99">FOTOS</td>
					<td width="68" bgcolor="#FFCC99"></td>
					<td width="68" bgcolor="#FFCC99"></td>';
		$i=0;
		foreach ($listaEvento as $evento)
		{
			if($i % 2 ){
	   			$bgcolor = "#FFDDBB";
	   		}else{
				$bgcolor = "#FFE6CC";   
	   		}	  				
			echo'<tr>
					<td width="500" bgcolor="'.$bgcolor.'">'.$evento->getTituloEvento().'</td>
					<td align="center" width="95" bgcolor="'.$bgcolor.'">'.$evento->getDataEvento().'</td>
					<td width="62" bgcolor="'.$bgcolor.'"><a href="fotoEventos.php?id='.$evento->getIdEvento().'" class="fotos"></a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="editarEvento.php?id='.$evento->getIdEvento().'" class="editar">EDITAR</a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="doExcluirEventoExe.php?id='.$evento->getIdEvento().'" class="excluir">EXCLUIR</a></td>
       		 	</tr>';
			$i++;	
		} 
		echo '</table>';
   ?>
</div>        
</div>	 
</body>
</html>