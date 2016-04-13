<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Usuario.php');
include_once($path['beans'].'Perfil.php');
include_once($path['funcao'].'DatasFuncao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author Kevyn
 */
class UsuarioDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insertComID(Usuario $user)
     {
     	$sql  = "insert into usuario (";
     	$sql .= "usr_id,";
     	$sql .= "usr_nome,";
     	$sql .= "usr_data_nascimento,";
     	$sql .= "usr_endereco,";
     	$sql .= "usr_escola,";
     	$sql .= "usr_data_entrada_escola,";
     	$sql .= "usr_nse,";
     	$sql .= "usr_perfil,";
     	$sql .= "rg,";
     	$sql .= "usr_cpf,";
     	$sql .= "usr_login,";
     	$sql .= "usr_senha,";
     	$sql .= "usr_imagem";
     	$sql .= ") values (";
     	$sql .= "".$user->getUsr_id().",";
     	$sql .= "'".$user->getUsr_nome()."',";
     	$sql .= "'".$user->getUsr_data_nascimento()."',";
     	$sql .= "'".$user->getUsr_endereco()."',";
     	$sql .= "'".$user->getUsr_escola()."',";
     	$sql .= "'".$user->getUsr_data_entrada_escola()."',";
     	$sql .= "'".$user->getUsr_nse()."',";
     	$sql .= "'".$user->getUsr_perfil()."',";
     	$sql .= "'".$user->getUsr_rg()."',";
     	$sql .= "'".$user->getUsr_cpf()."',";
     	$sql .= "'".$user->getUsr_login()."',";
     	$sql .= "'".$user->getUsr_senha()."',";
     	$sql .= "'".$user->getUsr_imagem()."')";
     	//echo $sql;
     	return $this->execute($sql);
     }
     
     public function insert($user)
     {
         $sql  = "insert into usuario (";
         $sql .= "usr_nome,";
         $sql .= "usr_data_nascimento,";
         $sql .= "usr_endereco,";
         $sql .= "usr_escola,";
         $sql .= "usr_data_entrada_escola,";
         $sql .= "usr_nse,";
         $sql .= "usr_perfil,";
         $sql .= "usr_rg,";
         $sql .= "usr_cpf,";
         $sql .= "usr_login,";
         $sql .= "usr_senha,";
         $sql .= "usr_imagem";
         $sql .= ") values (";
         $sql .= "'".$user->getUsr_nome()."',";
         $sql .= "'".$user->getUsr_data_nascimento()."',";
         $sql .= "'".$user->getUsr_endereco()."',";
         $sql .= "'".$user->getUsr_escola()."',";
         $sql .= "'".$user->getUsr_data_entrada_escola()."',";
         $sql .= "'".$user->getUsr_nse()."',";
         $sql .= "'".$user->getUsr_perfil()."',";
         $sql .= "'".$user->getUsr_rg()."',";
         $sql .= "'".$user->getUsr_cpf()."',";
         $sql .= "'".$user->getUsr_login()."',";
         $sql .= "'".$user->getUsr_senha()."',";
         $sql .= "'".$user->getUsr_imagem()."')";
		//echo $sql;
    	return $this->executeAndReturnLastID($sql);
     }
     
     public function update($user)
     {
        $sql  = "update usuario set usr_nome = '".$user->getUsr_nome()."',";
    	$sql .= "usr_data_nascimento = '".$user->getUsr_data_nascimento()."',";
    	$sql .= "usr_endereco = ".$user->getUsr_endereco().",";
        $sql .= "usr_escola = '".$user->getUsr_escola()."',";
        $sql .= "usr_data_entrada_escola = '".$user->getUsr_data_entrada_escola()."',";
        $sql .= "usr_nse = '".$user->getUsr_nse()."',";
        $sql .= "usr_perfil = ".$user->getUsr_perfil().",";
        $sql .= "usr_rg = '".$user->getUsr_rg()."',";
        $sql .= "usr_cpf = '".$user->getUsr_cpf()."',";
        $sql .= "usr_login = '".$user->getUsr_login()."',";
        $sql .= "usr_senha = '".$user->getUsr_senha()."',";
        $sql .= "usr_imagem = '".$user->getUsr_imagem()."'";
        $sql .= " where usr_id = ".$user->getUsr_id()." limit 1";
//        echo $sql;
        return $this->execute($sql);
     }
     
     public function delete($iduser)
     {
         $sql = "delete from usuario where usr_id = ".$iduser."";
    	return $this->execute($sql); 
     }
     
     public function select($iduser)
     {
        $sql = "select * from usuario where usr_id = ".$iduser;
		//echo $sql;
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);
        
                $user = new Usuario();
                $user->setUsr_id($qr["usr_id"]);
                $user->setUsr_nome($qr["usr_nome"]);
                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $user->setUsr_endereco($qr["usr_endereco"]);
                $user->setUsr_escola($qr["usr_escola"]);
                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $user->setUsr_nse($qr["usr_nse"]);
                $user->setUsr_perfil($qr["usr_perfil"]);
                $user->setUsr_rg($qr["usr_rg"]);
                $user->setUsr_cpf($qr["usr_cpf"]);
                $user->setUsr_imagem($qr["usr_imagem"]);
                $user->setUsr_login($qr["usr_login"]);
            	$user->setUsr_senha($qr["usr_senha"]);
              	
            	//print_r($user);
    	return $user;
     }
     
     public function selectbyPerfil($idescola){
        $sql = "select * from usuario where usr_perfil <> 6 and usr_escola = ".$idescola."";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $user = new Usuario();
                $user->setUsr_id($qr["usr_id"]);
                $user->setUsr_nome($qr["usr_nome"]);
                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $user->setUsr_endereco($qr["usr_endereco"]);
                $user->setUsr_escola($qr["usr_escola"]);
                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $user->setUsr_nse($qr["usr_nse"]);
                $user->setUsr_perfil($qr["usr_perfil"]);
                $user->setUsr_rg($qr["usr_rg"]);
                $user->setUsr_cpf($qr["usr_cpf"]);
                $user->setUsr_login($qr["usr_login"]);
            	$user->setUsr_senha($qr["usr_senha"]);
            	$user->setUsr_imagem($qr["usr_imagem"]);
                array_push($lista, $user);
                
        }	
    	return $lista;
     }

     public function idsHospital()
     {
        $sql = "select * from usuario where usr_perfil = 3";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result)){
            array_push($lista, $qr["usr_id"]);
        }
        return $lista;
     }

	public function selectFull()
	{
        $sql = "select * from usuario";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

        
                $user = new Usuario();
                $user->setUsr_id($qr["usr_id"]);
                $user->setUsr_nome($qr["usr_nome"]);
                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $user->setUsr_endereco($qr["usr_endereco"]);
                $user->setUsr_escola($qr["usr_escola"]);
                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $user->setUsr_nse($qr["usr_nse"]);
                $user->setUsr_perfil($qr["usr_perfil"]);
                $user->setUsr_rg($qr["usr_rg"]);
                $user->setUsr_cpf($qr["usr_cpf"]);
                $user->setUsr_login($qr["usr_login"]);
            	$user->setUsr_senha($qr["usr_senha"]);
            	$user->setUsr_imagem($qr["usr_imagem"]);
                array_push($lista, $user);
                
        }	
    	return $lista;
     }


    public function selectByPerfilUsuario($p){
        $sql = "select * from usuario where usr_perfil = $p";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
            $user = new Usuario();
            $user->setUsr_id($qr["usr_id"]);
            $user->setUsr_nome($qr["usr_nome"]);
            $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
            $user->setUsr_endereco($qr["usr_endereco"]);
            $user->setUsr_escola($qr["usr_escola"]);
            $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
            $user->setUsr_nse($qr["usr_nse"]);
            $user->setUsr_perfil($qr["usr_perfil"]);
            $user->setUsr_rg($qr["usr_rg"]);
            $user->setUsr_cpf($qr["usr_cpf"]);
            $user->setUsr_login($qr["usr_login"]);
            $user->setUsr_senha($qr["usr_senha"]);
            $user->setUsr_imagem($qr["usr_imagem"]);
            array_push($lista, $user);
        }
        return $lista;
    }

    public function ultimoIDUsuario(){
    	$sql = "select * from usuario order by usr_id desc limit 1";
    	//echo $sql;
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);
    	//echo $qr["usr_id"];
    	return intval($qr["usr_id"]+1);
    }
     
	public function autenticaUsuario($usuario,$senha){
		$sql = "select * from usuario inner join perfil ON usr_perfil = prf_id
				where usr_login = '".$usuario."' and usr_senha = '".$senha."' limit 1";
		$user = array();
		$result = $this->retrieve($sql);
		if(mysqli_num_rows($result)>0){
    		$qr = mysqli_fetch_array($result);
    		$user = array(
				'usr_id' 	=> $qr["usr_id"],
    			'usr_nome' 	=> $qr["usr_nome"],
                'usr_escola'  => $qr["usr_escola"],
    			'prf_perfil'=> $qr["prf_perfil"],
                'prf_id'    => $qr["prf_id"],
    			'prf_url'	=> $qr["url"],
    			'prf_pagina'=> $qr["pagina"],
    			'usr_imagem'=> $qr["usr_imagem"]
			);
		}
		
		//print_r($u);
		return $user;
	}
	
	public function buscaUsuarioByLetraNome($letraDigitada,$perfil_id,$escola){
		
        $sql = "select * from usuario where usr_nome like '%".$letraDigitada."%'";	

        switch ($perfil_id) {
            //Perfil Aluno
            case 1:
                $sql .=" AND usr_perfil IN ( 1,2 ) AND usr_escola =".$escola;
                break;
            
            //Perfil Professor
            case 2:
                $sql .=" AND ((usr_perfil IN ( 1,2 ) AND usr_escola =".$escola.") OR usr_perfil = 3)";
                break;

            //Perfil NEC
            case 3:
                $sql .=" AND usr_perfil IN ( 2,3,4 )";
                break;

            //Perfil Escola
            case 4:
                $sql .=" AND ((usr_perfil IN (1,2) AND usr_escola = ".$escola.") OR usr_perfil IN ( 3,4 ))";
                break;

        }


		$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{        
			$user = new Usuario();
			$user->setUsr_id($qr["usr_id"]);
			$user->setUsr_nome($qr["usr_nome"]);
			$user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
			$user->setUsr_endereco($qr["usr_endereco"]);
			$user->setUsr_escola($qr["usr_escola"]);
			$user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
			$user->setUsr_nse($qr["usr_nse"]);
			$user->setUsr_perfil($qr["usr_perfil"]);
			$user->setUsr_rg($qr["usr_rg"]);
			$user->setUsr_cpf($qr["usr_cpf"]);
			$user->setUsr_imagem($qr["usr_imagem"]);
			array_push($lista, $user);                
        }
    	return $lista;
     }	
	
    public function verificaLogin($login)
    {
        $sql = "select count(*) as total from usuario where usr_login = '$login'";
    	$result = $this->retrieve($sql);
		$qr = mysqli_fetch_array($result);
		return $qr["total"];	
    }
 
	public function verificaCpf($cpf)
    {
        $sql = "select count(*) as total from usuario where usr_cpf = '$cpf'";
    	$result = $this->retrieve($sql);
		$qr = mysqli_fetch_array($result);
		return $qr["total"];	
    }
    
    public function buscaProfessorByEscolaAndSerie($idEscola, $idSerie){
    	
		$sql = "SELECT u.usr_id, u.usr_nome, g.grp_id 
					FROM usuario_variavel as uv inner join 
						(usuario as u inner join grupo as g on u.usr_id = g.grp_professor) 
							on u.usr_id = usv_usuario 
					WHERE u.usr_perfil = 2 and uv.usv_serie = $idSerie and  g.grp_escola = $idEscola";

		//echo $sql;
		
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result)){
      
			$user = array(
						'idUsuario' => $qr["usr_id"],
						'nome'		=> $qr['usr_nome'],
						'idGrupo'	=> $qr['grp_id']
					);
            array_push($lista, $user);
        }  
		return $lista;
	}

    public function selectProfessorByEscola($idescola)
    {
        $sql  = "SELECT * FROM usuario usr ";
        $sql .= "JOIN endereco end ON usr.usr_endereco = end.end_id ";
        $sql .= "JOIN escola esc ON usr.usr_escola = esc.esc_id ";
        $sql .= "JOIN perfil prf ON usr.usr_perfil = prf.prf_id ";
        $sql .= "WHERE usr_perfil = 2 AND usr_escola = ";
        $sql .= $idescola;
        $result = $this->retrieve($sql);
        $lista = Array();

        if (mysqli_num_rows($result) > 0) {
            while ($qr = mysqli_fetch_array($result)) {
                $professor = new Usuario();
                $professor->setUsr_id($qr["usr_id"]);
                $professor->setUsr_nome($qr["usr_nome"]);
                $professor->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $professor->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
                $professor->setUsr_rg($qr["usr_rg"]);
                $professor->setUsr_cpf($qr["usr_cpf"]);
                $professor->setUsr_login($qr["usr_login"]);
                $professor->setUsr_imagem($qr["usr_imagem"]);
                $professor->setUsr_nse($qr["usr_nse"]);

                $professor->setUsr_endereco(new Endereco());
                $professor->getUsr_endereco()->setend_logradouro($qr["end_logradouro"]);
                $professor->getUsr_endereco()->setend_numero($qr["end_numero"]);
                $professor->getUsr_endereco()->setend_complemento($qr["end_complemento"]);
                $professor->getUsr_endereco()->setend_bairro($qr["end_bairro"]);
                $professor->getUsr_endereco()->setend_cep($qr["end_cep"]);
                $professor->getUsr_endereco()->setend_cidade($qr["end_cidade"]);
                $professor->getUsr_endereco()->setend_uf($qr["end_uf"]);
                $professor->getUsr_endereco()->setend_pais($qr["end_pais"]);
                $professor->getUsr_endereco()->setend_telefone_residencial($qr["end_telefone_residencial"]);
                $professor->getUsr_endereco()->setend_telefone_comercial($qr["end_telefone_comercial"]);
                $professor->getUsr_endereco()->setend_telefone_celular($qr["end_telefone_celular"]);
                $professor->getUsr_endereco()->setend_email($qr["end_email"]);

                $professor->setUsr_escola(new Escola());
                $professor->getUsr_escola()->setesc_id($qr["esc_id"]);
                $professor->getUsr_escola()->setesc_razao_social($qr["esc_razao_social"]);
                $professor->getUsr_escola()->setesc_nome($qr["esc_nome"]);

                $professor->setUsr_perfil(new Perfil());
                $professor->getUsr_perfil()->setPrf_id($qr["prf_id"]);
                $professor->getUsr_perfil()->setPrf_perfil($qr["prf_perfil"]);
                $professor->getUsr_perfil()->setPrf_url($qr["url"]);
                $professor->getUsr_perfil()->setPrf_pagina($qr["pagina"]);

                array_push($lista, $professor);
            }
        }
        return $lista;
    }

	public function buscaFotoByIdUsuario($id)
     {
        $sql = "select usr_imagem from usuario where usr_id = ".$id;
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);
    	
    	return $qr["usr_imagem"];
        
     }
     
     public function buscaUsuarioCompletoByPerfil($perfil){
     	
     	switch ($perfil){
            //Perfil Aluno
            case '1':{
	     		$sql = " SELECT us.usr_id, us.usr_nome, us.usr_data_nascimento, us.usr_rg, 
	     					   us.usr_cpf, us.usr_login, us.usr_senha, us.usr_imagem,
	     					   pf.prf_id, pf.prf_perfil, es.esc_id, es.esc_razao_social, es.esc_nome, 
	     					   uv.usv_id, ano.ano_id, ano.ano_ano, s.sri_id, s.sri_serie as serie, 
	     					   g.grp_id, g.grp_grupo, prof.usr_id AS idProfessor, prof.usr_nome AS nomeProfessor, e.*
						FROM  `usuario` AS us
							INNER JOIN perfil AS pf ON us.usr_perfil = pf.prf_id
							left OUTER JOIN escola AS es ON us.usr_escola = es.esc_id
							INNER JOIN usuario_variavel AS uv ON us.usr_id = uv.usv_usuario
							left outer JOIN ano_letivo AS ano ON uv.usv_ano_letivo = ano.ano_id
							left outer JOIN serie AS s ON uv.usv_serie = s.sri_id
							INNER JOIN endereco AS e ON us.usr_endereco = e.end_id
							left OUTER JOIN grupo AS g ON uv.usv_grupo = g.grp_id
							left OUTER JOIN usuario AS prof ON g.grp_professor = prof.usr_id
						WHERE us.usr_perfil = 1";
	     		break;
   			}

          	case '2':{
	     		$sql = "SELECT us.usr_id, us.usr_nome, us.usr_data_nascimento, us.usr_rg, 
	     					   us.usr_cpf, us.usr_login, us.usr_senha, us.usr_imagem, 
	     					   pf.prf_id, pf.prf_perfil, es.esc_id, es.esc_razao_social, es.esc_nome,
	     					   uv.usv_id, uv.usv_serie as serie, gi.*,cat.*, e.*
						FROM usuario as us 
							INNER JOIN perfil AS pf ON us.usr_perfil = pf.prf_id
							left outer JOIN escola AS es ON us.usr_escola = es.esc_id
							INNER JOIN usuario_variavel AS uv ON us.usr_id = uv.usv_usuario
							left JOIN grau_instrucao AS gi ON uv.usv_grau_instrucao = gi.grt_id
							left JOIN categoria_funcional AS cat ON uv.usv_categoria_funcional = cat.ctf_id
							left OUTER JOIN endereco AS e ON us.usr_endereco = e.end_id
						WHERE us.usr_perfil = 2";
	     		
	     		//echo $sql;
	     		break;
   			}
   			
          	case '4':{
          		$sql = 'SELECT es.*, us.usr_id, us.usr_nome, us.usr_login, us.usr_senha, us.usr_imagem, us.usr_nse,
          					   pf.prf_id, pf.prf_perfil, te.tps_tipo_escola, adm.adm_administracao, e.*
						FROM `usuario` as us 
							INNER JOIN escola as es ON us.usr_escola = es.esc_id
							INNER JOIN perfil as pf ON us.usr_perfil = pf.prf_id
							INNER JOIN tipo_escola as te ON es.esc_tipo_escola = te.tps_id
							INNER JOIN administracao as adm ON es.esc_administracao = adm.adm_id
							INNER JOIN endereco AS e ON us.usr_endereco = e.end_id
						WHERE us.usr_perfil = 4';
          		break;
          	}
     	}
     	
     	$lista = array();

     	if ($sql != ''){
     		$dataFuncao = new DatasFuncao();
     		
     		$result = $this->retrieve($sql);
     		
	     	while ($qr = mysqli_fetch_array($result)){

    	 		$u = array(
	        		'idUsuario'		=> ( isset($qr['usr_id']) ? $qr['usr_id'] : "" ),
	        		'nomeUsuario'	=> ( isset($qr['usr_nome']) ? utf8_encode($qr['usr_nome']) : "" ),
	        		'dataNascimento'=> ( isset($qr['usr_data_nascimento']) ? $qr['usr_data_nascimento'] : "" ),
	     			'dataNascBR'	=> ( isset($qr['usr_data_nascimento']) ? $dataFuncao->dataBR($qr['usr_data_nascimento']) : "" ),
	        		'rg'			=> ( isset($qr['usr_rg']) ? $qr['usr_rg'] : "" ),
	        		'cpf'			=> ( isset($qr['usr_cpf']) ? $qr['usr_cpf'] : "" ),
	        		'login'			=> ( isset($qr['usr_login']) ? $qr['usr_login'] : "" ),
	        		'senha'			=> ( isset($qr['usr_senha']) ? $qr['usr_senha'] : "" ),
	        		'imagem'		=> ( isset($qr['usr_imagem']) ? $qr['usr_imagem'] : "" ),
	        		'idPerfil'		=> ( isset($qr['prf_id']) ? $qr['prf_id'] : "" ),
	        		'perfil'		=> ( isset($qr['prf_perfil']) ? utf8_encode($qr['prf_perfil']) : "" ),
	        		'idEscola'		=> ( isset($qr['esc_id']) ? $qr['esc_id'] : "" ),
	        		'nomeEscola'	=> ( isset($qr['esc_nome']) ? utf8_encode($qr['esc_nome']) : "" ),
	        		'razaoEscola'	=> ( isset($qr['esc_razao_social']) ? utf8_encode($qr['esc_razao_social']) : "" ),
	     			'cnpj'			=> ( isset($qr['esc_cnpj']) ? utf8_encode($qr['esc_cnpj']) : "" ),
	     			'status'		=> ( isset($qr['esc_status']) ? utf8_encode($qr['esc_status']) : "" ),
	     			'site'			=> ( isset($qr['esc_site']) ? utf8_encode($qr['esc_site']) : "" ),
	     			'nomeDiretor'	=> ( isset($qr['esc_nome_diretor']) ? utf8_encode($qr['esc_nome_diretor']) : "" ),
	     			'emailDiretor'	=> ( isset($qr['esc_email_diretor']) ? utf8_encode($qr['esc_email_diretor']) : "" ),
	     			'nomeCoord'		=> ( isset($qr['esc_nome_coordenador']) ? utf8_encode($qr['esc_nome_coordenador']) : "" ),
	     			'emailCoord'	=> ( isset($qr['esc_email_coordenador']) ? utf8_encode($qr['esc_email_coordenador']) : "" ),
	     			'codigo'		=> ( isset($qr['esc_codigo']) ? utf8_encode($qr['esc_codigo']) : "" ),
	        		'idUsuarioVar'	=> ( isset($qr['usv_id']) ? $qr['usv_id'] : "" ),
	        		'idAno'			=> ( isset($qr['ano_id']) ? $qr['ano_id'] : "" ),
	        		'ano'			=> ( isset($qr['ano_ano']) ? $qr['ano_ano'] : "" ),
	        		'idSerie'		=> ( isset($qr['sri_id']) ? $qr['sri_id'] : "" ),
	        		'serie'			=> ( isset($qr['serie']) ? utf8_encode($qr['serie']) : "" ),
	        		'idGrupo'		=> ( isset($qr['grp_id']) ? $qr['grp_id'] : "" ),
	        		'grupo'			=> ( isset($qr['grp_grupo']) ? utf8_encode($qr['grp_grupo']) : "" ),
	        		'idProfessor'	=> ( isset($qr['idProfessor']) ? $qr['idProfessor'] : "" ),
	        		'nomeProfessor'	=> ( isset($qr['nomeProfessor']) ? utf8_encode($qr['nomeProfessor']) : "" ),
	        		'idEndereco' 	=> ( isset($qr['end_id']) ? $qr['end_id'] : "" ),
	        		'logradouro' 	=> ( isset($qr['end_logradouro']) ? utf8_encode($qr['end_logradouro']) : "" ),
	        		'numero' 		=> ( isset($qr['end_numero']) ? $qr['end_numero'] : "" ),
	        		'complemento' 	=> ( isset($qr['end_complemento']) ? utf8_encode($qr['end_complemento']) : "" ),
	        		'cep' 			=> ( isset($qr['end_cep']) ? $qr['end_cep'] : "" ),
	        		'bairro' 		=> ( isset($qr['end_bairro']) ? utf8_encode($qr['end_bairro']) : "" ),
	        		'cidade'		=> ( isset($qr['end_cidade']) ? utf8_encode($qr['end_cidade']) : "" ),	
		      		'uf'			=> ( isset($qr['end_uf']) ? $qr['end_uf'] : "" ),
	        		'pais' 			=> ( isset($qr['end_pais']) ? $qr['end_pais'] : "" ),
					'telResidencial'=> ( isset($qr['end_telefone_residencial']) ? $qr['end_telefone_residencial'] : "" ),
	        		'telComercial' 	=> ( isset($qr['end_telefone_comercial']) ? $qr['end_telefone_comercial'] : "" ),
	        		'telCelular' 	=> ( isset($qr['end_telefone_celular']) ? $qr['end_telefone_celular'] : "" ),
	        		'email' 		=> ( isset($qr['end_email']) ? $qr['end_email'] : "" ),
	     			'idInstrucao' 	=> ( isset($qr['grt_id']) ? $qr['grt_id'] : "" ),
	     			'instrucao' 	=> ( isset($qr['grt_instrucao']) ? utf8_encode($qr['grt_instrucao']) : "" ),
	     			'idCatFuncional'=> ( isset($qr['ctf_id']) ? $qr['ctf_id'] : "" ),
	     			'categoria'		=> ( isset($qr['ctf_categoria']) ? utf8_encode($qr['ctf_categoria']) : "" ),
	     			'idTipoEscola'	=> ( isset($qr['esc_tipo_escola']) ? $qr['esc_tipo_escola'] : "" ),
	     			'tipoEscola'	=> ( isset($qr['tps_tipo_escola']) ? $qr['tps_tipo_escola'] : "" ),
	     			'idAdm'			=> ( isset($qr['esc_administracao']) ? $qr['esc_administracao'] : "" ),
	     			'administracao'	=> ( isset($qr['adm_administracao']) ? $qr['adm_administracao'] : "" ),
    	 			'nse'			=> ( isset($qr['usr_nse']) ? $qr['usr_nse'] : "" )
	        	);

	        	array_push($lista, $u);
	     	}
	     	//print_r($lista);
     	}
	    return $lista;
     	
	     	
     }

     public function buscaUsuarioGrupo($grupo)
     {
        $sql  = "SELECT * FROM usuario us ";
        $sql .= "JOIN usuario_variavel uv ON uv.usv_usuario = us.usr_id ";
        $sql .= "WHERE uv.usv_grupo = ".$grupo;
        
        $result = $this->retrieve($sql);
        $lista = array();

        while ($qr = mysqli_fetch_array($result)){
            $item = Array(
                'id' => $qr['usr_id'],
                'nome' => $qr['usr_nome'],
                'escola' => $qr['usr_escola'],
                'serie' => $qr['usv_serie']
            );
            array_push($lista, $item);
        }

        return $lista;
     }

     public function selectGeral($idUsuario)
     {
        $sql  = "SELECT * FROM usuario us ";
        $sql .= "JOIN usuario_variavel uv ON uv.usv_usuario = us.usr_id ";
        $sql .= "WHERE us.usr_id = ".$idUsuario;

        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);

        $usuario = array(
            "id" => $qr['usr_id'],
            "nome" => $qr['usr_nome'],
            "perfil" => $qr['usr_perfil'],
            "escola" => $qr['usr_escola'],
            "imagem" => $qr['usr_imagem'],
            "serie" => $qr['usv_serie'],
            "grupo" => $qr['usv_grupo'],
            "id_variavel" => $qr['usv_id']);

        return $usuario;
     }

     public function buscarAlunosGrafico($par)
     {
        $sql = "SELECT * FROM usuario us ";
        $join = "JOIN usuario_variavel uv ON uv.usv_usuario = us.usr_id ";
        $join .= "JOIN grupo g ON g.grp_id = uv.usv_grupo AND g.grp_serie = uv.usv_serie ";
        $where = "WHERE g.grp_professor = ".$par['id']." AND us.usr_perfil = 1 ";
        if ($par['livro'] != 0){
            $where .= "AND g.grp_serie = ".$par['livro']." ";
        }
        if ($par['capitulo'] != 0){
            $join .= "JOIN liberar_capitulo lc ON lc.lbr_escola = us.usr_escola AND lc.lbr_livro = uv.usv_serie AND lc.lbr_capitulo = ".$par['capitulo']." ";
        }
        if ($par['sala'] != 0){
            $where .= "g.grp_id = ".$par['sala']." ";
        }

        $sql = $sql.$join.$where;
        $result = $this->retrieve($sql);
        $lista = Array();

        while ($qr = mysqli_fetch_array($result)){
            $item = Array(
                'id' => $qr['usr_id'],
                'nome' => $qr['usr_nome'],
                'perfil' => 'aluno',
                'escola' => $qr['usr_escola'],
                'serie' => $qr['usv_serie']
            );
            array_push($lista, $item);
        }
        return $lista;
     }
}
?>