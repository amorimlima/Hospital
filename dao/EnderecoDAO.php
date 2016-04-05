<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Endereco.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnderecoDAO
 *
 * @author Kevyn
 */
class EnderecoDAO extends DAO{
    //put your code here
    
      public function  __construct($da) {
        parent::__construct($da);
    }
    
      public function insert($end)
     {
        $sql  = "insert into endereco (";
        $sql .= "end_logradouro,";
        $sql .= "end_numero,";
        $sql .= "end_complemento,";
        $sql .= "end_cep,";
        $sql .= "end_bairro,";
        $sql .= "end_cidade,";
        $sql .= "end_uf,";
        $sql .= "end_pais,";
        $sql .= "end_telefone_residencial,";
        $sql .= "end_telefone_comercial,";
        $sql .= "end_telefone_celular,";
        $sql .= "end_email";
        $sql .= ") values (";
        $sql .= "'".$end->getend_logradouro()."',";
        $sql .= "'".$end->getend_numero()."',";
        $sql .= "'".$end->getend_complemento()."',";
    	$sql .= "'".$end->getend_cep()."',";
    	$sql .= "'".$end->getend_bairro()."',";
    	$sql .= "'".$end->getend_cidade()."',";
        $sql .= "'".$end->getend_uf()."',";
        $sql .= "'".$end->getend_pais()."',";
        $sql .= "'".$end->getend_telefone_residencial()."',";
        $sql .= "'".$end->getend_telefone_comercial()."',";
        $sql .= "'".$end->getend_telefone_celular()."',";
        $sql .= "'".$end->getend_email()."')";
		//echo $sql;
    	return $this->executeAndReturnLastID($sql);
     }
     
     public function update($end)
    {
    	$sql  = "update endereco set end_logradouro = '".$end->getend_logradouro()."',";
    	$sql .= "end_numero = '".$end->getend_numero()."',";
    	$sql .= "end_complemento = '".$end->getend_complemento()."',";
    	$sql .= "end_cep = '".$end->getend_cep()."',";
    	$sql .= "end_bairro = '".$end->getend_bairro()."',";
    	$sql .= "end_cidade = '".$end->getend_cidade()."',";
        $sql .= "end_uf = '".$end->getend_uf()."',";
        $sql .= "end_pais = '".$end->getend_pais()."',";
        $sql .= "end_telefone_residencial = '".$end->getend_telefone_residencial()."',";
        $sql .= "end_telefone_comercial = '".$end->getend_telefone_comercial()."',";
        $sql .= "end_telefone_celular = '".$end->getend_telefone_celular()."',";
        $sql .= "end_email = '".$end->getend_email()."'";
    	$sql .= "where end_id = ".$end->getend_id()." limit 1";
//    	echo $sql;
    	return $this->execute($sql);
    }
    
    public function delete($idend)
    {
    	$sql = "delete from endereco where end_id = ".$idend."";
    	return $this->execute($sql);
    }
    
      public function select($idend)
    {
    	$sql = "select * from endereco where end_id = ".$idend." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $end = new Endereco();
                $end->setend_id($qr["end_id"]);
                $end->setend_logradouro($qr["end_logradouro"]);
                $end->setend_numero($qr["end_numero"]);
                $end->setend_complemento($qr["end_complemento"]);
                $end->setend_cep($qr["end_cep"]);
                $end->setend_cep($qr["end_bairro"]);
                $end->setend_cidade($qr["end_cidade"]);
                $end->setend_uf($qr["end_uf"]);
                $end->setend_pais($qr["end_pais"]);
                $end->setend_telefone_residencial($qr["end_telefone_residencial"]);
                $end->setend_telefone_comercial($qr["end_telefone_comercial"]);
                $end->setend_telefone_celular($qr["end_telefone_celular"]);
                $end->setend_email($qr["end_email"]);
            	    	
    	return $end;
    }
    
    public function selectFull()
    {
        $sql = "select * from endereco";
    	$result = $this->retrieve($sql);
        $lista = array();
    	while ($qr = mysqli_fetch_array($result))
    	{ 
                $end = new Endereco();
                $end->setend_id($qr["end_id"]);
                $end->setend_logradouro($qr["end_logradouro"]);
                $end->setend_numero($qr["end_numero"]);
                $end->setend_complemento($qr["end_complemento"]);
                $end->setend_cep($qr["end_cep"]);
                $end->setend_cep($qr["end_bairro"]);
                $end->setend_cidade($qr["end_cidade"]);
                $end->setend_uf($qr["end_uf"]);
                $end->setend_pais($qr["end_pais"]);
                $end->setend_telefone_residencial($qr["end_telefone_residencial"]);
                $end->setend_telefone_comercial($qr["end_telefone_comercial"]);
                $end->setend_telefone_celular($qr["end_telefone_celular"]);
                $end->setend_email($qr["end_email"]);
            	array_push($lista, $end);                    
        }	
    	return $lista;
    }
    
	public function verificaEmail($email)
    {
        $sql = "select count(*) as total from endereco where end_email = '$email'";
    	$result = $this->retrieve($sql);
		$qr = mysqli_fetch_array($result);
		return $qr["total"];	
    }
}
?>