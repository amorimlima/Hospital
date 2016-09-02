<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'DocumentoEnvio.php');


class DocumentoEnvioDAO extends DAO{

	public function  __construct($da) {
        parent::__construct($da);
     }

     public function insert($doe)
     {
        $sql  = "insert into galeria (doe_documento, doe_destinatario, doe_data_envio, doe_retorno) values ";
        $sql .= "('".$doe->getDoe_documento()."', ";
        $sql .= "'".$doe->getDoe_destinatario()."', ";
        $sql .= "CURDATE(), ";
        $sql .= "'".$doe->getDoe_retorno()."')";
		echo $sql;
    	return $this->execute($sql);
     }

}
?>