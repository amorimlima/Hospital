<?php

$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'AtividadeExtraDAO.php');

class AtividadeExtraController{

	private $atividadeExtraDAO;

    public function  __construct() {
        $this->atividadeExtraDAO = new AtividadeExtraDAO(new DataAccess());
    }

    public function insert($ate)
    {
    	return $this->atividadeExtraDAO->insert($ate);
    }

    public function update($ate)
    {
    	return $this->atividadeExtraDAO->update($ate);
    }

    public function delete($ate)
    {
    	return $this->atividadeExtraDAO->delete($ate);
    }

    public function selectAll()
    {
    	return $this->atividadeExtraDAO->selectAll();
    }

    public function selectId($ateId)
    {
    	return $this->atividadeExtraDAO->selectId($ateId);
    }

}

?>