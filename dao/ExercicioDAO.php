<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Exercicio.php');
include_once($path['beans'].'ResgistroAcesso.php');

/**
* Description of ExercicioDAO
*
* @author Ana Carolina
*/

class ExercicioDAO extends DAO{

    public function  __construct($da) {
        parent::__construct($da);
     }

     
    // **********************
    // INSERT
    // **********************

    public function insertExercicio($exercicio)
    {
        $sql =  "insert into exercicio ( exe_nome,exe_diretorio,exe_tipo,exe_serie,exe_tema,exe_capitulo,exe_ordem )values";
        $sql .= "( '".$exercicio->getExe_nome()."','".$exercicio->getExe_diretorio()."','".$exercicio->getExe_tipo()."','".$exercicio->getExe_serie()."','".$exercicio->getExe_tema()."','".$exercicio->getExe_capitulo()."','".$exercicio->getExe_ordem()."')";
        return $this->execute($sql);
    }

    // **********************
    // DELETE
    // **********************

    public function deleteExercicio($idexercicio)
    {
        $sql = "delete from exercicio where exe_id = $idexercicio";
        return $this->execute($sql);
    }

    // **********************
    // SELECT BY ID
    // **********************

    function selectByIdExercicio($idexercicio)
    {
        $sql = "select * from exercicio where exe_id = ". $idexercicio." limit 1 ";

        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        $exercicio= new Exercicio();
        $exercicio->setExe_id($qr["exe_id"]);
        $exercicio->setExe_nome($qr["exe_nome"]);
        $exercicio->setExe_diretorio($qr["exe_diretorio"]);
        $exercicio->setExe_tipo($qr["exe_tipo"]);
        $exercicio->setExe_serie($qr["exe_serie"]);
        $exercicio->setExe_tema($qr["exe_tema"]);
        $exercicio->setExe_capitulo($qr["exe_capitulo"]);
        $exercicio->setExe_ordem($qr["exe_ordem"]);

        return $exercicio;
    }

    // **********************
    // SELECT ALL
    // **********************

