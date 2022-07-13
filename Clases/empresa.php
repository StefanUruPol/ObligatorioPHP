<?php
    class empresa  {
        private $rut;
        private $nombre;
        private $direccion;
        private $telefono;
        private $logo;
        private $codigo_credencial;
        
        
        public function __construct($rut, $nombre, $direccion, 
        $telefono, $logo, $codigo_credencial) {
        
            $this-> rut = $rut;
            $this-> nombre = $nombre;
            $this-> direccion = $direccion;
            $this-> telefono = $telefono;
            $this-> logo = $logo;
            $this-> codigo_credencial = $codigo_credencial;
        }
        
    }
