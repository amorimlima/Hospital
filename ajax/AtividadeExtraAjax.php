<?php

require_once /* $_SESSION['BASE_URL'] */'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'AtividadeExtraController.php');
include_once($path['controller'] . 'AtividadeEscolaController.php');
include_once($path['beans'] . 'AtividadeExtra.php');
include_once($path['beans'] . 'AtividadeEscola.php');
include_once($path['funcao'] . 'DatasFuncao.php');

$atividadeExtraController = new AtividadeExtraController();
$atividadeEscolaController = new AtividadeEscolaController();

$maxSize = 30000000; //Tamanho máximo de arquivo 30Mb

switch ($_REQUEST['acao']){
	case 'postAtividadeExtra':

		$atividade = $_REQUEST['atividade'];
		$descricao = $_REQUEST['descricao'];

		$_SESSION["cadastro"] = "";

		$atividade_extra = new AtividadeExtra();
		$atividade_extra->setAte_atividade($atividade);
		$atividade_extra->setAte_descricao($descricao);

		$nomeArquivo = "_".md5(uniqid(rand(),true)).'.'.pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];

        $local = $path['atividades'];

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
            $atividade_extra->setAte_arquivo("atividades/".$nomeArquivo);
            $result = $atividadeExtraController->insert($atividade_extra);
            echo $result;
            $_SESSION['cadastro'] = "ok";
        }

		break;

	case 'postAtividadeEscola':

		$atividade = $_REQUEST['atividade'];
		$escolas = $_REQUEST['escolas'];

		$escolas = explode(',', $escolas);

		$atividade_escola = new AtividadeEscola();
		$atividade_escola->setAes_atividade($atividade);
		foreach ($escolas as $escola) {
			$atividade_escola->setAes_escola($escola);

			$atividadeEscolaController->insert($atividade_escola);
		}

		echo 1;

		break;

	case 'listarAtividadeEscola':

		$atividades_extra = $AtividadeEscolaController->listarAtividadeEscola($_REQUEST['idEscola']);
        $retorno = [];
        //foreach($envios["documento_envio"] as $envio) {
        foreach ($atividades_extra as $aes) {
        	array_push($retorno, [
        			"ate_id" => $aes->getAte_id(),
        			"ate_atividade" => $aes->getAte_atividade(),
        			"ate_descricao" => $aes->getAte_descricao(),
        			"ate_arquivo" => $aes->getAte_arquivo()
        		]);
        }

        echo json_encode($retorno);

		break;

    case 'visualizarAtividadeEscola':
        $atividades_extra = 

}

?>
