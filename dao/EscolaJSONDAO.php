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

    public function insert($ejs)
    {
        $sql  = "insert into escola_json (ejs_escola, ejs_string) values ";
        $sql .= "('".$ejs->getEjs_escola()."''".$ejs->getEjs_string()."')";
        return $this->execute($sql);
    }

    public function update($ejs)
    {
        $sql  = "update escola_json set ejs_string = '".$ejs->getEjs_string()."',";
        $sql .= "where ejs_id = ".$ejs->getEjs_id()." limit 1";
        return $this->execute($sql);
    }

    public function delete($idejs)
    {
        $sql = "delete from escola_json where ejs_id = ".$idejs."";
        return $this->execute($sql);
    }

    public function select($idejs)
    {
        $sql = "select * from escola_json where ejs_id = ".$idejs." ";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);

        $ejs = new EscolaJSON();
        $ejs->setEjs_id($qr["ejs_id"]);
        $ejs->setEjs_escola($qr["ejs_escola"]);
        $ejs->setEjs_string($qr["ejs_string"]);

        return $ejs;
    }

    public function selectFull()
    {
        $sql = "select * from escola_json";
        $result = $this->retrieve($sql);
        $lista = array();
        while ($qr = mysqli_fetch_array($result))
        {
            $ejs = new EscolaJSON();
            $ejs->setEjs_id($qr["ejs_id"]);
            $ejs->setEjs_escola($qr["ejs_escola"]);
            $ejs->setEjs_string($qr["ejs_string"]);
            array_push($lista, $ejs);
        }
        return $lista;
    }

    public function insertAndReturnId($ejs)
    {
        $sql = "INSERT INTO escola_json (ejs_escola, ejs_string) VALUES ('{$ejs->getEjs_escola()}', '{$ejs->getEjs_string}')";
        return $this->executeAndReturnLastID($sql);
    }
}
?>