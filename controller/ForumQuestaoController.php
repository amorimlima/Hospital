<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ForumQuestaoDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumQuestaoController
 *
 * @author Kevyn
 */
class ForumQuestaoController {
    //put your code here
    
    private $forumQuestaoDAO;
    public function __construct()
	{
		$this->forumQuestaoDAO = new ForumQuestaoDAO(new DataAccess());
	}
	
	public function insert($foq)
	{
		return $this->forumQuestaoDAO->insert($foq);
	}
        
        public function insertAndReturnLastId($foq)
	{
		return $this->forumQuestaoDAO->insertAndReturnLastId($foq);
	}
	
	public function update($foq)
	{
		return $this->forumQuestaoDAO->update($foq);
	}
	
	public function delete($idfoq)
	{
		return $this->forumQuestaoDAO->delete($idfoq);
	}
	
	public function select($idfoq)
	{
		$foq = $this->forumQuestaoDAO->select($idfoq);
		return $foq;
	}
        
        public function selectComleta($keyword){
                $foq = $this->forumQuestaoDAO->selectCompleta($keyword);
		return $foq;
        }
            

                public function selectAll()
	{
		$foq = $this->forumQuestaoDAO->selectFull();
		return $foq;
	}
	public function selectUltimas($qtd)
	{
		$foq = $this->forumQuestaoDAO->selectUltimas($qtd);
		return $foq;
	}

	public function selectPendentes()
	{
		$foq = $this->forumQuestaoDAO->selectPendentes();
		return $foq;
	}
        
        public function selectAprovadas()
        {
            $frq = $this->forumQuestaoDAO->selectAprovadas();
            return $frq;
        }
        
        public function selectByTopico($idfrt)
        {
            $frq = $this->forumQuestaoDAO->selectByTopico($idfrt);
            return $frq;
        }
        
        public function selectAutorByQuestao($idquestao)
        {
            $usr = $this->forumQuestaoDAO->selectAutorByQuestao($idquestao);
            return $usr;
        }

    public function incrementarVisualizacoes($idfrq)
    {
    	return $this->forumQuestaoDAO->incrementarVisualizacoes($idfrq);
    }
}
?>