<?php
    class persona {
        private $ci;
        private $primer_nombre;
        private $segundo_nombre;
        private $primer_apellido;
        private $segundo_apellido;
        private $fecha_nacimiento;
        private $foto;
        private $codigo_credencial;
        
        
        public function __construct($ci, $primer_nombre, $segundo_nombre, $primer_apellido, 
        $segundo_apellido, $fecha_nacimiento, $foto, $codigo_credencial) {
            $this-> ci = $ci;
            $this-> primer_nombre = $primer_nombre;
            $this-> segundo_nombre = $segundo_nombre;
            $this-> primer_apellido = $primer_apellido;
            $this-> segundo_apellido = $segundo_apellido;
            $this-> fecha_nacimiento = $fecha_nacimiento;
            $this-> foto = $foto;
            $this-> codigo_credencial = $codigo_credencial;
        } 
        
    }
