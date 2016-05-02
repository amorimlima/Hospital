<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'ForumQuestao.php');
include_once($path['beans'].'ForumTopico.php');
include_once($path['beans'].'Usuario.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumQuestaoDAO
 *
 * @author Kevyn
 */
class ForumQuestaoDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($foq)
     {
         $sql  = "INSERT INTO forum_questao (frq_usuario,frq_questao,frq_anexo,frq_data,frq_topico) VALUES ";
         $sql .= "('".$foq->getFrq_usuario()."','".$foq->getFrq_questao()."',";
         $sql .= "'".$foq->getFrq_anexo()."','".$foq->getFrq_data()."','".$foq->getFrq_topico()."')";
		//echo $sql;
    	return $this->execute($sql);
     }
     
     public function insertAndReturnLastId($foq)
     {
         $sql  = "INSERT INTO forum_questao (frq_usuario,frq_questao,frq_anexo,frq_data,frq_topico) VALUES ";
         $sql .= "('".$foq->getFrq_usuario()."','".$foq->getFrq_questao()."',";
         $sql .= "'".$foq->getFrq_anexo()."','".$foq->getFrq_data()."','".$foq->getFrq_topico()."')";
		//echo $sql;
    	return $this->executeAndReturnLastID($sql);
     }
     
      public function update($foq)
     {
        $sql  = "update forum_questao set frq_usuario = '".$foq->getFrq_usuario()."',";
    	$sql .= "frq_questao = '".$foq->getFrq_questao()."',";
    	$sql .= "frq_anexo = ".$foq->getFrq_anexo().",";
        
        $sql .= "frq_data = ".$foq->getFrq_data().",";
        $sql .= "frq_topico = ".$foq->getFrq_topico().",";
        $sql .= "frq_visualizacoes = ".$foq->getFrq_visualizacoes().",";
        $sql .= "where  frq_id = ".$foq->getFrq_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idfoq)
     {
         $sql = "delete from forum_questao where frq_id = ".$idfoq."";
    	return $this->execute($sql); 
     }
     
     public function select($idfoq)
     {
        $sql = "SELECT * FROM forum_questao WHERE frq_id = ".$idfoq." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $foq = new ForumQuestao();
                $foq->setFrq_id($qr["frq_id"]);
                $foq->setFrq_usuario($qr["frq_usuario"]);
                $foq->setFrq_questao($qr["frq_questao"]);
                $foq->setFrq_anexo($qr["frq_anexo"]);
                $foq->setFrq_data($qr["frq_data"]);
                $foq->setFrq_topico($qr["frq_topico"]);
                $foq->setFrq_visualizacoes($qr["frq_visualizacoes"]);
                
	    	    	
    	return $foq;
     }
     
     public function selectCompleta($keyword)
     {
        $sql = "SELECT * FROM forum_questao WHERE  frq_questao LIKE '%".utf8_decode($keyword)."%' ORDER BY frq_id DESC";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

               $foq = new ForumQuestao();
                $foq->setFrq_id($qr["frq_id"]);
                $foq->setFrq_usuario($qr["frq_usuario"]);
                $foq->setFrq_questao($qr["frq_questao"]);
                $foq->setFrq_anexo($qr["frq_anexo"]);
                $foq->setFrq_data($qr["frq_data"]);
                $foq->setFrq_topico($qr["frq_topico"]);
                $foq->setFrq_visualizacoes($qr["frq_visualizacoes"]);
                array_push($lista, $foq);
        }    
       
    	return $lista;
     }


     public function selectFull()
     {
        $sql = "SELECT * FROM forum_questao ORDER BY frq_id DESC";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
            $foq = new ForumQuestao();
            $foq->setFrq_id($qr["frq_id"]);
            $foq->setFrq_usuario($qr["frq_usuario"]);
            $foq->setFrq_questao($qr["frq_questao"]);
            $foq->setFrq_anexo($qr["frq_anexo"]);
            $foq->setFrq_data($qr["frq_data"]);
            $foq->setFrq_topico($qr["frq_topico"]);
            $foq->setFrq_visualizacoes($qr["frq_visualizacoes"]);
            array_push($lista, $foq);
        }    	
    	return $lista;
     }
	 
	  public function selectUltimas($qtd)
     {
        $sql = "SELECT * FROM forum_questao JOIN forum_topico ON frq_topico = frt_id WHERE frt_status = 1 ORDER BY frq_data DESC LIMIT {$qtd}";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
            $foq = new ForumQuestao();
            $foq->setFrq_id($qr["frq_id"]);
            $foq->setFrq_usuario($qr["frq_usuario"]);
            $foq->setFrq_questao($qr["frq_questao"]);
            $foq->setFrq_anexo($qr["frq_anexo"]);
            $foq->setFrq_data($qr["frq_data"]);
            $foq->setFrq_topico($qr["frq_topico"]);
            $foq->setFrq_visualizacoes($qr["frq_visualizacoes"]);
            array_push($lista, $foq);
        }    
       
    	return $lista;
     }

    public function selectPendentes($idesc)
    {
        $sql  = "SELECT * FROM forum_questao frq ";
        $sql .= "JOIN usuario usr ON frq.frq_usuario = usr.usr_id ";
        $sql .= "JOIN forum_topico frt ON frq.frq_topico = frt.frt_id ";
        $sql .= "WHERE frt_status = 0 AND usr.usr_escola = {$idesc} ORDER BY frq_id DESC";
        $result = $this->retrieve($sql);
        $lista = Array();

        while ($qr = mysqli_fetch_array($result))
        {
            $frq = new ForumQuestao();
            $frq->setFrq_id($qr["frq_id"]);
            $frq->setFrq_questao($qr["frq_questao"]);
            $frq->setFrq_data($qr["frq_data"]);
            $frq->setFrq_anexo($qr["frq_anexo"]);
            $frq->setFrq_visualizacoes($qr["frq_visualizacoes"]);

            $frq->setFrq_usuario(new Usuario());
            $frq->getFrq_usuario()->setUsr_id($qr["usr_id"]);
            $frq->getFrq_usuario()->setUsr_nome($qr["usr_nome"]);
            $frq->getFrq_usuario()->setUsr_escola($qr["usr_escola"]);
            $frq->getFrq_usuario()->setUsr_imagem($qr["usr_imagem"]);

            $frq->setFrq_topico(new ForumTopico());
            $frq->getFrq_topico()->setFrt_id($qr["frt_id"]);
            $frq->getFrq_topico()->setFrt_topico($qr["frt_topico"]);
            $frq->getFrq_topico()->setFrt_status($qr["frt_status"]);

            array_push($lista,$frq);
        }

        return $lista;
    }

    public function selectAllAprovadas()
    {
        $sql  = "SELECT * FROM forum_questao frq ";
        $sql .= "JOIN usuario usr ON frq.frq_usuario = usr.usr_id ";
        $sql .= "JOIN forum_topico frt ON frq.frq_topico = frt.frt_id ";
        $sql .= "WHERE frt_status = 1 ORDER BY frq_id DESC";

        $result = $this->retrieve($sql);
        $lista = Array();

        while ($qr = mysqli_fetch_array($result))
        {
            $frq = new ForumQuestao();
            $frq->setFrq_id($qr["frq_id"]);
            $frq->setFrq_questao($qr["frq_questao"]);
            $frq->setFrq_data($qr["frq_data"]);
            $frq->setFrq_anexo($qr["frq_anexo"]);
            $frq->setFrq_visualizacoes($qr["frq_visualizacoes"]);

            $frq->setFrq_usuario(new Usuario());
            $frq->getFrq_usuario()->setUsr_id($qr["usr_id"]);
            $frq->getFrq_usuario()->setUsr_nome($qr["usr_nome"]);
            $frq->getFrq_usuario()->setUsr_escola($qr["usr_escola"]);
            $frq->getFrq_usuario()->setUsr_imagem($qr["usr_imagem"]);

            $frq->setFrq_topico(new ForumTopico());
            $frq->getFrq_topico()->setFrt_id($qr["frt_id"]);
            $frq->getFrq_topico()->setFrt_topico($qr["frt_topico"]);
            $frq->getFrq_topico()->setFrt_status($qr["frt_status"]);

            array_push($lista,$frq);
        }

        return $lista;
    }
    
    public function selectAprovadasByEscola($idesc)
    {
        $sql  = "SELECT * FROM forum_questao frq ";
        $sql .= "JOIN usuario usr ON frq.frq_usuario = usr.usr_id ";
        $sql .= "JOIN forum_topico frt ON frq.frq_topico = frt.frt_id ";
        $sql .= "WHERE frt_status = 1 AND usr.usr_escola = {$idesc} ORDER BY frq_id DESC";
        $result = $this->retrieve($sql);
        $lista = Array();

        while ($qr = mysqli_fetch_array($result))
        {
            $frq = new ForumQuestao();
            $frq->setFrq_id($qr["frq_id"]);
            $frq->setFrq_questao($qr["frq_questao"]);
            $frq->setFrq_data($qr["frq_data"]);
            $frq->setFrq_anexo($qr["frq_anexo"]);
            $frq->setFrq_visualizacoes($qr["frq_visualizacoes"]);

            $frq->setFrq_usuario(new Usuario());
            $frq->getFrq_usuario()->setUsr_id($qr["usr_id"]);
            $frq->getFrq_usuario()->setUsr_nome($qr["usr_nome"]);
            $frq->getFrq_usuario()->setUsr_escola($qr["usr_escola"]);
            $frq->getFrq_usuario()->setUsr_imagem($qr["usr_imagem"]);

            $frq->setFrq_topico(new ForumTopico());
            $frq->getFrq_topico()->setFrt_id($qr["frt_id"]);
            $frq->getFrq_topico()->setFrt_topico($qr["frt_topico"]);
            $frq->getFrq_topico()->setFrt_status($qr["frt_status"]);

            array_push($lista,$frq);
        }

        return $lista;
    }
    
    public function selectByTopico($idfrt)
    {
        $sql  = "SELECT * FROM forum_questao ";
        $sql .= "WHERE frq_topico = {$idfrt};";
        $result = $this->retrieve($sql);
        $lista = Array();
        
        while ($qr = mysqli_fetch_array($result))
        {
            $frq = new ForumQuestao();
            $frq->setFrq_id($qr["frq_id"]);
            $frq->setFrq_usuario($qr["frq_usuario"]);
            $frq->setFrq_topico($qr["frq_topico"]);
            $frq->setFrq_questao($qr["frq_questao"]);
            $frq->setFrq_data($qr["frq_data"]);
            $frq->setFrq_anexo($qr["frq_anexo"]);
            $frq->setFrq_visualizacoes($qr["frq_visualizacoes"]);
            
            array_push($lista,$frq);
        }
        
        return $lista;
    }
    
    public function selectAutorByQuestao($idquestao)
    {
        $sql  = "SELECT * FROM usuario usr ";
        $sql .= "JOIN forum_questao frq ON frq.frq_usuario = usr.usr_id ";
        $sql .= "WHERE frq.frq_id = {$idquestao}";
        $result = $this->retrieve($sql);
        $retorno;
        
        if ($result) {
            $qr = mysqli_fetch_array($result);
            
            $retorno = new ForumQuestao();
            $retorno->setFrq_id($qr["frq_id"]);
            $retorno->setFrq_usuario(new Usuario());
            $retorno->getFrq_usuario()->setUsr_id($qr["usr_id"]);
            $retorno->getFrq_usuario()->setUsr_nome($qr["usr_nome"]);
            $retorno->getFrq_usuario()->setUsr_escola($qr["usr_escola"]);
            $retorno->getFrq_usuario()->setUsr_imagem($qr["usr_imagem"]);
        }
        
        return $retorno;
    }

    public function incrementarVisualizacoes($idfrq)
    {
       $sql = "UPDATE forum_questao SET frq_visualizacoes = frq_visualizacoes + 1 WHERE frq_id = {$idfrq};";
       return $this->execute($sql);
    }
}
?>