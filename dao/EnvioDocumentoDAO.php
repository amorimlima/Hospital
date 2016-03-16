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
    	$qr = mysqli_fetch_array($result);

                $env = new EnvioDocumento();
                $env->setEnv_id($qr["idEnvioDocumento"]);
                $env->setEnv_idEscola($qr["idEscolas"]);
                $env->setEnv_idRemetente($qr["idRemetente"]);
                $env->setEnv_idDestinatario($qr["idDestinatario"]);
                $env->setEnv_url($qr["url"]);
                $env->setVisto($qr["visto"]);
	    	    	
    	return $env;
     }
     
    public function count($idenv){
        $sql = "select * from envio_documentos where visto = 0 and idDestinatario = ".$idenv." ";
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        
        return $qr;
        
     }
     
     public function updateVisto($idenv){
         $sql  = "update envio_documentos set visto = 1 where idDestinatario = ".$idenv." ";
         return $this->execute($sql);
     }

        public function selectNaoVistos($idenv){
        $sql = "select * from envio_documentos where visto = 0 and idDestinatario = ".$idenv." ";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
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
    	return $env;
     }

     public function selectFull()
     {
        $sql = "select * from envio_documentos";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
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
    public function selectDocPorEscola($idesc)
    {
        $sql = "SELECT * FROM envio_documentos WHERE idEscolas = ".$idesc;
        $result = $this->retrieve($sql);
        if ( mysqli_num_rows($result) > 0) {
            $qr = mysqli_fetch_array($result);
    
            $doc = new EnvioDocumento();
            $doc->setEnv_id($qr["idEnvioDocumento"]);
            $doc->setEnv_idEscola($qr["idEscolas"]);
            $doc->setEnv_idRemetente($qr["idRemetente"]);
            $doc->setEnv_idDestinatario($qr["idDestinatario"]);
            $doc->setEnv_url($qr["url"]);
            $doc->setVisto($qr["visto"]);

            return $doc;
        } else {
            return false;
        }

       
    }
}



