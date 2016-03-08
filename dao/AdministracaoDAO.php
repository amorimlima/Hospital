<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
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
    
     public function insert($adm)
     {
         $sql  = "insert into administracao (adm_administracao) values ";
         $sql .= "('".$adm->getadm_administracao()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
     public function update($adm)
     {
         $sql  = "update administracao set adm_administracao = '".$adm->getadm_administracao()."'";
         $sql .= "where adm_id = ".$adm->getadm_id()." limit 1";
         return $this->execute($sql);
     } 
     
     public function delete($idadm)
     {
        $sql = "delete from administracao where adm_id = ".$idadm."";
    	return $this->execute($sql);   
     }
     
     public function select($idadm)
     {
        $sql = "select * from administracao where adm_id = ".$idadm." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $adm = new Administracao();
	    	$adm->setadm_id($qr["adm_id"]);
	    	$adm->setadm_administracao($qr["adm_administracao"]);
	    	    	
    	return $adm;
     }
     
     
     public function selectFull()
     {
        $sql = "select * from administracao";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $adm = new Administracao();
	    	$adm->setadm_id($qr["adm_id"]);
	    	$adm->setadm_administracao($qr["adm_administracao"]);
                array_push($lista, $adm);   
        }
    	return $lista;
     }
    
}
?>