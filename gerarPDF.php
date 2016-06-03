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
$str = $_SERVER['QUERY_STRING'];
$file = file_get_contents("http://localhost:8080/Hospital/pesquisa_pdf.php?".$str);

$dompdf->load_html($file);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$arquivo = $dompdf->output("arquivo.pdf", array("Attachment" => true));
$rand = rand(1,500);
$rand2 = rand(1,500);
$nomeCrip = md5("arquivo".$rand.$rand2);

if($arquivo){
	file_put_contents($path['arquivos'].$nomeCrip.'.pdf',$arquivo);

	$env = new EnvioDocumento();
    $env->setEnv_idEscola($_SESSION['idEscolaPre']);
    $env->setEnv_idRemetente(1);
    $env->setEnv_idDestinatario(4);
    $env->setEnv_url($nomeCrip.'.pdf');
    $env->setVisto(0);

	$envioDocumentoControler->insert($env);

	echo json_encode(["status" => "Arquivo gerado com sucesso"]);
} else {
	throw new Exception("Ocorreu um erro ao gerar o arquivo pdf.");
}

?>