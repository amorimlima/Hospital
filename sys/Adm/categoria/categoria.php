<?php 
session_start();
$paths = $_SESSION['PATH_SYS'];
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
        	<li><a href="categoria.php">Categoria</a></li>
            <li><a href="../evento/evento.php">Eventos</a></li>
            <li><a href="../galeria/galeriaFotos.php"> Galeria de Fotos</a></li>
            <li><a href="../patrocinio/patrocinio.php">Patrocinios</a></li>
            <li><a href="../pontoTuristico/pontoTuristico.php">Ponto Turístico</a></li>
            <li><a href="../mapa/mapa.php">Mapa</a></li>
            <li><a href="../../Auth/doLogout.php">Sair</a></li>
        </ul>
    </div>
	<div id="corpo">
        <?php 
		if (!isset($_GET['pagina']) ){
			echo "
				<p><a href=\"categoria.php?pagina=gastronomia\">Gastrônomia</a></p>
            	<p><a href=\"categoria.php?pagina=ondeficar\">Onde Ficar</a></p>
            	<p><a href=\"categoria.php?pagina=atrativos\">Atrativos Turísticos</a></p>
           	 	<p><a href=\"categoria.php?pagina=lazer\">Lazer e Entretenimento</a></p>
            	<p><a href=\"categoria.php?pagina=artesanatos\">Artesanatos</a></p>
            	<p><a href=\"categoria.php?pagina=ondecomprar\">Onde Comprar</a></p>			
			";
		}else{
		$pagina = $_GET['pagina']; 
			switch($pagina)
			{
				case 'gastronomia':
					include('gastronomia.php');
				break;
				case 'ondeficar': 
					include('ondeficar.php'); 
				break;
				break;
				case 'atrativos': 
					include('atrativos.php'); 
				break;
				break;
				case 'lazer': 
					include('lazer.php'); 
				break;
				break;
				case 'artesanatos': 
					include('artesanatos.php'); 
				break;
				case 'ondecomprar': 
					include('ondecomprar.php'); 
				break;
			}
		}
		?>	          
		</div>
        
</div>	 
</body>
</html>