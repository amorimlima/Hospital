<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'EnvioDocumento.php');
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

class EnvioDocumentoDAO extends DAO{
    
     public function  __construct($da) {
        parent::__construct($da);
    }
    
      public function insert($env)
     {
         $sql  = "insert into envio_documentos (idEscolas,idRemetente,idDestinatario,url,visto) values ";
         $sql .= "(".$env->getEnv_idEscola().",";
         $sql .= "".$env->getEnv_idRemetente().",".$env->getEnv_idDestinatario().",";
         $sql .= "'".$env->getEnv_url()."','".$env->getVisto()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($env)
     {
        $sql  = "update envio_documentos set idEscolas = '".$env->getEnv_idEscola()."',";
    	$sql .= "idRemetente = '".$env->getEnv_idRemetente()."',";
    	$sql .= "idDestinatario = '".$env->getEnv_idDestinatario()."'";
        $sql .= "url = '".$env->getEnv_url()."'";
        $sql .= "visto = '".$env->getVisto()."'";
        $sql .= "where  idEnvioDocumento = ".$env->getEnv_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idenv)
     {
         $sql = "delete from envio_documentos where idEnvioDocumento = ".$idenv."";
    	return $this->execute($sql); 
     }
     
     public function select($idenv)
     {
        $sql = "select * from envio_documentos where idEnvioDocumento = ".$idenv." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $env = new EnvioDocumento();
                $env->setEnv_id($qr["idEnvioDocumento"]);
                $env->setEnv_idEscola($qr["idEscolas"]);
                $env->setEnv_idRemetente($qr["idRemetente"]);
                $env->setEnv_idDestinatario($qr["idDestinatario"]);
                $env->setEnv_url($qr["url"]);
                $env->setVisto($qr["visto"]);
	    	    	
    	return $env;
     }
     
    public function count(){
        $sql = "select * from envio_documentos where visto = 0";
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        
        return $qr;
        
     }
     
     public function selectNaoVistos($idenv){
        $sql = "select * from envio_documentos where visto = 0 and idEnvioDocumento = ".$idenv." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $env = new EnvioDocumento();
                $env->setEnv_id($qr["idEnvioDocumento"]);
                $env->setEnv_idEscola($qr["idEscolas"]);
                $env->setEnv_idRemetente($qr["idRemetente"]);
                $env->setEnv_idDestinatario($qr["idDestinatario"]);
                $env->setEnv_url($qr["url"]);
                $env->setVisto($qr["visto"]);
	    	    	
    	return $env;
     }

     public function selectFull()
     {
        $sql = "select * from envio_documentos";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $env = new EnvioDocumento();
                $env->setEnv_id($qr["idEnvioDocumento"]);
                $env->setEnv_idEscola($qr["idEscolas"]);
                $env->setEnv_idRemetente($qr["idRemetente"]);
                $env->setEnv_idDestinatario($qr["idDestinatario"]);
                $env->setEnv_url($qr["url"]);
                $env->setVisto($qr["visto"]);	
                array_push($lista, $env);
        }
    	return $lista;
     }
}



