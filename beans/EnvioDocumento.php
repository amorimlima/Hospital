<?php

class EnvioDocumento{
    
    private $env_id;
    private $env_idEscola;
    private $env_idRemetente;
    private $env_idDestinatario;
    private $env_url;
    private $visto;
    
    function getEnv_id() {
        return $this->env_id;
    }

    function getEnv_idEscola() {
        return $this->env_idEscola;
    }

    function getEnv_idRemetente() {
        return $this->env_idRemetente;
    }

    function getEnv_idDestinatario() {
        return $this->env_idDestinatario;
    }

    function getEnv_url() {
        return $this->env_url;
    }

    function getVisto() {
        return $this->visto;
    }

    function setEnv_id($env_id) {
        $this->env_id = $env_id;
    }

    function setEnv_idEscola($env_idEscola) {
        $this->env_idEscola = $env_idEscola;
    }

    function setEnv_idRemetente($env_idRemetente) {
        $this->env_idRemetente = $env_idRemetente;
    }

    function setEnv_idDestinatario($env_idDestinatario) {
        $this->env_idDestinatario = $env_idDestinatario;
    }

    function setEnv_url($env_url) {
        $this->env_url = $env_url;
    }

    function setVisto($visto) {
        $this->visto = $visto;
    }



}

?>