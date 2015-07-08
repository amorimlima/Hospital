    <?php

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of Acesso
     *
     * @author Kevyn
     */
    class Acesso {

        private $prf_id;
        private $id_menu;

        public function Acesso()
        {

        }

        public function getPrf_id(){
            return $this->prf_id;
        }
        public function  getId_menu(){
            return $this->id_menu;
        }


        public function setPrf_id($val){
            $this->prf_id = $val;
        }
        public function setId_menu($val){
            $this->id_menu = $val;
        }

    }
    ?>