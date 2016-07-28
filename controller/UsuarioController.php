<?php
if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'UsuarioDAO.php'); 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioController
 *
 * @author Kevyn
 */
class UsuarioController {
    //put your code here
    
    private $usuarioDAO;
    public function __construct()
	{
		$this->usuarioDAO = new UsuarioDAO(new DataAccess());
	}
	
	public function insertComID($user){
		return $this->usuarioDAO->insertComID($user);
	}
	
	public function insert($user)
	{
		return $this->usuarioDAO->insert($user);
	}
	
	public function update($user)
	{
		return $this->usuarioDAO->update($user);
	}
	
	public function delete($iduser)
	{
		return $this->usuarioDAO->delete($iduser);
	}
	
	public function select($iduser)
	{
		$user = $this->usuarioDAO->select($iduser);
		return $user;
	}
        
    public function  selectbyPerfil($idescola){
        $user = $this->usuarioDAO->selectbyPerfil($idescola);
        return $user;
    }

    public function selectAll()
	{
		$user = $this->usuarioDAO->selectFull();
		return $user;
	}
	
	public function autenticaUsuario($usuario,$senha)
	{
		$user = $this->usuarioDAO->autenticaUsuario($usuario,$senha);
		return $user;
	}
	public function selectByPerfilUsuario($idPerfil){
		$user = $this->usuarioDAO->selectByPerfilUsuario($idPerfil);
		return $user;
	}
	public function idsHospital()
	{
		$user = $this->usuarioDAO->idsHospital();
		return $user;
	}
	
	public function ultimoIDUsuario(){
		return $this->usuarioDAO->ultimoIDUsuario();
	}
	
	public function buscaUsuarioByLetraNome($letraDigitada,$perfil_id,$escola)
	{
		$user = $this->usuarioDAO->buscaUsuarioByLetraNome($letraDigitada,$perfil_id,$escola);
		return $user;
	}	
	
	public function verificaLogin($login)
	{
		return $this->usuarioDAO->verificaLogin($login);
	}
	
	public function verificaCpfAluno($cpf)
	{
		return $this->usuarioDAO->verificaCpfAluno($cpf);
	}

	public function verificaCpfProfessor($cpf, $escola)
	{
		return $this->usuarioDAO->verificaCpfProfessor($cpf, $escola);
	}
	
	public function buscaAlunoSemGrupoBySerieEscola($serie, $idEscola)
	{
		$user = $this->usuarioDAO->buscaAlunoSemGrupoBySerieEscola($serie, $idEscola);
		return $user;
	}
	
	public function buscaProfessorByEscolaAndSerie($idEscola,$idSerie)
	{
		$user = $this->usuarioDAO->buscaProfessorByEscolaAndSerie($idEscola,$idSerie);
		return $user;
	}
	public function buscaFotoByIdUsuario($id)
	{
		$user = $this->usuarioDAO->buscaFotoByIdUsuario($id);
		return $user;
	}
	public function buscaUsuarioCompletoByPerfil($perfil)
	{
		$user = $this->usuarioDAO->buscaUsuarioCompletoByPerfil($perfil);
		return $user;
	}
	public function selectProfessorByEscola($idescola)
	{
		$user = $this->usuarioDAO->selectProfessorByEscola($idescola);
		return $user;
	}

	public function buscaUsuarioGrupo($grupo)
	{
		$user = $this->usuarioDAO->buscaUsuarioGrupo($grupo);
		return $user;
	}

	public function selectGeral($idUsuario)
	{
		$user = $this->usuarioDAO->selectGeral($idUsuario);
		return $user;
	}

	public function selectSemGrupoBySerie($idSerie)
	{
		$user = $this->usuarioDAO->selectSemGrupoBySerie($idSerie);
		return $user;
	}
	
	public function verificaEmail($mail)
	{
		$user = $this->usuarioDAO->selectEmail($mail);
		return $user;
	}	

	public function updateSenhaByUser($user)
	{
		$user = $this->usuarioDAO->updateSenhaByUser($user);
		return $user;
	}

	public function adicionarAlunosGrupo($idGrupo, $alunos)
	{
		return $this->usuarioDAO->adicionarAlunosGrupo($idGrupo, $alunos);
	}

	public function alunosPorProfessor($idProfessor)
	{
		return $this->usuarioDAO->alunosPorProfessor($idProfessor);
	}

	public function getFullDataById($idusr) {
		return $this->usuarioDAO->getFullDataById($idusr);
	}
}
?>
