
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

/**
 * @author Diego Garcia
 * @author Lucas Tavares
 */
class DocumentoEnvio
{
    private $doe_id;
    private $doe_documento;
    private $doe_data_envio;
    private $doe_retorno;
    

    public function DocumentoEnvio() { }

    public function getDoe_id()
    {
        return $this->doe_id;
    }
    
    public function getDoe_documento()
    {
        return $this->doe_documento;
    }
    
    public function getDoe_data_envio()
    {
        return $this->doe_data_envio;
    }
    
    public function getDoe_retorno()
    {
        return $this->doe_retorno;
    }
    


    public function setDoe_id($val)
    {
        $this->doe_id =  $val;
    }

    public function setDoe_documento($val)
    {
        $this->doe_documento =  $val;
    }

    public function setDoe_data_envio($val)
    {
        $this->doe_data_envio =  $val;
    }

    public function setDoe_retorno($val)
    {
        $this->doe_retorno =  $val;
    }

}

?>

