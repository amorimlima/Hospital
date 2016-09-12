
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Documentos
* GENERATION DATE:  05.09.2016
* FOR MYSQL TABLE:  documento
* FOR MYSQL DB:     hcb
* -------------------------------------------------------
* CODE GENERATED BY:
* @MURANO DESIGN
* -------------------------------------------------------
*
*/

$path = $_SESSION['PATH_SYS'];

include_once($path['dao'].'DocumentoDAO.php');


/**
 * Description of DocumentosController
 *
 * @author MURANO DESIGN
 */

class DocumentoController {


    private $documentosDAO;

    public function  __construct() {
        $this->documentosDAO = new DocumentoDAO(new DataAccess());
    }


    public function insertDocumentos($documentos) {
        return $this->documentosDAO->insertDocumentos($documentos);
    }

    public function updateDocumentos($documentos) {
        return $this->documentosDAO->updateDocumentos($documentos);
    }

    public function deleteDocumentos($documentos) {
        return $this->documentosDAO->deleteDocumentos($documentos);
    }

    public function selectByIdDocumentos($idDocumentos){
        $documentos = $this->documentosDAO->selectByIdDocumentos($iddocumentos);
        return  $documentos;
    }

    public function selectAllDocumentos(){
        $documentos = $this->documentosDAO->selectAllDocumentos();
        return  $documentos;
    }
    
    public function selectDocumentosEnviados()
    {
        return $this->documentosDAO->selectDocumentoEnviados();
    }
    
    public function selectDocumentoByEnvio($idenvio) {
        return $this->documentosDAO->selectDocumentoByEnvio($idenvio);
    }
    
    public function getEnviados() {
        return $this->documentosDAO->getEnviados();
    }
}
?>