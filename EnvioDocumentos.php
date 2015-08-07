<?php
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/EnvioDocumento.js"></script>
<title>Page Title</title>
</head>
<body>

    <form method="post" action="recebe_upload.php" enctype="multipart/form-data">
        <label>Arquivo</label>
        <input id="enviarDocumentos" type="file" name="arquivo" />
        <input  onclick="enviarFuncao()" type="submit" value="Enviar" />
    </form>
 
</body>
</html>
        
