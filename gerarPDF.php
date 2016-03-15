<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';


if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];

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
file_put_contents($path['arquivos'].$nomeCrip.'.pdf',$arquivo);

echo '
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			var html = $("html").html();
			window.open("gerarPDF.php?html=" + html, "_blank");
			window.close();
		});
	</script>';

?>