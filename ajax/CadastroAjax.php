<?php
require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'EnderecoController.php');
include_once($path['beans'].'Usuario.php');
include_once($path['funcao'].'DatasFuncao.php');

switch ($_POST["acao"]) {
    case "novoUsuario":{
       //print_r($_POST);
        $endereco = new Endereco();
    	$endereco->setend_logradouro(utf8_decode($_POST["rua"]));
    	$endereco->setend_numero($_POST["numCasa"]);
    	$endereco->setend_complemento(utf8_decode($_POST["complemento"]));
    	$endereco->setend_cep($_POST["cep"]);
    	$endereco->setend_cidade(utf8_decode($_POST["cidade"]));
    	$endereco->setend_uf($_POST["estado"]);
    	$endereco->setend_pais('Brasil');
    	$endereco->setend_bairro(utf8_decode($_POST["bairro"]));
    	$endereco->setend_telefone_residencial($_POST["telResidencial"]);
    	$endereco->setend_telefone_celular($_POST["celular"]);
    	$endereco->setend_telefone_comercial($_POST["telComercial"]);
    	$endereco->setend_email($_POST["email"]);
    	$enderecoController = new EnderecoController();
    	if ($idEndereco = $enderecoController->insert($endereco)){
    	
	    	$dataFuncao = new DatasFuncao();
	        $usuario = new Usuario();
	        
	        $usuario->setUsr_login($_POST["login"]);
	        $usuario->setUsr_senha($_POST["senha"]);
	        $usuario->setUsr_nome(utf8_decode($_POST['nome']));
	        $usuario->setUsr_data_nascimento($dataFuncao->dataUSA($_POST['nascimento']));
	        $usuario->setUsr_data_entrada_escola(date("Y-m-d"));
	        $usuario->setUsr_endereco($idEndereco);
	        
	        
	        if ($_POST['tipo'] == 'aluno'){
	        	$usuario->setUsr_nse('');
	        	$usuario->setUsr_perfil(1);
	        	$usuario->setUsr_escola($_POST['escola']);
	        }elseif ($_POST['tipo'] == 'professor'){
	        	$usuario->setUsr_nse(''); //O professor preisa disso
	        	$usuario->setUsr_perfil(2);
	        }
	        
	        $usuarioController = new UsuarioController();
	        
	            	//$result = Array('erro'=>true);
        //return json_encode($result);
        
	        if ($usuarioController->insert($usuario)) $result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
	        	else $result = Array('erro'=>true,'msg'=>'Erro ao cadastrar!');
	        	
    	}else $result = Array('erro'=>true,'msg'=>'Erro ao cadastrar!');
        
    	echo json_encode($result);
        break;
    }
    
//    case "cadastroProfessor":{
//    	
//    	$endereco = new Endereco();
//    	$endereco->setend_logradouro($_POST["enderecoProfessor"]);
//    	$endereco->setend_numero($_POST["numeroCasaProfessor"]);
//    	$endereco->setend_cep($_POST["cepProfessor"]);
//    	$endereco->setend_cidade($_POST["cidadeProfessor"]);
//    	$endereco->setend_bairro($_POST["bairroProfessor"]);
//    	$endereco->setend_complemento(null);//não tem o campo no formulario 
//    	$endereco->setend_email($_POST["emailProfessor"]);
//    	$endereco->setend_uf("MG");//???????? não esta carregando estados
//    	$endereco->setend_pais(41489538);//???????????? que é este código
//    	$endereco->setend_telefone_residencial($_POST["telefoneProfessor"]);
//    	$endereco->setend_telefone_celular(null);
//    	$endereco->setend_telefone_comercial(null);
//    	$enderecoController = new EnderecoController();
//    	
//    	$idEndereco = $enderecoController->insert($endereco);
//    	$dataNascimento = explode("/", $_POST['dataNascimentoProfessor']);
//		if($idEndereco){
//		$usuarioController = new UsuarioController();
//    	$idUsuario = $usuarioController->ultimoIDUsuario();
//    	
//    	$usuario = new Usuario();
//    	$usuario->setUsr_id($idUsuario);
//    	$usuario->setUsr_nome($_POST['nomeProfessor']);
//    	$usuario->setUsr_data_nascimento($dataNascimento[2]."-".$dataNascimento[1]."-".$dataNascimento[0]);
//    	$usuario->setUsr_endereco($idEndereco);
//    	$usuario->setUsr_escola(null);
//    	$usuario->setUsr_perfil(2);
//    	$usuario->setUsr_login($_POST["loginProfessor"]);
//    	$usuario->setUsr_senha($_POST["senhaProfessor"]);
//    	$usuario->setUsr_data_entrada_escola(date("Y-m-d"));
//    	$usuario->setUsr_nse(null);
//		
//    	if($usuarioController->insertComID($usuario)){
//    	$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
//    	}else{
//    	$result = Array('erro'=>true,'msg'=>'Erro em cadastrar professor!');
//    	}
//		}else{
//		$result = Array('erro'=>true,'msg'=>'Erro em cadastrar endereço do professor!');	
//		}
//    	echo json_encode($result);
//    	
//    	break;
//    }
//    case "cadastraEscola":{
//    	$endereco = new Endereco();
//    	$endereco->setend_logradouro($_POST["enderecoEscola"]);
//    	$endereco->setend_numero($_POST["numeroEnderecoEscola"]);
//    	$endereco->setend_cep($_POST["cepEscola"]);
//    	$endereco->setend_cidade($_POST["cidadeEscola"]);
//    	$endereco->setend_bairro($_POST["bairroEscola"]);
//    	$endereco->setend_complemento(null);//não tem o campo no formulario
//    	$endereco->setend_email($_POST["emailEscola"]);
//    	$endereco->setend_uf("MG");//???????? não esta carregando estados
//    	$endereco->setend_pais(41489538);//???????????? que é este código
//    	$endereco->setend_telefone_residencial($_POST["telefoneEscola"]);
//    	$endereco->setend_telefone_celular(null);
//    	$endereco->setend_telefone_comercial(null);
//    	$enderecoController = new EnderecoController();
//    	 
//    	$idEndereco = $enderecoController->insert($endereco);
//    	if($idEndereco){
//    		$usuarioController = new UsuarioController();
//    		$idUsuario = $usuarioController->ultimoIDUsuario();
//    		 
//    		$usuario = new Usuario();
//    		$usuario->setUsr_id($idUsuario);
//    		$usuario->setUsr_nome($_POST['nomeEscola']);
//    		$usuario->setUsr_data_nascimento("0000-00-00");
//    		$usuario->setUsr_endereco($idEndereco);
//    		$usuario->setUsr_escola(null);
//    		$usuario->setUsr_perfil(4);
//    		$usuario->setUsr_login($_POST["loginEscola"]);
//    		$usuario->setUsr_senha($_POST["senhaEscola"]);
//    		$usuario->setUsr_data_entrada_escola(date("Y-m-d"));
//    		$usuario->setUsr_nse(null);
//    		
//    		if($usuarioController->insertComID($usuario)){
//    			$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
//    		}else{
//    			$result = Array('erro'=>true,'msg'=>'Erro em cadastrar escola!');
//    		}
//    	}else{
//    		$result = Array('erro'=>true,'msg'=>'Erro em cadastrar endereço do escola!');
//    	}
//    	echo json_encode($result);
//    	
//    	break;
//    }
}

?>
