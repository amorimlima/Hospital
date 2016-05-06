<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Questao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestaoDAO
 *
 * @author Kevyn
 */
class QuestaoDAO extends DAO{
    //put your code here
    
     public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($ques)
     {
         $sql  = "insert into questao (qst_numero,qst_questao,qst_exercicio) values ";
         $sql .= "('".$ques->getQst_numero()."','";
         $sql .= "'".$ques->getQst_questao()."','".$ques->getQst_exercicio()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ques)
     {
        $sql  = "update questao set qst_numero = '".$ques->getQst_numero()."',";
    	$sql .= "qst_questao = '".$ques->getQst_questao()."',";
    	$sql .= "qst_exercicio = '".$ques->getQst_exercicio()."',";
        $sql .= "where  qst_id = ".$ques->getQst_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idques)
     {
         $sql = "delete from questao where qst_id = ".$idques."";
    	return $this->execute($sql); 
     }
     
     public function select($idques)
     {
        $sql = "select * from questao where qst_id = ".$idques." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $ques = new Questao();
                $ques->setQst_id($qr["qst_id"]);
                $ques->setQst_numero($qr["qst_numero"]);
                $ques->setQst_questao($qr["qst_questao"]);
                $ques->setQst_exercicio($qr["qst_exercicio"]);
                
	    	    	
    	return $ques;
     }
     
     public function selectFull()
     {
        $sql = "select * from questao";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $ques = new Questao();
                $ques->setQst_id($qr["qst_id"]);
                $ques->setQst_numero($qr["qst_numero"]);
                $ques->setQst_questao($qr["qst_questao"]);
                $ques->setQst_exercicio($qr["qst_exercicio"]);
                array_push($lista, $ques);
        }	    	
    	return $lista;
     }

     public function textoTotaisUsuario($par, $usuario)
     {
        $sql = "SELECT COUNT(*) FROM questao q";
        $join = " JOIN exercicio ex ON ex.exe_id = q.qst_exercicio";
        $join .= " JOIN liberar_capitulo lc ON  ex.exe_serie = lc.lbr_livro AND ex.exe_capitulo = lc.lbr_capitulo";
        $where = " WHERE lc.lbr_escola = ".$usuario['escola']." AND ex.exe_serie = ".$usuario['serie'];
        if ($par['capitulo'] != 0)
            $where .= " AND lc.lbr_capitulo = ".$par['capitulo'];

        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function textoTotaisProfessor($par, $usuario)
     {
        $sql = "SELECT COUNT(*) FROM questao q";
        $join = " JOIN exercicio ex ON ex.exe_id = q.qst_exercicio
                  JOIN liberar_capitulo lc ON lc.lbr_livro = ex.exe_serie AND lc.lbr_capitulo = ex.exe_capitulo
                  JOIN grupo g ON g.grp_escola = lc.lbr_escola AND g.grp_serie = lc.lbr_livro
                  JOIN usuario_variavel uv ON uv.usv_grupo = g.grp_id";
        $where = " WHERE g.grp_professor = ".$usuario['id'];
        if ($par['livro'] != 0)
            $where .= " AND lc.lbr_livro = ".$par['livro'];
        if ($par['capitulo'] != 0)
            $where .= " AND lc.lbr_capitulo = ".$par['capitulo'];
        if ($par['sala'] != 0)
            $where .= " AND g.grp_id = ".$par['sala'];

        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function textoTotaisEscola($par, $usuario)
     {
        $sql = "SELECT COUNT(*) FROM questao q";
        $join = " JOIN exercicio ex ON ex.exe_id = q.qst_exercicio
                  JOIN liberar_capitulo lc ON lc.lbr_livro = ex.exe_serie AND lc.lbr_capitulo = ex.exe_capitulo
                  JOIN usuario us ON us.usr_escola = lc.lbr_escola
                  JOIN usuario_variavel uv ON uv.usv_usuario = us.usr_id";
        $where = " WHERE us.usr_escola = ".$usuario['id']."  AND uv.usv_serie = ex.exe_serie AND us.usr_perfil = 1";
        if ($par['capitulo'] != 0)
            $where .= " AND lc.lbr_capitulo = ".$par['capitulo'];

        $sql = $sql.$join.$where;
        
        return $this->retrieve($sql)->fetch_row()[0];
     }
}
?>