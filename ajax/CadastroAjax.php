<?php
require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'EnderecoController.php');
include_once($path['beans'].'Usuario.php');

switch ($_POST["acao"]) {
    case "novoAluno":{
    	
    	$endereco = new Endereco();
    	$endereco->setend_logradouro($_POST["ruaAluno"]);
    	$endereco->setend_numero($_POST["numCasaAluno"]);
    	$endereco->setend_cep($_POST["cepAluno"]);
    	$endereco->setend_cidade($_POST["cidadeAluno"]);
    	$endereco->setend_bairro($_POST["bairroAluno"]);
    	$endereco->setend_complemento($_POST["complementoAluno"]);
    	$endereco->setend_email($_POST["emailAluno"]);
    	$endereco->setend_uf("MG");//???????? não esta carregando estados
    	$endereco->setend_pais('Brasil');
    	$endereco->setend_telefone_residencial($_POST["telefoneAluno"]);
    	$endereco->setend_telefone_celular(null);
    	$endereco->setend_telefone_comercial(null);
    	$enderecoController = new EnderecoController();
    	$idEndereco = $enderecoController->insert($endereco);
    	
    	$dataNascimento = explode("/", $_POST['nascimentoAluno']);
    	
        $usuario = new Usuario();
        $usuario->setUsr_nome($_POST['nomeAluno']);
        $usuario->setUsr_data_nascimento($dataNascimento[2]."-".$dataNascimento[1]."-".$dataNascimento[0]);
        $usuario->setUsr_endereco($idEndereco);
        $usuario->setUsr_escola($_POST['escolaAluno']);
        $usuario->setUsr_perfil(1);
        $usuario->setUsr_login($_POST["loginAluno"]);
        $usuario->setUsr_senha($_POST["senhaAluno"]);
        $usuario->setUsr_data_entrada_escola(date("Y-m-d"));
        $usuario->setUsr_nse($_POST["serieAluno"]);//ver o que siguinifica?
        
        $usuarioController = new UsuarioController();
        $usuarioController->insert($usuario);
        //rever indice da tabela usuario, pois não esta autoincremento e não deixa colocar
        // campos do responsável não existe tabela para eles.
        
        

//Falta PERIODO
//falta RUA e outros dados do endereço

        print_r($usuario);

        print_r($_REQUEST);

        break;
    }
    case "cadastroProfessor":{
    	
    	$endereco = new Endereco();
    	$endereco->setend_logradouro($_POST["enderecoProfessor"]);
    	$endereco->setend_numero($_POST["numeroCasaProfessor"]);
    	$endereco->setend_cep($_POST["cepProfessor"]);
    	$endereco->setend_cidade($_POST["cidadeProfessor"]);
    	$endereco->setend_bairro($_POST["bairroProfessor"]);
    	$endereco->setend_complemento(null);//não tem o campo no formulario 
    	$endereco->setend_email($_POST["emailProfessor"]);
    	$endereco->setend_uf("MG");//???????? não esta carregando estados
    	$endereco->setend_pais(41489538);//???????????? que é este código
    	$endereco->setend_telefone_residencial($_POST["telefoneProfessor"]);
    	$endereco->setend_telefone_celular(null);
    	$endereco->setend_telefone_comercial(null);
    	$enderecoController = new EnderecoController();
    	
    	$idEndereco = $enderecoController->insert($endereco);
    	$dataNascimento = explode("/", $_POST['dataNascimentoProfessor']);
		if($idEndereco){
		$usuarioController = new UsuarioController();
    	$idUsuario = $usuarioController->ultimoIDUsuario();
    	
    	$usuario = new Usuario();
    	$usuario->setUsr_id($idUsuario);
    	$usuario->setUsr_nome($_POST['nomeProfessor']);
    	$usuario->setUsr_data_nascimento($dataNascimento[2]."-".$dataNascimento[1]."-".$dataNascimento[0]);
    	$usuario->setUsr_endereco($idEndereco);
    	$usuario->setUsr_escola(null);
    	$usuario->setUsr_perfil(2);
    	$usuario->setUsr_login($_POST["loginProfessor"]);
    	$usuario->setUsr_senha($_POST["senhaProfessor"]);
    	$usuario->setUsr_data_entrada_escola(date("Y-m-d"));
    	$usuario->setUsr_nse(null);
		
    	if($usuarioController->insertComID($usuario)){
    	$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
    	}else{
    	$result = Array('erro'=>true,'msg'=>'Erro em cadastrar professor!');
    	}
		}else{
		$result = Array('erro'=>true,'msg'=>'Erro em cadastrar endereço do professor!');	
		}
    	echo json_encode($result);
    	
    	break;
    }
    case "cadastraEscola":{
    	$endereco = new Endereco();
    	$endereco->setend_logradouro($_POST["enderecoEscola"]);
    	$endereco->setend_numero($_POST["numeroEnderecoEscola"]);
    	$endereco->setend_cep($_POST["cepEscola"]);
    	$endereco->setend_cidade($_POST["cidadeEscola"]);
    	$endereco->setend_bairro($_POST["bairroEscola"]);
    	$endereco->setend_complemento(null);//não tem o campo no formulario
    	$endereco->setend_email($_POST["emailEscola"]);
    	$endereco->setend_uf("MG");//???????? não esta carregando estados
    	$endereco->setend_pais(41489538);//???????????? que é este código
    	$endereco->setend_telefone_residencial($_POST["telefoneEscola"]);
    	$endereco->setend_telefone_celular(null);
    	$endereco->setend_telefone_comercial(null);
    	$enderecoController = new EnderecoController();
    	 
    	$idEndereco = $enderecoController->insert($endereco);
    	if($idEndereco){
    		$usuarioController = new UsuarioController();
    		$idUsuario = $usuarioController->ultimoIDUsuario();
    		 
    		$usuario = new Usuario();
    		$usuario->setUsr_id($idUsuario);
    		$usuario->setUsr_nome($_POST['nomeEscola']);
    		$usuario->setUsr_data_nascimento("0000-00-00");
    		$usuario->setUsr_endereco($idEndereco);
    		$usuario->setUsr_escola(null);
    		$usuario->setUsr_perfil(4);
    		$usuario->setUsr_login($_POST["loginEscola"]);
    		$usuario->setUsr_senha($_POST["senhaEscola"]);
    		$usuario->setUsr_data_entrada_escola(date("Y-m-d"));
    		$usuario->setUsr_nse(null);
    		
    		if($usuarioController->insertComID($usuario)){
    			$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
    		}else{
    			$result = Array('erro'=>true,'msg'=>'Erro em cadastrar escola!');
    		}
    	}else{
    		$result = Array('erro'=>true,'msg'=>'Erro em cadastrar endereço do escola!');
    	}
    	echo json_encode($result);
    	
    	break;
    }
}

?>
