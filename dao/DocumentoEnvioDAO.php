
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

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'DocumentoEnvio.php');
include_once($path["beans"]."Escola.php");
include_once($path["beans"]."DocumentoRetorno.php");


/**
 * Description of DocumentoEnvioDAO
 *
 * @author Diego Garcia
 * @author Lucas Tavares
 */

class DocumentoEnvioDAO extends DAO{

    public function  __construct($da) {
        parent::__construct($da);
    }

     
    // **********************
    // INSERT
    // **********************

    public function insertDocumentoEnvio($documentoenvio)
    {
        $sql =  "insert into documento_envio ( doe_documento,doe_destinatario,doe_data_envio,doe_visto,doe_retorno )values";
        $sql .= "( '".$documentoenvio->getDoe_documento()."','".$documentoenvio->getDoe_destinatario()."','".$documentoenvio->getDoe_data_envio()."','".$documentoenvio->getDoe_visto()."','".$documentoenvio->getDoe_retorno()."')";
        echo $sql;
        return $this->executeAndReturnLastID($sql);
    }

    // **********************
    // DELETE
    // **********************

    public function deleteDocumentoEnvio($iddocumentoenvio)
    {
        $sql = "delete from documento_envio where doe_id = $iddocumentoenvio";
        return $this->executeAndReturnLastID($sql);
    }

    // **********************
    // SELECT BY ID
    // **********************

    function selectByIdDocumentoEnvio($iddocumentoenvio)
    {
        $sql = "select * from documento_envio dor ";
        $sql .= "where doe_id = ". $iddocumentoenvio." limit 1 ";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        $documentoenvio= new DocumentoEnvio();
        $documentoenvio->setDoe_id($qr['doe_id']);
        $documentoenvio->setDoe_documento($qr['doe_documento']);
        $documentoenvio->setDoe_destinatario($qr['doe_destinatario']);
        $documentoenvio->setDoe_data_envio($qr['doe_data_envio']);
        $documentoenvio->setDoe_visto($qr['doe_visto']);
        $documentoenvio->setDoe_retorno($qr['doe_retorno']);

        return $documentoenvio;
    }

    // **********************
    // SELECT ALL
    // **********************

