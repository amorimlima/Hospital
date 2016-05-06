<?php
if(!isset($_SESSION['PATH_SYS'])){
	session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'PeriodoDAO.php');

class PeriodoController
{
	private $periodoDAO;

	public function __construct()
	{
		$this->periodoDAO = new PeriodoDAO(new DataAccess());
	}

	public function insert($periodo)
	{
		return $this->periodoDAO->insert($periodo);
	}

	public function selectAll()
	{
		return $this->periodoDAO->selectAll();
	}

	public function selectById($idperiodo)
	{
		return $this->periodoDAO->selectById($idperiodo);
	}

	public function update($idperiodo)
	{
		return $this->periodoDAO->update($idperiodo);
	}

	public function delete($idperiodo)
	{
		return $this->periodoDAO->delete($idperiodo);
	}

	public function listarDisponiveisProfessorSerieSemGrupo($serie, $idProfessor)
	{
		return $this->periodoDAO->listarDisponiveisProfessorSerieSemGrupo($serie, $idProfessor);
	}

	public function listarDisponiveisProfessorSerie($serie, $idProfessor)
	{
		return $this->periodoDAO->listarDisponiveisProfessorSerie($serie, $idProfessor);
	}
}