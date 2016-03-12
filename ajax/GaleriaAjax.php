<?php

require_once /* $_SESSION['BASE_URL'] */'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'GaleriaController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['beans'] . 'Galeria.php');
include_once($path['beans'] . 'Categoria_Galeria.php');
include_once($path['beans'] . 'Usuario.php');
include_once($path['template'] . 'TemplateGaleria.php');
include_once($path['funcao'] . 'DatasFuncao.php');
$template = new TemplateGaleria();
$galeriaController = new GaleriaController();
$userController = new UsuarioController();

switch ($_REQUEST["acao"]) {
    case "listaTodos": {
        $galeria = $galeriaController->selectAll();
        foreach ($galeria as $key => $value) {
            $result[$key] = Array(
                "id" => utf8_encode($galeria[$key]->getGlr_idgaleria()),
                "nome" => utf8_encode($galeria[$key]->getGlr_nome()),
                "arquivo" => utf8_encode($galeria[$key]->getGlr_arquivo()),
                "descricao" => utf8_encode($galeria[$key]->getGlr_descricao()),
                "aluno" => utf8_encode($galeria[$key]->getGlr_aluno()),
                "professor" => utf8_encode($galeria[$key]->getGlr_professor()),
                "escola" => utf8_encode($galeria[$key]->getGlr_escola()),
                "categoria" => utf8_encode($galeria[$key]->getGlr_categoria()),
                "visualizacoes" => utf8_encode($galeria[$key]->getGlr_visualizacoes())
            );
        }
        print_r(json_encode($result));
        break;
    }

    case "listaMaisRecentes": {
        $galeria = $galeriaController->selectMaisRecentes();
        $lista = Array();
        foreach ($galeria as $key => $value) {
            $result = Array(
                "id" => utf8_encode($value->getGlr_idgaleria()),
                "nome" => utf8_encode($value->getGlr_nome()),
                "arquivo" => utf8_encode($value->getGlr_arquivo()),
                "descricao" => utf8_encode($value->getGlr_descricao()),
                "data" => utf8_encode($value->getGlr_data()),
                "visualizacoes" => utf8_encode($value->getGlr_visualizacoes())
            );
            array_push($lista, $result);
        }
        
        print_r (json_encode($lista));
        
        break;
    }
}
?>