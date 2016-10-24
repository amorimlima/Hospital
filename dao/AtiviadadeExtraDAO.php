<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'AtividadeExtra.php');

class AtividadeExtraDAO extends DAO{

	public function  __construct($da) {
    	parent::__construct($da);
    }

    public function insert($ate)
    {
    	$sql = "INSERT INTO atividade_extra (ate_atividade, ate_descricao, ate_data, ate_arquivo) VALUES ";
    	$sql .= "('".$ate->getAte_atividade()."', ";
        $sql .= "'".$ate->getAte_descricao()."', ";
    	$sql .= "CURDATE(), ";
    	$sql .= "'".$ate->getAte_arquivo()."')";

		return $this->executeAndReturnLastID($sql);
    }

    public function delete($ateId)
    {
    	$sql = "DELETE FROM atividade_extra WHERE ate_id = ".$ateId;
    	return $this->executeAndReturnLastID($sql);
    }

    public function update($ate)
    {
    	$sql = "UPDATE atividade_extra SET ";
    	$sql .= "ate_atividade = '".$ate->getAte_atividade()."', ";
    	$sql .= "ate_descricao = '".$ate->getAte_descricao()."', ";
    	$sql .= "ate_arquivo = '".$ate->getAte_arquivo()."' ";
    	$sql .= "WHERE ate_id = '".$ate->getAte_id()"'";
        return $this->executeAndReturnLastID($sql);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM atividade_extra";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)) {
            $atividade_extra = new AtividadeExtra();

            $atividade_extra->setAte_id($qr['ate_id']);
            $atividade_extra->setAte_atividade($qr['ate_atividade']);
            $atividade_extra->setAte_descricao($qr['ate_descricao']);
            $atividade_extra->setAte_data($qr['ate_data']);
            $atividade_extra->setAte_arquivo($qr['ate_arquivo']);

            array_push($lista, $atividade_extra);
        }

        return $lista;
    }

    public function selectId($ateId)
    {
        $sql = "SELECT * FROM atividade_extra WHERE ate_id = ".$ate_id;
        $result = $this->retrieve($sql);
        $atividade_extra = new AtividadeExtra();

        $atividade_extra->setAte_id($qr['ate_id']);
        $atividade_extra->setAte_atividade($qr['ate_atividade']);
        $atividade_extra->setAte_descricao($qr['ate_descricao']);
        $atividade_extra->setAte_data($qr['ate_data']);
        $atividade_extra->setAte_arquivo($qr['ate_arquivo']);

        return $atividade_extra;
    }

}