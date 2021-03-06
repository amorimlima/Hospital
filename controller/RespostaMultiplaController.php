<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'RespostaMultiplaDAO.php');
include_once($path['controller'].'GrupoController.php');
include_once($path['controller'].'UsuarioController.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespostaMultiplaController
 *
 * @author Kevyn
 */
class RespostaMultiplaController {
    //put your code here
    
    private $respostaMultiplaDAO;
    public function __construct()
	{
		$this->respostaMultiplaDAO = new RespostaMultiplaDAO(new DataAccess());
	}
	
	public function insert($rem)
	{
		return $this->respostaMultiplaDAO->insert($rem);
	}
	
	public function update($rem)
	{
		return $this->respostaMultiplaDAO->update($rem);
	}
	
	public function delete($idrem)
	{
		return $this->respostaMultiplaDAO->delete($idrem);
	}
	
	public function select($idrem)
	{
		$rem = $this->respostaMultiplaDAO->select($idrem);
		return $rem;
	}
	
	public function selectAll()
	{
		$rem = $this->respostaMultiplaDAO->selectFull();
		return $rem;
	}

	public function countCorretasAluno($idAluno)
	{
		$rem = $this->respostaMultiplaDAO->countCorretasAluno($idAluno);
		return $rem;
	}

	public function countCorretasProfessor($idProfessor)
	{
		$exercicios = 0;
		$grupoController = new GrupoController();
		$usuarioController = new UsuarioController();
		$grupos = $grupoController->selectProfessor($idProfessor);
		foreach ($grupos as $grupo) {
			$alunosGrupo = $usuarioController->buscaUsuarioGrupo($grupo->getGrp_id());
			foreach ($alunosGrupo as $aluno) {
				$exercicios += $this->respostaMultiplaDAO->countCorretasAluno($aluno['id']);
			}
		}
		return $exercicios;
	}

	public function countCorretasEscola($idEscola)
	{
		$exercicios = 0;
		$usuarioController = new UsuarioController();
		$professores = $usuarioController->selectProfessorByEscola($idEscola);
		foreach ($professores as $professor) {
			$exercicios += $this->countCorretasProfessor($professor->getUsr_id());
		}
		return $exercicios;
	}

	public function selectAllQuestaoExeAluno($idExercicio,$idUsuario,$questao)
	{
		$rem = $this->respostaMultiplaDAO->selectQuestaoExByAluno($idExercicio,$idUsuario,$questao);
		return $rem;
	}
}
?>