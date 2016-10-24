<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'AtividadeEscola.php');

class AtividadeEscolaDAO extends DAO{

	public function  __construct($da) {
    	parent::__construct($da);
    }

    public function insert($aes)
    {
    	$sql = "INSERT INTO atividade_escola (aes_escola, aes_atividade) VALUES ";
    	$sql .= "('".$aes->getAes_escola()."', ";
    	$sql .= "'".$aes->getAes_atividade()."')";

		return $this->executeAndReturnLastID($sql);
    }

    public function delete($aesId)
    {
    	$sql = "DELETE FREOM atividade_escola WHERE aes_id = ".$aesId;
		return $this->executeAndReturnLastID($sql);
    }

    public function update($aes)
    {
    	$sql = "UPDATE atividade_escola SET ";
    	$sql .= "aes_escola = '".$aes->getAes_escola()."', ";
    	$sql .= "aes_atividade = '".$aes->getAes_atividade()."' ";
    	$sql .= "WHERE aes_id = ".$aes->getAes_id();


		return $this->executeAndReturnLastID($sql);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM atividade_escola";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)) {
            $atividade_escola = new AtividadeEscola();

            $atividade_escola->setAes_id($qr['aes_id']);
            $atividade_escola->setAes_atividade($qr['aes_atividade']);
            $atividade_escola->setAes_escola($qr['aes_escola']);
            $atividade_escola->setAes_visualizado($qr['aes_visualizado']);

            array_push($lista, $atividade_escola);
        }

        return $lista;
    }

    public function selectAll($aesId)
    {
        $sql = "SELECT * FROM atividade_escola WHERE aes_id = ".$aesId;
        $result = $this->retrieve($sql);
        $atividade_escola = new AtividadeEscola();

        $atividade_escola->setAes_id($qr['aes_id']);
        $atividade_escola->setAes_atividade($qr['aes_atividade']);
        $atividade_escola->setAes_escola($qr['aes_escola']);
        $atividade_escola->setAes_visualizado($qr['aes_visualizado']);

        return $atividade_escola;
    }

    public function listarAtividadeEscola($idEscola)
    {
        $sql = "SELECT ate_id, ate_arquivo, ate_atividade, ate_descricao, ate_data FROM atividade_escola ";
        $sql .= "JOIN atividade_extra ON ate_id = aes_atividade ";
        $sql .= "WHERE aes_escola = ".$idEscola;
        $sql .= " ORDER BY ate_data DESC";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)) {
            $atividade_extra = new AtividadeExtra();

            $atividade_extra->setAte_id($qr['ate_id']);
            $atividade_extra->setAte_atividade($qr['ate_atividade']);
            $atividade_extra->setAte_descricao($qr['ate_descricao']);
            $atividade_extra->setAte_arquivo($qr['ate_arquivo']);
            $atividade_escola->setAes_visualizado($qr['aes_visualizado']);
            

            array_push($lista, $atividade_extra);
        }

        return $lista;
    }

}

?>