<?php

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Documento.php');
include_once($path['beans'].'DocumentoDestinatario.php');
include_once($path['beans'].'DocumentoRetorno.php');
include_once($path['beans'].'DocumentoEnvio.php');

/**
 * Description of DocumentoDestinatarioDAO
 *
 * @author LucasTavares
 */


class DocumentoDestinatarioDAO extends DAO {
    
    public function  __construct($da) {
        parent::__construct($da);
    }
    
    public function insert($dod) {
        $sql  = "insert into documento_destinatario (dod_envio, dod_destinatario) ";
        $sql .= "values ('{$dod->getDod_envio()}', '{$dod->getDod_destinatario()}');";
        
        return $this->executeAndReturnLastID($sql);
    }
    
    public function delete($dod_id) {
        $sql = "delete from documento_destinatario where dod_id = {$dod_id};";
        
        if ($this->execute($sql))
            return 1;
        else
            return 0;
    }
    
    public function update($dod) {
        $sql  = "update documento_destinatario set ";
        $sql .= "dod_envio = {$dod->getDod_envio()}, ";
        $sql .= "dod_destinatario = {$dod->getDod_destinatario()}, ";
        $sql .= "dod_visto = {$dod->getDod_visto()} ";
        $sql .= "where dod_id = {$dod->getDod_id()};";
        
        if ($this->execute($sql))
            return 1;
        else
            return 0;
    }
    
    public function get($dod_id) {
        $sql  = "select * from documento_destinatario ";
        $sql .= "where dod_id = {$dod_id} limit 1;";
        $result = $this->retrieve($sql);
        $retorno = 0;
        
        if ($qr = mysqli_fetch_assoc($result)) {
            $retorno = new DocumentoDestinatario();
            $retorno->setDod_id($qr["dod_id"]);
            $retorno->setDod_envio($qr["dod_envio"]);
            $retorno->setDod_destinatario($qr["dod_destinatario"]);
            $retorno->setDod_visto($qr["dod_visto"]);
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
    
    public function getAll() {
        $sql = "select * from documento_destinatario;";
        $retorno = [];
        
        if ($result = $this->retrieve($sql)) {
            while ($qr = mysqli_fetch_assoc($result)) {
                $dod = new DocumentoDestinatario();
                $dod->setDod_id($qr["dod_id"]);
                $dod->setDod_envio($qr["dod_envio"]);
                $dod->setDod_destinatario($qr["dod_destinatario"]);
                $dod->setDod_visto($qr["dod_visto"]);

                array_push($retorno, $dod);
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
    
    public function getAllByEnvio($doe_id) {
        $sql = "select * from documento_destinatario where dod_envio = {$doe_id};";
        $retorno = [];
        
        if ($result = $this->retrieve($sql)) {
            while ($qr = mysqli_fetch_assoc($result)) {
                $dod = new DocumentoDestinatario();
                $dod->setDod_id($qr["dod_id"]);
                $dod->setDod_envio($qr["dod_envio"]);
                $dod->setDod_destinatario($qr["dod_destinatario"]);
                $dod->setDod_visto($qr["dod_visto"]);
                
                array_push($retorno, $dod);
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
    
    public function checkPendenciasOf($dod_id) {
        $sql  = "select if (";
        $sql .=     "(select count(dor_id) from documento_retorno ";
        $sql .=     "where dor_destinatario = {$dod_id}) > 0, ";
        $sql .= "0, 1) as pendencia ";
        $sql .= "from documento_destinatario where dod_id = {$dod_id};";
        
        $result = mysqli_fetch_assoc($this->retrieve($sql));
        
        return $result["pendencia"];
    }
    
    public function getEnviosFor($esc_id) {
        $sql = "select * from documento_destinatario where dod_destinatario = {$esc_id};";
        $result = $this->retrieve($sql);
        $retorno = [];
        
        while($qr = mysqli_fetch_assoc($result)) {
            $dod = new DocumentoDestinatario();
            $dod->setDod_id($qr["dod_id"]);
            $dod->setDod_envio($qr["dod_envio"]);
            $dod->setDod_destinatario($qr["dod_destinatario"]);
            $dod->setDod_visto($qr["dod_visto"]);
            array_push($retorno, $dod);
        }
        
        return $retorno;
    }
    
    public function checkRetornoRejeitadoOf($dod_id) {
        $sql = "select distinct ";
        $sql .=     "(select count(dor_id) from documento_retorno ";
        $sql .=         "where dor_destinatario = {$dod_id} and dor_rejeitado = 1) = ";
        $sql .=     "(select count(dor_id) from documento_retorno ";
        $sql .=         "where dor_destinatario = {$dod_id}) ";
        $sql .= "as rejeitado from documento_retorno ";
        $sql .= "where dor_destinatario = {$dod_id};";

        $result = $this->retrieve($sql);
        $qr = mysqli_fetch_assoc($result);
        
        return $qr["rejeitado"];
    }

    public function insertDocumentosPadrao($esc_id)
    {
        $sql = "INSERT INTO documento_destinatario (`dod_envio`, `dod_destinatario`) VALUES (1, ".$esc_id.")";
        return $this->executeAndReturnLastID($sql);
    }
}