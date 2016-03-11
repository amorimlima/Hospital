<?php
require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
$path = $_SESSION['PATH_SYS'];

include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'EnderecoController.php');
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'UsuarioVariavelController.php');
include_once($path['controller'].'GrupoController.php');
include_once($path['beans'].'Usuario.php');
include_once($path['beans'].'UsuarioVariavel.php');
include_once($path['beans'].'Escola.php');
include_once($path['beans'].'Endereco.php');
include_once($path['beans'].'Grupo.php');

include_once($path['funcao'].'DatasFuncao.php');

switch ($_POST["acao"]) {
    case "novoUsuario":{

	  	$result = '';
       	$enderecoController = new EnderecoController();
		$usuarioController = new UsuarioController();
		
        if ($usuarioController->verificaCpf($_POST['cpf']) > 0){
        	$result = Array('erro'=>true,'msg'=>'CPF já cadastrado!');
        	
        }else
         if ($enderecoController->verificaEmail($_POST['email']) > 0){
        	$result = Array('erro'=>true,'msg'=>'Email já cadastrado!');
        
        }else if ($usuarioController->verificaLogin($_POST["login"])){
        	$result = Array('erro'=>true,'msg'=>'Nome de usuário já cadastrado!');
        }
        
       	if ($result == ''){
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
	    	
	    	if ($idEndereco = $enderecoController->insert($endereco)){
	    	
		    	$dataFuncao = new DatasFuncao();
		        $usuario = new Usuario();
		        
		        $usuario->setUsr_login($_POST["login"]);
		        $usuario->setUsr_senha($_POST["senha"]);
		        $usuario->setUsr_nome(utf8_decode($_POST['nome']));
		        $usuario->setUsr_data_nascimento($dataFuncao->dataUSA($_POST['nascimento']));
		        $usuario->setUsr_data_entrada_escola(date("Y-m-d"));
		        $usuario->setUsr_endereco($idEndereco);
		        $usuario->setUsr_rg($_POST['rg']);
		        $usuario->setUsr_cpf($_POST['cpf']);
		        $usuario->setUsr_nse($_POST['nse']);
		        $usuario->setUsr_escola($_POST['escola']);
		        $usuario->setUsr_perfil($_POST['perfil']);
	
		        if ($idUsuario = $usuarioController->insert($usuario)){
			        
			        	$usuarioVarController = new UsuarioVariavelController();
			        	$usuarioVar = new UsuarioVariavel();
			        	$usuarioVar->setUsv_usuario($idUsuario);
			        	$usuarioVar->setUsv_serie($_POST['serie']);
			        	$usuarioVar->setUsv_ano_letivo($_POST['ano']);
			        	$usuarioVar->setUsv_serie($_POST['serie']);
			        	if ($_POST['grupo'] == '') $usuarioVar->setUsv_grupo('null');
			        		else $usuarioVar->setUsv_grupo($_POST['grupo']);
			        	$usuarioVar->setUsv_grau_instrucao($_POST['grauInstrucao']);
			        	$usuarioVar->setUsv_categoria_funcional($_POST['categoria']);
			        	
			        	//print_r($usuarioVar);
			        	$usuarioVarController->insert($usuarioVar);
			        	
		        	if ($_POST['perfil'] == 2){
		        		print_r($_SESSION['USR']);
		        		$u = unserialize($_SESSION['USR']);
						$escola = $u['escola'];
						
			        	$grupoController = new GrupoController();
			        	$grupo = new Grupo();
			        	$grupo->setGrp_escola($escola);
			        	$grupo->setGrp_grupo($_POST['nome']);
			        	$grupo->setGrp_professor($idUsuario);
			        	//print_r($grupo);
			        	$grupoController->insert($grupo);

			        }
		        	
		        	$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
		        	
		        }else $result = Array('erro'=>true,'msg'=>'Erro ao cadastrar!');
		        	
	    	}else $result = Array('erro'=>true,'msg'=>'Erro ao cadastrar!');
       	}
    	echo json_encode($result);
        break;
    }
    
    case "cadastraEscola":{
    	
    	//print_r($_POST);
    	
    	$result = '';
    	$escolaController = new EscolaController();
     	$enderecoController = new EnderecoController();
     	$usuarioController = new UsuarioController();
     	
       	if ($escolaController->verificaCnpj($_POST['cnpj']) > 0){
        	$result = Array('erro'=>true,'msg'=>'CNPJ já cadastrado!');
        	
        }else if ($enderecoController->verificaEmail($_POST['emailEscola']) > 0){
        	$result = Array('erro'=>true,'msg'=>'Email já cadastrado!');
        
		        	//Login será vazio se estiver fazendo um pré-cadastro
        }else if (($_POST["loginEscola"] != '') && ($usuarioController->verificaLogin($_POST["loginEscola"]))){
        	$result = Array('erro'=>true,'msg'=>'Nome de usuário já cadastrado!');
        }
        
        if ($result == ''){
        	
	    	$endereco = new Endereco();
	    	$endereco->setend_logradouro(utf8_decode($_POST["enderecoEscola"]));
	    	$endereco->setend_numero($_POST["numeroEnderecoEscola"]);
	    	$endereco->setend_cep($_POST["cepEscola"]);
	    	$endereco->setend_cidade(utf8_decode($_POST["cidadeEscola"]));
	    	$endereco->setend_bairro(utf8_decode($_POST["bairroEscola"]));
	    	$endereco->setend_complemento(utf8_decode($_POST['complemento']));
	    	$endereco->setend_email($_POST["emailEscola"]);
	    	$endereco->setend_uf($_POST['ufEscola']);
	    	$endereco->setend_pais('Brasil');
	    	$endereco->setend_telefone_residencial($_POST["telefoneEscola"]);
	    	$endereco->setend_telefone_celular(null);
	    	$endereco->setend_telefone_comercial(null);
	    	$enderecoController = new EnderecoController();
	    	 
	    	$idEndereco = $enderecoController->insert($endereco);
	    	
	    	if($idEndereco){
	    		
	    		$escola = new Escola();
	    		$escola->setesc_administracao($_POST['adm']);
	    		$escola->setesc_cnpj($_POST['cnpj']);
	    		$escola->setesc_endereco($idEndereco);
	    		$escola->setesc_nome(utf8_decode($_POST['nomeEscola']));
	    		$escola->setesc_razao_social(utf8_decode($_POST['razao']));
	    		$escola->setesc_tipo_escola($_POST['tipoEscola']);
	    		$escola->setesc_status($_POST['status']);
	    		$escola->setesc_codigo($_POST['codigoEscola']);
	    		$escola->setEsc_nome_diretor($_POST['nomeDiretor']);
	    		$escola->setEsc_email_diretor($_POST['emailDiretor']);
	    		$escola->setEsc_nome_coordenador($_POST['nomeCoordenador']);
	    		$escola->setEsc_email_coordenador($_POST['emailCoordenador']);
				$idEscola = $escolaController->insert($escola);
				
				$usuario = new Usuario();
	    		$usuario->setUsr_nome(utf8_decode($_POST['nomeEscola']));
	    		$usuario->setUsr_data_nascimento(null);
	    		$usuario->setUsr_endereco($idEndereco);
	    		$usuario->setUsr_escola($idEscola);
	    		$usuario->setUsr_perfil(4);
	    		$usuario->setUsr_login($_POST["loginEscola"]);
	    		$usuario->setUsr_senha($_POST["senhaEscola"]);
	    		$usuario->setUsr_data_entrada_escola(date("Y-m-d"));
	    		$usuario->setUsr_nse($_POST['nse']);
	    		
	    		if($usuarioController->insert($usuario)){
	    			$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
	    		}else{
	    			$result = Array('erro'=>true,'msg'=>'Erro ao cadastrar escola!');
	    		}
	    	}else{
	    		$result = Array('erro'=>true,'msg'=>'Erro ao cadastrar endereço daescola');
	    	}
	    	
    	}
    	echo json_encode($result);
    	break;
    }
    
    case 'listaProfessoresByEscolaAndSerie':{
    	$usuarioController = new UsuarioController();
    	$professores = $usuarioController->buscaProfessorByEscolaAndSerie($_POST['escola'], $_POST['serie']);
    	$html = '';

    	if (count($professores) > 0){
    		$html .= '<option value="" disabled selected>Selecione um professor</option>';
    		foreach ($professores as $p){
    			$html .= '<option value="'.$p['idUsuario'].'_'.$p['idGrupo'].'">'.utf8_encode($p['nome']).'</option>';
    		}
    	}else $html .= '<option value="" disabled selected>Nenhum professor encontrado</option>';
    	
    	echo $html;
    	break;
    }
    
    case 'listaEscolas':{
       	$escolaController = new EscolaController();
    	$escolas = $escolaController->selectAll();
    	$html = '';

    	$html .= '<option value="" disabled selected>Selecione a escola</option>';
    	foreach ($escolas as $esc){
    		$html .= '<option value="'.$esc->getesc_id().'_'.$p['idGrupo'].'">'.utf8_encode($esc->getesc_razao_social()).'</option>';
    	}
    	
    	echo $html;
    	break;
    }
}

?>
