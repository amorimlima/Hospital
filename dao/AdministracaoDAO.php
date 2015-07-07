<?php
session_start();
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Administracao.php');
/**
 * Description of CategoriaDAO
 *
 * @author Lombardi
 */

class AdministracaoDAO extends DAO{
    
     public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insertAdministracao($adm)
     {
         $sql  = "insert into administracao (adm_administracao) values ";
         $sql .= "('".$adm->getDmn_administracao()."','";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function updateAdministracao($adm)
     {
         $sql  = "update administracao set adm_administracao = '".$adm->getDmn_administracao()."',";
         $sql .= "where adm_id = ".$adm->getgetDmn_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function deleteAdministracao($idadm)
     {
        $sql = "delete from administracao where adm_id = ".$idadm."";
    	return $this->execute($sql);   
     }
     
     public function selectAdministracao($idadm)
     {
        $sql = "select * from administracao where adm_id = ".$idadm." ";
    	$result = $this->retrieve($sql);
    	$qr = mysql_fetch_array($result);

                $adm = new Administracao();
	    	$adm->setDmn_id($qr["adm_id"]);
	    	$adm->setDmn_administracao($qr["adm_administracao"]);
	    	    	
    	return $adm;
     }
     
     
     public function selectAdministracaoFull()
     {
        $sql = "select * from administracao";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $adm = new Administracao();
	    	$adm->setDmn_id($qr["adm_id"]);
	    	$adm->setDmn_administracao($qr["adm_administracao"]);
                array_push($lista, $adm);   
        }
    	return $lista;
     }
    
}
?>