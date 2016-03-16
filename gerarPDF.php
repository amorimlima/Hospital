<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';


if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'].'EnvioDocumentoController.php');
$envioDocumentoControler = new EnvioDocumentoController();

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
//$html = file_get_contents('pesquisa.php?'.$data;);

$dompdf->loadHtml("<html>".$_GET["html"]."</html>");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$arquivo = $dompdf->output("arquivo.pdf", array("Attachment" => true));

$rand = rand(1,100);
$nomeCrip = md5("arquivo".$rand);

if($arquivo){

	$env = new EnvioDocumento();
    $env->setEnv_idEscola(1);
    $env->setEnv_idRemetente(1);
    $env->setEnv_idDestinatario(4);
    $env->setEnv_url($nomeCrip.'pdf');
    $env->setVisto(0);

	$envioDocumentoControler->insert($env);
	file_put_contents($path['arquivos'].$nomeCrip.'.pdf',$arquivo);
}

echo '<script type="text/javascript">window.close();</script>';


?>