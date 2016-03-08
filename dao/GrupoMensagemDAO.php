<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'GrupoMensagem.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoMensagemDAO
 *
 * @author Kevyn
 */
class GrupoMensagemDAO extends DAO{
    //put your code here
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($grm)
     {
         $sql  = "insert into grupo_mensagem (gms_grupo,gms_usuario) values ";
         $sql .= "('".$grm->getGms_grupo()."','";
         $sql .= "'".$grm->getGms_usuario()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($grm)
     {
        $sql  = "update grupo_mensagem set gms_grupo = '".$grm->getGms_grupo()."',";
    	$sql .= "gms_usuario = ".$grm->getGms_usuario().",";
        $sql .= "where gms_id = ".$grm->getGms_id()." limit 1";
        return $this->execute($sql);
     }
    
     public function delete($idgrm)
     {
         $sql = "delete from grupo_mensagem where gms_id = ".$idgrm."";
    	return $this->execute($sql); 
     }
     
     public function select($idgru)
     {
        $sql = "select * from grupo_mensagem where gms_id = ".$idgru." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $grm = new GrupoMensagem();
                $grm->setGms_id($qr["gms_id"]);
                $grm->setGms_grupo($qr["gms_grupo"]);
                $grm->setGms_usuario($qr["gms_usuario"]);
                

    	return $grm;
     }
     
     public function selectFull()
    {
        $sql = "select * from grupo_mensagem";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $grm = new GrupoMensagem();
                $grm->setGms_id($qr["gms_id"]);
                $grm->setGms_grupo($qr["gms_grupo"]);
                $grm->setGms_usuario($qr["gms_usuario"]);
                array_push($lista, $grm);
                
        }
    	return $lista;
     }
}
?>