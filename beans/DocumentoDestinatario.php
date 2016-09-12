<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentoDestinatario
 *
 * @author LucasTavares
 */
class DocumentoDestinatario {
    private $dod_id;
    private $dod_envio;
    private $dod_destinatario;
    
    public function getDod_id() {
        return $this->dod_id;
    }
    
    public function getDod_envio() {
        return $this->dod_envio;
    }
    
    public function getDod_destinatario() {
        return $this->dod_destinatario;
    }
    
    public function setDod_id($id) {
        $this->dod_id = $id;
    }
    
    public function setDod_envio($envio) {
        $this->dod_envio = $envio;
    }
    
    public function setDod_destinatario($destinatario) {
        $this->dod_destinatario = $destinatario;
    }
}
