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
$documentoEnvioController = new DocumentoEnvioController();
$documentoRetornoController = new DocumentoRetornoController();

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
        $result = $documentoRetornoController->insertParcial($documentosRetorno);
        echo $result;

        break;

    // case 'getDocumento':

    //     if(isset($_REQUEST['id']))
    //         $result = $documentoController->listarkey($_REQUEST['id']);
    //         echo json_encode($result);

    //     else
    //         $result = $documentoController->listarTodos();
    //         echo json_encode($result);

    //     break;

    case "getDocumentosEnviados":
        $envios = $documentosController->selectDocumentosEnviados();
        $retorno = [];
        //foreach($envios["documento_envio"] as $envio) {
        foreach ($envios as $envio) {
            array_push($retorno, [
                "documento_envio" => [
                    "id" => intval($envio["documento_envio"]->getDoe_id()),
                    "data_envio" => DatasFuncao::dataTimeBRExibicao($envio["documento_envio"]->getDoe_data_envio()),
                    "visto" => $envio["documento_envio"]->getDoe_visto(),
                    "retorno" => intval($envio["documento_envio"]->getDoe_retorno()),
                    "documento" => [
                        "id" => intval($envio["documento_envio"]->getDoe_documento()->getDoc_id()),
                        "assunto" => utf8_encode($envio["documento_envio"]->getDoe_documento()->getDoc_assunto()),
                        "descricao" => intval($envio["documento_envio"]->getDoe_documento()->getDoc_descricao())
                    ]
                ],
                "verificadores" => $envio["verificadores"]
            ]);
        }

        echo json_encode($retorno);
    break;
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
        echo json_encode($result[0]);

        break;

    case 'getRetornoEscola':

        $result = $documentoRetornoController->listarEscola($_REQUEST['idEscola']);
        echo json_encode($result);

        break;

    case 'visualizarEnvio':
        $result = $documentoEnvioController->visualizar($_REQUEST['idEnvio']);
        echo json_encode($result);

        break;

    case 'visualizarRetorno':
        $result = $documentoRetornoController->visualizar($_REQUEST['idRetorno']);
        echo json_encode($result);

        break;

    case 'rejeitarRetorno':
        $result = $documentoRetornoController->rejeitar($_REQUEST['idRetorno']);
        echo json_encode($result);

        break;

    case 'enviosPorDocumento':

        $result = $documentoEnvioController->listarDocumento($_REQUEST['idDocumento']);
        echo json_encode($result);

        break;

    case 'retornosPorDocumentoDoEnvio':

        $result = $documentoRetornoController->listarDocumento($_REQUEST['idDocumento']);
        echo json_encode($result);

        break;

}
?>