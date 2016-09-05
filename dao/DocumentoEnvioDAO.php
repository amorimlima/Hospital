
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
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'DocumentoEnvio.php');


/**
 * Description of DocumentoEnvioDAO
 *
 * @author MURANO DESIGN
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
        $sql = "select * from documento_envio where doe_id = ". $iddocumentoenvio."limit 1 ";
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
$documentoenvio->setDoe_destinatario($qr['doe_destinatario']);
$documentoenvio->setDoe_data_envio($qr['doe_data_envio']);
$documentoenvio->setDoe_visto($qr['doe_visto']);
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
        $sql = "SELECT * FROM documento_envio WHERE doe_destinatario = ".$idEscola;
        $lista = array();
        $result = $this->retrieve($sql);
        while ($qr = mysqli_fetch_array($result)){
            $documentoenvio= new DocumentoEnvio();
            $documentoenvio->setDoe_id($qr['doe_id']);
            $documentoenvio->setDoe_documento($qr['doe_documento']);
            $documentoenvio->setDoe_destinatario($qr['doe_destinatario']);
            $documentoenvio->setDoe_data_envio($qr['doe_data_envio']);
            $documentoenvio->setDoe_visto($qr['doe_visto']);
            $documentoenvio->setDoe_retorno($qr['doe_retorno']);

            array_push($lista,$documentoenvio);
        };
        return $lista;
    }
}
?>