<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Grupo.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoDAO
 *
 * @author Kevyn
 */
class GrupoDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($gru)
     {
         $sql  = "insert into grupo (grp_grupo,grp_escola,grp_professor) values ";
         $sql .= "('".$gru->getGrp_grupo()."','";
         $sql .= "'".$gru->getGrp_escola()."','".$gru->getGrp_professor()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($gru)
     {
        $sql  = "update grupo set grp_grupo = '".$gru->getGrp_grupo()."',";
    	$sql .= "grp_escola = '".$gru->getGrp_escola()."',";
    	$sql .= "grp_professor = ".$gru->getGrp_professor().",";
        $sql .= "where  grp_id = ".$gru->getGrp_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idgru)
     {
         $sql = "delete from grupo where grp_id = ".$idgru."";
    	return $this->execute($sql); 
     }
     
     public function select($idgru)
     {
        $sql = "select * from grupo where grp_id = ".$idgru." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $gru = new Grupo();
                $gru->setGrp_id($qr["grp_id"]);
                $gru->setGrp_grupo($qr["grp_grupo"]);
                $gru->setGrp_escola($qr["grp_escola"]);
                $gru->setGrp_professor($qr["grp_professor"]);
                

    	return $gru;
     }
     
      public function selectFull()
      {
        $sql = "select * from grupo";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $gru = new Grupo();
                $gru->setGrp_id($qr["grp_id"]);
                $gru->setGrp_grupo($qr["grp_grupo"]);
                $gru->setGrp_escola($qr["grp_escola"]);
                $gru->setGrp_professor($qr["grp_professor"]);
                array_push($lista, $gru);
                
        }
    	return $lista;
      }
     
}
?>