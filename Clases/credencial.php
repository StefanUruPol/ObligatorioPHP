<?php
    class credencial {
        private $tipo;
        private $codigo;
        private $fecha_valida_desde;
        private $fecha_valida_hasta;
        private $pin;
        private $fecha_y_hora;
        private $CI_persona;
        private $RUT_empresa;
        
        public function __construct($tipo, $codigo, $fecha_valida_desde, $fecha_valida_hasta, 
        $pin, $fecha_y_hora, $CI_persona, $RUT_empresa) {
            $this-> tipo = $tipo;
            $this-> codigo = $codigo;
            $this-> fecha_valida_desde = $fecha_valida_desde;
            $this-> fecha_valida_hasta = $fecha_valida_hasta;
            $this-> pin = $pin;
            $this-> fecha_y_hora = $fecha_y_hora;
            $this-> CI_persona = $CI_persona;
            $this-> RUT_empresa = $RUT_empresa;
        }
    }
