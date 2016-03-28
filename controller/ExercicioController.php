<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ExercicioDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExercicioController
 *
 * @author Kevyn
 */
class ExercicioController {
    //put your code here
    
    private $exercicioDAO;
    public function __construct()
	{
		$this->exercicioDAO =  new ExercicioDAO(new DataAccess());
	}
	
	public function insertExercicio($exe)
	{
		return $this->exercicioDAO->insertExercicio($exe);
	}
	
	public function updateExercicio($exe)
	{
		return $this->exercicioDAO->update($exe);
	}
	
	public function deleteExercicio($idexe)
	{
		return $this->exercicioDAO->deleteExercicio($idexe);
	}
	
	public function selectByIdExercicio($idexe)
	{
		$exe = $this->exercicioDAO->selectByIdExercicio($idexe);
		return $exe;
	}
	
	public function selectAllExercicio()
	{
		$exe = $this->exercicioDAO->selectAllExercicio();
		return $exe;
	}

	public function selectAllExercicioBySerieCapituloLiberado($serie, $idEscola, $capitulo)
	{
		$exe = $this->exercicioDAO->selectAllExercicioBySerieCapituloLiberado($serie, $idEscola, $capitulo);
		return $exe;
	}
	
	public function selectAllExercicioBySerieCapitulo($serie, $capitulo)
	{
		$exe = $this->exercicioDAO->selectAllExercicioBySerieCapitulo($serie, $capitulo);
		return $exe;
	}

	public function selectExercicioProntosRegistroAcesso($idExercicio, $idUsuario)
	{
		$exe = $this->exercicioDAO->selectExercicioProntosRegistroAcesso($idExercicio, $idUsuario);
		return $exe;
	}
	
	public function selectExercicioProntoMultipla($idExercicio, $idUsuario)
	{
		$exe = $this->exercicioDAO->selectExercicioProntoMultipla($idExercicio, $idUsuario);
		return $exe;
	}

	public function selectExercicioProntoEscrita($idExercicio, $idUsuario)
	{
		$exe = $this->exercicioDAO->selectExercicioProntoEscrita($idExercicio, $idUsuario);
		return $exe;
	}

	public function selectCountExercicioNumQuestoes($exercicio)
	{
		$exe = $this->exercicioDAO->selectCountExercicioNumQuestoes($exercicio);
		return $exe;
	}	

	public function selectCountExercicioNumGabarito($exercicio)
	{
		$exe = $this->exercicioDAO->selectCountExercicioNumGabarito($exercicio);
	}

	public function countExerciciosAluno($idAluno)
	{
		$exe = $this->exercicioDAO->countExerciciosAluno($idAluno);
		return $exe;
	}

	public function countExerciciosAlunoCompletos($idAluno)
	{
		$exe = $this->exercicioDAO->countExerciciosAlunoCompletos($idAluno);
		return $exe;
	}		
}
?>
