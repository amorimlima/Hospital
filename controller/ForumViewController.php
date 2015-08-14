<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ForumViewDAO.php');

class ForumViewController {
     private $ForumViewDAO;
    public function __construct()
	{
		$this->forumViewDAO =  new ForumViewDAO(new DataAccess());
	}
	
	public function insert($view)
	{
		return $this->forumViewDAO->insert($view);
	}
	
    public function selectByQuestao($idQuestao)
	{
		return $this->forumViewDAO->selectByQuestao($idQuestao);
		
	}

	public function totalByQuestao($idQuestao)
	{
		return $this->forumViewDAO->totalByQuestao($idQuestao);
	}

	public function verificaUsuarioByQuestao($idUser, $idQuestao)
	{
		return $this->forumViewDAO->verificaUsuarioByQuestao($idUser, $idQuestao);
	}
}
?>