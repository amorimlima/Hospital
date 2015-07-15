<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'UsuarioGrupoMensagem.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioGrupoMensagemDAO
 *
 * @author Kevyn
 */
class UsuarioGrupoMensagemDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($ugm)
     {
         $sql  = "insert into usuario_grupo_mensagem (ugm_grupo,ugm_usuario) values ";
         $sql .= "('".$ugm->getugm_grupo()."','";
         $sql .= "'".$ugm->getugm_usuario()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($ugm)
     {
        $sql  = "update usuario_grupo_mensagem set ugm_grupo = '".$ugm->getugm_grupo()."',";
    	$sql .= "ugm_usuario = ".$ugm->getugm_usuario().",";
        $sql .= "where  ugm_id = ".$ugm->getugm_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idugm)
     {
         $sql = "delete from usuario_grupo_mensagem where ugm_id = ".$idugm."";
    	return $this->execute($sql); 
     }
    
     public function select($idugm)
     {
        $sql = "select * from usuario_grupo_mensagem where ugm_id = ".$idugm." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $ugm = new UsuarioGrupoMensagem();
                $ugm->setugm_id($qr["ugm_id"]);
                $ugm->setugm_grupo($qr["ugm_grupo"]);
                $ugm->setugm_usuario($qr["ugm_usuario"]);
                    
	    	    	
    	return $ugm;
     }
     
     public function selectFull()
     {
        $sql = "select * from usuario_grupo_mensagem";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $ugm = new UsuarioGrupoMensagem();
                $ugm->setugm_id($qr["ugm_id"]);
                $ugm->setugm_grupo($qr["ugm_grupo"]);
                $ugm->setugm_usuario($qr["ugm_usuario"]);
                array_push($lista, $ugm);
        }	    	
    	return $lista;
     }
}
?>