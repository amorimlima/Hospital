<?php
if(!isset($_SESSION['PATH_SYS'])){
    session_start();
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Escola.php');
include_once($path['beans'].'Endereco.php');
include_once($path['beans'].'Administracao.php');
include_once($path['beans'].'TipoEscola.php');
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
        $sql  = "insert into escola (esc_razao_social,esc_nome,esc_cnpj,esc_endereco,esc_tipo_escola,esc_administracao,esc_status,esc_site,esc_nome_diretor,esc_email_diretor,esc_nome_coordenador,esc_email_coordenador, esc_codigo) values ";
        $sql .= "('".$esc->getesc_razao_social()."','".$esc->getesc_nome()."',";
        $sql .= "'".$esc->getesc_cnpj()."','".$esc->getesc_endereco()."',";
        $sql .= "'".$esc->getesc_tipo_escola()."','".$esc->getesc_administracao()."',";
        $sql .= "'".$esc->getesc_status()."','".$esc->getesc_site()."','".$esc->getesc_nome_diretor()."',";
        $sql .= "'".$esc->getesc_email_diretor()."','".$esc->getesc_nome_coordenador()."','".$esc->getesc_email_coordenador()."','".$esc->getesc_codigo()."')";
       // echo $sql;
        return $this->executeAndReturnLastID($sql);
    }

    public function update($esc)
    {
        $sql  = "update escola set esc_razao_social = '".$esc->getesc_razao_social()."',";
        $sql .= "esc_nome = '".$esc->getesc_nome()."',";
        $sql .= "esc_cnpj = '".$esc->getesc_cnpj()."',";
        $sql .= "esc_endereco = '".$esc->getesc_endereco()."',";
        $sql .= "esc_tipo_escola = '".$esc->getesc_tipo_escola()."',";
        $sql .= "esc_administracao = '".$esc->getesc_administracao()."',";
        $sql .= "esc_status = '".$esc->getesc_status()."',";
        $sql .= "esc_site = '".$esc->getesc_site()."',";
        $sql .= "esc_nome_diretor = '".$esc->getesc_nome_diretor()."',";
        $sql .= "esc_email_diretor = '".$esc->getesc_email_diretor()."',";
        $sql .= "esc_nome_coordenador = '".$esc->getesc_nome_coordenador()."',";
        $sql .= "esc_email_coordenador = '".$esc->getesc_email_coordenador()."',";
        $sql .= "esc_codigo = '".$esc->getesc_codigo()."'";
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
        $lista = Array();

        $esc = new Escola();
        $esc->setesc_id($qr["esc_id"]);
        $esc->setesc_razao_social($qr["esc_razao_social"]);
        $esc->setesc_nome($qr["nome"]);
        $esc->setesc_cnpj($qr["esc_cnpj"]);
        $esc->setesc_endereco($qr["esc_endereco"]);
        $esc->setesc_tipo_escola($qr["esc_tipo_escola"]);
        $esc->setesc_administracao($qr["esc_administracao"]);
		$esc->setesc_status($qr["esc_status"]);
		$esc->setesc_site($qr["esc_site"]);
		$esc->setesc_nome_diretor($qr["esc_nome_diretor"]);
		$esc->setesc_email_diretor($qr["esc_email_diretor"]);
		$esc->setesc_nome_coordenador($qr["esc_nome_coordenador"]);
		$esc->setesc_email_coordenador($qr["esc_email_coordenador"]);
		$esc->setesc_codigo($qr["esc_codigo"]);

        return $esc;
    }

    public function selectPendentes()
    {
        $sql  = "SELECT * FROM escola esc ";
        $sql .= "JOIN endereco end ON esc.esc_endereco = end.end_id ";
        $sql .= "JOIN tipo_escola tps ON esc.esc_tipo_escola = tps.tps_id ";
        $sql .= "JOIN administracao adm ON esc.esc_administracao = adm.adm_id ";
        $sql .= "WHERE esc_status = 0";
        $result = $this->retrieve($sql);
        $lista = Array();

        while ($qr = mysqli_fetch_array($result))
        {
            $esc = new Escola();
            $esc->setesc_id($qr["esc_id"]);
            $esc->setesc_razao_social($qr["esc_razao_social"]);
            $esc->setesc_nome($qr["esc_nome"]);
            $esc->setesc_razao_social($qr["esc_nome"]);
            $esc->setesc_cnpj($qr["esc_cnpj"]);

            $esc->setesc_endereco(new Endereco());
            $esc->getesc_endereco()->setend_id($qr["end_id"]);
            $esc->getesc_endereco()->setend_logradouro($qr["end_logradouro"]);
            $esc->getesc_endereco()->setend_numero($qr["end_numero"]);
            $esc->getesc_endereco()->setend_complemento($qr["end_complemento"]);
            $esc->getesc_endereco()->setend_bairro($qr["end_bairro"]);
            $esc->getesc_endereco()->setend_cep($qr["end_cep"]);
            $esc->getesc_endereco()->setend_cidade($qr["end_cidade"]);
            $esc->getesc_endereco()->setend_uf($qr["end_uf"]);
            $esc->getesc_endereco()->setend_pais($qr["end_pais"]);
            $esc->getesc_endereco()->setend_telefone_residencial($qr["end_telefone_residencial"]);
            $esc->getesc_endereco()->setend_telefone_comercial($qr["end_telefone_comercial"]);
            $esc->getesc_endereco()->setend_telefone_celular($qr["end_telefone_celular"]);
            $esc->getesc_endereco()->setend_email($qr["end_email"]);

            $esc->setesc_tipo_escola(new TipoEscola());
            $esc->getesc_tipo_escola()->setTps_id($qr["tps_id"]);
            $esc->getesc_tipo_escola()->setTps_tipo_escola($qr["tps_tipo_escola"]);
            
            $esc->setesc_administracao(new Administracao());
            $esc->getesc_administracao()->setadm_id($qr["adm_id"]);
            $esc->getesc_administracao()->setadm_administracao($qr["adm_administracao"]);

            $esc->setesc_status($qr["esc_status"]);
            $esc->setesc_site($qr["esc_site"]);
            $esc->setesc_nome_diretor($qr["esc_nome_diretor"]);
            $esc->setesc_email_diretor($qr["esc_email_diretor"]);
            $esc->setesc_nome_coordenador($qr["esc_nome_coordenador"]);
            $esc->setesc_email_coordenador($qr["esc_email_coordenador"]);
            $esc->setesc_codigo($qr["esc_codigo"]);
            array_push($lista, $esc);
        }
        return $lista;
    }
    public function confirmCadastro($idesc)
    {
        $sql = "UPDATE escola SET esc_status = '1' WHERE esc_id = ".$idesc;
        return $this->execute($sql);
    }
    public function rejectCadastro($idesc)
    {
        $sql = "UPDATE escola SET esc_status = '2' WHERE esc_id = ".$idesc;
        return $this->execute($sql);
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
            $esc->setesc_nome($qr["esc_nome"]);
            $esc->setesc_razao_social($qr["esc_nome"]);
            $esc->setesc_cnpj($qr["esc_cnpj"]);
            $esc->setesc_endereco($qr["esc_endereco"]);
            $esc->setesc_tipo_escola($qr["esc_tipo_escola"]);
            $esc->setesc_administracao($qr["esc_administracao"]);
            $esc->setesc_status($qr["esc_status"]);
			$esc->setesc_site($qr["esc_site"]);
			$esc->setesc_nome_diretor($qr["esc_nome_diretor"]);
			$esc->setesc_email_diretor($qr["esc_email_diretor"]);
			$esc->setesc_nome_coordenador($qr["esc_nome_coordenador"]);
			$esc->setesc_email_coordenador($qr["esc_email_coordenador"]);
			$esc->setesc_codigo($qr["esc_codigo"]);
            array_push($lista, $esc);
        }
        return $lista;
    }
    
	public function verificaCnpj($cnpj)
    {
        $sql = "select count(*) as total from escola where esc_cnpj = '$cnpj'";
    	$result = $this->retrieve($sql);
		$qr = mysqli_fetch_array($result);
		return $qr["total"];	
    }
}
?>