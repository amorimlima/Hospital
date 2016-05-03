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
require_once ($paths["dao"]."RespostaTxtDAO.php");
require_once ($paths["dao"]."QuestaoDAO.php");

class RelatorioController {
	
	private $registroGaleriaDAO;
	private $usuarioDAO;
	private $exercicioDAO;
	private $respostaMultiplaDAO;
	private $liberarCapituloDAO;
	private $grupoDAO;
	private $respostaTextoDAO;
	private $questaoDAO;
	
	public function __construct()
	{
		$this->registroGaleriaDAO = new RegistroGaleriaDAO(new DataAccess());
		$this->usuarioDAO = new UsuarioDAO(new DataAccess());
		$this->exercicioDAO = new ExercicioDAO(new DataAccess());
		$this->respostaMultiplaDAO = new RespostaMultiplaDAO(new DataAccess());
		$this->liberarCapituloDAO = new LiberarCapituloDAO(new DataAccess());
		$this->grupoDAO = new GrupoDAO(new DataAccess());
		$this->respostaTextoDAO = new RespostaTxtDAO(new DataAccess());
		$this->questaoDAO = new QuestaoDAO(new DataAccess());
	}

	public function getListaVisualizacao($par)
	{
		if($par['perfil'] == 2){
			$result = $this->usuarioDAO->buscarAlunosGrafico($par);
			return $result;
		}
		else if($par['perfil'] == 4) {
			$result = $this->usuarioDAO->buscarProfessoresGrafico($par);
			return $result;
		}
	}

	public function getBarrasUsuario($par, $usuario)
	{
		if($par['grafico'] == 'graficoGaleria'){
			return $this->barrasGaleria($par, $usuario);
		}
		else if($par['grafico'] == 'graficoExercicios'){
			return $this->barrasExercicios($par, $usuario);
		}
	}

	public function barrasGaleria($par, $usuario)
	{
		if($par['perfil'] == 2){
			return $this->galeriaProfessor($par, $usuario);
		}
		if($par['perfil'] == 4){
			return $this->galeriaEscola($par, $usuario);
		}
	}

