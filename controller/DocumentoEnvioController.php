
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        DocumentoEnvio
* GENERATION DATE:  05.09.2016
* FOR MYSQL TABLE:  documento_envio
* FOR MYSQL DB:     hcb
* -------------------------------------------------------
* CODE GENERATED BY:
* @MURANO DESIGN
* -------------------------------------------------------
*
*/

session_start();
$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'DocumentoEnvioDAO.php');


/**
 * Description of DocumentoEnvioController
 *
 * @author MURANO DESIGN
 */

class DocumentoEnvioController {

    private $documentoenvioDAO;

    public function  __construct() {
        $this->documentoenvioDAO = new DocumentoEnvioDAO(new DataAccess());
    }


    public function insertDocumentoEnvio($documentoenvio) {
        return $this->documentoenvioDAO->insertDocumentoEnvio($documentoenvio);
    }

    public function updateDocumentoEnvio($documentoenvio) {
        return $this->documentoenvioDAO->updateDocumentoEnvio($documentoenvio);
    }

    public function deleteDocumentoEnvio($documentoenvio) {
        return $this->documentoenvioDAO->deleteDocumentoEnvio($documentoenvio);
    }

    public function selectByIdDocumentoEnvio($idDocumentoEnvio){
        $documentoenvio = $this->documentoenvioDAO->selectByIdDocumentoEnvio($iddocumentoenvio);
        return  $documentoenvio;
    }

    public function selectAllDocumentoEnvio(){
        $documentoenvio = $this->documentoenvioDAO->selectAllDocumentoEnvio();
        return  $documentoenvio;
    }

    public function insertParcial($documentoEnvio)
    {
        return $this->documentoenvioDAO->insertParcial($documentoEnvio);
    }
}
?>