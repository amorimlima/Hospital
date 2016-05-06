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



     public function countRespostasUsuario($par, $usuario)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm';
        $join = '';
        $where = ' WHERE rm.rspm_usuario = '.$usuario['id'];
        if ($par['capitulo'] != 0)
        {
            $join .= ' JOIN exercicio ex ON ex.exe_id = rm.rspm_exercicio';
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        }
        
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function countRespostasProfessor($par, $usuario)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm';
        $join = " JOIN usuario_variavel uv ON uv.usv_usuario = rm.rspm_usuario
                  JOIN exercicio ex ON ex.exe_id = rm.rspm_exercicio
                  JOIN liberar_capitulo lc on lc.lbr_capitulo = ex.exe_capitulo AND lc.lbr_livro = ex.exe_serie
                  JOIN grupo g ON g.grp_id = uv.usv_grupo";
        $where = ' WHERE g.grp_professor = '.$usuario['id'];
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        if ($par['sala'] != 0)
            $where .= " AND g.grp_id = ".$par['sala'];
        
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function countRespostasEscola($par, $usuario)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm';
        $join = " JOIN usuario us ON us.usr_id = rm.rspm_usuario
                  JOIN usuario_variavel uv ON uv.usv_usuario = rm.rspm_usuario
                  JOIN exercicio ex ON ex.exe_id = rm.rspm_exercicio
                  JOIN liberar_capitulo lc on lc.lbr_capitulo = ex.exe_capitulo AND lc.lbr_livro = ex.exe_serie AND us.usr_escola = lc.lbr_escola";
        $where = ' WHERE lc.lbr_escola = '.$usuario['id'];
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function countRespostasCorretasUsuario($par, $usuario)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm';
        $join = ' JOIN gabarito gb ON gb.gbt_exercicio = rm.rspm_exercicio AND gb.gbt_questao = rm.rspm_questao';
        $where = ' WHERE rm.rspm_usuario = '.$usuario['id'].' AND rm.rspm_resposta = gb.gbt_resposta';
        if ($par['capitulo'] != 0)
        {
            $join .= ' JOIN exercicio ex ON ex.exe_id = rm.rspm_exercicio';
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        }
        
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function countRespostasCorretasProfessor($par, $usuario)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm';
        $join = " JOIN usuario_variavel uv ON uv.usv_usuario = rm.rspm_usuario
                  JOIN exercicio ex ON ex.exe_id = rm.rspm_exercicio
                  JOIN liberar_capitulo lc on lc.lbr_capitulo = ex.exe_capitulo AND lc.lbr_livro = ex.exe_serie
                  JOIN grupo g ON g.grp_id = uv.usv_grupo
                  JOIN gabarito gb ON gb.gbt_exercicio = rm.rspm_exercicio AND gb.gbt_questao = rm.rspm_questao";
        $where = ' WHERE g.grp_professor = '.$usuario['id']." AND rm.rspm_resposta = gb.gbt_resposta";
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        if ($par['sala'] != 0)
            $where .= " AND g.grp_id = ".$par['sala'];
        
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function countRespostasCorretasEscola($par, $usuario)
     {
        $sql = 'SELECT COUNT(*) FROM resposta_multipla rm';
        $join = " JOIN usuario us ON us.usr_id = rm.rspm_usuario
                  JOIN usuario_variavel uv ON uv.usv_usuario = rm.rspm_usuario
                  JOIN exercicio ex ON ex.exe_id = rm.rspm_exercicio
                  JOIN liberar_capitulo lc on lc.lbr_capitulo = ex.exe_capitulo AND lc.lbr_livro = ex.exe_serie
                  JOIN gabarito gb ON gb.gbt_exercicio = rm.rspm_exercicio AND gb.gbt_questao = rm.rspm_questao AND us.usr_escola = lc.lbr_escola";
        $where = ' WHERE lc.lbr_escola = '.$usuario['id']." AND rm.rspm_resposta = gb.gbt_resposta";
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function multiplaTotaisProfessor($par, $usuario)
     {
        $sql = "SELECT COUNT(*) FROM gabarito gb";
        $join = " JOIN exercicio ex ON ex.exe_id = gb.gbt_exercicio
                  JOIN liberar_capitulo lc ON lc.lbr_livro = ex.exe_serie AND lc.lbr_capitulo = ex.exe_capitulo
                  JOIN grupo g ON g.grp_escola = lc.lbr_escola AND g.grp_serie = lc.lbr_livro
                  JOIN usuario_variavel uv ON uv.usv_grupo = g.grp_id";
        $where = " WHERE g.grp_professor = ".$usuario['id'];
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        if ($par['sala'] != 0)
            $where .= " AND g.grp_id = ".$par['sala'];

        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function multiplaTotaisEscola($par, $usuario)
     {
        $sql = "SELECT COUNT(*) FROM gabarito gb";
        $join = " JOIN exercicio ex ON ex.exe_id = gb.gbt_exercicio
                  JOIN liberar_capitulo lc ON lc.lbr_livro = ex.exe_serie AND lc.lbr_capitulo = ex.exe_capitulo
                  JOIN usuario us ON us.usr_escola = lc.lbr_escola
                  JOIN usuario_variavel uv ON uv.usv_usuario = us.usr_id AND uv.usv_serie = lc.lbr_livro";
        $where = " WHERE lc.lbr_escola = ".$usuario['id'];
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];

        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
     }

     public function multiplaTotaisUsuario($par, $usuario)
     {
        $sql = "SELECT COUNT(*) FROM gabarito gb";
        $join = " JOIN exercicio ex ON ex.exe_id = gb.gbt_exercicio";
        $join .= " JOIN liberar_capitulo lc ON lc.lbr_livro = ex.exe_serie AND lc.lbr_capitulo = ex.exe_serie";
        $where = " WHERE lc.lbr_escola = ".$usuario['escola']." AND ex.exe_serie = ".$usuario['serie'];
        if ($par['capitulo'] != 0)
            $where .= ' AND ex.exe_capitulo = '.$par['capitulo'];

        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
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
