<?php

$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'AtividadeEscolaDAO.php');

class AtividadeEscolaController{

	private $atividadeEscolaDAO;

    public function  __construct() {
        $this->atividadeEscolaDAO = new AtividadeEscolaDAO(new DataAccess());
    }

    public function insert($aes)
    {
    	return $this->atividadeEscolaDAO->insert($aes);
    }

    public function update($aes)
    {
    	return $this->atividadeEscolaDAO->update($aes);
    }

    public function delete($aes)
    {
    	return $this->atividadeEscolaDAO->delete($aes);
    }

    public function selectAll()
    {
    	return $this->atividadeEscolaDAO->selectAll();
    }

    public function selectId($aesId)
    {
    	return $this->atividadeEscolaDAO->selectId($aesId);
    }

    public function listarAtividadeEscola($idEscola)
    {
        return $this->atividadeEscolaDAO->listarAtividadeEscola($idEscola);
    }

}

?>