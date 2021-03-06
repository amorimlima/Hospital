
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

/**
 * @author Diego Garcia
 * @author Lucas Tavares
 */
class DocumentoRetorno
{
    private $dor_id;
    private $dor_documento;
    private $dor_destinatario;
    private $dor_data;
    private $dor_visto;
    private $dor_rejeitado;


    public function DocumentoRetorno() { }

    public function getDor_id()
    {
        return $this->dor_id;
    }
    
    public function getDor_documento()
    {
        return $this->dor_documento;
    }
    
    public function getDor_destinatario()
    {
        return $this->dor_destinatario;
    }
    
    public function getDor_data()
    {
        return $this->dor_data;
    }

    public function getDor_visto()
    {
        return $this->dor_visto;
    }
    
    public function getDor_rejeitado()
    {
        return $this->dor_rejeitado;
    }
    
    public function setDor_id($val)
    {
        $this->dor_id =  $val;
    }

    public function setDor_documento($val)
    {
        $this->dor_documento =  $val;
    }

    public function setDor_destinatario($val)
    {
        $this->dor_destinatario =  $val;
    }

    public function setDor_data($val)
    {
        $this->dor_data =  $val;
    }

    public function setDor_visto($val)
    {
        $this->dor_visto =  $val;
    }

    public function setDor_rejeitado($val)
    {
        $this->dor_rejeitado =  $val;
    }

}

?>

