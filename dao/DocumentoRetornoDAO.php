
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        DocumentoRetorno
* GENERATION DATE:  05.09.2016
* FOR MYSQL TABLE:  documento_retorno
* FOR MYSQL DB:     hcb
* -------------------------------------------------------
* CODE GENERATED BY:
* @MURANO DESIGN
* -------------------------------------------------------
*
*/

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'DocumentoRetorno.php');


/**
 * Description of DocumentoRetornoDAO
 *
 * @author MURANO DESIGN
 */

class DocumentoRetornoDAO extends DAO{

    public function  __construct($da) {
        parent::__construct($da);
    }

     
    // **********************
    // INSERT
    // **********************

    public function insertDocumentoRetorno($documentoretorno)
    {
        $sql =  "insert into documento_retorno ( dor_documento,dor_remetente,dor_envio,dor_visto,dor_rejeitado,dor_data )values";
        $sql .= "( '".$documentoretorno->getDor_documento()."','".$documentoretorno->getDor_remetente()."','".$documentoretorno->getDor_envio()."','".$documentoretorno->getDor_visto()."','".$documentoretorno->getDor_rejeitado()."','".$documentoretorno->getDor_data()."')";
        return $this->execute($sql);
    }

    // **********************
    // DELETE
    // **********************

    public function deleteDocumentoRetorno($iddocumentoretorno)
    {
        $sql = "delete from documento_retorno where dor_id = $iddocumentoretorno";
        return $this->execute($sql);
    }

    // **********************
    // SELECT BY ID
    // **********************

    function selectByIdDocumentoRetorno($iddocumentoretorno)
    {
        $sql  = "select * from documento_retorno dor "; 
        $sql .= "join documento doc on dor.dor_documento = doc.doc_id ";
        $sql .= "join documento_envio doe on dor.dor_envio = doe.doe_id ";
        $sql .= "where dor.dor_id = ". $iddocumentoretorno." limit 1 ";

        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        $documentoretorno= new DocumentoRetorno();
        $documentoretorno->setDor_id($qr['dor_id']);
        $documentoretorno->setDor_documento(new Documento());
        $documentoretorno->getDor_documento()->setDoc_id($qr["doc_id"]);
        $documentoretorno->getDor_documento()->setDoc_assunto($qr["doc_assunto"]);
        $documentoretorno->getDor_documento()->setDoc_descricao($qr["doc_descricao"]);
        $documentoretorno->getDor_documento()->setDoc_arquivo($qr["doc_arquivo"]);
        $documentoretorno->setDor_remetente($qr['dor_remetente']);
        $documentoretorno->setDor_envio(new DocumentoEnvio());
        $documentoretorno->getDor_envio()->setDoe_id($qr["doe_id"]);
        $documentoretorno->getDor_envio()->setDoe_documento($qr["doe_documento"]);
        $documentoretorno->setDor_visto($qr['dor_visto']);
        $documentoretorno->setDor_rejeitado($qr['dor_rejeitado']);
        $documentoretorno->setDor_data($qr['dor_data']);

        return $documentoretorno;
    }

    // **********************
    // SELECT ALL
    // **********************