    function  selectAllDocumentoEnvio()
    {
        $sql = "select * from documento_envio ";
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
            $documentoenvio= new DocumentoEnvio();
            $documentoenvio->setDoe_id($qr['doe_id']);
            $documentoenvio->setDoe_documento($qr['doe_documento']);
            $documentoenvio->setDoe_data_envio($qr['doe_data_envio']);
            $documentoenvio->setDoe_retorno($qr['doe_retorno']);

            array_push($lista,$documentoenvio);
        };
        return $lista;
    }

    // **********************
    // UPDATE
    // **********************

    function updateDocumentoEnvio($documentoenvio)
    {
        $sql = "update documento_envio set ";
        $sql .= "doe_documento = '".$documentoenvio->getDoe_documento()."',";
$sql .= "doe_destinatario = '".$documentoenvio->getDoe_destinatario()."',";
$sql .= "doe_data_envio = '".$documentoenvio->getDoe_data_envio()."',";
$sql .= "doe_visto = '".$documentoenvio->getDoe_visto()."',";
$sql .= "doe_retorno = '".$documentoenvio->getDoe_retorno()."',";

        $sql .= "where doe_id = '".$documentoenvio->getDoe_id()."'";
        return $this->execute($sql);
    }

    public function insertParcial($doe)
    {
        $sql  = "insert into documento_envio (doe_documento, doe_destinatario, doe_data_envio, doe_retorno) values ";
        $sql .= "('".$doe->getDoe_documento()."', ";
        $sql .= "'".$doe->getDoe_destinatario()."', ";
        $sql .= "CURDATE(), ";
        $sql .= "'".$doe->getDoe_retorno()."')";
        return $this->executeAndReturnLastID($sql);
    }

    public function listarEscola($idEscola)
    {
        $sql = "SELECT *, IF(doe.doe_retorno = 1 AND dor.dor_id IS NULL, 1, 0) as retorno_pendente FROM documento_envio doe ";
        $sql .= "LEFT JOIN documento_retorno dor ON dor.dor_envio = doe.doe_id ";
        $sql .= "JOIN documento doc ON doc.doc_id = doe.doe_documento ";
        $sql .= "WHERE doe_destinatario = ".$idEscola." ORDER BY doe_data_envio DESC";

        $lista = array();
        $result = $this->retrieve($sql);
        
        while ($qr = mysqli_fetch_array($result)){
            $documentoenvio= new DocumentoEnvio();
            $documentoenvio->setDoe_id($qr['doe_id']);
            $documentoenvio->setDoe_documento(new Documento());
            $documentoenvio->getDoe_documento()->setDoc_id($qr["doc_id"]);
            $documentoenvio->getDoe_documento()->setDoc_assunto($qr["doc_assunto"]);
            $documentoenvio->getDoe_documento()->setDoc_descricao($qr["doc_descricao"]);
            $documentoenvio->getDoe_documento()->setDoc_arquivo($qr["doc_arquivo"]);
            $documentoenvio->setDoe_destinatario($qr['doe_destinatario']);
            $documentoenvio->setDoe_data_envio($qr['doe_data_envio']);
            $documentoenvio->setDoe_visto($qr['doe_visto']);
            $documentoenvio->setDoe_retorno($qr['doe_retorno']);

            array_push($lista, [
                "documento_envio" => $documentoenvio,
                "verificadores" => [
                    "retorno_pendente" => intval($qr["retorno_pendente"]),
                    "retorno_rejeitado" => intval($qr["dor_rejeitado"])
                ]
            ]);
        };
        return $lista;
    }

    public function visualizar($idEnvio)
    {
        $sql = "UPDATE documento_envio SET doe_visto = 1 WHERE doe_id = ".$idEnvio;

        if ($this->execute($sql))
            return 1;
        else
            return 0;
    }

    public function listarDocumento($idDocumento)
    {
        $sql = "SELECT * FROM documento_envio doe JOIN documento doc ON doe.doe_documento = doc.doc_id WHERE doe_documento = ".$idDocumento." ORDER BY doe_data_envio DESC";
        $lista = array();
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
            $documentoenvio= new DocumentoEnvio();
            $documentoenvio->setDoe_id($qr['doe_id']);
            $documentoenvio->setDoe_documento(new Documento());
            $documentoenvio->getDoe_documento()->setDoc_id($qr["doc_id"]);
            $documentoenvio->getDoe_documento()->setDoc_assunto($qr["doc_assunto"]);
            $documentoenvio->getDoe_documento()->setDoc_descricao($qr["doc_descricao"]);
            $documentoenvio->setDoe_destinatario($qr['doe_destinatario']);
            $documentoenvio->setDoe_data_envio($qr['doe_data_envio']);
            $documentoenvio->setDoe_visto($qr['doe_visto']);
            $documentoenvio->setDoe_retorno($qr['doe_retorno']);

        return $documentoenvio;
    }
    
    public function getEnviosByDocumento($doc_id) {
        $sql  = "select distinct dor.dor_envio, doe.*, esc.esc_id, esc.esc_nome, ";
        $sql .= "IF (dor.dor_id = (select max(dor2.dor_id) from documento_retorno dor2 where dor2.dor_envio = doe.doe_id) or dor.dor_id is null, dor.dor_id, 'antigo') as dor_id, ";
        $sql .= "dor.dor_rejeitado, dor.dor_visto is not null as dor_visto, ";
        $sql .= "doc.doc_id, doc.doc_descricao is not null as doc_descricao ";
        $sql .= "from documento_envio doe ";
        $sql .=	"join escola esc on doe.doe_destinatario = esc.esc_id ";
        $sql .=    "left join documento_retorno dor on doe.doe_id = dor.dor_envio ";
        $sql .=    "left join documento doc on dor.dor_documento = doc.doc_id ";
        $sql .= "where doe.doe_documento = {$doc_id};";
        
        $result = $this->retrieve($sql);
        $retorno = [];
        
        while ($qr = mysqli_fetch_array($result)) {
            if($qr["dor_id"] == "antigo"){
                continue;
            }
            
            $doe = new DocumentoEnvio();
            $doe->setDoe_id($qr["doe_id"]);
            $doe->setDoe_data_envio($qr["doe_data_envio"]);
            $doe->setDoe_documento($qr["doe_documento"]);
            $doe->setDoe_retorno($qr["doe_retorno"]);
            $doe->setDoe_visto($qr["doe_visto"]);
            $doe->setDoe_destinatario(new Escola());
            $doe->getDoe_destinatario()->setEsc_id($qr["esc_id"]);
            $doe->getDoe_destinatario()->setEsc_nome($qr["esc_nome"]);
            
            $dados = ["envio" => $doe];
            
            if ($qr["dor_id"] != null) {
                $dor = new DocumentoRetorno();
                $dor->setDor_id($qr["dor_id"]);
                $dor->setDor_visto($qr["dor_visto"]);
                $dor->setDor_rejeitado($qr["dor_rejeitado"]);
                $dor->setDor_documento(new Documento());
                $dor->getDor_documento()->setDoc_id($qr["doc_id"]);
                $dor->getDor_documento()->setDoc_descricao($qr["doc_descricao"]);
                
                $dados["retorno"] = $dor;
            } else {
                $dados["retorno"] = false;
            }
            
            array_push($retorno, $dados);
        }
        
        return $retorno;
    }

    public function isPendenciaRetornoEscola($idEscola)
    {
        $sql = "SELECT MAX(IF(doe.doe_retorno = 1 AND (dor.dor_id IS NULL), 1, 0)) AS pendencia, MIN(dor.dor_rejeitado) as rejeitado FROM documento_envio doe LEFT JOIN documento_retorno dor ON dor.dor_envio = doe.doe_id WHERE doe.doe_destinatario = 72 GROUP BY doe.doe_id ORDER BY pendencia DESC";
        $result = $this->retrieve($sql);
        while($qr = mysqli_fetch_array($result)){
            if ($qr["pendencia"] == 1 || $qr["rejeitado"] == 1)
                return 1;
        }

        return 0; 
    }

    public function isPendenciasRetornoHospital()
    {
        $sql = "SELECT MAX(dor.dor_id IS NULL OR dor.dor_rejeitado) AS pendencia FROM documento_envio doe LEFT JOIN documento_retorno dor ON dor.dor_envio = doe.doe_id WHERE doe.doe_destinatario = ".$idEscola." GROUP BY doe.doe_id ORDER BY pendencia DESC LIMIT 1";
        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_array($result);
        return $qr["pendencia"]; 
    }
    
    public function checkPendenciasOf($doe_id) {
        $sql  = "select if (";
        $sql .=    "(select count(dod_id) from documento_destinatario ";
        $sql .=     "where dod_envio = {$doe_id} and dod_visto = 1) = 0, 1, 0) as pendencias ";
        $sql .= "from documento_envio;";
        
        return mysqli_fetch_assoc($this->retrieve($sql))["pendencias"];
    }
}
?>