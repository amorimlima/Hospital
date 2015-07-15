<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'RespostaMultipla.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespostaMultiplaDAO
 *
 * @author Kevyn
 */
class RespostaMultiplaDAO extends DAO{
    //put your code here
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($rem)
     {
         $sql  = "insert into resposta_multipla (rspm_aluno, rspm_questao, rspm_resposta) values ";
         $sql .= "('".$rem->getRspm_aluno()."','";
         $sql .= "'".$rem->getRspm_questao()."','".$rem->getRspm_resposta()."')";
		echo $sql;
    	return $this->execute($sql);
     }
    
     public function update($rem)
     {
        $sql  = "update resposta_multipla set rspm_aluno = '".$rem->getRspm_aluno()."',";
    	$sql .= "rspm_questao = '".$rem->getRspm_questao()."',";
    	$sql .= "rspm_resposta = '".$rem->getRspm_resposta()."',";
        $sql .= "where  rspm_id = ".$rem->getRspm_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idrem)
     {
         $sql = "delete from resposta_multipla where rspm_id = ".$idrem."";
    	return $this->execute($sql); 
     }
     
     public function select($idrem)
     {
        $sql = "select * from resposta_multipla where rspm_id = ".$idrem." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $rem = new RespostaMultipla();
                $rem->setRspm_id($qr["rspm_id"]);
                $rem->setRspm_aluno($qr["rspm_aluno"]);
                $rem->setRspm_questao($qr["rspm_questao"]);
                $rem->setRspm_resposta($qr["rspm_resposta"]);
               
    	
    	return $rem;
     }
     
     public function selectFull()
     {
        $sql = "select * from resposta_multipla";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $rem = new RespostaMultipla();
                $rem->setRspm_id($qr["rspm_id"]);
                $rem->setRspm_aluno($qr["rspm_aluno"]);
                $rem->setRspm_questao($qr["rspm_questao"]);
                $rem->setRspm_resposta($qr["rspm_resposta"]);
               array_push($lista, $rem);
        }
    	return $lista;
     }
}
?>
