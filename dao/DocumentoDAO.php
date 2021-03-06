
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
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Documento.php');


/**
 * Description of DocumentosDAO
 *
 * @author MURANO DESIGN
 */

class DocumentoDAO extends DAO{

    public function  __construct($da) {
        parent::__construct($da);
    }

     
    // **********************
    // INSERT
    // **********************

    public function insertDocumentos($documentos)
    {
        $sql =  "insert into documento ( doc_assunto,doc_descricao,doc_arquivo )values";
        $sql .= "( '".$documentos->getDoc_assunto()."','".$documentos->getDoc_descricao()."','".$documentos->getDoc_arquivo()."')";
        return $this->executeAndReturnLastID($sql);
    }

    // **********************
    // DELETE
    // **********************

    public function deleteDocumentos($iddocumentos)
    {
        $sql = "delete from documento where doc_id = $iddocumentos";
        return $this->executeAndReturnLastID($sql);
    }

    // **********************
    // SELECT BY ID
    // **********************

    function selectByIdDocumentos($iddocumentos)
    {
        $sql = "select * from documento where doc_id = ". $iddocumentos." limit 1 ";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        $documentos= new Documento();
        $documentos->setDoc_id($qr['doc_id']);
        $documentos->setDoc_assunto($qr['doc_assunto']);
        $documentos->setDoc_descricao($qr['doc_descricao']);
        $documentos->setDoc_arquivo($qr['doc_arquivo']);
        
        return $documentos;
    }

    // **********************
    // SELECT ALL
    // **********************

    function  selectAllDocumentos()
    {
        $sql = "select * from documento ";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
        $documentos= new Documentos();
        $documentos->setDoc_id($qr['doc_id']);
        $documentos->setDoc_assunto($qr['doc_assunto']);
        $documentos->setDoc_descricao($qr['doc_descricao']);
        $documentos->setDoc_arquivo($qr['doc_arquivo']);

        array_push($lista,$documentos);
        };
        return $lista;
    }

    // **********************
    // UPDATE
    // **********************

    function updateDocumentos($documentos)
    {
        $sql = "update documento set ";
        $sql .= "doc_assunto = '".$documentos->getDoc_assunto()."',";
$sql .= "doc_descricao = '".$documentos->getDoc_descricao()."',";
$sql .= "doc_arquivo = '".$documentos->getDoc_arquivo()."',";

        $sql .= "where doc_id = '".$documentos->getDoc_id()."'";
        return $this->executeAndReturnLastID($sql);
    }
    
    public function selectDocumentoEnviados()
    {
        $sql  = "   SELECT doe_id, doe_data_envio, doe_visto, doe_retorno, doc_id, doc_assunto, doc_descricao, ";
        $sql .= "   MAX(IF(doe_retorno = 1 AND dor_id IS NULL, 1, 0)) as retornos_pendentes, MAX(IF(doe_retorno = 1 AND dor_visto = 0, 1, 0)) as retornos_nao_vistos ";
        $sql .= "   FROM documento_envio ";
        $sql .= "   JOIN documento ON doe_documento = doc_id ";
        $sql .= "   LEFT JOIN documento_retorno ON dor_envio = doe_id ";
        $sql .= "   GROUP BY doe_documento";
        $result = $this->retrieve($sql);
        $retorno = [];
        
        while($qr = mysqli_fetch_array($result)) {
            $doe = new DocumentoEnvio();
            $doe->setDoe_id($qr["doe_id"]);
            $doe->setDoe_data_envio($qr["doe_data_envio"]);
            $doe->setDoe_visto($qr["doe_visto"]);
            $doe->setDoe_retorno($qr["doe_retorno"]);
            $doe->setDoe_documento(new Documento());
            $doe->getDoe_documento()->setDoc_id($qr["doc_id"]);
            $doe->getDoe_documento()->setDoc_assunto($qr["doc_assunto"]);
            $doe->getDoe_documento()->setDoc_descricao($qr["doc_descricao"]);

            array_push($retorno, [
                "documento_envio" => $doe,
                "verificadores" => [
                    "exige_retorno" => intval($qr["doe_retorno"]),
                    "retornos_nao_vistos" => intval($qr["retornos_nao_vistos"]),
                    "retornos_pendentes" => intval($qr["retornos_pendentes"])
                ]
            ]);
        }
        
        return $retorno;
    }
    
    
    public function selectDocumentoByEnvio($idenvio) {
        $sql  = "select doc.* from documento doc ";
        $sql .= "join documento_envio doe on doe.doe_documento = doc.doc_id ";
        $sql .= "where doe.doe_id = {$idenvio};";
        
        $result = $this->retrieve($sql);
        
        $qr = mysqli_fetch_array($result);
        $doc = new Documento();
        $doc->setDoc_id($qr["doc_id"]);
        $doc->setDoc_assunto($qr["doc_assunto"]);
        $doc->setDoc_descricao($qr["doc_descricao"]);
        $doc->setDoc_arquivo($qr["doc_arquivo"]);
        
        return $doc;
    }
    
    public function getEnviados() {
        $sql  = "select distinct doc.* from documento doc "; 
        $sql .= "join documento_envio doe on doe.doe_documento = doc.doc_id;";
        $retorno = [];
        $result = $this->retrieve($sql);
        
        if($result) {
            while($qr = mysqli_fetch_assoc($result)) {
                $doc = new Documento();
                $doc->setDoc_id($qr["doc_id"]);
                $doc->setDoc_assunto($qr["doc_assunto"]);
                $doc->setDoc_descricao($qr["doc_descricao"]);
                $doc->setDoc_arquivo($qr["doc_arquivo"]);
                
                array_push($retorno, $doc);
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
}
?>