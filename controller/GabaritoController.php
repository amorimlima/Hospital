<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'GabaritoDAO.php');
include_once($path['controller'].'GrupoController.php');
include_once($path['controller'].'UsuarioController.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GabaritoController
 *
 * @author Kevyn
 */
class GabaritoController {
    //put your code here
    
    private $gabaritoDAO;
    public function __construct()
	{
		$this->gabaritoDAO = new GabaritoDAO(new DataAccess());
	}
	
	public function insert($gab)
	{
		return $this->gabaritoDAO->insert($gab);
	}
	
	public function update($gab)
	{
		return $this->gabaritoDAO->update($gab);
	}
	
	public function delete($idgab)
	{
		return $this->gabaritoDAO->delete($idgab);
	}
	
	public function select($idgab)
	{
		$gab = $this->gabaritoDAO->select($idgab);
		return $gab;
	}
	
	public function selectAll()
	{
		$gab = $this->gabaritoDAO->selectFull();
		return $gab;
	}

	public function countMultiplaAluno($idEscola, $serie)
	{
		$gab = $this->gabaritoDAO->countMultiplaAluno($idEscola, $serie);
		return $gab;
	}

	public function countMultiplaProfessor($idProfessor)
	{
		$exercicios = 0;
		$grupoController = new GrupoController();
		$usuarioController = new UsuarioController();
		$grupos = $grupoController->selectProfessor($idProfessor);
		foreach ($grupos as $grupo) {
			$alunosGrupo = $usuarioController->buscaUsuarioGrupo($grupo->getGrp_id());
			foreach ($alunosGrupo as $aluno) {
				$exercicios += $this->gabaritoDAO->countMultiplaAluno($aluno['escola'], $aluno['serie']);
			}
		}
		return $exercicios;
	}

	public function countMultiplaEscola($idEscola)
	{
		$exercicios = 0;
		$usuarioController = new UsuarioController();
		$professores = $usuarioController->selectProfessorByEscola($idEscola);
		foreach ($professores as $professor) {
			$exercicios += $this->countMultiplaProfessor($professor->getUsr_id());
		}
		return $exercicios;
	}
}
