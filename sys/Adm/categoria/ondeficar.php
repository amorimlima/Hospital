<?php 
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['beans'].'Categoria.php');
include_once($path['controller'].'CategoriaController.php');
include_once($path['sys'].'Nav/Navigator.php');
$cidade = $_SESSION['CIDADE'];
$id = $_GET["id"];		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listar Categoria</title> 
<link href="../../../css/jquery.tabs-ie.css" />
</head>
<body id="adm">
	<div id="corpo"> 
    <p><a href="novo_itemOndeFicar.php?categoria=<?php echo $_GET['pagina'];?>">Cadastrar novo Local</a></p>
    <?php    		
   		$categoriaController = new CategoriaController();	  
	   	$listaCategoria = $categoriaController->selectAllCategoriasByCidade($cidade,$_GET['pagina']);
		echo '<table border="0" cellspacing="2" cellpadding="2">
			  		<td width="260" align="center" bgcolor="#FFCC99">TÍTULO</td>
					<td width="260" align="center" bgcolor="#FFCC99">ENDEREÇO</td>
					<td width="80" align="center" bgcolor="#FFCC99">TELEFONE</td>
					<td width="68" align="center" bgcolor="#FFCC99"></td>
					<td width="68" align="center" bgcolor="#FFCC99"></td>';
		$i=0;
		foreach ($listaCategoria as $categoria)
		{
			if($i % 2 ){
	   			$bgcolor = "#FFDDBB";
	   		}else{
				$bgcolor = "#FFE6CC";   
	   		}	
			echo'<tr>
					<td width="260" bgcolor="'.$bgcolor.'">'.$categoria->getTituloCategoria().'</td>
					<td width="260" bgcolor="'.$bgcolor.'">'.$categoria->getEnderecoCategoria().'</td>
					<td width="150" bgcolor="'.$bgcolor.'">'.$categoria->getTelefoneCategoria().'</td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="editar_itemOndeFicar.php?id='.$categoria->getIdCategoria().'&categoria='.$_GET['pagina'].'"class="editar">EDITAR</a></td>
        			<td width="68" bgcolor="'.$bgcolor.'"><a href="doExcluirCategoriaExe.php?id='.$categoria->getIdCategoria().'" class="excluir">EXCLUIR</a></td>
       		 	</tr>';
				$i++;	
		} 
		echo '</table>';
   ?> 
    </div>
</div>
</body>
</html>