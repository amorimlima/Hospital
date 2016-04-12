<?php

if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}

$paths = $_SESSION['PATH_SYS'];
require_once ($paths["dao"]."RegistroGaleriaDAO.php");
require_once ($paths["dao"]."UsuarioDAO.php");

class RelatorioController {
	
	private $registroGaleriaDAO;
	private $usuarioDAO;
	private $exercicioDAO;
	
	public function __construct()
	{
		$this->registroGaleriaDAO = new RegistroGaleriaDAO(new DataAccess());
		$this->usuarioDAO = new UsuarioDAO(new DataAccess());
		$this->exercicioDAO = new ExercicioDAO(new DataAccess());
	}

	public function getListaVisualizacao($par)
	{
		if($par['perfil'] == 2){
			$result = $this->usuarioDAO->buscarAlunosGrafico($par);
			return $result;
		}
	}

	public function getBarrasUsuario($par, $usuario)
	{
		if($par['grafico'] == 'graficoGaleria'){
			if($par['perfil'] == 2){
				$acessosUsuario = $this->registroGaleriaDAO->registroGaleriaCountAcessosUsuario($usuario['id']);
				$dowloadsUsuario = $this->registroGaleriaDAO->registroGaleriaCountDownloadUsuario($usuario['id']);
				$acessosProfessor = $this->registroGaleriaDAO->registroGaleriaCountAcessosProfessor($par['id']);
				$downloadsProfessor= $this->registroGaleriaDAO->registroGaleriaCountDownloadProfessor($par['id']);
				$pctAcessos = $acessosProfessor > 0? $acessosUsuario/$acessosProfessor : 0;
				$pctDownloads = $downloadsProfessor > 0? $dowloadsUsuario/$downloadsProfessor : 0;
				$result = array(
					'barra1' => $pctAcessos,
					'barra2' => $pctDownloads);
				return $result;
			}
		}
		else if($par['grafico'] == 'graficoExercicios'){
			if($par['perfil'] == 2){
				$exerciciosUsuario = $this->exercicioDAO->exerciciosCompletosUsuario($par, $usuario);
				$exerciciosTotais = $this->exercicioDAO->exerciciosTotaisUsuario($par, $usuario);
			}
		}
	}
}

?>