    function selectAllExercicio()
    {
        $sql = "select * from exercicio ";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
        $exercicio= new Exercicio();
        $exercicio->setExe_id($qr[exe_id]);
        $exercicio->setExe_nome($qr[exe_nome]);
        $exercicio->setExe_diretorio($qr[exe_diretorio]);
        $exercicio->setExe_tipo($qr[exe_tipo]);
        $exercicio->setExe_serie($qr[exe_serie]);
        $exercicio->setExe_tema($qr[exe_tema]);
        $exercicio->setExe_capitulo($qr[exe_capitulo]);
        $exercicio->setExe_ordem($qr[exe_ordem]);

        array_push($lista,$exercicio);
        };
        return $lista;
    }

    // **********************
    // UPDATE
    // **********************

    function updateExercicio($idexercicio)
    {
        $sql = "update exercicio set ";
        $sql .= "exe_nome = '".$exercicio->getExe_nome()."',";
        $sql .= "exe_diretorio = '".$exercicio->getExe_diretorio()."',";
        $sql .= "exe_tipo = '".$exercicio->getExe_tipo()."',";
        $sql .= "exe_serie = '".$exercicio->getExe_serie()."',";
        $sql .= "exe_tema = '".$exercicio->getExe_tema()."',";
        $sql .= "exe_capitulo = '".$exercicio->getExe_capitulo()."',";
        $sql .= "exe_ordem = '".$exercicio->getExe_ordem()."',";

        $sql .= "where $idexercicio = '".$exercicio->getExe_id()."'";
        return $this->execute($sql);
    }



    function selectAllExercicioBySerieCapituloLiberado($serie, $idEscola, $capitulo)
    {
        $sql  = "select * from exercicio ex ";
        $sql .= "join liberar_capitulo lbr  on lbr.lbr_capitulo = ex.exe_capitulo ";
        $sql .= "join diretorio dir on dir.drt_id = ex.exe_diretorio ";
        $sql .= "Where ex.exe_serie = ".$serie." and lbr.lbr_escola = ".$idEscola;
        $sql .= " and lbr.lbr_livro = ".$serie;
        if($capitulo){
            $sql .=" and ex.exe_capitulo = ".$capitulo;
        }
        $sql .= " order by ex.exe_ordem asc";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){           
            $exercicio = Array(
                'exe_id'       => $qr["exe_id"],
                'exe_nome'     => $qr["exe_nome"],
                'exe_diretorio'=> $qr["exe_diretorio"],
                'exe_tipo'     => $qr["exe_tipo"],
                'exe_serie'    => $qr["exe_serie"],
                'exe_tema'     => $qr["exe_tema"],
                'exe_capitulo' => $qr["exe_capitulo"],
                'exe_ordem'    => $qr["exe_ordem"],
                'drt_id'       => $qr["drt_id"],
                'drt_nome'     => $qr["drt_nome"],
                'drt_descricao'=> $qr["drt_descricao"]
            );
            array_push($lista, $exercicio);
        };
        return $lista;
    }

    function selectAllExercicioBySerieCapitulo($serie, $capitulo)
    {
        $sql  = "select * from exercicio ex ";
        $sql .= "join diretorio dir on dir.drt_id = ex.exe_diretorio ";
        $sql .= "Where ex.exe_serie = ".$serie;
        if($capitulo){
            $sql .=" and ex.exe_capitulo = ".$capitulo;
        }
        $sql .= " order by ex.exe_ordem asc";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){           
            $exercicio = Array(
                'exe_id'       => $qr["exe_id"],
                'exe_nome'     => $qr["exe_nome"],
                'exe_diretorio'=> $qr["exe_diretorio"],
                'exe_tipo'     => $qr["exe_tipo"],
                'exe_serie'    => $qr["exe_serie"],
                'exe_tema'     => $qr["exe_tema"],
                'exe_capitulo' => $qr["exe_capitulo"],
                'exe_ordem'    => $qr["exe_ordem"],
                'drt_id'       => $qr["drt_id"],
                'drt_nome'     => $qr["drt_nome"],
                'drt_descricao'=> $qr["drt_descricao"]
            );
            array_push($lista, $exercicio);
        };
        return $lista;
    }


    function selectExercicioProntosRegistroAcesso($idExercicio, $idUsuario)
    { 
        $sql  = "select * from registro_acesso where rgc_exercicio=".$idExercicio." and rgc_usuario=".$idUsuario; 
        $result = $this->retrieve($sql);  
        $qr = mysqli_fetch_array($result);

        if(isset($qr['rgc_id'])){
            $registro = new ResgistroAcesso();
            $registro->setRgc_id($qr['rgc_id']);
            $registro->setRgc_usuario($qr['rgc_usuario']);
            $registro->setRgc_exercicio($qr['rgc_exercicio']);
            $registro->setRgc_inicio($qr['rgc_inicio']);
            $registro->setRgc_fim($qr['rgc_fim']);  
            return $registro;
        }else{
            return false;
        }        
    }

    function selectExercicioProntoEscrita($idExercicio, $idUsuario){
        $sql  = "select * from resposta_txt where rspt_exercicio=".$idExercicio." and rspt_usuario=".$idUsuario;
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        return $qr;
    }

    function selectExercicioProntoMultipla($idExercicio, $idUsuario){
        $sql  = "select * from resposta_multipla where rspm_exercicio=".$idExercicio." and rspm_usuario=".$idUsuario;
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        return $qr;
    }

    function selectCountExercicioNumQuestoes($exercicio){
        $sql  = "select * from questao where qst_exercicio = ".$exercicio;
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        return $qr;
    }

    function selectCountExercicioNumGabarito($exercicio){
        $sql  = "select * from gabarito where gbt_questao = ".$exercicio;
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        return $qr;
    }

    public function countExerciciosAluno($idEscola, $serie)
    {
        $sql = 'SELECT COUNT(*) FROM exercicio ex
                JOIN liberar_capitulo lc ON (ex.exe_serie =  lc.lbr_livro AND ex.exe_capitulo = lc.lbr_capitulo)
                WHERE lc.lbr_escola = '.$idEscola.' AND lc.lbr_status = 1 AND ex.exe_serie = '.$serie;
        return $this->retrieve($sql)->fetch_row()[0];
    }

    public function exerciciosCompletosUsuario($par, $usuario)
    {
        $sql = "SELECT COUNT(*) FROM exercicio ex";
        $where = ' WHERE ex.exe_id IN (
                    SELECT DISTINCT rgc_exercicio FROM registro_acesso ra
                    WHERE ra.rgc_usuario ='.$usuario['id'].' 
                    AND ra.rgc_inicio < ra.rgc_fim)';
        if ($par['capitulo'] != 0)
            $where .= " AND ex.exe_capitulo = ".$par['capitulo'];

        $sql = $sql.$where;

        return $this->retrieve($sql)->fetch_row()[0];
    }

    public function exerciciosCompletosProfessor($par, $usuario)
    {

        $sql = "SELECT DISTINCT ex.exe_id, ra.rgc_usuario FROM registro_acesso ra";
        $join = " JOIN usuario_variavel uv ON uv.usv_usuario = ra.rgc_usuario";
        $join .= " JOIN exercicio ex ON ex.exe_id = ra.rgc_exercicio";
        $join .= " JOIN liberar_capitulo lc on lc.lbr_capitulo = ex.exe_capitulo AND lc.lbr_livro = ex.exe_serie";
        $join .= " JOIN grupo g ON g.grp_id = uv.usv_grupo";
        $where = " WHERE g.grp_professor = ".$usuario['id'];
        if ($par['capitulo'] != 0)
            $where .= " AND ex.exe_capitulo = ".$par['capitulo'];
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        if ($par['sala'] != 0)
            $where .= " AND g.grp_id = ".$par['sala'];

        $sql = $sql.$join.$where;

        $return = $this->retrieve($sql);

        return mysqli_num_rows($return);
    }

    public function exerciciosTotaisUsuario($par, $usuario)
    {
        $sql = "SELECT COUNT(*) FROM exercicio ex";
        $join = " JOIN liberar_capitulo lc ON ex.exe_serie = lc.lbr_livro AND ex.exe_capitulo = lc.lbr_capitulo";
        $where = " WHERE (ex.exe_tipo = 1 OR ex.exe_tipo = 3) AND lc.lbr_escola = ".$usuario['escola']." AND ex.exe_serie = ".$usuario['serie'];
        if ($par['capitulo'] != 0)
            $where .= " AND ex.exe_capitulo = ".$par['capitulo'];
        $sql = $sql.$join.$where;

        return $this->retrieve($sql)->fetch_row()[0];
    }

    public function exerciciosTotaisProfessor($par, $usuario)
    {
        $sql = "SELECT COUNT(*) FROM exercicio ex";
        $join = " JOIN liberar_capitulo lc ON ex.exe_serie = lc.lbr_livro AND ex.exe_capitulo = lc.lbr_capitulo";
        $join .= " JOIN grupo g ON lc.lbr_escola = g.grp_escola";
        $join .= " JOIN usuario us ON us.usr_escola = lc.lbr_escola";
        $join .= " JOIN usuario_variavel uv ON uv.usv_usuario = us.usr_id";
        $where = " WHERE (ex.exe_tipo = 1 OR ex.exe_tipo = 3) AND g.grp_professor = ".$usuario['id']." AND lc.lbr_livro = uv.usv_serie AND uv.usv_grupo = g.grp_id";
        if ($par['livro'] != 0)
            $where .= " AND ex.exe_serie = ".$par['livro'];
        if ($par['capitulo'] != 0)
            $where .= " AND ex.exe_capitulo = ".$par['capitulo'];
        if ($par['sala'] != 0)
            $where .= " AND g.grp_id = ".$par['sala'];
        $sql = $sql.$join.$where;
        return $this->retrieve($sql)->fetch_row()[0];
    }

}
?>