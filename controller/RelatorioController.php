<?php

if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}

$paths = $_SESSION['PATH_SYS'];
require_once ($paths["dao"]."RegistroGaleriaDAO.php");
require_once ($paths["dao"]."UsuarioDAO.php");
require_once ($paths["dao"]."ExercicioDAO.php");
require_once ($paths["dao"]."RespostaMultiplaDAO.php");
require_once ($paths["dao"]."LiberarCapituloDAO.php");
require_once ($paths["dao"]."GrupoDAO.php");

class RelatorioController {
	
	private $registroGaleriaDAO;
	private $usuarioDAO;
	private $exercicioDAO;
	private $respostaMultiplaDAO;
	private $liberarCapituloDAO;
	private $grupoDAO;
	
	public function __construct()
	{
		$this->registroGaleriaDAO = new RegistroGaleriaDAO(new DataAccess());
		$this->usuarioDAO = new UsuarioDAO(new DataAccess());
		$this->exercicioDAO = new ExercicioDAO(new DataAccess());
		$this->respostaMultiplaDAO = new RespostaMultiplaDAO(new DataAccess());
		$this->liberarCapituloDAO = new LiberarCapituloDAO(new DataAccess());
		$this->grupoDAO = new GrupoDAO(new DataAccess());
	}

	public function getListaVisualizacao($par)
	{
		if($par['perfil'] == 2){
			$result = $this->usuarioDAO->buscarAlunosGrafico($par);
			return $result;
		}
		elseif($par['perfil'] == 4) {
			$result = $this->usuarioDAO->buscarProfessoresGrafico($par);
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
			if($par['perfil'] == 4){
				//AQUI
			}
		}
		else if($par['grafico'] == 'graficoExercicios'){
			if($par['perfil'] == 2){
				$exerciciosTempoUsuario = $this->exercicioDAO->exerciciosCompletosUsuario($par, $usuario);
				$exerciciosMultiplaUsuario = $this->respostaMultiplaDAO->countRespostasUsuario($par, $usuario);
				$exerciciosMultiplaCorretas = $this->respostaMultiplaDAO->countRespostasCorretasUsuario($par, $usuario);

				$exerciciosTempo = $this->exercicioDAO->exerciciosTotaisUsuario($par, $usuario);
				$exerciciosMultipla = $this->respostaMultiplaDAO->multiplaTotaisUsuario($par, $usuario);

				$exerciciosTotaisUsuario =  $exerciciosTempoUsuario + $exerciciosMultiplaUsuario;
				$exerciciosTotais = $exerciciosTempo + $exerciciosMultipla;

				$pctCompletos = $exerciciosTotais > 0? $exerciciosTotaisUsuario / $exerciciosTotais : 0;
				$pctCorretos = $exerciciosMultipla > 0? $exerciciosMultiplaCorretas / $exerciciosMultipla : 0;

				$result = array(
					'barra1' => $pctCompletos,
					'barra2' => $pctCorretos);
				return $result;
			}
			if($par['perfil'] == 4){
				
			}
		}
	}

	public function getLivros($par)
	{
		if($par['perfil'] == 2){
			return array();
		}
	}

	public function getCapitulos($par)
	{
		if ($par['perfil'] == 2){
			$result = $this->liberarCapituloDAO->listaCapitulosProfessor($par);
			return $result;
		}
	}

	public function getSalas($par)
	{
		if ($par['perfil'] == 2){
			$this->grupoDAO->listaGruposProfessor($par);
		}
	}
}

?>