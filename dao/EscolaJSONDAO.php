<?php
if(!isset($_SESSION['PATH_SYS'])){
 session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'EscolaJSON.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EscolaJSONDAO
 *
 * @author Lucas
 */
class EscolaJSONDAO extends DAO{
    //put your code here

    public function  __construct($da) {
        parent::__construct($da);
    }

    public function insert($esj)
    {
        $sql  = "insert into escola_json (esj_escola, esj_string) values ";
        $sql .= "('".$esj->getEsj_escola()."', '".$esj->getEsj_string()."')";
        return $this->execute($sql);
    }

    public function update($esj)
    {
        $sql  = "update escola_json set esj_string = '".$esj->getEsj_string()."',";
        $sql .= "where esj_id = ".$esj->getEsj_id()." limit 1";
        return $this->execute($sql);
    }

    public function delete($idesj)
    {
        $sql = "delete from escola_json where esj_id = ".$idesj."";
        return $this->execute($sql);
    }

    public function select($idesj)
    {
        $sql = "select * from escola_json where esj_id = ".$idesj." ";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);

        $esj = new EscolaJSON();
        $esj->setEsj_id($qr["esj_id"]);
        $esj->setEsj_escola($qr["esj_escola"]);
        $esj->setEsj_string($qr["esj_string"]);

        return $esj;
    }

    public function selectFull()
    {
        $sql = "select * from escola_json";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
            $esj = new EscolaJSON();
            $esj->setEsj_id($qr["esj_id"]);
            $esj->setEsj_escola($qr["esj_escola"]);
            $esj->setEsj_string($qr["esj_string"]);
            array_push($lista, $esj);
        }
        return $lista;
    }

    public function insertAndReturnId($esj)
    {
        $sql  = "INSERT INTO escola_json (esj_escola, esj_string, esj_arquivo) ";
        $sql .= "VALUES ('{$esj->getEsj_escola()}', '{$esj->getEsj_string()}', '')";
        return $this->executeAndReturnLastID($sql);
    }

    public function selectByIdEscola($idesc)
    {
        $sql = "SELECT * FROM escola_json WHERE esj_escola = {$idesc}";
        $result = $this->retrieve($sql);

        if ($qr = mysqli_fetch_array($result))
        {
            $esj = new EscolaJSON();
            $esj->setEsj_id($qr["esj_id"]);
            $esj->setEsj_escola($qr["esj_escola"]);
            $esj->setEsj_string($qr["esj_string"]);
            $esj->setEsj_arquivo($qr["esj_documento"]);

            return $esj;
        }
        else
            return false;

    }
    
    public function salvarDocumentoPreCadastro($esj) {
        $sql  = "UPDATE escola_json ";
        $sql .= "SET esj_arquivo = '" . $esj->getEsj_arquivo() . "' ";
        $sql .= "WHERE esj_id = {$esj->getEsj_id()} limit 1";
        
        return $this->executeAndReturnLastID($sql);
    }
}
?>