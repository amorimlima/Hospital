<?php

require_once /* $_SESSION['BASE_URL'] */'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'DocumentoController.php');
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
	case 'postDocumento':
		$assunto = $_REQUEST['assunto'];
        $descricao = $_REQUEST['descricao'];

        $_SESSION["cadastro"] = "";

        $documento = new Documento();
        $documento->setDoc_assunto($assunto);
        $documento->setDoc_descricao($descricao);

        $nomeArquivo = "_".md5(uniqid(rand(),true)).'.'.pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];

        $local = $path['documentos'];

        if (filesize($arquivo_temporario) > $maxSize)
        {
            $_SESSION['cadastro'] = "excedeu";
        }
        else
        {
            move_uploaded_file($arquivo_temporario, $local.$nomeArquivo);
            $arquivo = $local.$nomeImage;
        }

        if (!$_SESSION['cadastro'] == "excedeu")
        {
            $documento->setDoc_arquivo("documentos/".$nomeArquivo);
            $result = $documentosController->insertDocumentos($documento);
            echo $result;
            $_SESSION['cadastro'] = "ok";
        }

		break;
	
	case 'postEnvio':
		$documento    = $_REQUEST['documento'];
		$destinatario = $_REQUEST['destinatario'];
		$retorno      = $_REQUEST['retorno'];
        $feedback     = ["envios" => []];

        $destinatario = explode(',',$destinatario);

        for ($i = 0; $i < count($destinatario); $i++) {
            $documentoEnvio = new DocumentoEnvio();
            $documentoEnvio->setDoe_documento($documento);
            $documentoEnvio->setDoe_destinatario($destinatario[$i]);
            $documentoEnvio->setDoe_retorno($retorno);

            $documentosEnvioController->insertParcial($documentoEnvio);
        }
        echo 1;

		break;

    case 'postRetorno':
        $documento  = $_REQUEST['documento'];
        $remetente  = $_REQUEST['remetente'];
        $envio      = $_REQUEST['envio'];

        $documentosRetorno = new DocumentoRetorno();
        $documentosRetorno->setDor_documento($documento);
        $documentosRetorno->setDor_remetente($remetente);
        $documentosRetorno->setDor_envio($envio);

        $documentoRetornoController->insertParcial($documentosRetorno);

        break;

    // case 'getDocumento':

    //     if(isset($_REQUEST['id']))
    //         $result = $documentoController->listarkey($_REQUEST['id']);
    //         echo json_encode($result);

    //     else
    //         $result = $documentoController->listarTodos();
    //         echo json_encode($result);

    //     break;

    case 'getEnvio':

        if(isset($_REQUEST['id'])){
            $result = $documentoEnvioController->selectByIdDocumentoEnvio($_REQUEST['id']);
            echo json_encode($result);
        }

        else{
            $result = $documentoEnvioController->selectAllDocumentoEnvio();
            echo json_encode($result);
        }

        break;

    case 'getRetorno':

        if(isset($_REQUEST['id'])){
            $result = $documentoRetornoController->selectByIdDocumentoRetorno($_REQUEST['id']);
            echo json_encode($result);
        }

        else{
            $result = $documentoRetornoController->selectAllDocumentoRetorno();
            echo json_encode($result);
        }

        break;

    case 'getEnvioEscola':

        $result = $documentoEnvioController->listarEscola($_REQUEST['idEscola']);
        echo json_encode($result);

        break;

    case 'getRetornoEscola':

        $result = $documentoRetornoController->listarEscola($_REQUEST['idEscola']);
        echo json_encode($result);

        break;
}
?>