<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Kevyn
 */
class Menu {
   private $id_menu;
   private $tipo_menu;
   private $btn_menu;
   private $obj_menu;
   
   public function Menu()
    {

    }
    
    public function getId_men(){
        return $this->id_menu;
    }
    public function  getTipo_menu(){
        return $this->tipo_menu;
    }
    public function  getBtn_menu(){
        return $this->btn_menu;
    }
    public function  getOrdem_menu(){
        return $this->obj_menu;
    }
    
    
    public function setId_men($val){
        $this->id_menu = $val;
    }
    public function  setTipo_menu($val){
        $this->tipo_menu = $val;
    }
    public function  setBtn_menu($val){
        $this->btn_menu = $val;
    }
    public function  setOrdem_menu($val){
        $this->obj_menu = $val;
    }
}
?>