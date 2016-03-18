<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Usuario.php');
include_once($path['beans'].'Perfil.php');
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
        $sql .= "usr_nse = ".$user->getUsr_nse().",";
        $sql .= "usr_perfil = ".$user->getUsr_perfil().",";
        $sql .= "usr_rg = ".$user->getUsr_rg().",";
        $sql .= "usr_cpf = ".$user->getUsr_cpf().",";
        $sql .= "usr_login = ".$user->getUsr_login().",";
        $sql .= "usr_senha = ".$user->getUsr_senha().",";
        $sql .= "usr_imagem = ".$user->getUsr_imagem();
        $sql .= " where usr_id = ".$user->getUsr_id()." limit 1";
        
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
                //$user->setUsr_login($qr["usr_login"]);
            	//$user->setUsr_senha($qr["usr_senha"]);
                
              	
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

		echo $sql;
		
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
        $sql .= "JOIN perfil prf ON usr.usr_perfil = prf.prf_id ";
        $sql .= "WHERE usr_perfil = 2 AND usr_escola = ".$idescola;
        $result = $this->retrieve($sql);
        $lista = Array();

        if (mysqli_num_rows($result) > 0) {
            while ($qr = mysqli_fetch_array($result)) {
                $professor = new Usuario();
                $professor->setUsr_id($qr["usr_id"]);
                $professor->setUsr_nome($qr["usr_nome"]);
                $professor->setUsr_data_nascimento($qr["usr_data_nascimento"]);
                $professor->setUsr_escola($qr["usr_escola"]);
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
        //echo $sql;
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);
    	
    	return $qr["usr_imagem"];
        
//                $user = new Usuario();
//                $user->setUsr_id($qr["usr_id"]);
//                $user->setUsr_nome($qr["usr_nome"]);
//                $user->setUsr_data_nascimento($qr["usr_data_nascimento"]);
//                $user->setUsr_endereco($qr["usr_endereco"]);
//                $user->setUsr_escola($qr["usr_escola"]);
//                $user->setUsr_data_entrada_escola($qr["usr_data_entrada_escola"]);
//                $user->setUsr_nse($qr["usr_nse"]);
//                $user->setUsr_perfil($qr["usr_perfil"]);
//                $user->setUsr_rg($qr["usr_rg"]);
//                $user->setUsr_cpf($qr["usr_cpf"]);
//                $user->setUsr_imagem($qr["usr_imagem"]);
//                //$user->setUsr_login($qr["usr_login"]);
//            	//$user->setUsr_senha($qr["usr_senha"]);
//                
//              	
//    	return $user;
     }
}
?>