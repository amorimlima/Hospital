<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Documentos.php');


class DocumentosDAO extends DAO{

	public function  __construct($da) {
        parent::__construct($da);
     }

     public function insert($doc)
     {
        $sql  = "insert into documento (doc_assunto, doc_descricao, doc_arquivo) values ";
        $sql .= "('".$doc->getDoc_assunto()."', ";
        $sql .= "'".$doc->getDoc_descricao()."', ";
        $sql .= "'".$doc->getDoc_arquivo()."')";

    	return $this->execute($sql);
     }

     public function update($doc)
     {
        $sql  = "update documento set doc_arquivo = {$doc->getDoc_arquivo()} ";
        $sql .= "where doc_id = {$doc->getDoc_id()}";

        return $this->execute($sql);
     }

}
?>