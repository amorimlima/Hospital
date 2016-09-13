<?php

require_once /* $_SESSION['BASE_URL'] */'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'EscolaController.php');
include_once($path['controller'] . 'DocumentoController.php');
include_once($path['controller'] . 'DocumentoEnvioController.php');
include_once($path['controller'] . 'DocumentoRetornoController.php');
include_once($path['controller'] . 'DocumentoDestinatarioController.php');
include_once($path['funcao'] . 'DatasFuncao.php');

$escolaController = new EscolaController();
$documentosController = new DocumentoController();
$documentoEnvioController = new DocumentoEnvioController();
$documentoRetornoController = new DocumentoRetornoController();
$documentoDestinatarioController = new DocumentoDestinatarioController();

$maxSize = 30000000; //Tamanho máximo de arquivo 30Mb

switch ($_REQUEST['acao']) {
    case 'postDocumento': {
        $_SESSION["cadastro"] = "";

        $documento = new Documento();
        $documento->setDoc_assunto($_REQUEST['assunto']);
        $documento->setDoc_descricao($_REQUEST['descricao']);

        $nomeArquivo = "_".md5(uniqid(rand(),true)).'.'.pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];

        $local = $path['documentos'];

        if (filesize($arquivo_temporario) > $maxSize) {
            $_SESSION['cadastro'] = "excedeu";
        } else {
            move_uploaded_file($arquivo_temporario, $local.$nomeArquivo);
            $arquivo = $local.$nomeArquivo;
        }

        if (!$_SESSION['cadastro'] == "excedeu") {
            $documento->setDoc_arquivo("documentos/".$nomeArquivo);
            $result = $documentosController->insertDocumentos($documento);
            $_SESSION['cadastro'] = "ok";
            echo $result;
        }

        break;
    }
	
    case 'postEnvio': {
        $doe = new DocumentoEnvio();
        $doe->setDoe_documento($_POST["documento"]);
        $doe->setDoe_retorno($_POST["retorno"]);
        $retorno = 0;
        $doe_id = intval($documentoEnvioController->insertDocumentoEnvio($doe));
        
        
        for ($i = 0; $i < count(explode(",", $_POST["destinatario"])); $i++) {
            $dod = new DocumentoDestinatario();
            $dod->setDod_envio($doe_id);
            $dod->setDod_destinatario(explode(",", $_POST["destinatario"])[$i]);

            if ($documentoDestinatarioController->insert($dod))
                $retorno = 1;
            else
                $retorno = 0;
        }

        echo $retorno;

	break;
    }

    case 'postRetorno': {
        $documentosRetorno = new DocumentoRetorno();
        $documentosRetorno->setDor_documento($_POST["documento"]);
        $documentosRetorno->setDor_destinatario($_POST["destinatario"]);
        $result = $documentoRetornoController->insertDocumentoRetorno($documentosRetorno);
        
        echo $result;

        break;
    }

    case "getDocumentosEnviados":
        $envios = $documentoEnvioController->selectAllDocumentoEnvio();
        $retorno = [];
        
        foreach ($envios as $envio) {
            $doc = $documentosController->selectByIdDocumentos($envio->getDoe_documento());
            $verificadores = [];
            
            if (intval($envio->getDoe_retorno())) {
                $dod = $documentoDestinatarioController->getAllByEnvio($envio->getDoe_id());
                $pendencia = false;
                $naoVisto = false;
                
                for ($i = 0; $i < count($dod); $i++) {
                    if (!$dod[$i]->getDod_visto())
                        $naoVisto = true;
                    
                    if ($documentoDestinatarioController->checkPendenciasOf($dod[$i]->getDod_id()))
                        $pendencia = true;
                }
                
                $verificadores["retornos_pendentes"] = $pendencia;
                $verificadores["retornos_nao_vistos"] = $naoVisto;
            }
            
            array_push($retorno, [
                "documento_envio" => [
                    "id" => intval($envio->getDoe_id()),
                    "data_envio" => DatasFuncao::dataTimeBRExibicao($envio->getDoe_data_envio()),
                    "retorno" => intval($envio->getDoe_retorno()),
                    "documento" => [
                        "id" => intval($doc->getDoc_id()),
                        "assunto" => $doc->getDoc_assunto(),
                        "descricao" => intval($doc->getDoc_descricao()),
                        "arquivo" => $doc->getDoc_arquivo()
                    ]
                ],
                "verificadores" => $verificadores
            ]);   
        }
        
        echo json_encode($retorno);
    break;

    case 'getEnvio':

        if(isset($_REQUEST['idEnvio'])){
            $envio = $documentoEnvioController->selectByIdDocumentoEnvio($_REQUEST['idEnvio']);
            $doc = $documentosController->selectByIdDocumentos($envio->getDoe_documento());
            
            $retorno = array(
                    "id" => intval($envio->getDoe_id()),
                    "data_envio" => DatasFuncao::dataTimeBRExibicao($envio->getDoe_data_envio()),
                    "retorno" => intval($envio->getDoe_retorno()),
                    "documento" => [
                        "id" => intval($doc->getDoc_id()),
                        "assunto" => $doc->getDoc_assunto(),
                        "descricao" => $doc->getDoc_descricao(),
                        "arquivo" => $doc->getDoc_arquivo()
                    ]
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
        if(isset($_GET['id'])){
            $dor = $documentoRetornoController->selectByIdDocumentoRetorno($_GET['id']);
            $doc = $documentosController->selectByIdDocumentos($dor->getDor_documento());
            $dod = $documentoDestinatarioController->get($dor->getDor_destinatario());
            $esc = $escolaController->select($dod->getDod_destinatario());
            
            $retorno = [
                "id" => $dor->getDor_id(),
                "documento" => [
                    "id" => intval($doc->getDoc_id()),
                    "assunto" => $doc->getDoc_assunto(),
                    "descricao" => $doc->getDoc_descricao(),
                    "arquivo" => $doc->getDoc_arquivo()
                ],
                "destinatario" => [
                    "id" => intval($dod->getDod_id()),
                    "envio" => intval($dod->getDod_envio()),
                    "destinatario" => [
                        "id" => intval($esc->getEsc_id()),
                        "nome" => utf8_encode($esc->getEsc_nome())
                    ],
                    "visto" => intval($dod->getDod_visto())
                ],
                "data" => DatasFuncao::dataTimeBRExibicao($dor->getDor_data()),
                "visto" => intval($dor->getDor_visto()),
                "rejeitado" => intval($dor->getDor_rejeitado())
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
        $result = $documentoDestinatarioController->getEnviosFor($_GET['id']);
        $retorno = [];
        
        foreach($result as $dod) {
            $doe = $documentoEnvioController->selectByIdDocumentoEnvio($dod->getDod_envio());
            $doc = $documentosController->selectByIdDocumentos($doe->getDoe_documento());
            $pendencias = $documentoDestinatarioController->checkPendenciasOf($dod->getDod_id());
            $rejeitado = $documentoDestinatarioController->checkRetornoRejeitadoOf($dod->getDod_id());
                
            
            array_push($retorno, [
                "destinatario" => [
                    "id" => intval($dod->getDod_id()),
                    "envio" => [
                        "id" => intval($doe->getDoe_id()),
                        "documento" => [
                            "id" => intval($doc->getDoc_id()),
                            "assunto" => $doc->getDoc_assunto(),
                            "descricao" => $doc->getDoc_descricao(),
                            "arquivo" => $doc->getDoc_arquivo()
                        ],
                        "data" => DatasFuncao::dataTimeBRExibicao($doe->getDoe_data_envio()),
                        "retorno" => intval($doe->getDoe_retorno())
                    ],
                    "destinatario" => intval($dod->getDod_destinatario()),
                    "visto" => intval($dod->getDod_visto())
                ],
                "verificadores" => [
                    "retorno_pendente" => intval($pendencias),
                    "retorno_rejeitado" => intval($rejeitado)
                ]
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
                    "envio" => intval($dor->getDor_envio()),
                    "visto" => intval($dor->getDor_visto()),
                    "rejeitado" => intval($dor->getDor_rejeitado())
                ]);
            }
            
            echo json_encode($retorno);

        break;
    
    case "envioPorDestinatario": {
        $dod = $documentoDestinatarioController->get($_GET['id']);
        $doe = $documentoEnvioController->selectByIdDocumentoEnvio($dod->getDod_envio());
        $doc = $documentosController->selectByIdDocumentos($doe->getDoe_documento());
        
        $retorno = [
            "id" => intval($dod->getDod_id()),
            "envio" => [
                "id" => intval($doe->getDoe_id()),
                "documento" => [
                    "id" => intval($doc->getDoc_id()),
                    "assunto" => $doc->getDoc_assunto(),
                    "descricao" => $doc->getDoc_descricao(),
                    "arquivo" => $doc->getDoc_arquivo()
                ],
                "data_envio" => DatasFuncao::dataTimeBRExibicao($doe->getDoe_data_envio()),
                "retorno" => intval($doe->getDoe_retorno())
            ],
            "destinatario" => intval($dod->getDod_destinatario()),
            "visto" => intval($dod->getDod_visto())
        ];

        echo json_encode($retorno);
        
        break;
    }
        
        case "retornosPorDestinatario":
            $result = $documentoRetornoController->getRetornosOf($_GET["id"]);
            $retorno = [];
            
            foreach($result as $dor) {
                $doc = $documentosController->selectByIdDocumentos($dor->getDor_documento());
                array_push($retorno, [
                    "id" => intval($dor->getDor_id()),
                    "documento" => [
                        "id" => intval($doc->getDoc_id()),
                        "assunto" => $doc->getDoc_assunto(),
                        "descricao" => $doc->getDoc_descricao(),
                        "arquivo" => $doc->getDoc_arquivo()
                    ],
                    "destinatario" => intval($dor->getDor_destinatario()),
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

    case "getEnviados": {
        $docs = $documentosController->getEnviados();
        $retorno = [];
        
        foreach($docs as $doc) {
            array_push($retorno, [
                "id" => intval($doc->getDoc_id()),
                "assunto" => $doc->getDoc_assunto(),
                "descricao" => $doc->getDoc_descricao(),
                "arquivo" => $doc->getDoc_arquivo()
            ]);
        }

        echo json_encode($retorno);
        break;
    }
    
    case "destinatariosPorEnvio" : {
        $dods = $documentoDestinatarioController->getAllByEnvio($_GET["id"]);
        $retorno = [];

        foreach($dods as $dod) {
            $esc = $escolaController->select($dod->getDod_destinatario());
            $pendente = $documentoDestinatarioController->checkPendenciasOf($dod->getDod_id());
            $dor = $documentoRetornoController->getMaisRecenteOf($dod->getDod_id());
            
            if (!intval($pendente)) {
                $doc = $documentosController->selectByIdDocumentos($dor->getDor_documento());
                $dor = [
                    "id" => intval($dor->getDor_id()),
                    "documento" => [
                        "id" => intval($doc->getDoc_id()),
                        "assunto" => $doc->getDoc_assunto(),
                        "descricao" => $doc->getDoc_descricao(),
                        "arquivo" => $doc->getDoc_arquivo()
                    ],
                    "destinatario" => intval($dor->getDor_destinatario()),
                    "data" => DatasFuncao::dataTimeBRExibicao($dor->getDor_data()),
                    "visto" => intval($dor->getDor_visto()),
                    "rejeitado" => intval($dor->getDor_rejeitado())
                ];
            } else {
                $dor = 0;
            }
            
            array_push($retorno, [
                "destinatario" => [
                    "id" => intval($dod->getDod_id()),
                    "envio" => intval($dod->getDod_envio()),
                    "destinatario" => [
                        "id" => intval($esc->getEsc_id()),
                        "nome" => utf8_encode($esc->getEsc_nome())
                    ],
                    "visto" => intval($dod->getDod_visto())
                ],
                "retorno" => $dor,
                "verificadores" => [
                    "retorno_pendente" => intval($pendente)
                ],
            ]);
        }
        echo json_encode($retorno);
        break;
    }
    
    case "setDestinatarioVisto": {
        $dod = $documentoDestinatarioController->get($_POST["id"]);
        $dod->setDod_visto(1);
        
        echo $documentoDestinatarioController->update($dod);
    }
    
    case "checkPendenciasOf" : {
        echo $documentoDestinatarioController->checkPendenciasOf($_GET["id"]);
        break;
    }

    default:
        echo "Erro: Serviço não reconhecido!";

        break;

}
?>