<?php

require_once /* $_SESSION['BASE_URL'] */'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'DocumentosController.php');
include_once($path['controller'] . 'DocumentoEnvioController.php');
include_once($path['controller'] . 'DocumentoRetornoController.php');
include_once($path['beans'] . 'Documento.php');
include_once($path['beans'] . 'DocumentoEnvio.php');
include_once($path['beans'] . 'DocumentoRetorno.php');
include_once($path['funcao'] . 'DatasFuncao.php');

$documentosController = new DocumentoController();
$documentosEnvioController = new DocumentoEnvioController();

$maxSize = 30000000; //Tamanho máximo de arquivo 30Mb

switch ($_REQUEST['acao']) {
	case 'postDocumento': {
        $documento = new Documento();
        $documento->setDoc_assunto($_REQUEST['assunto']);
        $documento->setDoc_descricao($_REQUEST['descricao']);
        $retorno = [];

        $nomeArquivo = "_" . md5(uniqid(rand(), true)) . '.' . pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        $arquivoTemporario = $_FILES["arquivo"]["tmp_name"];

        if (filesize($arquivoTemporario) > $maxSize) {
            $retorno["erro"] = true;
            $retorno["mensagem"] = "O tamanho do arquivo excede o limite (30mb)";
        } else {
            move_uploaded_file($arquivoTemporario, $path["documentos"].$nomeArquivo);
            $documento->setDoc_documento("arquivos_galeria/".$nomeArquivo);

            try {
                $doc_id = $documentosController->insert($documento);
                $retorno["erro"] = false;
                $retorno["mensagem"] = "Arquivo enviado com sucesso";
                $retorno["documento"] = intval($doc_id);
            } catch (Exception $e) {
                $retorno["erro"] = true;
                $retorno["mensagem"] = "Ocorreu um erro ao enviar o arquivo: ".$e->getMessage();
            }
        }

        echo json_encode($retorno);

		break;
    }

	case 'postEnvio': {
		$documento    = $_REQUEST['documento'];
		$destinatario = $_REQUEST['destinatario'];
		$retorno      = $_REQUEST['retorno'];

		$documentoEnvio = new DocumentoEnvio();
		$documentoEnvio->setDoe_documento($documento);
		$documentoEnvio->setDoe_destinatario($destinatario);
		$documentoEnvio->setDoe_retorno($retorno);

		$documentoEnvioController->insert($documentoEnvio);

		break;
    }

    case 'postRetorno': {
        $documento  = $_REQUEST['documento'];
        $remetente  = $_REQUEST['remetente'];
        $envio      = $_REQUEST['envio'];

        $documentosRetorno = new DocumentoRetorno();
        $documentosRetorno->setDor_documento($documento);
        $documentosRetorno->setDor_remetente($remetente);
        $documentosRetorno->setDor_envio($envio);

        $documentoRetornoController->insert($documentosRetorno);

        break;
    }
}
?>