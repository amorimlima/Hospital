<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Exercicio.php');

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
        $exercicio->setExe_id($qr[exe_id]);
        $exercicio->setExe_nome($qr[exe_nome]);
        $exercicio->setExe_diretorio($qr[exe_diretorio]);
        $exercicio->setExe_tipo($qr[exe_tipo]);
        $exercicio->setExe_serie($qr[exe_serie]);
        $exercicio->setExe_tema($qr[exe_tema]);
        $exercicio->setExe_capitulo($qr[exe_capitulo]);
        $exercicio->setExe_ordem($qr[exe_ordem]);

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
        if($capitulo){
            $sql .=" and ex.exe_capitulo = ".$capitulo;
        }
        $sql .= " order by ex.exe_ordem asc";

        //echo $sql;
        //echo "<br>";

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
}
?>