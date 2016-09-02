<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'DocumentoRetorno.php');


class DocumentoRetornoDAO extends DAO{

	public function  __construct($da) {
        parent::__construct($da);
     }

     public function insert($doe)
     {
        $sql  = "insert into galeria (dor_documento, dor_remetente, dor_envio, dor_data) values ";
        $sql .= "('".$dor->getDor_documento()."', ";
        $sql .= "'".$dor->getDor_emetente()."', ";
        $sql .= "'".$dor->getDor_envio()."', ";
        $sql .= "CURDATE()) ";
		echo $sql;
    	return $this->execute($sql);
     }

}
?>