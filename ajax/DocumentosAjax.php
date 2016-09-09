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

            $documentoEnvioController->insertParcial($documentoEnvio);
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
        echo '<pre>';
        echo json_encode($retorno);
    break;

    case 'getEnvio':

        if(isset($_REQUEST['id'])){
            $envio = $documentoEnvioController->selectByIdDocumentoEnvio($_REQUEST['id']);
            $retorno = array(
                    "id" => intval($envio->getDoe_id()),
                    "data_envio" => DatasFuncao::dataTimeBRExibicao($envio->getDoe_data_envio()),
                    "visto" => $envio->getDoe_visto(),
                    "retorno" => intval($envio->getDoe_retorno()),
                    "documento" => $envio->getDoe_documento()
                );

            echo json_encode($retorno);
        }

        else{
            $envios = $documentoEnvioController->selectAllDocumentoEnvio();
            $retorno = [];

            foreach ($envios as $envio) {
                array_push($retorno, [
                    "id" => intval($envio->getDoe_id()),
                    "data_envio" => DatasFuncao::dataTimeBRExibicao($envio->getDoe_data_envio()),
                    "visto" => $envio->getDoe_visto(),
                    "retorno" => intval($envio->getDoe_retorno()),
                    "documento" => $envio->getDoe_documento()
                    ]
                );
            }

            echo json_encode($retorno);
        }

        break;

    case 'getRetorno':

        if(isset($_REQUEST['id'])){
            $result = $documentoRetornoController->selectByIdDocumentoRetorno($_REQUEST['id']);
            $retorno = [
                "id" => $result->getDor_id(),
                "documento" => [
                    "id" =>  intval($result->getDor_documento()->getDoc_id()),
                    "assunto" => utf8_encode($result->getDor_documento()->getDoc_assunto()),
                    "descricao" => utf8_encode($result->getDor_documento()->getDoc_descricao()),
                    "arquivo" => $result->getDor_documento()->getDoc_arquivo()
                ],
                "remetente" => [
                    "id" => intval($result->getDor_remetente()->getEsc_id()),
                    "nome" => utf8_encode($result->getDor_remetente()->getEsc_nome())
                ],
                "envio" => [
                    "id" => intval($result->getDor_envio()->getDoe_id()),
                    "documento" => intval($result->getDor_envio()->getDoe_documento())
                ],
                "visto" => intval($result->getDor_visto()),
                "rejeitado" => intval($result->getDor_rejeitado()),
                "data" => DatasFuncao::dataTimeBRExibicao($result->getDor_data())
            ];

            echo json_encode($retorno);

        }else{
            $result = $documentoRetornoController->selectAllDocumentoRetorno();
            $retorno = [];
            
            foreach($result as $dor) {
                array_push($retorno, [
                    "id" => intval($dor->getDor_id()),
                    "documento" => intval($dor->getDor_documento()),
                    "remetente" => intval($dor->getDor_remetente()),
                    "envio" => intval($dor->getDor_envio()),
                    "visto" => intval($dor->getDor_visto()),
                    "rejeitado" => intval($dor->getDor_rejeitado())
                ]);
            }
            
            echo json_encode($retorno);
        }

        break;

    case 'getEnvioEscola':
        $result = $documentoEnvioController->listarEscola($_REQUEST['idEscola']);
        $retorno = [];
        
        
        foreach($result as $doe) {
            array_push($retorno, [
                "id" => intval($doe["documento_envio"]->getDoe_id()),
                "destinatario" => intval($doe["documento_envio"]->getDoe_destinatario()),
                "data_envio" => DatasFuncao::dataTimeBRExibicao($doe["documento_envio"]->getDoe_data_envio()),
                "visto" => intval($doe["documento_envio"]->getDoe_visto()),
                "retorno" => intval($doe["documento_envio"]->getDoe_retorno()),
                "documento" => [
                    "id" => intval($doe["documento_envio"]->getDoe_documento()->getDoc_id()),
                    "assunto" => utf8_encode($doe["documento_envio"]->getDoe_documento()->getDoc_assunto()),
                    "descricao" => utf8_encode($doe["documento_envio"]->getDoe_documento()->getDoc_descricao()),
                    "arquivo" => $doe["documento_envio"]->getDoe_documento()->getDoc_arquivo()
                ],
                "retorno_pendente" => intval($doe["verificadores"]["retorno_pendente"]),
                "retorno_rejeitado" => intval($doe["verificadores"]["retorno_rejeitado"])
            ]);
        }
        echo json_encode($retorno);

        break;

    case 'getRetornoEscola':

        $result = $documentoRetornoController->listarEscola($_REQUEST['idEscola']);
        $retorno = [];
            
            foreach($result as $dor) {
                array_push($retorno, [
                    "id" => intval($dor->getDor_id()),
                    "documento" => intval($dor->getDor_documento()),
                    "remetente" => intval($dor->getDor_remetente()),
                    "envio" => intval($dor->getDor_envio()),
                    "visto" => intval($dor->getDor_visto()),
                    "rejeitado" => intval($dor->getDor_rejeitado())
                ]);
            }
            
            echo json_encode($retorno);

        break;

    case 'visualizarEnvio':
        $result = $documentoEnvioController->visualizar($_REQUEST['idEnvio']);
        echo ($result);

        break;

    case 'visualizarRetorno':
        $result = $documentoRetornoController->visualizar($_REQUEST['idRetorno']);
        echo ($result);

        break;

    case 'rejeitarRetorno':
        $result = $documentoRetornoController->rejeitar($_REQUEST['idRetorno']);
        echo ($result);

        break;

    case 'enviosPorDocumento':
        $result = $documentoEnvioController->listarDocumento($_REQUEST['idDocumento']);
        $retorno = [
            "id" => $result->getDoe_id(),
            "data_envio" => DatasFuncao::dataTimeBRExibicao($result->getDoe_data_envio()),
            "retorno" => $result->getDoe_retorno(),
            "documento" => [
                "id" => $result->getDoe_documento()->getDoc_id(),
                "assunto" => utf8_encode($result->getDoe_documento()->getDoc_assunto()),
                "descricao" => utf8_encode($result->getDoe_documento()->getDoc_descricao()),
                "arquivo" => $result->getDoe_documento()->getDoc_arquivo()
            ]
        ];

        echo json_encode($retorno);

        break;

    case 'retornosPorDocumentoDoEnvio':

        $result = $documentoRetornoController->listarDocumento($_REQUEST['idDocumento']);
        $retorno = [];
            
            foreach($result as $dor) {
                array_push($retorno, [
                    "id" => intval($dor->getDor_id()),
                    "documento" => intval($dor->getDor_documento()),
                    "remetente" => intval($dor->getDor_remetente()),
                    "envio" => intval($dor_getDor_envio()),
                    "visto" => intval($dor_getDor_visto()),
                    "rejeitado" => intval($dor_getDor_rejeitado())
                ]);
            }
            
            echo json_encode($retorno);

        break;
    
    case "destinatariosPorDocumento":
        $result = $documentoEnvioController->getEnviosByDocumento($_REQUEST['idDocumento']);
        $retorno = [];

        foreach($result as $envio) {
            $dados = [
                "id" => intval($envio["envio"]->getDoe_id()),
                "documento" => intval($envio["envio"]->getDoe_documento()),
                "destinatario" => [
                    "id" => intval($envio["envio"]->getDoe_destinatario()->getEsc_id()),
                    "nome" => utf8_encode($envio["envio"]->getDoe_destinatario()->getEsc_nome())
                ],
                "data_envio" => DatasFuncao::dataTimeBRExibicao($envio["envio"]->getDoe_data_envio()),
                "visto" => intval($envio["envio"]->getDoe_visto()),
            ];

            if (intval($envio["envio"]->getDoe_retorno())) {
                $dados["retorno"] = [];
                
                if ($envio["retorno"] != null) {
                   $dados["retorno"] = [
                       "id" => intval($envio["retorno"]->getDor_id()),
                       "documento" => [
                            "id" => intval($envio["retorno"]->getDor_documento()->getDoc_id()),
                            "descricao" => intval($envio["retorno"]->getDor_documento()->getDoc_descricao())
                       ],
                       "rejeitado" => intval($envio["retorno"]->getDor_rejeitado()),
                       "visto" => intval($envio["retorno"]->getDor_visto())
                   ];
                }
            } else {
                $dados["retorno"] = 0;
            }
            
            array_push($retorno, $dados);
        }
        echo json_encode($retorno);
        
        break;
        
        case "retornosPorEnvioEscola": 
            $result = $documentoRetornoController->getRetornosByEscolaAndEnvio($_GET["idEscola"], $_GET["idEnvio"]);
            $retorno = [];
            
            foreach($result as $dor) {
                array_push($retorno, [
                    "id" => intval($dor->getDor_id()),
                    "documento" => [
                        "id" => intval($dor->getDor_documento()->getDoc_id()),
                        "assunto" => utf8_encode($dor->getDor_documento()->getDoc_assunto()),
                        "descricao" =>utf8_encode($dor->getDor_documento()->getDoc_descricao()),
                        "arquivo" => $dor->getDor_documento()->getDoc_arquivo()
                    ],
                    "remetente" => intval($dor->getDor_remetente()),
                    "envio" => intval($dor->getDor_envio()),
                    "visto" => intval($dor->getDor_visto()),
                    "rejeitado" => intval($dor->getDor_rejeitado()),
                    "data" => DatasFuncao::dataTimeBRExibicao($dor->getDor_data())
                ]);
            }
            
            echo json_encode($retorno);
        break;

    case 'pendenciasEscola':
        $pendenciaRetorno = $documentoEnvioController->isPendenciaRetornoEscola($_REQUEST['idEscola']);

        echo ($pendenciaRetorno);

        break;

    case 'pendenciasHospital':
        $pendenciasRetorno = $documentoRetornoController->isPendenciasRetornoHospital();

        echo ($pendenciasRetorno);
        
        break;
    
    case "documentoPorEnvio":
        $doc = $documentosController->selectDocumentoByEnvio($_GET["idenvio"]);
        $retorno = [
            "id" => intval($doc->getDoc_id()),
            "assunto" => utf8_encode($doc->getDoc_assunto()),
            "descricao" => utf8_encode($doc->getDoc_descricao()),
            "arquivo" => $doc->getDoc_arquivo()
        ];
        
        echo json_encode($retorno);
    break;

    default:
        echo "Erro: Serviço não reconhecido!";

        break;

}
?>