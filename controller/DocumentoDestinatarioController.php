<?php

$path = $_SESSION['PATH_SYS'];
include_once($path['dao'].'DocumentoDestinatarioDAO.php');

/**
 * Description of DocumentoDestinatarioController
 *
 * @author LucasTavares
 */
class DocumentoDestinatarioController {
    private $documentoDestinatarioDAO;
    
    public function  __construct() {
        $this->documentoDestinatarioDAO = new DocumentoDestinatarioDAO(new DataAccess());
    }
    
    public function insert($dod) {
        return $this->documentoDestinatarioDAO->insert($dod);
    }
    
    public function delete($dod_id) {
        return $this->documentoDestinatarioDAO->delete($dod_id);
    }
    
    public function update($dod) {
        return $this->documentoDestinatarioDAO->update($dod);
    }
    
    public function get($dod_id) {
        return $this->documentoDestinatarioDAO->get($dod_id);
    }
    
    public function getAll() {
        return $this->documentoDestinatarioDAO->getAll();
    }
    
    public function getAllByEnvio($doe_id) {
        return $this->documentoDestinatarioDAO->getAllByEnvio($doe_id);
    }
    
    public function checkPendenciasOf($dod_id) {
        return $this->documentoDestinatarioDAO->checkPendenciasOf($dod_id);
    }
}
