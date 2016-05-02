<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'ForumQuestaoParticipanteDAO.php');

/**
 * Usuários participantes da discussão de uma questão no fórum.
 *
 * @author Lucas Tavares
 */

class ForumQuestaoParticipanteController
{
    private $forumQuestaoParticipanteDAO;
    
    public function __construct()
    {
        $this->forumQuestaoParticipanteDAO =  new ForumQuestaoParticipanteDAO(new DataAccess());
    }
    
    public function insert($fqp)
    {
        return $this->forumQuestaoParticipanteDAO->insert($fqp);
    }
    
    public function insertAndReturnLastId($fqp)
    {
        return $this->forumQuestaoParticipanteDAO->insertAndReturnLastId($fqp);
    }
    
    public function selectById($idfqp,$idusr)
    {
        $fqp = $this->forumQuestaoParticipanteDAO->selectById($idfqp,$idusr);
        return $fqp;
    }
    
    public function selectAll()
    {
        $fqp = $this->forumQuestaoParticipanteDAO->selectAll();
        return $fqp;
    }
    
    public function update($idfqp)
    {
        return $this->forumQuestaoParticipanteDAO->update($idfqp);
    }
    
    public function delete($idfrq,$idusr)
    {
        return $this->forumQuestaoParticipanteDAO->delete($idfrq,$idusr);
    }
    
    public function verificarParticipante($idfrq, $idusr)
    {
        $fqp = $this->forumQuestaoParticipanteDAO->verificarParticipante($idfrq, $idusr);
        return $fqp;
    }
    public function insertOrUpdateUltimaVisualizacao($idfrq, $idusr, $data)
    {
        $fqp = $this->forumQuestaoParticipanteDAO->insertOrUpdateUltimaVisualizacao($idfrq, $idusr, $data);
        return $fqp;
    }
    public function getUltimaVisualizacao($idfrq, $idusr)
    {
        $fqp = $this->forumQuestaoParticipanteDAO->getUltimaVisualizacao($idfrq, $idusr);
        return $fqp;
    }

    public function getQuestoesByParticipante($idusr)
    {
        $fqp = $this->forumQuestaoParticipanteDAO->getQuestoesByParticipante($idusr);
        return $fqp;
    }
}
