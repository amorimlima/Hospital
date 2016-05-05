<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        ForumQuestaoParticipanteDAO
* GENERATION DATE:  27.04.2016
* FOR MYSQL TABLE:  forum_questao_participante
* FOR MYSQL DB:     hcb_criancas_teste
* -------------------------------------------------------
* CODE GENERATED BY:
* @MURANO DESIGN
* -------------------------------------------------------
*
*/

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'ForumQuestaoParticipante.php');


/**
 * Description of ForumQuestaoParticipanteDAO
 *
 * @author Lucas Tavares
 */

class ForumQuestaoParticipanteDAO extends DAO
{
    function  __construct() {
        parent::__construct(new DataAccess());
    }

    // **********************
    // INSERT
    // **********************

    public function insert($fqp)
    {
        $sql  = "INSERT INTO forum_questao_participante (fqp_questao,fqp_usuario,fqp_ultima_visualizacao) VALUES ";
        $sql .= "('{$fqp->getFqp_questao()}','{$fqp->getFqp_usuario()}','{$fqp->getFqp_ultima_visualizacao()}')";
        return $this->execute($sql);
    }
    
    // **********************
    // INSERT AND RETURN LAST ID
    // **********************

    public function insertAndReturnLastId($fqp)
    {
        $sql  = "INSERT INTO forum_questao_participante (fqp_questao,fqp_usuario,fqp_ultima_visualizacao) VALUES ";
        $sql .= "('{$fqp->getFqp_questao()}','{$fqp->getFqp_usuario()}','{$fqp->getFqp_ultima_visualizacao()}')";
        return $this->executeAndReturnLastID($sql);
    }
    
    // **********************
    // DELETE
    // **********************

    public function delete($idfrq,$idusr)
    {
        $sql = "DELETE FROM forum_questao_participante WHERE fqp_questao = {$idfrq} AND fqp_usuario = {$idusr}";
        return $this->execute($sql);
    }

    // **********************
    // SELECT BY ID
    // **********************

    public function selectById($idfqp,$idusr)
    {
        $sql = "SELECT * FROM forum_questao_participante WHERE fqp_questao = {$idfqp} AND fqp_usuario = {$idusr} LIMIT 1";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        $forumquestaoparticipante= new ForumQuestaoParticipante();
        $forumquestaoparticipante->setFqp_questao($qr['fqp_questao']);
        $forumquestaoparticipante->setFqp_usuario($qr['fqp_usuario']);
        $forumquestaoparticipante->setFqp_ultima_visualizacao($qr['fqp_ultima_visualizacao']);

        return $forumquestaoparticipante;
    }

    // **********************
    // SELECT ALL
    // **********************

    public function selectAll()
    {
        $sql = "SELECT * FROM forum_questao_participante";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result))
        {
            $forumquestaoparticipante = new ForumQuestaoParticipante();
            $forumquestaoparticipante->setFqp_id($qr['fqp_id']);
            $forumquestaoparticipante->setFqp_questao($qr['fqp_questao']);
            $forumquestaoparticipante->setFqp_usuario($qr['fqp_usuario']);
            $forumquestaoparticipante->setFqp_ultima_visualizacao($qr['fqp_ultima_visualizacao']);

            array_push($lista,$forumquestaoparticipante);
        };
        return $lista;
    }

    // **********************
    // UPDATE
    // **********************

    public function update($fqp)
    {
        $sql  = "UPDATE forum_questao_participante SET ";
        $sql .= "fqp_ultima_visualizacao = '{$fqp->getFqp_ultima_visualizacao()}'";
        $sql .= "WHERE fqp_questao = '{$fqp->getFqp_questao()}' AND fqp_usuario = '{$fqp->getFqp_usuario()}'";
        return $this->execute($sql);
    }
    
    
    // **********************
    // Demais métodos
    // **********************
    
    public function verificarParticipante($idfrq, $idusr)
    {
        $sql  = "SELECT * FROM forum_questao_participante ";
        $sql .= "WHERE fqp_questao = {$idfrq} AND fqp_usuario = {$idusr}";
        $result = $this->retrieve($sql);
        $qtde = mysqli_num_rows($result);
        $retorno = "";
        
        if ($qtde > 0)
        {   
            $retorno = true;
        }
        
        return $retorno;
    }
    
    public function insertOrUpdateUltimaVisualizacao($idfrq, $idusr, $data)
    {
        $sql  = "INSERT INTO forum_questao_participante (fqp_questao,fqp_usuario,fqp_ultima_visualizacao)";
        $sql .= "VALUES ('{$idfrq}','{$idusr}','{$data}') ";
        $sql .= "ON DUPLICATE KEY ";
        $sql .= "UPDATE fqp_ultima_visualizacao = '{$data}';";
        
        return $this->execute($sql);
    }
    
    public function getUltimaVisualizacao($idfrq,$idusr)
    {
        $sql  = "SELECT fqp_ultima_visualizacao AS data FROM forum_questao_participante ";
        $sql .= "WHERE fqp_questao = {$idfrq} AND fqp_usuario = {$idusr};";
        $fqp = new ForumQuestaoParticipante();
        $result = $this->retrieve($sql);
        
        if ($qr = mysqli_fetch_array($result)) {
            $fqp->setFqp_ultima_visualizacao($qr["data"]);
            return $fqp;
        } else {
            return false;
        }
    }

    public function getQuestoesByParticipante($idusr)
    {
        $sql  = "SELECT * FROM forum_questao_participante ";
        $sql .= "WHERE fqp_usuario = {$idusr};";
        $datas = [];

        if ($result = $this->retrieve($sql)) {
            while($qr = mysqli_fetch_array($result)) {
                $fqp = new ForumQuestaoParticipante();
                $fqp->setFqp_questao($qr["fqp_questao"]);
                $fqp->setFqp_usuario($qr["fqp_usuario"]);
                $fqp->setFqp_ultima_visualizacao($qr["fqp_ultima_visualizacao"]);
                array_push($datas, $fqp);
            }
            return $datas;
        } else {
            return false;
        }
    }
}
?>