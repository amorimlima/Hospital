<?php

if (!isset($_SESSION['PATH_SYS'])) {
    require_once '../_loadPaths.inc.php';
}

$path = $_SESSION['PATH_SYS'];
include_once($path['controller'] . 'EscolaJSONController.php');
include_once($path['controller'] . 'EnvioDocumentoController.php');
require_once '../dompdf/autoload.inc.php';
require_once '../pesquisa_pdf.php';

use Dompdf\Dompdf;

switch ($_REQUEST["acao"]) {
    case "novoPreCadastro": {
            $escolaJSONController = new EscolaJSONController();

            $query = json_encode($_POST);

            $escolaJSON = new EscolaJSON();

            $escolaJSON->setEsj_escola($_SESSION['idEscolaPre']);
            $escolaJSON->setEsj_string($query);

            try {
                $idesj = $escolaJSONController->insertAndReturnId($escolaJSON);
                echo json_encode(["status" => 1, "retorno" => "Registro salvo com sucesso.", "idesj" => $idesj]);
            } catch (Exception $e) {
                echo json_encode(["status" => 0, "retorno" => "Erro ao inserir arquivo: {$e->getMessage()}"]);
            }

            break;
        }

    case "getAquivoPdf": {
            $envioDocumentoControler = new EnvioDocumentoController();
            $escolaJSONController = new EscolaJSONController();

            if ($_GET["idesc"]) {
                if (function_exists("curl_init")) {
                    $dompdf = new Dompdf();
                    $host = $_SERVER["HTTP_HOST"];
                    $folder = ($_SERVER["HTTP_HOST"] == "187.73.149.26:8080" ? "" : "Hospital/");
                    //$url = "http://{$host}/{$folder}pesquisa_pdf.php?idesc=".$_GET["idesc"];
                    $url = gerarPDF();

                    // Carrega o conteúdo da página
                    $dompdf->load_html($url);

                    // Define o tamanho da página para A4 e orientação para retrato
                    $dompdf->setPaper('A4', 'portrait');

                    // Gera a visualização do arquivo
                    $dompdf->render();

                    // Exporta o arquivo
                    $arquivo = $dompdf->output("arquivo.pdf", ["Attachment" => true]);

                    // Gera um nome criptografado para o arquivo
                    $rand = rand(1, 500);
                    $rand2 = rand(1, 500);
                    $nomeCrip = md5("arquivo" . $rand . $rand2);

                    if ($arquivo) {
                        file_put_contents($path['arquivos'] . $nomeCrip . '.pdf', $arquivo);

                        $env = new EnvioDocumento();
                        $env->setEnv_idEscola($_GET['idesc']);
                        $env->setEnv_idRemetente(1);
                        $env->setEnv_idDestinatario(1);
                        $env->setEnv_url($nomeCrip . '.pdf');
                        $env->setVisto(0);

                        $envioDocumentoControler->insert($env);

                        echo json_encode(["status" => "Arquivo gerado com sucesso", "arquivo" => $nomeCrip . ".pdf"]);
                    } else
                        throw new Exception("Ocorreu um erro ao gerar o arquivo pdf.");
                } else
                    throw new Exception("CURL não configurado.", 1);
            } else
                throw new Exception("Parâmetro 'idesc' ausente.", 1);

            break;
        }

    case "uploadArquivoPreCadastro": {
        $escJSONController = new EscolaJSONController();
        $arquivo = $_FILES["arquivo"];
        $idesj = $_POST["idesj"];

        $nomeArquivo = "_" . md5(uniqid(rand(), true)) . "." . pathinfo($arquivo["name"], PATHINFO_EXTENSION);
        $arquivoTemporario = $arquivo["tmp_name"];
        $local = $path["arquivos"];

        $esj = new EscolaJSON();
        $esj->setEsj_id($idesj);
        $esj->setEsj_arquivo($nomeArquivo);

        $retorno = [];

        if ($escolaJSONController->salvarDocumentoPreCadastro($esj)) {
            move_uploaded_file($arquivoTemporario, $local . $nomeArquivo);

            $retorno["status"] = 1;
            $retorno["mensagem"] = "Arquivo salvo com sucesso";
        } else {
            $retorno["status"] = 0;
            $retorno["mensagem"] = "Erro ao inserir o arquivo: ".utf8_encode($e->getMessage());   
        }

        echo json_encode($retorno);

        break;
    }
}
?>