    function  selectAllDocumentoRetorno()
    {
        $sql = "select * from documento_retorno ";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
            $documentoretorno= new DocumentoRetorno();
            $documentoretorno->setDor_id($qr['dor_id']);
            $documentoretorno->setDor_documento($qr['dor_documento']);
            $documentoretorno->setDor_remetente($qr['dor_remetente']);
            $documentoretorno->setDor_envio($qr['dor_envio']);
            $documentoretorno->setDor_visto($qr['dor_visto']);
            $documentoretorno->setDor_rejeitado($qr['dor_rejeitado']);
            $documentoretorno->setDor_data($qr['dor_data']);

            array_push($lista,$documentoretorno);
        };
        return $lista;
    }

    // **********************
    // UPDATE
    // **********************

    function updateDocumentoRetorno($documentoretorno)
    {
        $sql = "update documento_retorno set ";
        $sql .= "dor_documento = '".$documentoretorno->getDor_documento()."',";
        $sql .= "dor_remetente = '".$documentoretorno->getDor_remetente()."',";
        $sql .= "dor_envio = '".$documentoretorno->getDor_envio()."',";
        $sql .= "dor_visto = '".$documentoretorno->getDor_visto()."',";
        $sql .= "dor_rejeitado = '".$documentoretorno->getDor_rejeitado()."',";
        $sql .= "dor_data = '".$documentoretorno->getDor_data()."',";

        $sql .= "where dor_id = '".$documentoretorno->getDor_id()."'";
        return $this->execute($sql);
    }

    public function insertParcial($dor)
     {
        $sql  = "insert into documento_retorno (dor_documento, dor_remetente, dor_envio, dor_data) values ";
        $sql .= "('".$dor->getDor_documento()."', ";
        $sql .= "'".$dor->getDor_remetente()."', ";
        $sql .= "'".$dor->getDor_envio()."', ";
        $sql .= "CURDATE()) ";

        return $this->executeAndReturnLastID($sql);
     }

    public function listarEscola($idEscola)
    {
        $sql = "SELECT * FROM documento_retorno WHERE dor_remetente = ".$idEscola." ORDER BY dor_data DESC";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
            $documentoretorno= new DocumentoRetorno();
            $documentoretorno->setDor_id($qr['dor_id']);
            $documentoretorno->setDor_documento($qr['dor_documento']);
            $documentoretorno->setDor_remetente($qr['dor_remetente']);
            $documentoretorno->setDor_envio($qr['dor_envio']);
            $documentoretorno->setDor_visto($qr['dor_visto']);
            $documentoretorno->setDor_rejeitado($qr['dor_rejeitado']);
            $documentoretorno->setDor_data($qr['dor_data']);

            array_push($lista,$documentoretorno);
        };

        return $lista;

    }

    public function visualizar($idRetorno)
    {
        $sql = "UPDATE FROM documento_retorno SET dor_visto = 1 WHERE dor_id = ".$idEnvio;
        return $this->executeAndReturnLastID($sql);
    } 

    public function rejeitar($idRetorno)
    {
        $sql = "UPDATE FROM documento_retorno SET dor_rejeitado = 1 WHERE dor_id = ".$idEnvio;
        return $this->executeAndReturnLastID($sql);
    }

    public function listarDocumento($idDocumento)
    {
        $sql = "SELECT * FROM documento_retorno ";
        $sql .= "JOIN documento_envio ON doe_id = dor_envio";
        $sql .= "WHERE dor_documento = ".$idDocumento." ORDER BY dor_data DESC";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
            $documentoretorno= new DocumentoRetorno();
            $documentoretorno->setDor_id($qr['dor_id']);
            $documentoretorno->setDor_documento($qr['dor_documento']);
            $documentoretorno->setDor_remetente($qr['dor_remetente']);
            $documentoretorno->setDor_envio($qr['dor_envio']);
            $documentoretorno->setDor_visto($qr['dor_visto']);
            $documentoretorno->setDor_rejeitado($qr['dor_rejeitado']);
            $documentoretorno->setDor_data($qr['dor_data']);

            array_push($lista,$documentoretorno);
        };

        return $lista;

    }
    
    public function getRetornosByEscolaAndEnvio($idesc, $iddoe) {
        $sql  = "select * from documento_retorno dor ";
        $sql .= "join documento doc on dor.dor_documento = doc.doc_id ";
        $sql .= "where dor_envio = {$iddoe} and dor_remetente = {$idesc};";

        
        $result = $this->retrieve($sql);
        $retorno = [];
        
        while($qr = mysqli_fetch_array($result)) {
            $dor = new DocumentoRetorno();
            $dor->setDor_id($qr["dor_id"]);
            $dor->setDor_envio($qr["dor_envio"]);
            $dor->setDor_remetente($qr["dor_remetente"]);
            $dor->setDor_documento(new Documento());
            $dor->getDor_documento()->setDoc_id($qr["doc_id"]);
            $dor->getDor_documento()->setDoc_assunto($qr["doc_assunto"]);
            $dor->getDor_documento()->setDoc_descricao($qr["doc_descricao"]);
            $dor->getDor_documento()->setDoc_arquivo($qr["doc_arquivo"]);
            $dor->setDor_rejeitado($qr["dor_rejeitado"]);
            $dor->setDor_visto($qr["dor_visto"]);
            $dor->setDor_data($qr["dor_data"]);
            
            array_push($retorno, $dor);
        }
        
        return $retorno;
    }

    public function isPendenciasRetornoHospital()
    {
        $sql = "SELECT dor_visto FROM documento_retorno ORDER BY dor_visto DESC LIMIT 1";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        return $qr["dor_visto"];
    }
}
?>
