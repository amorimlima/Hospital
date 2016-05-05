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
 * @author Ana Carolina
 */
class RespostaMultiplaDAO extends DAO{
    //put your code here
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($rem)
     {
        $sql  = "insert into resposta_multipla (rspm_usuario, rspm_exercicio, rspm_questao, rspm_resposta) values ";
        $sql .= "(".$rem->getRspm_usuario().",".$rem->getRspm_exercicio().",";
        $sql .= "'".$rem->getRspm_questao()."','".$rem->getRspm_resposta()."')";
    	return $this->execute($sql);
     }
    
     public function update($rem)
     {
        $sql  = "update resposta_multipla set rspm_usuario = '".$rem->getRspm_usuario()."',";
    	$sql .= "rspm_exercicio = '".$rem->getRspm_exercicio()."',";
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
    	$qr = mysqli_fetch_array($result);

            $rem = new RespostaMultipla();
            $rem->setRspm_id($qr["rspm_id"]);
            $rem->setRspm_usuario($qr["rspm_usuario"]);
            $rem->setRspm_exercicio($qr["rspm_exercicio"]);
            $rem->setRspm_questao($qr["rspm_questao"]);
            $rem->setRspm_resposta($qr["rspm_resposta"]);
               
    	
    	return $rem;
     }
     
     public function selectFull()
     {
        $sql = "select * from resposta_multipla";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
            $rem = new RespostaMultipla();
            $rem->setRspm_id($qr["rspm_id"]);
            $rem->setRspm_usuario($qr["rspm_usuario"]);
            $rem->setRspm_exercicio($qr["rspm_exercicio"]);
            $rem->setRspm_questao($qr["rspm_questao"]);
            $rem->setRspm_resposta($qr["rspm_resposta"]);
            array_push($lista, $rem);
        }
    	return $lista;
     }
     
     public function countCorretasAluno($idAluno)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm
                JOIN gabarito gb ON gb.gbt_exercicio = rm.rspm_exercicio AND gb.gbt_questao = rm.rspm_questao
                WHERE rm.rspm_usuario = '.$idAluno.' AND rm.rspm_resposta = gb.gbt_resposta';
        return $this->retrieve($sql)->fetch_row()[0];
     }

    public function selectQuestaoExByAluno($idExercicio,$idUsuario,$questao)
    {
        $sql = "select * from resposta_multipla where rspm_exercicio = ".$idExercicio." and rspm_usuario=".$idUsuario." and rspm_questao=".$questao;
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        return $qr;
    } 
}
?>
