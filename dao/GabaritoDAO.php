<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Gabarito.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GabaritoDAO
 *
 * @author Kevyn
 */
class GabaritoDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
      public function insert($gab)
     {
         $sql  = "insert into gabarito (gbt_exercicio,gbt_questao,gbt_resposta) values ";
         $sql .= "('".$gab->getGbt_exercicio()."','";
         $sql .= "'".$gab->getGbt_questao()."','".$gab->getGbt_resposta()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($gab)
     {
        $sql  = "update gabarito set gbt_exercicio = '".$gab->getGbt_exercicio()."',";
    	$sql .= "gbt_questao = '".$gab->getGbt_questao()."',";
    	$sql .= "gbt_resposta = '".$gab->getGbt_resposta()."'";
        $sql .= "where  gbt_id = ".$gab->getGbt_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idgab)
     {
         $sql = "delete from gabarito where gbt_id = ".$idgab."";
    	return $this->execute($sql); 
     }
     
     public function select($idgab)
     {
        $sql = "select * from gabarito where gbt_id = ".$idgab." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $gab = new Gabarito();
                $gab->setGbt_id($qr["gbt_id"]);
                $gab->setGbt_exercicio($qr["gbt_exercicio"]);
                $gab->setGbt_questao($qr["gbt_questao"]);
                $gab->setGbt_resposta($qr["gbt_resposta"]);
                

    	return $gab;
     }
     
     public function selectFull()
     {
        $sql = "select * from gabarito";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{

                $gab = new Gabarito();
                $gab->setGbt_id($qr["gbt_id"]);
                $gab->setGbt_exercicio($qr["gbt_exercicio"]);
                $gab->setGbt_questao($qr["gbt_questao"]);
                $gab->setGbt_resposta($qr["gbt_resposta"]);
                array_push($lista, $gab);
                
        }
    	return $lista;
     }
}
?>
