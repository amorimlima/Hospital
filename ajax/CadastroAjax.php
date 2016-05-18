<?php
require_once /*$_SESSION['BASE_URL']*/'../_loadPaths.inc.php';
$path = $_SESSION['PATH_SYS'];
 
include_once($path['controller'].'UsuarioController.php');
include_once($path['controller'].'EnderecoController.php');
include_once($path['controller'].'EscolaController.php');
include_once($path['controller'].'UsuarioVariavelController.php');
include_once($path['controller'].'GrupoController.php');
include_once($path['controller'].'EnvioDocumentoController.php');
include_once($path['beans'].'Usuario.php');
include_once($path['beans'].'UsuarioVariavel.php');
include_once($path['beans'].'Escola.php');
include_once($path['beans'].'Endereco.php');
include_once($path['beans'].'Grupo.php');
include_once($path['beans'].'EnvioDocumento.php');
//require_once ($paths["funcao"]."Thumbs.php");

include_once($path['funcao'].'DatasFuncao.php');
include_once($path['funcao'].'Thumbs.php');

switch ($_REQUEST["acao"]) {
    case "novoUsuario":{
    	$result = '';
       	$enderecoController = new EnderecoController();
		$usuarioController = new UsuarioController();
		
		//Verificações o CPF
		//cpf só poderá vir vazio se for cadastro de um aluno
		if ($_POST['cpf'] != ''){
			//Confirma se está cadastrando um aluno e faz a verificação simples do cpf
			if ($_POST['perfil'] == '1'){
				$escola = $_POST['escola'];	//Salva na variavel $escola o valor vindo por ajax
				//Verificação de CPF para alunos
		    	if ($usuarioController->verificaCpfAluno($_POST['cpf']) > 0){
		        	$result = Array('erro'=>true,'msg'=>'CPF já cadastrado!');
		    	}

		    //Se for professor, pega o id da escola da sessão para verificar a disponibilidade do cpf em uma determinada escola
	        }else{
	        	$u = unserialize($_SESSION['USR']);
				$escola = $u['escola'];
	        	//chama o método de verficação do cpf do professor verificando a existencia do CPF em uma determinada escola.
	        	if ($usuarioController->verificaCpfProfessor($_POST['cpf'], $escola) > 0){
		        	$result = Array('erro'=>true,'msg'=>'CPF já cadastrado nessa escola!');
	        	}
	        }        	
        }
        
        //Verificações de email e login. Só entrará no IF se não tiver erro no cpf.
        if ($result == ''){
	        if (($enderecoController->verificaEmail($_POST['email']) > 0) && $_POST['email'] != ''){
	        	$result = Array('erro'=>true,'msg'=>'Email já cadastrado!');
	        
	        }else if ($usuarioController->verificaLogin($_POST["login"])){
	        	$result = Array('erro'=>true,'msg'=>'Nome de usuário já cadastrado!');
	        }
        }
		
       //Se não tiver nenhum erro, segue o cadastro. 
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
		        
		        $usuario->setUsr_escola($escola);
		        $usuario->setUsr_perfil($_POST['perfil']);
				$usuario->setUsr_imagem($_POST['imagem']);
				
				if ($idUsuario = $usuarioController->insert($usuario)){
		        	
		        		if ($_POST['imagem'] != ''){
				        	$imag = getimagesize("../temporaria/".$_POST["imagem"]);
						   	gerar_tumbs_real(100,100,100,"../temporaria/".$_POST["imagem"],"../imgm/".$_POST["imagem"]);
						   	gerar_tumbs_real(65,65,100,"../temporaria/".$_POST["imagem"],"../imgp/".$_POST["imagem"]);
				        }
			        
			        	$usuarioVarController = new UsuarioVariavelController();
			        	$usuarioVar = new UsuarioVariavel();
			        	$usuarioVar->setUsv_usuario($idUsuario);
			        	if (strlen($_POST['serie'])>1) $usuarioVar->setUsv_serie('null');
			        	 else $usuarioVar->setUsv_serie($_POST['serie']);
			        	$usuarioVar->setUsv_ano_letivo($_POST['ano']);
			        	$usuarioVar->setUsv_serie($_POST['serie']);
			        	$usuarioVar->setUsv_status('0');
			        	if ($_POST['grupo'] == '') $usuarioVar->setUsv_grupo('null');
			        		else $usuarioVar->setUsv_grupo($_POST['grupo']);
//			        	$usuarioVar->setUsv_grau_instrucao($_POST['grauInstrucao']);
//			        	$usuarioVar->setUsv_categoria_funcional($_POST['categoria']);
			        	$usuarioVar->setUsv_grau_instrucao('null');
			        	$usuarioVar->setUsv_categoria_funcional('null');
			        	
			        	$usuarioVarController->insert($usuarioVar);
	
		        	if ($_POST['perfil'] == 2){

		        		//Pega o id da escola pela sessão
		        		$u = unserialize($_SESSION['USR']);
						$escola = $u['escola'];
						
						//Chama os objetos
						$grupoController = new GrupoController();
			        	$grupo = new Grupo();
			        	
			        	//Preenche o objeto grupo com os dados que não vão mudar.
			        	$grupo->setGrp_escola($escola);
			        	$grupo->setGrp_professor($idUsuario);

			        	//Pega as séries e percorre elas salvando os grupos no banco.
			        	$series = explode(';', $_POST['serie']);
						array_pop($series);
		
						foreach($series as $s){
							$sp = explode('-', $s);
							
							if ($sp[1] == 1){
								$periodo = 'Manhã';
							}else{
								$periodo = 'Tarde';
							}
							
							$nomeGrupo = $_POST['nome'].' - '.$sp[0].' '.$periodo;
							$grupo->setGrp_grupo(utf8_decode($nomeGrupo));
							$grupo->setGrp_serie($sp[0]);
							$grupo->setGrp_periodo($sp[1]);
							
							$grupoController->insert($grupo);
						}
			        }
		        	
		        	$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
		        	
		        }else $result = Array('erro'=>true,'msg'=>'Erro ao cadastrar usuário!');
		        	
	    	}else $result = Array('erro'=>true,'msg'=>'Erro ao cadastrar endereço!');
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
     	$usuarioVarController = new UsuarioVariavelController();
     	
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
//	    	echo $idEndereco;
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
	    		$usuario->setUsr_imagem($_POST['imagem']);
	    		
	    		if ($_POST['imagem'] != ''){
				    $imag = getimagesize("../temporaria/".$_POST["imagem"]);
					gerar_tumbs_real(100,100,100,"../temporaria/".$_POST["imagem"],"../imgm/".$_POST["imagem"]);
					gerar_tumbs_real(65,65,100,"../temporaria/".$_POST["imagem"],"../imgp/".$_POST["imagem"]);
				}
				
				if (isset($_POST['preCadastro'])){
					$_SESSION['idEscolaPre'] = $idEscola;
				}
				
	    		if($idUsuario = $usuarioController->insert($usuario)){
	    			$usuarioVar = new UsuarioVariavel();
		    		$usuarioVar->setUsv_usuario($idUsuario);
		    		$usuarioVar->setUsv_status('0');
		    		$usuarioVarController->insert($usuarioVar);
		    		
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
    
    case "editarUsuario":{

    	$result = '';
       	$enderecoController 	= 	new EnderecoController();
		$usuarioController 		= 	new UsuarioController();
		
		$endereco 	= 	$enderecoController->select($_POST['idEndereco']);
    	$usuario 	= 	$usuarioController->select($_POST['idUsuario']);
    	//print_r($usuario);
    	//Verifica se foi alterado e depois se esses dados não estão cadastrados para outros usuários.
        if ($_POST['perfil'] == '1'){
        	if ($_POST['cpf'] != $usuario->getUsr_cpf()){
        	
        		if ($usuarioController->verificaCpfAluno($_POST['cpf']) > 0)
        			$result = Array('erro'=>true,'msg'=>'CPF já cadastrado!');
        	}
       	}
       	if ($result == ''){
       		if ($_POST['email'] != ''){
	       		if ($_POST['email'] != $endereco->getend_email()){
		         	if ($enderecoController->verificaEmail($_POST['email']) > 0){
	        			$result = Array('erro'=>true,'msg'=>'Email já acadastrado!');
	         		}
	        	}
       		}
       	}
       	if ($result == ''){
	        if ($_POST['login'] != $usuario->getUsr_login()){
	        	if ($usuarioController->verificaLogin($_POST["login"]))
	        		$result = Array('erro'=>true,'msg'=>'Nome de usuário já cadastrado!');
	        }
       	}
        
        
        
       	if ($result == ''){
       		
       		//$grupoController 		= 	new GrupoController();
			$usuarioVarController	=	new UsuarioVariavelController();
			//$grupo 		= 	$grupoController->select($_POST['grupo']);
	    	$usuarioVar	=	$usuarioVarController->select($_POST['idUsuarioVar']);
    	
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
	    	$endereco->setend_id($_POST['idEndereco']);
	    	$enderecoController->update($endereco);
	    	
	    	$dataFuncao = new DatasFuncao();

	    	$imagemAntiga = $usuario->getUsr_imagem();
	    	
	    	$usuario->setUsr_login($_POST["login"]);
	        if ($_POST["senha"] != '') $usuario->setUsr_senha($_POST["senha"]);
	        $usuario->setUsr_nome(utf8_decode($_POST['nome']));
	        $usuario->setUsr_data_nascimento($dataFuncao->dataUSA($_POST['nascimento']));
	        $usuario->setUsr_endereco($_POST['idEndereco']);
	        $usuario->setUsr_rg($_POST['rg']);
	        $usuario->setUsr_cpf($_POST['cpf']);
	        $usuario->setUsr_nse($_POST['nse']);
	        if ($_POST['escola'] != '') $usuario->setUsr_escola($_POST['escola']);
			$usuario->setUsr_imagem($_POST['imagem']);
			$usuario->setUsr_id($_POST['idUsuario']);
			$usuarioController->update($usuario);
			
			//Verifica se a imagem vem com o formulário e se é uma outra imagem.
       		if ($_POST['imagem'] != ''){
				if ($_POST['imagem'] != $imagemAntiga){
				    $imag = getimagesize("../temporaria/".$_POST["imagem"]);
					gerar_tumbs_real(100,100,100,"../temporaria/".$_POST["imagem"],"../imgm/".$_POST["imagem"]);
					gerar_tumbs_real(65,65,100,"../temporaria/".$_POST["imagem"],"../imgp/".$_POST["imagem"]);
					$usuario->setUsr_imagem($_POST['imagem']);
				}
	    	}

			$usuarioVar->setUsv_serie($_POST['serie']);
			$usuarioVar->setUsv_ano_letivo($_POST['ano']);
			$usuarioVar->setUsv_serie($_POST['serie']);
			if ($_POST['grupo'] == '') $usuarioVar->setUsv_grupo('null');
				else $usuarioVar->setUsv_grupo($_POST['grupo']);
			$usuarioVar->setUsv_grau_instrucao($_POST['grauInstrucao']);
			$usuarioVar->setUsv_categoria_funcional($_POST['categoria']);
			$usuarioVar->setUsv_id($_POST['idUsuarioVar']);
			$usuarioVarController->update($usuarioVar);
			//print_r($usuarioVar);
			
		    if ($_POST['perfil'] == 2){
			    $grupoController = new GrupoController();
			    //$grupo = $grupoController->select($_POST['idGrupo']);
			    //$grupos = $grupoController->selectByProfessor($_POST['idUsuario']);
			    
			    $series = explode(';', $_POST['serie']);
				array_pop($series);
				
				foreach ($series as $s){
					$grp = explode('-', $s);
					//Se o array formado tiver tamanho 1, deve ser excluido
					//Tamanho 2, deve ser adicionado um grupo para o professor
					//e se tiver do tamanho 3 deve ser editado
					if (count($grp) > 1 ){
						
						if ($grp[1] == 1) $periodo = 'Manhã';
							else $periodo = 'Tarde';
						$nomeGrupo = $_POST['nome'].' - '.$grp[0].' '.$periodo;
						
						if (count($grp) > 2 ){
							$grupo = $grupoController->select($grp[2]);
							$grupo->setGrp_grupo(utf8_decode($nomeGrupo));
							$grupo->setGrp_serie($grp[0]);
							$grupo->setGrp_periodo($grp[1]);
							$grupoController->update($grupo);
							
						}else{
							//Pega o id da escola pela sessão
							if (!isset($escola)){ 
		        				$u = unserialize($_SESSION['USR']);
								$escola = $u['escola'];
							}
							
							$grupo = new Grupo();
							$grupo->setGrp_grupo(utf8_decode($nomeGrupo));
							$grupo->setGrp_serie($grp[0]);
							$grupo->setGrp_periodo($grp[1]);
							$grupo->setGrp_professor($_POST['idUsuario']);
							$grupo->setGrp_escola($escola);
							$grupoController->insert($grupo);
							
						}
					}else{
						$grupoController->delete($grp[0]);
						$usuarioVarController->removeGrupoByIdGrupo($grp[0]); 
					}
				}
			}

			$result = Array('erro'=>false,'msg'=>'Cadastrou com sucesso!');
       	}
       	
    	echo json_encode($result);
        
    
    break;
    }
    
    case 'editarEscola':{
    	$enderecoController = new EnderecoController();
    	$escolaController 	= new EscolaController();
    	$usuarioController 	= new UsuarioController();
    	
    	$endereco 	= $enderecoController->select($_POST['idEndereco']);
    	$usuario 	= $usuarioController->select($_POST['idUsuario']);
    	$escola = $escolaController->select($_POST['idEscola']);
    	
	   	if ($_POST['emailEscola'] != $endereco->getend_email()){
	    	if ($enderecoController->verificaEmail($_POST['emailEscola']) > 0){
	        	$result = Array('erro'=>true,'msg'=>'Email já cadastrado!');
	    	}
        }
        if (!isset($result)){
	        if ($_POST["loginEscola"] != $usuario->getUsr_login()){
	        	if ($usuarioController->verificaLogin($_POST["loginEscola"])){
	        		$result = Array('erro'=>true,'msg'=>'Nome de usuário já cadastrado!');
	        	}
	        }
        }
    	
    	if (!isset($result)){
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
		    $endereco->setend_id($_POST['idEndereco']);
	    	$enderecoController->update($endereco);
			
	    	$imagemAntiga = $usuario->getUsr_imagem();
	    	$escola->setesc_administracao($_POST['adm']);
	    	$escola->setesc_endereco($_POST['idEndereco']);
	    	$escola->setesc_nome(utf8_decode($_POST['nomeEscola']));
	    	$escola->setesc_razao_social(utf8_decode($_POST['razao']));
	    	$escola->setesc_tipo_escola($_POST['tipoEscola']);
	    	$escola->setesc_status($_POST['status']);
	    	//$escola->setesc_codigo($_POST['codigoEscola']);
	    	//$escola->setEsc_nome_diretor($_POST['nomeDiretor']);
	    	//$escola->setEsc_email_diretor($_POST['emailDiretor']);
	    	//$escola->setEsc_nome_coordenador($_POST['nomeCoordenador']);
	    	//$escola->setEsc_email_coordenador($_POST['emailCoordenador']);
			$escolaController->update($escola);
	
			if ($_POST['imagem'] != ''){
				if ($_POST['imagem'] != $imagemAntiga){
				    $imag = getimagesize("../temporaria/".$_POST["imagem"]);
					gerar_tumbs_real(100,100,100,"../temporaria/".$_POST["imagem"],"../imgm/".$_POST["imagem"]);
					gerar_tumbs_real(65,65,100,"../temporaria/".$_POST["imagem"],"../imgp/".$_POST["imagem"]);
					$usuario->setUsr_imagem($_POST['imagem']);
				}
	    	}
	    	
			$usuario->setUsr_nome(utf8_decode($_POST['nomeEscola']));
	    	$usuario->setUsr_login($_POST["loginEscola"]);
	    	if ($_POST["senhaEscola"] != '') $usuario->setUsr_senha($_POST["senhaEscola"]);
	    	$usuario->setUsr_nse($_POST['nse']);
	    	$usuarioController->update($usuario);
	    	
	    	$result = Array('erro'=>false,'msg'=>'Editou com sucesso!');
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
    			$html .= '<option value="'.$p['idUsuario'].'_'.$p['idGrupo'].'">'.utf8_encode($p['nome']).' ('.$p['periodo'].') </option>';
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
    		//print_r($esc);
    		$html .= '<option value="'.$esc->getesc_id().'_'.$p['idGrupo'].'">'.utf8_encode($esc->getesc_razao_social()).'</option>';
    	}
    	
    	echo $html;
    	break;
    }
    
	case "selecImagem":{
		//$nome = $_GET['nomeInput'];
		$nome = 'arquivo';
		$permitido = array('image/jpg','image/jpeg','image/pjpeg');
		if($_FILES[$nome]["name"]){
			if(in_array($_FILES[$nome]["type"], $permitido)){
				if($_FILES[$nome]["size"] < 1048576){
					$nomeImg = "_".md5(uniqid(rand(),true)).".jpg";
					$diretorio = "../temporaria/".$nomeImg;
					$arquivo_temporario = $_FILES[$nome]["tmp_name"];
					if(move_uploaded_file($arquivo_temporario,$diretorio)){
						$retorno = Array('erro'=>'0','msg'=>'','img'=>$nomeImg);
					}else{
						$retorno = Array('erro'=>'1','msg'=>'Erro ao fazer Upload da imagem!!!','img' =>'');
					}
	
				}else{
					$retorno = Array('erro'=>'1','msg' => 'Erro: O limite da imagem é de até 1MB !!!','img' =>'');
				}
			}else{
				$retorno = Array('erro'=>'1','msg'=>'Atenção: Somente Imagem JPG !!!','img' =>'');
			}
	
		}else{
			$retorno = Array('erro'=>'1','msg'=>'Atenção: Escolha um arquivo !!!','img' =>'');
		}
		echo json_encode($retorno);
		break;
	}
	case "listaPendentes": {
		$escolasController = new EscolaController();
		$pre_cadastros = $escolasController->selectPendentes();
		$lista = Array();

		if ( count($pre_cadastros) > 0 ) {
			foreach($pre_cadastros as $escola => $valor) {
				$result = Array(
					"id" 			=> utf8_encode($valor->getEsc_id()),
					"razaoSocial" 	=> utf8_encode($valor->getEsc_razao_social()),
					"nome" 			=> utf8_encode($valor->getEsc_nome()),
					"cnpj"			=> utf8_encode($valor->getEsc_cnpj()),
					"endereco"		=> Array(
						"id"			=> utf8_encode($valor->getesc_endereco()->getend_id()),
						"logradouro"	=> utf8_encode($valor->getesc_endereco()->getend_logradouro()),
						"numero"		=> utf8_encode($valor->getesc_endereco()->getend_numero()),
						"complemento"	=> utf8_encode($valor->getesc_endereco()->getend_complemento()),
						"bairro"		=> utf8_encode($valor->getesc_endereco()->getend_bairro()),
						"cep"			=> utf8_encode($valor->getesc_endereco()->getend_cep()),
						"cidade"		=> utf8_encode($valor->getesc_endereco()->getend_cidade()),
						"uf"			=> utf8_encode($valor->getesc_endereco()->getend_uf()),
						"pais"			=> utf8_encode($valor->getesc_endereco()->getend_pais()),
						"tel_res"		=> utf8_encode($valor->getesc_endereco()->getend_telefone_residencial()),
						"tel_com"		=> utf8_encode($valor->getesc_endereco()->getend_telefone_comercial()),
						"tel_cel"		=> utf8_encode($valor->getesc_endereco()->getend_telefone_celular()),
						"email"			=> utf8_encode($valor->getesc_endereco()->getend_email())
					),
					"tipo"			=> Array(
						"id"			=> utf8_encode($valor->getEsc_tipo_escola()->getTps_id()),
						"tipo_escola"	=> utf8_encode($valor->getEsc_tipo_escola()->getTps_tipo_escola())
					),
					"administracao"	=> Array(
						"id" 			=> utf8_encode($valor->getEsc_administracao()->getadm_id()),
						"administracao"	=> utf8_encode($valor->getEsc_administracao()->getadm_administracao())
					),
					"status"		=> utf8_encode($valor->getEsc_status()),
					"site"			=> utf8_encode($valor->getEsc_site()),
					"diretor"		=> utf8_encode($valor->getEsc_nome_diretor()),
					"emailDiretor"	=> utf8_encode($valor->getEsc_email_diretor()),
					"coordenador"	=> utf8_encode($valor->getEsc_nome_coordenador()),
					"emailCoord"	=> utf8_encode($valor->getEsc_email_coordenador()),
					"codigo"		=> utf8_encode($valor->getEsc_codigo())
				);
				array_push($lista, $result);
			}
		} else {
			$result = Array("status"=>false);
			array_push($lista,$result);
		}
		echo json_encode($lista);		
		break;
	}
	case "confirm": {
		$escolasController = new EscolaController();
		$idesc = $_REQUEST["id"];
		$result = "";

		if ($confirmacao = $escolasController->confirmCadastro($idesc))
			$result = Array("status"=>"1", "mensagem"=>"Cadastro confirmado com sucesso!");
		else
			$result = Array("status"=>"0", "mensagem"=>"Erro ao confirmar o cadastro.");

		echo json_encode($result);

		break;
	}
	case "reject": {
		$escolasController = new EscolaController();
		$idesc = $_REQUEST["id"];
		$result = "";

		if ($confirmacao = $escolasController->rejectCadastro($idesc))
			$result = Array("status"=>"1", "mensagem"=>"Cadastro rejeitado com sucesso!");
		else
			$result = Array("status"=>"0", "mensagem"=>"Erro ao rejeitar o cadastro.");

		echo json_encode($result);

		break;
	}
	case "requestPdf": {
		$envioDocumentoController = new EnvioDocumentoController();
		$idesc = $_REQUEST["id"];
		$doc = $envioDocumentoController->selectDocPorEscola($idesc);
		$result = "";

		if (!empty($doc)) {
			$result = Array(
				"id" 			 => utf8_encode($doc->getEnv_id()),
				"idEscola"	 	 => utf8_encode($doc->getEnv_idEscola()),
				"idRemetente"	 => utf8_encode($doc->getEnv_idRemetente()),
				"idDestinatario" => utf8_encode($doc->getEnv_idDestinatario()),
				"url"	 		 => $path["arquivos"].utf8_encode($doc->getEnv_url()),
				"Visto"	 		 => utf8_encode($doc->getVisto()),
				"status"		 => true
			);
		} else {
			$result = Array("status" => false);
		}

		echo json_encode($result);
		break;
	}	
	case "listaUsuariosCompleto":{
		$usuarioController = new UsuarioController();
		$usuarios = $usuarioController->buscaUsuarioCompletoByPerfil($_POST['perfil']);
		echo json_encode($usuarios);
		break;
	}
	
	case "BuscaGruposByIdProfessor":{
		$grupoController = new GrupoController();
		$grupos = $grupoController->selectByProfessor($_POST['idProfessor']);
		$result = Array();
		foreach ($grupos as $g){
			$grp = Array(
				"idGrupo"	=> $g->getGrp_id(),
				"idSerie"	=> $g->getGrp_serie(),
				"idPeriodo"	=> $g->getGrp_periodo()
			);
			array_push($result, $grp);
		}
		echo json_encode($result);
		break;
	}
	
	case "excluirUsuario":{
		$usuarioVarController = new UsuarioVariavelController();
		if ($usuarioVarController->delete($_POST['idUsuarioVar'])){
			$result = Array('erro' => false);
		}else $result = Array('erro' => true, 'mensagem' => 'Erro ao exluir.');
		
		echo json_encode($result);
		//echo 'exluir';
		//print_r($_POST);
		break;
	}
}

?>