	public function galeriaProfessor($par, $usuario)
	{
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

	public function galeriaEscola($par, $usuario)
	{
		$acessosProfessor = $this->registroGaleriaDAO->registroGaleriaCountAcessosProfessor($usuario['id']);
		$downloadsProfessor = $this->registroGaleriaDAO->registroGaleriaCountDownloadProfessor($usuario['id']);
		$acessosUsuario = $this->registroGaleriaDAO->registroGaleriaCountAcessosUsuario($usuario['id']);
		$downloadsUsuario = $this->registroGaleriaDAO->registroGaleriaCountDownloadUsuario($usuario['id']);
		$totalAcessosProfessor = $acessosProfessor + $acessosUsuario;
		$totalDownloadsProfessor = $downloadsProfessor + $downloadsUsuario;

		$acessosEscola = $this->registroGaleriaDAO->registroGaleriaCountAcessosEscola($par['id']);
		$downloadsEscola = $this->registroGaleriaDAO->registroGaleriaCountDownloadEscola($par['id']);
		
		$pctAcessos = $acessosEscola > 0? $acessosProfessor/$acessosEscola : 0;
		$pctDownloads = $downloadsEscola > 0? $dowloadsProfessor/$downloadsEscola : 0;
		$result = array(
			'barra1' => $pctAcessos,
			'barra2' => $pctDownloads);
		return $result;
	}

	public function barrasExercicios($par, $usuario)
	{
		if($par['perfil'] == 2){
			return $this->exerciciosProfessor($par, $usuario);
		}
		if($par['perfil'] == 4){
			return $this->exerciciosEscola($par, $usuario);
		}
	}

	public function exerciciosProfessor($par, $usuario)
	{
		$exerciciosTempoUsuario = $this->exercicioDAO->exerciciosCompletosUsuario($par, $usuario);
		$exerciciosTextoUsuario = $this->respostaTextoDAO->countRespostasTextoUsuario($par, $usuario);
		$exerciciosMultiplaUsuario = $this->respostaMultiplaDAO->countRespostasUsuario($par, $usuario);
		$exerciciosMultiplaCorretas = $this->respostaMultiplaDAO->countRespostasCorretasUsuario($par, $usuario);

		$exerciciosTempo = $this->exercicioDAO->exerciciosTotaisUsuario($par, $usuario);
		$exerciciosTexto = $this->questaoDAO->textoTotaisUsuario($par, $usuario);
		$exerciciosMultipla = $this->respostaMultiplaDAO->multiplaTotaisUsuario($par, $usuario);

		$exerciciosTotaisUsuario =  $exerciciosTempoUsuario + $exerciciosTextoUsuario + $exerciciosMultiplaUsuario;
		$exerciciosTotais = $exerciciosTempo + $exerciciosTexto + $exerciciosMultipla;

		$pctCompletos = $exerciciosTotais > 0? $exerciciosTotaisUsuario / $exerciciosTotais : 0;
		$pctCorretos = $exerciciosMultipla > 0? $exerciciosMultiplaCorretas / $exerciciosMultipla : 0;
			
		$result = array(
			'barra1' => $pctCompletos,
			'barra2' => $pctCorretos);
		return $result;
	}

	public function exerciciosEscola($par, $usuario)
	{
		$exerciciosTempoProfessor = $this->exercicioDAO->exerciciosCompletosProfessor($par, $usuario);
		$exerciciosTextoProfessor = $this->respostaTextoDAO->countRespostasTextoProfessor($par, $usuario);
		$exerciciosMultiplaProfessor = $this->respostaMultiplaDAO->countRespostasProfessor($par, $usuario);
		$exerciciosMultiplaCorretas = $this->respostaMultiplaDAO->countRespostasCorretasProfessor($par, $usuario);

		$exerciciosTempo = $this->exercicioDAO->exerciciosTotaisProfessor($par, $usuario);
		$exerciciosTexto = $this->questaoDAO->textoTotaisProfessor($par, $usuario);
		$exerciciosMultipla = $this->respostaMultiplaDAO->multiplaTotaisProfessor($par, $usuario);

		$exerciciosTotaisProfessor =  $exerciciosTempoProfessor + $exerciciosTextoProfessor + $exerciciosMultiplaProfessor;
		$exerciciosTotais = $exerciciosTempo + $exerciciosTexto + $exerciciosMultipla;

		$pctCompletos = $exerciciosTotais > 0? $exerciciosTotaisProfessor / $exerciciosTotais : 0;
		$pctCorretos = $exerciciosMultipla > 0? $exerciciosMultiplaCorretas / $exerciciosMultipla : 0;
			
		$result = array(
			'barra1' => $pctCompletos,
			'barra2' => $pctCorretos);
		return $result;
	}

	public function getFiltros($par)
	{
		if ($par['filtro'] == "filtroLivro")
			return $this->getLivros($par);
		else if ($par['filtro'] == "filtroCapitulo")
			return $this->getCapitulos($par);
		else if ($par['filtro'] == "filtroSala")
			return $this->getSalas($par);
	}

	public function getLivros($par)
	{
		if($par['perfil'] == 2){
			return array();
		}
		else if($par['perfil'] == 4){
			$result = $this->liberarCapituloDAO->listaLivrosEscola($par);
			return $result;
		}
	}

	public function getCapitulos($par)
	{
		if ($par['perfil'] == 2){
			$result = $this->liberarCapituloDAO->listaCapitulosProfessor($par);
			return $result;
		}

		else if ($par['perfil'] == 4){
			$result = $this->liberarCapituloDAO->listaCapitulosEscola($par);
			return $result;
		}
	}

	public function getSalas($par)
	{
		if ($par['perfil'] == 2){
			$result = $this->grupoDAO->listaGruposProfessor($par);
			return $result;
		}
		else if ($par['perfil'] == 4){
			$result = $this->grupoDAO->listaGruposEscola($par);
			return $result;
		}
	}
}

?>