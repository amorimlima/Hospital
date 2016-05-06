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
require_once ($paths["dao"]."EscolaDAO.php");

class RelatorioController {
	
	private $registroGaleriaDAO;
	private $usuarioDAO;
	private $exercicioDAO;
	private $respostaMultiplaDAO;
	private $liberarCapituloDAO;
	private $grupoDAO;
	private $respostaTextoDAO;
	private $questaoDAO;
	private $escolaDAO;
	
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
		$this->escolaDAO = new EscolaDAO(new DataAccess());
	}

	public function getListaVisualizacao($par)
	{
		if($par['perfil'] == 2)
			return $this->usuarioDAO->buscarAlunosGrafico($par);
		
		else if($par['perfil'] == 4)
			return $this->usuarioDAO->buscarProfessoresGrafico($par);

		else if($par['perfil'] == 3)
			return $this->escolaDAO->buscarEscolasGrafico($par);
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
		if($par['perfil'] == 2)
			return $this->galeriaProfessor($par, $usuario);
		
		else if($par['perfil'] == 4)
			return $this->galeriaEscola($par, $usuario);

		else if($par['perfil'] == 3)
			return $this->galeriaHospital($par, $usuario);
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

	public function galeriaHospital($par, $usuario)
	{
		$acessosEscola = $this->registroGaleriaDAO->registroGaleriaCountAcessosEscola($usuario['id']);
		$downloadsEscola = $this->registroGaleriaDAO->registroGaleriaCountDownloadEscola($usuario['id']);

		$acessosTotais = $this->registroGaleriaDAO->registroGaleriaCountAcessos();
		$downloadsTotais = $this->registroGaleriaDAO->registroGaleriaCountDownload();

		$pctAcessos = $acessosTotais > 0? $acessosEscola/$acessosTotais : 0;
		$pctDownloads = $downloadsTotais > 0? $downloadsEscola/$downloadsTotais : 0;
		$result = array(
			'barra1' => $pctAcessos,
			'barra2' => $pctDownloads);
		return $result;
	}

	public function barrasExercicios($par, $usuario)
	{
		if($par['perfil'] == 2)
			return $this->exerciciosProfessor($par, $usuario);

		else if($par['perfil'] == 4)
			return $this->exerciciosEscola($par, $usuario);

		else if($par['perfil'] == 3)
			return $this->exerciciosHospital($par, $usuario);
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

	public function exerciciosHospital($par, $usuario)
	{
		$exerciciosTempoEscola = $this->exercicioDAO->exerciciosCompletosEscola($par, $usuario);
		$exerciciosTextoEscola = $this->respostaTextoDAO->countRespostasTextoEscola($par, $usuario);
		$exerciciosMultiplaEscola = $this->respostaMultiplaDAO->countRespostasEscola($par, $usuario);
		$exerciciosMultiplaCorretas = $this->respostaMultiplaDAO->countRespostasCorretasEscola($par, $usuario);

		$exerciciosTempo = $this->exercicioDAO->exerciciosTotaisEscola($par, $usuario);
		$exerciciosTexto = $this->questaoDAO->textoTotaisEscola($par, $usuario);
		$exerciciosMultipla = $this->respostaMultiplaDAO->multiplaTotaisEscola($par, $usuario);

		$exerciciosTotaisEscola =  $exerciciosTempoEscola + $exerciciosTextoEscola + $exerciciosMultiplaEscola;
		$exerciciosTotais = $exerciciosTempo + $exerciciosTexto + $exerciciosMultipla;


		$pctCompletos = $exerciciosTotais > 0? $exerciciosTotaisEscola / $exerciciosTotais : 0;
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
		if($par['perfil'] == 2)
			return array();
	
		else if($par['perfil'] == 4)
			return $this->liberarCapituloDAO->listaLivrosEscola($par);
			
		
		else if($par['perfil'] == 3)
			return $this->liberarCapituloDAO->listaLivrosHospital($par);
	}

	public function getCapitulos($par)
	{
		if ($par['perfil'] == 2)
			return $this->liberarCapituloDAO->listaCapitulosProfessor($par);

		else if ($par['perfil'] == 4)
			return $this->liberarCapituloDAO->listaCapitulosEscola($par);
		
		else if ($par['perfil'] == 3)
			return $this->liberarCapituloDAO->listaCapitulosHospital($par);

	}

	public function getSalas($par)
	{
		if ($par['perfil'] == 2)
			return $this->grupoDAO->listaGruposProfessor($par);
		
		else if ($par['perfil'] == 4)
			return $this->grupoDAO->listaGruposEscola($par);

		else if ($par['perfil'] == 3)
			return array();
	}
}

?>