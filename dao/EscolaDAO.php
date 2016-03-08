<?php
if(!isset($_SESSION['PATH_SYS'])){
    session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Escola.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EscolaDAO
 *
 * @author Kevyn
 */
class EscolaDAO extends DAO{
    //put your code here

    public function  __construct($da) {
        parent::__construct($da);
    }

    public function insert($esc)
    {
        $sql  = "insert into escola (esc_razao_social,esc_cnpj,esc_endereco,esc_tipo_escola,esc_administracao) values ";
        $sql .= "('".$esc->getesc_razao_social()."','";
        $sql .= "'".$esc->getesc_cnpj()."','".$esc->getesc_endereco()."','";
        $sql .= "'".$esc->getesc_tipo_escola()."','".$esc->getesc_administracao()."')";
        echo $sql;
        return $this->execute($sql);
    }

    public function update($esc)
    {
        $sql  = "update escola set esc_razao_social = '".$esc->getesc_razao_social()."',";
        $sql .= "esc_cnpj = '".$esc->getesc_cnpj()."',";
        $sql .= "esc_endereco = '".$esc->getesc_endereco()."',";
        $sql .= "esc_tipo_escola = '".$esc->getesc_tipo_escola()."',";
        $sql .= "esc_administracao = '".$esc->getesc_administracao()."'";
        $sql .= "where  esc_id = ".$esc->getesc_id()." limit 1";
        return $this->execute($esc);
    }

    public function delete($idesc)
    {
        $sql = "delete from escola where esc_id = ".$idesc."";
        return $this->execute($sql);
    }

    public function select($idesc)
    {
        $sql = "select * from escola where esc_id = ".$idesc." ";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);

        $esc = new Escola();
        $esc->setesc_id($qr["esc_id"]);
        $esc->setesc_razao_social($qr["esc_razao_social"]);
        $esc->setesc_cnpj($qr["esc_cnpj"]);
        $esc->setesc_endereco($qr["esc_endereco"]);
        $esc->setesc_tipo_escola($qr["esc_tipo_escola"]);
        $esc->setesc_administracao($qr["esc_administracao"]);

        return $esc;
    }

    public function selectFull()
    {
        $sql = "select * from escola ORDER BY esc_razao_social";
        $result = $this->retrieve($sql);
        $lista = array();
        //while ($qr = $result->fetch_array(MYSQLI_ASSOC))
        while ($qr = mysqli_fetch_array($result))
        {
            $esc = new Escola();
            $esc->setesc_id($qr["esc_id"]);
            $esc->setesc_razao_social($qr["esc_razao_social"]);
            $esc->setesc_cnpj($qr["esc_cnpj"]);
            $esc->setesc_endereco($qr["esc_endereco"]);
            $esc->setesc_tipo_escola($qr["esc_tipo_escola"]);
            $esc->setesc_administracao($qr["esc_administracao"]);
            array_push($lista, $esc);
        }
        return $lista;
    }

}
?>