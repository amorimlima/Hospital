<?php

require_once /* $_SESSION['BASE_URL'] */'../_loadPaths.inc.php';

$path = $_SESSION['PATH_SYS'];

include_once($path['controller'] . 'GaleriaController.php');
include_once($path['controller'] . 'CategoriaGaleriaController.php');
include_once($path['controller'] . 'UsuarioController.php');
include_once($path['controller'] . 'RegistroGaleriaController.php');
include_once($path['beans'] . 'Galeria.php');
include_once($path['beans'] . 'CategoriaGaleria.php');
include_once($path['beans'] . 'RegistroGaleria.php');
include_once($path['beans'] . 'Usuario.php');
include_once($path['template'] . 'TemplateGaleria.php');
include_once($path['funcao'] . 'DatasFuncao.php');
$template = new TemplateGaleria();
$galeriaController = new GaleriaController();
$categoriaGaleriaController = new CategoriaGaleriaController();
$userController = new UsuarioController();
$registroGaleriaController = new RegistroGaleriaController();

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
                'categoria' => Array(
                    'id' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_id()),
                    'categoria' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_categoria()),
                    'classe' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_classe())),
                "visualizacoes" => utf8_encode($value->getGlr_visualizacoes())
            );
            array_push($lista, $result);
        }
        
        print_r (json_encode($lista));
        
        break;
    }

    case "listaMaisVistos":{
        $galeria = $galeriaController->selectMaisVistos();
        $lista = Array();
        foreach ($galeria as $key => $value) {
            $result = Array(
                "id" => utf8_encode($value->getGlr_idgaleria()),
                "nome" => utf8_encode($value->getGlr_nome()),
                "arquivo" => utf8_encode($value->getGlr_arquivo()),
                "descricao" => utf8_encode($value->getGlr_descricao()),
                "data" => utf8_encode($value->getGlr_data()),
                'categoria' => Array(
                    'id' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_id()),
                    'categoria' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_categoria()),
                    'classe' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_classe())),
                "visualizacoes" => utf8_encode($value->getGlr_visualizacoes())
            );
            array_push($lista, $result);
        }
        
        print_r (json_encode($lista));
        
        break;
    }
    case "listaCategorias": {
        $galeria = $galeriaController->selectCategoria($_REQUEST["categoria"]);
        $lista = Array();
        foreach ($galeria as $key => $value) {
            $result = Array(
                "id" => utf8_encode($value->getGlr_idgaleria()),
                "nome" => utf8_encode($value->getGlr_nome()),
                "arquivo" => utf8_encode($value->getGlr_arquivo()),
                "descricao" => utf8_encode($value->getGlr_descricao()),
                "data" => utf8_encode($value->getGlr_data()),
                'categoria' => Array(
                    'id' => utf8_encode($value->getGlr_categoria()->getCtg_id()),
                    'categoria' => utf8_encode($value->getGlr_categoria()->getCtg_categoria()),
                    'classe' => utf8_encode($value->getGlr_categoria()->getCtg_classe())),
                "visualizacoes" => utf8_encode($value->getGlr_visualizacoes())
            );
            array_push($lista, $result);
        }
        
        print_r (json_encode($lista));
        
        break;
    }
    case "novaVisualizacao":{
        $galeria = $galeriaController->select($_REQUEST["id"]);
        $galeria->setGlr_visualizacoes($galeria->getGlr_visualizacoes() + 1);
        $result = $galeriaController->update($galeria);
        //print_r(json_encode($result));
        break;
    }
    case "listaNome":{
        $galeria = $galeriaController->selectNome($_REQUEST["nome"]);
        $lista = Array();
        foreach ($galeria as $key => $value) {
            $result = Array(
                "id" => utf8_encode($value->getGlr_idgaleria()),
                "nome" => utf8_encode($value->getGlr_nome()),
                "arquivo" => utf8_encode($value->getGlr_arquivo()),
                "descricao" => utf8_encode($value->getGlr_descricao()),
                "data" => utf8_encode($value->getGlr_data()),
                'categoria' => Array(
                    'id' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_id()),
                    'categoria' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_categoria()),
                    'classe' => utf8_encode($galeria[$key]->getGlr_categoria()->getCtg_classe())),
                "visualizacoes" => utf8_encode($value->getGlr_visualizacoes())
            );
            array_push($lista, $result);
        }
        
        print_r (json_encode($lista));
        
        break;
    }
    case "listaCategoriasGaleria":{
        $categoriaGaleria = $categoriaGaleriaController->selectAll();
        $lista = Array();
        foreach ($categoriaGaleria as $key => $value) {
            $result = Array(
                'id' => utf8_encode($categoriaGaleria[$key]->getCtg_id()),
                'categoria' => utf8_encode($categoriaGaleria[$key]->getCtg_categoria()),
                'classe' => utf8_encode($categoriaGaleria[$key]->getCtg_classe())
            );
            array_push($lista, $result);
        }
        
        print_r (json_encode($lista));
        
        break;
    }
    case 'uploadGaleria':{
        $categoria = $_REQUEST['cat_arquivo'];
        $titulo = $_REQUEST['titulo_arquivo'];
        $descricao = $_REQUEST['descricao_arquivo'];
        $data = date('Y-m-d h:i', time());
        $galeria = new Galeria();
        $galeria->setGlr_categoria($categoria);
        $galeria->setGlr_nome(utf8_decode($titulo));
        $galeria->setGlr_descricao(utf8_decode($descricao));
        $galeria->setGlr_data($data);
        if ($_REQUEST['tipo_arquivo'] == 0)
        {
            $arquivo = $_REQUEST['link_arquivo'];
        }
        else
        {
            $nomeImage = "_".md5(uniqid(rand(),true)).'.'.pathinfo($_FILES['file_arquivo']['name'], PATHINFO_EXTENSION);
            $arquivo_temporario = $_FILES["file_arquivo"]["tmp_name"];
            $local = $path['arquivos_galeria'];
            move_uploaded_file($arquivo_temporario, $local.$nomeImage);
            $arquivo = $local.$nomeImage;
        }
        $galeria->setGlr_arquivo("arquivos_galeria/".$nomeImage);
        $galeria->setGlr_visualizacoes(0);
        $galeriaController->insert($galeria);
        $_SESSION['cadastro'] = "ok";
        header("Location:../galeria.php?");
        break;
    }

    case 'registroGaleria':{

        $logado = unserialize($_SESSION['USR']);
        if($logado['perfil_id'] != 3)
        {
            $data = date("Y-m-d");

            $registrogaleria= new RegistroGaleria();
            $registrogaleria->setRgg_escola($logado['escola']);
            $registrogaleria->setRgg_usuario($logado['id']);
            $registrogaleria->setRgg_menu_galeria($_POST['menu']);
            $registrogaleria->setRgg_download_galeria($_POST['download']);
            $registrogaleria->setRgg_data($data);
    
            $registroGaleriaController->insertRegistroGaleria($registrogaleria);
            echo "ok";
            break;
        }
        
    }
}
?>