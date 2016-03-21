<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'LiberarCapitulo.php');
include_once($path['beans'].'Capitulo.php');

/**
* Description of LiberarCapituloDAO
*
* @author Ana Carolina
*/

class LiberarCapituloDAO extends DAO{

    public function  __construct($da) {
        parent::__construct($da);
    }

    // **********************
    // INSERT
    // **********************

    public function insertLiberarCapitulo($liberarcapitulo)
    {
        $sql =  "insert into liberar_capitulo ( lbr_escola,lbr_capitulo,lbr_status )values";
        $sql .= "( '".$liberarcapitulo->getLbr_escola()."','".$liberarcapitulo->getLbr_capitulo()."','".$liberarcapitulo->getLbr_status()."')";
        return $this->execute($sql);
    }

    // **********************
    // DELETE
    // **********************

    public function deleteLiberarCapitulo($idliberarcapitulo)
    {
        $sql = "delete from liberar_capitulo where lbr_id = $idliberarcapitulo";
        return $this->execute($sql);
    }

    // **********************
    // SELECT BY ID
    // **********************

    public function selectByIdLiberarCapitulo($idliberarcapitulo)
    {
        $sql = "select * from liberar_capitulo where lbr_id = ". $idliberarcapitulo."limit 1 ";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        $liberarcapitulo= new LiberarCapitulo();
        $liberarcapitulo->setLbr_id($qr["lbr_id"]);
        $liberarcapitulo->setLbr_escola($qr["lbr_escola"]);
        $liberarcapitulo->setLbr_capitulo($qr["lbr_capitulo"]);
        $liberarcapitulo->setLbr_status($qr["lbr_status"]);

        return $liberarcapitulo;
    }

    // **********************
    // SELECT ALL
    // **********************

    public function selectAll()
    {
        $sql = "select * from liberar_capitulo ";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
            $liberarcapitulo= new LiberarCapitulo();
            $liberarcapitulo->setLbr_id($qr["lbr_id"]);
            $liberarcapitulo->setLbr_escola($qr["lbr_escola"]);
            $liberarcapitulo->setLbr_capitulo($qr["lbr_capitulo"]);
            $liberarcapitulo->setLbr_status($qr["lbr_status"]);

            array_push($lista,$liberarcapitulo);
        };
        return $lista;
    }

    // **********************
    // UPDATE
    // **********************

    public function updateLiberarCapitulo($idliberarcapitulo)
    {
        $sql = "update liberar_capitulo set ";
        $sql .= "lbr_escola = '".$liberarcapitulo->getLbr_escola()."',";
        $sql .= "lbr_capitulo = '".$liberarcapitulo->getLbr_capitulo()."',";
        $sql .= "lbr_status = '".$liberarcapitulo->getLbr_status()."',";

        $sql .= "where $idliberarcapitulo = '".$liberarcapitulo->getLbr_id()."'";
        return $this->execute($sql);
    }    

    // **********************
    // SELECT BY ID da ESCOLA
    // **********************

    public function selectByIdEscola($idEscola)
    {
        $sql  = "SELECT * FROM liberar_capitulo lbr ";
        $sql .= "JOIN capitulo cpt ON lbr.lbr_capitulo = cpt.cpt_id ";
        $sql .= "WHERE lbr_escola = ".$idEscola;

        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){

            $liberarcapitulo= new LiberarCapitulo();
            $liberarcapitulo->setLbr_id($qr["lbr_id"]);
            $liberarcapitulo->setLbr_escola($qr["lbr_escola"]);
            
            $liberarcapitulo->setLbr_capitulo(new Capitulo());
            $liberarcapitulo->getLbr_capitulo()->setCpt_id($qr["cpt_id"]);
            $liberarcapitulo->getLbr_capitulo()->setCpt_capitulo($qr["cpt_capitulo"]);

            $liberarcapitulo->setLbr_status($qr["lbr_status"]);

            array_push($lista,$liberarcapitulo);
        };
        return $lista;
    }
    public function deleteByIdLiberarCapitulo($idliberarcapitulo)
    {
        $sql = "DELETE FROM liberar_capitulo WHERE lbr_id = ".$idliberarcapitulo;
        return $this->execute($sql);
    }
}
?>